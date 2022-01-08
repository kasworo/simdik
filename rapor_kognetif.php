<?php 
    $idsiswa=$_GET['id'];
?>
<script type="text/javascript">
$(document).ready(function() {
    $(".txtNilai").attr('disabled', 'disabled');
    $(".txtDeskripsi").attr('disabled', 'disabled');
    $(".txtHuruf").attr('disabled', 'disabled');
    $("#txtThpel").change(function() {
        let id = "<?php echo $idsiswa;?>";
        $.ajax({
            url: "rapor_json.php",
            type: "POST",
            dataType: 'json',
            data: "id=" + id + "&d=3",
            success: function(e) {
                $("#idsiswa").val(e.idsiswa);
                $("#nmsiswa").val(e.nmsiswa);
                $("#simpan").html(data.tmbl);
            }
        })
        if ($(this).val() == '' || $(this).val() == null) {
            $(".txtNilai").attr('disabled', 'disabled');
            $(".txtHuruf").attr('disabled', 'disabled');
            $(".txtDeskripsi").attr('disabled', 'disabled');
        } else {
            $(".txtNilai").removeAttr('disabled');
            $(".txtHuruf").removeAttr('disabled');
            $(".txtDeskripsi").removeAttr('disabled');
        }
    })
})
</script>
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title m-0" id="judul">Input Nilai Pengetahuan</h5>
            <div class="card-tools">
                <a href="index.php?p=datarapor&d=3" class="btn btn-tool">
                    <i class="fas fa-arrow-circle-left"></i>
                    <span>&nbsp;Kembali</span>
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
                <hr />
                <div class="form-group row mt-2">
                    <div class="col-sm-4">
                        Pilih Tahun Pelajaran
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control input-sm col-sm-10" id="txtThpel" name="thpel">
                            <option value="">..Pilih..</option>
                            <?php
                                $qtp=viewdata('tbthpel');
                                $qtp=$conn->query("SELECT*FROM tbthpel");
                                foreach($qtp as $tp):
                                ?>
                            <option value="<?php echo $tp['idthpel'];?>">
                                <?php echo $tp['desthpel'];?>
                            </option>
                            <?php endforeach ?>
                        </select>
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
                                <th style="text-align:center;width:10%">Predikat</th>
                                <th style="text-align:center;width:35%">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $col=array('idmapel', 'nmmapel');
                                $qnil=fulljoin($col,'tbmapel', array('tbkurikulum'=>'idkur'));
                                $no=0;
                                foreach($qnil as $n):
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
                                    <input class="form-control txtHuruf" name="predik<?php echo $no;?>"
                                        id="predik<?php echo $no;?>" style="text-align:center;height:42px">
                                </td>
                                <td>
                                    <textarea class="form-control txtDeskripsi" name="des<?php echo $no;?>"
                                        id="des<?php echo $no;?>" style="height:42px"></textarea>
                                </td>
                            </tr>
                            <script type="text/javascript">
                            $("#nilai<?php echo $no;?>").change(function(e) {
                                e.preventDefault();
                                let thpel = $("#txtThpel").val();
                                let kdmapel = "<?php echo $n['idmapel'];?>";
                                let idsiswa = "<?php echo $idsiswa;?>";
                                let nilai = $(this).val();
                                $.ajax({
                                    url: "rapor_simpan.php",
                                    type: "POST",
                                    data: "as=3&m=1&th=" + thpel + "&mp=" + kdmapel + "&id=" + idsiswa +
                                        "&nil=" + nilai,
                                    cache: false,
                                    success: function(data) {
                                        //toastr.success(data);
                                        alert(data);
                                    }
                                });
                            })

                            $("#predik<?php echo $no;?>").change(function(e) {
                                e.preventDefault();
                                let thpel = $("#txtThpel").val();
                                let kdmapel = "<?php echo $n['idmapel'];?>";
                                let idsiswa = "<?php echo $idsiswa;?>";
                                let nilai = $("#nilai<?php echo $no;?>").val();
                                let huruf = $(this).val();
                                $.ajax({
                                    url: "rapor_simpan.php",
                                    type: "POST",
                                    data: "as=3&m=2&th=" + thpel + "&mp=" + kdmapel + "&id=" + idsiswa +
                                        "&nil=" + nilai + "&hrf=" + huruf,
                                    cache: false,
                                    success: function(data) {
                                        //toastr.success(data);
                                        alert(data);
                                    }
                                });
                            })

                            $("#des<?php echo $no;?>").change(function(e) {
                                e.preventDefault();
                                let thpel = $("#txtThpel").val();
                                let kdmapel = "<?php echo $n['idmapel'];?>";
                                let idsiswa = "<?php echo $idsiswa;?>";
                                let nilai = $("#nilai<?php echo $no;?>").val();
                                let huruf = $("#pred<?php echo $no;?>").val();
                                let des = $(this).val();
                                $.ajax({
                                    url: "rapor_simpan.php",
                                    type: "POST",
                                    data: "as=3&m=3&th=" + thpel + "&mp=" + kdmapel + "&id=" + idsiswa +
                                        "&nil=" + nilai + "&hrf=" + huruf + "&des=" + des,
                                    cache: false,
                                    success: function(data) {
                                        //toastr.success(data);
                                        alert(data);
                                    }
                                });
                            })
                            </script>
                            <?php endforeach ?>
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
</script>