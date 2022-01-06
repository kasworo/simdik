<div class="alert alert-warning">
    <p><strong>Petunjuk:</strong></p>
    <p>Silahkan isikan data Nilai Sikap Spiritual yang diperoleh tiap semester.<br>Nilai Akan tersimpan
        otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol
        <strong>Refresh</strong>
    </p>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Impor Dan Ekspor Nilai Peserta Didik</h4>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary">
                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Upload
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">

        </div>
        <div class="form-group row mb-2">
            <table class="table table-sm table-striped table-bordered table-condensed" id="tb_template">
                <thead>
                    <tr>
                        <th style="text-align:center;width:7.5%">No.</th>
                        <th style="text-align:center">Template <?php echo $rombel;?></th>
                        <th style="text-align:center;width:27.5%">Download Format</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center">1.</td>
                        <td>Penilaian Sikap Spiritual</td>
                        <td style="text-align:center">
                            <button class="btn btn-xs btn-success" id="inputspirit" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Input
                            </button>
                            <button class="btn btn-xs btn-danger" id="editspirit" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Edit
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">2.</td>
                        <td>Penilaian Sikap Sosial</td>
                        <td style="text-align:center">
                            <button class="btn btn-xs btn-success" id="inputsosial" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Input
                            </button>
                            <button class="btn btn-xs btn-danger" id="editsosial" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Edit
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">3.</td>
                        <td>Penilaian Pengetahuan</td>
                        <td style="text-align:center">
                            <button class="btn btn-xs btn-success" id="inputkognetif" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Input
                            </button>
                            <button class="btn btn-xs btn-danger" id="editkognetif" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Edit
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">4.</td>
                        <td>Penilaian Keterampilan</td>
                        <td style="text-align:center">
                            <button class="btn btn-xs btn-success" id="inputmotorik" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Input
                            </button>
                            <button class="btn btn-xs btn-danger" id="editmotorik" disabled="true">
                                <i class="fas fa-cloud-download-alt"></i>&nbsp;Edit
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>