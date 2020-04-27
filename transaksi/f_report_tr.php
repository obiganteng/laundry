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
    <title>Filter Report Transaksi</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>/assets/libs/DataTable/datatables.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?=base_url()?>/assets/css/sb-admin.css" rel="stylesheet">
    
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
							<label for="tanggal_transaksi" id="cetak">Cari Berdasarkan Tanggal Transaksi</label>
							<input type="date" id="cetak" name="tanggal_transaksi" class="form-control">
						</div>
						<div class="form-group pull-right">
							<button type="submit" id="cetak" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" id="cetak"></span></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-2 col-lg-offset-1">
				<div style="margin-bottom: 20px;">
					<form action="" method="get">
						<div class="form-group">
							<label for="jenis_ambil" id="cetak">Cari Berdasarkan Jenis Ambil</label>
							<select name="jenis_ambil" id="jenis_ambil" class="form-control">
							<option value="">~Cari Jenis Ambil~</option>
							<option value="Ambil">Ambil</option>
							<option value="Antar">Antar</option>
						</select>
						</div>
						<div class="form-group pull-right">
							<button type="submit" id="cetak" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" id="cetak"></span></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-2 col-lg-offset-1">
				<div style="margin-bottom: 20px;">
					<form action="" method="get">
						<div class="form-group">
							<label for="nama_jl" id="cetak">Cari Berdasarkan Jenis Laundry</label>
							<select name="nama_jl" id="nama_jl" class="form-control">
							<option value="">~Cari Jenis Laundry~</option>
							<?php  
							$sql_konsumen = mysqli_query($db, "SELECT * FROM jenis_laundry") or die ($db->error);
							while($data_kons = mysqli_fetch_array($sql_konsumen)) {
								echo '<option value="'.$data_kons['nama_jl'].'">'.$data_kons['nama_jl'].'</option>';
							}
							?>
						</select>
						</div>
						<div class="form-group pull-right">
							<button type="submit" id="cetak" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" id="cetak"></span></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10 col-lg-offset-1">
				<div class="pull-right">
					<a href="data.php" id="cetak" class="btn btn-warning btn-xs" style="margin-bottom: 10px;">Kembali</a>
					<div class="dropdown">
						<a href="#" class="dropdown-toggle btn btn-default btn-xs" data-toggle="dropdown">Cetak Berdasarkan</a>
						<ul class="dropdown-menu">
							<li>
								<a href="f_report_pdf.php?tanggal_transaksi=<?=$_GET['tanggal_transaksi']?>" class="btn btn-default btn-xs">Tanggal</a>
							</li>
							<li>
								<a href="f_report_pdf.php?jenis_ambil=<?=$_GET['jenis_ambil']?>" class="btn btn-default btn-xs">Jenis Ambil</a>
							</li>
							<li>
								<a href="f_report_pdf.php?nama_jl=<?=$_GET['nama_jl']?>" class="btn btn-default btn-xs">Jenis Laundry</a>
							</li>
						</ul>
					</div>
				</div>
				<div style="margin: 20px;">
					<h1 class="page-header">Data Transaksi</h1>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">				<thead>
											<tr>
											<th>Nomor</th>
											<th>Kasir</th>
											<th>Nama Konsumen</th>
											<th>Tanggal Transaksi</th>
											<th>Tanggal Ambil</th>
											<th>Jenis Ambil</th>
											<th>Alamat</th>
											<th>Jenis Laundry</th>
											<th>Pakaian</th>
											<th>Jumlah Kg/Satuan</th>
											<th>Total</th>
											</tr>
										</thead>
					<tbody>
					<?php 

					$no = 1;
					//Jika Pencarian Menggunakan Tanggal Transaksi
					if(isset($_GET['tanggal_transaksi'])){
						$tgl = $_GET['tanggal_transaksi'];
						$sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
													    INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
													    INNER JOIN user ON transaksi.id_user = user.id_user WHERE tanggal_transaksi = '$tgl'");
						if($tgl == ""){
							$sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
													    INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
													    INNER JOIN user ON transaksi.id_user = user.id_user");
						}
						//Jika Pencarian Menggunakan Jenis Ambil
					} else if(isset($_GET['jenis_ambil'])) {
						$cja = $_GET['jenis_ambil'];
						$sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
													    INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
													    INNER JOIN user ON transaksi.id_user = user.id_user WHERE jenis_ambil = '$cja'");
						if($cja == ""){
							$sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
													    INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
													    INNER JOIN user ON transaksi.id_user = user.id_user");
						}
						//Jika Pencarian Menggunakan Jenis Laundry
					} else if(isset($_GET['nama_jl'])) {
						$cnjl = $_GET['nama_jl'];
						$sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
													    INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
													    INNER JOIN user ON transaksi.id_user = user.id_user WHERE nama_jl = '$cnjl'");
						if($cnjl == ""){
							$sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
													    INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
													    INNER JOIN user ON transaksi.id_user = user.id_user");
						}
					} else {
						$sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
													    INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
													    INNER JOIN user ON transaksi.id_user = user.id_user");
					}
						if (mysqli_num_rows($sql) > 0) {
						while($data = mysqli_fetch_array($sql)) {
					?>
									<tr>
										<td><?=$no++?>.</td>
										<td><?=$data['nama_lengkap']?></td>
										<td><?=$data['nama_konsumen']?></td>
										<td><?=$data['tanggal_transaksi']?></td>
										<td><?=$data['tanggal_ambil']?></td>
										<td><?=$data['jenis_ambil']?></td>
										<?php if ($data['jenis_ambil'] == 'Antar') { ?>
										<td><?=$data['alamat']?></td>
										<?php } ?>
										<?php if ($data['jenis_ambil'] == 'Ambil') { ?>
										<td>-</td> 
										<?php } ?>
										<td><?=$data['nama_jl']?></td>
										<td><?=$data['nama_pakaian']?></td>
										<td><?=$data['jumlah']?></td>
										<?php 
										$antarq = 10000;
										if ($data['jenis_ambil'] == 'Antar') { ?>
											<td>Rp.<?= number_format($data['jumlah'] * $data['tarif'] + $antarq)?></td>
										<?php } ?>
										<?php if ($data['jenis_ambil'] == 'Ambil') { ?>
											<td>Rp.<?= number_format($data['jumlah'] * $data['tarif'])?></td>
										<?php } ?>
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