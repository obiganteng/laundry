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
			<a href="generate.php" class="btn btn-warning btn-sm">Kembali</a>
		</div>
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
	    	<div class="col-nd-12">
	    		<div class="card">
					<div class="card-header">
						Form Barang
					</div>
					<div class="card-body">
	    				<form action="proses.php" method="post">
			    			<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
			    			<table class="table">
			    				<tr>
			    					<th>#</th>
			    					<th>Nama Barang</th>
			    					<th>Stok</th>
			    					<th>Tanggal Masuk</th>
			    					<th>Harga</th>
			    				</tr>
			    				<?php 
			    				for ($i=1; $i <= $_POST['count_add']; $i++) { ?>
			    					<tr>
			    						<td><?=$i?></td>
			    						<td>
			    							<input type="text" name="nama_barang-<?=$i?>" class="form-control" required="required">
			    						</td>
			    						<td>
			    							<input type="text" name="stok-<?=$i?>" class="form-control" onkeypress="return isNumberKey(event)" required="required">
			    						</td>
			    						<td>
			    							<input type="date" name="tgl_update-<?=$i?>" class="form-control" required="required" value="<?=date('Y-m-d')?>">
			    						</td>
			    						<td>
			    							<input type="text" name="harga-<?=$i?>" class="form-control" onkeypress="return isNumberKey(event)" required="required">
			    						</td>
			    					</tr>
			    				<?php
			    				}
			    				?>
			    			</table>
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