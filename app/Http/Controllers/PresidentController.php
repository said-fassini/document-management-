<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PresidentController extends Controller
{
    
    // Home method to display dashboard overview
    public function home()
{
    // Count of all users in the system
    $userCount = User::count();

    // Count of all documents in the system
    $documentCount = DB::table('documents')->count();

    // Get the latest three users created in the system
    $latestUsers = User::orderBy('created_at', 'desc')->take(3)->get();

    // Get the latest document sent in the system, if available
    $latestDocument = DB::table('documents')
        ->orderBy('created_at', 'desc')
        ->first(['title', 'sender_id', 'receiver_id']);

    // Prepare data for Google Charts
    $sentDocumentsPerService = DB::table('documents')
        ->select(DB::raw('sender_id, COUNT(*) as total_sent'))
        ->groupBy('sender_id')
        ->get();

    $receivedDocumentsPerService = DB::table('documents')
        ->select(DB::raw('receiver_id, COUNT(*) as total_received'))
        ->groupBy('receiver_id')
        ->get();

    // Convert received documents to an associative array for easy access
    $receivedCounts = [];
    foreach ($receivedDocumentsPerService as $received) {
        $receivedCounts[$received->receiver_id] = $received->total_received;
    }

    // Passing data to the home view
    return view('president.home', [
        'latestDocument' => $latestDocument,
        'userCount' => $userCount,
        'documentCount' => $documentCount, // إضافة إجمالي الوثائق
        'sentDocumentsPerService' => $sentDocumentsPerService,
        'receivedCounts' => $receivedCounts,
        'latestUsers' => $latestUsers,
    ]);
}



    // Method to create a new user
    public function createUser()
    {
        return view('president.create-user');
    }
    public function storeUser(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
        ]);
    
        // إنشاء المستخدم الجديد
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('default_password'), // تعيين كلمة مرور افتراضية، يمكن تعديلها لاحقاً
        ]);
    
        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('president.home')->with('success', 'User created successfully!');
    }
    



    // Method to display documents list
    public function viewDocuments()
    {
        $documents = DB::table('documents')->get();
        return view('president.view-docs', ['documents' => $documents]);
    }

    // Method to display services (users)
    public function viewServices()
    {
        $services = User::where('role', '!=', 'president')->get();
        return view('president.view-services', ['services' => $services]);
    }

    // Method to view actions performed in the system
    public function viewActions()
    {
        $actions = DB::table('audit_logs')->orderBy('created_at', 'desc')->get();
        return view('president.view-actions', ['actions' => $actions]);
    }
    public function index()
    {
        return view('president.dashboard');
    }


}








