<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\message;
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
Route::get('/denz', 'App\Http\Controllers\PagesController@denz'); 
Route::get('/driver_ui', 'App\Http\Controllers\PagesController@driver'); 
Route::get('/bus', 'App\Http\Controllers\PagesController@bus');
Route::get('/sedan', 'App\Http\Controllers\PagesController@sedan');
Route::get('/suv', 'App\Http\Controllers\PagesController@suv');
Route::get('/van', 'App\Http\Controllers\PagesController@van');

Route::get('/maptest', [PagesController::class, 'maptest']);
Route::get('/booking', [BookController::class, 'index']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('test/auth', array('uses' => 'App\Http\Controllers\TestController@postAuth'));
Route::get('/admin', 'App\Http\Controllers\PagesController@admin'); 
Route::get('/verify_pwd', 'App\Http\Controllers\PagesController@pwd_verify'); 
Route::get('/verify_driver', 'App\Http\Controllers\PagesController@driver_verify'); 
Route::post('/verify-driver/{id}', 'App\Http\Controllers\VeridriverController@verifyDriver')->name('verify-driver');
Route::post('/verify-user/{id}', 'App\Http\Controllers\VeriuserController@verifyUser')->name('verify-user');
Route::get('/messages', 'App\Http\Controllers\PagesController@message');
Route::post('/send-message', function(Request $request){
    event(new message($request->input('username1'), $request->input('username2'), $request->input('message')));
    return ["success" => true];
});

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
