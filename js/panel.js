function PlaylistSelection(){
    document.getElementById('greybackground').style.display="block"
    document.getElementById('choosePL').style.display="block"
}

function ClosePlaylistSelection(){
    document.getElementById('greybackground').style.display="none"
    document.getElementById('choosePL').style.display="none"
}


function editPlaylist(id){
    document.getElementById('editPl').style.display="block";
    document.getElementById('greybackground').style.display="block"
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;
            const div = document.getElementById('PlListEditor');
            div.innerHTML = data;
            document.getElementById('changeDateButton').setAttribute("onclick", "changeDate("+id+")");


        }
    };
    req.open('GET', '../php/getMusicFromPl.php?id='+id);
    req.send();
}



function removeFromPl(id,idPl){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            let music = document.getElementById('music_'+id+'+'+idPl);
            const data = req.response;
            const div = document.getElementById('test');
            div.innerHTML = data;
            music.remove();
        }
    };
    req.open('GET', '../php/rmMusicFromPl.php?id='+id+'&idPl='+idPl);
    req.send();
}

function removePlaylist(idPl){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            let playlist = document.getElementById('playlist'+idPl);
            playlist.remove();
        }
    };
    req.open('GET', '../php/deletePlaylist.php?idPl='+idPl);
    req.send();
}

function closePledit(){
    document.getElementById('greybackground').style.display="none"
    document.getElementById('editPl').style.display="none"
}

function emptyPlAlert(){
    alert('You have to define all your music before modifying your playlist')
}

function changeDate(id){
    let date = document.getElementById('changeDate_'+id).value
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;

            if(data =='ok'){
                window.location="../admin/panel.php"
            }else{
                const div = document.getElementById('ajaxResponse');
                div.innerHTML = data;}




        }
    };
    req.open('GET', '../php/changeDate.php?idPl='+id+'&date='+date);
    req.send();
}

function showPlanning(){
    document.getElementById('calendar').style.transform="translateX(0%)"
}

function hidePlanning(){
    document.getElementById('calendar').style.transform="translateX(-100%)"

}

//Full calendar for planning visualisation
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        customButtons: {
            myCustomButton: {
                text: 'Close!',
                click: function() {
                    hidePlanning();
                }
            }
        },
        headerToolbar: { center: 'dayGridMonth,timeGridWeek,list', left: 'myCustomButton' }, // buttons for switching between views
        initialView: 'timeGridWeek',
        locale: 'fr',
        events: '../php/getEvents.php',
        contentHeight: 600,





    });
    calendar.render();
});