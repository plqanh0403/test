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
        $recruitmentCount = Recruitment::where('is_visible', true)
            ->where('status', 'open')
            ->count();

        $recruitments = Recruitment::where('is_visible', true)
            ->where('status', 'open')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('viewer.recruitment.index', compact('recruitments', 'recruitmentCount'));
    }

    // DETAIL PAGE
    public function show($slug)
    {
        $recruitment = Recruitment::where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        // gợi ý job khác
        $relatedJobs = Recruitment::where('slug', '!=', $slug)
            ->where('status', 'open')
            ->take(3)
            ->get();

        return view('viewer.recruitment.show', compact('recruitment', 'relatedJobs'));
    }
}
