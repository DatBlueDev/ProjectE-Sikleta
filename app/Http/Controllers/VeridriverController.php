<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Log;


class VeridriverController extends Controller
{
    public function verifyDriver(Request $request, $id){
        
        $driver = Driver::findorFail($id);
        $driver->update(['verified' => true]);
        return redirect()->back()->with('success', 'Driver verified successfully');
    }
}
