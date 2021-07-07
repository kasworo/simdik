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
	<p>Silahkan isikan data nilai Sikap yang diperoleh tiap semester.<br/>Nilai Akan tersimpan otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol <strong>Refresh</strong></p>
</div>
<div class="card card-primary card-outline">
	<div class="card-header">
		<h5 class="m-0">Form Data Nilai Sikap</h5>
	</div>
	<div class="card-body">
			<div class="col-sm-12">
				<div class="row" style="padding-bottom:5px">
					<label class="col-sm-4 offset-sm-1">Sikap Spiritual</label>
                    <?php
					    $qtp=mysqli_query($sqlconn,"SELECT idthpel FROM tb_thpel LIMIT $awal,$akhir");
						$j=0;
                        while($tp=mysqli_fetch_array($qtp))
                        {
                            $j++;
                            $qrp=mysqli_query($sqlconn,"SELECT nilai FROM tb_sikap WHERE idthpel='$tp[idthpel]' AND aspek='1' AND idsiswa='$idsiswa'");
                            $rp=mysqli_fetch_array($qrp);
                        ?>
                    <div class="col-sm-1" style="padding-bottom:5px">
                        <input class="form-control form-control-sm" id="spiritual<?php echo $j;?>" style="text-align:center" placeholder="<?php echo $tp['idthpel'];?>" value="<?php echo $rp['nilai'];?>"/>
                    </div>
                    <script type="text/javascript">								
                        $("#spiritual<?php echo $j;?>").change(function(){
							var thpel="<?php echo $tp['idthpel'];?>";
                            var idsiswa = "<?php echo $idsiswa;?>";
                            var nilai = $("#spiritual<?php echo $j;?>").val();
                            $.ajax({
                                url: "sikap_simpan.php",
                                data: "aksi=simpan&jns=1&thpel="+thpel+"&id="+idsiswa + "&nilai="+nilai,
                                cache: false,
                                success: function(data){
								    toastr.success(data);
                                }
                            });
                        })
                    </script>
                    <?php } ?>
                </div>
                <div class="row" style="padding-bottom:5px">
					<label class="col-sm-4 offset-sm-1">Sikap Sosial</label>
                    <?php
					    $qtp=mysqli_query($sqlconn,"SELECT idthpel FROM tb_thpel LIMIT $awal,$akhir");
						$j=0;
                        while($tp=mysqli_fetch_array($qtp))
                        {
                            $j++;
                            $qrp=mysqli_query($sqlconn,"SELECT nilai FROM tb_sikap WHERE idthpel='$tp[idthpel]' AND aspek='2' AND idsiswa='$idsiswa'");
                            $rp=mysqli_fetch_array($qrp);
                        ?>
                    <div class="col-sm-1" style="padding-bottom:5px">
                        <input class="form-control form-control-sm" id="sosial<?php echo $j;?>" style="text-align:center" placeholder="<?php echo $tp['idthpel'];?>" value="<?php echo $rp['nilai'];?>"/>
                    </div>
                    <script type="text/javascript">								
                        $("#sosial<?php echo $j;?>").change(function(){
							var thpel="<?php echo $tp['idthpel'];?>";                           
                            var idsiswa = "<?php echo $idsiswa;?>";
                            var nilai = $("#sosial<?php echo $j;?>").val();
                            $.ajax({
                                url: "sikap_simpan.php",
                                data: "aksi=simpan&jns=2&thpel="+thpel+"&id="+idsiswa + "&nilai="+nilai,
                                cache: false,
                                success: function(data){
								    toastr.success(data);
                                }
                            });
                        })
                    </script>
                    <?php } ?>
                </div>
			</div>
	</div>
	<div class="card-footer">
		<div class="row" align="center">
			<div class="col-sm-4 col-md-4 col-lg-4" style="padding-bottom:5px">
				<a href="index.php?p=nilaisikap&j=1" class="btn btn-lg btn-default btn-flat btn-block col-8">
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
				<a href="index.php?p=nilaisikap&j=2" class="btn btn-lg btn-success btn-flat btn-block col-8">
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