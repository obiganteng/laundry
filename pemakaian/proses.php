<?php 

include '../config/koneksi.php';

if (isset($_POST['add'])) {
	
	$id_barang = trim(mysqli_real_escape_string($db, $_POST['id_barang']));
	$id_user = trim(mysqli_real_escape_string($db, $_POST['id_user']));
	$jumlah_pakai = trim(mysqli_real_escape_string($db, $_POST['jumlah_pakai']));
	$tgl_pakai = trim(mysqli_real_escape_string($db, $_POST['tgl_pakai']));

	$check_id = mysqli_query($db, "SELECT * FROM barang_laundry WHERE id_barang = '$id_barang'");
	$req_check_id = mysqli_fetch_array($check_id);

	$jumlah = $req_check_id['stok'];

	if ($jumlah_pakai > $jumlah) {
		echo "<script>alert('Melebihi Jumlah Stok yang Tersedia');
					  window.location='add.php';</script>";

	} else if ($jumlah_pakai < $jumlah) {

		$query = mysqli_query($db, "INSERT INTO pemakaian_barang (id_pemakaian, id_barang, id_user, jumlah_pakai, tgl_pakai)VALUES ('', '$id_barang', '$id_user', '$jumlah_pakai', '$tgl_pakai')") or die ($db->error);
		$query2 = mysqli_query($db, "UPDATE barang_laundry SET stok = (stok - '$jumlah_pakai') WHERE id_barang = '$id_barang'") or die ($db->error);

		if ($query && $query2) {
		echo "<script>alert('Data Berhasil di Input'); window.location='data.php';</script>";
	}
}
}
?>