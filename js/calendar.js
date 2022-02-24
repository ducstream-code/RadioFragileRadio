document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: { center: 'dayGridMonth,timeGridWeek,list' }, // buttons for switching between views
        initialView: 'timeGridWeek',
        locale: 'fr',
        events: '../php/getEvents.php',
        contentHeight: 800,



    });
    calendar.render();
});