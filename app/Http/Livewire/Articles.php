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
    public $pagination=10;

    public $article_id;
    public $name;
    public $brand;
    public $stock;
    public $serial;
    public $description;
    public $category_id;
    public $location;

    protected function rules(){
        return[
            'name' => 'required',
            'brand' => 'required',
            'serial' => 'nullable',
            'description' => 'required',
            'category_id' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'El campo nombre es obligatorio.',
        'brand.required' => 'El campo marca es obligatorio.',
        'description.required' => 'El campo descripción es obligatorio.',
        'category_id.required' => 'El campo categoría es obligatorio.',
    ];

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
        $this->reset('article_id','name', 'description','category_id','location', 'brand', 'serial');
        $this->resetErrorBag();
        $this->resetValidation();
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
        $this->brand = $article['brand'];
        $this->stock = $article['stock'];
        $this->serial = $article['serial'];
        $this->description = $article['description'];
        $this->category_id = $article['category_id'];
        $this->name = $article['name'];
        $this->location = $article['location'];

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

            if(Article::where('name', $this->name)->where('location', $this->location)->where('serial', $this->serial)->first()){
                $this->dispatchBrowserEvent('showMessage',['error', "El artículo ya se encuentra en " . $this->location ." actualice su stock"]);
                return;
            }

            Article::create([
                'name' => $this->name,
                'brand' => $this->brand,
                'serial' => $this->serial,
                'stock' => 0,
                'description' => $this->description,
                'location' => 'general',
                'category_id' => $this->category_id,
                'created_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo ha sido creado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);

            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            $article = Article::findorFail($this->article_id);

            $article->update([
                'name' => $this->name,
                'brand' => $this->brand,
                'serial' => $this->serial,
                'description' => $this->description,
                'location' => $this->location,
                'category_id' => $this->category_id,
                'updated_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo sido actualizado con 'exito."]);

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

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo ha sido eliminado con éxito."]);

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
                                    ->orwhere('brand', 'LIKE', '%' . $this->search . '%')
                                    ->orwhere('serial', 'LIKE', '%' . $this->search . '%')
                                    ->orwhere('location', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere(function($q){
                                        return $q->whereHas('category', function($q){
                                            return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                        });
                                    })
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate($this->pagination);

        return view('livewire.articles', compact('articles', 'categories'));
    }
}
