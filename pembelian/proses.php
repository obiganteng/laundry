<?php 
require_once "../config/koneksi.php";
require "../assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
	
	$id_supplier = trim(mysqli_real_escape_string($db, $_POST['id_supplier']));
	$id_user = trim(mysqli_real_escape_string($db, $_POST['id_user']));
	$id_barang = trim(mysqli_real_escape_string($db, $_POST['id_barang']));
	$nama_barang = trim(mysqli_real_escape_string($db, $_POST['nama_barang']));
	$stok = trim(mysqli_real_escape_string($db, $_POST['stok']));
	$harga = trim(mysqli_real_escape_string($db, $_POST['harga']));
	$tgl_update = trim(mysqli_real_escape_string($db, $_POST['tgl_update']));
	$total = trim(mysqli_real_escape_string($db, ($stok * $harga)));

	

	mysqli_query($db, "INSERT INTO pembelian_barang (no_pembelian, id_barang, id_user, id_supplier, nama_barang, stok, harga, tgl_update, total) VALUES('', '$id_barang', '$id_user', '$id_supplier', '$nama_barang', '$stok', '$harga', '$tgl_update', '$total')") or die ($db->error);

		mysqli_query($db, "INSERT INTO barang_laundry (id_barang, nama_barang, stok, harga, tgl_update) VALUES ('$id_barang', '$nama_barang', '$stok', '$harga', '$tgl_update')") or die ($db->error);
	
	echo "<script>window.location='data.php'</script>";
}
?>