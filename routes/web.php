<?php

use App\Http\Controllers\PagesController;
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

Route::get('/', 'App\Http\Controllers\PagesController@index'); 
Route::get('/pwd', 'App\Http\Controllers\PagesController@pwd'); 

Route::get('/maptest', [PagesController::class, 'maptest']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('test/auth', array('uses' => 'App\Http\Controllers\TestController@postAuth'));

Route::controller(App\Http\Controllers\Auth\LoginRegisterController::class)->group(function() {
    Route::get('/driver', 'driver')->name('driver');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});
