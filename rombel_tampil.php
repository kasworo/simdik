<?php
    if(isset($_POST['simpan'])){
		if($_POST['idreg']=='1' || $_POST['idreg']=='4'){
			$idthn=array('idthpel'=>$_POST['kdthpel']);
			$th=viewdata('tbthpel',$idthn)[0];
			$tgl=$th['awal'];
		}
		else {
			$tgl=date('Y-m-d');
		}
       	$keyreg=array(
			'idsiswa'=>$_POST['idsiswa'],
			'idthpel'=>$_POST['kdthpel']
		);
		$join=array(
            'tbkelas'=>'idkelas',
            'tbthpel'=>'idthpel' 
        );
    	$cekregis=cekfulljoin('*', 'tbregistrasi', $join, $keyreg);
        if($cekregis===0){
            $data=array(
                'idsiswa'=>$_POST['idsiswa'],
                'idjreg'=>$_POST['idreg'],
                'idkelas'=>$_POST['kdkelas'],
                'tglreg'=>$tgl    
              );
            $rows=adddata('tbregistrasi',$data);
            if($rows>0)
			{
				echo "<script>
					    $(function() {
                            toastr.success('Maping Rombel Untuk Peserta Didik Berhasil!','Terimakasih', {
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    window.location.href='index.php?p=isikelas';
                                }
                            });
				        });
			        </script>";
			}
            else {
                echo "<script>
			            $(function() {
                            toastr.error('Maping Rombel Untuk Peserta Didik Gagal!','Mohon Maaf', {
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    window.location.href='index.php?p=isikelas';
                                }
                            });
				        });
			        </script>";    
            }
			//exit;
		}
		else {
            $data=array(
                'idjreg'=>$_POST['idreg'],
                'idkelas'=>$_POST['kdkelas'],
                'tglreg'=>$tgl    
            );
            $join=array('tbkelas'=>'idkelas');
            $field=array(
                'idsiswa'=>$_POST['idsiswa'],
                'idthpel'=>$_POST['kdthpel']
            );
            $rows=editdata('tbregistrasi', $data, $join, $field);
            if($rows>0)
			{
				echo "<script>
					    $(function() {
                            toastr.success('Update Maping Rombel Untuk Peserta Didik Berhasil!','Terimakasih', {
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    window.location.href='index.php?p=isikelas';
                                }
                            });
				        });
			        </script>";
			}
            else {
                echo "<script>
			            $(function() {
                            toastr.error('Update Maping Rombel Untuk Peserta Didik Gagal!','Mohon Maaf', {
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    window.location.href='index.php?p=isikelas';
                                }
                            });
				        });
			        </script>";    
            }
			//exit;
		}
    }
