{{-- resources/views/service/archive.blade.php --}}
@extends('layouts.app')

@section('content')
<style>



/* Search bar and button */
.search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

 input {
    padding: 8px 12px;
    border-radius: 4px 0 0 4px;
    border: 1px solid #ccc;
    font-size: 1rem;
    width: 60%;
    outline: none;
}

 button {
    padding: 8px 16px;
    background-color: #2a5298;
    color: #fff;
    border: none;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

 button:hover {
    background-color: #c0392b;
}

/* Document cards */

 h3 {
    font-size: 1.4rem;
    color: #2643c4;
    margin-bottom: 8px;
}

 p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 12px;
}

 a {
    color: #2a5298;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

 a:hover {
    color: #c0392b;
}

</style>
<div class="card">
    <h1>Archived Documents</h1>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search Form --}}
    <form action="{{ route('service.archive') }}" method="GET">
        <input type="text" name="search" placeholder="Search documents by title or sender" value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    {{-- Display Archived Documents --}}
    @if ($archivedDocuments->isEmpty())
        <p>No archived documents found.</p>
    @else
        @foreach ($archivedDocuments as $document)
            <div class="card my-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $document->title }}</h5>
                    <p class="card-text">{{ $document->description }}</p>
                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary">Download</a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
