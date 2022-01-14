var ajaxku;
function getthpel(id){
    ajaxku = buatajax();
    var url="rapor_getkls.php";
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
            $("#pilih").removeAttr('disabled');
            $("#txtThpel").removeAttr('disabled');
            $("#txtThpel").html(data);            
        } else {
            $("#txtThpel").html("<option selected>..Pilih..</option>");
        }
    }
}