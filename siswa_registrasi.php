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
                'idthpel'=>$_POST['kdthpel'],
                'tglreg'=>$tgl    
            );
            //var_dump($data);
            $rows=adddata('tbregistrasi',$data);
            if($rows>0)
			{
				echo "<script>
					    $(function() {
                            toastr.success('Maping Rombel Untuk Peserta Didik Berhasil!','Terimakasih', {
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    window.location.href='index.php?p=regsiswa';
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
                                    window.location.href='index.php?p=regsiswa';
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
                                    window.location.href='index.php?p=regsiswa';
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
                                    window.location.href='index.php?p=regsiswa';
                                }
                            });
				        });
			        </script>";    
            }
			//exit;
		}
    }
    if(isset($_POST['upload'])){
        require_once 'assets/library/PHPExcel.php';
	    require_once 'assets/library/excel_reader.php';
	    if(empty($_FILES['filereg']['tmp_name'])) { 
		    echo "<script>
			        $(function() {
				        toastr.error('File Template Registrasi Peserta Didik Kosong!','Mohon Maaf!',{
					        timeOut:1000,
					        fadeOut:1000
				    });
			    });
		    </script>";	
	    } else {
            $data = new Spreadsheet_Excel_Reader($_FILES['filereg']['tmp_name']);        
            $baris = $data->rowcount($sheet_index=0);
            $isidata=$baris-5;        
            $sukses = 0;
            $gagal = 0;
            $update=0;
            for ($i=6; $i<=$baris; $i++)
            {
                $xnis=$data->val($i,2);           
                $xnisn=$data->val($i,3);
                $xidreg=$data->val($i,5);
                $xidkelas=$data->val($i,6);
                $xthpel=$data->val($i,7);
                $ds=viewdata('tbsiswa',array('nis'=>$xnis,'nisn'=>$xnisn))[0];
                $idsiswa=$ds['idsiswa'];
                $dreg=viewdata('tbthpel',array('nmthpel'=>$xthpel))[0];
                $idthpel=$dreg['idthpel'];
                $xtglreg=$dreg['awal'];             
                $key=array(
                    'idsiswa'=>$idsiswa,
                    'idthpel'=>$idthpel
                );                         
                $cekdata=cekdata('tbregistrasi',$key);
                if($cekdata>0){
                    $datane=array(
                        'idjreg'=>$xidreg,
                        'idkelas'=>$xidkelas,
                        'tglreg'=>$xtglreg
                    );                    
                    $edit=editdata('tbriwayatskul',$datane,'',$key);
                    $update++;
                } else {
                    $datane=array(
                        'idjreg'=>$xidreg,
                        'idsiswa'=>$idsiswa,
                        'idkelas'=>$xidkelas,
                        'idthpel'=>$idthpel,
                        'tglreg'=>$xtglreg  
                    );
                    $tambah=adddata('tbregistrasi',$datane);
                    if($tambah>0){
                        $sukses++;
                    }					
                    else {
                        $gagal++;
                    }
                }
                if($gagal>0){
                    echo "<script>
                        $(function() {
                            toastr.error('Ada ".$gagal." Data Gagal Ditambahkan','Mohon Maaf!',{
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    location.(reload);
                                }
                            });
                        });
                    </script>";
                } 
                if($sukses>0){ 
                    echo "<script>
                        $(function() {
                            toastr.success('Ada ".$sukses." Data Berhasil Ditambahkan','Terima Kasih',{
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    location.reload();
                                }
                            });
                        });
                    </script>";
                } 
                if($update>0)
                { 
                    echo "<script>
                        $(function() {
                            toastr.warning('Ada ".$update." Data Berhasil Diupdate!','Terima Kasih',{
                                timeOut:1000,
                                fadeOut:1000,
                                onHidden:function(){
                                    location.reload;
                                }
                            });
                        });
                    </script>";
                }            
            } 
        }
    }
?>
<div class="modal fade" id="myImportReg" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Registrasi Peserta Didik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filereg">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file" id="filereg" name="filereg">
                                <label class="custom-file-label" for="filereg">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="siswa_registmp.php" class="btn btn-success btn-sm btn-flat" target="_blank"><i
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
								?>
                                <option value="<?php echo $tp['idthpel'];?>"
                                    <?php echo $tp['aktif']=='1' ? "selected" : "";?>>
                                    <?php echo $tp['desthpel'];?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Kelas</label>
                            <select class="form-control input-sm col-sm-6" id="kdkelas" name="kdkelas"
                                onchange="pilkelas(this.value)">
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
<div class="col-sm-12">
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <h4 class="card-title">Registrasi Peserta Didik</h4>
            <div class="card-tools">
                <button class="btn btn-flat btn-success btn-sm" data-target="#myImportReg" data-toggle="modal">
                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                </button>
                <?php
				$where=array('idthpel'=>$_COOKIE['c_tahun']);
				$th=viewdata('tbthpel',$where)[0];
				if(substr($th['nmthpel'],-1)=='2'):
			?>
                <button class="btn btn-flat btn-primary btn-sm" data-target="#myLanjutin" data-toggle="modal">
                    <i class="fas fa-plus-circle"></i>&nbsp;Lanjutkan
                </button>
                <?php else:?>
                <button class="btn btn-flat btn-primary btn-sm" data-target="#myLanjutin" data-toggle="modal">
                    <i class="fas fa-plus-circle"></i>&nbsp;Naik Kelas
                </button>
                <?php endif;?>
            </div>
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
								'tbkelas'=>'idkelas',
                                'tbthpel tp'=>'idthpel'
							);
							$where =array(
								'tp.aktif'=>'1',
								'deleted'=>'0'
							); 
							//$qs=$conn->query("SELECT s.idsiswa, s.idthpel as thmasuk, s.nmsiswa, s.nisn, s.nis,  rb.nmrombel,rg.idjreg FROM tbsiswa s LEFT JOIN tbregistrasi rg USING(idsiswa) LEFT JOIN tbrombel rb USING(idrombel) WHERE s.deleted='0' OR rb.idthpel='$_COOKIE[c_tahun]' AND (rg.idjreg<7 OR rg.idjreg is NULL) ORDER BY s.idsiswa, rg.idrombel");
							$no=0;
							$qs=leftjoin($field,'tbsiswa', $tbl, $where);
                           // var_dump($qs);die;
							foreach($qs as $s):
							$no++;
						?>
                        <tr>
                            <td style="text-align:center"><?php echo $no.'.';?></td>
                            <td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?>
                            </td>
                            <td style="text-align: center"><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                            <td style="text-align: center"><?php echo $s['nmkelas'];?></td>
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
</div>
<script type="text/javascript" src="js/pilihkelas.js"></script>
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