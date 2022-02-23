
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

function goAdmin(id){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
        const data = req.response
            location.reload()

        }
    };
    req.open('GET', '../php/goAdmin.php?id='+id+'&method=0');
    req.send();
}

function goUnAdmin(id){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.response
            location.reload()

        }
    };
    req.open('GET', '../php/goAdmin.php?id='+id+'&method=1');
    req.send();
}