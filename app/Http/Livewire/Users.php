<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{

    use WithPagination;

    public $modal = false;
    public $modalDelete = false;
    public $create = false;
    public $edit = false;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $user_id;
    public $name;
    public $email;
    public $status;
    public $role;

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
        $this->reset('user_id','name','email','status','role');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    protected function rules(){
        return[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $this->user_id,
            'status' => 'required|in:activo,inactivo',
            'role' => 'required|integer|in:2,3,4,5'
        ];
    }

    public function openModalCreate(){

        $this->resetAll();

        $this->edit = false;
        $this->create = true;
        $this->modal = true;
    }

    public function openModalEdit($user){

        $this->resetAll();

        $this->create = false;

        $this->user_id = $user['id'];
        $this->role = $user['roles'][0]['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->status = $user['status'];

        $this->edit = true;
        $this->modal = true;
    }

    public function openModalDelete($user){

        $this->modalDelete = true;
        $this->user_id = $user['id'];
    }

    public function closeModal(){
        $this->resetall();
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function create(){

        $this->validate();

        try {

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'password' => 'almacen',
                'created_by' => auth()->user()->id,
            ]);

            $user->roles()->attach($this->role);

            $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido creado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        try {

            $user = User::findorFail($this->user_id);

            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'updated_by' => auth()->user()->id,
            ]);

            $user->roles()->sync($this->role);

            $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido actualizado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }

    }

    public function delete(){

        try {

            $user = User::findorFail($this->user_id);

            $user->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido eliminado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function render()
    {

        $users = User::with('roles','createdBy','updatedBy')
                        ->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                        ->orWhere(function($q){
                            return $q->whereHas('roles', function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%');
                            });
                        })
                        ->when($this->sort != 'role', function($q){
                            $q->orderBy($this->sort, $this->direction);
                        })
                        ->paginate(10);

        $roles = Role::where('id', '!=', 1)->orderBy('name')->get();

        return view('livewire.users', compact('users', 'roles'));
    }
}
