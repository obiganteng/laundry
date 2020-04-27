<?php 
date_default_timezone_set('Asia/Jakarta');
session_start();

include_once "ar_konek.php";

//koneksi
$db = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['db']);
if(mysqli_connect_error()){
	echo mysqli_connect_error();
}

function base_url($url = null){
	$base_url = "http://localhost/laundry";
	//membuat fungsi dari base_url
	if($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url;
	}
}

function tgl_indo($tgl){
	$tanggal = substr($tgl, 8, 2);
	$bulan = substr($tgl, 5, 2);
	$tahun = substr($tgl, 0, 4);

	return $tanggal."-".$bulan."-".$tahun;
}
?>