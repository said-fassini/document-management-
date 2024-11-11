{{-- resources/views/service/upload.blade.php --}}
@extends('layouts.app')

@section('content')
<style>


.user-form {
    background-color:#ffffff83;
    max-width: 500px; /* Maximum width of the form */
    margin: 0 auto; /* Center the form */
    padding: 10px; /* Padding inside the form */
    border-radius: 12px; /* Rounded corners */
    border:none  ; /* Gradient background */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Shadow for depth */
    animation: fadeIn 0.8s ease-in-out; /* Animation for form appearance */

    display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
}

.form-group {
    margin: 30px; /* Spacing between form groups */
}

label {
    display: block; /* Labels on a new line */
    margin-bottom: 8px; /* Spacing below labels */
    font-weight: bold; /* Bold labels */
    font-size: 18px;
    color: rgb(65, 68, 108) ; /* White color for labels */
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    
    width: 400px;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-bottom: 1px solid #ccc; /* Adjust the border color as needed */
    background-color: transparent;
    outline: none;
}


input:focus {
    border: none;
    background-color: transparent;
border-color: blue;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}


.password-container {
    position: relative; /* Positioning for the eye icon */
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 10px; /* Position the icon to the right */
    transform: translateY(-50%); /* Center the icon vertically */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 24px; /* Icon size */
    transition: color 0.3s; /* Smooth transition for color change */
    color: #fff; /* Color of the icon */
}

.toggle-password:hover {
    color: #2ecc71; /* Change color on hover */
}

.submit-button {
    padding: 12px 20px; /* Padding for the button */
    background-color: #2a5298; /* Button color */
    color: #fff; /* Text color */
    border: none; /* Remove default border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transition for background color */
    font-size: 16px; /* Button text size */
    display: flex;
        justify-content: center;
        align-items: center;
}

.submit-button:hover {
    background-color: #c0392b; /* Darker color on hover */
    transform: scale(1.05); /* Slightly enlarge on hover */
}

@keyframes fadeIn {
    from {
        opacity: 0; /* Start transparent */
        transform: translateY(20px); /* Slide in from below */
    }
    to {
        opacity: 1; /* Fully visible */
        transform: translateY(0); /* Original position */
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1); /* Slightly enlarge */
    }
    100% {
        transform: scale(1);
    }
}
</style>
<div class="container">
    <h1>Upload Document</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="user-form">
        <form action="{{ route('service.upload.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ now()->format('Ymd') }}-{{ Auth::id() }}" readonly>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="receiver_id">Select Receiver</label>
                <select name="receiver_id" id="receiver_id">
                    @foreach ($receivers as $receiver)
                        <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="file">Upload Document</label>
                <input type="file" name="file" id="file">
            </div>

            <button type="submit" class="submit-button">Send Document</button>
        </form>
    </div>
</div>
@endsection
