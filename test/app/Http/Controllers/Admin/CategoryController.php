<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search =  $request->search;

        $categories = Category::when($search, function($query) use ($search) {
            $query->where("name","like","%{$search}%");
        }) 
        -> latest()
        ->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
                                                //unique:ten_bang,ten_cot
        ]);

        Category::create([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name),
        ]);
        
        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');;
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => ['required','string','max:255',Rule::unique('categories', 'name')->ignore($category->id),
    ],
]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'User deleted successfully');
    }
}
