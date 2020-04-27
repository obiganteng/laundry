<?php 
//meload file dan memanggil fungsi yang ada didalamnya
require_once "../config/koneksi.php";
require "../assets/libs/vendor/autoload.php";
//penggunaan library uuid dari composer
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
	$total = $_POST['total'];
	for ($i=1; $i <= $total; $i++) { 
		$nama_barang = trim(mysqli_real_escape_string($db, $_POST['nama_barang-'.$i]));
		$stok = trim(mysqli_real_escape_string($db, $_POST['stok-'.$i]));
		$tgl_update = trim(mysqli_real_escape_string($db, $_POST['tgl_update-'.$i]));
		$harga = trim(mysqli_real_escape_string($db, $_POST['harga-'.$i]));
		$sql = mysqli_query($db, "INSERT INTO barang_laundry (id_barang, nama_barang, stok, tgl_update, harga) VALUES('', '$nama_barang', '$stok', '$tgl_update', '$harga')") or die ($db->error);
	}
	if ($sql) {
		echo "<script>alert('".$total." Data Berhasil di Tambahkan'); window.location='data.php';</script>";
	} else {
		echo "<script>alert('Gagal Menambah Data'); window.location='generate.php';</script>";
	}
} else if(isset($_POST['edit'])) {
	$id_barang = $_POST['id_barang'];
	$nama_barang = trim(mysqli_real_escape_string($db, $_POST['nama_barang']));
	$stok = trim(mysqli_real_escape_string($db, $_POST['stok']));
	$tgl_update = trim(mysqli_real_escape_string($db, $_POST['tgl_update']));
	$harga = trim(mysqli_real_escape_string($db, $_POST['harga']));
	mysqli_query($db, "UPDATE barang_laundry SET nama_barang = '$nama_barang', stok = '$stok', tgl_update = '$tgl_update', harga = '$harga' WHERE id_barang = '$id_barang'") or die ($db->error);
	echo "<script>alert('Data Barang Berhasil di Update'); window.location='data.php';</script>";
}	
	
?>