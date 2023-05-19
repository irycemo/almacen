<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Http\Constantes;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentsTrait;

class Users extends Component
{

    use WithPagination;
    use ComponentsTrait;

    public $name;
    public $email;
    public $status;
    public $role;
    public $location;

    protected function rules(){
        return[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $this->selected_id,
            'status' => 'required|in:activo,inactivo',
            'role' => 'required|integer|min:2',
            'location' => 'required'
        ];
    }

    protected $messages = [
        'name.required' => 'El campo nombre es obligatorio.',
        'role.required' => 'El campo rol es obligatorio.',
        'location.required' => 'El campo ubicación es obligatorio.',
    ];

    public function resetAll(){
        $this->reset('selected_id','name','email','status','role');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModalEdit($user){

        $this->resetAll();

        $this->create = false;

        $this->selected_id = $user['id'];
        $this->role = $user['roles'][0]['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->status = $user['status'];
        $this->location = $user['location'];

        $this->edit = true;
        $this->modal = true;
    }

    public function create(){

        $this->validate();

        try {

            DB::transaction(function () {

                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'status' => $this->status,
                    'location' => $this->location,
                    'password' => 'sistema',
                    'created_by' => auth()->user()->id,
                ]);

                $user->roles()->attach($this->role);

                $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido creado con éxito."]);

                $this->closeModal();

            });

        } catch (\Throwable $th) {

            Log::error("Error al crear usuario por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            DB::transaction(function () {


                $user = User::findorFail($this->selected_id);

                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'status' => $this->status,
                    'location' => $this->location,
                    'updated_by' => auth()->user()->id,
                ]);

                $user->roles()->sync($this->role);

                $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido actualizado con éxito."]);

                $this->closeModal();

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar usuario por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }

    }

    public function delete(){

        try {

            $user = User::findorFail($this->selected_id);

            $user->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido eliminado con éxito."]);

            $this->closeModal();

        } catch (\Throwable $th) {

            Log::error("Error al borrar usuario por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo."]);
            $this->closeModal();
        }
    }

    public function render()
    {

        $ubicaciones = collect(Constantes::UBICACIONES)->sort();

        $users = User::with('roles','createdBy','updatedBy')
                        ->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('location', 'LIKE', '%' . $this->search . '%')
                        ->orWhere(function($q){
                            return $q->whereHas('roles', function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%');
                            });
                        })
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);

        $roles = Role::where('id', '!=', 1)->orderBy('name')->get();

        return view('livewire.users', compact('users', 'roles', 'ubicaciones'));
    }
}
