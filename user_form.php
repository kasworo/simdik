<?php
include "config/function_user.php";
?>
<div class="col-sm-12">
    <div class="alert alert-warning">
        <p><strong>Petunjuk</strong><br/>Silahkan cek kembali data anda, lengkapi dan betulkan jika masih terdapat data yang masih kurang atau salah, kemudian klik tombol <strong>Update</strong></p>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Data Pengguna</h5>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <div id="fotouser" style="text-align:center;margin-top:10px">
                        <img class="img img-responsive img-circle" src="<?php echo $fotouser;?>" width="100%"/>
                        <span id="fotouser_status"></span>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Nama Pengguna</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="nmuser" id="nmuser" value="<?php echo $nama;?>">
                        </div>
                    </div>				
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">NIP</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="nip" id="nip" value="<?php echo $nip;?>" onkeyup="validAngka(this)"> 
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Tempat Lahir</label>			
                        <div class="col-sm-6">
                            <input class="form-control" name="tmplahir" id="tmplahir" value="<?php echo $tmpl;?>">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Tanggal Lahir</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="tgllahir" id="tgllahir" value="<?php echo $tgll;?>">
                        </div>
                    </div>				
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Jenis Kelamin</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="gender" id="gender">
                                <?php
                                if($gend=="L"){$jk0="";$jk1="selected";$jk2="";}
                                else if($gend=="P"){$jk0="";$jk1="";$jk2="selected";}
                                else {$jk0="selected";$jk1="";$jk2="";}
                                ?>
                                <option value="" <?php echo $jk0;?>>..Pilih..</option>
                                <option value="L" <?php echo $jk1;?>>Laki-laki</option>
                                <option value="P" <?php echo $jk2;?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Agama</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="agama" id="agama">
                                <?php
                                    switch ($agma) {
                                        case 'A':{
                                            $agm1="selected";$agm2="";$agm3="";
                                            $agm4="";$agm5="";$agm6="";break;
                                        }
                                        case 'B':{
                                            $agm2="selected";$agm1="";$agm3="";
                                            $agm4="";$agm5="";$agm6="";break;
                                        }
                                        case 'C':{
                                            $agm3="selected";$agm2="";$agm1="";
                                            $agm4="";$agm5="";$agm6="";break;
                                        }
                                        case 'D':{
                                            $agm4="selected";$agm2="";$agm3="";
                                            $agm1="";$agm5="";$agm6="";break;
                                        }
                                        case 'E':{
                                            $agm5="selected";$agm2="";$agm3="";
                                            $agm4="";$agm1="";$agm6="";break;
                                        }
                                        case 'F':{
                                            $agm5="selected";$agm2="";$agm3="";
                                            $agm4="";$agm5="";$agm1="";break;
                                        }
                                        default:{
                                            $agm1="";$agm2="";$agm3="";
                                            $agm4="";$agm5="";$agm6="";break;
                                        }
                                        
                                    }
                                ?>
                                <option value="">..Pilih..</option>
                                <option <?php echo $agm1;?> value="A">Islam</option>
                                <option <?php echo $agm2;?> value="B">Kristen</option>
                                <option <?php echo $agm3;?> value="C">Katholik</option>
                                <option <?php echo $agm4;?> value="D">Hindu</option>
                                <option <?php echo $agm5;?> value="E">Buddha</option>
                                <option <?php echo $agm6;?> value="F">Konghucu</option>
                            </select>
                        </div>                        
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Jabatan Dinas</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="jbtd" id="jbtd">
                                <?php
                                    switch($jbtd){
                                        case '1':{$jbtd1='selected';$jbtd2='';$jbtd3='';$jbtd4='';$jbtd5='';break;}
                                        case '2':{$jbtd1='';$jbtd2='selected';$jbtd3='';$jbtd4='';$jbtd5='';break;}
                                        case '3':{$jbtd1='';$jbtd2='';$jbtd3='selected';$jbtd4='';$jbtd5='';break;}
                                        case '4':{$jbtd1='';$jbtd2='';$jbtd3='';$jbtd4='selected';$jbtd5='';break;}
                                        case '5':{$jbtd1='';$jbtd2='';$jbtd3='';$jbtd4='';$jbtd5='selected';break;}
                                        default:{$jbtd1='';$jbtd2='';$jbtd3='';$jbtd4='';$jbtd5='';break;}
                                    }
                                ?>
                                <option value="">..Pilih..</option>
                                <option value="1" <?php echo $jbtd1;?>>Kepala Sekolah</option>
                                <option value="2" <?php echo $jbtd2;?>>Wakil Kepala Sekolah</option>
                                <option value="3" <?php echo $jbtd3;?>>Guru Bidang Studi</option>
                                <option value="4" <?php echo $jbtd4;?>>Guru BP/BK</option>
                                <option value="5" <?php echo $jbtd5;?>>Tenaga Administrasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Jabatan Panitia</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="jbtp" id="jbtp">
                                <?php
                                switch($jbtp){
                                    case '1':{$jbtp1='selected';$jbtp2='';$jbtp3='';$jbtp4='';$jbtp5='';$jbtp6="";break;}
                                    case '2':{$jbtp1='';$jbtp2='selected';$jbtp3='';$jbtp4='';$jbtp5='';$jbtp6="";break;}
                                    case '3':{$jbtp1='';$jbtp2='';$jbtp3='selected';$jbtp4='';$jbtp5='';$jbtp6="";break;}
                                    case '4':{$jbtp1='';$jbtp2='';$jbtp3='';$jbtp4='selected';$jbtp5='';$jbtp6="";break;}
                                    case '5':{$jbtp1='';$jbtp2='';$jbtp3='';$jbtp4='';$jbtp5='selected';$jbtp6="";break;}
                                    case '6':{$jbtp1='';$jbtp2='';$jbtp3='';$jbtp4='';$jbtp5='';$jbtp6="selected";break;}
                                    default:{$jbtp1='';$jbtp2='';$jbtp3='';$jbtp4='';$jbtp5='';break;}
                                }
                                ?>
                                <option value="">..Pilih..</option>
                                <option value="1" <?php echo $jbtp1;?>>Penanggung Jawab</option>
                                <option value="2" <?php echo $jbtp2;?>>Ketua Panitia</option>
                                <option value="3" <?php echo $jbtp3;?>>Wakil Ketua Panitia</option>
                                <option value="4" <?php echo $jbtp4;?>>Sekretaris</option>
                                <option value="5" <?php echo $jbtp5;?>>Bendahara</option>
                                <option value="6" <?php echo $jbtp6;?>>Anggota</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Alamat E-mail</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="imel" id="imel" value="<?php echo $imel;?>">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Alamat</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="almt" id="almt" value="<?php echo $almt;?>">
                        </div>
                    </div>				
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Desa / Kelurahan</label>
                        <div class="col-sm-6">		
                            <input class="form-control" name="desa" id="desa" value="<?php echo $desa;?>">		
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Kecamatan</label>
                        <div class="col-sm-6">		
                            <input class="form-control" name="kec" id="kec" value="<?php echo $kec;?>">	
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Kabupaten</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="kab" id="kab" value="<?php echo $kab;?>">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Provinsi</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="prov" id="prov" value="<?php echo $prov;?>">
                        </div>
                    </div>					
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Kode Pos</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="kdpos" id="kdpos" value="<?php echo $kpos;?>">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <label class="col-sm-5 offset-sm-1">Nomor HP</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="nohp" id="nohp" value="<?php echo $nohp;?>">
                        </div>
                    </div>
                </div>
            </div>
                </div>        
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary btn-md btn-flat" id="simpan">
                <i class="fas fa-fw fa-save"></i>
                <span>&nbsp;Simpan</span>
            </button>
            <?php if($_COOKIE['c_login']=='1'):?>
            <a href="index.php?p=datauser" class="btn btn-md btn-danger btn-flat">
                <i class="fas fa-fw fa-power-off"></i>
                <span>&nbsp;Tutup</span>
            </a>
            <?php else: ?>
            <a href="index.php?p=dashboard" class="btn btn-md btn-danger btn-flat">
                <i class="fas fa-fw fa-power-off"></i>
                <span>&nbsp;Tutup</span>
            </a>
            <?php endif ?>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
	function validAngka(a)
	{
		if(!/^[0-9.]+$/.test(a.value))
		{
			a.value = a.value.substring(0,a.value.length-1000);
		}
	}
    $(function(){
		var btnUpload=$('#fotouser');
		var status=$('#fotouser_status');
		new AjaxUpload(btnUpload, {
			action	: 'user_foto.php?id=<?php echo $kode;?>',
			name	: 'filefoto',
			onSubmit: function(file, ext){
			if (! (ext && /^(jpg)$/.test(ext)))
			{
				toastr.error('Hanya Mendukung File *.jpg atau *.JPG Saja Bro!!');
				return false;
			}
				status.text('Upload Sedang Berlangsung...');
			},
			onComplete: function(file, response)
			{
				status.text('');
				if(response==="success")
				{
					$('#fotouser').html('<img src="foto/'+file+'" height="180px" alt="" />').addClass('success');
					window.location.reload();
                }
                else
				{
					toastr.error('Upload Gagal Bro!!');
				}
			}
		});
	});
	$(document).ready(function(){
		$('#tgllahir').datetimepicker({
			timepicker:false,
			format: 'Y-m-d'
		});
		$(function() {
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
			$("#simpan").click(function(){
				var username="<?php echo $kode;?>";
				var nmuser = $("#nmuser").val();
				var nip = $("#nip").val();
				var tmplahir = $("#tmplahir").val();
				var tgllahir = $("#tgllahir").val();
				var agama = $("#agama").val();
				var gender = $("#gender").val();
                var jbtdinas=$("#jbtd").val();
                var jbtpanitia=$("#jbtp").val();
                var email=$("#imel").val();
				var almt = $("#almt").val();
				var desa = $("#desa").val()
				var kec = $("#kec").val();
				var kab	= $("#kab").val();
				var prov = $("#prov").val();
				var kdpos = $("#kdpos").val();
				var nohp = $("#nohp").val();
				if(nmuser=="" || nmuser==null){
					toastr.error('Nama Pengguna Wajib Diisi!');
					$("#nmuser").focus();
				}
				else if(nip=="" || nip==null){
					toastr.error('Nomor Induk Siswa Wajib Diisi!');
					$("#nip").focus();
				}
                else if(tmplahir=="" || tmplahir==null){
					toastr.error('Tempat Lahir Wajib Diisi!');
					$("#tmplahir").focus();
				}
                else if(tgllahir=="" || tgllahir==null){
					toastr.error('Tanggal Lahir Wajib Diisi!');
					$("#tgllahir").focus();
				}
                else if(gender=="" || gender==null){
					toastr.error('Jenis Kelamin Wajib Diisi!');
					$("#gender").focus();
				}
                else if(agama=="" || agama==null){
					toastr.error('Agama Wajib Diisi!');
					$("#agama").focus();
				}
				else {
					$.ajax({
						type:"POST",
						url:"user_simpan.php",
						data: "aksi=simpan&id="+username+"&nama="+nmuser+"&nip="+nip+"&tmplahir="+tmplahir+"&tgllahir="+tgllahir + "&gender="+gender+"&agama="+agama +"&jbtd="+jbtdinas+"&jbtp="+jbtpanitia+"&email="+email+"&almt="+almt+"&desa="+desa + "&kec="+kec +"&kab="+kab + "&prov=" + prov +"&kdpos="+kdpos + "&nohp="+nohp,
						success:function(data)
						{
							toastr.success(data);
						}	
					})
				}
			})
		})
	})
</script>