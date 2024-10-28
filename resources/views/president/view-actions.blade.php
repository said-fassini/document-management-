{{-- resources/views/president/view_actions.blade.php --}}
@extends('layouts.app')

@section('content')

    <h1>Actions</h1>
    <table>
        <tr>
            <th>User</th>
            <th>Action</th>
            <th>Date</th>
        </tr>
        @foreach ($actions as $action) {{-- Looping through the actions --}}
            <tr>
                <td>{{ $action->user_id }}</td>
                <td>{{ $action->action }}</td>
                <td>{{ $action->created_at }}</td>
            </tr>
            <h1>helle</h1>
        @endforeach
    </table>
@endsection
