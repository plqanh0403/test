<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);
        // Validate and store the new category
        // For now, just redirect back to the categories index
        return redirect()->route('admin.categories');
    }

    public function destroy(Category $category)
    {
        // Find and delete the category by ID
        // For now, just redirect back to the categories index
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'User deleted successfully');
    }
}
