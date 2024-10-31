<?php

namespace App\Http\Controllers;
use App\Models\Document;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function viewDocs()
{
    $documents = Document::all(); // Fetch all documents or add any specific conditions
    return view('president.view_docs', compact('documents'));
}
    public function create()
    {
        
    }
}
