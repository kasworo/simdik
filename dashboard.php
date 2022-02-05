<?php if($level=='1'):?>
	<div class="card card-secondary card-outline">
		<div class="card-header">
			<h3 class="card-title">Riwayat Login</h3>
        </div>
		<div class="card-body">
            <div class="row d-flex align-items-stretch justify-content-start">
				<?php
				$qu=$conn->query("SELECT*FROM tbuser WHERE xlog IS NOT NULL ORDER BY xlog DESC, level LIMIT 0,18");
				while($u=$qu->fetch_array()):
					$foto=$u['foto'];
					if($u['level']=='1'){
						$level='Administrator';
					}
					else if($u['level']=='2'){
						$level='Guru / Staff';
					}
					else{
						$level='Peserta Didik';
					}
					$foto=$u['foto'];
					if($foto=='' || $foto==null){
						$fotouser='assets/img/avatar.gif';
					}
					else{
						if(file_exists('foto/'.$foto)){
							$fotouser='foto/'.$foto;
						}
						else{
							$fotouser='assets/img/avatar.gif';
						}
					}
					
				?>
				<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
					<div class="card bg-light">
						<div class="card-header text-muted border-bottom-0"><?php echo $u['nama'];?></div>
							<div class="card-body pt-0">
								<div class="row">
									<div class="col-7">
										<h3 class="lead"><b><?php echo $level;?></b></h3>
										<p class="text-muted text-sm"><b>Riwayat Login</b></p>
										<ul class="ml-4 mb-0 fa-ul text-muted">
											<li class="small"><span class="fa-li"><i class="far fa-sm fa-calendar"></i></span>Tanggal<br/><?php echo indonesian_date($u['xlog']);?></li>
											<li class="small"><span class="fa-li"><i class="far fa-sm fa-clock"></i></span> Jam<br/><?php echo date_format(date_create($u['xlog']),'H:i:s');?></li>
										</ul>
									</div>
									<div class="col-5 text-center">
									<img src="<?php echo $fotouser;?>" class="img-circle img-fluid">
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile ?>
				
            </div>
		</div>
	</div>
    <?php else: ?>
    <div class="card card-secondary card-outline">
		<div class="card-header">
		    <h3 class="card-title">Riwayat Login Pengguna</h3>
        </div>
		<div class="card-body">
		</div>
	</div>
    <?php endif ?>
