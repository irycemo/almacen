<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\TrackingController;

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

    Route::resource('categories', CategoryController::class)->only(['index'])->middleware('can:Lista de categorías')->names('categories');

    Route::resource('articles', ArticleController::class)->only(['index'])->middleware('can:Lista de artículos')->names('articles');
    Route::get('articles/catastro', [ArticleController::class, 'catastro'])->middleware('can:Lista de artículos de catastro')->name('articles.catastro');
    Route::get('articles/rpp', [ArticleController::class, 'rpp'])->middleware('can:Lista de artículos de rpp')->name('articles.rpp');

    Route::resource('requests', RequestController::class)->only(['index','edit','create'])->middleware('can:Lista de solicitudes')->names('requests');

    Route::get('tracking', TrackingController::class)->middleware('can:Seguimiento')->name('tracking');

});
