<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');


Route::get('/ciao', function(){
    return view('ciao');
}) ;


// DA ABILITARE PER VISUALIZZARE LO SHOW
Route::resource(
    'contents',
    App\Http\Controllers\ContentShowController::class
    );


Route::resource(
    'categories',
    App\Http\Controllers\CategoryController::class
    );