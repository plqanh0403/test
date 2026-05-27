<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    //
    public function show() : View {
        $text = "Hello World!";
        
        return view('dashboard', ['text' => $text]);
    }
}
