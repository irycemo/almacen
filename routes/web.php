<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

Route::group(['middleware' => ['auth','is.active']], function(){

    Route::resource('users', UserController::class)->only(['index'])->middleware('can:Lista de usuarios')->names('users');

    Route::resource('roles', RoleController::class)->only(['index'])->middleware('can:Lista de roles')->names('roles');

    Route::resource('permissions', PermissionController::class)->only(['index'])->middleware('can:Lista de permisos')->names('permissions');

});
