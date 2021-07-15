<?php
	if(isset($_POST['ijolan'])){
		var_dump($_POST);
	}
	if(isset($_POST['btnGuru'])){
		$baru=0;
		$sql=$conn->query("SELECT idgtk, nama, tgllahir FROM tbgtk");
		while($us=$sql->fetch_array()){
			$user='G'.substr(getskul(),-8).substr('000'.$us['idgtk'],-3);
			$nama=$us['nama'];
			$pass=str_replace('-','',$us['tgllahir']);
			$guru= array(
				'nama' =>$nama,
				'user'=>$user,
				'paswd'=>$pass
			);
			if(adduser($guru,2)>0){
				$conn->query("UPDATE tbgtk SET username='$user' WHERE idgtk='$us[idgtk]'");	
			}
			$baru++;
		}
		echo "<script>
				$(function() {
					toastr.success('Ada ".$baru." Username Untuk Guru Diaktifkan!','Terima Kasih',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=datauser';
						}
					});
				});
			</script>";
	}

	if(isset($_POST['btnSiswa'])){
		$baru=0;
		$sql=$conn->query("SELECT nmsiswa, nisn, tgllahir FROM tbsiswa WHERE deleted='0'");
		while($us=$sql->fetch_array()){
			$user=$us['nisn'];
			$nama=$us['nmsiswa'];
			$pass=str_replace('-','',$us['tgllahir']);
			$data= array(
				'nama' =>$nama,
				'user'=>$user,
				'paswd'=>$pass
			);
			if(adduser($data,3)>0){			
				$conn->query("UPDATE tbsiswa SET username='$user' WHERE nisn='$us[nisn]'");
			}
			$baru++;
		}
		echo "<script>
				$(function() {
					toastr.success('Ada ".$baru." Username Untuk Guru Diaktifkan!','Terima Kasih',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=datauser';
						}
					});
				});
			</script>";
	}

	if(isset($_POST['kosongin'])){
		if(deluser()>0){
			echo "<script>
				$(function() {
					toastr.info('Username Berhasil Dikosongkan!','Terima Kasih',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.reload();
						}
					});
				});
			</script>";
		}
	}
?>
<div class="modal fade" id="myIjolUser" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="user_tukar.php">
                <div class="modal-header">
                    <h5 class="modal-title">Tukar Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 mt-1">Level Pengguna</label>
                        <select class="form-control form-control-sm col-sm-6" id="setlev" name="setlev"
                            onchange="getlev(this.value)">
                            <option value="">..Pilih..</option>
                            <option value="2">Guru</option>
                            <option value="3">Peserta Didik</option>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 mt-1">Pilih Nama</label>
                        <select class="form-control form-control-sm col-sm-6" id="setname"
                            onchange="getname(this.value)" disabled>
                            <option value="">..Pilih..</option>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 mt-1">Username</label>
                        <input class="form-control form-control-sm col-sm-6" id="setuser" name="setuser" disabled>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button name="ijolan" id="ijolan" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-sign-in-alt"></i>&nbsp;Login
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <h4 class="card-title">Data Pengguna</h4>
            <div class="card-tools">
                <button data-target="#myIjolUser" data-toggle="modal" class="btn btn-flat btn-warning btn-sm">
                    <i class="fas fa-sync-alt"></i>&nbsp;Tukar Pengguna
                </button>
                <form action="" method="post">
                    <button type="submit" name="btnSiswa" class="btn btn-flat btn-secondary btn-sm" id="btnSiswa">
                        <i class="fas fa-random"></i>&nbsp;Buat Akun Siswa
                    </button>
                    <button name="btnGuru" class="btn btn-flat btn-info btn-sm" id="btnGuru">
                        <i class="fas fa-random"></i>&nbsp;Buat Akun Guru
                    </button>
                    <button name="kosongin" id="kosongin" class="btn btn-flat btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>&nbsp;Hapus Pengguna
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tb_user" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="text-align: center;width:2.5%">No.</th>
                            <th style="text-align: center;width:17.5%">Username</th>
                            <th style="text-align: center;width:30%">Nama Lengkap</th>
                            <th style="text-align: center;width:10%">Level</th>
                            <th style="text-align: center;width:10%">Status</th>
                            <th style="text-align: center;width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$col=array(
							'level'=>'1'
						);
						$qs=viewdata('tbuser',$col,'level ASC');
						$no=0;
						foreach($qs as $s)
						{
							$no++;
							if($s['aktif']=='1'){$stat='Aktif';$btn="btn-success";} else {$stat='Non Aktif';$btn="btn-danger";}
					?>
                        <tr>
                            <td style="text-align:center"><?php echo $no.'.';?></td>
                            <td><?php echo $s['username'];?></td>
                            <td><?php echo $s['nama'];?></td>
                            <td><?php echo $s['level'];?></td>
                            <td style="text-align:center">
                                <input data-id="<?php echo base64_encode($s['username']);?>" type="button"
                                    class="btn <?php echo $btn;?> btn-flat btn-xs btnAktif" value="<?php echo $stat;?>">
                            </td>
                            <td style="text-align: center">
                                <button data-id="<?php echo base64_encode($s['username']);?>"
                                    class="btn btn-xs btn-secondary btn-flat btnReset">
                                    <i class="fas fa-sync-alt"></i>&nbsp;Reset
                                </button>
                                <a href="#" class="btn btn-xs btn-danger btn-flat">
                                    <i class="fas fa-trash-alt"></i>&nbsp;Hapus
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
<script type="text/javascript" src="js/getusername.js"></script>
<script type="text/javascript">
$(function() {
    $('#tb_user').DataTable({
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