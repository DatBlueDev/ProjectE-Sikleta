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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('test/auth', array('uses' => 'App\Http\Controllers\TestController@postAuth'));

Route::get('/admin', 'App\Http\Controllers\PagesController@admin'); 
Route::get('/verify_pwd', 'App\Http\Controllers\PagesController@pwd_verify'); 
Route::get('/verify_driver', 'App\Http\Controllers\PagesController@driver_verify'); 
Route::post('/verify-driver/{id}', 'App\Http\Controllers\VeridriverController@verifyDriver')->name('verify-driver');
Route::post('/verify-user/{id}', 'App\Http\Controllers\VeriuserController@verifyUser')->name('verify-user');

Route::controller(App\Http\Controllers\Auth\AdminLoginController::class)->group(function() {
    Route::get('/admindashboard', 'admindashboard')->name('admindashboard');
    Route::post('/adminlogin', 'admin_authenticate')->name('admin_authenticate');
});


Route::controller(App\Http\Controllers\Auth\LoginRegisterController::class)->group(function() {
    Route::get('/driver', 'driver')->name('driver');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});
