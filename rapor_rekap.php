<div class="col-sm-12">
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <h4 class="card-title">Laporan Rekap Nilai Rapor</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="tb_rapor" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th style="text-align: center;width:2.5%">No.</th>
                  <th style="text-align: center">Mata Pelajaran</th>
                  <th style="text-align: center;width:5%">1</th>
                  <th style="text-align: center;width:5%">2</th>
                  <th style="text-align: center;width:5%">3</th>
                  <th style="text-align: center;width:5%">4</th>
                  <th style="text-align: center;width:5%">5</th>
                  <th style="text-align: center;width:5%">6</th>                        
                  <th style="text-align: center;width:15%">Rerata</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="text-align:center">1.</td>                  
                    <td>Pendidikan Agama</td>
                    <td style="text-align: center">80</td>
                    <td style="text-align: center">80</td>
                    <td style="text-align: center">80</td>
                    <td style="text-align: center">80</td>
                    <td style="text-align: center">80</td>
                    <td style="text-align: center">80</td>
                    <td style="text-align: center">80.00</td>
                   
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(function () {
    $('#tb_rapor').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>