var ajaxku;
function buatajax(){
    if (window.XMLHttpRequest){
    return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}
function getlev(id){
    ajaxku = buatajax();
    var url="user_getid.php?lev="+id;
    ajaxku.onreadystatechange=setlevChanged;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function setlevChanged(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
        document.getElementById("setname").innerHTML = data;
        document.getElementById("setname").removeAttribute('disabled');
    }else{
    document.getElementById("setname").value = "<option selected>..Pilih..</option>";
    }
    }
}

function getname(id){
    ajaxku = buatajax();
    var url="user_setid.php?id="+id;
    ajaxku.onreadystatechange=setnameChanged;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function setnameChanged(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>=0){
            document.getElementById("setuser").value = data;
        } else{
        document.getElementById("setuser").value = "Cek Lagi";
        }
    }
}