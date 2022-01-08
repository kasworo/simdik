<?php
	include "config/fun.php";
	$idsiswa=$_GET['id'];
   
?>
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title m-0" id="judul">Input Nilai Pengetahuan</h5>
            <div class="card-tools">
                <a href="index.php?p=datarapor&d=4" class="btn btn-tool">
                    <i class="fas fa-arrow-circle-left"></i><span>&nbsp;Kembali</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <div class="alert alert-warning">
                    <p><strong>Petunjuk:</strong></p>
                    <p>Silahkan pilih Tahun Pelajaran, kemudian isikan nilai lengkap dengan deskripsinya.<br />Nilai
                        Akan tersimpan otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian
                        klik tombol <strong>Refresh</strong></p>
                </div>
                <div class="form-group row mt-2 mb-2">
                    <div class="col-sm-4">
                        Pilih Tahun Pelajaran
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control input-sm col-sm-10" id="txtThpel" name="thpel">
                            <option value="">..Pilih..</option>
                            <?php
                                    $qtp=$conn->query("SELECT*FROM tbthpel");
                                    while($tp=$qtp->fetch_array()):
                                ?>
                            <option value="<?php echo $tp['idthpel'];?>"><?php echo $tp['desthpel'];?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary" id="simpan" name="simpan">
                            <i class="fas fa-save"></i>&nbsp;Simpan
                        </button>
                    </div>
                </div>
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center;width:2.5%">No</th>
                                <th style="text-align:center;">Mata Pelajaran</th>
                                <th style="text-align:center;width:10%">Nilai</th>
                                <th style="text-align:center;width:35%">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $qnil=$conn->query("SELECT idmapel, nmmapel FROM tbmapel m INNER JOIN tbkurikulum k USING(idkur)");
                                    $no=0;
                                    while($n=$qnil->fetch_array()):
                                        $no++;
                                ?>
                            <tr>
                                <td><?php echo $no.'.';?></td>
                                <td><?php echo $n['nmmapel'];?></td>
                                <td>
                                    <input class="form-control txtNilai" name="nilai<?php echo $no;?>"
                                        id="nilai<?php echo $no;?>" style="text-align:center;height:42px">
                                </td>
                                <td>
                                    <textarea class="form-control txtDeskripsi" name="des<?php echo $no;?>"
                                        id="des<?php echo $no;?>" style="height:42px"></textarea>
                                </td>
                            </tr>
                            <script type="text/javascript">
                            $("#nilai<?php echo $no;?>").change(function() {
                                var thpel = $("#txtThpel").val();
                                var kdmapel = "<?php echo $n['idmapel'];?>";
                                var idsiswa = "<?php echo $idsiswa;?>";
                                var nilai = $(this).val();

                                $.ajax({
                                    url: "rapor_simpan.php",
                                    type: "POST",
                                    data: "as=3&th=" + thpel + "&mp=" + kdmapel + "&id=" + idsiswa +
                                        "&nil=" + nilai,
                                    cache: false,
                                    success: function(data) {
                                        //toastr.success(psn);
                                        $("#judul").html(data);
                                    }
                                });
                            })
                            $("#des<?php echo $no;?>").change(function() {
                                var thpel = $("#txtThpel").val();
                                var kdmapel = "<?php echo $n['idmapel'];?>";
                                var idsiswa = "<?php echo $idsiswa;?>";
                                var nilai = $("#nilai<?php echo $no;?>").val();
                                var des = $(this).val();
                                $.ajax({
                                    url: "rapor_simpan.php",
                                    type: "POST",
                                    data: "as=3&th=" + thpel + "&mp=" + kdmapel + "&id=" + idsiswa +
                                        "&nil=" + nilai + "&des=" + des,
                                    cache: false,
                                    success: function(data) {
                                        toastr.success(data);
                                    }
                                });
                            })
                            </script>
                            <?php endwhile ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function validAngka(a) {
    if (!/^[0-9.]+$/.test(a.value)) {
        a.value = a.value.substring(0, a.value.length - 1000);
    }
}
$(document).ready(function() {
    $(".txtNilai").attr('disabled', 'disabled');
    $(".txtDeskripsi").attr('disabled', 'disabled');
    $("#txtThpel").change(function() {
        if ($(this).val() == '' || $(this).val() == null) {
            $(".txtNilai").attr('disabled', 'disabled');
            $(".txtDeskripsi").attr('disabled', 'disabled');
        } else {
            $(".txtNilai").removeAttr('disabled');
            $(".txtDeskripsi").removeAttr('disabled');
        }

    })
})
</script>