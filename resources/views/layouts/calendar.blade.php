<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendar</title>
    
    <!-- Chemin vers le fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}" />
    
    <!-- Chemin vers le fichier JavaScript -->
    <script src="{{ asset('js/calendar.js') }}" defer></script>
    
  
  </head>
  <body>
    <div class="calendar">
      <header>
        <h3></h3>
        <nav>
          <button id="prev"></button>
          <button id="next"></button>
        </nav>
      </header>
      <section>
        <ul class="days">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>
        <ul class="dates"></ul>
      </section>
    </div>
  </body>
</html>
