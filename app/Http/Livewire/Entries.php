<?php

namespace App\Http\Livewire;

use App\Models\Entrie;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Entries extends Component
{

    use WithPagination;

    public $modal = false;
    public $modalDelete = false;
    public $create = false;
    public $edit = false;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $article_id;
    public $article;
    public $entrie_id;
    public $origin;
    public $description;
    public $quantity;
    public $showArticles;
    public $searchArticle;
    public $price;
    public $articleDescription;

    protected function rules(){
        return[
            'origin' => 'required',
            'quantity' => 'required',
            'price' => 'nullable|numeric',
            'description' => 'required'
        ];
    }

    protected $messages = [
        'origin.required' => 'El campo origen es obligatorio.',
        'description.required' => 'El campo comentario es obligatorio.',
        'quantity.required' => 'El campo cantidad es obligatorio.',
    ];

    public function updatingSearchArticle(){
        $this->resetPage();
        $this->showArticles = true;
        $this->articleDescription = false;
    }

    public function updatedSearchArticle(){
        if($this->searchArticle == "")
            $this->showArticles = false;
    }

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
        $this->reset('article_id','entrie_id','origin', 'price', 'articleDescription', 'searchArticle','showArticles', 'quantity', 'description');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalCreate(){

        $this->resetAll();

        $this->edit = false;
        $this->modal = true;
        $this->create = true;
    }

    public function openModalEdit($entrie){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->article = Article::findorFail($entrie['article_id']);
        $this->article_id = $this->article->id;
        $this->articleDescription = true;
        $this->entrie_id = $entrie['id'];
        $this->location = $entrie['location'];
        $this->origin = $entrie['origin'];
        $this->price = $entrie['price'];
        $this->description = $entrie['description'];
        $this->quantity = $entrie['quantity'];

        $this->modal = true;
        $this->edit = true;
    }

    public function openModalDelete($entrie){

        $this->modalDelete = true;
        $this->entrie_id = $entrie['id'];
    }

    public function closeModal(){
        $this->resetAll();
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function create(){

        if($this->article['serial'])
            $this->validate([
                'origin' => 'required',
                'price' => 'nullable|numeric',
                'description' => 'required'
            ]);
        else
            $this->validate();

        if($this->origin == 'compra')
            $this->validate(['price' => 'required']);

        try {

            $article = Article::findorFail($this->article_id);

            if(!$article->serial)
                $stock = $article->stock + $this->quantity;
            else
                $stock = 1;

            $article->update([
                'stock' => $stock
            ]);

            Entrie::create([
                'article_id' => $this->article_id,
                'location' => $article->location,
                'origin' => $this->origin,
                'description' => $this->description,
                'price' => $this->origin === 'donación' ? 0 : $this->price,
                'quantity' => $article->serial ? 1 : $this->quantity,
                'created_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La entrada ha sido creada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);

            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            $entrie = Entrie::findorFail($this->entrie_id);

            $article = Article::findorFail($this->article_id);

            $article->update(['stock' => $this->article->serial ? 1 : $this->quantity]);

            $entrie->update([
                'article_id' => $this->article_id,
                'location' => $article->location,
                'origin' => $this->origin,
                'price' => $this->origin === 'donación' ? 0 : $this->price,
                'description' => $this->description,
                'quantity' => $article->serial ? 1 : $this->quantity,
                'created_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La entrada ha sido actualizada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);

            $this->closeModal();
        }
    }

    public function delete(){

        try {

            $entrie = Entrie::findorFail($this->entrie_id);

            $entrie->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "La entrada ha sido eliminada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function viewDetails($article){
        $this->article_id = $article['id'];
        $this->article = $article;

        $this->showArticles = false;
        $this->articleDescription = true;
    }

    public function render()
    {

        $articles = Article::with('entries')->where('name', 'LIKE', '%' . $this->searchArticle . '%')
                                        ->orWhere('serial', $this->searchArticle);

        if($this->searchArticle)
            $articles = $articles->simplePaginate(5);

        $entries = Entrie::with('article', 'createdBy', 'updatedBy')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

        return view('livewire.entries', compact('entries', 'articles'));
    }
}
