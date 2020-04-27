<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Pemakaian Barang</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Transaksi</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Riwayat Pemakaian Barang</li>
		  </ol>
		</nav>
		<div class="float-right">
			<a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
			<a href="add.php" class="btn btn-primary btn-sm">Pakai Barang</a>
		</div>
		<div style="margin-bottom: 20px;">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<input type="text" name="cari_pakai" autocomplete="off" class="form-control" placeholder="Cari Pemakaian Barang">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary ml-1">Cari</button>
				</div>
			</form>
		</div>
		<div class="float-right mb-3">
			<button class="btn btn-warning btn-sm" onclick="f_report()">Filter Report</button>
			<button class="btn btn-danger btn-sm" onclick="hapus()">Hapus</button>
		</div>
		<form name="proses" method="post">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Pemakai / Pengguna</th>
							<th>Nama Barang</th>
							<th>Jumlah Pakai</th>
							<th>Tanggal Pakai</th>
							<th>Sisa Terkini</th>
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
					if (empty($hal)) {
						$posisi = 0;
						$hal = 1;
					} else {
						$posisi = ($hal - 1) * $batas;
					}

					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$cari_pakai = trim(mysqli_real_escape_string($db, $_POST['cari_pakai']));
						if($cari_pakai != ''){
							$sql = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user WHERE nama_barang like '%$cari_pakai%' OR tgl_pakai like '%$cari_pakai%' OR nama_lengkap like '%$cari_pakai%'";
							$query = $sql;
							$queryJml = $sql;
						} else {
							$query = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user";
							$no = $posisi + 1;
						}
					} else {
						$query = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user LIMIT $posisi, $batas";
						$queryJml = "SELECT * FROM pemakaian_barang INNER JOIN barang_laundry ON pemakaian_barang.id_barang = barang_laundry.id_barang INNER JOIN user ON pemakaian_barang.id_user = user.id_user";
						$no = $posisi + 1;
					}

					$sql_data_pakai = mysqli_query($db, $query) or die ($db->error);
					if(mysqli_num_rows($sql_data_pakai) > 0) {
					while ($data = mysqli_fetch_array($sql_data_pakai)) {
					?>
					<tbody>
						<tr>
							<td><?=$no++?>.</td>
							<td><?=$data['nama_lengkap']?></td>
							<td><?=$data['nama_barang']?></td>
							<td><?=$data['jumlah_pakai']?></td>
							<td><?=$data['tgl_pakai']?></td>
							<td><?=$data['stok']?></td>
							<td align="center">
								<input type="checkbox" name="checked[]" class="checked" value="<?=$data['id_pemakaian']?>">
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
			if(@$_POST['cari_pakai'] == '') { ?>
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

	function f_report(){
		document.proses.action = 'f_report.php';
		document.proses.submit();
	}

	//script untuk fungsi dari button hapus
	function hapus() {
		//konfirmasi dari menghapus data
		var conf = confirm('Menghapus data-data ini?');
		if(conf){
			document.proses.action = 'delete.php';	
			document.proses.submit();
		}
		
	}

</script>
</div>
<?php include '../inc/footer.php'; ?>