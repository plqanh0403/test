<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ServiceCategory::get();

        $query = Service::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('slug', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('is_visible')) {
            $query->where('is_visible', $request->is_visible);
        }

        $services = $query
            ->with('serviceCategory')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.service.index', compact('services', 'categories')
        );
    }

    public function store(Request $request) : RedirectResponse
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:service_categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail_alt' => 'nullable|string|max:255',
            'overview' => 'required|string',
            'details' => 'required|string',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_visible' => 'nullable|boolean',
        ]);

        Service::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'thumbnail' => $request->thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt ?? $request->name,
            'overview' => $request->overview,
            'details' => $request->details,
            'slug' => Str::slug($request->name),
            'seo_title' => $request->seo_title ?? '',
            'seo_description' => $request->seo_description ?? '',
            'seo_keywords' => $request->seo_keywords ?? '',
            'sort_order' => $request->sort_order,
            'is_visible' => $request->is_visible
        ]);

        return redirect()->route('admin.services')->with('success', 'Service created successfully');
    }

    public function update(Request $request, Service $service) : RedirectResponse
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:service_categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail_alt' => 'nullable|string|max:255',
            'overview' => 'required|string',
            'details' => 'required|string',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_visible' => 'nullable|boolean',
        ]);

        // $data = [];

        // if ($request->hasFile('thumbnail')) {

        //     if ($service->thumbnail &&
        //         file_exists(public_path($service->thumbnail))) {

        //         unlink(public_path($service->thumbnail));
        //     }

        //     $file = $request->file('thumbnail');

        //     $filename = time().'_'.$file->getClientOriginalName();

        //     $file->move(public_path('uploads/services'), $filename);

        //     $data['thumbnail'] = 'uploads/services/'.$filename;
        // }

        $service->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'thumbnail' => $request->thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt ?? $request->name,
            'overview' => $request->overview,
            'details' => $request->details,
            'slug' => Str::slug($request->name),
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
            'sort_order' => $request->sort_order ?? '0',
            'is_visible' => $request->is_visible,
        ]);

        return redirect()->route('admin.services')->with('success', 'Service updated successfully');
    }

    public function show(Service $service) : RedirectResponse
    {
        $service->update([
            'is_visible' => true
        ]);

        return back()->with('success', 'Service shown successfully.');
    }

    public function hide(Service $service) : RedirectResponse
    {
        $service->update([
            'is_visible' => false
        ]);

        return back()->with('success', 'Service hide successfully.');
    }

    public function destroy(Service $service) : RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Service deleted successfully');
    }
}
