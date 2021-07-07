<?php
function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1){
	$merge = 'A1:A1';
	if($start>=0 && $end>=0 && $row>=0){
		$start = PHPExcel_Cell::stringFromColumnIndex($start);
		$end = PHPExcel_Cell::stringFromColumnIndex($end);
		$merge = "$start{$row}:$end{$row}";
	}
	return $merge;
}
?>