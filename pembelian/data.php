<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Pembelian Barang</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Transaksi</a></li>
		    <li class="breadcrumb-item active" aria-current="page">List Pembelian Barang</li>
		  </ol>
		</nav>
		<div class="float-right">
			<a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
			<a href="add.php" class="btn btn-primary btn-sm">Lakukan Pembelian Barang!</a>
		</div>
		<div style="margin-bottom: 20px;">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<input type="text" name="cari_pemb" autocomplete="off" class="form-control" placeholder="Cari Data Pembelian">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary ml-1">Cari</button>
				</div>
			</form>
		</div>
		<div class="float-right mb-3">
			<button class="btn btn-danger btn-sm" onclick="report_pembelian()">Export to PDF</button>
			<button class="btn btn-success btn-sm" onclick="excel()">Export Excel</button>
			<button class="btn btn-warning btn-sm" onclick="f_report()">Filter Report</button>
			<button class="btn btn-danger btn-sm" onclick="hapus()">Hapus</button>
		</div>
		<form name="proses" method="post">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Kasir</th>
							<th>Nama Supplier</th>
							<th>Nama Barang</th>
							<th>Stok</th>
							<th>Harga per Unit</th>
							<th>Tanggal Masuk</th>
							<th>Total</th>
							<th>Struk</th>
							<th>
								<center>
									<input type="checkbox" id="select_all" value="">
								</center>
							</th>
						</tr>
					</thead>
					<?php 
					$no = 1;
					$batas = 10;
					$hal = @$_GET['hal'];
					if(empty($hal)){
						$posisi = 0;
						$hal = 1;
					} else {
						$posisi = ($hal - 1) * $batas;
					}

					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$cari_pemb = trim(mysqli_real_escape_string($db, $_POST['cari_pemb']));
						if($cari_pemb != ''){
							$sql = "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user WHERE nama_barang like '%$cari_pemb%' OR nama_lengkap like '%$cari_pemb%' OR tgl_update like '%$cari_pemb%' OR stok like '%$cari_pemb%' OR nama_supplier like '%$cari_pemb%' OR harga like '%$cari_pemb%'";
							$query = $sql;
							$queryJml = $sql;
						} else {
							$query = "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user";
							$no = $posisi + 1;
						}
					} else {
						$query = "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user LIMIT $posisi, $batas";
						$queryJml = "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user";
						$no = $posisi + 1;
					}

					$sql_data_pemb = mysqli_query($db, $query) or die ($db->error);
					if (mysqli_num_rows($sql_data_pemb) > 0) {
					while ($data = mysqli_fetch_array($sql_data_pemb)) {
					?>
					<tbody>
						<tr>
							<td><?=$no++?>.</td>
							<td><?=$data['nama_lengkap']?></td>
							<td><?=$data['nama_supplier']?></td>
							<td><?=$data['nama_barang']?></td>
							<td><?=$data['stok']?></td>
							<td>Rp.<?= number_format($data['harga'])?></td>
							<td><?=$data['tgl_update']?></td>
							<td>Rp.<?= number_format ($data['harga'] * $data['stok']); ?></td>
							<td>
								<a href="struk_pemb.php?no_pembelian=<?=$data['no_pembelian']?>" class="badge badge-info">Struk</a>
							</td>
							<td align="center">
								<input type="checkbox" name="checked[]" class="checked" value="<?=$data['no_pembelian']?>">
							</td>
						</tr>
						<?php
							}
						} else {
							echo "<tr><td colspan=\"10\" align=\"center\">Data Tidak Ditemukan</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<?php 
				if(@$_POST['cari_pemb'] == '') { ?>
					<div style="float: left;">
						<?php 
							$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
							echo "Jumlah Data : <b>$jml</b>";
						 ?>
					</div>

					<nav aria-label="Page navigation example" class="float-right">
						<ul class="pagination">
						    <?php 
									$jml_hal = ceil($jml / $batas);
									for ($i=1; $i<= $jml_hal; $i++){
										if($i != $hal){
											echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?hal=$i\">$i</a></li>";
										} else {
											echo "<li class=\"page-item\"><a class=\"page-link text-muted\">$i</a></li>";
										}
									}
							?>
						</ul>
					</nav>
			<?php 
				} else {
					echo "<div style=\"float: left;\">";
					$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
					echo "Data Hasil Pencarian : <b>$jml</b>";
					echo "</div>";
				}
			 ?>
		</form>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		//script untuk fungsi dari id select_all ke checked/checkbox
		$('#select_all').on('click', function(){
			if(this.checked){
				$('.checked').each(function(){
					this.checked = true;
				})
			} else {
				$('.checked').each(function(){
					this.checked = false;
				})
			}
		});
		//script untuk fungsi dari class checked click id select_all
		$('.checked').on('click', function(){
			if($('.checked:checked').length == $('.checked').length) {
				$('#select_all').prop('checked',true)
			} else {
				$('#select_all').prop('checked',false)
			}
		})
	})

	//script untuk fungsi dari button hapus
	function hapus() {
		//konfirmasi dari menghapus data
		var conf = confirm('Menghapus data-data ini?');
		if(conf){
			document.proses.action = 'delete.php';	
			document.proses.submit();
		}
		
	}

	function report_pembelian() {
		document.proses.action = 'report_pengeluaran.php';
		document.proses.submit();
	}

	function f_report() {
		document.proses.action = 'f_report_pemb.php';
		document.proses.submit();
	}

	function excel() {
		document.proses.action = 'excel_r_pemb.php';
		document.proses.submit();
	}

</script>
</div>
<?php include '../inc/footer.php'; ?>