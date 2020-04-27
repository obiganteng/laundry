<?php 
require_once "../config/koneksi.php";
require "../assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
	$uuid = Uuid::uuid4()->toString();
	$nama_supplier = trim(mysqli_real_escape_string($db, $_POST['nama_supplier']));
	$no_telepon = trim(mysqli_real_escape_string($db, $_POST['no_telepon']));
	$alamat_supplier = trim(mysqli_real_escape_string($db, $_POST['alamat_supplier']));
	mysqli_query($db, "INSERT INTO supplier (id_supplier, nama_supplier, no_telepon, alamat_supplier) VALUES('$uuid', '$nama_supplier', '$no_telepon', '$alamat_supplier')") or die ($db->error);
	echo "<script>alert('Data Supplier Berhasil di Input'); window.location='data.php';</script>";
} else if(isset($_POST['edit'])) {
		for ($i=0; $i<count($_POST['id_supplier']); $i++) {
		$id_supplier = $_POST['id_supplier'][$i];
		$nama_supplier = $_POST['nama_supplier'][$i];
		$no_telepon = $_POST['no_telepon'][$i];
		$alamat_supplier = $_POST['alamat_supplier'][$i];
		$sql = mysqli_query($db, "UPDATE supplier SET nama_supplier = '$nama_supplier', no_telepon = '$no_telepon',  alamat_supplier = '$alamat_supplier' WHERE id_supplier = '$id_supplier'") or die ($db->error);
	} echo "<script>alert('Data Berhasil di Edit'); window.location='data.php';</script>";
}
	
?>