<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RequestDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RequestCreateEdit extends Component
{

    use WithPagination;

    public $search;

    public $request;
    public $request_id;
    public $content;
    public $status;
    public $comment;
    public $requestedArticles = [];
    public $quantity;

    protected $listeners = ['addOrCreateArticle'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function addOrCreateArticle($object){

        if($this->request){

            try {

                DB::transaction(function () use ($object) {


                    $detail = RequestDetail::where('request_id',$this->request->id)
                                ->where('article_id', $object['id'])
                                ->first();

                    if($detail){

                        $detail->update(['quantity' => $detail->quantity + $object['quantity']]);

                        Article::find($object['id'])->decrement('stock', (int)$object['quantity']);

                        $this->dispatchBrowserEvent('showMessage',['success', "Artículo agregado con exito."]);

                    }else{

                        $this->request->requestDetails()->attach($object['id'], ['quantity' => $object['quantity']]);

                        Article::find($object['id'])->decrement('stock', (int)$object['quantity']);

                        $article = Article::find($object['id']);

                        $this->request->price = $article->precio * (float)$object['quantity'];

                        $this->request->save();

                        $this->dispatchBrowserEvent('showMessage',['success', "Artículo agregado con exito."]);

                    }

                    $this->request->refresh();

                });

            } catch (\Throwable $th) {

                Log::error("Error al agregar articulos a la solicitud por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            }


        }else{

            try {

                DB::transaction(function () use ($object) {

                    $number = Request::max('number') + 1;

                    $this->request = Request::create([
                        'number' => $number,
                        'location' => auth()->user()->location,
                        'status' => 'solicitada',
                        'created_by' => auth()->user()->id,
                    ]);

                    $this->request->requestDetails()->attach($object['id'], ['quantity' => $object['quantity']]);

                    Article::find($object['id'])->decrement('stock', (int)$object['quantity']);

                    $article = Article::find($object['id']);

                    $this->request->price = $article->precio * (float)$object['quantity'];

                    $this->request->save();

                    $this->dispatchBrowserEvent('showMessage',['success', "Artículo agregado con exito."]);

                });

            } catch (\Throwable $th) {

                Log::error("Error al agregar articulos a la solicitud por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            }

        }
    }

    public function updateRequest(){

        try {

            $this->request->update([
                'comment' => $this->comment,
                'updated_by' => auth()->user()->id,
                'status' => 'solicitada'
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La solicitud ha sido actualizada con exito."]);

            redirect()->route('requests.index');

        } catch (\Throwable $th) {

            Log::error("Error al actualizar solicitud id:" .$this->request->id . " por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

        }

    }

    public function deleteArticle($detail){

        $detail = json_decode($detail, true);

        try {

            DB::transaction(function () use ($detail) {

                $article = Article::find($detail['id']);

                $article->stock = $article->stock + (int)$detail['pivot']['quantity'];

                $article->save();

                $resta = (float)$this->request->price - ($article->precio * (float)$detail['pivot']['quantity']);

                $this->request->price = $resta < 0 ? 0 : $resta;

                $this->request->save();

                $this->request->requestDetails()->detach($detail['id']);

                $this->request->refresh();

                $this->dispatchBrowserEvent('showMessage',['success', "Artículo eliminado con exito."]);

            });

        } catch (\Throwable $th){

            Log::error("Error al borrar artículo de solicitud id:" .$this->request->id . " por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "No se pudo reestablecer el stock."]);

        }

    }

    public function mount(){

        if($this->request){

            $this->comment = $this->request->comment;

        }

    }

    public function render()
    {

        if(auth()->user()->roles[0]['name'] == 'Administrador'){

            $articles = Article::where('stock','!=', 0)
                                ->where('location', auth()->user()->location)
                                ->where('stock', '>',  0)
                                ->where(function($q){
                                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('brand', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('description', 'LIKE', '%' . $this->search . '%');
                                })
                                ->paginate(10);

        }elseif(auth()->user()->roles[0]['name'] == 'Director'){

            $articles = Article::where('stock','!=', 0)
                                ->where('location', 'general')
                                ->where('stock', '>',  0)
                                ->where(function($q){
                                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('brand', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('description', 'LIKE', '%' . $this->search . '%');
                                })
                                ->paginate(10);

        }elseif(auth()->user()->location == 'Dirección rpp' || auth()->user()->location == 'Dirección catastro'){

            $articles = Article::where('stock','!=', 0)
                                ->where('location', auth()->user()->location)
                                ->where('stock', '>',  0)
                                ->where(function($q){
                                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('brand', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('description', 'LIKE', '%' . $this->search . '%');
                                })
                                ->paginate(10);

        }elseif(auth()->user()->location != 'Dirección rpp' || auth()->user()->location != 'Dirección catastro'){

            $articles = Article::where('stock','!=', 0)
                                ->where('location', 'general')
                                ->where('stock', '>',  0)
                                ->where(function($q){
                                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('brand', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('description', 'LIKE', '%' . $this->search . '%');
                                })
                                ->paginate(10);

        }

        return view('livewire.request-create-edit', compact('articles'));
    }
}
