<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\SubmitEmail;
use Illuminate\Http\Request;

class ViewerEmailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'  => 'required|email|max:100',
            'source' => 'nullable|string|max:20',
        ]);

        SubmitEmail::create([
            'email' => $request->email,
            'source' => $request->source ?? 'unknown'
        ]);

        return back()->with('success', 'Your email has been sent successfully!');
    }
}
