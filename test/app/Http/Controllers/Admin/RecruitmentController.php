<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class RecruitmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Recruitment::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->where('position', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->work_type) {
            $query->where('work_type', $request->work_type);
        }

        $recruitments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.recruitment.index', compact('recruitments')
        );
    }

    public function store(Request $request) : RedirectResponse
    {
        request()->validate([
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'benefits' => 'required|string',
            'location' => 'required|string|max:255',
            'work_type' => 'required|in:full-time,part-time,remote,hybrid',
            'work_time' => 'required|string|max:255',
            'application_deadline' => 'nullable|date',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail_alt' => 'nullable|string|max:255',
        ]);

        Recruitment::create([
            'position' => $request->position,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'location' => $request->location,
            'work_type' => $request->work_type,
            'work_time' => $request->work_time,
            'application_deadline' => $request->application_deadline,
            'slug' => Str::slug($request->position),
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'is_visible' => $request->is_visible,
            'thumbnail' => $request->thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt ?? $request->position,
        ]);

        return redirect()
            ->route('admin.recruitments')
            ->with('success', 'Recruitment created successfully');
    }

    public function update(Request $request, Recruitment $recruitment) : RedirectResponse
    {
        request()->validate([
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'benefits' => 'required|string',
            'work_time' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'work_type' => 'required|in:full-time,part-time,remote,hybrid',
            'application_deadline' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail_alt' => 'nullable|string|max:255',
        ]);

        $recruitment->update([
            'position' => $request->position,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'location' => $request->location,
            'work_type' => $request->work_type,
            'application_deadline' => $request->application_deadline,
            'slug' => Str::slug($request->position),
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'is_visible' => $request->is_visible,
            'thumbnail' => $request->thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt ?? $request->position,
            'work_time' => $request->work_time,
        ]);

        return redirect()->route('admin.recruitments')->with('success', 'Recruitment updated successfully');
    }

    public function destroy(Recruitment $recruitment) : RedirectResponse
    {
        $recruitment->delete();

        return redirect()->route('admin.recruitments')->with('success', 'Recruitment deleted successfully');
    }
}
