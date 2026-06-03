<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use Illuminate\Http\Request;

class ViewerRecruitmentController extends Controller
{
    // LIST PAGE
    public function index()
    {
        $recruitments = Recruitment::where('is_visible', true)
            ->where('status', 'open')
            ->latest()
            ->get();

        return view('viewer.recruitment.index', compact('recruitments'));
    }

    // DETAIL PAGE
    public function show($id)
    {
        $recruitment = Recruitment::where('id', $id)
            ->where('is_visible', true)
            ->firstOrFail();

        // gợi ý job khác
        $relatedJobs = Recruitment::where('id', '!=', $id)
            ->where('status', 'open')
            ->take(3)
            ->get();

        return view('viewer.recruitment.show', compact('recruitment', 'relatedJobs'));
    }
}
