<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntrieController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\DashboardController;
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

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

Route::get('manual', ManualController::class)->name('manual');

Route::group(['middleware' => ['auth','is.active']], function(){

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('users', UserController::class)->only(['index'])->middleware('can:Lista de usuarios')->names('users');

    Route::resource('roles', RoleController::class)->only(['index'])->middleware('can:Lista de roles')->names('roles');

    Route::resource('permissions', PermissionController::class)->only(['index'])->middleware('can:Lista de permisos')->names('permissions');

    Route::resource('categories', CategoryController::class)->only(['index'])->middleware('can:Lista de categorías')->names('categories');

    Route::resource('articles', ArticleController::class)->only(['index'])->middleware('can:Lista de artículos')->names('articles');
    Route::get('articles/catastro', [ArticleController::class, 'catastro'])->middleware('can:Lista de artículos de catastro')->name('articles.catastro');
    Route::get('articles/rpp', [ArticleController::class, 'rpp'])->middleware('can:Lista de artículos de rpp')->name('articles.rpp');

    Route::resource('requests', RequestController::class)->only(['index','edit','create'])->middleware('can:Lista de solicitudes')->names('requests');
    Route::get('requests/receipt/{request}', [RequestController::class, 'receipt'])->name('requests.receipt');

    Route::get('tracking', TrackingController::class)->middleware('can:Seguimiento')->name('tracking');

    Route::get('entries', EntrieController::class)->middleware('can:Seguimiento')->name('entries');

    Route::get('reports', ReportController::class)->middleware('can:Reportes')->name('reports');

});
