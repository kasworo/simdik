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
        <h4 class="card-title">Cetak Buku Induk</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive table-responsive-xl">
            <table class="table table-bordered table-sm table-striped table-condensed">
                <thead>
                    <tr>
                        <td style="text-align:center;width:7.5%">No.</td>
                        <td style="text-align:center">Tahun Pelajaran</td>
                        <td style="text-align:center;width:25%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
						$no=0;
                        $kabeh=cekdata('tbthpel','',"LEFT(nmthpel,4)");
                        if($kabeh>5){
                            $offset=$kabeh-5;
                             $sql="SELECT LEFT(desthpel,9) as tapel, LEFT(nmthpel,4) as kdthpel FROM tbthpel GROUP BY LEFT(nmthpel,4) ORDER BY idthpel LIMIT 5 OFFSET $offset";
                        }
                        else{
                            $sql="SELECT LEFT(desthpel,9) as tapel, LEFT(nmthpel,4) as kdthpel FROM tbthpel GROUP BY LEFT(nmthpel,4) ORDER BY idthpel LIMIT 5";
                        }
                        $qtp=vquery($sql);
						foreach ($qtp as $tp):
							$no++;
					?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no.'.';?></td>
                        <td><?php echo $tp['tapel'];?></td>
                        <td style="text-align:center">
                            <button data-id="<?php echo $tp['kdthpel'];?>"
                                class="btn btn-default btn-sm col-sm-5 btnBiodata">
                                <i class="fas fa-print"></i>&nbsp;Biodata
                            </button>
                            <button data-id="<?php echo $tp['kdthpel'];?>"
                                class="btn btn-info btn-sm col-sm-5 btnNilai">
                                <i class="fas fa-print"></i>&nbsp;Nilai
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
$(".btnBiodata").click(function() {
    var id = $(this).data('id');
    window.open("cetak_binduk.php?id=" + id, "_blank");
})
$(".btnNilai").click(function() {
    var id = $(this).data('id');
    window.open("cetak_lhb.php?id=" + id, "_blank");
})
</script>