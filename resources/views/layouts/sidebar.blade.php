<div class="sidebar">
    <ul>
        <li> <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo"> </li>

        @if (auth()->check() && auth()->user()->role === 'President')

        
            <li><a href="{{ route('president.home') }}">Home</a></li>
            <li><a href="{{ route('president.create-User') }}">Create User</a></li> {{-- Use createUser --}}
            <li><a href="{{ route('president.view-Docs') }}">View Documents</a></li>
            <li><a href="{{ route('president.view-Services') }}">View Users</a></li>
            <li><a href="{{ route('president.view-Actions') }}">View Actions</a></li>

        @elseif (auth()->check() && auth()->user()->role === "Bureau dOrdre") 

            <li><a href="{{ route('bureau.home') }}">Home</a></li>
            <li><a href="{{ route('bureau.received') }}">Received Documents</a></li>
            <li><a href="{{ route('bureau.archive') }}">Archive</a></li>    


        @elseif (auth()->check() && auth()->user()->role === "General Director") 

            <li><a href="{{ route('dgs.home') }}">Home</a></li>
            <li><a href="{{ route('dgs.received') }}">Received Documents</a></li>
            <li><a href="{{ route('dgs.archive') }}">Archive</a></li>    

        @elseif (auth()->check() && auth()->user()->role === "Service")
            <li class="nav-item"><a class="nav-link" href="{{ route('service.index') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('service.upload') }}">Upload Document</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('service.receive') }}">Received Documents</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('service.archive') }}">Archive</a></li>
        @else
            <p>No sidebar available for this role.</p>
        @endif
    </ul>
</div>
