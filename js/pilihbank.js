var ajaxku;
function pilkelas(id){
    ajaxku = buatajax();
    var url="banksoal_guru.php";
    url=url+"?k="+id;
    ajaxku.onreadystatechange=levChanged;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function pilmapel(id){
    ajaxku = buatajax();
    var url="banksoal_guru.php";
    url=url+"?m="+id;
    ajaxku.onreadystatechange=mapelChanged;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}


function buatajax(){
    if (window.XMLHttpRequest){
    return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
    return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}

function levChanged(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
    document.getElementById("idmapel").innerHTML = data
    }else{
    document.getElementById("idmapel").value = "<option selected>..Pilih..</option>";
    }
    }
}

function mapelChanged(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
    document.getElementById("idguru").innerHTML = data
    }else{
    document.getElementById("idguru").value = "<option selected>..Pilih..</option>";
    }
    }
}