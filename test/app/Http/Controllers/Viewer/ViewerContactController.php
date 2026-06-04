<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\SubmitContact;
use Illuminate\Http\Request;

class ViewerContactController extends Controller
{
    public function index()
    {
        $about_us = AboutUs::first();
        return view('viewer.contact.index', compact('about_us'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'company' => 'nullable|string',
            'message' => 'required|string',
        ]);

        SubmitContact::create($request->all());

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
