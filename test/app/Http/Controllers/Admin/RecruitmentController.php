<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'required',
            'requirements' => 'required',
            'benefits' => 'required',
            'location' => 'required|string|max:255',
            'work_type' => 'required',
            'application_deadline' => 'nullable|date',
        ]);

        Recruitment::create([
            'position' => $request->position,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'location' => $request->location,
            'work_type' => $request->work_type,
            'application_deadline' => $request->application_deadline,
            'seo_title' => $request->seo_title ?? '',
            'seo_description' => $request->seo_description ?? '',
            'is_visible' => $request->has('is_visible'),
        ]);

        return redirect()
            ->route('admin.recruitments')
            ->with('success', 'Recruitment created successfully');
    }

    public function update(Request $request, Recruitment $recruitment) : RedirectResponse
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'required',
            'requirements' => 'required',
            'benefits' => 'required',
            'location' => 'required|string|max:255',
            'work_type' => 'required',
            'application_deadline' => 'nullable|date',
        ]);

        $recruitment->update([
            'position' => $request->position,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'location' => $request->location,
            'work_type' => $request->work_type,
            'application_deadline' => $request->application_deadline,
            'seo_title' => $request->seo_title ?? '',
            'seo_description' => $request->seo_description ?? '',
            'is_visible' => $request->has('is_visible'),
        ]);

        return redirect()->route('admin.recruitments')->with('success', 'Recruitment updated successfully');
    }

    public function destroy(Recruitment $recruitment) : RedirectResponse
    {
        $recruitment->delete();

        return redirect()->route('admin.recruitments')->with('success', 'Recruitment deleted successfully');
    }
}
