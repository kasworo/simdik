<?php
	if(isset($_POST['upload'])) {
        require_once 'assets/library/PHPExcel.php';
	    require_once 'assets/library/excel_reader.php';
	
		if(empty($_FILES['filerapor']['tmp_name'])) { 
			echo "<script>
				$(function() {
					toastr.error('File Template Peserta Didik Kosong!','Mohon Maaf!',{
						timeOut:1000,
						fadeOut:1000
					});
				});
			</script>";	
		} else {
			$data = new Spreadsheet_Excel_Reader($_FILES['filerapor']['tmp_name']);
			$baris = $data->rowcount($sheet_index=0);       
        	$thpel=substr($data->val(3,4),2,1);
        	$aspek=substr($data->val(5,4),2,1);
			$isidata=$baris-8;
			$sukses = 0;
			$gagal = 0;
			$update=0;	
			for ($i=6; $i<=$baris; $i++)
			{
				$xnis=$data->val($i,2);
				$xnisn=$data->val($i,3);
				$xnama=$data->val($i,4);
				$xnilai = $data->val($i,5); 
				$xpred = $data->val($i,6); 
				$xdes = $data->val($i,7); 
				$xmapel = $data->val($i,8);
				$ds=viewdata('tbsiswa',array('nis'=>$xnis,'nisn'=>$xnisn))[0];
            	$idsiswa=$ds['idsiswa'];
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
				else {
					$key=array(
						'idsiswa'=>$idsiswa,
						'idthpel'=>$xthpel,
						'idmapel'=>$xmapel,
						'aspek'=>$aspek
					); 
					$cekrapor=cekdata('tbnilairapor',$key);
					if($cekrapor>0){
						$nilai=array(
							'nilairapor'=>$xnilai,
							'predikat'=>$xpred,
							'deskripsi'=>$xdes
						);
						$editnilai=editdata('tbnilairapor',$nilai,'',$key);
						if($editnilai>0){
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
					$nilai=array(
						'idsiswa'=>$idsiswa,
						'idthpel'=>$xthpel,
						'idmapel'=>$xmapel,
						'aspek'=>$aspek,
						'nilairapor'=>$xnilai,
						'predikat'=>$xpred,
						'deskripsi'=>$xdes
					);
					$tambahnilai=adddata('tbnilairapor',$nilai);
					if($tambahnilai>0){
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
<script type="text/javascript">
$(document).ready(function() {
    $("#pilih").click(function() {
        let tp = $("#txtThpel").val();
        let kls = $("#txtKls").val();
        if (tp == '' || tp == null || kls == '' || kls == null) {
            toastr.error('Kelas atau Tahun Pelajaran Tidak Boleh Kosong!', 'Mohon Maaf')
        } else {
            $(".tmpinput").removeAttr('disabled');
            $(".thpel").val(tp);
            $(".kls").val(kls);
        }
    })
})
</script>

<div class="modal fade" id="myRapor" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Import Nilai Peserta Didik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filepd">Pilih File Template Rapor</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file" id="filerapor" name="filerapor">
                                <label class="custom-file-label" for="filerapor">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
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

<div class="alert alert-danger">
    <p><strong>Petunjuk:</strong></p>
    <p>Silahkan isikan data Nilai Sikap Spiritual yang diperoleh tiap semester.<br>Nilai Akan tersimpan
        otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol
        <strong>Refresh</strong>
    </p>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Impor Dan Ekspor Nilai Peserta Didik</h4>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myRapor">
                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Upload
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row mt-2 mb-0">
            <div class="col-sm-12">
                <label>
                    Pilih Kelas dan Tahun Pelajaran
                </label>
            </div>
        </div>
        <div class="form-group row mt-2 mb-4">
            <div class="col-sm-4">
                <select class="form-control input-sm" id="txtKls">
                    <option value="">..Pilih..</option>
                    <?php
									$fkls=array('idkelas', 'nmkelas');
									$tbl=array('tbskul'=>'idjenjang');
									$qkls=fulljoin($fkls,'tbkelas',$tbl);
									foreach ($qkls as $kl):
								?>
                    <option value="<?php echo $kl['idkelas'];?>"><?php echo $kl['nmkelas'];?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-sm-4">
                <select class="form-control" id="txtThpel">
                    <option value="">..Pilih..</option>
                    <?php
                        $qtp=viewdata('tbthpel');
						foreach ($qtp as $tp):
					?>
                    <option value="<?php echo $tp['idthpel'];?>" <?php echo $tp['aktif']=='1' ? "selected" : "";?>>
                        <?php echo $tp['desthpel'];?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-warning btn-block" id="pilih">Pilih</button>
            </div>
        </div>
        <div class="form-group row mt-2 mb-2">
            <table class="table table-sm table-striped table-bordered table-condensed" id="tb_template">
                <thead>
                    <tr>
                        <th style="text-align:center;width:7.5%">No.</th>
                        <th style="text-align:center">Template <?php echo $rombel;?></th>
                        <th style="text-align:center;width:27.5%">Download Format</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center">1.</td>
                        <td>Penilaian Sikap Spiritual</td>
                        <td style="text-align:center">
                            <form action="rapor_template.php" method="post">
                                <input type="hidden" class="thpel" name="thpel1">
                                <input type="hidden" class="kls" name="kls1">
                                <button type="submit" class="btn btn-xs btn-success tmpinput" name="downloadspr"
                                    disabled="disabled">
                                    <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">2.</td>
                        <td>Penilaian Sikap Sosial</td>
                        <td style="text-align:center">
                            <form action="rapor_template.php" method="post">
                                <input type="hidden" class="thpel" name="thpel2">
                                <input type="hidden" class="kls" name="kls2">
                                <button type="submit" class="btn btn-xs btn-success tmpinput" name="downloadsos"
                                    disabled="disabled">
                                    <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">3.</td>
                        <td>Penilaian Pengetahuan</td>
                        <td style="text-align:center">
                            <form action="rapor_template.php" method="post">
                                <input type="hidden" class="thpel" name="thpel3">
                                <input type="hidden" class="kls" name="kls3">
                                <button type="submit" class="btn btn-xs btn-success tmpinput" name="downloadkog"
                                    disabled="disabled">
                                    <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">4.</td>
                        <td>Penilaian Keterampilan</td>
                        <td style="text-align:center">
                            <form action="rapor_template.php" method="post">
                                <input type="hidden" class="thpel" name="thpel4">
                                <input type="hidden" class="kls" name="kls4">
                                <button type="submit" class="btn btn-xs btn-success tmpinput" name="downloadmot"
                                    disabled="disabled">
                                    <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>