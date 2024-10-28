{{-- resources/views/president/create_user.blade.php --}}
@extends('layouts.app')

@section('content')

    <h1>Create User</h1>

    <form action="{{ route('president.storeUser') }}" method="POST" class="user-form"> {{-- Adjust the action route as necessary --}}
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group password-container">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required class="password-input">
            <span class="toggle-password" onclick="togglePasswordVisibility()">🙈</span> {{-- Closed eye icon to indicate hidden password --}}
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="service">Service</option>
                <option value="director">Director</option>
                <option value="admin">bereau dorer</option>
            </select>
        </div>
        <button type="submit" class="submit-button">Create User</button>
    </form>

@endsection

@section('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password');

        // Toggle the password visibility
        if (passwordInput.type === "password") {
            passwordInput.type = "text"; // Show password
            toggleIcon.innerHTML = "👁️"; // Open eye icon to indicate visibility
        } else {
            passwordInput.type = "password"; // Hide password
            toggleIcon.innerHTML = "🙈"; // Closed eye icon to indicate hidden
        }
    }
</script>
@endsection

<style>
    body {
        background-color: #ecf0f1; /* Light background color for the entire page */
        font-family: 'Arial', sans-serif; /* Font style for the page */
    }

    .user-form {
        max-width: 400px; /* Maximum width of the form */
        margin: 0 auto; /* Center the form */
        padding: 20px; /* Padding inside the form */
        border-radius: 12px; /* Rounded corners */
        background: linear-gradient(135deg, #3498db, #2ecc71); /* Gradient background */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Shadow for depth */
        animation: fadeIn 0.8s ease-in-out; /* Animation for form appearance */
        border: 1px solid #2980b9; /* Border color */
    }

    .form-group {
        margin-bottom: 20px; /* Spacing between form groups */
    }

    label {
        display: block; /* Labels on a new line */
        margin-bottom: 8px; /* Spacing below labels */
        font-weight: bold; /* Bold labels */
        color: #fff; /* White color for labels */
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%; /* Full width for inputs */
        padding: 12px; /* Padding inside inputs */
        border: none; /* Remove default border */
        border-radius: 4px; /* Rounded corners */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for inputs */
        transition: all 0.3s ease; /* Smooth transition for border color */
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    select:focus {
        box-shadow: 0 0 5px #2ecc71; /* Glow effect on focus */
        outline: none; /* Remove default outline */
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
        background-color: #e74c3c; /* Button color */
        color: #fff; /* Text color */
        border: none; /* Remove default border */
        border-radius: 4px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        transition: background-color 0.3s, transform 0.3s; /* Smooth transition for background color */
        animation: pulse 1s infinite; /* Animation for the button */
        font-size: 16px; /* Button text size */
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
