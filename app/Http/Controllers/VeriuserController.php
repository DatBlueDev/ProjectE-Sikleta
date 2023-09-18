<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class VeriuserController extends Controller
{
    public function verifyUser(Request $request, $id){
            
        $user = User::findorFail($id);
        $user->update(['PWD' => true]);
        return redirect()->back()->with('success', 'Driver verified successfully');
    }
}
