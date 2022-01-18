<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
?>
<script type="text/javascript" src="js/pilihampu.js"></script>
<div class="modal fade" id="myAddAmpu" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengampu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group mb-2">
                        <label>Kelas</label>
                        <input type="hidden" id="idampu" name="idampu">
                        <select class="form-control input-sm" id="idkelas" name="idkelas"
                            onchange="pilkelas(this.value)">
                            <option value="">..Pilih..</option>
                            <?php
					$qkls=$conn->query("SELECT idkelas,nmkelas FROM tbkelas INNER JOIN tbskul USING (idjenjang)");
					while($kl=$qkls->fetch_array()){
					?>
                            <option value="<?php echo $kl['idkelas'];?>"><?php echo $kl['nmkelas'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Rombongan Belajar</label>
                        <select class="form-control input-sm" id="idrombel" name="idrombel">
                            <option value="">..Pilih..</option>
                            <?php
					$qrb=$conn->query("SELECT*FROM tbrombel");
					while($rb=$qrb->fetch_array()){
					?>
                            <option value="<?php echo $rb['idrombel'];?>"><?php echo $rb['nmrombel'];?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Mata Pelajaran</label>
                        <select class="form-control input-sm" id="idmapel" name="idmapel">
                            <option value="">..Pilih..</option>
                            <?php
					$qmp=$conn->query("SELECT idmapel, nmmapel FROM tbmapel");
					while($mp=$qmp->fetch_array()){
					?>
                            <option value="<?php echo $mp['idmapel'];?>"><?php echo $mp['nmmapel'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Guru Bidang Studi</label>
                        <select class="form-control input-sm" id="idguru" name="idguru">
                            <option value="">..Pilih..</option>
                            <?php
					$qus=$conn->query("SELECT username,nama FROM tbuser WHERE level='2'");
					while($us=$qus->fetch_array()){
					?>
                            <option value="<?php echo $us['username'];?>"><?php echo $us['nama'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary btn-md col-4 btn-flat" id="simpan">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-md col-4 btn-flat" data-dismiss="modal">
                    <i class="fas fa-power-off"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mySalinAmpu" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salin Pengampu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group mb-2">
                        <label>Rombongan Belajar Asal</label>
                        <select class="form-control input-sm" id="idrombasl" name="idrombasl">
                            <option value="">..Pilih..</option>
                            <?php
					$qkls=$conn->query("SELECT idrombel,nmrombel FROM tbrombel INNER JOIN tbthpel USING (idthpel) WHERE aktif='1'");
					while($kl=$qkls->fetch_array()){
					?>
                            <option value="<?php echo $kl['idrombel'];?>"><?php echo $kl['nmrombel'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Rombongan Belajar Tujuan</label>
                        <select class="form-control input-sm" id="idrombtjn" name="idrombtjn">
                            <option value="">..Pilih..</option>
                            <?php
					$qkls=$conn->query("SELECT idrombel,nmrombel FROM tbrombel INNER JOIN tbthpel USING (idthpel) WHERE aktif='1'");
					while($kl=$qkls->fetch_array()){
					?>
                            <option value="<?php echo $kl['idrombel'];?>"><?php echo $kl['nmrombel'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary btn-md col-4 btn-flat" id="salin">
                    <i class="fas fa-copy"></i> Salin
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
        <h4 class="card-title">Data Pengampu</h4>
        <div class="card-tools">
            <button class="btn btn-flat btn-success btn-sm" id="btnTambah" data-toggle="modal" data-target="#myAddAmpu">
                <i class="fas fa-plus-circle"></i>&nbsp;Tambah
            </button>
            <button class="btn btn-flat btn-default btn-sm" id="btnSalin" data-toggle="modal"
                data-target="#mySalinAmpu">
                <i class="fas fa-copy"></i>&nbsp;Salin
            </button>
            <button class="btn btn-flat btn-info btn-sm" id="btnRefresh">
                <i class="fas fa-sync-alt"></i>&nbsp;Refresh
            </button>
            <button id="hapusall" class="btn btn-flat btn-danger btn-sm">
                <i class="fas fa-trash-alt"></i>&nbsp;Hapus
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_pengampu" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;width:10.5%">Rombel</th>
                        <th style="text-align: center;width:35%">Mata Pelajaran</th>
                        <th style="text-align: center">Guru Bidang Studi</th>
                        <th style="text-align: center;width:12.5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$qk=$conn->query("SELECT a.idampu, m.nmmapel, r.nmrombel, u.nama FROM tbpengampu a INNER JOIN tbrombel r USING(idrombel) INNER JOIN tbmapel m USING(idmapel) INNER JOIN tbuser u ON a.username=u.username WHERE r.idthpel='$_COOKIE[c_tahun]' ORDER BY idrombel, idmapel");
					$no=0;
					while($m=$qk->fetch_array())
					{
						$no++;
				?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td style="text-align:center"><?php echo $m['nmrombel'];?></td>
                        <td><?php echo $m['nmmapel'];?></td>
                        <td><?php echo $m['nama'];?></td>
                        <td style="text-align: center">
                            <a href="#myAddAmpu" data-toggle="modal" data-id="<?php echo $m['idampu'];?>"
                                class="btn btn-xs btn-success btn-flat btnUpdate">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>
                            <button data-id="<?php echo $m['idampu'];?>"
                                class="btn btn-xs btn-danger btn-flat btnHapus">
                                <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#myAddAmpu").on('hidden.bs.modal', function() {
        window.location.reload();
    })
    $("#mySalinAmpu").on('hidden.bs.modal', function() {
        window.location.reload();
    })
})
</script>
<script type="text/javascript">
$(function() {
    $('#tb_pengampu').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
})

$("#btnTambah").click(function() {
    $(".modal-title").html("Tambah Data Pengampu");
    $("#simpan").html("<i class='fas fa-save'></i> Simpan");
})

$("#simpan").click(function() {
    let ida = $("#idampu").val();
    let idm = $("#idmapel").val();
    let idg = $("#idguru").val();
    let idr = $("#idrombel").val();
    $.ajax({
        url: "pengampu_simpan.php",
        type: 'POST',
        data: "aksi=simpan&id=" + ida + "&mp=" + idm + "&gr=" + idg + "&rm=" + idr,
        success: function(data) {
            toastr.success(data);
        }
    })
})
$("#salin").click(function() {
    let idrasl = $("#idrombasl").val();
    let idrtjn = $("#idrombtjn").val();
    $.ajax({
        url: "pengampu_simpan.php",
        type: 'POST',
        data: "aksi=salin&idra=" + idrasl + "&idrt=" + idrtjn,
        success: function(data) {
            toastr.success(data);
        }
    })
})
$(".btnUpdate").click(function() {
    $(".modal-title").html("Ubah Data Pengampu");
    $("#simpan").html("<i class='fas fa-save'></i> Update");
    let id = $(this).data('id');
    $.ajax({
        url: 'pengampu_edit.php',
        type: 'post',
        dataType: 'json',
        data: 'id=' + id,
        success: function(data) {
            $("#idampu").val(data.idampu);
            $("#idkelas").val(data.idkelas);
            $("#idrombel").val(data.idrombel);
            $("#idmapel").val(data.idmapel);
            $("#idguru").val(data.username);
        }
    })
})
$(".btnHapus").click(function() {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Mata Pelajaran",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "pengampu_simpan.php",
                data: "aksi=hapus&id=" + id,
                success: function(data) {
                    toastr.success(data);
                }
            })
            window.location.reload();
        }
    })
})
$("#hapusall").click(function() {
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Seluruh Pembelajaran",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "pengampu_simpan.php",
                data: "aksi=kosong",
                success: function(data) {
                    toastr.success(data);
                }
            })
        }
    })
})
$("#btnRefresh").click(function() {
    window.location.reload();
})
</script>