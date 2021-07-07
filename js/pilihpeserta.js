var ajaxku;
function pilrombel(id){
    ajaxku = buatajax();
    var url="rombel_getid.php";
    url=url+"?k="+id;
    ajaxku.onreadystatechange=levChanged;
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
    document.getElementById("pstrmb").innerHTML = data
    }else{
    document.getElementById("pstrmb").value = "<option selected>..Pilih..</option>";
    }
    }
}