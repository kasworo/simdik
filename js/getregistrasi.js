var ajaxku;

function piltahun(id) {
    ajaxku = buatajax();
    var url = "siswa_getregistrasi.php";
    url = url + "?tp=" + id;
    ajaxku.onreadystatechange = ThPelChanged;
    ajaxku.open("GET", url, true);
    ajaxku.send(null);
}

function buatajax() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}

function ThPelChanged() {
    var data;
    if (ajaxku.readyState == 4) {
        data = ajaxku.responseText;
        if (data.length >= 0) {
            document.getElementById("idreg").removeAttribute('disabled');
            document.getElementById("idreg").innerHTML = data;
        } else {
            document.getElementById("idreg").value = "<option selected>..Pilih..</option>";
        }
    }
}