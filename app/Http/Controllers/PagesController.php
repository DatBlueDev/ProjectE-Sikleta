<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }
    public function pwd(){
        return view('auth.pwd');
    }
    public function maptest(){
        return view("pages.maptest");
    }
}
