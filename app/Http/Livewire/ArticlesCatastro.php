<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ArticlesCatastro extends Component
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
    public $brand;
    public $serial;
    public $stock;
    public $description;
    public $category_id;
    public $area;
    public $origin;
    public $comment;

    protected function rules(){
        return[
            'name' => 'required',
            'brand' => 'required',
            'serial' => 'nullable',
            'stock' => 'nullable|numeric',
            'description' => 'required',
            'category_id' => 'required',
            'comment' => 'required',
            'origin' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'El campo nombre es obligatorio.',
        'brand.required' => 'El campo marca es obligatorio.',
        'description.required' => 'El campo descripción es obligatorio.',
        'category_id.required' => 'El campo categoría es obligatorio.',
        'comment.required' => 'El campo descripción del origen del artículo es obligatorio.',
        'origin.required' => 'El campo origen es obligatorio.',
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
        $this->reset('article_id','name','stock', 'description','category_id','origin', 'comment', 'brand', 'serial');
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
        $this->stock = $article['stock'];
        $this->brand = $article['brand'];
        $this->serial = $article['serial'];
        $this->description = $article['description'];
        $this->category_id = $article['category_id'];
        $this->name = $article['name'];
        $this->origin = $article['origin'];
        $this->comment = $article['comment'];

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

            if(Article::where('name', $this->name)->where('location', 'catastro')->where('serial', $this->serial)->first()){
                $this->dispatchBrowserEvent('showMessage',['error', "El artículo ya se encuentra en catastro actualice su stock"]);
                return;
            }

            Article::create([
                'name' => $this->name,
                'brand' => $this->brand,
                'serial' => $this->serial,
                'stock' => $this->serial ? 1 : $this->stock,
                'description' => $this->description,
                'location' => 'catastro',
                'origin' => $this->origin,
                'comment' => $this->comment,
                'category_id' => $this->category_id,
                'created_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo ha sido creado con exito."]);

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
                'stock' => $this->serial ? 1 : $this->stock,
                'description' => $this->description,
                'location' => 'catastro',
                'origin' => $this->origin,
                'comment' => $this->comment,
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
                                    ->where('location', 'catastro')
                                    ->where(function($q){
                                        return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('description', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('location', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('brand', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('serial', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('stock', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('origin', 'LIKE', '%' . $this->search . '%')
                                            ->orwhere('comment', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('category', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                                    })
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate(10);

        return view('livewire.articles-catastro', compact('categories', 'articles'));
    }
}
