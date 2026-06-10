<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Services\MediaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index() :View
    {
        $about_us = AboutUs::first();

        return view('admin.about_us.index', compact('about_us'));
    }

    public function store(Request $request, MediaService $mediaService) : RedirectResponse
    {
        if (AboutUs::exists()) {
            return back()->with('error', 'Company profile already exists.');
        }

        request()->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'thumbnail_alt' => 'nullable|string|max:255',
            'light_logo' => 'nullable|image|mimes:png,svg,jpg,webp|max:2048',
            'dark_logo' => 'nullable|image|mimes:png,svg,jpg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'slogan' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'footer_text' => 'nullable|string|max:500',
            'hr_email' => 'nullable|email|max:255',
            'hr_phone' => 'nullable|string|max:20',
            'google_map' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:255',
            'google_site_verification' => 'nullable|string|max:255',
            'google_analytics' => 'nullable|string',
            'meta_pixel' => 'nullable|string',
        ]);

        $thumbnail = $mediaService->uploadImg($request->file('thumbnail'), 'about_us');
        $light_logo = $mediaService->uploadImg($request->file('light_logo'), 'about_us');
        $dark_logo = $mediaService->uploadImg($request->file('dark_logo'), 'about_us');
        $favicon = $mediaService->uploadImg($request->file('favicon'), 'about_us');

        AboutUs::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'thumbnail' => $thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt ?? $request->title,
            'light_logo' => $light_logo,
            'dark_logo' => $dark_logo,
            'favicon' => $favicon,
            'slogan' => $request->slogan,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
            'tiktok' => $request->tiktok,
            'instagram' => $request->instagram,
            'description' => $request->description,
            'footer_text' => $request->footer_text,
            'hr_email' => $request->hr_email,
            'hr_phone' => $request->hr_phone,
            'google_map' => $request->google_map,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
            'og_image' => $request->og_image,
            'og_title' => $request->og_title,
            'og_description' => $request->og_description,
            'canonical_url' => $request->canonical_url,
            'google_site_verification' => $request->google_site_verification,
            'google_analytics' => $request->google_analytics,
            'meta_pixel' => $request->meta_pixel,
        ]);

        return back()->with('success','Add information successfully');
    }

    public function update(Request $request, AboutUs $about_us, MediaService $mediaService) : RedirectResponse
    {
        if (! AboutUs::exists()) {
            return back()->with('error', 'Company profile have not existed.');
        }

        request()->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'thumbnail_alt' => 'nullable|string|max:255',
            'light_logo' => 'nullable|image|mimes:png,svg,jpg,webp|max:2048',
            'dark_logo' => 'nullable|image|mimes:png,svg,jpg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'slogan' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'footer_text' => 'nullable|string|max:500',
            'hr_email' => 'nullable|email|max:255',
            'hr_phone' => 'nullable|string|max:20',
            'google_map' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:255',
            'google_site_verification' => 'nullable|string|max:255',
            'google_analytics' => 'nullable|string',
            'meta_pixel' => 'nullable|string',
        ]);

        $data = [];

        if ($request->hasFile('thumbnail')) {

            if ($about_us->thumbnail) {
                Storage::disk('public')->delete($about_us->thumbnail);
            }

            $data['thumbnail'] = $mediaService->uploadImg($request->file('thumbnail'), 'about_us');
        }

        if ($request->hasFile('light_logo')) {

            if ($about_us->light_logo) {
                Storage::disk('public')->delete($about_us->light_logo);
            }

            $data['light_logo'] = $mediaService->uploadImg($request->file('light_logo'), 'about_us');
        }

        if ($request->hasFile('dark_logo')) {

            if ($about_us->dark_logo) {
                Storage::disk('public')->delete($about_us->dark_logo);
            }

            $data['dark_logo'] = $mediaService->uploadImg($request->file('dark_logo'), 'about_us');
        }

        if ($request->hasFile('favicon')) {

            if ($about_us->favicon) {
                Storage::disk('public')->delete($about_us->favicon);
            }

            $data['favicon'] = $mediaService->uploadImg($request->file('favicon'), 'about_us');
        }

        $about_us->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'thumbnail' => $data['thumbnail'] ?? $request->thumbnail,
            'thumbnail_alt' => $request->thumbnail_alt ?? $request->title,
            'light_logo' =>$data['light_logo'] ?? $request->light_logo,
            'dark_logo' => $data['dark_logo'] ?? $request->dark_logo,
            'favicon' => $data['favicon'] ?? $request->favicon,
            'slogan' => $request->slogan,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
            'tiktok' => $request->tiktok,
            'instagram' => $request->instagram,
            'description' => $request->description,
            'footer_text' => $request->footer_text,
            'hr_email' => $request->hr_email,
            'hr_phone' => $request->hr_phone,
            'google_map' => $request->google_map,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
            'og_image' => $request->og_image,
            'og_title' => $request->og_title,
            'og_description' => $request->og_description,
            'canonical_url' => $request->canonical_url,
            'google_site_verification' => $request->google_site_verification,
            'google_analytics' => $request->google_analytics,
            'meta_pixel' => $request->meta_pixel,
        ]);

        return back()->with('success','Add information successfully');
    }

    public function destroy(AboutUs $aboutUs) : RedirectResponse
    {
        $aboutUs->delete();

        return back()->with('success','Delete information succesfully');
    }
}
