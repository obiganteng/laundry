<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Transaksi</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Transaksi</a></li>
		    <li class="breadcrumb-item active" aria-current="page">List Transaksi</li>
		  </ol>
		</nav>
		<div class="float-right">
			<a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
			<a href="add.php" class="btn btn-primary btn-sm">Lakukan Transaksi!</a>
		</div>
		<div class="form-group input-group">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<input type="text" name="cari_tr" autocomplete="off" class="form-control" placeholder="Cari Transaksi">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary ml-1">Cari</button>
				</div>
			</form>
		</div>
		<div class="float-right mb-3">
			<button class="btn btn-danger btn-sm" onclick="report()">Export to PDF</button>
			<button class="btn btn-success btn-sm" onclick="excel()">Export to Excel</button>
			<button class="btn btn-warning btn-sm" onclick="f_report()">Filter Report</button>
			<button class="btn btn-danger btn-sm" onclick="hapus()">Hapus</button>
			<button class="btn btn-info btn-sm" onclick="bayarStatus()">$</i></button>
		</div>
		<form name="proses" method="post">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Konsumen</th>
							<th>Kasir</th>
							<th>Tanggal Transaksi</th>
							<th>Tanggal Ambil</th>
							<th>Jenis Ambil</th>
							<th>Alamat</th>
							<th>Jenis Laundry</th>
							<th>Qty</th>
							<th>Total</th>
							<th>Status</th>
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
					$batas = 5;
					$hal = @$_GET['hal'];
					if(empty($hal)){
						$posisi = 0;
						$hal = 1;
					} else {
						$posisi = ($hal - 1) * $batas;
					}

					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$cari_tr = trim(mysqli_real_escape_string($db, $_POST['cari_tr']));
						if($cari_tr != ''){
							$sql = "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user WHERE nama_konsumen like '%$cari_tr%' OR nama_lengkap like '%$cari_tr%' OR tanggal_transaksi like '%$cari_tr%' OR tanggal_ambil like '%$cari_tr%' OR jenis_ambil like '%$cari_tr%' OR nama_jl like '%$cari_tr%' OR nama_pakaian like '%$cari_tr%' OR jumlah like '%$cari_tr%'";
							$query = $sql;
							$queryJml = $sql;
						} else {
							$query = "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user";
							$no = $posisi + 1;
						}
					} else {
						$query = "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user LIMIT $posisi, $batas";
						$queryJml = "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user";
						$no = $posisi + 1;
					}
					$sql_data_tr = mysqli_query($db, $query) or die ($db->error);
					if (mysqli_num_rows($sql_data_tr) > 0) {
					while ($data = mysqli_fetch_array($sql_data_tr)) {
					?>
					<tbody>
						<tr>
							<td><?=$no++?>.</td>
							<td><?=$data['nama_konsumen']?></td>
							<td><?=$data['nama_lengkap']?></td>
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
							<td><?=$data['jumlah']?></td>
							<?php 
							$antarq = 10000;
							if ($data['jenis_ambil'] == 'Antar') { ?>
								<td>Rp.<?= number_format($data['jumlah'] * $data['tarif'] + $antarq)?></td>
							<?php } ?>
							<?php if ($data['jenis_ambil'] == 'Ambil') { ?>
								<td>Rp.<?= number_format($data['jumlah'] * $data['tarif'])?></td>
							<?php } ?>
							<?php if ($data['status'] == 'Lunas') { ?>
								<td><span class="badge badge-success"><?=$data['status']?></span></td>
							<?php } ?>
							<?php if ($data['status'] == 'Belum Bayar') { ?>
								<td><span class="badge badge-warning"><?=$data['status']?></span></td>
							<?php } ?>
							<td>
								<a href="struk_tr.php?no_transaksi=<?=$data['no_transaksi']?>" class="badge badge-info">Struk</a>
							</td>
							<td align="center">
								<input type="checkbox" name="checked[]" class="checked" value="<?=$data['no_transaksi']?>">
							</td>
						</tr>
						<?php
							}
						} else {
							echo "<tr><td colspan=\"13\" align=\"center\">Data Tidak Ditemukan</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<?php 
				if(@$_POST['cari_tr'] == '') { ?>
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

	function bayarStatus() {
		//konfirmasi dari menghapus data
		var conf = confirm('Transaksi Ini Sudah Lunas?');
		if(conf){
			document.proses.action = 'statusBayar.php';	
			document.proses.submit();
		}
		
	}

	function report() {
		document.proses.action = 'report_tr_pdf.php';
		document.proses.submit();
	}

	function f_report() {
		document.proses.action = 'f_report_tr.php';
		document.proses.submit();
	}

	function excel() {
		document.proses.action = 'excel_report.php';
		document.proses.submit();
	}

</script>
</div>
<?php include '../inc/footer.php'; ?>