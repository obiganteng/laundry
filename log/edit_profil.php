<?php include '../inc/header.php'; ?>

<div class="container-sm row">
    <div class="col-12">
        <h1>Profile User</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>">Laundrying</a></li>
            <li class="breadcrumb-item text-primary">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>
        </nav>
        <div class="float-right">
            <a href="" class="btn btn-default btn-sm text-muted">Refresh</a>
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
        <!-- Query Untuk Menampilkan User yang dipilih -->
        <?php 
            $id_user = $_GET['id_user'];
            $sql_user = mysqli_query($db, "SELECT * FROM user WHERE id_user = '$id_user'") or die ($db->error);
            $data = mysqli_fetch_array($sql_user);
        ?>
    <div class="contianer row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Form Profile User
                </div>
                <div class="card-body">
                    <form action="proses_regis.php" method="post">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="hidden" name="id_user" value="<?=$data['id_user']?>">
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?=$data['nama_lengkap']?>" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="<?=$data['username']?>" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="pass" id="password" value="<?=$data['pass']?>" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" class="form-control" required="required">
                                <option value="Admin" <?php if($data['level'] =='Admin'){echo "selected"; } ?>>Admin</option>
                                <option value="Petugas" <?php if($data['level'] =='Petugas') { echo "selected"; } ?>>Petugas</option>
                            </select>
                        </div>
                        <div class="form-group pull-right">
                            <input type="submit" name="edit" value="Simpan" class="btn btn-success" onclick="return confirm('Ingin Mengubah Informasi Anda?')">
                            <input type="reset" name="reset" value="Batal" class="btn btn-danger">
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>

<?php include_once "../inc/footer.php"; ?>