?>
<div class="modal fade" id="myRegPD" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judule"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Peserta Didik</label>
                            <input type="hidden" class="form-control input-sm" id="idsiswa" name="idsiswa">
                            <input type="text" class="form-control input-sm col-sm-6" id="nmsiswa" name="nmsiswa"
                                disabled="true">
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Tahun Pelajaran</label>
                            <select class="form-control input-sm col-sm-6" id="kdthpel" name="kdthpel">
                                <option value="">..Pilih..</option>
                                <?php
									$qtp=viewdata('tbthpel', $key);
									foreach($qtp as $tp):
										if($tp['idthpel']===$_COOKIE['c_tahun']){
											$ts="selected";
										}
										else {$ts='';}
								?>
                                <option value="<?php echo $tp['idthpel'];?>" <?php echo $ts;?>>
                                    <?php echo $tp['desthpel'];?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Kelas</label>
                            <select class="form-control input-sm col-sm-6" id="kdkelas" name="kdkelas"
                                onchange="pilrombel(this.value)">
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
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Terdaftar Sebagai</label>
                            <select class="form-control input-sm col-sm-6" id="idreg" name="idreg" disabled="disabled">
                                <option value="">..Pilih..</option>
                                <?php
									$qreg=$conn->query("SELECT*FROM ref_jnsregistrasi LIMIT 0,5");
									while($rg=$qreg->fetch_array()):
								?>
                                <option value="<?php echo $rg['idjreg'];?>"><?php echo $rg['jnsregistrasi'];?></option>
                                <?php endwhile?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-md col-4 btn-flat" id="simpan" name="simpan">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btn-md col-4 btn-flat" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="myLanjutin" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judule">Registrasi Peserta Didik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group row mb-2">
                        <label class="col-sm-5">Rombel Lama</label>
                        <select class="form-control input-sm col-sm-6" id="rombelold" name="rombelold">
                            <option value="">..Pilih..</option>
                            <?php
								$sblm=$_COOKIE['c_tahun']-1;
								$qrb0=$conn->query("SELECT*FROM tbrombel WHERE idthpel='$sblm'");
								while($rb0=$qrb0->fetch_array()):
							?>
                            <option value="<?php echo $rb0['idrombel'];?>"><?php echo $rb0['nmrombel'];?></option>
                            <?php endwhile?>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5">Rombel Baru</label>
                        <select class="form-control input-sm col-sm-6" id="rombelnew" name="rombelnew">
                            <option value="">..Pilih..</option>
                            <?php
									$skrg=$_COOKIE['c_tahun'];
									$qrb=$conn->query("SELECT*FROM tbrombel WHERE idthpel='$skrg'");
									while($rb=$qrb->fetch_array()):
								?>
                            <option value="<?php echo $rb['idrombel'];?>"><?php echo $rb['nmrombel'];?></option>
                            <?php endwhile?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary btn-md col-4 btn-flat" id="lanjutkan">
                    <i class="fas fa-arrow-right"></i> Lanjutkan
                </button>
                <button type="button" class="btn btn-danger btn-md col-4 btn-flat" data-dismiss="modal">
                    <i class="fas fa-power-off"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Registrasi Peserta Didik</h4>
        <?php
				$where=array('idthpel'=>$_COOKIE['c_tahun']);
				$th=viewdata('tbthpel',$where)[0];
				if(substr($th['nmthpel'],-1)=='2'):
			?>
        <div class="card-tools">
            <button class="btn btn-flat btn-primary btn-sm" data-target="#myLanjutin" data-toggle="modal">
                <i class="fas fa-plus-circle"></i>&nbsp;Lanjutkan
            </button>
        </div>
        <?php else:?>
        <div class="card-tools">
            <button class="btn btn-flat btn-primary btn-sm" data-target="#myLanjutin" data-toggle="modal">
                <i class="fas fa-plus-circle"></i>&nbsp;Naik Kelas
            </button>
        </div>
        <?php endif;?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_siswa" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center">Nama Peserta Didik</th>
                        <th style="text-align: center;width:20%">NIS / NISN</th>
                        <th style="text-align: center;width:10%">Kelas</th>
                        <th style="text-align: center;width:17.5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
							$field=array('idsiswa', 'idthpel','nmsiswa','nisn','nis', 'nmkelas', 'idjreg');
							$tbl=array(
								'tbregistrasi'=>'idsiswa',
								'tbkelas'=>'idkelas'
							);
							$where =array(
								//'idthpel'=>$_COOKIE['c_tahun'],
								'deleted'=>'0'
							); 
							//$qs=$conn->query("SELECT s.idsiswa, s.idthpel as thmasuk, s.nmsiswa, s.nisn, s.nis,  rb.nmrombel,rg.idjreg FROM tbsiswa s LEFT JOIN tbregistrasi rg USING(idsiswa) LEFT JOIN tbrombel rb USING(idrombel) WHERE s.deleted='0' OR rb.idthpel='$_COOKIE[c_tahun]' AND (rg.idjreg<7 OR rg.idjreg is NULL) ORDER BY s.idsiswa, rg.idrombel");
							$no=0;
							$qs=leftjoin($field,'tbsiswa', $tbl, $where);
                            var_dump($qs);die;
							foreach($qs as $s):
							$no++;
						?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?>
                        </td>
                        <td style="text-align: center"><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                        <td style="text-align: center"><?php echo $s['idjreg'].'/'.$s['nmrombel'];?></td>
                        <td style="text-align:center">
                            <button data-target="#myRegPD" data-toggle="modal" data-id="<?php echo $s['idsiswa'];?>"
                                class="btn btn-sm btn-secondary btn-flat col-sm-8 btnRegistrasi">
                                <i class="fas fa-edit"></i>&nbsp;Registrasi
                            </button>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/pilihrombel.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#myRegPD").on('hidden.bs.modal', function() {
        window.location.reload();
    })
})
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
$("#kdrombel").change(function() {
    var rmb = $(this).val();
    if (rmb == '' || rmb == null) {
        toastr.error('Pilih Rombel Dulu!');
    } else {
        $("#idreg").removeAttr('disabled');
    }
})

$(".btnRegistrasi").click(function() {
    var id = $(this).data('id');
    $.ajax({
        url: 'rombel_json.php',
        type: 'post',
        dataType: 'json',
        data: 'id=' + id,
        success: function(e) {
            $("#judule").html(e.judul);
            $("#idsiswa").val(e.idsiswa);
            $("#nmsiswa").val(e.nmsiswa);
            $("#kdkelas").val(e.kelas);
            $("#kdrombel").val(e.rombel);
            $("#idreg").val(e.regis);
            $("#simpan").html(e.tmb);
        }
    })
})
$("#lanjutkan").click(function() {
    var rblama = $("#rombelold").val();
    var rbnew = $("#rombelnew").val();
    $.ajax({
        url: "rombel_simpan.php",
        type: 'POST',
        data: 'aksi=2&rl=' + rblama + "&rb=" + rbnew,
        success: function(data) {
            toastr.success(data)
        }
    })
})
$("#btnrefresh").click(function() {
    window.location.reload();
})
</script>