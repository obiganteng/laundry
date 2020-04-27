<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Users</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">User</a></li>
		    <li class="breadcrumb-item active" aria-current="page">List User</li>
		  </ol>
		</nav>
		<div class="float-right">
			<a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
		</div>
		<div style="margin-bottom: 20px;">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<input type="text" name="cari_user" class="form-control" placeholder="Cari User">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary ml-1">Cari</button>
				</div>
			</form>
		</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered mt-3">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Nama Lengkap</th>
							<th>Username</th>
							<th>Password</th>
							<th>Level</th>
							<th>Opsi</th>
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
						$cari_user = trim(mysqli_real_escape_string($db, $_POST['cari_user']));
						if($cari_user != ''){
							$sql = "SELECT * FROM user WHERE nama_lengkap like '%$cari_user%' OR username like '%$cari_user%'";
							$query = $sql;
							$queryJml = $sql;
						} else {
							$query = "SELECT * FROM user LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM user";
							$no = $posisi + 1;
						}
					} else {
						$query = "SELECT * FROM user LIMIT $posisi, $batas";
						$queryJml = "SELECT * FROM user";
						$no = $posisi + 1;
					}
					$sql_data_user = mysqli_query($db, $query) or die ($db->error);
					if (mysqli_num_rows($sql_data_user) > 0) {
					while ($data = mysqli_fetch_array($sql_data_user)) {
					?>
					<tbody>
						<tr>
							<td><?=$no++?>.</td>
							<td><?=$data['nama_lengkap']?></td>
							<td><?=$data['username']?></td>
							<td><?=$data['pass']?></td>
							<td><?=$data['level']?></td>
							<td align="center">
								<a href="edit_profil.php?id_user=<?=$data['id_user']?>" class="badge badge-info">Lihat</a>
								<a href="delete_user.php?id_user=<?=$data['id_user']?>" onclick="return confirm('Ingin Menghapus Data ini?')" class="badge badge-danger">Hapus</a>
							</td>
						</tr>
					<?php
						}
					} else {
						echo "<tr><td colspan=\"4\" align=\"center\">Data Tidak Ditemukan</td></tr>";
					}
					?>
					</tbody>
				</table>
			</div>
			<?php 
				if(@$_POST['cari_user'] == '') { ?>
					<div style="float: left;">
						<?php 
							$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
							echo "Jumlah Data : <b>$jml</b>";
						 ?>
					</div>

					<nav aria-label="page navigation example" class="float-right">
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
	</div>
</div>
<?php include '../inc/footer.php'; ?>