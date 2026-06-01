<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Blog;
use App\Models\SubmitContact;
use App\Models\Service;
use App\Models\SubmitEmail;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index() : View {

        $emailStats = SubmitEmail::selectRaw("
                DATE(created_at) as date,
                COUNT(*) as total
            ")
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->pluck('total', 'date');

        $contactStats = SubmitContact::selectRaw("
                DATE(created_at) as date,
                COUNT(*) as total
            ")
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->pluck('total', 'date');


        $labels = [];
        $emailData = [];
        $contactData = [];

        $userCount = User::count();
        $blogCount = Blog::count();
        $submitCount = SubmitContact::count() + SubmitEmail::count();
        $serviceCount = Service::count();


        for ($i = 6; $i >= 0; $i--) {

            $date = now()->subDays($i);

            $key = $date->toDateString();

            $emailData[] = $emailStats[$key] ?? 0;

            $contactData[] = $contactStats[$key] ?? 0;
        }

        return view('admin.dashboard', compact('userCount','blogCount', 'submitCount', 'serviceCount', 'labels', 'emailData', 'contactData'));
    }
}
