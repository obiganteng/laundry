<?php
//cek dari fungsi checked di data.php
$cek = @$_POST['checked'];
if(!isset($cek)){
	echo "<script>alert('Tidak ada data yang dipilih'); window.location='data.php';</script>";
} else {
	//meload file header dan memanggil fungsi didalmnya
	include_once "../inc/header.php";
?>

<div class="container-sm row">
    <div class="col-12">
        <h1>Supplier</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url('dashboard/index.php')?>">Laundrying</a></li>
            <li class="breadcrumb-item text-primary">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Supplier</li>
          </ol>
        </nav>
        <div class="float-right">
            <a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
            <a href="data.php" class="btn btn-warning btn-sm">Kembali</a>
        </div>
        <script language=Javascript>
            function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                    return true;
            }
        </script>
    <div class="container row mt-5">
    	<div class="col-lg-10">
            <div class="card">
                    <div class="card-header">
                        Form Edit Supplier
                    </div>
                    <div class="card-body">
                		<form action="proses.php" method="post">
                			<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
                			<table class="table">
                				<tr>
                					<th>#</th>
                					<th>Nama Supplier</th>
                					<th>Nomor Telepon</th>
                                    <th>Alamat</th>
                				</tr>
                				<?php 
            	    				$no = 1;
            	    				foreach ($cek as $id_supplier) {
            	    					$sql_supplier = mysqli_query($db, "SELECT * FROM supplier WHERE id_supplier = '$id_supplier'") or die ($db->error);
            	    					while($data = mysqli_fetch_array($sql_supplier)) {
                				?>
                					<tr>
                						<td><?=$no++?></td>
                						<td>
                							<input type="hidden" name="id_supplier[]" value="<?=$data['id_supplier']?>">
                							<input type="text" name="nama_supplier[]" value="<?=$data['nama_supplier']?>" class="form-control" required="required">
                						</td>
                						<td>
                							<input type="text" name="no_telepon[]" value="<?=$data['no_telepon']?>" class="form-control" required="required" onkeypress="return isNumberKey(event)">
                						</td>
                                        <td>
                                            <textarea name="alamat_supplier[]" class="form-control" required="required"><?=$data['alamat_supplier']?></textarea>
                                        </td>
                					</tr>
            	    				<?php
            	    					}
            	    				}
            	    				?>
                			</table>
                			<div class="form-group float-right">
                				<input type="submit" name="edit" value="Simpan" class="btn btn-success">
                                <input type="reset" name="reset" value="Batal" class="btn btn-danger">
                			</div>
                		</form>
                    </div>
                </div>
    	</div>
    </div>
</div>
<?php include_once "../inc/footer.php"; } ?>