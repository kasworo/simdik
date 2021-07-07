<?php
	session_start();
	if(!isset($_SESSION['login'])){header("Location: login.php");exit;}
	include "dbfunction.php";
	$u=viewdata("tbuser","username",$_COOKIE['id'])[0];
	$nmuser=$u['nama'];
	$level=$u['level'];
	$foto='';
	if($level=='1'){
		$navigasi='<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="logout.php" title="Keluar / Logout">
					<i class="fas fa-power-off"></i>
				</a>
			</li>
		</ul>';
	}
	if($foto=='' || $foto==null){
		$fotouser='assets/img/avatar.gif';
	}
	else{
		if(file_exists('foto/'.$foto)){
			$fotouser='foto/'.$foto;
		}
		else{
			$fotouser='assets/img/avatar.gif';
		}
	}
	$tp=viewdata("tbthpel", "aktif",'1')[0];
	setcookie('c_tahun', $tp['idthpel'],time()+3600);
	$tapel=$tp['desthpel'];	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Aplikasi SIMAK</title>
	<link href='assets/img/tutwuri.png' rel='icon' type='image/png'/>
	<link rel="stylesheet" href="assets/css/all.min.css">
	<link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="assets/css/adminlte.min.css">
	<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.datetimepicker.css"> 
	<link rel="stylesheet" type="text/css" href="assets/css/dropzone.css"/>
	<script type="text/javascript" src="assets/js/dropzone.js"></script>
	<script type="text/javascript" src="assets/js/jquery-1.4.js"></script>
	<script type="text/javascript" src="assets/js/ajaxupload.3.5.js" ></script>
	<script type="text/javascript">
		$(document).ready(function () {
			toastr.options = {
				"closeButton": false,
				"positionClass": "toast-top-center",
				"preventDuplicates":true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "1000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}	
			bsCustomFileInput.init();
		});
	</script>
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
	<div class="modal fade" id="myPassword" aria-modal="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">Ganti Password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="col-sm-10 offset-sm-1">
							<div class="form-group mb-2">
								<label >Password Lama</label>
								<input type="password" class="form-control input-sm" id="passlama" name="passlama">
							</div>
							<div class="form-group mb-2">
								<label >Password Baru</label>
								<input type="password" class="form-control input-sm" id="passbaru" name="passbaru">
							</div>
							<div class="form-group mb-2">
								<label >Konfirmasi Password</label>
								<input type="password" class="form-control input-sm" id="passkonf" name="passkonf">
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="submit" class="btn btn-primary btn-md btn-flat" id="gantipass">
							<i class="fas fa-save"></i> Update
						</button>
						<button type="button" class="btn btn-danger btn-md btn-flat" data-dismiss="modal">
							<i class="fas fa-power-off"></i> Tutup
						</button>
					</div>
			</div>
		</div>
	</div>
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button">
						<i class="fas fa-bars"></i>
					</a>
				</li>
			</ul>
			<?php echo $navigasi;?>
		</nav>
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="index.php?p=dashboard" class="brand-link" title="Sistem Informasi Akademik">
				<img src="assets/img/logo.png" width="100" class="brand-image elevation-3" style="opacity: 1.0">
				<span class="brand-text font-weight-light">Aplikasi SIMAK</span>
			</a>
			<div class="sidebar">
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo $fotouser;?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block"><?php echo $nmuser;?></a>
					</div>
				</div>
				<?php include "sidemenu.php";?>
			</div>
		</aside>
		<div class="content-wrapper">
			<?php
				switch ($_GET['p']){
					case 'dashboard' : {
						$judul='Selamat Datang';
						$tautan='index.php?p=dashboard';
						$menu='Home';
						$submenu='Dashboard';
						$stat0='';
						$stat1='';
						$stat2='';
						break;
					}
					case 'datasekolah' : {
						$judul='Identitas Satuan Pendidikan';
						$tautan='index.php?p=datasekolah';
						$menu='Data Master';
						$submenu='Identitas Sekolah';
						$stat0='active';
						$stat1='';
						$stat2='';
						break;
					}
					case 'datauser' : {
						$judul='Informasi Data Pengguna';
						$tautan='index.php?p=datauser';
						$menu='Data Master';
						$submenu='Data Pengguna';
						$stat0='active';
						$stat1='';
						$stat2='';
						break;
					}

					case 'datakur' : {
						$judul='Informasi Kurikulum';
						$tautan='index.php?p=datakur';
						$menu='Data Master';
						$submenu='Data Kurikulum';
						$stat0='active';
						$stat1='';
						$stat2='';
						break;
					}
					case 'datakelas' : {
						$judul='Informasi Rombongan Belajar';
						$tautan='index.php?p=datakelas';
						$menu='Manajamen KBM';
						$submenu='Data Rombel';
						$stat0='';
						$stat1='active';
						$stat2='';
						break;
					}
					case 'datates' : {
						$judul='Informasi Jenis Tes';
						$tautan='index.php?p=datates';
						$menu='Manajamen Tes';
						$submenu='Jenis Tes';
						$stat0='';
						$stat1='';
						$stat2='active';
						break;
					}
					case 'banksoal' : {
						$judul='Informasi Bank Soal';
						$tautan='index.php?p=banksoal';
						$menu='Manajamen Tes';
						$submenu='Bank Soal Tes';
						$stat0='';
						$stat1='';
						$stat2='active';
						break;
					}
					default:{
						$judul='Selamat Datang';
						$tautan='index.php?p=dashboard';
						$menu='Home';
						$submenu='Dashboard';
						$stat0='';
						$stat1='';
						break;
					}
				}
			?>
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark"><?php echo $judul;?></h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo $tautan;?>"><?php echo $menu;?></a></li>
								<li class="breadcrumb-item active"><?php echo $submenu;?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="form-group">
						<?php
							if($level=='1'){
								switch ($_GET['p']){
									case 'refpddk' :{include "refpddk_tampil.php";break;}
									case 'refkerja' :{include "refkerja_tampil.php";break;}
									case 'refskul' :{include "refskul_tampil.php";break;}
									case 'dashboard' : {include "dashboard.php";break;}
									case 'datasekolah' : {include "sekolah_tampil.php";break;}
									case 'datauser' : {include "user_tampil.php";break;}
									case 'datakur' : {include "kurikulum_tampil.php";break;}
									case 'datamapel' : {include "mapel_tampil.php";break;}
									case 'datagtk' : {include "gtk_tampil.php";break;}
									case 'addgtk': {include "gtk_form.php";break;}
									
									case 'datasiswa' : {include "siswa_tampil.php";break;}									
									case 'addsiswa' : {include "siswa_form.php";break;}
									case 'addriwayat' : {include "siswa_riwayat.php";break;}
									case 'addayah' : {include "siswa_ayah.php";break;}									
									case 'addibu' : {include "siswa_ibu.php";break;}
									case 'eksporsiswa' : {include "siswa_ekspor.php";break;}
									case 'addrombel' : {include "form_rombel.php";break;}
									case 'regissiswa' : {include "rombel_tampil.php";break;}

									case 'kompetensi' : {include "kompetensi_tampil.php";break;}

									case 'datarapor' : {include "rapor_tampil.php";break;}
									case 'inputsikap' : {include "rapor_sikap.php";break;}
									case 'inputkognetif' : {include "rapor_kognetif.php";break;}
									case 'inputterampil' : {include "rapor_motorik.php";break;}
									case 'nilaieksim' :{include "rapor_ekspor.php";break;}
									
									case 'datakelas' : {include "kelas_tampil.php";break;}
									case 'dataampu' : {include "pengampu_tampil.php";break;}
									case 'datarombel' : {include "rombel_tampil.php";break;}
									case 'datakkm' : {include "kkm_tampil.php";break;}
									case 'cetakbinduk' : {include "view_binduk.php";break;}
									
									default:{include "dashboard.php";break;}
								}
							}
						?>			
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer text-sm">
			<strong>Copyright &copy;</strong> Kasworo Wardani, Template By <a href="http://adminlte.io">AdminLTE.io</a>.
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>SIMAK Versi</b> 1.0.0
			</div>
		</footer>
	</div>
	<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#goleki").click(function(){
				var cari=$("#dicari").val();
				if(cari==null || cari=='' || cari==' '){
					toastr.error('Tidak Boleh Kosong!');	
				}
				else {
					$.ajax({
						type:"POST",
						url:"calsis_cari.php",
						data: "cari="+cari,
						success:function(data)
						{
							if(data==1){
								window.location.href='index.php?p=addsiswa&m=2&id='+cari;
							}
							else {
								toastr.error('Data Tidak Ada');	
							}
						}	
					})
				}
			})
			$("#gantipass").click(function(){
				var passlama=$("#passlama").val();
				var passbaru=$("#passbaru").val();
				var passkonf=$("#passkonf").val();
				var id="<?php echo $_COOKIE['c_user'];?>";
				if(passlama==''){
					toastr.error('Password Lama Tidak Boleh Kosong');
					$("#passbaru").focus();
				}
				else if(passkonf!==passbaru){
					toastr.error('Password Tidak Sama');
					$("#passbaru").focus();
				}
				$.ajax({
					type:"POST",
					url:"user_simpan.php",
					data: "aksi=pass&id="+id+"&passbaru="+passbaru,
					success:function(data){
						toastr.success(data)
					}	
				})	
			})		
		})
	</script>
	
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/adminlte.min.js"></script>
	<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="assets/plugins/toastr/toastr.min.js"></script>
	<script src="assets/plugins/select2/js/select2.full.min.js"></script>
	<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<script src="assets/js/jquery.datetimepicker.full.js"></script>
	<script src="assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
	<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
</body>
</html>
