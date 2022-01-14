<?php 
    include "dbfunction.php";
    if($_POST['as']=='3' || $_POST['as']=='4'): 
?>
<table class="table table-bordered table-condensed table-striped" id="tbnilai">
    <thead>
        <tr>
            <th style="text-align:center;width:2.5%">No</th>
            <th style="text-align:center;width:20%">Mata Pelajaran</th>
            <th style="text-align:center;width:10%">Nilai</th>
            <th style="text-align:center;width:15%">Predikat</th>
            <th style="text-align:center;">Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no=0;
        $qmp=viewdata('tbmapel');
        foreach ($qmp as $mp):
            $no++;
            if(empty($_POST['th'])){
                $sql="SELECT nr.nilairapor, nr.predikat, nr.deskripsi FROM tbnilairapor nr LEFT JOIN tbthpel tp ON
                tp.idthpel=nr.idthpel WHERE nr.idmapel='$mp[idmapel]' AND nr.idsiswa='$_POST[id]' AND tp.aktif='1' AND
                nr.aspek='$_POST[as]'";
            }
            else {
                $sql="SELECT nr.nilairapor, nr.predikat, nr.deskripsi FROM tbnilairapor nr LEFT JOIN tbthpel tp ON
                tp.idthpel=nr.idthpel WHERE nr.idmapel='$mp[idmapel]' AND nr.idsiswa='$_POST[id]' AND nr.idthpel='$_POST[th]' AND
                nr.aspek='$_POST[as]'";
            }
            $dn=vquery($sql)[0];
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $no.'.';?></td>
            <td><?php echo $mp['nmmapel'];?></td>
            <td style="vertical-align: middle;">
                <input class="form-control" type="hidden" name="mapel[]" id="mapel<?php echo $no;?>"
                    style="text-align:center;height:42px" value="<?php echo $mp['idmapel'];?>">
                <input class="form-control txtNilai" type="number" name="nilai[]" id="nilai<?php echo $no;?>"
                    style="text-align:center;height:42px" value="<?php echo $dn['nilairapor'];?>" disabled>
            </td>
            <td style="vertical-align: middle;">
                <select class="form-control txtPredikat" type="text" name="predikat[]" id="nilai<?php echo $no;?>"
                    style="height:42px" disabled>
                    <option value="">..Pilih..</option>
                    <option value="A" <?php echo $dn['predikat']=='A'? "selected":"";?>>Amat Baik</option>
                    <option value="B" <?php echo $dn['predikat']=='B'? "selected":"";?>>Baik</option>
                    <option value="C" <?php echo $dn['predikat']=='C'? "selected":"";?>>Cukup</option>
                    <option value="D" <?php echo $dn['predikat']=='D'? "selected":"";?>>Kurang</option>
                </select>
            </td>
            <td style="vertical-align: middle;">
                <textarea class="form-control txtDeskripsi" name="deskripsi[]" id="des<?php echo $no;?>" rows="2"
                    disabled><?php echo $dn['deskripsi'];?></textarea>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th style="text-align:center;width:2.5%">No</th>
                <th style="text-align:center;width:35%">Aspek Sikap</th>
                <th style="text-align:center;width:15%">Nilai</th>
                <th style="text-align:center;">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i=1;$i<=2;$i++):
            if(empty($_POST['th'])){
                $sql="SELECT nr.nilaisikap, nr.deskripsi FROM tbnilaisikap nr LEFT JOIN tbthpel tp ON
                tp.idthpel=nr.idthpel WHERE nr.idsiswa='$_POST[id]' AND tp.aktif='1' AND
                nr.aspek='$i'";
            }
            else {
                $sql="SELECT nr.nilaisikap, nr.deskripsi FROM tbnilaisikap nr LEFT JOIN tbthpel tp ON
                tp.idthpel=nr.idthpel WHERE nr.idsiswa='$_POST[id]' AND nr.idthpel='$_POST[th]' AND
                nr.aspek='$i'";
            }
            if($i==1){$teks='Sikap Spiritual<br />(<em>Bersyukur, Rajin Beribadah, dan lain-lain</em>)';}
            if($i==2){$teks='Sikap Sosial<br />(<em>Jujur, Tanggung Jawab dan Lain-lain</em>)';}
            $ds=vquery($sql)[0];
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $i.'.';?></td>
                <td><?php echo $teks;?></td>
                <td style="vertical-align: middle;">
                    <input class="form-control" type="hidden" name="aspek[]" id="aspek<?php echo $i;?>"
                        style="text-align:center;height:42px" value="<?php echo $i;?>">
                    <select class="form-control txtPredikat" type="text" name="nilai[]" id="nilai<?php echo $i;?>"
                        style="height:42px" disabled>
                        <option value="">..Pilih..</option>
                        <option value="4" <?php echo $ds['nilaisikap']=='4'? "selected":"";?>>Amat Baik</option>
                        <option value="3" <?php echo $ds['nilaisikap']=='3'? "selected":"";?>>Baik</option>
                        <option value="2" <?php echo $ds['nilaisikap']=='2'? "selected":"";?>>Cukup</option>
                        <option value="1" <?php echo $ds['nilaisikap']=='1'? "selected":"";?>>Kurang</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control txtDeskripsi" name="deskripsi[]" id="deskripsi<?php echo $i;?>"
                        rows="2" disabled><?php echo $ds['deskripsi'];?></textarea>
                </td>
            </tr>
            <?php endfor ?>
        </tbody>
    </table>
    <?php endif?>