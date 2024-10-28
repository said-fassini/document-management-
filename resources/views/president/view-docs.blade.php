@extends('layouts.app')

@section('content')


    <h1>Documents</h1>
    <table>
        <tr>
            <th>Titrrrrrrle</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Status</th>
        </tr>
        @foreach ($documents as $document) {{-- Looping through the documents --}}
            <tr>
                <td>{{ $document->title }}</td>
                <td>{{ $document->sender }}</td>
                <td>{{ $document->receiver }}</td>
                <td>{{ $document->status }}</td>
                <td>{{ $document->status }}</td>
            </tr>
           <h1>hhhhh</h1> hello world
        @endforeach
    </table>
@endsection
