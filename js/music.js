let page = 30
let pos = 0
let musicList =[]


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
    let numberArray = musicList.map(Number);
    let list = JSON.stringify(numberArray)
    console.log(JSON.stringify(numberArray))

    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;
            const div = document.getElementById('test');
            div.innerHTML = data;
            ClosePlaylistSelection()
            window.location='../admin/index.php'
        }
    };
    req.open('GET', '../php/createPlaylist.php?idPL='+idPL+'&list='+list);
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
