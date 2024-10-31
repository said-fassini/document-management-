<!-- resources/views/bureau/history.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Document History</h1>
    @foreach($documents as $document)
        <div class="document-history">
            <h3>{{ $document->title }}</h3>
            <p>{{ $document->description }}</p>
            <p>Status: {{ $document->status }}</p>
        </div>
    @endforeach
@endsection
