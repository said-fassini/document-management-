<?php
namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    // Index page with notifications and calendar
    public function index()
{
    // Get the logged-in user's ID
    $userId = Auth::id();

    // Retrieve the latest document for the logged-in user (receiver)
    $latestDocument = Document::where('receiver_id', $userId)
                              ->orderBy('created_at', 'desc')
                              ->first();

    // Count of new documents (pending status) for notifications
    $newDocumentsCount = Document::where('receiver_id', $userId)
                                 ->where('status', 'pending')
                                 ->count();

     // Logging the values for debugging
    Log::info("newDocumentsCount: " . $newDocumentsCount);
    Log::info("latestDocument: " . optional($latestDocument)->title);
    // Logging the values for debugging
    logger("newDocumentsCount: " . $newDocumentsCount);
    logger("latestDocument: " . optional($latestDocument)->title);
    // Pass variables to the view
    return view('service.index', compact('latestDocument', 'newDocumentsCount'));
}


    // Received documents with search functionality
    public function receive(Request $request)
    {
        // Get logged-in user's ID
        $userId = Auth::id();

        // Initialize query for received documents with status "read"
        $query = Document::where('receiver_id', $userId)
                         ->where('status', 'read');

        // Filter documents by search input
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Paginate results
        $receivedDocuments = $query->paginate(10);

        return view('service.receive', compact('receivedDocuments'));
    }

    // Archived documents with search functionality
    public function archive(Request $request)
    {
        // Get logged-in user's ID
        $userId = Auth::id();

        // Query for archived documents
        $query = Document::where('receiver_id', $userId)
                         ->where('archived', true);

        // Apply search filter if present
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Paginate results
        $archivedDocuments = $query->paginate(10);

        return view('service.archive', compact('archivedDocuments'));
    }
}









