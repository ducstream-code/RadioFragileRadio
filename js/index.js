function PlaylistSelection(){
    document.getElementById('greybackground').style.display="block"
    document.getElementById('choosePL').style.display="block"
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
            music.remove();
        }
    };
    req.open('GET', '../php/rmMusicFromPl.php?id='+id+'&idPl='+idPl);
    req.send();
}

function changeDate(idPl){
    let date = document.getElementById('changeDate').value
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            location.reload()
        }
    };
    req.open('GET', '../php/changeDate.php?idPl='+idPl+'&date='+date);
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
