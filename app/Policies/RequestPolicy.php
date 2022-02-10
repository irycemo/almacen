<?php

namespace App\Policies;

use App\Models\Request;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Request $request)
    {

        if($user->roles[0]->id === 4){

            if($request->created_by == $user->id)

                if($request->status === 'rechazada' || $request->status === 'entregada')
                    return false;
                else
                    return true;

            else
                return false;
        }else{

            if($request->status === 'rechazada' || $request->status === 'entregada')
                return false;
            else
                return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Request $request)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Request $request)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Request $request)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Request $request)
    {
        //
    }
}
