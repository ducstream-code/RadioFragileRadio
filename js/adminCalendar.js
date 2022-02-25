document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        eventClick: function(info) {
            let id = info.event.id
            console.log(id)
            document.getElementById('editPl').style.display="block";
            document.getElementById('greybackground').style.display="block"
            const req = new XMLHttpRequest();
            req.onreadystatechange = function()  {
                if(req.readyState === 4 ){
                    const data = req.response;
                    const div = document.getElementById('PlListEditor');
                    div.innerHTML = data;


                }
            };
            req.open('GET', '../php/getMusicFromPl.php?id='+id);
            req.send();







            // change the border color just for fun
            info.el.style.borderColor = 'red';
        },
        headerToolbar: { center: 'dayGridMonth,timeGridWeek,list' }, // buttons for switching between views
        initialView: 'timeGridWeek',
        locale: 'fr',
        events: '../php/getEvents.php',
        width:1000,
        height: 800,




    });
    calendar.render();
});
