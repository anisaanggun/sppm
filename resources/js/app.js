import './bootstrap';
import FullCalendar from 'fullcalendar';
import 'fullcalendar/dist/fullcalendar.css';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        // Konfigurasi FullCalendar di sini
    });
    calendar.render();
});
