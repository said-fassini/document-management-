@extends('layouts.app')

@section('content')
    <h1>President Dashboard</h1>

    <!-- User and Document Stats as Cards -->
    <div class="stats-cards">
        <div class="card">
            <h3>Total Users</h3>
            <p>{{ $userCount }}</p>
        </div>
        <div class="card">
            <h3>Total Documents</h3>
            <p>{{ $documentCount }}</p>
        </div>
    </div>

    <!-- Last Three Created Users -->
    <h2>Last Three Created Users</h2>
    <div class="latest-users-cards">
        @foreach ($latestUsers as $user)
            <div class="card">
                <h3>{{ $user->name }}</h3>
                <p>Role: {{ $user->role }}</p>
                <p>Created At: {{ $user->created_at->format('Y-m-d') }}</p>
            </div>
        @endforeach
    </div>

    <!-- Google Chart Placeholder -->
    @if ($sentDocumentsPerService->isNotEmpty() || !empty($receivedCounts))
        <div id="chart_div" class="chart"></div>
    @else
        <p>No data available for document statistics.</p> {{-- رسالة توضح عدم وجود بيانات --}}
    @endif
@endsection

@section('scripts')
@if ($sentDocumentsPerService->isNotEmpty() || !empty($receivedCounts))
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Service', 'Documents'],
            @foreach ($sentDocumentsPerService as $service)
                var received = {{ isset($receivedCounts[$service->sender_id]) ? $receivedCounts[$service->sender_id] : 0 }};
                ['Service {{ $service->sender_id }}', {{ $service->total_sent + $received }}],
            @endforeach
        ]);

        var options = {
            title: 'Documents Sent and Received by Service',
            pieHole: 0.4,
            slices: {
                0: { color: '#3498db' },
                1: { color: '#2ecc71' },
                2: { color: '#e74c3c' },
                3: { color: '#9b59b6' },
                4: { color: '#f1c40f' }
            },
            legend: { position: 'right' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
@endif
@endsection
