<?php 
//koneksi dengan database dan memanggil fungsi dari base_url
require_once "../config/koneksi.php";

//cek dari fungsi checked di data.php
$cek = @$_POST['checked'];
if(!isset($cek)){
	echo "<script>alert('Tidak ada data yang dipilih'); window.location='data.php';</script>";
} else {
	foreach ($cek as $id_pemakaian) {
		$sql = mysqli_query($db, "DELETE FROM pemakaian_barang WHERE id_pemakaian = '$id_pemakaian'") or die ($db->error);
	}
	//script untuk alert penghapusan data 
	if ($sql) {
		echo "<script>alert('".count($cek)." Data Berhasil di Hapus'); window.location='data.php';</script>";
	} else {
		echo "<script>alert('Gagal Menghapus Data');</script>";
	}
}
?>