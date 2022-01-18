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
                        <td style="text-align:center;width:17.5%">Jumlah Siswa</td>
                        <td style="text-align:center;width:25%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
							$no=0;
							$qtp=$conn->query("SELECT LEFT(desthpel,9) as tapel, LEFT(nmthpel,4) as kdthpel FROM tbthpel GROUP BY LEFT(nmthpel,4)");
							while($tp=$qtp->fetch_array()):
								$no++;
						?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no.'.';?></td>
                        <td><?php echo $tp['tapel'];?></td>
                        <td></td>
                        <td style="text-align:center">
                            <button data-id="<?php echo $tp['kdthpel'];?>"
                                class="btn btn-default btn-sm btn-flat col-sm-5 btnBiodata">
                                <i class="fas fa-print"></i>&nbsp;Biodata
                            </button>
                            <button data-id="<?php echo $tp['kdthpel'];?>"
                                class="btn btn-default btn-sm btn-flat col-sm-5 btnNilai">
                                <i class="fas fa-print"></i>&nbsp;Nilai
                            </button>
                        </td>
                    </tr>
                    <?php endwhile;?>
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