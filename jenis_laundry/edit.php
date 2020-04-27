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
        <h1>Jenis Laundry</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url('dashboard/index.php')?>">Laundrying</a></li>
            <li class="breadcrumb-item text-primary">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Jenis Laundry</li>
          </ol>
        </nav>
        <div class="float-right">
            <a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
            <a href="data.php" class="btn btn-warning btn-sm">Kembali</a>
        </div>
    <div class="container row mt-5">
        <div class="col-lg-8">
            <div class="card">
                    <div class="card-header">
                        Form Edit Jenis Laundry
                    </div>
                    <div class="card-body">
                		<form action="proses.php" method="post">
                			<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
                			<table class="table">
                				<tr>
                					<th>#</th>
                					<th>Nama Jenis Laundry</th>
                                    <th></th>
                					<th>Tarif Jenis Laundry</th>
                				</tr>
                				<?php 
            	    				$no = 1;
            	    				foreach ($cek as $id_jl) {
            	    					$sql_jenis_laundry = mysqli_query($db, "SELECT * FROM jenis_laundry WHERE id_jl = '$id_jl'") or die ($db->error);
            	    					while($data = mysqli_fetch_array($sql_jenis_laundry)) {
                				?>
                					<tr>
                						<td><?=$no++?></td>
                						<td>
                							<input type="hidden" name="id_jl[]" value="<?=$data['id_jl']?>">
                							<input type="text" name="nama_jl[]" value="<?=$data['nama_jl']?>" class="form-control" required="required">
                						</td>
                                        <td>Rp.</td>
                						<td>
                							<input type="text" name="tarif[]" value="<?=$data['tarif']?>" class="form-control" required="required">
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