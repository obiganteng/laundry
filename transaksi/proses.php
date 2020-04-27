<?php 
include '../config/koneksi.php'; 

if (isset($_POST['add'])) {

	$id_konsumen = trim(mysqli_real_escape_string($db, $_POST['id_konsumen']));
	$id_user = trim(mysqli_real_escape_string($db, $_POST['id_user']));
	$tanggal_transaksi = trim(mysqli_real_escape_string($db, $_POST['tanggal_transaksi']));
	$tanggal_ambil = trim(mysqli_real_escape_string($db, $_POST['tanggal_ambil']));
	$jenis_ambil = trim(mysqli_real_escape_string($db, $_POST['jenis_ambil']));
	$id_jl = trim(mysqli_real_escape_string($db, $_POST['id_jl']));
	$nama_pakaian = trim(mysqli_real_escape_string($db, $_POST['nama_pakaian']));
	$jumlah = trim(mysqli_real_escape_string($db, $_POST['jumlah']));
	$status = trim(mysqli_real_escape_string($db, $_POST['status']));

	$insert_tr = mysqli_query($db, "INSERT INTO transaksi (no_transaksi, id_konsumen, id_user, tanggal_transaksi, tanggal_ambil, jenis_ambil, id_jl, nama_pakaian, jumlah, status) VALUES ('', '$id_konsumen', '$id_user', '$tanggal_transaksi', '$tanggal_ambil', '$jenis_ambil', '$id_jl', '$nama_pakaian', '$jumlah', '$status')") or die ($db->error);

	if ($insert_tr){
		echo "<script>alert('Transaksi Berhasil, Terima Kasih Telah Menggunakan Jasa Kami'); window.location='data.php';
    	</script>";
	}
}

?>