<?php
	function ceknilai($data)
	{
		global $conn;
		$sql=$conn->query($data);
		return $sql->num_rows;
	}

	function viewnilai($data){
		global $conn;
		$sql=$conn->query($data);
		$rows=[];
		while($row=$sql->fetch_assoc()){
			$rows[]=$row;
		}
		return $rows;
	}

	function isinilai($data,$m){
		global $conn;
		$tgl=date('Y-m-d');
		$id=$data['id'];
		$mp=$data['mp'];
		$th=$data['th'];
		$nil=$data['nil'];
		$as=$data['as'];
		$des=$data['des'];
		if($m=='1'){
			$sql="INSERT INTO tbnilairapor (idsiswa, idmapel, idthpel, aspek, nilairapor, tglinput) VALUES ('$id', '$mp', '$th', '$as', '$nil','$tgl')";
		}
		if($m=='2'){
			if($des=='' || $des==NULL){
				$sql="UPDATE tbnilairapor SET nilairapor='$nil', tglinput='$tgl' WHERE idsiswa='$id' AND idmapel='$mp' AND idthpel= '$th' AND aspek='$as'";
			}
			else {
			$sql="UPDATE tbnilairapor SET nilairapor='$nil', deskripsi='$des', tglinput='$tgl' WHERE idsiswa='$id' AND idmapel='$mp' AND idthpel= '$th' AND aspek='$as'";
			}
		}
		$conn->query($sql);
		return $conn->affected_rows;
	}
?>