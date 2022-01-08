<?php 
session_start();
$_SESSION=[];
session_unset();
session_destroy();
setcookie('id','',time()-3600);
setcookie('key','',time()-3600);
// unset($_COOKIE['id']);
// unset($_COOKIE['key']);
header('location:login.php');

?>
<script>
function disableBackButton() {
    window.history.forward();
}
setTimeout("disableBackButton()", 0);
</script>