<?php include '../config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="text/css" href="<?=base_url()?>/assets/img/logo.png">
    <title>Filter Report Per Tanggal</title>

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
							<label for="tgl_update" id="cetak">Cari Tanggal Beli Barang</label>
							<input type="date" id="cetak" name="tgl_update" class="form-control">
						</div>
						<div class="form-group pull-right">
							<button type="submit" id="cetak" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" id="cetak"></span></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10 col-lg-offset-1">
				<div class="pull-right">
                	<a href="f_report_pemb_pdf.php?tgl_update=<?=$_GET['tgl_update']?>" class="btn btn-default btn-xs">Cetak</a>
                	<a href="data.php" id="cetak" class="btn btn-warning btn-xs">Kembali</a>
				</div>
				<div style="margin: 20px;">
					<h1 class="page-header">Data Pembelian</h1>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">				<thead>
											<tr>
											<th>Nomor</th>
											<th>Kasir</th>
											<th>Nama Supplier</th>
											<th>Nama Barang</th>
											<th>Stok</th>
											<th>Harga</th>
											<th>Tanggal Beli</th>
											<th>Total</th>
											</tr>
										</thead>
										<tbody>
					<?php 

					$no = 1;

					if(isset($_GET['tgl_update'])){
						$tgl = $_GET['tgl_update'];
						$sql = mysqli_query($db, "SELECT * FROM pembelian_barang 
															 INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier
															 INNER JOIN user ON pembelian_barang.id_user = user.id_user WHERE tgl_update = '$tgl'");
						if($tgl == ""){
							$sql = mysqli_query($db, "SELECT * FROM pembelian_barang 
															 INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier
															 INNER JOIN user ON pembelian_barang.id_user = user.id_user");
						}
						
					} else {
						$sql = mysqli_query($db, "SELECT * FROM pembelian_barang 
															 INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier
															 INNER JOIN user ON pembelian_barang.id_user = user.id_user");
					}
						if (mysqli_num_rows($sql) > 0) {
						while($data = mysqli_fetch_array($sql)) {
					?>
									<tr>
										<td><?=$no++?>.</td>
										<td><?=$data['nama_lengkap']?></td>
										<td><?=$data['nama_supplier']?></td>
										<td><?=$data['nama_barang']?></td>
										<td><?=$data['stok']?></td>
										<td>Rp.<?= number_format($data['harga'])?></td>
										<td><?=$data['tgl_update']?></td>
										<td>Rp.<?php echo number_format ($data['harga'] * $data['stok']); ?></td>
			     						<?php
											}
										} else {
											echo "<tr><td colspan=\"10\" align=\"center\">Data Tidak Ditemukan</td></tr>";
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