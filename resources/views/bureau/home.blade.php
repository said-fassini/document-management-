<!-- resources/views/bureau/home.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

    <!-- Notification Card for New Documents -->
    <div class="notification-card animated-card">
        <h2>New Documents</h2>
        <p>You have {{ $newDocCount }} new document(s) received.</p>
        @if ($newDocCount > 0)
            <a href="{{ route('bureau.received') }}" class="btn">View Received Documents</a>
        @else
            <p>No new documents.</p>
        @endif
    </div>

    <!-- Pending Documents Section -->
    <div class="notification-card animated-card">
        <h2>Pending Documents</h2>
        @foreach($pendingDocuments as $document)
            <div class="document-card" data-id="{{ $document->id }}">
                <h3>{{ $document->title }}</h3>
                <p>{{ $document->content }}</p>
                <p>Status: {{ $document->status }}</p>
                <button class="delete-button" data-id="{{ $document->id }}">Delete</button> <!-- Button to delete document -->
                <a href="{{ route('bureau.received', ['document_id' => $document->id]) }}" class="btn">View Document</a> <!-- Link to received documents -->
            </div>
        @endforeach
    </div>
    @foreach($pendingDocuments as $document)
    <div class="document-card">
        <h3>{{ $document->title }}</h3>
        <p>{{ $document->content }}</p>
        <p>Status: {{ $document->status }}</p>
        <a href="{{ route('bureau.received', ['document_id' => $document->id]) }}" class="btn">View Document</a> <!-- Link to received documents -->
        <button class="delete-button" data-id="{{ $document->id }}">Delete</button> <!-- Button to delete document -->
    </div>
@endforeach





    <!-- Notes Section -->
    <div class="notes-section">
        <h2>Notes for <span id="selectedDate"></span></h2>
        <input id="noteInput" placeholder="Add your note and press Enter..." class="notes-input"/>
    </div>

    <!-- Calendar Section -->
    <div class="calendar-container">
        <h2>Calendar</h2>
        <div id="calendar"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var noteInput = document.getElementById('noteInput');
        var selectedDateDisplay = document.getElementById('selectedDate');
        var currentDate; // To store the currently selected date

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            dateClick: function(info) {
                currentDate = info.dateStr; // Get the selected date
                selectedDateDisplay.textContent = currentDate; // Update displayed date
                noteInput.value = ''; // Clear the input for new note
                noteInput.placeholder = "Write a note for " + currentDate; // Update placeholder
                noteInput.focus(); // Focus on the input
            },
            events: [
                // Example events; you can fetch events from your backend
                // { title: 'Note for Date', date: '2024-10-30' }
            ]
        });

        calendar.render();

        // Save note functionality on Enter
        noteInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                var note = noteInput.value;
                if (note) {
                    // Add the note to the calendar
                    calendar.addEvent({
                        title: note,
                        start: currentDate,
                        allDay: true
                    });
                    noteInput.value = ''; // Clear input after saving
                    alert('Note saved for ' + currentDate);
                } else {
                    alert('Please enter a note to save.');
                }
            }
        });

        // Handle document deletion
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                var docCard = this.closest('.document-card');
                var docId = docCard.getAttribute('data-id');
                // Implement AJAX request to delete the document from the database
                // For demo, we just remove the card from the DOM
                docCard.remove();
                alert('Document with ID ' + docId + ' deleted.'); // You can replace this with actual AJAX handling
            });
        });

        // Handle document viewing
        document.querySelectorAll('.view-button').forEach(button => {
            button.addEventListener('click', function() {
                var docCard = this.closest('.document-card');
                var docId = docCard.getAttribute('data-id');
                // Redirect to the received documents page
                window.location.href = "{{ route('bureau.received') }}?document_id=" + docId;
                // Optionally, remove the card from the homepage after redirect
                // docCard.remove();
            });
        });
    });
</script>

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
