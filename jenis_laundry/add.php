<?php include '../inc/header.php'; ?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Jenis Laundry</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Master</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Laundry</li>
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
		<div class="container row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						Form Jenis Laundry
					</div>
					<div class="card-body">
						<form action="proses.php" method="post">
							<div class="form-group">
								<label for="nama_konsumen">Nama Jenis Laundry</label>
								<input type="text" name="nama_jl" class="form-control" required="required">
							</div>
							<div class="form-group">
								<label for="no_telepon">Tarif Jenis Laundry</label>
								<input type="text" name="tarif" placeholder="Hanya Angka" onkeypress="return isNumberKey(event)" class="form-control" required="required">
							</div>
							<div class="form-group float-right">
								<input type="submit" name="add" value="Simpan" class="btn btn-success">
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