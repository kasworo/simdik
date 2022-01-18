<div class="modal fade" id="mySkulAsal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Sekolah Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group mb-2">
                        <label>Pilih Jenjang</label>
                        <select class="form-control input-sm select2bs4" id="idjenjang" name="idjenjang">
                            <?php
                                    $qjen=$conn->query("SELECT*FROM tbjenjang");
                                    while($rj=$qjen->fetch_array()):
                                ?>
                            <option value="<?php echo $rj['idjenjang'];?>"><?php echo $rj['nmjenjang'];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>NPSN </label>
                        <input type="text" class="form-control input-sm" id="npsn" name="npsn">
                    </div>
                    <div class=" form-group mb-2">
                        <label>Nama Satuan Pendidikan</label>
                        <input type="text" class="form-control input-sm" id="nmmitra" name="nmmitra">
                    </div>
                    <div class="form-group mb-2">
                        <label>Alamat Satuan Pendidikan</label>
                        <textarea type="text" class="form-control input-sm" id="almmitra" name="almmitra"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary btn-sm btn-flat" id="simpan">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i
                        class="fas fa-power-off"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Data Sekolah Mitra</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#mySkulAsal"
                    id="btnTambah">
                    <i class="fas fa-plus-circle"></i>&nbsp;Tambah
                </button>
                <button class="btn btn-flat btn-info btn-sm" id="btnRefresh">
                    <i class="fas fa-sync-alt"></i>&nbsp;Refresh
                </button>
                <button id="hapusall" class="btn btn-flat btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                </button>
            </div>
        </div>
        <br />
        <div class="table-responsive">
            <table id="tb_skulasal" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;width:10%">NPSN</th>
                        <th style="text-align: center;width:25%">Nama Sekolah</th>
                        <th style="text-align: center;width:15%">Jenjang</th>
                        <th style="text-align: center">Alamat</th>
                        <th style="text-align: center;width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
							$qsm="SELECT idmitra, npsn, nmmitra, alamat, nmjenjang FROM ref_skulmitra INNER JOIN tbjenjang USING(idjenjang)";
							$rows=viewref($qsm);
							$no=0;
							foreach ($rows as $k):
							$no++;
						?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td style="text-align:center"><?php echo $k['npsn'];?></td>
                        <td><?php echo $k['nmmitra'];?></td>
                        <td><?php echo $k['nmjenjang'];?></td>
                        <td><?php echo $k['alamat'];?></td>
                        <td style="text-align: center">
                            <a href="#mySkulAsal" class="btn btn-xs btn-success btn-flat btnEdit" data-toggle="modal"
                                data-id="<?php echo $k['idmitra'];?>">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>
                            <button class="btn btn-xs btn-danger btn-flat">
                                <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                            </button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('#tb_skulasal').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
});

$("#btnTambah").click(function() {
    $(".modal-title").html("Tambah Data Sekolah Mitra");
    $("#simpan").html("<i class='fas fa-save'></i> Simpan");
    $("#idskulasl").val('');
    $("#nmskulasl").val('');
    $("#alskulasl").val('');
})

$(".btnEdit").click(function() {
    $(".modal-title").html("Ubah Data Sekolah Mitra");
    $("#simpan").html("<i class='fas fa-save'></i> Update");
    var id = $(this).data('id');
    $.ajax({
        url: 'refskul_edit.php',
        type: 'post',
        dataType: 'json',
        data: 'id=' + id,
        success: function(data) {
            $("#idjenjang").val(data.idjenjang);
            $("#npsn").val(data.npsn);
            $("#nmmitra").val(data.nmmitra);
            $("#almmitra").val(data.alamat);
        }
    })
});

$("#simpan").click(function() {
    var idjen = $("#idjenjang").val();
    var npsn = $("#npsn").val();
    var nama = $("#nmmitra").val();
    var alamat = $("#almmitra").val();
    if (idjen == '') {
        toastr.error("Jenjang Satuan Pendidikan Harus Diisi!");
        $("#idjenjang").focus();
    } else if (npsn == '') {
        toastr.error("NPSN Tidak Boleh Kosong!");
        $("#npsn").focus();
    } else if (nama == '') {
        toastr.error("Nama Sekolah Mitra Tidak Boleh Kosong!");
        $("#nmmitra").focus();
    } else if (alamat == '') {
        toastr.error("Alamat Sekolah Mitra Tidak Boleh Kosong!");
        $("#almmitra").focus();
    } else {
        $.ajax({
            url: "refskul_simpan.php",
            type: "post",
            data: "idjen=" + idjen + "&npsn=" + npsn + "&nama=" + nama + "&alamat=" + alamat,
            cache: false,
            success: function(data) {
                toastr.success(data);
            }
        });
    }
})
$("#btnrefresh").click(function() {
    window.location.reload();
})
</script>