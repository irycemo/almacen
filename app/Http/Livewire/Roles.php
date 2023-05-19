<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentsTrait;
use Spatie\Permission\Models\Permission;

class Roles extends Component
{
    use WithPagination;
    use ComponentsTrait;

    public $selected_id;
    public $name;
    public $permissionsList = [];

    protected function rules(){
        return[
            'name' => 'required'
        ];
    }

    protected $messages = [
        'name.required' => 'El campo nombre es obligatorio.',
    ];

    public function resetAll(){
        $this->reset('name','permissionsList');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalEdit($role){

        $this->resetAll();

        $this->create = false;

        $this->selected_id = $role['id'];
        $this->name = $role['name'];

        foreach($role['permissions'] as $permission){
            array_push($this->permissionsList, (string)$permission['id']);
        }

        $this->edit = true;
        $this->modal = true;

    }

    public function create(){

        $this->validate();

        try {

            $role = Role::create([
                'name' => $this->name,
                'created_by' => auth()->user()->id,
            ]);

            $role->permissions()->sync($this->permissionsList);

            $this->dispatchBrowserEvent('showMessage',['success', "El rol ha sido creado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar rol por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function update(){



        $this->validate();

        try {

            $role = Role::findorFail($this->selected_id);

            $role->update([
                'name' => $this->name,
                'updated_by' => auth()->user()->id,
            ]);

            $role->permissions()->sync($this->permissionsList);



            $this->dispatchBrowserEvent('showMessage',['success', "El rol ha sido actualizado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al actualizar rol por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }

    }

    public function delete(){

        try {

            $role = Role::findorFail($this->selected_id);

            $role->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El rol ha sido eliminado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar rol por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function render()
    {

        $roles = Role::with('createdBy','updatedBy','permissions')
                        ->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);

        $permissions = Permission::orderBy('area','desc')->get()->groupBy(function($permission) {
                                                                        return $permission->area;
                                                                    })->all();

        return view('livewire.roles', compact('roles', 'permissions'));
    }
}
