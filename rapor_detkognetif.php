<?php
	$ds=viewdata('tbsiswa',array('idsiswa'=>$_GET['id']))[0];  
?>

<div class="alert alert-warning">
	<p><strong>Petunjuk:</strong></p>
	<p>Tabel di bawah ini merupakan nilai dan predikat Penilaian Pengetahuan yang diperoleh tiap semester.
	</p>
</div>
<div class="card card-primary card-outline">
	<div class="card-header">
		<h5 class="card-title m-0">Detail Nilai Pengetahuan Untuk <?php echo $namasiswa;?></h5>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-sm table-condensed table-striped" id="tbnilai">
				<thead>
					<tr>
						<th style="text-align:center;width:5%;vertical-align: middle" rowspan="2">No</th>
						<th style="text-align:center;vertical-align: middle;width:37.5%" rowspan="2">Mata Pelajaran</th>
						<?php
							$sql="SELECT th.nmthpel FROM tbregistrasi rg INNER JOIN tbthpel th USING(idthpel) WHERE rg.idsiswa='$_GET[id]'";
							$qtp=vquery($sql);
							foreach ($qtp as $tp):
						?>
						<th style="text-align:center;" colspan="2">
							<?php echo $tp['nmthpel'];?>
						</th>
						<?php endforeach ?>
					</tr>
					<tr>
						<?php foreach ($qtp as $tp): ?>
						<th style="text-align:center">N</th>
						<th style="text-align:center">P</th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
					$no=0;
					$qmp=viewdata('tbmapel');
					foreach ($qmp as $mp):
						$no++;						
				?>
					<tr>
						<td style="text-align:center;"><?php echo $no.'.';?></td>
						<td><?php echo $mp['nmmapel'];?></td>
						<?php
						$sql="SELECT rg.idthpel FROM tbregistrasi rg INNER JOIN tbthpel th USING(idthpel) WHERE rg.idsiswa='$_GET[id]'";				   
						$qtp=vquery($sql);
						foreach($qtp as $tp):
							$key=array(
								'idmapel'=>$mp['idmapel'],
								'idthpel'=>$tp['idthpel'],
								'aspek'=>$_GET['d']
							);
							$dn=viewdata('tbnilairapor',$key)[0];
					?>
						<td style="text-align:center;"><?php echo $dn['nilairapor'];?></td>
						<td style="text-align:center;"><?php echo $dn['predikat'];?></td>
						<?php endforeach ?>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>