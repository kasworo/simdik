<?php
	$idsiswa=$_GET['id'];;
	if(isset($_POST['simpan'])){
		$cekriwayat=cekdata('tbriwayatskul', array('idsiswa'=>$idsiswa));
        if($cekriwayat==0){
            if($_POST['idreg']=='1')
            {
                $data=array(
                    'idsiswa'   => $_POST['idsiswa'],
                    'idjreg'    => $_POST['idreg'],
                    'aslsd'     => $_POST['aslsd'],
                    'noijazah'  => $conn->escape_string($_POST['noijz']),
                    'tglijazah'     => $_POST['tglijz'],
                    'lama'    => $_POST['lamasd'] 
                );
            }
            if($_POST['idreg']=='2'){
                $data=array(
                    'idsiswa'   => $_POST['idsiswa'],
                    'idjreg'    => $_POST['idreg'],
                    'aslsd'     => $_POST['aslsd'],
                    'noijazah'  => $conn->escape_string($_POST['noijz']),
                    'tglijazah' => $_POST['tglijz'],
                    'lama'    => $_POST['lamasd'],
                    'aslsmp'    => $_POST['aslsmp'],
                    'nosurat'     => $_POST['nosrt'],
                    'tglsurat'    => $_POST['tglsrt'],
                    'alasan'    =>$_POST['alasan']  
                );
            }
           
            $baru=adddata('tbriwayatskul',$data);
			if($baru>0){
				echo "<script>
						$(function() {
							toastr.success('Tambah Riwayat Pendidikan Siswa Berhasil!','Terima Kasih...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addortu&id=".$idsiswa."&a=1';
								}
							});
						});
					</script>";
				}
			else {
				echo "<script>
						$(function() {
							toastr.error('Tambah Riwayat Pendidikan Siswa Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addriwayat&id=".$idsiswa."';
								}
							});
						});
					</script>";
			}
		}
		else 
		{
			if($_POST['idreg']=='1')
            {
                $data=array(
                    'idjreg'    => $_POST['idreg'],
                    'aslsd'     => $_POST['aslsd'],
                    'noijazah'     => $conn->escape_string($_POST['noijz']),
                    'tglijazah'     => $_POST['tglijz'],
                    'lama'   => $_POST['lamasd'] 
                );
            }
            if($_POST['idreg']=='2'){
                $data=array(
                    'idjreg'    => $_POST['idreg'],
                    'aslsd'     => $_POST['aslsd'],
                    'noijazah'  => $conn->escape_string($_POST['noijz']),
                    'tglijazah' => $_POST['tglijz'],
                    'lama'      => $_POST['lamasd'],
                    'aslsmp'    => $_POST['aslsmp'],
                    'nosurat'     => $_POST['nosrt'],
                    'tglsurat'    => $_POST['tglsrt'],
                    'alasan'    =>$_POST['alasan']  
                );
            }
            $update=editdata('tbriwayatskul', $data, '',array('idsiswa'=>$_POST['idsiswa']));
            if($update>0){
				echo "<script>
						$(function() {
							toastr.success('Ubah Riwayat Pendidikan Siswa Berhasil!','Terima Kasih...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addayah&id=".$idsiswa."';
								}
							});
						});
					</script>";
			}
			else {
				echo "<script>
						$(function() {
							toastr.error('Ubah Riwayat Pendidikan Siswa Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addriwayat&id=".$idsiswa."';
								}
							});
						});
					</script>";
			}
		}
	}
	?>
<script type="text/javascript">
$(document).ready(function() {
    let id = "<?php echo $idsiswa;?>";
    $.ajax({
        url: "siswa_json.php",
        type: "POST",
        dataType: 'json',
        data: "id=" + id + "&d=2",
        success: function(data) {
            $("#idreg").val(data.idreg);
            $("#aslsd").val(data.aslsd);
            $("#noijz").val(data.noijz);
            $("#tglijz").val(data.tglijz);
            $("#lamasd").val(data.lamasd);
            $("#aslsmp").val(data.aslsmp);
            $("#nosrt").val(data.nosrt);
            $("#tglsrt").val(data.tglsrt);
            $("#alasan").val(data.alasan);
            $("#judul").html(data.judul);
            $("#simpan").html(data.tmbl);
        }
    })
});
</script>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title m-0" id="judul">Data Riwayat</h5>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <div class="row mt-auto">
                <div class="col-sm-6">
                    <div class="form-group row mb-2">
                        <input type="hidden" class="form-control form-control-sm col-sm-6" name="idsiswa" id="idsiwa"
                            value="<?php echo $idsiswa;?>">
                        <label class="col-sm-5 offset-sm-1">Terdaftar Sebagai</label>
                        <select class="form-control form-control-sm col-sm-6" id="idreg" name="idreg">
                            <option value="">..Pilih..</option>
                            <option value="1">Siswa Baru</option>
                            <option value="2">Pindahan</option>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">Asal SD/MI</label>
                        <input class="form-control form-control-sm col-sm-6" name="aslsd" id="aslsd">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">Nomor Ijazah</label>
                        <input class="form-control form-control-sm col-sm-6" name="noijz" id="noijz">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">Tanggal Ijazah</label>
                        <input class="form-control form-control-sm col-sm-6" name="tglijz" id="tglijz">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">Lama Belajar</label>
                        <input class="form-control form-control-sm col-sm-6" name="lamasd" id="lamasd">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">Pindahan dari</label>
                        <input class="form-control form-control-sm col-sm-6" name="aslsmp" id="aslsmp">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">No. Surat Pindah</label>
                        <input class="form-control form-control-sm col-sm-6" name="nosrt" id="nosrt">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">Tanggal Surat Pindah</label>
                        <input class="form-control form-control-sm col-sm-6" name="tglsrt" id="tglsrt">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 offset-sm-1">Alasan Pindah</label>
                        <textarea class="form-control form-control-sm col-sm-6" name="alasan" id="alasan"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?php if($level=='1'): ?>
            <a href="index.php?p=addsiswa&id=<?php echo $idsiswa;?>" class="btn btn-danger col-sm-2 ml-2 mb-2">
                <i class="fas fa-arrow-circle-left"></i>
                <span>&nbsp;Kembali</span>
            </a>
            <?php endif ?>
            <button class="btn btn-primary col-sm-2 ml-2 mb-2" id="simpan" name="simpan">
                <i class="fas fa-fw fa-save"></i>
                <span>&nbsp;Simpan</span>
            </button>
            <a href="index.php?p=addayah&id=<?php echo $idsiswa;?>" class="btn btn-success col-sm-2 ml-2 mb-2">
                <span>Berikutnya&nbsp;</span>
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#idjreg").change(function() {
        var reg = this.val();
        alert(reg);
    })
})
</script>