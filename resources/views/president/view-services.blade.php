{{-- resources/views/president/view_services.blade.php --}}
@extends('layouts.app')

@section('content')

    <style>
        /* Table Styles */
        .document-table {
        max-width: 90%;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff83;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        animation: fadeIn 1s ease-out;
    }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.1em;
            min-width: 600px;
            transition: all 0.3s ease;
    }

        th, td {
            padding: 12px 20px;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #3a4e6c; /* Darker blue for header */
            color: #ffffff; /* White text for header */
            text-transform: uppercase; /* Uppercase letters for header */
            letter-spacing: 1px; /* Spacing between letters */
        }
         td {
        font-size: 1em;
        color: #ffffff;
    }

    tr {
        background:rgb(65, 68, 108) ;
        color: #fff;
        text-align: left;
        font-weight: bold;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }
        tr:hover {
            transform: scale(1.02);
            cursor: pointer;            
        }

        tr:nth-child(even) {
            background: #414ac463; 
        }

        h1 {
            font-size: 2.5em;
            color: rgb(65, 68, 108) ;
            margin-bottom: 25px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-align: center;
        }
    </style>
<div class="document-table">
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
</div>
@endsection
