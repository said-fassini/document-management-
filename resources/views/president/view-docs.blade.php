@extends('layouts.app')

@section('content')
<style>
    /* تصميم كامل للمحتوى */
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

    /* تصميم العنوان */
    .title {
        font-size: 2.5em;
        color: rgb(65, 68, 108) 
;
        margin-bottom: 25px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        text-align: center;
    }

    /* تصميم الجدول */
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 1.1em;
        min-width: 600px;
        transition: all 0.3s ease;
    }

    /* تصميم العناوين */
    .styled-table thead tr {
        background:rgb(65, 68, 108) ;
        color: #fff;
        text-align: left;
        font-weight: bold;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    /* تنسيق الخلايا */
    .styled-table th,
    .styled-table td {
        padding: 12px 20px;
        border-bottom: 1px solid #dddddd;
    }

    /* الصفوف */
    .styled-table tbody tr {
        transition: background 0.3s, transform 0.3s;
    }

    .styled-table tbody tr:nth-child(even) {
            background: #414ac463; 
        }
    /* التأثيرات على الصفوف */
    .styled-table tbody tr:hover {
        transform: scale(1.02);
        cursor: pointer;
    }

    /* الخلايا */
    .styled-table tbody td {
        font-size: 1em;
        color: #ffffff;
    }

    /* تأثير الظهور */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="document-table">
    <h1 class="title">Documents</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr>
                    <td>{{ $document->title }}</td>
                    <td>{{ $document->sender }}</td>
                    <td>{{ $document->receiver }}</td>
                    <td>{{ $document->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
