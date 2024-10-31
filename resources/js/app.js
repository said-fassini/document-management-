import './bootstrap';
import '@fullcalendar/core/main.css'; // FullCalendar CSS
import '@fullcalendar/daygrid/main.css'; // DayGrid plugin CSS
import { Calendar } from '@fullcalendar/core'; // FullCalendar Core
import dayGridPlugin from '@fullcalendar/daygrid'; // DayGrid plugin

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin], // Register plugins
        initialView: 'dayGridMonth', // Initial view
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            {
                title: 'New Document Received',
                start: '2024-10-30'
            },
            {
                title: 'Follow-up Meeting',
                start: '2024-11-02'
            }
        ]
    });

    calendar.render(); // Render the calendar
});
