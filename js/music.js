let page = 30
let pos = 0
let musicList =[]

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function f() {
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            page+=30
            fetchMusic()
        }
    });
}
setTimeout(f,500)

function fetchMusic(){

    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;
            const div = document.getElementById('table_body');
            div.innerHTML = data;
        }
    };
    req.open('GET', '../php/getMusic.php?limit='+page);
    req.send();
}

function getIdMusic(id){

    musicList.splice(pos,0,id)
    pos+=1
    console.log(musicList)
    console.log(pos)
    document.getElementById(id).setAttribute("onChange", "removeElement(id)");
}

function removeElement(id){
    let value = musicList.indexOf(id);

    musicList.splice(value, 1); // 2nd parameter means remove one item only
    pos+=1
    document.getElementById(id).setAttribute("onChange", "getIdMusic(id)");
    console.log(musicList)

}

function createPlaylist(){
    let PLselector = document.getElementById('PLselect')
    let idPL = PLselector.value;
    console.log(idPL)
    let numberArray = musicList.map(Number);
    let list = JSON.stringify(numberArray)
    let date = document.getElementById('changeDate').value
    console.log(JSON.stringify(numberArray))

    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;
            if (data == 'ok'){
                window.location="../admin/panel.php"
            }else {

                const div = document.getElementById('createPlResponse');
                div.innerHTML = data;
            }
            //ClosePlaylistSelection()
            //window.location='../admin/index.php'
        }
    };
    req.open('GET', '../php/createPlaylist.php?idPL='+idPL+'&list='+list+'&date='+date);
    req.send();

}

function PlaylistSelection(){
    document.getElementById('greybackground').style.display="block"
    document.getElementById('choosePL').style.display="block"
}

function ClosePlaylistSelection(){
    document.getElementById('greybackground').style.display="none"
    document.getElementById('choosePL').style.display="none"
}
//var numberArray = musicList.map(Number); transforme l'entièreté du tableau en int si il y a des strings dedans

function getMusicInList(){

    document.getElementById('musicList').style.display="block";

    let numberArray = musicList.map(Number);
    let list = JSON.stringify(numberArray)
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;
            const div = document.getElementById('musicList')
            div.innerHTML = data;

        }
    };
    req.open('GET', '../php/displayList.php?list='+list);
    req.send();
}

function removeMusicFromList(id){
    const checkbox = document.getElementById(id);
    document.getElementById(id).checked = false
    let value = musicList.indexOf(id);
    const listElement = document.getElementById('list_'+id);
    listElement.remove();
    musicList.splice(value, 1); // 2nd parameter means remove one item only
    pos+=1
    checkbox.setAttribute("onChange", "getIdMusic(id)");
}



function translateElement(){
    document.getElementById('sliderMain').style.transform="translateX(0px)"
}

function translateElement100(){
    document.getElementById('sliderMain').style.transform="translateX(100%)"
}

function showSlideOver(){
    document.getElementById('slidershowcontainer').style.display='block'
    setTimeout(translateElement,100);

    document.getElementById('body').style.overflow='hidden';
}
function hideSlideOver(){
    setTimeout(translateElement100,0);
    sleep(500).then(() => {
        document.getElementById('slidershowcontainer').style.display='none'

    });
    document.getElementById('body').style.overflow='auto';
}

function searchMusic(search){
    const div = document.getElementById('searchResults')
    if (search.length > 0) {
        const req = new XMLHttpRequest();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                const data = req.response;
                div.innerHTML = data;
            }
        };
        req.open('GET', '../php/musicSearch.php?search=' + search);
        req.send();
    }else{div.innerHTML=""}
}








function showPlanning(){
    document.getElementById('calendar').style.transform="translateX(0%)"
}

function hidePlanning(){
    document.getElementById('calendar').style.transform="translateX(-100%)"

}

//Full calendat for planning visualisation
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
