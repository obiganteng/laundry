<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Konsumen</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Master</a></li>
		    <li class="breadcrumb-item active" aria-current="page">List Konsumen</li>
		  </ol>
		</nav>
		<div class="float-right">
			<a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
			<a href="add.php" class="btn btn-success btn-sm">Tambah Konsumen</a>
		</div>
		<div style="margin-bottom: 20px;">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<input type="text" name="cari_konsumen" class="form-control" placeholder="Cari Konsumen">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary ml-1">Cari</button>
				</div>
			</form>
		</div>
		<div class="box float-right mb-3">
			<button class="btn btn-warning btn-sm" onclick="edit()">Edit</button>
			<button class="btn btn-danger btn-sm" onclick="hapus()">Hapus</button>
		</div>
		<form name="proses" method="post">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Nama Konsumen</th>
							<th>Nomor Telepon</th>
							<th>Jenis Kelamin</th>
							<th>Alamat Konsumen</th>
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
						$cari_konsumen = trim(mysqli_real_escape_string($db, $_POST['cari_konsumen']));
						if($cari_konsumen != ''){
							$sql = "SELECT * FROM konsumen WHERE nama_konsumen like '%$cari_konsumen%' OR no_telepon like '%$cari_konsumen%' OR alamat like '%$cari_konsumen%' OR jenis_kelamin like '%$cari_konsumen%'";
							$query = $sql;
							$queryJml = $sql;
						} else {
							$query = "SELECT * FROM konsumen LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM konsumen";
							$no = $posisi + 1;
						}
					} else {
						$query = "SELECT * FROM konsumen LIMIT $posisi, $batas";
						$queryJml = "SELECT * FROM konsumen";
						$no = $posisi + 1;
					}

					$sql_data_konsumen = mysqli_query($db, $query) or die ($db->error);
					if(mysqli_num_rows($sql_data_konsumen) > 0) {
					while ($data = mysqli_fetch_array($sql_data_konsumen)) {
					?>
					<tbody>
						<tr>
							<td><?=$no++?>.</td>
							<td><?=$data['nama_konsumen']?></td>
							<td><?=$data['no_telepon']?></td>
							<td><?=$data['jenis_kelamin']?></td>
							<td><?=$data['alamat']?></td>
							<td align="center">
								<input type="checkbox" name="checked[]" class="checked" value="<?=$data['id_konsumen']?>">
							</td>
						</tr>
					<?php
						}
					} else {
						echo "<tr><td colspan=\"6\" align=\"center\">Data Tidak Ditemukan</td></tr>";
					}
					?>
					</tbody>
				</table>
			</div>
			<?php 
			if(@$_POST['cari_konsumen'] == '') { ?>
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

	//script untuk fungsi dari button edit 
	function edit() {
		document.proses.action = 'edit.php';
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