<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmitContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;


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
            ->paginate(10);

        return view('admin.submit_contact.index', compact('submitContacts'));
    }

    public function updateSeenStatus(SubmitContact $submitContact) : RedirectResponse
    {
        $submitContact->update(['status' => 'seen']); 

        return redirect()->back()->with('success', 'Seen status updated successfully.');
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

            foreach (SubmitContact::latest()->get() as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->company,
                    $contact->status,
                    $contact->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
