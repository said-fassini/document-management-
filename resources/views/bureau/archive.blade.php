<!-- resources/views/bureau/archive.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Archive</h2>
    
    <!-- Search Form -->
    <form method="GET" action="{{ route('bureau.archive') }}">
        <input type="text" name="search" placeholder="Search by title, content, or date">
        <button type="submit">Search</button>
    </form>

    <!-- Archive Results -->
    @if($documents->isEmpty())
        <p>No documents found.</p>
    @else
        @foreach($documents as $document)
            <div class="document-card">
                <h3>{{ $document->title }}</h3>
                <p>{{ $document->content }}</p>
                <p>Date: {{ $document->created_at->format('Y-m-d') }}</p>
                <!-- Additional details can be added here -->
            </div>
        @endforeach
    @endif
</div>
@endsection
