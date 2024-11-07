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
                            <form action="{{ route('bureau.download', $document->id) }}" method="POST" style="display: inline;">
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
