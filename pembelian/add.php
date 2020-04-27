<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Pembelian Barang</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Transaksi</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Beli Barang</li>
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
		<!-- Query Untuk Nomor Otomatis Barang -->
		<?php
			$query = "SELECT max(id_barang) as maxKode FROM barang_laundry";
			$hasil = mysqli_query($db, $query);
			$data = mysqli_fetch_array($hasil);
			$kodeBarang = $data['maxKode'];

			$noUrut = (int) ($kodeBarang);
			$noUrut++;
			$kodeBarang = sprintf($noUrut);
		?>
		<div class="container-fluid">
		  <h4 class="header">Form Pembelian Barang</h4>
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
		      			<label for="id_supplier">Supplier</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="hidden" name="id_barang" value="<?=$kodeBarang?>">
		      				<select name="id_supplier" id="id_supplier" class="form-control" required="required">
								<option value="">~ Pilih Supplier ~</option>
									<?php  
									$sql_supplier = mysqli_query($db, "SELECT * FROM supplier") or die ($db->error);
									while($data_sup = mysqli_fetch_array($sql_supplier)) {
									echo '<option value="'.$data_sup['id_supplier'].'">'.$data_sup['nama_supplier'].'</option>';
								}
								?>
							</select>
		      			</div>
		      		</td>
		      	</tr>
		      	<div class="mt-5">
		      		<hr>
		      	</div>
		    </div>
		    <div class="col-sm">
		    	<hr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="nama_barang">Nama Barang</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="text" name="nama_barang" id="nama_barang" class="form-control" required="required">
		      			</div>
		      		</td>
		      	</tr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="stok">Stok</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="text" name="stok" id="stok" onkeypress="return isNumberKey(event)" class="form-control" required="required">
		      			</div>
		      		</td>
		      	</tr>
		      	<div class="mt-5">
		      		<hr>
		      	</div>
		    </div>
		    <div class="col-sm">
		    	<hr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="harga">Harga</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="text" name="harga" id="harga" onkeypress="return isNumberKey(event)" class="form-control" required="required">
		      				<input type="hidden" name="total">
		      			</div>
		      		</td>
		      	</tr>
		      	<tr>
		      		<td style="vertical-align: top">
		      			<label for="tgl_update">Tanggal Beli / Masuk</label>
		      		</td>
		      		<td>
		      			<div class="form-group">
		      				<input type="date" name="tgl_update" value="<?=date('Y-m-d')?>" class="form-control" required="required">
		      			</div>
		      		</td>
		      	</tr>
		      	<div class="mt-5">
		      		<hr>
		      	</div>
		      	<tr>
		      		<td>
		      			<div class="form-group float-right">
		      				<input type="submit" name="add" value="Simpan" onclick="return confirm('Pembelian Sudah Benar?')" class="btn btn-success">
								<input type="reset" name="reset" value="Batal" class="btn btn-danger">
		      			</div>
		      		</td>
		      	</tr>
		      </form>
		    </div>
		  </div>
		</div>
	</div>
</div>
<?php include '../inc/footer.php'; ?>