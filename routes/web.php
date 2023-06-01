<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CrudOperationsController;
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

Route::get('/', function () {
    return view('index');
});

Route::middleware(['guest'])->controller(LoginRegisterController::class)->group(function(){
    Route::get('/auth/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/auth/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
});
Route::middleware(['auth'])->controller(CrudOperationsController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::resource('/crud', CrudOperationsController::class);
    // Route::get('/create','create')->name('create');
    // Route::post('/add','store')->name('store_data');
    // Route::get('/show','show')->name('show_data');
    // Route::get('/edit','edit')->name('edit_data');
    // Route::put('/update','update')->name('update_data');
});

Route::get('/logout',[LoginRegisterController::class,'logout'])->name('logout');