@extends('layouts.app')

@section('content')

<style>
    /* Container styling */
    .received-documents-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }



    /* Search bar and button */
    form {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    form input[type="text"] {
        padding: 8px 12px;
        border-radius: 4px 0 0 4px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 60%;
        outline: none;
    }

    form button {
        padding: 8px 16px;
        background-color: #2a5298;
        color: #fff;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s;
    }

    form button:hover {
        background-color: #c0392b;
    }

    /* Document cards */
    .document-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 15px;
        transition: transform 0.2s;
    }

    .document-card:hover {
        transform: translateY(-5px);
    }

    .document-card h3 {
        font-size: 1.4rem;
        color: #2643c4;
        margin-bottom: 8px;
    }

    .document-card p {
        font-size: 1rem;
        color: #555;
        margin-bottom: 12px;
    }

    .document-card a {
        color: #2a5298;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }

    .document-card a:hover {
        color: #c0392b;
    }

</style>

<div class="card">
    <h2>Archive</h2>
    
    <!-- Search Form -->
    <form method="GET" action="{{ route('dgs.archive') }}">
        <input type="text" name="search" placeholder="Search by title, content, or date">
        <button type="submit">Search</button>
    </form>

    <!-- Archive Results -->
    @if($documentss->isEmpty())
        <p>No documents found.</p>
    @else
        <div class="row">
            @foreach($documentss as $document)
                <div class="col-md-4 mb-4">
                    <div class="card" style="border: 1px solid #ccc; padding: 15px;">
                        <div class="card-body">
                            <h3 class="card-title">{{ $document->title }}</h3>
                            <p>{{ $document->description }}</p>
                            <p><strong>Status:</strong> {{ $document->status }}</p> <!-- Display the status -->

                            <p>Date: {{ $document->created_at->format('Y-m-d') }}</p>
                            
                            <!-- Download button -->
                            <form action="{{ route('dgs.download', $document->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Download</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
