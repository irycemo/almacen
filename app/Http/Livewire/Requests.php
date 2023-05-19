<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentsTrait;

class Requests extends Component
{

    use WithPagination;
    use ComponentsTrait;

    public $request_content = [];
    public $request;
    public $comment;

    protected $queryString = ['search'];

    public function resetAll(){
        $this->reset('selected_id', 'request_content', 'comment', 'request');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalDetail(Request $request){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->selected_id = $request->id;

        $this->request = $request;

        if(isset($request['content'])){

            $this->request_content = json_decode($request['content'],true);

        }

        $this->modal = true;
        $this->edit = true;

    }

    public function delete(){

        try {

            DB::transaction(function (){

                $request = Request::findorFail($this->selected_id);

                if($request->status != 'rechazada'){

                    $content = json_decode($request->content,true);

                    foreach ($content as $article) {

                        try {

                            $aux = Article::find($article['id']);
                            $aux->stock = $aux->stock + $article['quantity'];
                            $aux->save();

                        } catch (\Throwable $th) {
                            Log::error("Error al reestablecer el stock de artículos de la solicitud id:" . $this->selected_id . " por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                            $this->dispatchBrowserEvent('showMessage',['warning', "No se pudo reestablecer el stock para " .  $article['article'] . "."]);
                        }

                    }
                }

                $request->delete();

                $this->dispatchBrowserEvent('showMessage',['success', "La solicitud ha sido eliminada con éxito."]);

                $this->closeModal();

            });

        } catch (\Throwable $th) {

            Log::error("Error al borrar solicitud por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function process($action){

        if($action == 'rechazar')

            $this->validate([
                'comment' => 'required'
            ],
            [
                'comment.required' => 'El campo comentario es obligatorio para rechazar.'
            ]);

        try {

            $request = Request::findorFail($this->selected_id);

            if($action == 'aceptar'){

                $request->update([
                    'status' => 'aceptada',
                    'comment' => $request->comment . ' ' . $this->comment,
                    'updated_by' => auth()->user()->id,
                ]);

            }elseif($action == 'entregar'){

                if($request->createdBy->roles[0]['name'] == 'Director'){

                    $this->createArticles($request);

                }

                $array = [];

                foreach($request->requestDetails as $article){

                    $content =  (object)[];

                    $content->article = $article->name;
                    $content->quantity = $article->pivot->quantity;
                    $content->serial = $article->serial;
                    $content->brand = $article->brand;
                    $content->id = $article->id;
                    $content->price = (float)$article->precio * $article->pivot->quantity;

                    $array[] = $content;

                }

                DB::transaction(function () use($request, $array){

                    $request->requestDetails()->detach();

                    $request->update([
                        'content' => !empty($array) ? json_encode($array, JSON_FORCE_OBJECT) : $request->content,
                        'status' => 'entregada',
                        'comment' => $request->comment . ' ' . $this->comment,
                        'updated_by' => auth()->user()->id,
                    ]);

                    $this->dispatchBrowserEvent('receipt',route('requests.receipt', $request->id));

                });

            }else{

                DB::transaction(function () use($request){

                    foreach ($request->requestDetails as $article) {

                        try {

                           $article->increment('stock', $article->pivot->quantity);

                        } catch (\Throwable $th) {

                            $this->dispatchBrowserEvent('showMessage',['warning', "No se pudo reestablecer el stock para " .  $article->name . "."]);

                        }

                    }

                    $request->requestDetails()->detach();

                    $request->update([
                        'status' => 'rechazada',
                        'comment' => $request->comment . ' ' . $this->comment,
                        'updated_by' => auth()->user()->id,
                    ]);

                });
            }

            $this->resetAll();

            $this->dispatchBrowserEvent('showMessage',['success', "La solicitud sido actualizada con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al procesar solicitud por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function createArticles($request){


        foreach ($request->requestDetails as $article) {

            try {

                $aux = Article::where('name', $article->name)
                                ->where('brand', $article->brand)
                                ->where('serial', $article->serial)
                                ->where('precio', $article->precio)
                                ->where('location', $request->createdBy->location)
                                ->first();

                if($aux){

                    $aux->increment('stock', $article->pivot->quantity);

                }else{

                    Article::create([
                        'name' => $article->name,
                        'brand' =>$article->brand,
                        'serial' => $article->serial,
                        'stock' => $article->pivot->quantity,
                        'location' => $request->createdBy->location,
                        'category_id' => $article->category_id,
                        'created_by' => auth()->user()->id,
                        'description' => $article->description,
                        'precio' => $article->precio
                    ]);
                }

            } catch (\Throwable $th) {
                Log::error("Error al crear articulo procesando la solicitud id:" . $this->selected_id . " por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                $this->dispatchBrowserEvent('showMessage',['warning', "No se pudo procesar la solicitud."]);
            }

        }
    }

    public function render()
    {

        if(auth()->user()->roles[0]->name == 'Solicitante' || auth()->user()->roles[0]->name == 'Director'){

            $requests = Request::with('createdBy', 'updatedBy', 'requestDetails')
                                    ->where('created_by', auth()->user()->id)
                                    ->where(function($q){
                                        $q->where('status', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('number', 'LIKE', '%' . $this->search . '%');
                                    })
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate(10);

        }else{

            $requests = Request::with('createdBy', 'updatedBy', 'requestDetails')
                                    ->where('status', 'LIKE', '%' . $this->search . '%')
                                    ->orwhere('number', 'LIKE', '%' . $this->search . '%')
                                    ->orwhere('content', 'LIKE', '%' . $this->search . '%')
                                    ->orwhere('location', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere(function($q){
                                        $q->whereHas('createdBy', function($q){
                                            $q->where('name', 'LIKE', '%' . $this->search . '%');
                                        })
                                            ->orWhere('number', 'LIKE', '%' . $this->search . '%');
                                    })
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate(10);
        }

        return view('livewire.requests', compact('requests'));
    }
}
