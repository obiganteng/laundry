<?php 
//koneksi dengan database dan memanggil fungsi dari base_url
require_once "../config/koneksi.php";

//cek dari fungsi checked di data.php
$cek = @$_POST['checked'];
if(!isset($cek)){
	echo "<script>alert('Tidak ada data yang dipilih'); window.location='data.php';</script>";
} else {
	foreach ($cek as $no_transaksi) {
		$sql = mysqli_query($db, "UPDATE transaksi set status = 'Lunas' WHERE no_transaksi = '$no_transaksi'") or die ($db->error);
	}
	//script untuk alert penghapusan data 
	if ($sql) {
		echo "<script>alert('".count($cek)." Data Sudah Lunas'); window.location='data.php';</script>";
	} else {
		echo "<script>alert('Gagal Bayar');</script>";
	}
}
?>