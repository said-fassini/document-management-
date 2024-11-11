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
    .search-form {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .search-form input[type="text"] {
        padding: 8px 12px;
        border-radius: 4px 0 0 4px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 60%;
        outline: none;
    }

    .search-form button {
        padding: 8px 16px;
        background-color: #2a5298;
        color: #fff;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s;
    }

    .search-form button:hover {
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
    <h2>Received Documents</h2>
    <form method="GET" action="{{ route('service.receive') }}" class="search-form">
        <input type="text" name="search" placeholder="Search by title or description">
        <button type="submit">Search</button>
    </form>

    @foreach($receivedDocuments as $document)
        <div class="document-card">
            <h3>{{ $document->title }}</h3>
            <p>{{ $document->description }}</p>
            <a href="{{ route('documents.download', $document->id) }}">Download</a>
        </div>
    @endforeach
</div>

@endsection
