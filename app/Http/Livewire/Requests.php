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
    public $request_status;
    public $request_number;
    public $request_author;
    public $request_created_at;
    public $request_comment;
    public $comment;

    protected $queryString = ['search'];

    public function resetAll(){
        $this->reset('selected_id','request_status', 'request_content', 'request_number', 'request_author', 'request_created_at','request_comment', 'comment');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalDetail($request){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->selected_id = $request['id'];
        $this->request_status = $request['status'];
        $this->request_content = json_decode($request['content'],true);
        $this->request_author = $request['created_by']['name'];
        $this->request_number = $request['number'];
        $this->request_created_at = $request['created_at'];
        $this->request_comment = $request['comment'];

        $this->modal = true;
        $this->edit = true;

    }

    public function delete(){

        try {

            $request = Request::findorFail($this->selected_id);

            if($request->status != 'rechazada'){

                $content = json_decode($request->content,true);

                foreach ($content as $article) {

                    try {

                        $aux = Article::find($article['id']);
                        $aux->stock = $aux->stock + $article['quantity'];
                        $aux->save();

                    } catch (\Throwable $th) {
                        Log::error("Error al reestablecer el stock de artículos de la solicitud id:" . $this->selected_id . " por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
                        $this->dispatchBrowserEvent('showMessage',['warning', "No se pudo reestablecer el stock para " .  $article['article'] . "."]);
                    }

                }
            }

            $request->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "La solicitud ha sido eliminada con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar solicitud por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function process($i){

        if($i == 3)
            $this->validate([
                'comment' => 'required'
            ],
            [
                'comment.required' => 'El campo comentario es obligatorio para rechazar.'
            ]);

        try {

            $request = Request::findorFail($this->selected_id);

            if($i == 1){

                $request->update([
                    'status' => 'aceptada',
                    'comment' => $request->comment . ' ' . $this->comment,
                    'updated_by' => auth()->user()->id,
                ]);

            }elseif($i == 2){

                $this->dispatchBrowserEvent('receipt',route('requests.receipt', $request->id));

                if($request->createdBy->roles[0]['name'] == 'Director'){

                    $this->createArticles($request);

                }

                $request->update([
                    'status' => 'entregada',
                    'comment' => $request->comment . ' ' . $this->comment,
                    'updated_by' => auth()->user()->id,
                ]);

            }else{

                DB::transaction(function () use($request){

                    $content = json_decode($request->content,true);

                    foreach ($content as $article) {

                        try {

                            $aux = Article::find($article['id']);
                            $aux->stock = $aux->stock + $article['quantity'];
                            $aux->save();

                        } catch (\Throwable $th) {
                            $this->dispatchBrowserEvent('showMessage',['warning', "No se pudo reestablecer el stock para " .  $article['article'] . "."]);
                        }

                    }

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

            Log::error("Error al procesar solicitud por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function createArticles($request){


        $content = json_decode($request->content,true);

        foreach ($content as $article) {

            try {

                $aux = Article::find($article['id']);

                Article::create([
                    'name' => $aux->name,
                    'brand' =>$aux->brand,
                    'serial' => $aux->serial,
                    'stock' => $article['quantity'],
                    'location' => $request->createdBy->location,
                    'category_id' => $aux->category_id,
                    'created_by' => auth()->user()->id,
                    'description' => $aux->description
                ]);

            } catch (\Throwable $th) {
                Log::error("Error al crear articulo procesando la solicitud id:" . $this->selected_id . " por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
                $this->dispatchBrowserEvent('showMessage',['warning', "No se pudo procesar la solicitud."]);
            }

        }
    }

    public function render()
    {

        if(auth()->user()->roles[0]->name == 'Solicitante' || auth()->user()->roles[0]->name == 'Director'){

            $requests = Request::with('createdBy', 'updatedBy')
                                    ->where('created_by', auth()->user()->id)
                                    ->where(function($q){
                                        $q->where('status', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('number', 'LIKE', '%' . $this->search . '%');
                                    })
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate(10);

        }else{

            $requests = Request::with('createdBy', 'updatedBy')
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
