<?php
	session_start();
	include "config/konfigurasi.php";
	include "config/function_user.php";
	if(isset($_COOKIE['id'],$_COOKIE['key'])){
		$id=$_COOKIE['id'];
		$key=$_COOKIE['key'];
		$sql = $conn->query("SELECT username, passwd FROM tbuser WHERE username = '$id'");
		$data=$sql->fetch_assoc();
		if($key===hash('sha256',$data['passwd'])){
			$_SESSION['login']=true;
		}
	}

	if(isset($_SESSION['login'])){
		header("Location: index.php?p=dashboard");
		exit;
	}
	
	if(isset($_POST['login'])){
		$user=$conn->real_escape_string($_POST['user']);
		$pass=$_POST['pass'];
		$sql = $conn->query("SELECT username, passwd FROM tbuser WHERE username = '$user'");
		if($sql->num_rows===1){
			$data=$sql->fetch_assoc();
			if(password_verify($pass, $data['passwd'])){
				$_SESSION['login']=true;
				setcookie('id',$data['username'],time()+3600);
				$qskul=$conn->query("SELECT idskul FROM tbskul");
				$sk=$qskul->fetch_assoc();
				setcookie('kdskul',hash('sha256',$sk['kdskul']), time()+3600);
				
				if(isset($_POST['ingat'])){					
					setcookie('key',hash('sha256',$data['passwd']),time()+3600);
				}
				header("Location:index.php?p=dashboard");
				exit;
			}
		}
		$error=true;
	}

	
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi SIMAK</title>
    <link href='assets/img/tutwuri.png' rel='icon' type='image/png' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="background:url(assets/img/boxed-bg.png)">
    <?php 
	$admin="SELECT*FROM tbuser WHERE level='1'";
	if(cekuser($admin)===0):?>
    <div class="register-box">
        <div class="register-logo">
            <span><b>Selamat Datang</b></span>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Silahkan Isikan Data Administrator</p>
                <form action="" method="post" role="form" id="FrmRegistrasi">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="user" id="user" placeholder="Username"
                                autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="password" class="form-control" name="paswd" id="paswd" placeholder="Password"
                                autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-eye"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <div class="input-group">
                            <input type="password" class="form-control" name="conf" id="conf" placeholder="Password"
                                autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-eye"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" name="regis" class="btn btn-primary btn-block col-5">
                            <i class="far fa-check-square"></i>&nbsp;Registrasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/toastr/toastr.min.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/adminlte.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        toastr.options = {
            "closeButton": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": true,
            "onclick": null,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    })
    </script>
    <?php
	if(isset($_POST['regis'])){
		if(addadmin($_POST)>0){
			echo "<script>
                    $(function() {
                        toastr.success('Administrator Berhasil Ditambahkan!','Terima Kasih...',{
                            timeOut:1000,
                            fadeOut:1000,
                            onHidden:function(){
                                this.location.reload();
                            }
                        });
                    });
                </script>";
		}
		else {
			mysqli_error($conn);
		}

	}
	?>
    <?php else: ?>
    <div class="login-box">
        <div class="login-logo">
            <b>Aplikasi SIMAK</b><br />
            <p style="font-size:16pt">(Sistem Informasi Akademik)</p>
        </div>
        <form action="" method="post" id="FrmLogin">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Selamat Datang<br />Silahkan Login Terlebih Dahulu</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="user" name="user" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <style>
                    #viewpass:hover {
                        cursor: pointer;
                    }
                    </style>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-eye" title="Tampilkan Password" id="viewpass"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-8">
                            <div class="icheck-primary mb-3">
                                <input type="checkbox" id="ingat" name="ingat">
                                <label for="ingat">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-block mb-3" id="login" name="login">
                                <i class="fas fa-sign-in-alt"></i>&nbsp;Login
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/toastr/toastr.min.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/adminlte.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#viewpass").click(function() {
            var x = $("#pass").attr('type');
            if (x === 'password') {
                $(this).removeClass("fas fa-eye");
                $(this).addClass("fas fa-eye-slash");
                $(this).attr("title", "Sembunyikan Password");
                $("#pass").attr('type', 'text');
            } else {
                $(this).removeClass("fas fa-eye-slash");
                $(this).attr("title", "Tampilkan Password");
                $(this).addClass("fas fa-eye");
                $("#pass").attr('type', 'password');
            }
        })
    })
    </script>
    <?php if($error) {
		echo "<script>
				$(function() {
					toastr.error('Cek Username dan Password Anda!','Mohon Maaf',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							$('#user').focus();
						}
					});
				});
			</script>";
	}
	?>
    <?php endif ?>
</body>

</html>