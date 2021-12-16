<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasswordRequest;

class SetPasswordController extends Controller
{
    public function create(Request $request){

        $email = $request->email;

        return view('auth.setpassword', compact('email'));
    }

    public function store(StorePasswordRequest $request){

        $user = User::where('email', $request->email)->first();

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
