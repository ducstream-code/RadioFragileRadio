function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


function PlaylistSelection(){
    document.getElementById('greybackground').style.display="block"
    document.getElementById('choosePL').style.display="block"
}

function ClosePlaylistSelection(){
    document.getElementById('greybackground').style.display="none"
    document.getElementById('choosePL').style.display="none"
}

function Upload1music(){

let uploadButton = document.getElementById('upload1button')



    var myTitle = document.getElementById('uploadTitle')
    var myArtist = document.getElementById('uploadArtist')
    var myAlbum = document.getElementById('uploadAlbum')
    var myYear = document.getElementById('uploadYear')
    var myGenre = document.getElementById('uploadType')
    var myFile = document.getElementById('uploadFile')
    uploadButton.innerHTML = 'Uploading...';

    // Get the files from the form input
    var files = myFile.files;
    var title = myTitle.value
    var artist = myArtist.value
    var album = myAlbum.value
    var year = myYear.value
    var genre = myGenre.value


    // Create a FormData object
    var formData = new FormData();

    // Select only the first file from the input array
    var file = files[0];


    // Add the file to the AJAX request
    formData.append('titleAjax', title);
    formData.append('artistAjax', artist);
    formData.append('albumAjax', album);
    formData.append('yearAjax', year);
    formData.append('genreAjax', genre);
    formData.append('fileAjax', file);

    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;
            const div = document.getElementById('testReturn');
            uploadButton.innerHTML = 'Upload another ?';

            div.innerHTML = data;

        }
    };
    req.open('POST', '../php/Upload1Music.php');
    req.send(formData);

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
