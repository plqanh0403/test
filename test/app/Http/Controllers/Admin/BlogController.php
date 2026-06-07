<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request) : View
    {
        $servicesCount = Blog::where('type', 'tech-service')->count();
        $activitiesCount = Blog::where('type', 'EGEAD-activity')->count();

        $query = Blog::query();

        // Default tab Technical Service
        $type = $request->type ?? 'tech-service';

        $query = Blog::where('type', $type);

        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $blogs = $query->with(['category', 'user'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('sort_order')->get();

        return view('admin.blog.index', compact('blogs', 'categories', 'servicesCount', 'activitiesCount', 'type'));
    }

    public function store(Request $request): RedirectResponse
    {
        $categories = Category::all();
        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail')->store('blogs', 'public');
        }

        Blog::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'thumbnail' => $thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt,
            'seo_title' => $request->seo_title ?? $request->title,
            'seo_description' => $request->seo_description ?? $request->excerpt,
            'status' => $request->has('status'),
            'is_visible' => $request->has('is_visible'),
            'sort_order' => $request->sort_order ?? 0,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return back()->with('success', 'Blog created successfully.');
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $thumbnail = $blog->thumbnail;

        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($thumbnail);

            $thumbnail = $request->file('thumbnail')->store('blogs', 'public');
        }

        $blog->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'thumbnail' => $thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt,
            'seo_title' => $request->seo_title ?? $request->title,
            'seo_description' => $request->seo_description ?? $request->excerpt,
            'status' => $request->status,
            'is_visible' => $request->has('is_visible'),
            'sort_order' => $request->sort_order ?? 0,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return back()->with('success', 'Blog updated successfully.');
    }

    public function show(Blog $blog) : RedirectResponse
    {
        $blog->update([
            'is_visible' => true
        ]);

        return back()->with('success', 'Blog shown successfully.');
    }

    public function hide(Blog $blog) : RedirectResponse
    {
        $blog->update([
            'is_visible' => false
        ]);

        return back()->with('success', 'Blog hide successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return back()->with('success', 'Blog deleted successfully.');
    }
}
