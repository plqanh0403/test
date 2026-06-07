<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmitEmail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubmitEmailController extends Controller
{
    public function index(Request $request): View
    {
        $query = SubmitEmail::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->search . '%')
                    ->orWhere('source', 'like', '%' . $request->search . '%');
            });
        }

        // Lọc từ ngày
        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        // Lọc đến ngày
        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $submitEmails = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.submit_email.index', compact('submitEmails'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'email' => 'required|email|max:255|unique:submit_emails,email',
            'source' => 'nullable|string|max:255',
            'status'=> 'nullable|in:pending,processing,processed',
        ]);

        SubmitEmail::create([
            'email'  => $request->email,
            'source' => $request->source,
            'status' => $request->status
        ]);

        return back()->with('success', 'Email subscriber created successfully.');
    }

    public function destroy(SubmitEmail $submitEmail) : RedirectResponse
    {
        $submitEmail->delete();

        return redirect()->route('admin.submit_emails')->with('success', 'Email submission deleted successfully.');
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = 'emails.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Email',
                'Source',
                'Status',
                'Created At',
            ]);

            foreach (SubmitEmail::latest()->get() as $submitEmail) {
                fputcsv($file, [
                    $submitEmail->id,
                    $submitEmail->email,
                    $submitEmail->source,
                    $submitEmail->status,
                    $submitEmail->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
