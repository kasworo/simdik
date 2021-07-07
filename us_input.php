<?php
include "../config/konfigurasi.php";
$idsiswa=$_REQUEST['id'];
$qt=mysqli_query($sqlconn,"SELECT COUNT(*) as akhir FROM tb_thpel");
$t=mysqli_fetch_array($qt);
$akhir=$t['akhir'];
$awal=$akhir-6;
?>
<div class="col-sm-12">
<div class="alert alert-warning">
	<p><strong>Petunjuk:</strong></p>
	<p>Silahkan isikan data nilai pengetahuan yang diperoleh tiap semester.<br/>Nilai Akan tersimpan otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol <strong>Refresh</strong></p>
</div>
<div class="card card-primary card-outline">
	<div class="card-header">
		<h5 class="m-0">Form Data Nilai Ujian Sekolah</h5>
	</div>
	<div class="card-body">
			<div class="col-sm-12">
				<?php
						$no=0;
						$rerata=0;
						$qnil=mysqli_query($sqlconn, "SELECT idmapel, nmmapel FROM tb_mapel m INNER JOIN tb_kurikulum k USING(idkurikulum) WHERE statkurikulum='Y'");
						while($n=mysqli_fetch_array($qnil))
						{
							$no++;
                            $qus=mysqli_query($sqlconn,"SELECT nilai FROM tbus WHERE idmapel='$n[idmapel]' AND idsiswa='$idsiswa'");
                            $us=mysqli_fetch_array($qus);
						?>
							<div class="row" style="padding-bottom:5px">
								<label class="col-sm-6 offset-sm-2"><?php echo $n['nmmapel'];?></label>
								<div class="col-sm-2" style="padding-bottom:5px">
									<input class="form-control form-control-sm" id="nilai<?php echo $no;?>" style="text-align:center" placeholder="Nilai Ujian Sekolah" value="<?php echo $us['nilai'];?>"/>
                                </div>
                                    <script type="text/javascript">								
                                        $("#nilai<?php echo $no;?>").change(function(){
											var kdmapel = "<?php echo $n['idmapel'];?>";
                                            var idsiswa = "<?php echo $idsiswa;?>";
                                            var nilai = $("#nilai<?php echo $no;?>").val();
                                            $.ajax({
                                                url: "us_simpan.php",
                                                data: "aksi=simpan&kdmapel="+kdmapel+"&id="+idsiswa + "&nilai="+nilai,
                                                cache: false,
                                                success: function(data){
													toastr.success(data);
                                                }
                                            });
                                        })
                                    </script>				
							</div>
						<?php } ?>
			</div>
	</div>
	<div class="card-footer">
		<div class="row" align="center">
			<div class="col-sm-4 col-md-4 col-lg-4" style="padding-bottom:5px">
				<a href="?p=nilaius" class="btn btn-lg btn-default btn-flat btn-block col-8">
					<i class="fas fa-fw fa-arrow-left"></i>
					<span>&nbsp;Sebelumnya</span>
				</a>
			</div>
			<div class="col-sm-4 col-md-4 col-lg-4" style="padding-bottom:5px">
				<button class="btn btn-lg btn-primary btn-flat btn-block col-8" id="simpan">
					<i class="fas fa-fw fa-sync-alt"></i>
					<span>&nbsp;Refresh</span>
				</button>
			</div>
			<div class="col-sm-4 col-md-4 col-lg-4" style="padding-bottom:5px">
				<a href="?p=nilaiun" class="btn btn-lg btn-success btn-flat btn-block col-8">
					<i class="fas fa-fw fa-arrow-right"></i>
					<span>&nbsp;Berikutnya</span>
				</a>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	function validAngka(a)
	{
		if(!/^[0-9.]+$/.test(a.value))
		{
			a.value=a.value.substring(0,a.value.length-1000);
		}
	}
	$(document).ready(function(){
		$(function() {
			const Toast=Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
		})
	})
</script>