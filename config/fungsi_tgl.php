<?php
if (!function_exists('indonesian_date')) {
    function indonesian_date($date)
    {
        $indonesian_month = array("Januari", "Februari", "Maret",
            "April", "Mei", "Juni",
            "Juli", "Agustus", "September",
            "Oktober", "November", "Desember");

        $year        = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $month       = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $currentdate = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
        if($month>=1)
            { 
                $result = $currentdate . " " . $indonesian_month[(int) $month - 1] . " " . $year;
            }
        else
        {
            $result = '';
        }
        return $result;
    }
	
}
?>
