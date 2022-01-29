<?php
	$sk=viewdata("tbskul")[0];
	if($sk['logoskul']=='' || $sk['logoskul']==null){
		$logoskul='assets/img/avatar.gif';
	}
	else{
		if(file_exists('images/'.$sk['logoskul'])){
			$logoskul='images/'.$sk['logoskul'];
		}
		else{
			$logoskul='assets/img/avatar.gif';
		}
	}
		
		if($sk['logoskpd']=='' || $sk['logoskpd']==null){
		$logoskpd='assets/img/avatar.gif';
	}
	else{
		if(file_exists('images/'.$sk['logoskpd'])){
			$logoskpd='images/'.$sk['logoskpd'];
		}
		else{
			$logoskpd='assets/img/avatar.gif';
		}
	}
	if($level=='1'):
		if(isset($_POST['simpan'])){
			$key=array('kdskul'=>$_POST['kode']);
            if(cekdata('tbskul',$key)>0){
                $data=array( 
                    'nmskul'=>$_POST['nama'], 
                    'nss'=>$_POST['nss'], 
                    'npsn'=>$_POST['npsn'], 
                    'nmskpd'=>$_POST['skpd'], 
                    'alamat'=>$_POST['almt'], 
                    'desa'=>$_POST['desa'], 
                    'kec'=>$_POST['kec'], 
                    'kab'=>$_POST['kab'], 
                    'prov'=>$_POST['prov'],
                    'kdpos'=>$_POST['kdpos'], 
                    'email'=>$_POST['imel'],
                    'website'=>$_POST['web']
                );
			    editdata("tbskul", $data,'',$key);
            }
		}
?>
<div class="card card-secondary card-outline">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-header">
            <h3 class="card-title"><strong>Data Satuan Pendidikan</strong></h3>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <div class="card card-gray-dark">
                                <div class="card-body">
                                    <div id="logoskul" style="text-align:center">
                                        <img class="img img-responsive img-rounded" src="<?php echo $logoskul;?>"
                                            height="180px" />
                                        <span id="logoskul_status"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <div class="card card-secondary">
                                <div class="card-body">
                                    <div id="logoskpd" style="text-align:center">
                                        <img class="img img-responsive img-rounded" src="<?php echo $logoskpd;?>"
                                            height="180px" />
                                        <span id="logoskpd_status"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Kode Satuan Pendidikan</label>
                        <input type="text" class="form-control col-sm-5" id="kode" name="kode"
                            placeholder="Kode Satuan Pendidikan" value="<?php echo $sk['kdskul'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Nama Satuan Pendidikan</label>
                        <input type="text" class="form-control col-sm-5" id="nama" name="nama"
                            placeholder="Nama Satuan Pendidikan" value="<?php echo $sk['nmskul'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">NPSN</label>
                        <input type="text" class="form-control col-sm-5" id="npsn" name="npsn" placeholder="N P S N"
                            value="<?php echo $sk['npsn'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">No. Statistik Sekolah</label>
                        <input type="text" class="form-control col-sm-5" id="nss" name="nss"
                            placeholder="Nomor Statistik Sekolah" value="<?php echo $sk['nss'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Nama SKPD</label>
                        <input type="text" class="form-control col-sm-5" id="skpd" name="skpd"
                            placeholder="Nama SKPD atau Yayasan" value="<?php echo $sk['nmskpd'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Alamat</label>
                        <input type="text" class="form-control col-sm-5" id="almt" name="almt" placeholder="Alamat"
                            value="<?php echo $sk['alamat'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Desa</label>
                        <input type="text" class="form-control col-sm-5" id="desa" name="desa" placeholder="Desa"
                            value="<?php echo $sk['desa'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Kecamatan</label>
                        <input type="text" class="form-control col-sm-5" id="kec" name="kec" placeholder="Kecamatan"
                            value="<?php echo $sk['kec'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Kabupaten</label>
                        <input type="text" class="form-control col-sm-5" id="kab" name="kab" placeholder="Kabupaten"
                            value="<?php echo $sk['kab'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Provinsi</label>
                        <input type="text" class="form-control col-sm-5" id="prov" name="prov" placeholder="Provinsi"
                            value="<?php echo $sk['prov'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Kode Pos</label>
                        <input type="text" class="form-control col-sm-5" id="kdpos" name="kdpos" placeholder="Kode Pos"
                            value="<?php echo $sk['kdpos'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">Website</label>
                        <input type="text" class="form-control col-sm-5" id="web" name="web"
                            placeholder="Website Satuan Pendidikan" value="<?php echo $sk['website'];?>">
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-5 offset-sm-1">E-mail</label>
                        <input type="text" class="form-control col-sm-5" id="imel" name="imel"
                            placeholder="Email Satuan Pendidikan" value="<?php echo $sk['email'];?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer justify-content-between">
            <button class="btn btn-primary btn-md btn-flat" id="simpan" name="simpan">
                <i class="fas fa-fw fa-save"></i>
                <span>&nbsp;Simpan</span>
            </button>
            <a href="?p=dashboard" class="btn btn-md btn-danger btn-flat">
                <i class="fas fa-fw fa-power-off"></i>
                <span>&nbsp;Tutup</span>
            </a>
        </div>
    </form>
