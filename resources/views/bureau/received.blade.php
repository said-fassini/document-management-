@extends('layouts.app')

@section('content')
<div class="container">
    <h2>recived</h2>

    <!-- Search Form -->
    <form action="{{ route('bureau.received') }}" method="GET" class="search-form">
        <input type="text" name="query" placeholder="Search by title or content..." value="{{ request('query') }}">
        <input type="date" name="date" value="{{ request('date') }}">
        <input type="text" name="receiver" placeholder="Search by receiver..." value="{{ request('receiver') }}">
        <button type="submit">Search</button>
    </form>

    <!-- Document List -->
<div class="documents-list">
    @if($documents->isEmpty())
        <p>No documents found.</p>
    @else
        @foreach($documents as $document)
            <div class="document-card" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px;">
                <h3>{{ $document->title }}</h3>
                    <p>description is '{{ $document->description }}'</p>
                    <p>Received on: {{ $document->created_at->format('Y-m-d') }}</p>
                    <p>Receiver: {{ $document->receiver->name }}</p>
                    <p>statue: {{ $document->status }}</p>

                <!-- زر التحميل -->
                <form action="{{ route('bureau.download', $document->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Download</button>
                </form>

                <!-- زر إعادة التوجيه -->
                <form action="{{ route('bureau.forward', $document->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Forward to General Director</button>
                </form>
            </div>
        @endforeach
    @endif
</div>























<style>
    /* Styles for the search form */
    .search-form {
        margin-bottom: 20px;
    }

    .search-form input {
        padding: 10px;
        margin-right: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .search-form button {
        padding: 10px 15px;
        background-color: #457b9d;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-form button:hover {
        background-color: #1d3557;
    }

    /* Styles for document cards */
    .document-card {
        background-color: #f1faee;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
    }
</style>

@endsection
