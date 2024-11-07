@extends('layouts.app') <!-- Ensure this layout exists and has @yield('content') -->

@section('content')
    
<div class="container">
    <!-- Section: Recently Received Documents -->
    <h2>Recently Received Documents</h2>
    @if($pendingDocuments->count())
        <div class="row">
            @foreach($pendingDocuments as $document)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $document->title }}</h5>
                            <p class="card-text">Sender: {{ $document->sender->name }}</p>
                            <p class="card-text"><small class="text-muted">Received {{ $document->created_at->diffForHumans() }}</small></p>
                            <a href="{{ route('bureau.received', ['id' => $document->id]) }}" class="btn btn-primary">View Document</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No pending documents.</p>
    @endif

    <!-- Section: New Unread Document Count -->
    <p>New Unread Documents: {{ $newDocCount }}</p>

    <!-- Section: Google Chart for Received Documents -->
    <div id="chart_div" style="height: 500px;"></div>
































<style>
    /* Styles for the body */
    body {
        background-image: url('https://example.com/moroccan-background.jpg'); /* Change to your Moroccan background image */
        background-size: cover; /* Cover the entire background */
        background-color: #f5f3f0; /* Fallback color */
        font-family: 'Arial', sans-serif; /* Simple font family */
    }

    /* Styles for the Notification Card */
    .notification-card {
        background-color: #e63946; /* Deep red color */
        border: 1px solid #d50032; /* Darker red for border */
        border-radius: 8px; /* Rounded corners */
        padding: 20px; /* Spacing inside the card */
        margin-bottom: 20px; /* Space below the card */
        transition: transform 0.3s ease; /* Animation on hover */
        color: white; /* White text color */
        text-align: center; /* Center align text */
    }

    .notification-card:hover {
        transform: scale(1.05); /* Slightly enlarge card on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
    }

    /* Styles for the Pending Documents */
    .pending-documents {
        margin-top: 20px; /* Space above the pending documents */
    }

    .document-card {
        background-color: #457b9d; /* Blue background for document cards */
        border: 1px solid #1d3557; /* Darker blue for border */
        border-radius: 8px; /* Rounded corners */
        padding: 15px; /* Spacing inside the document card */
        margin-bottom: 10px; /* Space below each document card */
        color: white; /* White text color */
        position: relative; /* For positioning delete button */
    }

    .delete-button, .view-button {
        background-color: #d50032; /* Red for delete button */
        color: white; /* White text color */
        border: none; /* No border */
        padding: 5px 10px; /* Padding inside button */
        border-radius: 4px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        transition: background-color 0.3s; /* Animation on hover */
    }

    .delete-button:hover, .view-button:hover {
        background-color: #b00020; /* Darker red on hover */
    }

    /* Styles for Notes Section */
    .notes-section {
        margin-top: 40px; /* Space above the notes section */
        background-color: rgba(255, 255, 255, 0.8); /* Light background for notes */
        border-radius: 8px; /* Rounded corners */
        padding: 15px; /* Padding inside notes section */
    }

    .notes-input {
        width: 100%; /* Full width for input */
        border-radius: 4px; /* Rounded corners */
        border: 1px solid #ccc; /* Light border */
        padding: 10px; /* Padding inside input */
        font-size: 0.9rem; /* Smaller font size */
        resize: none; /* Disable resizing */
    }

    /* Styles for Calendar */
    .calendar-container {
        margin-top: 40px; /* Space above the calendar */
        background-color: cadetblue; /* Light background for calendar */
        border-radius: 8px; /* Rounded corners */
        padding: 15px; /* Padding inside calendar section */
    }

    #calendar {
        max-width: 50%; /* Full width for calendar */
        margin: 0 auto; /* Center the calendar */
        font-size: 0.9rem; /* Smaller font size for calendar */
    }

    /* Button styling */
    .btn {
        background-color: #f1faee; /* Light background for buttons */
        color: #457b9d; /* Blue text color */
        padding: 10px 15px; /* Padding inside buttons */
        border-radius: 5px; /* Rounded corners */
        text-decoration: none; /* Remove underline */
        transition: background-color 0.3s ease; /* Animation for hover */
        display: inline-block; /* Make it inline */
    }

    .btn:hover {
        background-color: #a8dadc; /* Lighter blue on hover */
        color: white; /* White text color on hover */
    }
</style>

@endsection
