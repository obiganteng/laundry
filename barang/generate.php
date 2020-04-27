<?php 
//meload file header dan memanggil fungsi yang ada didalamnya
include_once "../inc/header.php";
?>

<div class="container-sm row">
	<div class="col-12">
		<h1>Barang</h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url('dashboard/index.php')?>">Laundrying</a></li>
		    <li class="breadcrumb-item text-primary">Master</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
		  </ol>
		</nav>
		<div class="float-right">
			<a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
			<a href="data.php" class="btn btn-warning btn-sm">Kembali</a>
		</div>
		<div class="container">
			<div class="col-6">
				<form action="add.php" method="post">
					<div class="form-group">
						<label for="count_add">Banyak Record</label>
						<!-- Menginput count_add ke masukan count_add di add.php -->
						<input type="text" name="count_add" id="count_add" maxlength="2" pattern="[0-9]+" class="form-control" required="required">
					</div>
					<div class="form-group pull-right">
						<input type="submit" onclick="return confirm('Benar Ingin Input Segini?')" name="generate" value="Generate" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include '../inc/footer.php'; ?>