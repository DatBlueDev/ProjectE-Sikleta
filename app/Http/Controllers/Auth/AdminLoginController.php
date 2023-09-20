<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function admin_authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $guardName = 'acc_admin';
        if(Auth::guard($guardName)->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('admindashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    } 
    
    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function admindashboard()
    {
        $guardName = 'acc_admin';
        if(Auth::guard($guardName)->check())
        {
            return view('pages.admindashboard');
        }
        
        return redirect()->route('admin_authenticate')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 
    
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $guardName = "acc_admin";
        Auth::guard("$guardName")->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }    

}

