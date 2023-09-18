<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }
    public function pwd(){
        return view('auth.pwd');
    }
    public function admin(){
        return view('auth.admin');
    }
    public function pwd_verify(){
        $users_verifying = User::whereNotNull('user_id_verification_image')
        ->where('PWD', '0')
        ->get();
        return view('pages.pwd_verification', ['users' => $users_verifying]);
    }
    public function driver_verify(){
        $drivers_verifying= Driver::where('verified', '0')->get();
        return view('pages.driver_verification', ['drivers' => $drivers_verifying] );
    }
}
