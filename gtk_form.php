<?php
   if(isset($_POST['simpan'])){
		$data=array(
		   'idskul'	=>$_POST['idskul'],
			'nama'	  =>$_POST['nmgtk'],
			'nik'	   =>$_POST['nik'],
			'nip'	   =>$_POST['nip'],
			'tmplahir'  =>$_POST['tmplahir'],
			'tgllahir'  =>$_POST['tgllahir'],
			'gender'	=>$_POST['gender'],
			'agama'	 =>$_POST['agama'],
			'kepeg'	 =>$_POST['stsp'],
			'jbtdinas'  =>$_POST['jbtd'],
			'email'	 =>$_POST['imel'],
			'alamat'	=>$_POST['almt'],
			'desa'	  =>$_POST['desa'],
			'kec'	   =>$_POST['kec'],
			'kab'	   =>$_POST['kab'],
			'prov'	  =>$_POST['prov'],
			'kdpos'	 =>$_POST['kdpos'],
			'nohp'	  =>$_POST['nohp']
		);
		if($_GET['m']=='1'){
			$rows=adddata('tbgtk',$data);
		}
		else {
			$rows=editdata('tbgtk',$data,'idgtk',$_GET['id']);
		}
		if($rows>0){
			echo "<script>
				$(function() {
					toastr.success('Tambah atau Edit Data GTK Berhasil!','Terima Kasih',
					{
						timeOut:1000,
						fadeOut:1000,
						onHidden: function(){
							window.location.href='index.php?p=datagtk';
						}
					});
				});
			</script>";
		}
		else {
			echo "<script>
				$(function() {
					toastr.error('Data GTK Gagal Disimpan!','Mohon Maaf',
					{
						timeOut:1000,
						fadeOut:1000,
						onHidden: function(){
							window.location.href='index.php?p=datagtk';
						}
					});
				});
			</script>";
		}
	}
if(isset($_GET['id'])){
?>
<script type="text/javascript">
$(document).ready(function() {
    var id = "<?php echo $_GET['id'];?>";
    $.ajax({
        url: "gtk_edit.php",
        type: "POST",
        dataType: 'json',
        data: "id=" + id,
        success: function(e) {
            $("#idgtk").val(e.idgtk);
            $("#nmgtk").val(e.nama);
            $("#nik").val(e.nik);
            $("#nip").val(e.nip);
            $("#tmplahir").val(e.tmplahir);
            $("#tgllahir").val(e.tgllahir);
            $("#gender").val(e.gender);
            $("#agama").val(e.agama);
            $("#stsp").val(e.kepeg);
            $("#jbtd").val(e.jbtd);
            $("#imel").val(e.email);
            $("#almt").val(e.alamat);
            $("#desa").val(e.desa);
            $("#kec").val(e.kec);
            $("#kab").val(e.kab);
            $("#prov").val(e.prov);
            $("#kdpos").val(e.kdpos);
            $("#nohp").val(e.nohp);
            $("#fotogtk").attr("src", e.dir + e.foto);
        }
    })
});
</script>
<?php  } ?>
<div class="col-sm-12">
    <div class="alert alert-warning">
        <p><strong>Petunjuk</strong><br />Silahkan cek kembali data anda, lengkapi dan betulkan jika masih terdapat data
            yang masih kurang atau salah, kemudian klik tombol <strong>Update</strong></p>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Data Guru dan Staff</h5>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div style="text-align:center;margin-top:10px">
                            <img class="img img-responsive img-circle" id="fotogtk" src="assets/img/avatar.gif"
                                width="100%" />
                            <span id="fotogtk_status"></span>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Nama Lengkap</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" class="form-control" name="idgtk" id="idgtk">
                                        <input type="hidden" class="form-control" name="idskul" id="idskul"
                                            value="<?php echo $idskul;?>">
                                        <input class="form-control form-control-sm" name="nmgtk" id="nmgtk">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">N I K</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="nik" id="nik"
                                            onkeyup="validAngka(this)">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">N I P</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="nip" id="nip"
                                            onkeyup="validAngka(this)">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Tempat Lahir</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="tmplahir" id="tmplahir">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Tanggal Lahir</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="tgllahir" id="tgllahir">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Jenis Kelamin</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="">..Pilih..</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Agama</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="agama" id="agama">
                                            <option value="">..Pilih..</option>
                                            <option value="A">Islam</option>
                                            <option value="B">Kristen</option>
                                            <option value="C">Katholik</option>
                                            <option value="D">Hindu</option>
                                            <option value="E">Buddha</option>
                                            <option value="F">Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Status Kepegawaian</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="stsp" id="stsp">
                                            <option value="">..Pilih..</option>
                                            <option value="1">Aparatur Sipil Negara</option>
                                            <option value="2">GTT/PTT Kabupaten</option>
                                            <option value="2">GTT/PTT Komite</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Jabatan Dinas</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="jbtd" id="jbtd">
                                            <option value="">..Pilih..</option>
                                            <option value="1">Kepala Sekolah</option>
                                            <option value="2">Wakil Kepala Sekolah</option>
                                            <option value="3">Guru Bidang Studi</option>
                                            <option value="4">Guru BP/BK</option>
                                            <option value="5">Tenaga Administrasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Alamat E-mail</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="imel" id="imel">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Alamat</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="almt" id="almt">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Desa / Kelurahan</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="desa" id="desa">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Kecamatan</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="kec" id="kec">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Kabupaten</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="kab" id="kab">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Provinsi</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="prov" id="prov">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Kode Pos</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="kdpos" id="kdpos">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Nomor HP</label>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-sm" name="nohp" id="nohp">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-5 offset-sm-1">Foto</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="col-sm-12" id="foto" name="foto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-md btn-flat ml-2" name="simpan">
                    <i class="fas fa-fw fa-save"></i>
                    <span>&nbsp;Simpan</span>
                </button>
                <?php if($level=='1'):?>
                <a href="index.php?p=datagtk" class="btn btn-md btn-danger btn-flat ml-2">
                    <i class="fas fa-fw fa-power-off"></i>
                    <span>&nbsp;Tutup</span>
                </a>
                <?php else: ?>
                <a href="index.php?p=dashboard" class="btn btn-md btn-danger btn-flat ml-2">
                    <i class="fas fa-fw fa-power-off"></i>
                    <span>&nbsp;Tutup</span>
                </a>
                <?php endif ?>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
function validAngka(a) {
    if (!/^[0-9.]+$/.test(a.value)) {
        a.value = a.value.substring(0, a.value.length - 1000);
    }
}
$(document).ready(function() {
    $('#tgllahir').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
})
</script>