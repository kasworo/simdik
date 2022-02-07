<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Laporan Klapper</h4>
        <div class="card-tools">
            <a href="cetak_klapper.php" class="btn btn-default btn-md" target="_blank">
                <i class="fas fa-print"></i> Cetak
            </a>
        </div>
    </div>
    <?php $qs=viewdata('tbsiswa','','','nmsiswa, nis'); ?>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_siswa" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;width:22.5%">Nomor Induk</th>
                        <th style="text-align: center;width:22.5%">Nama Peserta Didik</th>
                        <th style="text-align: center;">Masuk</th>
                        <th style="text-align: center;">Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach( range('A', 'Z') as $huruf):
					    $no=0;
                        $sql="SELECT nis, nisn, nmsiswa FROM tbsiswa WHERE nmsiswa LIKE '$huruf%' ORDER BY nis";
                        $qs=vquery($sql);
                        foreach($qs as $s):
                    $no++;

                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td style="text-align:center"><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                        <td><?php echo ucwords(strtolower($s['nmsiswa']));?> </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php

?>