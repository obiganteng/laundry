<?php 
require_once "../config/koneksi.php";
require "../assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['simpan'])){
$uuid = Uuid::uuid4()->toString();
$nama_lengkap = trim(mysqli_real_escape_string($db, $_POST['nama_lengkap']));
$username = trim(mysqli_real_escape_string($db, $_POST['username']));
$password = trim(mysqli_real_escape_string($db, $_POST['password']));
$pass = trim(mysqli_real_escape_string($db, $_POST['pass']));

mysqli_query($db, "INSERT INTO user (id_user, nama_lengkap, username, password, pass, level) VALUES('$uuid', '$nama_lengkap', '$username', sha1('$password'), '$pass', 'Petugas')") or die ($db->error);
echo "<script>alert('Berhasil Menambah User'); window.location='pendaftaran.php';</script>";

} else if(isset($_POST['edit'])){

$id_user = trim(mysqli_real_escape_string($db, $_POST['id_user']));
$nama_lengkap = trim(mysqli_real_escape_string($db, $_POST['nama_lengkap']));
$username = trim(mysqli_real_escape_string($db, $_POST['username']));
$pass = trim(mysqli_real_escape_string($db, $_POST['pass']));
$level = trim(mysqli_real_escape_string($db, $_POST['level']));

mysqli_query($db, "UPDATE user SET nama_lengkap = '$nama_lengkap',
											   username = '$username',
											   pass = '$pass',
											   password = sha1('$pass'),
											   level = '$level'
											   WHERE id_user = '$id_user'") or die ($db->error);
echo "<script>alert('Berhasil Merubah User'); window.location='profil.php';</script>";
}

?>