<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\TransaksiController;

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

Route::controller(UserController::class)->group(function (){
    Route::get('/user', 'index')->name('user.index');
    Route::post('/user', 'store')->name('user.store');
    Route::get('/user/{id}', 'edit');
    Route::post('/user/update/{id}', 'update');
    Route::get('/user/delete/{id}', 'destroy')->name('user.destroy');
});

Route::controller(KatalogController::class)->group(function (){
    Route::get('/katalog', 'index')->name('user.index');
});

Route::controller(TransaksiController::class)->group(function (){
    Route::get('/transaksi', 'index')->name('user.index');
});
