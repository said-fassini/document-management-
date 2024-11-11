<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // For file handling
use Illuminate\Support\Facades\Log;  // Add this at the top of the controller
use Illuminate\Support\Facades\DB;


class BureauController extends Controller
{
    // Display Bureau d’Ordre Dashboard with pending documents, agenda, and notifications
    public function home()
    {
        $userId = Auth::id();
    
        // Fetch all pending documents that have been received by the Bureau d'Ordre (user)
        $pendingDocuments = Document::where('status', 'pending')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    
        // Count of unread documents for the Bureau d'Ordre
        $newDocCount = Document::where('status', 'pending')
                               ->count();
    
        // Count of received documents by each service (role) for the Google Chart
        $serviceStats = Document::join('users', 'documents.sender_id', '=', 'users.id')
                                ->where('status', 'pending')
                                ->selectRaw('users.role as sender_role, COUNT(*) as received_count')
                                ->groupBy('users.role')
                                ->pluck('received_count', 'sender_role')
                                ->toArray();
    
        return view('bureau.home', compact('pendingDocuments', 'newDocCount', 'serviceStats'));
    }
    



    
    // Display received documents for Bureau d'Ordre
    
public function received()
{
    $userId = Auth::id();

    // Log the user ID for clarity
    Log::info("Current User ID: " . $userId);

    // Enable query logging
    DB::enableQueryLog();

    // Fetch documents received by the Bureau d'Ordre with 'pending' status
    $documents = Document::where('status','=', 'pending')
                         ->get();

    // Log the executed query
    Log::info("Executed Query: ", ['query' => DB::getQueryLog()]);

    // Log the fetched documents to check if any records are returned
    Log::info("Fetched Documents: ", ['documents' => $documents]);

    // Count of unread documents
    $unreadCount = $documents->count();

    // Log the unread count
    Log::info("Unread Documents Count: " . $unreadCount);

    // Return the view with the fetched data
    return view('bureau.received', compact('documents', 'unreadCount'));
}




    // Download the document and change its status to 'read by Bureau d'Ordre'
    public function download($id)
    {
        $document = Document::findOrFail($id);

        // Check if the logged-in user is authorized to download
        if ($document->status=='pending') {
            // Update status to "read by Bureau d'Ordre"
            $document->update(['status' => 'read by Bureau d\'Ordre']);

            return Storage::disk('public')->download($document->file_path, $document->title);
        }

        return redirect()->back()->withErrors('Unauthorized access.');
    }

    // Forward the document to the General Director
    public function forward($id)
    {
        $document = Document::findOrFail($id);

        // Check if document is marked as archived before forwarding
        if ($document->status !== 'read by Bureau d\'Ordre') {
            return redirect()->route('bureau.received')
                             ->withErrors('Document must be downloaded before forwarding.');
        }

        // Forward document to the Director General (role "General Director")
        // $document->receiver_id = User::where('role', 'General Director')->first()->id;
        $document->status = 'forwarded to dgs';
        $document->save();

        return redirect()->route('bureau.received')->with('status', 'Document forwarded to General Director.');
    }


    // public function forward(Request $request, $id)
    // {
    //     // Get the authenticated user and ensure it's the Bureau d'Ordre
    //     $userId = Auth::id();
    //     $userRole = Auth::user()->role;
    
    //     if ($userRole !== 'Bureau dOrdre') {
    //         return redirect()->back()->withErrors('Only the Bureau dOrdre can forward documents.');
    //     }
    
    //     // Find the document by ID
    //     $document = Document::findOrFail($id);
    
    //     // Check if the document is eligible for forwarding
    //     if ($document->status !== 'pending') {
    //         return redirect()->back()->withErrors('The document has already been processed.');
    //     }
    
    //     // Change the status of the document to 'forwarded'
    //     $document->status = 'forwarded';
    
    //     // Update the receiver to the Directeur Général (assuming you have a way to identify them)
    //     $generalDirector = User::where('role', 'Directeur Général')->first();
    //     if (!$generalDirector) {
    //         return redirect()->back()->withErrors('Error: Directeur Général user not found.');
    //     }
    
    //     $document->receiver_id = $generalDirector->id;
    //     $document->save();
    
    //     return redirect()->route('bureau.received')->with('success', 'Document has been forwarded successfully.');
    // }
    

















    
    // Show the archive page for Bureau d'Ordre
    public function showArchive(Request $request)
    {
        // Search functionality
        $documentss = Document::when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhereDate('created_at', $request->search);
            });
        })
        ->get();

        return view('bureau.archive', compact('documentss'));
    }





    // Archive document after download
    public function archiveDocument($id)
    {
        $document = Document::findOrFail($id);
        $document->status = 'archived';
        $document->archived = true;
        $document->save();

        return redirect()->route('bureau.archive')->with('status', 'Document archived successfully.');
    }
}
