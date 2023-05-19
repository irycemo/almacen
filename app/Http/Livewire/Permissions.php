<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Constantes;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentsTrait;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{

    use WithPagination;
    use ComponentsTrait;

    public $selected_id;
    public $name;
    public $area;

    protected function rules(){
        return[
            'name' => 'required',
            'area' => 'required'
        ];
    }

    protected $validationAttributes = [
        'name' => 'nombre',
        'area' => 'área'
    ];

    public function resetAll(){
        $this->reset('selected_id','name','area');
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function openModalEdit($permission){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;

        $this->selected_id = $permission['id'];
        $this->name = $permission['name'];
        $this->area = $permission['area'];

        $this->modal = true;
        $this->edit = true;
    }

    public function create(){

        $this->validate();

        try {

            Permission::create([
                'name' => $this->name,
                'area' => $this->area,
                'created_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El permiso ha sido creado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al crear permiso por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            $permission = Permission::findorFail($this->selected_id);

            $permission->update([
                'name' => $this->name,
                'area' => $this->area,
                'updated_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "El permiso ha sido actualizado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al actualizar permiso por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function delete(){

        try {

            $permission = Permission::findorFail($this->selected_id);

            $permission->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El permiso ha sido eliminado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar permiso por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);
            $this->closeModal();
        }
    }

    public function render()
    {

        $areas = collect(Constantes::AREAS)->sort();

        $permissions = Permission::with('createdBy', 'updatedBy')
                                    ->where('name', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('area', 'LIKE', '%' . $this->search . '%')
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate($this->pagination);

        return view('livewire.permissions', compact('permissions', 'areas'));
    }
}
