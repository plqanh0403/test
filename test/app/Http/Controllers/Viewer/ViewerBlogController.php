<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ViewerBlogController extends Controller
{
    public function index(Request $request)
    {
        $servicesCount = Cache::remember(
            'services_count',
            now()->addHours(1),
            fn() => Blog::where('type', 'tech-service')
                        ->where('status', 'published')
                        ->where('is_visible', true)
                        ->count()
        );

        $activitiesCount = Cache::remember(
            'activities_count',
            now()->addHours(1),
            fn() => Blog::where('type', 'EGEAD-activity')
                        ->where('status', 'published')
                        ->where('is_visible', true)
                        ->count()
        );

        $type = $request->type ?? 'tech-service';

        $featuredBlogs = Cache::remember(
            "featured_blogs_{$type}",
            now()->addDays(7),
            function () use ($type) {
                return Blog::with('user', 'category')
                    ->where('status', 'published')
                    ->where('is_visible', 1)
                    ->where('type', $type)
                    ->orderByDesc('published_at')
                    ->orderBy('sort_order')
                    ->take(4)
                    ->get();
            }
        );

        $normalBlogs = Blog::with('user', 'category')
            ->where('status', 'published')
            ->where('is_visible', 1)
            ->where('type', $type)
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->skip(4)
            ->paginate(6);

        return view('viewer.blog.index', compact('servicesCount', 'activitiesCount', 'type', 'normalBlogs', 'featuredBlogs'));
    }

    public function show(String $slug)
    {
        $blog = Cache::remember(
            "blog_{$slug}",
            now()->addHours(1),
            function () use ($slug) {

                return Blog::with('user', 'category')
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->where('is_visible', '1')
                    ->firstOrFail();
            }
        );

        $relatedBlogs = Cache::remember(
            "related_blogs_{$blog->id}",
            now()->addHours(1),
            function () use ($blog) {

                return Blog::with('user', 'category')
                    ->where('id', '!=', $blog->id)
                    ->where('type', $blog->type)
                    ->where('status', 'published')
                    ->where('is_visible', '1')
                    ->orderBy('sort_order')
                    ->take(3)
                    ->get();
            }
        );

        return view('viewer.blog.show', compact('blog', 'relatedBlogs'));
    }
}
