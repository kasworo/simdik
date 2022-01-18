<?php
if(isset($_POST['upload'])) {
    require_once 'assets/library/PHPExcel.php';
    require_once 'assets/library/excel_reader.php';
    if(empty($_FILES['filerwy']['tmp_name'])) {
        echo "<script>
        $(function() {
            toastr.error('File Template Riwayat Sekolah Kosong!', 'Mohon Maaf!', {
                timeOut: 1000,
                fadeOut: 1000
            });
        });
        </script>"; 
    } else {
        $data = new Spreadsheet_Excel_Reader($_FILES['filerwy']['tmp_name']);        
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
            $xaslsd=$data->val($i,6);
            $xnoijz=$data->val($i,7);
            $xtglijz=$data->val($i,8);
            $xlamasd=$data->val($i,9);
            $xaslsmp=$data->val($i,10);
            $xnosurat=$data->val($i,11);
            $xtglsurat=$data->val($i,12);
            $xalasan=$data->val($i,13);
            $ds=viewdata('tbsiswa',array('nis'=>$xnis,'nisn'=>$xnisn))[0];
            $idsiswa=$ds['idsiswa'];              
            $key=array('idsiswa'=>$idsiswa); 
                    
            $cekdata=cekdata('tbriwayatskul',$key);
            if($cekdata>0){
                if($xidreg=='1'){
                    $datane=array(
                        'aslsd'=>$xaslsd,
                        'noijazah'=>$xnoijz,
                        'tglijazah'=>$xtglijz,
                        'lama'=>$xlamasd  
                    );
                }
                else {
                    $datane=array(
                        'aslsd'=>$xaslsd,
                        'noijazah'=>$xnoijz,
                        'tglijazah'=>$xtglijz,
                        'lama'=>$xlamasd,
                        'aslsmp'=>$xaslsmp,
                        'nosurat'=>$xnosurat,
                        'tglsurat'=>$xtglsurat,
                        'alasan'=>$xalasan    
                    );
                }
                
                $edit=editdata('tbriwayatskul',$datane,'',$key);
				$update++;
            } else {
                if($xidreg=='1'){
                    $datane=array(
                        'idjreg'=>$xidreg,
                        'idsiswa'=>$idsiswa,
                        'aslsd'=>$xaslsd,
                        'noijazah'=>$xnoijz,
                        'tglijazah'=>$xtglijz,
                        'lama'=>$xlamasd
                    );
                }
                else {
                    $datane=array(
                        'idjreg'=>$xidreg,
                        'idsiswa'=>$idsiswa,
                        'aslsd'=>$xaslsd,
                        'noijazah'=>$xnoijz,
                        'tglijazah'=>$xtglijz,
                        'lama'=>$xlamasd,
                        'aslsmp'=>$xaslsmp,
                        'nosurat'=>$xnosurat,
                        'tglsurat'=>$xtglsurat,
                        'alasan'=>$xalasan    
                    );
                }                
               
                $tambah=adddata('tbriwayatskul',$datane);
				if($tambah>0){
					$sukses++;
				}					
				else {
					$gagal++;
				}
            }
            if($gagal>0){
                echo"<script>
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
                echo"<script>
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
                echo"<script>
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
<div class="modal fade" id="mySkulAsal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Import Riwayat Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filerwy">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file" id="filerwy" name="filerwy">
                                <label class="custom-file-label" for="filerwy">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="siswa_template.php?d=2" class="btn btn-success btn-sm btn-flat" target="_blank"><i
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
        <h4 class="card-title">Riwayat Pendidikan Peserta Didik</h4>
        <div class="card-tools">
            <button class="btn btn-flat btn-success btn-sm" data-target="#mySkulAsal" data-toggle="modal">
                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_siswa" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center">Nama Peserta Didik</th>
                        <th style="text-align: center;width:17.5%">NIS / NISN</th>
                        <th style="text-align: center;width:25%">Asal Sekolah</th>
                        <th style="text-align: center;width:17.5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
							$field=array('idsiswa', 'nmsiswa','nisn','nis', 'jnsregistrasi', 'idjreg','aslsd', 'aslsmp');
							$tbl=array(
								'tbriwayatskul'=>'idsiswa',
                                'ref_jnsregistrasi'=>'idjreg'		
							);
							$where =array(
								'deleted'=>'0'
							); 
							$no=0;
							$qs=leftjoin($field,'tbsiswa', $tbl, $where);
                            
							foreach($qs as $s):
							$no++;
                            if($s['idjreg']=='1'){
                                $aslskul=$s['aslsd'];
                            }
                            else {
                                $aslskul=$s['aslsmp'];
                            }
						?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?>
                        </td>
                        <td style="text-align: center"><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                        <td style="text-align: center"><?php echo $aslskul;?></td>
                        <td style="text-align:center">
                            <a href="index.php?p=addriwayat&id=<?php echo $s['idsiswa'];?>"
                                class="btn btn-sm btn-info btn-flat">
                                <i class="fas fa-edit"></i>&nbsp;Isi Riwayat
                            </a>
                        </td>
                    </tr>
                    <?php endforeach?>
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
</script>