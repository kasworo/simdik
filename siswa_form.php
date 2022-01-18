<?php
	if($level=='3'){
		$sql="SELECT idsiswa FROM tbsiswa WHERE username='$_COOKIE[id]'";
		$row=$conn->query($sql);
		$r=$row->fetch_array();
		$idsiswa=$r['idsiswa'];
	}
	else {
		$idsiswa=$_GET['id'];
	}
    
	if(isset($_POST['simpan'])) {
        if(empty($_POST['idsiswa'])){
            $data=array(
                'idskul'        => $_POST['idskul'],
                'nmsiswa'       => $_POST['nmsiswa'],
                'nik'           => $_POST['nik'],
                'nis'           => $_POST['nis'],
                'nisn'          => $_POST['nisn'],
                'tmplahir'      => $_POST['tmplahir'],
                'tgllahir'      => $_POST['tgllahir'],
                'gender'        => $_POST['gender'],
                'idagama'       => $_POST['agama'],
                'anake'         => $_POST['anake'],
                'sdr'           => $_POST['saudara'],
                'warganegara'   => $_POST['warganegara'],
                'goldarah'      => $_POST['goldarah'],
                'rwysakit'      => $_POST['penyakit'],
                'kebkhusus'     => $_POST['kebkhusus'],
                'ikuts'         => $_POST['reftgl'],
                'transpr'       => $_POST['transpor'],
                'jarak'         => $_POST['jarak'],
                'waktu'         => $_POST['waktu'],
                'alamat'        => $_POST['almt'],
                'desa'          => $_POST['desa'],
                'kec'           => $_POST['kec'],
                'kab'           => $_POST['kab'],
                'prov'          => $_POST['prov'],
                'kdpos'         => $_POST['kdpos'],
                'lintang'       => $_POST['longitude'],
                'bujur'         => $_POST['latitude'],
                'nohp'          => $_POST['nohp'],
                'hobi1'         => $_POST['olahrg'],
                'hobi2'         => $_POST['seni'],
                'hobi3'         => $_POST['orgns'],
                'hobi4'         => $_POST['lain']
            );
            $baru=adddata('tbsiswa',$data);
			if($baru>0){
				echo "<script>
					$(function() {
							toastr.success('Tambah Data Siswa Berhasil!','Terima Kasih...',{
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
							toastr.error('Tambah Data Siswa Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=datasiswa';
								}
							});
						});
					</script>";
			}
		}
		else {
            $data=array(
                'nmsiswa'       => $_POST['nmsiswa'],
                'nik'           => $_POST['nik'],
                'nis'           => $_POST['nis'],
                'nisn'          => $_POST['nisn'],
                'tmplahir'      => $_POST['tmplahir'],
                'tgllahir'      => $_POST['tgllahir'],
                'gender'        => $_POST['gender'],
                'idagama'       => $_POST['agama'],
                'anake'         => $_POST['anake'],
                'sdr'           => $_POST['saudara'],
                'warganegara'   => $_POST['warganegara'],
                'goldarah'      => $_POST['goldarah'],
                'rwysakit'      => $_POST['penyakit'],
                'kebkhusus'     => $_POST['kebkhusus'],
                'ikuts'         => $_POST['reftgl'],
                'transpr'       => $_POST['transpor'],
                'jarak'         => $_POST['jarak'],
                'waktu'         => $_POST['waktu'],
                'alamat'        => $_POST['almt'],
                'desa'          => $_POST['desa'],
                'kec'           => $_POST['kec'],
                'kab'           => $_POST['kab'],
                'prov'          => $_POST['prov'],
                'kdpos'         => $_POST['kdpos'],
                'lintang'       => $_POST['longitude'],
                'bujur'         => $_POST['latitude'],
                'nohp'          => $_POST['nohp'],
                'hobi1'         => $_POST['olahrg'],
                'hobi2'         => $_POST['seni'],
                'hobi3'         => $_POST['orgns'],
                'hobi4'         => $_POST['lain']
            );
            $field=array('idsiswa'=>$_POST['idsiswa']);
            $update=editdata('tbsiswa',$data,'',$field);
			if($update>0){
				echo "<script>
						$(function() {
							toastr.info('Update Data Siswa Berhasil!','Terima Kasih...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=addriwayat&id=".$idsiswa."';
								}
							});
						});
					</script>";
			}
			else {
				echo "<script>
						$(function() {
							toastr.error('Update Data Siswa Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=datasiswa';
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
        data: "id=" + id + "&d=1",
        success: function(e) {
            $("#idsiswa").val(e.idsiswa);
            $("#nmsiswa").val(e.nmsiswa);
            $("#nik").val(e.nik);
            $("#nis").val(e.nis);
            $("#nisn").val(e.nisn);
            $("#tmplahir").val(e.tmplahir);
            $("#tgllahir").val(e.tgllahir);
            $("#gender").val(e.gender);
            $("#agama").val(e.agama);
            $("#warganegara").val(e.warganegara);
            $("#anake").val(e.anake);
            $("#saudara").val(e.sdr);
            $("#goldarah").val(e.goldarah);
            $("#penyakit").val(e.rwysakit);
            $("#kebkhusus").val(e.kebkhusus);
            $("#reftgl").val(e.ikuts);
            $("#jarak").val(e.jarak);
            $("#waktu").val(e.waktu);
            $("#transpor").val(e.transpr);
            $("#almt").val(e.alamat);
            $("#desa").val(e.desa)
            $("#kec").val(e.kec);
            $("#kab").val(e.kab);
            $("#prov").val(e.prov);
            $("#kdpos").val(e.kdpos);
            $("#longitude").val(e.lintang);
            $("#latitude").val(e.bujur);
            $("#nohp").val(e.nohp);
            $("#olahrg").val(e.hobi1);
            $("#seni").val(e.hobi2);
            $("#orgns").val(e.hobi3);
            $("#lain").val(e.hobi4);
            $("#fotolama").val(e.fotolama);
            $("#fotosiswa").attr("src", e.dir + e.foto);
            $("#judul").html(data.judul);
            $("#simpan").html(data.tmbl);
        }
    })
});
</script>
<div class="card card-primary card-outline">
    <form action="" method="post" enctype="multipart/form-data" id="FormSiswa">
        <input type="hidden" class="form-control" name="idskul" id="idskul" value="<?php echo $idskul;?>">
        <div class="card-header">
            <h5 class="card-title m-0" id="judul">Data Peserta Didik</h5>
        </div>
        <div class="card-body">
            <div class="row form-group">
                <div class="col-sm-2 text-center mb-5">
                    <img class="img-fluid img-thumbnail rounded" src="assets/img/avatar.gif" width="160px"
                        id="fotosiswa">
                    <input type="hidden" class="form-control form-control-sm" name="fotolama" id="fotolama">
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row mb-2" for="nmsiswa">
                                <label class="col-sm-5 offset-sm-1">Nama Lengkap</label>
                                <div class="col-sm-6">
                                    <input type="hidden" class="form-control form-control-sm" name="idsiswa"
                                        id="idsiswa">
                                    <input class="form-control form-control-sm" name="nmsiswa" id="nmsiswa">
                                    <!--required oninvalid="this.setCustomValidity('Nama Wajib Diisi!')" oninput="setCustomValidity('')">-->
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="nik">
                                <label class="col-sm-5 offset-sm-1">N I K</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="nik" id="nik"
                                        onkeyup="validAngka(this)">
                                    <!-- required oninvalid="this.setCustomValidity('Kolom NIK Wajib Diisi')" oninput="setCustomValidity('')"> -->
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="nis">
                                <label class="col-sm-5 offset-sm-1" for="nis">N I S</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="nis" id="nis">
                                    <!--required oninvalid="this.setCustomValidity('N I S Wajib Diisi')" oninput="setCustomValidity('')">-->
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="nisn">
                                <label class="col-sm-5 offset-sm-1">NISN</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="nisn" id="nisn">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="tmplahir">
                                <label class="col-sm-5 offset-sm-1">Tempat Lahir</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="tmplahir" id="tmplahir">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="tgllahir">
                                <label class="col-sm-5 offset-sm-1" for="tgllahir">Tanggal Lahir</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="tgllahir" id="tgllahir">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="gender">
                                <label class="col-sm-5 offset-sm-1">Jenis Kelamin</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" name="gender" id="gender">
                                        <option value="">..Pilih..</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="agama">
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
                            <div class="form-group row mb-2" for="anake">
                                <label class="col-sm-5 offset-sm-1">Anak Ke / Dari</label>
                                <div class="col-sm-3 mb-2">
                                    <input class="form-control form-control-sm" name="anake" id="anake"
                                        placeholder='anak ke' value="<?php echo $anake;?>">
                                </div>
                                <div class="col-sm-3" for="saudara">
                                    <input class="form-control form-control-sm" name="saudara" id="saudara"
                                        placeholder="bersaudara" value="<?php echo $sdr;?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="warganegara">
                                <label class="col-sm-5 offset-sm-1">Kewarganegaraan</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" name="warganegara" id="warganegara">
                                        <option value="">..Pilih..</option>
                                        <option value="1">Warga Negara Indonesia</option>
                                        <option value="2">Warga Negara Asing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-5 offset-sm-1">Golongan Darah</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" name="goldarah" id="goldarah">
                                        <option value="">..Pilih..</option>
                                        <option value="0">Tidak Tahu</option>
                                        <option value="1">A</option>
                                        <option value="2">B</option>
                                        <option value="3">AB</option>
                                        <option value="4">O</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="penyakit">
                                <label class="col-sm-5 offset-sm-1">Riwayat Penyakit</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" name="penyakit" id="penyakit">
                                        <option value="">..Pilih..</option>
                                        <option value="0">Tidak Ada</option>
                                        <option value="1">Demam Berdarah</option>
                                        <option value="2">Malaria</option>
                                        <option value="3">Asma</option>
                                        <option value="4">Campak</option>
                                        <option value="5">TBC</option>
                                        <option value="6">Tetanus</option>
                                        <option value="7">Pneumonia</option>
                                        <option value="8">Jantung</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="kebkhusus">
                                <label class="col-sm-5 offset-sm-1">Kebutuhan Khusus</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" name="kebkhusus" id="kebkhusus">
                                        <option value="">..Pilih..</option>
                                        <option value="0">Tidak Ada</option>
                                        <option value="1">Tuna Daksa</option>
                                        <option value="2">Tuna Rungu</option>
                                        <option value="3">Tuna Wicara</option>
                                        <option value="4">Tuna Netra</option>
                                        <option value="5">Tuna Grahita</option>
                                        <option value="6">Down Syndrome</option>
                                        <option value="7">Autisme</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="reftgl">
                                <label class="col-sm-5 offset-sm-1">Tinggal Dengan</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" name="reftgl" id="reftgl">
                                        <option value="">..Pilih</option>
                                        <option value="1">Orang Tua</option>
                                        <option value="2">Wali Murid</option>
                                        <option value="3">Kost</option>
                                        <option value="4">Asrama</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="transpor">
                                <label class="col-sm-5 offset-sm-1">Transportasi</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" name="transpor" id="transpor">
                                        <option value="">..Pilih</option>
                                        <option value="1">Jalan Kaki</option>
                                        <option value="2">Sepeda</option>
                                        <option value="3">Sepeda Motor</option>
                                        <option value="4">Ojek</option>
                                        <option value="5">Angkutan Umum</option>
                                        <option value="6">Angkutan Antar Jemput</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row mb-2" for="jarak">
                                <label class="col-sm-5 offset-sm-1">Jarak / Waktu</label>
                                <div class="col-sm-3 mb-2">
                                    <input max="25" class="form-control form-control-sm" name="jarak" id="jarak"
                                        placeholder="berapa km">
                                </div>
                                <div class="col-sm-3 mb-2" for="waktu">
                                    <input class="form-control form-control-sm" name="waktu" id="waktu"
                                        placeholder="menit">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="almt">
                                <label class="col-sm-5 offset-sm-1">Alamat</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="almt" id="almt">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-5 offset-sm-1" for="desa">Desa / Kelurahan</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="desa" id="desa">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="kec">
                                <label class="col-sm-5 offset-sm-1">Kecamatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="kec" id="kec">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="kab">
                                <label class="col-sm-5 offset-sm-1">Kabupaten</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="kab" id="kab">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="prov">
                                <label class="col-sm-5 offset-sm-1">Provinsi</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="prov" id="prov">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="kdpos">
                                <label class="col-sm-5 offset-sm-1">Kode Pos</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="kdpos" id="kdpos">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="longitude">
                                <label class="col-sm-5 offset-sm-1">Lintang</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="longitude" id="longitude">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="latitude">
                                <label class="col-sm-5 offset-sm-1">Bujur</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="latitude" id="latitude">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="nohp">
                                <label class="col-sm-5 offset-sm-1">Nomor HP</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="nohp" id="nohp">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="olahrg">
                                <label class="col-sm-5 offset-sm-1">Hobi / Kegemaran</label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="olahrg" id="olahrg"
                                        placeholder="Bidang Olahraga">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="seni">
                                <label class="col-sm-5 offset-sm-1"></label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="seni" id="seni"
                                        placeholder="Bidang Seni">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="orgns">
                                <label class="col-sm-5 offset-sm-1"></label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="orgns" id="orgns"
                                        placeholder="Kemasyarakatan/Organisasi">
                                </div>
                            </div>
                            <div class="form-group row mb-2" for="lain">
                                <label class="col-sm-5 offset-sm-1"></label>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-sm" name="lain" id="lain"
                                        placeholder="Hobi Lainnya">
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
            <div class="row">
                <?php if($level=='1'): ?>
                <a href="index.php?p=datasiswa" class="btn btn-danger col-sm-2 ml-2 mb-2">
                    <i class="fas fa-arrow-circle-left"></i>
                    <span>&nbsp;Kembali</span>
                </a>
                <?php endif ?>
                <button class="btn btn-primary col-sm-2 ml-2 mb-2" id="simpan" name="simpan">
                    <i class="fas fa-fw fa-save"></i>
                    <span>&nbsp;Simpan</span>
                </button>
                <a href="index.php?p=addriwayat&id=<?php echo $idsiswa;?>" class="btn btn-success col-sm-2 ml-2 mb-2">
                    <span>Berikutnya&nbsp;</span>
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#tgllahir').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
});
</script>