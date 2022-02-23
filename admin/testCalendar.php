<?php
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <? include '../includes/head.php'?>

    <script>


        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek'
            });
            calendar.render();
        });

    </script>
</head>
<body style="height: 500px !important;">
<div id='calendar'></div>
</body>
</html>
