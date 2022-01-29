<?php
	if(isset($_POST['upload'])) {
        require_once 'assets/library/PHPExcel.php';
	    require_once 'assets/library/excel_reader.php';
		if(empty($_FILES['filerapor']['tmp_name'])) { 
			echo "<script>
				$(function() {
					toastr.error('File Template Nilai Kosong!','Mohon Maaf!',{
						timeOut:3000,
						fadeOut:3000
					});
				});
			</script>";	
		} 
        else {
            $data = new Spreadsheet_Excel_Reader($_FILES['filerapor']['tmp_name']);
            $baris = $data->rowcount($sheet_index=0);
            $cekkolom= $data->colcount($sheet_index=0);             
            $isidata=$baris-9;                       
            if($_POST['tmp']=='1'){
                if($cekkolom!=54){
                    echo "<script>
                        $(function() {
                            toastr.error('File Template Nilai Rapor Salah!','Mohon Maaf!',{
                                timeOut:3000,
                                fadeOut:3000
                            });
                        });
                    </script>";
                }
                else {                      
                    $skskog = 0;$btlkog = 0; $updkog = 0; $gglkog=0;
                    $sksmot = 0;$btlmot = 0; $updmot = 0; $gglmot=0;
                    $sksspr = 0;$btlspr = 0; $updspr = 0; $gglspr=0;
                    $skssos = 0;$btlsos = 0; $updsos = 0; $gglsos=0;
                    $sksabs = 0;$btlabs = 0; $updabs = 0; $gglabs=0;
                    $skseks = 0;$btleks = 0; $updeks = 0; $ggleks=0;                    
                    for ($i=10; $i<=$baris; $i++)
                    {
                        $xnis=$data->val($i,2);
                        $xnmsiswa=$data->val($i,3);
                        $xthpel=$data->val($i,4);
                        $ds=viewdata('tbsiswa',array('nis'=>$xnis))[0];
                        $idsiswa=$ds['idsiswa'];               
                        $qtp="SELECT idthpel FROM tbthpel WHERE nmthpel='$xthpel'";
                        $tp=vquery($qtp)[0];
                        $idthpel=$tp['idthpel'];
                        $qmp="SELECT akmapel FROM tbmapel m INNER JOIN tbkurikulum k USING(idkur)";               
                        $jmp=cquery($qmp);
                        for ($j=1;$j<=$jmp;$j++){
                            $xakmapel=$data->val(6,($j-1)*4+5);
                            $sqm="SELECT idmapel FROM tbmapel WHERE akmapel='$xakmapel'";
                            $mp=vquery($sqm)[0];
                            $idmapel=$mp['idmapel'];
                            $xnkog=$data->val($i,($j-1)*4+5);
                            $xpkog=$data->val($i,($j-1)*4+6);
                            $xnmot=$data->val($i,($j-1)*4+7);
                            $xpmot=$data->val($i,($j-1)*4+8);
                            $keykog=array(
                                'idsiswa'=>$idsiswa,
                                'idmapel'=>$idmapel,
                                'idthpel'=>$idthpel,
                                'aspek'=>'3'
                            );
                            if(cekdata('tbnilairapor',$keykog)>0){
                                $nilai=array(
                                    'nilairapor'=>$xnkog,
                                    'predikat'=>$xpkog
                                );
                                if(editdata('tbnilairapor',$nilai,'',$keykog)>0){$updkog++;} else {$btlkog++;}
                            }
                            else {
                                $nilai = array(
                                    'idsiswa'=>$idsiswa,
                                    'idmapel'=>$idmapel,
                                    'idthpel'=>$idthpel,				
                                    'nilairapor'=>$xnkog,
                                    'predikat'=>$xpkog,
                                    'aspek'=>'3'
                                );				
                                if(adddata('tbnilairapor',$nilai)>0){$skskog++;} else {$gglkog++;}
                            }
                            $keymot=array(
                                'idsiswa'=>$idsiswa,
                                'idmapel'=>$idmapel,
                                'idthpel'=>$idthpel,
                                'aspek'=>'4'
                            );
                            
                            if(cekdata('tbnilairapor',$keymot)>0){
                                $nilai=array(
                                    'nilairapor'=>$xnmot,
                                    'predikat'=>$xpmot
                                );
                                if(editdata('tbnilairapor',$nilai,'',$keymot)>0){$updmot++;} else {$btlmot++;}
                            }
                            else {
                                $nilai = array(
                                    'idsiswa'=>$idsiswa,
                                    'idmapel'=>$idmapel,
                                    'idthpel'=>$idthpel,				
                                    'nilairapor'=>$xnmot,
                                    'predikat'=>$xpmot,
                                    'aspek'=>'4'
                                );				
                                if(adddata('tbnilairapor',$nilai)>0){$sksmot++;} else {$gglmot++;}
                            }
                        }
                        $keyspr=array(
                            'idsiswa'=>$idsiswa,
                            'idthpel'=>$idthpel,
                            'aspek'=>'1'
                        );
                    
                        $xnspr=KonversiHuruf($data->val($i,$jmp*4+7));                    
                        if(cekdata('tbnilaisikap',$keyspr)>0){
                            $sikap=array(
                                'nilaisikap'=>$xnspr
                            );
                            if(editdata('tbnilaisikap',$nilai,'',$keyspr)>0){$updspr++;} else {$btlspr++;}
                        }
                        else {
                            $sikap = array(
                                'idsiswa'=>$idsiswa,
                                'idthpel'=>$idthpel,				
                                'nilaisikap'=>$xnspr,
                                'aspek'=>'1'
                            );				
                            if(adddata('tbnilaisikap',$sikap)>0){$sksspr++;} else {$gglspr++;}
                        }

                        $keysos=array(
                        'idsiswa'=>$idsiswa,
                        'idthpel'=>$idthpel,
                        'aspek'=>'2'
                        );
                        $xnsos=KonversiHuruf($data->val($i,$jmp*4+8));
                            
                        if(cekdata('tbnilaisikap',$keysos)>0){
                            $sikap=array(
                                'nilaisikap'=>$xnsos
                            );
                            if(editdata('tbnilaisikap',$sikap,'',$keysos)>0){$updsos++;} else {$btlsos++;}
                        }
                        else {
                            $sikap= array(
                            'idsiswa'=>$idsiswa,
                            'idthpel'=>$idthpel,
                                'nilaisikap'=>$xnsos,
                                'aspek'=>'2'
                            );				
                            if(adddata('tbnilaisikap',$sikap)>0){$skssos++;} else {$gglsos++;}
                        }

                        $keyabs=array(
                        'idsiswa'=>$idsiswa,
                        'idthpel'=>$idthpel
                        );
                        $xskt=$data->val($i,$jmp*4+9);
                        $xizn=$data->val($i,$jmp*4+10);
                        $xalp=$data->val($i,$jmp*4+11);
                        if(cekdata('tbabsensi',$keyabs)>0){
                            $absen=array(
                            'sakit'=>$xskt,
                            'izin'=>$xizn,
                            'alpa'=>$xalp
                            );
                            if(editdata('tbabsensi',$absen,'',$keyabs)>0){$updabs++;} else {$btlabs++;}
                        }
                        else {
                            $absen = array(
                                'idsiswa'=>$idsiswa,
                                'idthpel'=>$idthpel,				
                                'sakit'=>$xskt,
                                'izin'=>$xizn,
                                'alpa'=>$xalp
                            );				
                            if(adddata('tbabsensi',$absen)>0){$sksabs++;} else {$gglabs++;}
                        }                   
                        //Ekstrakurikuler
                        $qek="SELECT akekskul FROM tbekskul";               
                        $jeks=cquery($qek);
                        for($k=1;$k<=$jeks;$k++){
                            $xakekskul=$data->val(8,($k-1)+$jmp*4+12);
                            $qeks="SELECT idekskul FROM tbekskul WHERE akekskul='$xakekskul'";
                            $eks=vquery($qeks)[0];
                            $idekskul=$eks['idekskul'];                    
                            $keyeks=array(
                                'idsiswa'=>$idsiswa,
                                'idthpel'=>$idthpel,
                                'idekskul'=>$idekskul
                            );                    
                            $xneks=KonversiHuruf($data->val($i,($k-1)+$jmp*4+12)); 
                            if(cekdata('tbnilaiekskul',$keyeks)>0){
                                $ekskul=array(
                                    'nilaieks'=>$xneks
                                );
                                if(editdata('tbnilaiekskul',$ekskul,'',$keyeks)>0){$updeks++;} else {$btleks++;}
                            }
                            else {
                                $ekskul = array(
                                    'idsiswa'=>$idsiswa,
                                    'idthpel'=>$idthpel,
                                    'idekskul'=>$idekskul,
                                    'nilaieks'=>$xneks
                                );                        			
                                if(adddata('tbnilaiekskul',$ekskul)>0){$skseks++;} else {$ggleks++;}
                            }
                        }                          
                    }
                }
                //sisipkan pesan di sini
            }
            
            if($_POST['tmp']=='2'){
                if($cekkolom!=26){
                    echo "<script>
                        $(function() {
                            toastr.error('File Template Nilai Ujian Sekolah Salah!','Mohon Maaf!',{
                                timeOut:3000,
                                fadeOut:3000
                            });
                        });
                    </script>";
                }
                else {
                    $sksust = 0;$btlust = 0; $updust = 0; $gglust=0;
                    $sksusp = 0;$btlusp = 0; $updusp = 0; $gglusp=0;
                    for ($i=10; $i<=$baris; $i++)
                    {
                        $xnis=$data->val($i,2);
                        $xnmsiswa=$data->val($i,3);
                        $xthpel=$data->val($i,4);
                        $ds=viewdata('tbsiswa',array('nis'=>$xnis))[0];
                        $idsiswa=$ds['idsiswa'];               
                        $qtp="SELECT idthpel FROM tbthpel WHERE nmthpel='$xthpel'";
                        $tp=vquery($qtp)[0];
                        $idthpel=$tp['idthpel'];
                        $qmp="SELECT akmapel FROM tbmapel m INNER JOIN tbkurikulum k USING(idkur)";               
                        $jmp=cquery($qmp);
                        for ($j=1;$j<=$jmp;$j++){
                            $xakmapel=$data->val(6,($j-1)*2+5);
                            $sqm="SELECT idmapel FROM tbmapel WHERE akmapel='$xakmapel'";
                            $mp=vquery($sqm)[0];
                            $idmapel=$mp['idmapel'];
                            $xnust=$data->val($i,($j-1)*2+5);
                            $xnusp=$data->val($i,($j-1)*2+6);
                            $keyust=array(
                                'idsiswa'=>$idsiswa,
                                'idmapel'=>$idmapel,
                                'idthpel'=>$idthpel,
                                'aspek'=>'3'
                            );
                            if(cekdata('tbnilaius',$keyust)>0){
                                $nilai=array(
                                    'nilaius'=>$xnust
                                );
                                if(editdata('tbnilaus',$nilai,'',$keyust)>0){$updust++;} else {$btlust++;}
                            }
                            else {
                                $nilai = array(
                                    'idsiswa'=>$idsiswa,
                                    'idmapel'=>$idmapel,
                                    'idthpel'=>$idthpel,				
                                    'nilaius'=>$xnust,
                                    'aspek'=>'3'
                                );				
                                if(adddata('tbnilaius',$nilai)>0){$sksust++;} else {$gglust++;}
                            }
                            $keyusp=array(
                                'idsiswa'=>$idsiswa,
                                'idmapel'=>$idmapel,
                                'idthpel'=>$idthpel,
                                'aspek'=>'4'
                            );
                            if(cekdata('tbnilaius',$keyusp)>0){
                                $nilai=array(
                                    'nilaius'=>$xnusp
                                );
                                if(editdata('tbnilaus',$nilai,'',$keyusp)>0){$updusp++;} else {$btlusp++;}
                            }
                            else {
                                $nilai = array(
                                    'idsiswa'=>$idsiswa,
                                    'idmapel'=>$idmapel,
                                    'idthpel'=>$idthpel,				
                                    'nilaius'=>$xnusp,
                                    'aspek'=>'4'
                                );				
                                if(adddata('tbnilaius',$nilai)>0){$sksusp++;} else {$gglusp++;}
                            }
                            
                        }
                    }
                }
                //sisipkan pesan di sini
            }

            if($_POST['tmp']=='3'){
                if($cekkolom!=15){
                    echo "<script>
                        $(function() {
                            toastr.error('File Template Nilai Ijazah Salah!','Mohon Maaf!',{
                                timeOut:3000,
                                fadeOut:3000
                            });
                        });
                    </script>";
                }
                else {
                    $sksijz = 0;$btlijz = 0; $updijz = 0; $gglijz=0;
                    for ($i=10; $i<=$baris; $i++)
                    {
                        $xnis=$data->val($i,2);
                        $xnmsiswa=$data->val($i,3);
                        $xthpel=$data->val($i,4);
                        $ds=viewdata('tbsiswa',array('nis'=>$xnis))[0];
                        $idsiswa=$ds['idsiswa'];               
                        $qtp="SELECT idthpel FROM tbthpel WHERE nmthpel='$xthpel'";
                        $tp=vquery($qtp)[0];
                        $idthpel=$tp['idthpel'];
                        $qmp="SELECT akmapel FROM tbmapel m INNER JOIN tbkurikulum k USING(idkur)";               
                        $jmp=cquery($qmp);
                        for ($j=1;$j<=$jmp;$j++){
                            $xakmapel=$data->val(6,($j-1)*2+5);
                            $sqm="SELECT idmapel FROM tbmapel WHERE akmapel='$xakmapel'";
                            $mp=vquery($sqm)[0];
                            $idmapel=$mp['idmapel'];
                            $xnijz=$data->val($i,($j-1)*2+5);
                            $xnusp=$data->val($i,($j-1)*2+6);
                            $keyijz=array(
                                'idsiswa'=>$idsiswa,
                                'idmapel'=>$idmapel,
                                'idthpel'=>$idthpel
                            );
                            if(cekdata('tbnilaiijz',$keyijz)>0){
                                $nilai=array(
                                    'nilaiijz'=>$xnijz
                                );
                                if(editdata('tbnilijz',$nilai,'',$keyijz)>0){$updijz++;} else {$btlijz++;}
                            }
                            else {
                                $nilai = array(
                                    'idsiswa'=>$idsiswa,
                                    'idmapel'=>$idmapel,
                                    'idthpel'=>$idthpel,				
                                    'nilaiijz'=>$xnijz
                                );				
                                if(adddata('tbnilaiijz',$nilai)>0){$sksijz++;} else {$gglijz++;}
                            }                            
                            
                        }
                    }
                }
                //sisipkan pesan di sini
            }
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
            $(".tmpimport").removeAttr('disabled');
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
                        <div class="row mt-3">
                            <input type="hidden" name="tmp" id="template">
                            <label for="filepd">Pilih File Template</label>
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
                    <button type="submit" name="upload" class="btn btn-primary">
                        <i class="fas fa-upload"></i>&nbsp;Upload
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-power-off"></i>
                        Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="alert alert-danger">
    <p><strong>Petunjuk:</strong></p>
    <ul>
        <li>Silahkan pilih kelas dan tahun pelajaran terlebih dahulu, kemudian klik tombol <strong>Pilih</strong> agar
            tombol
            Download template aktif.
        </li>
        <li>Setelah template import data terisi, silahkan upload dengan cara klik tombol
            <strong>Import</strong>, kemudian
            pilihlah dimana file template tersimpan dengan cara klik tombol Browse.
        </li>
        <li>Pastikan anda memilih file template yang benar, kemudian klik tombol <strong>Upload</strong>, tunggu
            beberapa
            saat proses import data selesai.
        </li>
    </ul>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Impor Dan Ekspor Nilai Peserta Didik</h4>
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
                        <th style="text-align:center">Format Template</th>
                        <th style="text-align:center;width:27.5%">Download Format</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center">1.</td>
                        <td>Nilai Rapor</td>
                        <td style="text-align:center">
                            <form action="rapor_template.php" method="post">
                                <input type="hidden" class="thpel" name="thnrpt">
                                <input type="hidden" class="kls" name="klsrpt">
                                <button type="submit" class="btn btn-xs btn-success tmpinput" name="downrpt"
                                    id="downrpt" disabled="disabled">
                                    <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                                </button>
                                <a href="#" class="btn btn-xs btn-info tmpimport" name="uplrpt" id="uplrpt"
                                    disabled="disabled" data-toggle="modal" data-target="#myRapor" data-id="1">
                                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                                </a>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">2.</td>
                        <td>Nilai Ujian Sekolah</td>
                        <td style="text-align:center">
                            <form action="rapor_template.php" method="post">
                                <input type="hidden" class="thpel" name="thnuas">
                                <input type="hidden" class="kls" name="klsuas">
                                <button type="submit" class="btn btn-xs btn-success tmpinput" name="downuas"
                                    id="downuas" disabled="disabled">
                                    <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                                </button>
                                <a href="#" class="btn btn-xs btn-info tmpimport" name="upluas" id="upluas"
                                    disabled="disabled" data-toggle="modal" data-target="#myRapor" data-id="2">
                                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                                </a>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">3.</td>
                        <td>Nilai Ijazah</td>
                        <td style="text-align:center">
                            <form action="rapor_template.php" method="post">
                                <input type="hidden" class="thpel" name="thnijz">
                                <input type="hidden" class="kls" name="klsijz">
                                <button type="submit" class="btn btn-xs btn-success tmpinput" name="downijz"
                                    id="downijz" disabled="disabled">
                                    <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                                </button>
                                <a href="#" class="btn btn-xs btn-info tmpimport" name="uplijz" id="uplizj"
                                    disabled="disabled" data-toggle="modal" data-target="#myRapor" data-id="3">
                                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                                </a>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    $(".tmpimport").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (id == '1') {
            $(".modal-title").html("Import Nilai Raport");
        }
        if (id == '2') {
            $(".modal-title").html("Import Nilai Ujian Sekolah");
        }
        if (id == '3') {
            $(".modal-title").html("Import Nilai Ijazah");
        }
        $("#template").val(id);
    })
    </script>