<script type="text/javascript">
$(document).ready(function () {
	bsCustomFileInput.init();
});
</script>
<?php if(!empty($_REQUEST['d']) && $_REQUEST['d']=='1'){include "us_upload.php";} ?>
                                                                                        
<div class="modal fade" id="myImportUS" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="?p=nilaius&d=1" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Import Nilai Ujian Sekolah</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<label for="tmpus">Pilih File Template</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="tmpus" name="tmpus">
								<label class="custom-file-label" for="tmpus">Pilih file</label>
							</div>              
							<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel 97-2003)</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
          <a href="us_template.php" class="btn btn-success btn-sm btn-flat" target="_blank"><i class="fas fa-download"></i> Download</a>
					<button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-upload"></i> Upload</button>
					<button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i class="fas fa-power-off"></i> Tutup</button>
				</div>
			</form>
		</div>
			<!-- /.modal-content -->
	</div>
		<!-- /.modal-dialog -->
</div>
<div class="col-sm-12">
    <div class="alert alert-info">
    </div>
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <h4 class="card-title">Daftar Rekap Nilai Ujian Sekolah</h4>
        </div>
        <div class="card-body">
          <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#myImportUS">
                        <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                    </button>
                    <a href="?p=nilairapor" class="btn btn-flat btn-secondary btn-sm">
                        <i class="fas fa-plus-circle"></i>&nbsp;Nilai Rapor
                    </a>
                    <a href="?p=nilaisikap" class="btn btn-flat btn-danger btn-sm">
                        <i class="fas fa-plus-circle"></i>&nbsp;Nilai Sikap
                    </a>                    
                    <a href="?p=nilaiun" class="btn btn-flat btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i>&nbsp;Nilai UN
                    </a>
                </div>
            </div>
            <br/>
            <div class="table-responsive">
              <table id="tb_us" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th style="text-align: center;width:2.5%">No.</th>
                  <th style="text-align: center;width:15%">NIS/NISN</th>
                  <th>Nama Peserta Didik</th>
                  <th style="text-align: center;width:12.5%">Jumlah</th>
                  <th style="text-align: center;width:12.5%">Rata-rata</th>                   
                  <th style="text-align: center;width:17.5%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $qs=mysqli_query($sqlconn,"SELECT idsiswa, nama, nis, nisn FROM tb_siswa WHERE deleted='0'");
                    $no=0;
                    $jum=0;
                    while($s=mysqli_fetch_array($qs))
                    {
                        $no++;
                ?>
                <tr>
                  <td style="text-align:center"><?php echo $no.'.';?></td>                  
                  <td><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                  <td><?php echo $s['nama'];?></td>
                  <td style="text-align: center">
                    <?php
                        $sql=mysqli_query($sqlconn,"SELECT SUM(nilai) as jml, ROUND(AVG(nilai),2) as rata FROM tb_us WHERE idsiswa='$s[idsiswa]' GROUP BY idsiswa");
                        $q=mysqli_fetch_array($sql);
                        echo $q['jml'];
                    ?>
                  </td>
                  <td style="text-align: center">
                    <?php
                        echo $q['rata'];        
                    ?>
                  </td>
                  <td style="text-align: center">
                    <a href="?p=addus&id=<?php echo $s['idsiswa'];?>" class="btn btn-xs btn-secondary btn-flat">
                        <i class="fas fa-edit"></i>&nbsp;Input Nilai
                    </a>
                  </td>
                </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(function () {
    $('#tb_us').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>