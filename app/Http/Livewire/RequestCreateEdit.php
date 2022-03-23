<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;

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

            $this->addArticle($object);

        }else{

            try {

                $this->addArticle($object);

                $number = Request::orderBy('number', 'desc')->value('number');

                $this->request = Request::create([
                    'number' => $number ? $number + 1 : 1,
                    'content' => json_encode($this->requestedArticles, JSON_FORCE_OBJECT),
                    'location' => auth()->user()->location,
                    'status' => 'solicitada',
                    'created_by' => auth()->user()->id,
                ]);

                $this->dispatchBrowserEvent('showMessage',['success', "Artículo agregado con exito."]);

            } catch (\Throwable $th) {

                $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);
            }

        }
    }

    public function addArticle($object){

        if($object['serial']){
            $this->requestedArticles[] = (array)$object;
            return;
        }

        $i = $this->searchForId($object['id'], $this->requestedArticles);

        if($i === null){
            $this->requestedArticles[] = (array)$object;
        }elseif($i >= 0){
            $this->requestedArticles[$i]['quantity'] = (int)$object['quantity'] + (int)$this->requestedArticles[$i]['quantity'];
        }

    }

    public function updateRequest(){

        try {

            $this->request->update([
                'content' => json_encode($this->requestedArticles, JSON_FORCE_OBJECT),
                'comment' => $this->comment,
                'updated_by' => auth()->user()->id,
                'status' => 'solicitada'
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La solicitud ha sido actualizada con exito."]);

            redirect()->route('requests.index');

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);
        }

    }

    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['id'] === $id) {
                return $key;
            }
        }
        return null;
     }

    public function deleteArticle($article){

        $article = json_decode($article,true);

        $i = $this->searchForId($article['id'], $this->requestedArticles);


        unset($this->requestedArticles[$i]);

        $this->requestedArticles = array_values($this->requestedArticles);

        try {

            $aux = Article::find($article['id']);
            $aux->stock = $aux->stock + (int)$article['quantity'];
            $aux->save();

            $this->request->update([
                'content' => $this->requestedArticles
            ]);

            $this->request->save();

            $this->dispatchBrowserEvent('showMessage',['success', "Artículo eliminado con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['warning', "No se pudo reestablecer el stock para " .  $article['article'] . "."]);
        }

    }

    public function mount(){

        if($this->request){

            $this->request_id = $this->request->id;

            $items = json_decode($this->request->content, true);

            for ($i=0; $i < count($items); $i++) {
                $this->requestedArticles [] = (array)$items[$i];
            }
        }

        if($this->request)
            $this->comment = $this->request->comment;

    }

    public function render()
    {

        if(auth()->user()->roles[0]['name'] == 'Administrador' || auth()->user()->roles[0]['name'] == 'Delegado(a) Administrativo'){
            $articles = Article::where('stock','!=', 0)
                                ->where('stock', '>',  0)
                                ->where(function($q){
                                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('brand', 'LIKE', '%' . $this->search . '%')
                                        ->orwhere('description', 'LIKE', '%' . $this->search . '%');
                                })
                                ->paginate(10);
        }else{
            $articles = Article::where('stock','!=', 0)
                ->where('location', auth()->user()->location)
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