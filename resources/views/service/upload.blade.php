{{-- resources/views/service/upload.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Document</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('service.upload.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ now()->format('Ymd') }}-{{ Auth::id() }}" readonly>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="receiver_id" class="form-label">Select Receiver</label>
            <select name="receiver_id" id="receiver_id" class="form-control">
                @foreach ($receivers as $receiver)
                    <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Upload Document</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Send Document</button>
    </form>
</div>
@endsection
