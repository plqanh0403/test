<?php

namespace App\Http\Controllers\viewer;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class ViewerAboutUsController extends Controller
{
    public function index()
    {
        $about_us = AboutUs::first();

        return view('viewer.about_us.index', compact('about_us'));
    }
}
