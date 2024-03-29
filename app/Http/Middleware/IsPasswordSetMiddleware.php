<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsPasswordSetMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->password == 'almacen' && !$request->is('setpassword') && !$request->password){
            return redirect()->route('setpassword')->with('message', 'Ingresa tu nueva contraseña.');
        }

        return $next($request);
    }
}
