{{-- resources/views/president/view_services.blade.php --}}
@extends('layouts.app')

@section('content')

    <style>
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse; /* Removes space between borders */
            margin-top: 20px; /* Spacing above the table */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Hides overflow for rounded corners */
        }

        th, td {
            padding: 15px; /* Spacing inside table cells */
            text-align: left; /* Align text to the left */
            border-bottom: 1px solid #444; /* Darker border for rows */
            color: #dcdcdc; /* Light text color for contrast */
        }

        th {
            background-color: #3a4e6c; /* Darker blue for header */
            color: #ffffff; /* White text for header */
            text-transform: uppercase; /* Uppercase letters for header */
            letter-spacing: 1px; /* Spacing between letters */
        }

        tr:hover {
            background-color: #4c6b8f; /* Highlight row on hover */
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        tr:nth-child(even) {
            background-color: #2a3b4d; /* Alternate row color for even rows */
        }

        h1 {
            color: #ffffff; /* Light text for heading */
            margin-bottom: 20px; /* Spacing below heading */
        }
    </style>

    <h1>Services</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        @foreach ($services as $service) {{-- Looping through the services --}}
            <tr>
                <td>{{ $service->name }}</td>
                <td>{{ $service->email }}</td>
                <td>{{ $service->role }}</td>
            </tr>
        @endforeach
    </table>
@endsection
