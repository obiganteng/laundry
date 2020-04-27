<?php
include_once "../inc/header.php";
?>

<div class="container-sm row">
    <div class="col-12">
        <h1>Barang</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url('dashboard/index.php')?>">Laundrying</a></li>
            <li class="breadcrumb-item text-primary">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Barang</li>
          </ol>
        </nav>
        <div class="float-right">
            <a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
            <a href="data.php" class="btn btn-warning btn-sm">Kembali</a>
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
        <div class="container mt-5">
        <div class="col-lg-6">
            <?php 
            $id_barang = $_GET['id_barang'];
            $sql_barang = mysqli_query($db, "SELECT * FROM barang_laundry WHERE id_barang = '$id_barang'") or die ($db->error);
            $data = mysqli_fetch_array($sql_barang);
            ?>
            <div class="card">
                    <div class="card-header">
                        Form Edit Barang
                    </div>
                    <div class="card-body">
                        <form action="proses.php" method="post">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="hidden" name="id_barang" value="<?=$data['id_barang']?>">
                                <input type="text" name="nama_barang" id="nama_barang" value="<?=$data['nama_barang']?>" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" name="stok" id="stok" value="<?=$data['stok']?>" class="form-control" required="required" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="form-group">
                                <label for="tgl_update">Tanggal Masuk</label>
                                <input type="date" name="tgl_update" id="tgl_update" value="<?=$data['tgl_update']?>" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Barang</label>
                                <input type="text" name="harga" id="harga" value="<?=$data['harga']?>" class="form-control" required="required" onkeypress="return isNumberKey(event)">
                            </div>
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
</div>
<?php include_once "../inc/footer.php"; ?>