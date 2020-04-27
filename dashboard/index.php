<!-- Memanggil Fungsi dari Header -->
<?php include_once('../inc/header.php'); ?>

<?php
$username = $_SESSION['username'];

$query = "SELECT * FROM user WHERE username = '$username'";
$exec = mysqli_query($db, $query);

$is_exist = mysqli_num_rows($exec);
if($is_exist > 0){
	$req = mysqli_fetch_assoc($exec);

	$_SESSION['nama_lengkap'] = $req['nama_lengkap'];
	$_SESSION['level'] = $req['level'];
} else {
	die ('username atau password tidak ditemukan');
}
?>

	<?php 
	$data_transaksi = "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user";

	$hasil_tr = "SELECT * FROM transaksi INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl WHERE jumlah * tarif";

	$data_pemb_barang = "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user";

	$data_barang = "SELECT * FROM barang_laundry";
	?>

<div class="container row">
	<div class="col-lg-12">
		<h1 class="ml-2">Dashboard</h1>
		<hr>
		<p>Selamat Datang <mark><?=@$_SESSION['nama_lengkap']; ?></mark> - <mark><?=@$_SESSION['level']; ?></mark> 
		di Sistem Pengelolaan Laundry. <strong>Laundrying</strong></p>
		<p>Laundry Murah, Profesional dan Terpercaya.</p>
	</div>
	<div class="col-md-3">
		<div class="card ml-2">
			<div class="card-header">
				Barang Keperluan Laundry : <?php $jml = mysqli_num_rows(mysqli_query($db, $data_barang));
							echo "<b>$jml</b>"; ?>
			</div>
			<div class="card-body">
				<a href="<?= base_url('barang/data.php'); ?>" class="btn btn-primary btn-sm">View List</a>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">
				Rekam Transaksi : <?php $jml = mysqli_num_rows(mysqli_query($db, $data_transaksi));
							echo "<b>$jml</b>"; ?>
			</div>
			<div class="card-body">
				<a href="<?= base_url('transaksi/data.php'); ?>" class="btn btn-primary btn-sm">View List</a>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">
				Rekam Pembelian Barang : <?php $jml = mysqli_num_rows(mysqli_query($db, $data_pemb_barang));
							echo "<b>$jml</b>"; ?>
			</div>
			<div class="card-body">
				<a href="<?= base_url('pembelian/data.php'); ?>" class="btn btn-primary btn-sm">View List</a>
			</div>
		</div>
	</div>
</div>

<!-- Memanggil Fungsi dari Footer -->
<?php include_once('../inc/footer.php'); ?>