<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Laporan Klapper</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_siswa" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;width:22.5%">Nama Peserta Didik</th>

                        <th style="text-align: center;">Alamat</th>
                        <th style="text-align: center;width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						$qs=viewdata('tbsiswa');
							$no=0;
							foreach($qs as $s)
							{
								$no++;
								if($s['aktif']=='1'){$stat='Aktif';$btn="btn-success";} else {$stat='Non Aktif';$btn="btn-danger";}
						?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?>
                        </td>
                        <td><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                        <td><?php echo $s['alamat'];?></td>
                        <td style="text-align: center">
                            <button data-id="<?php echo $s['idsiswa'];?>"
                                class="btn btn-xs btn-success btn-flat btnUpdate">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </button>
                            <button data-id="<?php echo $s['idsiswa'];?>"
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
<?php
foreach( range('A', 'Z') as $elements) {     
   
    echo $elements . ", ";
}
?>