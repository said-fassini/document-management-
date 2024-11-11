<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    //
    public function viewDocs()
    {
    $documents = Document::all(); // Fetch all documents or add any specific conditions
    return view('president.view_docs', compact('documents'));
   }


 // Show the upload form
    public function showUploadForm()
    {
        // Get users with the 'service' role to populate receiver dropdown
        $receivers = User::where('role', 'Service')->get();
        return view('service.upload', compact('receivers'));
    }

 // Handle document upload
    public function upload(Request $request)
    {
    // Validate the request
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'description' => 'required|string',
            'receiver_id' => 'required|exists:users,id'  // Ensure receiver exists
        ]);

        // Get the current date and create a sequential document title
        $datePrefix = now()->format('Ymd');
        $senderId = Auth::id();

        // Get the last document to create a sequential title
        $lastDocument = Document::where('title', 'like', "$datePrefix-$senderId-%")
                                ->orderBy('id', 'desc')
                                ->first();
        $newSequence = $lastDocument ? ((int) str_replace([$datePrefix . '-' . $senderId . '-', '.pdf'], '', $lastDocument->title) + 1) : 1;
        $title = "$datePrefix-$senderId-$newSequence.pdf";

        // Find Bureau d'Ordre user
        $bureauDOrder = User::where('role', 'Bureau dOrdre')->first();
        if (!$bureauDOrder) {
            return redirect()->back()->withErrors('Error: Bureau d\'Ordre user not found.');
        }

        $finalReceiverId = $request->receiver_id;  // Final receiver selected by user

        // Handle file upload
        if ($request->hasFile('file')) {
            // Store the file and get the file path
            $filePath = $request->file('file')->storeAs('documents', $title, 'public');  // Store file in 'public/documents'

            // Ensure the file path is correctly stored
            Log::info("File uploaded successfully, file path: " . $filePath);

            // Create a new document entry in the database with the file path
            Document::create([
                'title' => $title,
                'description' => $request->description,
                'file_path' => $filePath,  // Store the file path in the database
                'sender_id' => $senderId,
                'receiver_id' => $finalReceiverId,  // Bureau d'Ordre as intermediary
                'status' => 'pending'
            ]);

            return redirect()->route('service.upload')->with('success', 'Document uploaded successfully');
        } else {
            return redirect()->back()->withErrors('Error: Failed to upload file.');
        }
    }



    // Download the document
    public function download($id)
    {
        $document = Document::findOrFail($id);

        // تحديث حالة المستند عند التنزيل
        if (Auth::id() == $document->receiver_id && $document->status == 'pending') {
            $document->update(['status' => 'read', 'archived' => true]);
        }

        // تنزيل الملف باستخدام مسار الملف المخزن
        $filePath = storage_path("app/public/" . $document->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath, $document->title);
        } else {
            return redirect()->back()->withErrors("الملف غير موجود.");
        }
    }




// public function showUploadForm()
// {
//     return view('documents.upload'); // The view file for the upload form
// }

// public function upload(Request $request)
// {
//     $request->validate([
//         'file' => 'required|mimes:pdf|max:2048',
//         'description' => 'required|string',
//         'receiver_id' => 'required|integer|exists:users,id'
//     ]);

//     // Create a unique title based on the current date and the document ID
//     $title = now()->format('Ymd') . '-' . (Document::max('id') + 1) . '.pdf';

//     // Store the file using the new title
//     $path = $request->file('file')->storeAs('documents', $title, 'public');

//     // Create a new document entry
//     Document::create([
//         'title' => $title, // Store the title as the filename
//         'description' => $request->description,
//         'file_path' => $path,
//         'sender_id' => 4,  // Default sender_id
//         'receiver_id' => $request->receiver_id,
//     ]);

//     return redirect()->route('documents.index');
// }


// public function index()
// {
//     $sentDocuments = Document::where('sender_id', 4)->get(); // Hardcoded sender_id for this example
//     $receivedDocuments = Document::where('receiver_id', 4)
//                                   ->where('status', 'readbyDGS') // Only documents with 'readbyDGS' status
//                                   ->get();

//     return view('documents.index', compact('sentDocuments', 'receivedDocuments'));
// }


// public function download($id)
// {
//     // Find the document by ID
//     $document = Document::findOrFail($id);

//     // Check if the file exists in the storage
//     if (!Storage::disk('public')->exists($document->file_path)) {
//         abort(404, 'File not found.');
//     }

//     // Return the file for download with the specified name
//     return response()->download(storage_path('app/public/' . $document->file_path), $document->title);
// }

// public function markAsRead($id)
// {
//     $document = Document::findOrFail($id);
//     $document->update(['status' => 'read']); // Update the status to 'read'
//     return redirect()->route('documents.index')->with('success', 'Document marked as read.');
// }




// Display sent and received documents for the specific service user



   


    

   
}

