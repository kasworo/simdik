<?php	
	if(isset($_POST['tmpsiswa'])){include "siswa_upload.php";}
	if(isset($_POST['tmportu'])){include "siswa_ortu.php";    }

?>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Ekspor dan Impor Data Terkait Peserta Didik</h4>
        <div class="card-tools">

        </div>
    </div>
    <div class="card-body">
        <div class="row table-responsive">
            <table class="table table-sm table-striped table-bordered table-condensed" id="tb_template">
                <thead>
                    <tr>
                        <th style="text-align:center;width:7.5%">No.</th>
                        <th style="text-align:center">Template</th>
                        <th style="text-align:center;width:27.5%">Download Format</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">1.</td>
                        <td>Data Utama Peserta Didik</td>
                        <td style="text-align:center;">
                            <a href="siswa_template.php?d=1" class="btn btn-xs btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">2.</td>
                        <td>Data Riwayat Pendidikan Peserta Didik</td>
                        <td style="text-align:center;">
                            <a href="siswa_template.php?d=2" class="btn btn-xs btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">3.</td>
                        <td>Data Ayah Kandung Peserta Didik</td>
                        <td style="text-align:center;">
                            <a href="siswa_template.php?d=3" class="btn btn-xs btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">4.</td>
                        <td>Data Ibu Kandung Peserta Didik</td>
                        <td style="text-align:center;">
                            <a href="siswa_template.php?d=4" class="btn btn-xs btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">4.</td>
                        <td>Data Wali Peserta Didik</td>
                        <td style="text-align:center;">
                            <a href="siswa_template.php?d=5" class="btn btn-xs btn-success ml-2">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Download
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
                                Klik tombol <strong>Download</strong> untuk mengunduh file template data orangtua/wali
                                peserta
                                didik.<br />
                                Editlah kemudian Upload ke database melalui tool di bawah ini.
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" enctype="multipart/form-data" action="">
                            <input type="file" class="col-sm-6" name="fileortu">
                            <button type="submit" class="btn btn-primary btn-sm ml-2" name="tmportu">
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