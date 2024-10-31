<?php

namespace App\Http\Controllers;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BureauController extends Controller
{
    // Display Bureau d’Ordre Dashboard with pending documents, agenda, and notifications
    public function home()
    {
        $userId = Auth::id();

        // Fetch all documents that are pending for display on the dashboard
        $pendingDocuments = Document::where('status', Document::STATUS_PENDING)->get();

        // Count of new (unread) documents to show as notifications
        $newDocCount = Document::where('receiver_id', $userId)
                                ->where('status', 'unread') // Ensure status is 'unread' for new docs
                                ->count();

        return view('bureau.home', compact('pendingDocuments', 'newDocCount'));
    }

    // Display received documents for Bureau d'Ordre with unread notifications
    public function received()
    {
        $userId = Auth::id();

        // Retrieve only unread documents assigned to Bureau d'Ordre
        $documents = Document::where('receiver_id', $userId)
                             ->where('status', Document::STATUS_PENDING)
                             ->get();

        // Count unread documents for notification
        $unreadCount = $documents->count();

        return view('bureau.received', compact('documents', 'unreadCount'));
    }

    // Forward document to the Director General after download
    public function forwardDocument($id)
    {
        // Fetch the document and verify it exists
        $document = Document::findOrFail($id);

        // Check if document was downloaded (archived) before forwarding
        if ($document->status !== Document::STATUS_ARCHIVED) {
            return redirect()->route('bureau.received')
                             ->withErrors('Document must be downloaded before forwarding.');
        }

        // Forward to Director General; assuming Director General's user ID is 1
        $document->receiver_id = 1;
        $document->status = Document::STATUS_PENDING;
        $document->save();

        return redirect()->route('bureau.received')->with('status', 'Document forwarded to Director General.');
    }

    // Archive document after download
    public function archiveDocument($id)
    {
        // Find and archive the document, marking as downloaded
        $document = Document::findOrFail($id);
        $document->status = Document::STATUS_ARCHIVED;
        $document->archived = true;
        $document->save();

        return redirect()->route('bureau.archive')->with('status', 'Document archived successfully.');
    }

   

    // Update status of document to 'read' when it's opened
    public function markAsRead($id)
    {
        $document = Document::findOrFail($id);

        // Mark document as read for tracking
        $document->status = Document::STATUS_READ;
        $document->save();

        return redirect()->route('bureau.received')->with('status', 'Document marked as read by BO.');
    }
    //the archive methode

    
    public function showArchive(Request $request)
{
    // Filter documents based on user name, title, content, and creation date
    $documents = Document::when($request->filled('search'), function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%')
              ->orWhereDate('created_at', $request->search);
        });
    })
    ->get();

    return view('bureau.archive', compact('documents'));
}


    
        // Additional methods for the Bureau d'Ordre
    
    
}
