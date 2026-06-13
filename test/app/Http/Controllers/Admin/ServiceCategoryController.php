<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index(Request $request) : View
    {
        $search =  $request->search;

        $categories = ServiceCategory::when($search, function($query) use ($search) {
            $query->where("name","like","%{$search}%");
        })
        ->latest()
        ->paginate(10);

        return view('admin.service_category.index', compact('categories'));
    }

    public function store(Request $request) : RedirectResponse
    {
        request()->validate([
            'name' => 'required|string|max:255|unique:categories,name', //unique:ten_bang,ten_cot
            'description' => 'required|string|max:255',
        ]);

        ServiceCategory::create([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name), // chuyển chuỗi thành slug
            'description' => $request->description,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'is_visible' => $request->is_visible,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');;
    }

    public function update(Request $request, ServiceCategory $category) : RedirectResponse
    {
        request()->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'required|string|max:255',
        ]);

        $category->update([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name), // chuyển chuỗi thành slug
            'description' => $request->description,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'is_visible' => $request->is_visible,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $category) : RedirectResponse
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
