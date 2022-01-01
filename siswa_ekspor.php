<?php
	include "config/function_siswa.php";
	if(isset($_POST['tmpsiswa'])){
		include "siswa_upload.php";
	}
	if(isset($_POST['tmpayah']) || isset($_POST['tmpibu']) || isset($_POST['tmpwali']))
	{
		include "siswa_ortu.php";
	}

?> <div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Ekspor dan Impor Data Terkait Peserta Didik</h4>
    </div>
    <div class="card-body">
        <div class="row d-flex align-items-stretch justify-content-start">
            <div class="col-sm-6">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> Data Peserta Didik</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <p><strong>Petunjuk:</strong></p>
                            <p>
                                Klik tombol <strong>Download</strong> untuk mengunduh file template data peserta
                                didik.<br />
                                Editlah kemudian Upload ke database melalui tool di bawah ini.
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" enctype="multipart/form-data" action="">
                            <input type="file" class="col-sm-6" name="filepd">
                            <button type="submit" class="btn btn-secondary btn-sm ml-2" name="tmpsiswa">
                                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Upload
                            </button>
                            <a href="siswa_template.php?d=1" class="btn btn-sm btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> Data Ayah Kandung</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <p><strong>Petunjuk:</strong></p>
                            <p>
                                Klik tombol <strong>Download</strong> untuk mengunduh file template data ayah
                                kandung peserta
                                didik.<br />
                                Editlah kemudian Upload ke database melalui tool di bawah ini.
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" enctype="multipart/form-data" action="">
                            <input type="file" class="col-sm-6" name="fileayah">
                            <input type="hidden" name="nmfile" value="1">
                            <button type="submit" class="btn btn-primary btn-sm ml-2" name="tmpayah">
                                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Upload
                            </button>
                            <a href="siswa_template.php?d=3" class="btn btn-sm btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> Data Ibu Kandung</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <p><strong>Petunjuk:</strong></p>
                            <p>
                                Klik tombol <strong>Download</strong> untuk mengunduh file template data ibu
                                kandung peserta
                                didik..<br />
                                Editlah kemudian Upload ke database melalui tool di bawah ini.
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" enctype="multipart/form-data" action="">
                            <input type="file" class="col-sm-6" name="fileibu">
                            <input type="hidden" name="nmfile" value="2">
                            <button type="submit" class="btn btn-danger btn-sm" name="tmpibu">
                                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Upload
                            </button>
                            <a href="siswa_template.php?d=4" class="btn btn-sm btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> Data Wali Peserta didik</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <p><strong>Petunjuk:</strong></p>
                            <p>
                                Klik tombol <strong>Download</strong> untuk mengunduh file template data wali peserta
                                didik.<br />
                                Editlah kemudian Upload ke database melalui tool di bawah ini.
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" enctype="multipart/form-data" action="">
                            <input type="file" class="col-sm-6" name="filewali">
                            <input type="hidden" name="nmfile" value="3">
                            <button type="submit" class="btn btn-warning btn-sm" name="tmpwali">
                                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Upload
                            </button>
                            <a href="siswa_template.php?d=5" class="btn btn-sm btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>