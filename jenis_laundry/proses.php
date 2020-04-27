<?php 
require_once "../config/koneksi.php";
require "../assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
	$uuid = Uuid::uuid4()->toString();
	$nama_jl = trim(mysqli_real_escape_string($db, $_POST['nama_jl']));
	$tarif = trim(mysqli_real_escape_string($db, $_POST['tarif']));
	mysqli_query($db, "INSERT INTO jenis_laundry (id_jl, nama_jl, tarif) VALUES('$uuid', '$nama_jl', '$tarif')") or die ($db->error);
	echo "<script>alert('Data Jenis Laundry Berhasil di Input'); window.location='data.php';</script>";
} else if(isset($_POST['edit'])) {
	for ($i=0; $i<count($_POST['id_jl']); $i++) {
		$id_jl = $_POST['id_jl'][$i];
		$nama_jl = $_POST['nama_jl'][$i];
		$tarif = $_POST['tarif'][$i];
		$sql = mysqli_query($db, "UPDATE jenis_laundry SET nama_jl = '$nama_jl', tarif = '$tarif' WHERE id_jl = '$id_jl'") or die ($db->error);
	} echo "<script>alert('Data Berhasil di Edit'); window.location='data.php';</script>";
}
	
?>