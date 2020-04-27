<?php include '../config/koneksi.php'; 
if(!isset($_SESSION['username'])) {
    echo "<script>window.location='".base_url('log/login.php')."';</script>";
}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="text/css" href="<?=base_url()?>/assets/img/logo.png">
    <title>Filter Report Pemakaian Barang</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>/assets/libs/DataTable/datatables.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?=base_url()?>/assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>/assets/font-awesome/css/font-awesome.min.css">
    
    <!-- JavaScript -->
    <script src="<?=base_url()?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.js"></script>
    <script src="<?=base_url()?>/assets/libs/DataTable/datatables.min.js"></script>

    <!-- Page Specific Plugins -->
    <script src="<?=base_url()?>/assets/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?=base_url()?>/assets/js/tablesorter/tables.js"></script>
    <style type="text/css">
    	@media print {
    		#cetak {
    			visibility: hidden;
    		}
    	}
    </style>
  </head>
<body>
	<div id="page-wrappper">
		<div class="row">
			<div class="col-lg-2 col-lg-offset-1">
				<div style="margin-bottom: 20px;">
					<form action="" method="get">
						<div class="form-group">
							<label for="tgl_pakai" id="cetak">Cari Berdasarkan Tanggal Pemakaian</label>
							<input type="date" id="cetak" name="tgl_pakai" class="form-control">
						</div>
						<div class="form-group pull-right">
							<button type="submit" id="cetak" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" id="cetak"></span></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-2 col-lg-offset-1">
				<div style="margin-bottom: 20px;">
					<form action="" method="post">
						<div class="form-group">
							<label for="cari_barang" id="cetak">Cari Berdasarkan Barang</label>
							<input type="text" name="cari_barang" autocomplete="off" class="form-control">
						</div>
						<div class="form-group pull-right">
							<button type="submit" id="cetak" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" id="cetak"></span></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10 col-lg-offset-1">
				<div class="pull-right">
					<button class="btn btn-default btn-xs" onclick="window.print();" id="cetak">
						Cetak
					</button>
					<a href="data.php" id="cetak" class="btn btn-warning btn-xs">Kembali</a>
				</div>
				<div style="margin: 20px;">
					<h1 class="page-header">Data Transaksi</h1>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">				<thead>
											<tr>
											<th>Nomor</th>
											<th>Pemakai / Pengguna</th>
											<th>Nama Barang</th>
											<th>Jumlah Pakai</th>
											<th>Tanggal Pakai</th>
											<th>Sisa Terkini</th>
											</tr>
										</thead>
					<tbody>
					<?php 

					$no = 1;
					//Jika Pencarian Menggunakan Tanggal Transaksi
					 if($_SERVER['REQUEST_METHOD'] == "POST"){
						$cari_barang = trim(mysqli_real_escape_string($db, @$_POST['cari_barang']));
						if($cari_barang != ''){
							$sql = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user WHERE nama_barang like '%$cari_barang%'";
							$query = $sql;

						} else {
							$query = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user";
						}
					} else if($_SERVER['REQUEST_METHOD'] == "GET"){
						$tgl = @$_GET['tgl_pakai'];
						if($tgl != ''){
							$sql = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user WHERE tgl_pakai = '$tgl'";
							$query = $sql;

						} else {
							$query = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user";
						}
					}

						$sql = mysqli_query($db, $query) or die ($db->error);
						if(mysqli_num_rows($sql) > 0) {
						while ($data = mysqli_fetch_array($sql)) {
						?>
									<tr>
										<td><?=$no++?>.</td>
										<td><?=$data['nama_lengkap']?></td>
										<td><?=$data['nama_barang']?></td>
										<td><?=$data['jumlah_pakai']?></td>
										<td><?=$data['tgl_pakai']?></td>
										<td><?=$data['stok']?></td>
									</tr>
			     						<?php
											}
										} else {
											echo "<tr><td colspan=\"12\" align=\"center\">Data Tidak Ditemukan</td></tr>";
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>