


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('president.sidebar')
    <style>
 /* resources/css/dashboard.css */

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #2b2b36; /* Dark background */
    background: linear-gradient(to bottom, #2b2b36, #1d1d26); /* Dark gradient */
    color: #dcdcdc; /* Light text for contrast */
}

.sidebar {
    background-color: #2a3b4d; /* Cool dark blue for sidebar */
    color: white;
    width: 200px;
    height: 100vh;
    position: fixed;
    transition: width 0.3s ease, background-color 0.5s ease, transform 0.5s ease; 
    overflow: hidden;
    transform: translateX(-200px); /* Start hidden */
    animation: slideIn 0.5s forwards; /* Slide in animation */
}

.sidebar h2 {
    text-align: center;
    padding: 15px 0;
    font-size: 24px; /* Increased font size for header */
    color: #ffffff; /* Light text */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Added text shadow for depth */
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 20px 0;
    text-align: center;
}

.sidebar ul li a {
    color: #dcdcdc; /* Light text */
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 10px 15px; /* Added padding for better click area */
    transition: background-color 0.3s, transform 0.3s; /* Added transform transition */
}

.sidebar ul li a:hover {
    background-color: #4c6b8f; /* Lighter blue on hover */
    transform: scale(1.05);
}

.content {
    margin-left: 220px; /* Space for sidebar */
    padding: 20px;
    background-color: #2b2b36; /* Matching background */
}

.header {
    display: flex;
    justify-content: flex-start;
    background-color: #2a3b4d; /* Dark blue header */
    padding: 10px;
}

.logout-button {
    background-color: #3d5b7c; /* Darker teal button */
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.logout-button:hover {
    background-color: #66a2c1; /* Lighter teal on hover */
    transform: scale(1.05);
}

h1, h2 {
    color: #ffffff; /* Light text */
    transition: color 0.3s ease;
}

h1:hover, h2:hover {
    color: #66a2c1; /* Accent color on hover */
}

/* Animations */
@keyframes slideIn {
    from {
        transform: translateX(-200px); /* Start hidden */
    }
    to {
        transform: translateX(0); /* Slide in to visible */
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.content {
    animation: fadeIn 0.5s ease-in-out;
}

.card {
    background: #1e1e2f; /* Dark card background */
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4); /* Stronger shadow for dark theme */
    margin: 15px 0;
    padding: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: #dcdcdc; /* Light text */
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Deeper shadow on hover */
}

/* Google Chart styles (if used) */
.chart {
    width: 100%;
    height: 400px;
}

.latest-users-cards {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.latest-users-cards .card {
    flex: 1;
    margin: 10px;
    padding: 20px;
    background-color: #252533; /* Darker card */
    border: 1px solid #333; /* Darker border */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: #ffffff; /* Light text */
}

.latest-users-cards .card:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6); /* Deeper shadow on hover */
}

    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <button class="logout-button">Logout</button>
        </div>
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>