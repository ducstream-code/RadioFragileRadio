
function deleteAccount(id){

    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response;
            const div = document.getElementById('acc_'+id);
            div.remove();

        }
    };
    req.open('GET', '../php/deleteAccount.php?id='+id);
    req.send();
}
