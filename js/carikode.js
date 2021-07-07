var ajaxku;
function getrayon(id){
	ajaxku = buatajax();
	var url="getidskul.php";
	url=url+"?p="+id;
	ajaxku.onreadystatechange=provChanged;
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

function provChanged(){
	var data;
	if (ajaxku.readyState==4){
	data=ajaxku.responseText;
	if(data.length>=0){
		document.getElementById("rayon").innerHTML = data
	}else{
	document.getElementById("rayon").value = "<option selected>..Pilih..</option>";
	}
	}
}
