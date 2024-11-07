@extends('layouts.app')

@section('content')
<div>
    <h2>Received Documents</h2>
    <form method="GET" action="{{ route('service.receive') }}">
        <input type="text" name="search" placeholder="Search by title or description">
        <button type="submit">Search</button>
    </form>

    @foreach($receivedDocuments as $document)
        <div class="card">
            <h3>{{ $document->title }}</h3>
            <p>{{ $document->description }}</p>
            <a href="{{ route('documents.download', $document->id) }}">Download</a>
        </div>
    @endforeach
</div>
@endsection
