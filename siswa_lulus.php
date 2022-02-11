<?php
    $field=array('MAX(idkelas) as maks');
    $join=array(
        'tbjenjang'=>'idjenjang',
        'tbskul'=>'idjenjang'
    );
	$kl=fulljoin($field,'tbkelas',$join)[0];
    $kelas=$kl['maks'];
    if(isset($_POST['upload'])) {
        require_once 'assets/library/PHPExcel.php';
	    require_once 'assets/library/excel_reader.php';
	if(empty($_FILES['filetmp']['tmp_name'])) { 
		echo "<script>
			$(function() {
				toastr.error('File Template Kosong!','Mohon Maaf!',{
					timeOut:1000,
					fadeOut:1000
				});
			});
		</script>";	
	} else {
		$data = new Spreadsheet_Excel_Reader($_FILES['filetmp']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);
		$isidata=$baris-5;
		$sukses = 0;
		$gagal = 0;
		$update=0;
        $idskul=getskul();	
		for ($i=6; $i<=$baris; $i++)
		{
			$xnis=$data->val($i,2);
			$xnisn=$data->val($i,3);			
			$xnmsiswa = $data->val($i,4);
			$xtglak = $data->val($i,5);			
			$xnoijz = $data->val($i,6);
			$xtglijz = $data->val($i,7);
			$xlanjut = $data->val($i,8);
			$xslta = $data->val($i,9);			
			if(strlen($nmagama)==1){$xagama=$nmagama;}
				else {
					switch ($nmagama) {
					case 'Islam':{ $xagama='A';break;}
					case 'Kristen':{ $xagama='B';break;}
					case 'Katholik':{ $xagama='C';break;}
					case 'Hindu':{ $xagama='D';break;}
					case 'Buddha':{ $xagama='E';break;}
					case 'Konghucu':{ $xagama='F';break;}
					default: {$xagama='';break;}
				}
			}
			// if($xnik==''){
			// 	echo "<script>
			// 		$(function() {
			// 			toastr.error('Cek Kolom NIK a.n ".$xnama."','Mohon Maaf!',{
			// 				timeOut:10000,
			// 				fadeOut:10000
			// 			});
			// 		});
			// 	</script>";
			// }
			// else 
            if($xnis==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom NIS a.n ".$xnama."','Mohon Maaf!',{
							timeOut:10000,
							fadeOut:10000
						});
					});
				</script>";
			}
			else if(strlen($xnisn)<>10 || $xnisn==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom NISN a.n ".$xnama."','Mohon Maaf!',{
							timeOut:10000,
							fadeOut:10000
						});
					});
				</script>";
			}
			else if(strlen($xnama)<1 || $xnama==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Nama Lengkap a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if(strlen($xtmplhr)<1 || $xtmplhr==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Tempat Lahir a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if(strlen($xtgllhr)<1 || $xtgllhr==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Tanggal Lahir a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if(strlen($xjekel)>1 || $xjekel==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Jenis Kelamin a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if($xagama==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Agama a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";

			}
			else {
				$key=array(
					'nisn'=>$xnisn,
					'nis'=>$xnis
				);
				$ceksiswa=cekdata('tbsiswa',$key);
				if($ceksiswa>0){
					$datasiswa=array(
						'idskul'=>$idskul,
						'nmsiswa' =>$xnama,
						'nik' =>$xnik,
						'tmplahir' => $xtmplhr,
						'tgllahir' =>$xtgllhr,
						'gender' =>$xjekel,
						'idagama' =>$xagama,
						'anake' =>$xanak,
						'sdr' =>$xsdr,
						'warganegara' =>'1',
						'goldarah' =>$xdrh,
						'rwysakit' =>$xsakit,
						'kebkhusus' =>$xkeb,
						'ikuts' =>$xikut,
						'transpr' =>$xtrans,
						'jarak' =>$xjrk,
						'waktu' =>$xwkt,
						'alamat' =>$xalmt,
						'desa' =>$xdesa,
						'kec' =>$xkec,
						'kab' =>$xkab,
						'prov' =>$xprov,
						'kdpos' =>$xkdpos,
						'lintang' =>$xltg,
						'bujur' =>$xbjr,
						'nohp' =>$xnohp,
						'hobi1' =>$xolga,
						'hobi2' =>$xseni,
						'hobi3' =>$xorgn,
						'hobi4' =>$xlain,
						'deleted'=>'0'
					);
					
					if(editdata('tbsiswa',$datasiswa,'',$key)>0){
						echo "<script>
							$(function() {
								toastr.success('Update Data Peserta Didik a.n ".$xnama." Sukses!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
						$update++;
					}
					else {
						echo "<script>
							$(function() {
								toastr.error('Update Data Peserta Didik a.n ".$xnama." Gagal!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
					}
				} 
				else {
					$datasiswa=array(
						'idskul'=>$idskul,
						'nmsiswa' =>$xnama,
						'nik' =>$xnik,
						'nis' =>$xnis,
						'nisn' =>$xnisn,
						'tmplahir' => $xtmplhr,
						'tgllahir' =>$xtgllhr,
						'gender' =>$xjekel,
						'idagama' =>$xagama,
						'anake' =>$xanak,
						'sdr' =>$xsdr,
						'warganegara' =>'1',
						'goldarah' =>$xdrh,
						'rwysakit' =>$xsakit,
						'kebkhusus' =>$xkeb,
						'ikuts' =>$xikut,
						'transpr' =>$xtrans,
						'jarak' =>$xjrk,
						'waktu' =>$xwkt,
						'alamat' =>$xalmt,
						'desa' =>$xdesa,
						'kec' =>$xkec,
						'kab' =>$xkab,
						'prov' =>$xprov,
						'kdpos' =>$xkdpos,
						'lintang' =>$xltg,
						'bujur' =>$xbjr,
						'nohp' =>$xnohp,
						'hobi1' =>$xolga,
						'hobi2' =>$xseni,
						'hobi3' =>$xorgn,
						'hobi4' =>$xlain
					);
					
					if(adddata('tbsiswa',$datasiswa)>0){
						echo "<script>
							$(function() {
								toastr.success('Tambah Data Peserta Didik a.n ".$xnama." Sukses!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
						$sukses++;
					}
					else {
						echo "<script>
							$(function() {
								toastr.error('Tambah Data Peserta Didik a.n ".$xnama." Gagal!','Mohon Maaf',{
									timeOut:4000,
									fadeOut:3000
								});
							});
						</script>";
						$gagal++;
					}
				}
			}
		}
		echo "<script>
				$(function() {
					toastr.info('Ada ".$sukses." data ditambah, ".$update." data diupdate, ".$gagal." data gagal ditambahkan!','Terimakasih',{
					timeOut:2000,
					fadeOut:2000
				});
			});
		</script>";
	}
}
?>
<div class="modal fade" id="myLulusPD" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Kelulusan Peserta Didik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filetmp">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file" id="filetmp" name="filetmp">
                                <label class="custom-file-label" for="filetmp">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="siswa_lulustmp.php" class="btn btn-success btn-sm btn-flat" target="_blank"><i
                            class="fas fa-download"></i> Download</a>
                    <button type="submit" name="upload" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-upload"></i>&nbsp;Upload
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i
                            class="fas fa-power-off"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Data Peserta Didik Tingkat Akhir</h4>
        <div class="card-tools">
            <button class="btn btn-flat btn-secondary btn-sm" data-toggle="modal" data-target="#myLulusPD">
                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import Data Lulusan
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_siswa" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;">Nama Peserta</th>
                        <th style="text-align: center;width:17.5%">NIS / NISN</th>
                        <th style="text-align: center;width:17.5%">Kelas</th>
                        <th style="text-align: center;width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT s.nis, s.nisn, s.nmsiswa, k.nmkelas FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) INNER JOIN tbkelas k USING(idkelas) INNER JOIN tbthpel t USING(idthpel) WHERE k.idkelas='$kelas' AND s.deleted='0' AND t.aktif='1'";
						$qs=vquery($sql);
						$no=0;
						foreach($qs as $s)
						{
							$no++;
					?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?>
                        </td>
                        <td><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                        <td><?php echo $s['nmkelas'];?></td>
                        <td style="text-align: center">
                            <button data-id="<?php echo $s['idsiswa'];?>" class="btn btn-xs btn-success btnLulus">
                                <i class="fas fa-sign-out-alt"></i>&nbsp;Lulus
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('#tb_siswa').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
});

$(".btnUpdate").click(function() {
    var id = $(this).data('id');
    window.location.href = "index.php?p=addsiswa&id=" + id

})

$(".btnHapus").click(function() {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Data Peserta Didik" + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "siswa_simpan.php",
                data: "aksi=hapus&id=" + id,
                success: function(data) {
                    toastr.success(data);
                }
            })
            window.location.reload();
        }
    })
})

$("#hapusall").click(function() {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Seluruh	Data Peserta Didik" + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "siswa_simpan.php",
                data: "aksi=kosong&id=" + id,
                success: function(data) {
                    toastr.success(data);
                }
            })
            window.location.reload();
        }
    })
})
</script>