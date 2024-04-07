<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('admin.home');
//});

Auth::routes();

Route::get('/dashboard', function () {
    return view('admin.home');
})->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'roles', 'middleware' => ['auth']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
    Route::get('/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
    Route::get('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'show'])->name('roles.show');
    Route::get('/{role}/edit', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/store', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
    Route::put('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
    Route::DELETE('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'destroy']);
});

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::get('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::post('/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::put('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::DELETE('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy']);
});

Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
