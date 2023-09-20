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
    public function message(){
        return view('pages.message');
    }
    public function denz(){
        return view("denz.ugh.index");
    }
    public function driver(){
        return view("denz.ugh.driver_ui");
    }
    public function bus(){
        /* return view("pages.payment-bus"); */
    }
    public function sedan(){
        return view("pages.payment-sevan");
    }
    public function suv(){
        return view("pages.payment-suv");
    }
    public function van(){
        return view("pages.payment-van");
    }
}
