<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>

    <!-- Chemin vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">
</head>
<body>
    <div class="container">
        <h1>ToDo List</h1>
        <form class="todo-form">
            <input type="text" id="todoInput" placeholder="What's the plan today?" />
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
            </button>
        </form>
        <div id="statusText"></div>
        <ul id="todoList"></ul>
    </div>

    <!-- Chemin vers le fichier JavaScript -->
    <script src="{{ asset('js/todo.js') }}"></script>
</body>
</html>
