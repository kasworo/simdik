<?php
	$idsiswa=$_GET['id'];
	if(isset($_POST['simpan'])){		
		$field=array(
			'hubkel' =>$_POST['hubkel'],
			'idsiswa'=>$_POST['idsiswa']
		);
		$cekortu=cekdata('tbortu',$field);
		if($cekortu==0){
			$ortu=array(
				'idsiswa'   => $_POST['idsiswa'],
				'nmortu'	=>$_POST['nmortu'],
				'nik'	   =>$_POST['nik'],
				'tmplahir'  =>$_POST['tmplahir'],
				'tgllahir'  =>$_POST['tgllahir'],
				'idagama'   =>$_POST['agama'],
				'idpddk'	=>$_POST['pddkortu'],
				'hidup'	 =>$_POST['hidup'],
				'idkerja'   =>$_POST['krjortu'],
				'idhsl'	 =>$_POST['hslortu'],
				'hubkel'	=>$_POST['hubkel'],
				'alamat'	=>$_POST['almt'],
				'desa'	  =>$_POST['desa'],
				'kec'	   =>$_POST['kec'],
				'kab'	   =>$_POST['kab'],
				'prov'	  =>$_POST['prov'],
				'kdpos'	 =>$_POST['kdpos'],
				'nohp'	  =>$_POST['nohp']
			);
			$rows=adddata('tbortu',$ortu);
			if($rows>0){
				echo "<script>
						$(function() {
							toastr.success('Tambah Data Ayah Kandung Berhasil!','Terima Kasih...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=datasiswa';
								}
							});
						});
					</script>";
			}
			else {
				echo "<script>
						$(function() {
							toastr.error('Tambah Data Ayah Kandung Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addayah&id=".$idsiswa."';
								}
							});
						});
					</script>";
			}
		}
		else {
			$ortu=array(
				'nmortu'=>$_POST['nmortu'],
				'nik'=>$_POST['nik'],
				'tmplahir'=>$_POST['tmplahir'],
				'tgllahir'=>$_POST['tgllahir'],
				'idagama'=>$_POST['agama'],
				'idpddk'=>$_POST['pddkortu'],
				'hidup'=>$_POST['hidup'],
				'idkerja'=>$_POST['krjortu'],
				'idhsl'=>$_POST['hslortu'],
				'alamat'=>$_POST['almt'],
				'desa'=>$_POST['desa'],
				'kec'=>$_POST['kec'],
				'kab'=>$_POST['kab'],
				'prov'=>$_POST['prov'],
				'kdpos'=>$_POST['kdpos'],
				'nohp'=>$_POST['nohp']
			);
			$rows=editdata('tbortu',$ortu, $field);
			if($rows>0){
				echo "<script>
						$(function() {
							toastr.success('Update Data Ayah Kandung Berhasil!','Terima Kasih...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addibu&id=".$idsiswa."';
								}
							});
						});
					</script>";
			}
			else {
				echo "<script>
						$(function() {
							toastr.error('Update Data Ayah Kandung Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addayah&id=".$idsiswa."';
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
    var id = "<?php echo $idsiswa;?>";
    $.ajax({
        url: "siswa_json.php",
        type: "POST",
        dataType: 'json',
        data: "id=" + id + "&j=1",
        success: function(data) {
            $("#nmortu").val(data.nmortu);
            $("#nik").val(data.nik);
            $("#tmplahir").val(data.tmplahir);
            $("#tgllahir").val(data.tgllahir);
            $("#agama").val(data.idagama);
            $("#pddkortu").val(data.idpddk);
            $("#hidup").val(data.hidup);
            $("#krjortu").val(data.idkerja);
            $("#hslortu").val(data.idhsl);
            $("#hubkel").val(data.hubkel);
            $("#almt").val(data.alamat);
            $("#desa").val(data.desa)
            $("#kec").val(data.kec);
            $("#kab").val(data.kab);
            $("#prov").val(data.prov);
            $("#kdpos").val(data.kdpos);
            $("#nohp").val(data.nohp);
            $("#judul").html(data.psn);
            $("#simpan").html(data.tmb);
        }
    })
})
</script>
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title m-0" id="judul">Data Ayah Kandung</h5>
        </div>
        <form action="" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row mb-2">
                            <input type="hidden" class="form-control form-control-sm col-sm-6" name="idsiswa"
                                id="idsiswa" value="<?php echo $idsiswa;?>">
                            <input type="hidden" class="form-control form-control-sm col-sm-6" name="hubkel"
                                id="hubkel">
                            <label class="col-sm-5 offset-sm-1">Nama Ayah</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="nmortu" id="nmortu">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">NIK</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="nik" id="nik">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Tempat Lahir</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="tmplahir" id="tmplahir">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Tanggal Lahir</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="tgllahir" id="tgllahir">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Agama</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" name="agama" id="agama">
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
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Pendidikan Terakhir</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" name="pddkortu" id="pddkortu">
                                    <option value="">..Pilih..</option>
                                    <?php
										$qed=$conn->query("SELECT*FROM ref_pendidikan");
										while($ed=$qed->fetch_array()):
									?>
                                    <option value="<?php echo $ed['idpddk'];?>"><?php echo $ed['pendidikan'];?></option>
                                    <?php endwhile?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Masih Hidup / Sudah Meninggal</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" name="hidup" id="hidup">
                                    <option value="">..Pilih..</option>
                                    <option value="1">Masih Hidup</option>
                                    <option value="0">Sudah Meninggal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Pekerjaan</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" name="krjortu" id="krjortu">
                                    <option value="">..Pilih..</option>
                                    <?php
										$qkrj=$conn->query("SELECT*FROM ref_pekerjaan LIMIT 7");
										while($kr=$qkrj->fetch_array()):
									?>
                                    <option value="<?php echo $kr['idkerja'];?>"><?php echo $kr['pekerjaan'];?></option>
                                    <?php endwhile?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Penghasilan / Bulan</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" name="hslortu" id="hslortu">
                                    <option value="">..Pilih..</option>
                                    <?php
										$qhsl=$conn->query("SELECT*FROM ref_penghasilan");
										while($hs=$qhsl->fetch_array()):
									?>
                                    <option value="<?php echo $hs['idhsl'];?>"><?php echo $hs['penghasilan'];?></option>
                                    <?php endwhile?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Alamat</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="almt" id="almt">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Desa / Kelurahan</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="desa" id="desa">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Kecamatan</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="kec" id="kec">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Kabupaten</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="kab" id="kab">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Provinsi</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="prov" id="prov">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Kode Pos</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="kdpos" id="kdpos">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5 offset-sm-1">Nomor HP</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" name="nohp" id="nohp">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <a href="index.php?p=addriwayat&id=<?php echo $idsiswa;?>"
                        class="btn btn-md btn-danger mb-2 ml-2 col-sm-2">
                        <i class="fas fa-arrow-circle-left"></i>
                        <span>&nbsp;Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-md mb-2 ml-2 col-sm-2" id="simpan" name="simpan">
                        <i class="fas fa-fw fa-save"></i>
                        <span>&nbsp;<?php echo $tmbl;?></span>
                    </button>
                    <a href="index.php?p=addibu&id=<?php echo $idsiswa;?>"
                        class="btn btn-success btn-md mb-2 ml-2 col-sm-2">
                        <span>Berikutnya&nbsp;</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#tgllahir').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
})
</script>