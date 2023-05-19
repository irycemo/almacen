<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentsTrait;

class Articles extends Component
{
    use WithPagination;
    use ComponentsTrait;

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

    public function resetAll(){
        $this->reset('selected_id','name', 'description','category_id','location', 'brand', 'serial');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalEdit($article){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->selected_id = $article['id'];
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

    public function create(){

        $this->validate();

        if(Article::where('name', $this->name)->where('location', 'general')->first()){
            $this->dispatchBrowserEvent('showMessage',['error', "El artículo ya se encuentra en el almacen general"]);
            return;
        }

        try {

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

            Log::error("Error al crear artículo por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            $article = Article::findorFail($this->selected_id);

            $article->update([
                'name' => $this->name,
                'brand' => $this->brand,
                'serial' => $this->serial,
                'description' => $this->description,
                'location' => $this->location,
                'category_id' => $this->category_id,
                'updated_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo sido actualizado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al actualizar artículo por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function delete(){

        try {

            $article = Article::findorFail($this->selected_id);

            $article->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El artículo ha sido eliminado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar artículo por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error. Asegurese de que el artículo no esta realcionado con una entrada o solicitud"]);
            $this->closeModal();
        }
    }

    public function render()
    {

        $categories = Category::orderBy('name')->get();

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
