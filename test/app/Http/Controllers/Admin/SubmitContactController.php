<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmitContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\JsonResponse;


class SubmitContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = SubmitContact::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('company', 'like', '%' . $request->search . '%')
                ->orWhere('message', 'like', '%' . $request->search . '%')
                ->orWhere('internal_note', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $submitContacts = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.submit_contact.index', compact('submitContacts'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255'],
            'phone'         => ['nullable', 'string', 'max:255'],
            'company'       => ['nullable', 'string', 'max:255'],
            'message'       => ['required', 'string'],
            'status'        => ['nullable', 'in:new,seen,processing,processed'],
            'internal_note' => ['nullable', 'string'],
        ]);

        SubmitContact::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Contact submission created successfully.');
    }

    public function updateSeenStatus(SubmitContact $submitContact): JsonResponse
    {
        try {
            $submitContact->update([
                'status' => 'seen'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Seen status updated successfully.',
                'data' => $submitContact
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to update seen status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateProcessingStatus(SubmitContact $submitContact)
    {
        $submitContact->update(['status' => 'processing',]); 

        return response()->json([
            'success' => true,
            'message' => 'Seen status updated successfully.'
        ]);
    }

    public function updateProcessedStatus(SubmitContact $submitContact) : RedirectResponse
    {
        $submitContact->update(['status' => 'processed']);

        return redirect()->back()->with('success', 'Processed status updated successfully.');
    }

    public function updateNote(Request $request, SubmitContact $submitContact) : RedirectResponse
    {
        $request->validate(['internal_note' => 'nullable|string']);

        $submitContact->update(['internal_note' => $request->internal_note]);

        return redirect()->back()->with('success', 'Internal note updated successfully.');
    }

    public function destroy(SubmitContact $submitContact) : RedirectResponse
    {
        $submitContact->delete();

        return redirect()->route('admin.submit_contacts')->with('success', 'Contact submission deleted successfully.');
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = 'contacts.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Phone',
                'Company',
                'Status',
                'Created At',
            ]);

            foreach (SubmitContact::latest()->get() as $submitContact) {
                fputcsv($file, [
                    $submitContact->id,
                    $submitContact->name,
                    $submitContact->email,
                    $submitContact->phone,
                    $submitContact->company,
                    $submitContact->status,
                    $submitContact->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
