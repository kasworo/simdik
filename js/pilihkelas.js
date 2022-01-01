var ajaxku;
function pilkelas(id){
    ajaxku = buatajax();
    var url="siswa_kelas.php";
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
            document.getElementById("idreg").removeAttribute('disabled'); 
            document.getElementById("idreg").innerHTML = data;            
        } else {
            document.getElementById("idreg").value = "<option selected>..Pilih..</option>";
        }
    }
}