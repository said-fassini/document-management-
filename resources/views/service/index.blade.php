@extends('layouts.app')

@section('content')
<div class="card">

    {{-- Notification section --}}
    <p>New Documents: {{ $newDocumentsCount ?? 0}}</p>

    {{-- Display latest document received --}}
    <h3>Latest Document</h3>
    @if(isset($latestDocument))
        <div>
            <h4>{{ $latestDocument->title }}</h4>
            <p>{{ $latestDocument->description }}</p>
        </div>
    @else
        <p>No documents received recently.</p>
    @endif

    <div class="cal-todo-cards">
                @include('layouts.calendar')
                <div class="todo">
                 @include('layouts.todo')   
                </div>
                
        
        </div>
</div>
@endsection
