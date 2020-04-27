<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Pemakaian Barang</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Transaksi</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Pakai Barang</li>
		  </ol>
		</nav>
		<div class="float-right">
			<a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
			<a href="data.php" class="btn btn-warning btn-sm">Kembali</a>
		</div>
		<!--Script Number Only -->
		<script>
	        function isNumberKey(evt)
	        {
	            var charCode = (evt.which) ? evt.which : event.keyCode
	            if (charCode > 31 && (charCode < 48 || charCode > 57))

	                return false;
	                return true;
	        }
		</script>
		<!-- Query Untuk Menampilkan User Login -->
		<?php
			$username = $_SESSION['username'];

			$query = "SELECT * FROM user WHERE username = '$username'";
			$exec = mysqli_query($db, $query);

			$is_exist = mysqli_num_rows($exec);
			if($is_exist > 0){
				$req = mysqli_fetch_assoc($exec);

				$_SESSION['nama_lengkap'] = $req['nama_lengkap'];
				$_SESSION['id_user'] = $req['id_user'];
			} else {
				die ('username atau password tidak ditemukan');
			}
		?>
		<div class="container row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						Form Pemakaian Barang
					</div>
					<div class="card-body">
						<form action="proses.php" method="post">
							<div class="form-group">
								<label for="id_user">Pemakai</label>
								<input type="text" class="form-control" value="<?=@$_SESSION['nama_lengkap']; ?>" readonly>
								<input type="hidden" name="id_user" value="<?=@$_SESSION['id_user']; ?>">
							</div>
							<div class="form-group">
								<label for="id_barang">Barang</label>
								<select name="id_barang" id="id_barang" class="form-control" required="required">
									<option value="">~ Pilih Barang ~</option>
									<?php  
									$sql_pake_barang = mysqli_query($db, "SELECT * FROM barang_laundry") or die ($db->error);
									while($data_pk_brg = mysqli_fetch_array($sql_pake_barang)) {
										echo '<option value="'.$data_pk_brg['id_barang'].'">'.$data_pk_brg['nama_barang'].'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="jumlah_pakai">Jumlah Pakai</label>
								<input type="text" name="jumlah_pakai" placeholder="Hanya Angka" onkeypress="return isNumberKey(event)" class="form-control" required="required">
							</div>
							<div class="form-group">
								<label for="tgl_pakai">Tanggal Pakai</label>
								<input type="date" name="tgl_pakai" value="<?=date('Y-m-d')?>" class="form-control" readonly>
							</div>
							<div class="form-group float-right">
								<input type="submit" name="add" value="Simpan" onclick="return confirm('Ingin Memakai Barang ini?')" class="btn btn-success">
								<input type="reset" name="reset" value="Batal" class="btn btn-danger">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include '../inc/footer.php'; ?>