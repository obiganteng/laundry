<?php 
require_once "../config/koneksi.php";
require "../assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
	$uuid = Uuid::uuid4()->toString();
	$nama_konsumen = trim(mysqli_real_escape_string($db, $_POST['nama_konsumen']));
	$no_telepon = trim(mysqli_real_escape_string($db, $_POST['no_telepon']));
	$jenis_kelamin = trim(mysqli_real_escape_string($db, $_POST['jenis_kelamin']));
	$alamat = trim(mysqli_real_escape_string($db, $_POST['alamat']));
	mysqli_query($db, "INSERT INTO konsumen (id_konsumen, nama_konsumen, no_telepon, jenis_kelamin, alamat) VALUES('$uuid', '$nama_konsumen', '$no_telepon', '$jenis_kelamin', '$alamat')") or die ($db->error);
	echo "<script>alert('Data Konsumen Berhasil di Input'); window.location='data.php';</script>";
} else if(isset($_POST['edit'])) {
	for ($i=0; $i<count($_POST['id_konsumen']); $i++) {
		$id_konsumen = $_POST['id_konsumen'][$i];
		$nama_konsumen = $_POST['nama_konsumen'][$i];
		$no_telepon = $_POST['no_telepon'][$i];
		$jenis_kelamin = $_POST['jenis_kelamin'][$i];
		$alamat = $_POST['alamat'][$i];
		$sql = mysqli_query($db, "UPDATE konsumen SET nama_konsumen = '$nama_konsumen', no_telepon = '$no_telepon', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat' WHERE id_konsumen = '$id_konsumen'") or die ($db->error);
	} echo "<script>alert('Data Berhasil di Edit'); window.location='data.php';</script>";
}
	
?>