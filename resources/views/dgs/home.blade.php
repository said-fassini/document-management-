@extends('layouts.app') <!-- Ensure this layout exists and has @yield('content') -->

@section('content')
    
<div class="stats-cards">
        <div class="card">
            <!-- Section: Recently Received Documents -->
            <h2>Recently Received Documents</h2>
            @if($pendingDocuments->count())
                        <div class="">
                    @foreach($pendingDocuments as $document)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                            <h5 class="card-title">{{ $document->title }}</h5>
                                    <p class="card-text">Sender: {{ $document->sender->name }}</p>
                                    <p class="card-text"><small class="text-muted">Received {{ $document->created_at->diffForHumans() }}</small></p>
                                    <a href="{{ route('dgs.received', ['id' => $document->id]) }}" class="btn btn-primary">View Document</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No pending documents.</p>
            @endif
        </div>
    <!-- Section: New Unread Document Count -->
   <div class="card">
     <p>New Unread Documents: {{ $newDocCount }}</p>
    </div>
    <!-- Section: Google Chart for Received Documents -->
    <!-- <div id="chart_div" style="height: 500px;"></div> -->
      
    <div class="cal-todo-cards">
                @include('layouts.calendar')
                <div class="todo">
                 @include('layouts.todo')   
                </div>
                
        
        </div>







@endsection
