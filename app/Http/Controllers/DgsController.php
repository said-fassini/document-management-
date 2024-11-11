<?php
namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // For file handling
use Illuminate\Support\Facades\Log;  
use Illuminate\Support\Facades\DB;


class DgsController extends Controller
{
    // Affiche les documents avec le statut "readbyBO"
   
    public function home()
    {
    
        // Fetch all pending documents that have been received by the Bureau d'Ordre (user)
        $pendingDocuments = Document::where('status', 'forwarded to dgs')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    
        // Count of unread documents for the Bureau d'Ordre
        $newDocCount = Document::where('status', 'forwarded to dgs')
                               ->count();
    
        // Count of received documents by each service (role) for the Google Chart
        $serviceStats = Document::join('users', 'documents.sender_id', '=', 'users.id')
                                ->selectRaw('users.role as sender_role, COUNT(*) as received_count')
                                ->groupBy('users.role')
                                ->pluck('received_count', 'sender_role')
                                ->toArray();
    
        return view('dgs.home', compact('pendingDocuments', 'newDocCount', 'serviceStats'));
    }
    




    // Marquer un document comme lu
    public function received()
    {
        $userId = Auth::id();
    
        // Log the user ID for clarity
        Log::info("Current User ID: " . $userId);
    
        // Enable query logging
        DB::enableQueryLog();
    
        // Fetch documents received by the Bureau d'Ordre with 'pending' status
        $documents = Document::where('status','=', 'forwarded to dgs')
                             ->get();
    
        // Log the executed query
        Log::info("Executed Query: ", ['query' => DB::getQueryLog()]);
    
        // Log the fetched documents to check if any records are returned
        Log::info("Fetched Documents: ", ['documents' => $documents]);
    
        // Count of unread documents
        $unreadCount = $documents->count();
    
        // Log the unread count
        Log::info("Unread Documents Count: " . $unreadCount);
    
        $receivers = User::where('role', 'Service')->get();
     
        // Return the view with the fetched data
        return view('dgs.received', compact('documents', 'unreadCount','receivers'));
    }
    

    
 // Download the document and resent it to service
 public function download($id)
 {
    $document = Document::findOrFail($id);

     // Check if the logged-in user is authorized to download
     if ($document->status == 'forwarded to dgs') {
         // Update status to "read by Bureau d'Ordre"
         $document->update(['status' => 'read by dgs']);

         return Storage::disk('public')->download($document->file_path, $document->title);
     }

     return redirect()->back()->withErrors('Unauthorized access.');
 }


 public function forward(Request $request, $id)
 {
     $document = Document::findOrFail($id);
    $receiver=$request->receiver_id;
     // Check if document is marked as archived before forwarding
     if ($document->status !== 'read to dgs') {
         return redirect()->route('dgs.received')
                          ->withErrors('Document must be downloaded before forwarding.');
     }

     // Forward document to the Director General (role "General Director")
     $document->receiver_id = $receiver;
     $document->status = 'forwarded to service';
     $document->save();

     return redirect()->route('dgs.received')->with('status', 'Document forwarded to service.');
 }


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

     return view('dgs.archive', compact('documentss'));
 }
     // Archive document after download
     public function archiveDocument($id)
     {
         $document = Document::findOrFail($id);
         $document->status = 'archived';
         $document->archived = true;
         $document->save();
 
         return redirect()->route('dgs.archive')->with('status', 'Document archived successfully.');
     }
}
