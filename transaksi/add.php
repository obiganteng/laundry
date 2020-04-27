<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Transaksi</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Transaksi</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Rekam Transaksi</li>
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
		<div class="container-fluid">
			<h4 class="header">Form Transaksi</h4>
		  <div class="row mt-3">
		    <div class="col-sm">
		    <hr>
		      <form action="proses.php" method="post">
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="id_user">Kasir</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="text" class="form-control" id="id_user" value="<?=@$_SESSION['nama_lengkap']; ?>" readonly>
							<input type="hidden" name="id_user" value="<?=@$_SESSION['id_user']; ?>">
		      			</div>
		      		</td>
		      	</tr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="id_konsumen">Konsumen</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<select name="id_konsumen" id="id_konsumen" class="form-control" required="required">
							<option value="">~ Pilih Konsumen ~</option>
									<?php  
							    	$sql_konsumen = mysqli_query($db, "SELECT * FROM konsumen") or die ($db->error);
									while($data_kons = mysqli_fetch_array($sql_konsumen)) {
									echo '<option value="'.$data_kons['id_konsumen'].'">'.$data_kons['nama_konsumen'].'</option>';
								}
							?>
							</select>
		      			</div>
		      		</td>
		      	</tr>
		      	<div class="mt-5">
		      		<hr>
		      	</div>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="nama_pakaian">Nama Pakaian</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="text" name="nama_pakaian" id="nama_pakaian" class="form-control" required="required">
		      			</div>
		      		</td>
		      	</tr>
		    </div>
		    <div class="col-sm">
		    	<hr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="tanggal_transaksi">Tanggal Transaksi</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?=date('Y-m-d')?>" class="form-control" required="required" readonly>
		      			</div>
		      		</td>
		      	</tr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="tanggal_ambil">Tanggal Ambil</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="date" name="tanggal_ambil" id="tanggal_ambil" class="form-control" required="required">
		      			</div>
		      		</td>
		      	</tr>
		      	<div class="mt-5">
		      		<hr>
		      	</div>
		      	<tr>
		      		<td style="vertical-align: top">
						<label for="jumlah">Jumlah Kilo/Satuan <small class="text-danger"> * Sesuaikan dengan Jenis Laundry</small></label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="text" name="jumlah" id="jumlah" class="form-control" onkeypress="return isNumberKey(event)" required="required">
		      			</div>
		      		</td>
		      	</tr>
		    </div>
		    <div class="col-sm">
		    	<hr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="jenis_ambil">Jenis Ambil</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<select name="jenis_ambil" id="jenis_ambil" class="form-control" required="required">
									<option value="">- Pilih Jenis Ambil -</option>
									<option value="Antar">Antar Kerumah / Delivery</option>
									<option value="Ambil">Ambil Ditempat</option>
							</select>
		      			</div>
		      		</td>
		      	</tr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="id_jl">Jenis Laundry</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<select name="id_jl" id="id_jl" class="form-control" required="required">
								<option value="">~ Pilih Jenis Laundry ~</option>
								<?php  
								$sql_jl = mysqli_query($db, "SELECT * FROM jenis_laundry") or die ($db->error);
								while($data_jens = mysqli_fetch_array($sql_jl)) {
									echo '<option value="'.$data_jens['id_jl'].'">'.$data_jens['nama_jl'].'</option>';
								}
								?>
							</select>
		      			</div>
		      		</td>
		      	</tr>
		      	<div class="mt-5">
		      		<hr>
		      	</div>
		      	<tr>
		      		<td>
		      			<div class="form-group float-right">
		      				<input type="hidden" name="status" value="Belum Bayar" readonly>
		      				<input type="submit" name="add" value="Simpan" onclick="return confirm('Transaksi Sudah Benar?')" class="btn btn-success">
								<input type="reset" name="reset" value="Batal" class="btn btn-danger">
		      			</div>
		      		</td>
		      	</tr>
		      </form>
		    </div>
		  </div>
		</div>
<?php include '../inc/footer.php'; ?>