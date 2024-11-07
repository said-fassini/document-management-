{{-- resources/views/service/archive.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
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
