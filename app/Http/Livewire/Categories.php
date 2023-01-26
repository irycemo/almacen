<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentsTrait;

class Categories extends Component
{
    use WithPagination;
    use ComponentsTrait;

    public $name;
    public $area;

    protected function rules(){
        return[
            'name' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'El campo nombre es obligatorio.',
    ];

    public function resetAll(){
        $this->reset('selected_id','name');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalEdit($category){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->selected_id = $category['id'];
        $this->name = $category['name'];

        $this->modal = true;
        $this->edit = true;
    }

    public function create(){

        $this->validate();

        try {

            Category::create([
                'name' => $this->name,
                'created_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La categoría ha sido creada con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al crear categoría por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            $category = Category::findorFail($this->selected_id);

            $category->update([
                'name' => $this->name,
                'updated_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La categoría sido actualizada con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al actualizar categoría por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function delete(){

        try {

            $category = Category::findorFail($this->selected_id);

            $category->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "La categoría ha sido eliminada con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar categoría por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function render()
    {
        $categories = Category::with('createdBy', 'updatedBy')
                                    ->where('name', 'LIKE', '%' . $this->search . '%')
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate($this->pagination);

        return view('livewire.categories', compact('categories'));
    }
}
