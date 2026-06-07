<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index() :View
    {
        $about_us = AboutUs::first();

        return view('admin.about_us.index', compact('about_us'));
    }

    public function store(Request $request) : RedirectResponse
    {
        AboutUs::create($request->all());
        return back()->with('success','Add information successfully');
    }

    public function update(Request $request, AboutUs $aboutUs) : RedirectResponse
    {
        $aboutUs->update($request->all());
        return back()->with('success','Update information succesfully');
    }
}
