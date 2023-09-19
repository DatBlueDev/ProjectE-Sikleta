<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\LoginController;

class TestController extends Controller
{
    protected $loginController;
    protected $LoginRegisterController;

    public function __construct(LoginController $loginController, LoginRegisterController $LoginRegisterController)
    {
        $this->loginController = $loginController;
        $this->LoginRegisterController = $LoginRegisterController;
    }

    public function postAuth(Request $request)
    {
        // Check which submit button was clicked on
        if ($request->has('userlogin')) {
            return $this->loginController->login($request); // If login, then use this method
        } elseif ($request->has('driverlogin')) {
            return $this->LoginRegisterController->authenticate($request); // If register, then use this method
        }
    }


}