</div>
<script type="text/javascript">
$(function() {
    var btnUpload = $('#logoskul');
    var status = $('#logoskul_status');
    new AjaxUpload(btnUpload, {
        action: 'sekolah_logo.php',
        name: 'filefoto',
        onSubmit: function(filefoto, ext) {
            if (!(ext && /^(jpg)$/.test(ext))) {
                toastr.error('Hanya Mendukung File *.jpg atau *.JPG Saja Bro!!');
                return false;
            }
            status.text('Upload Sedang Berlangsung...');
        },
        onComplete: function(file, response) {
            status.text('');
            if (response === "success") {
                $('#logoskul').html('<img src="images/' + file + '" height="180px" alt="" />')
                    .addClass('success');
                //document.getElementById("files").placeholder = file;
                window.location.reload();
            } else {
                toastr.error('Upload Gagal Bro!!');
            }
        }
    });
});
$(function() {
    var btnUpload = $('#logoskpd');
    var status = $('#logoskpd_status');
    new AjaxUpload(btnUpload, {
        action: 'sekolah+skpd.php',
        name: 'filefoto',
        onSubmit: function(filefoto, ext) {
            if (!(ext && /^(jpg)$/.test(ext))) {
                toastr.error('Hanya Mendukung File *.jpg atau *.JPG Saja Bro!!');
                return false;
            }
            status.text('Upload Sedang Berlangsung...');
        },
        onComplete: function(file, response) {
            status.text('');
            if (response === "success") {
                $('#logoskpd').html('<img src="images/' + file + '" height="180px" alt="" />')
                    .addClass('success');
                //document.getElementById("files").placeholder = file;
                window.location.reload();
            } else {
                toastr.error('Upload Gagal Bro!!');
            }
        }
    });
});
// 	$(document).ready(function(){
// 		$("#simpan").click(function(){
// 			var kode=$("#kode_skul").val();
// 			var nama=$("#nama_skul").val();
// 			var npsn=$("#npsn_skul").val();
// 			var noss=$("#nss_skul").val();
// 			var skpd=$("#skpd_skul").val();
// 			var almt=$("#almt_skul").val();
// 			var desa=$("#desa_skul").val();
// 			var kec=$("#kec_skul").val();
// 			var kab=$("#kab_skul").val();
// 			var prov=$("#prov_skul").val();
// 			var kpos=$("#kpos_skul").val();
// 			var webs=$("#web_skul").val();
// 			var imel=$("#imel_skul").val();
// 			$.ajax({
// 				type:"POST",
// 				url:"sekolah_simpan.php",
// 				data: "aksi=simpan&kode="+kode+"&nama="+nama+"&npsn="+npsn+"&noss="+noss+"&skpd="+skpd+"&almt="+almt+"&desa="+desa+"&kec="+kec+"&kab="+kab+"&prov="+prov+"&kpos="+kpos+"&webs="+webs+"&imel="+imel,
// 				success:function(data)
// 				{
// 					toastr.success(data);
// 					return false;
// 					window.location.reload();
// 				}	
// 			})
// 		})
// 	})
// 
</script>
<?php else: ?>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h3 class="card-title"><strong>Data Satuan Pendidikan</strong></h3>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-gray-dark">
                            <div class="card-header">
                                <h4 class="card-title"><b>Logo Sekolah</b></h4>
                            </div>
                            <div class="card-body">
                                <div id="logoskul" style="text-align:center">
                                    <img class="img img-responsive img-rounded" src="<?php echo $logoskul;?>"
                                        height="180px" />
                                    <span id="logoskul_status"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h4 class="card-title"><b>Logo SKPD / Yayasan</b></h4>
                            </div>
                            <div class="card-body">
                                <div id="logoskpd" style="text-align:center">
                                    <img class="img img-responsive img-rounded" src="<?php echo $logoskpd;?>"
                                        height="180px" />
                                    <span id="logoskpd_status"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Kode Satuan Pendidikan</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['kdskul'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Nama Satuan Pendidikan</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['nmskul'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">NPSN</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['npsn'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">No. Statistik Sekolah</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['nss'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Nama SKPD</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['nmskpd'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Alamat</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['alamat'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Desa</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['desa'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Kecamatan</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['kec'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Kabupaten</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['kab'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Provinsi</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['prov'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Kode Pos</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['kdpos'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">Website</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['website'];?>">
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5 offset-sm-1">E-mail</label>
                    <input type="text" readonly class="form-control col-sm-5" value="<?php echo $sk['email'];?>">
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif?>