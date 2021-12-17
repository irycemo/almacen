<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Articles extends Component
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
    public $name;
    public $stock;
    public $description;
    public $category_id;
    public $area;

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
        $this->reset('article_id','name','stock', 'description','category_id');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    protected function rules(){
        return[
            'name' => 'required',
            'stock' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required'
        ];
    }

    public function openModalCreate(){

        $this->resetAll();

        $this->edit = false;
        $this->modal = true;
        $this->create = true;
    }

    public function openModalEdit($article){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->article_id = $article['id'];
        $this->stock = $article['stock'];
        $this->description = $article['description'];
        $this->category_id = $article['category_id'];
        $this->name = $article['name'];

        $this->modal = true;
        $this->edit = true;
    }

    public function openModalDelete($article){

        $this->modalDelete = true;
        $this->article_id = $article['id'];
    }

    public function closeModal(){
        $this->resetAll();
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function create(){

        $this->validate();

        try {

            Article::create([
                'name' => $this->name,
                'stock' => $this->stock,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'created_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo ha sido creado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            $article = Article::findorFail($this->article_id);

            $article->update([
                'name' => $this->name,
                'stock' => $this->stock,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'updated_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo sido actualizado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function delete(){

        try {

            $article = Article::findorFail($this->article_id);

            $article->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo ha sido eliminado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function render()
    {

        $categories = Category::all();

        $articles = Article::with('createdBy', 'updatedBy', 'category')
                                    ->where('name', 'LIKE', '%' . $this->search . '%')
                                    ->orwhere('description', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere(function($q){
                                        return $q->whereHas('category', function($q){
                                            return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                        });
                                    })
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate(10);

        return view('livewire.articles', compact('articles', 'categories'));
    }
}
