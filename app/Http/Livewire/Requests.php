<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Requests extends Component
{

    use WithPagination;

    public $modal = false;
    public $modalDelete = false;
    public $create = false;
    public $edit = false;
    public $search;
    public $sort = 'number';
    public $direction = 'desc';

    public $request_id;
    public $request_content = [];
    public $request_status;
    public $request_number;
    public $request_author;
    public $request_created_at;
    public $request_comment;
    public $comment;

    protected $queryString = ['search'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function order($sort){

        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function resetAll(){
        $this->reset('request_id','request_status', 'request_content', 'request_number', 'request_author', 'request_created_at','request_comment', 'comment');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalDetail($request){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->request_id = $request['id'];
        $this->request_status = $request['status'];
        $this->request_content = json_decode($request['content'],true);
        $this->request_author = $request['created_by']['name'];
        $this->request_number = $request['number'];
        $this->request_created_at = $request['created_at'];
        $this->request_comment = $request['comment'];

        $this->modal = true;
        $this->edit = true;

    }

    public function openModalDelete($request){

        $this->modalDelete = true;
        $this->request_id = $request['id'];
    }

    public function closeModal(){
        $this->resetAll();
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function delete(){

        try {

            $request = Request::findorFail($this->request_id);

            if($request->status != 'rechazada'){

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
            }

            $request->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "La solicitud ha sido eliminada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

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

            $request = Request::findorFail($this->request_id);

            if($i == 1){
                $request->update([
                    'status' => 'aceptada',
                    'comment' => $request->comment . ' ' . $this->comment,
                    'updated_by' => auth()->user()->id,
                ]);
            }elseif($i == 2){
                $request->update([
                    'status' => 'entregada',
                    'comment' => $request->comment . ' ' . $this->comment,
                    'updated_by' => auth()->user()->id,
                ]);
            }else{

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
            }

            $this->resetAll();

            $this->dispatchBrowserEvent('showMessage',['success', "La solicitud sido actualizada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function render()
    {

        if(auth()->user()->roles[0]->name == 'Jefe(a) de Departamento'){

            $requests = Request::with('createdBy', 'updatedBy')
                        ->where('created_by', auth()->user()->id)
                        ->where(function($q){
                            $q->where('status', 'LIKE', '%' . $this->search . '%')
                                ->orwhere('number', 'LIKE', '%' . $this->search . '%');
                        })
                        ->orderBy($this->sort, $this->direction)
                        ->paginate(10);
        }else if(auth()->user()->roles[0]->name == 'Almacenista'){

            $requests = Request::with('createdBy', 'updatedBy')
                ->where('status', '!=', 'solicitada')
                ->where(function($q){
                    $q->whereHas('createdBy', function($q){
                        $q->where('name', 'LIKE', '%' . $this->search . '%');
                    })
                        ->orWhere('number', 'LIKE', '%' . $this->search . '%');
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate(10);
        }else{

            $requests = Request::with('createdBy', 'updatedBy')
                            ->where('status', 'LIKE', '%' . $this->search . '%')
                            ->orwhere('number', 'LIKE', '%' . $this->search . '%')
                            ->orwhere('content', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                $q->whereHas('createdBy', function($q){
                                    $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }

        return view('livewire.requests', compact('requests'));
    }
}
