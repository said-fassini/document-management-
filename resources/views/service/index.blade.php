@extends('layouts.app')

@section('content')
<div>
    <h2>Dashboard</h2>

    {{-- Notification section --}}
    <p>New Documents: {{ $newDocumentsCount ?? 0 }}</p>

    {{-- Display latest document received --}}
    <h3>Latest Document</h3>
    @if(isset($latestDocument))
        <div>
            <h4>{{ $latestDocument->title }}</h4>
            <p>{{ $latestDocument->description }}</p>
        </div>
    @else
        <p>No documents received recently.</p>
    @endif

    {{-- Calendar and Note-taking section --}}
    <h3>Calendar and Notes</h3>
    <div>
        <label for="note-date">Select Date:</label>
        <input type="date" id="note-date" name="note_date">

        <label for="note-content">Note:</label>
        <textarea id="note-content" name="note_content" placeholder="Write your note here..."></textarea>

        <button onclick="saveNote()">Save Note</button>
    </div>
</div>
@endsection
