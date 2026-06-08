<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;

class ViewerServiceController extends Controller
{
    public function index($slug)
    {
        $serviceCategory = ServiceCategory::where('slug', $slug)->firstOrFail();

        $services = Service::where('category_id', $serviceCategory->id)
            ->latest()
            ->paginate(6);

        return view('viewer.service.index', compact('serviceCategory', 'services'));
    }

    public function show($slug)
    {
        $service = Service::with('serviceCategory')
            ->where('slug', $slug)
            ->firstOrFail();

        // Related services (gợi ý)
        $relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->take(3)
            ->get();

        return view('viewer.service.show', compact('service', 'relatedServices'));
    }
}
