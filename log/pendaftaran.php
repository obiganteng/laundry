<?php 
include "../config/koneksi.php";

if(isset($_SESSION['username'])){
	echo "<script>window.location='".base_url()."'</script>";
} else {

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="text/css" href="<?=base_url()?>/assets/img/logo.png">
	<title>Buat Akun - Laundrying</title>
	<!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?=base_url()?>/assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>/assets/font-awesome/css/font-awesome.min.css">
    
    <!-- JavaScript -->
    <script src="<?=base_url()?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>

    <!-- Page Specific Plugins -->
    <script src="<?=base_url()?>/assets/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?=base_url()?>/assets/js/tablesorter/tables.js"></script>
</head>
<body>
	<div class="wrapper">
		<div class="container">
			<div class="col-lg-6 col-lg-offset-3">
				<div class="panel panel-default">
					<div class="float-right"><a href="login.php" class="btn btn-warning btn-sm">Kembali</a></div>
					<div class="panel-body">
						<h3 class="text-primary"><b>Buat Akun</b></h3>
						<form role="role" action="proses_regis.php" method="post">
							<hr>
							<div class="form-group">
								<label for="nama_lengkap">Nama Lengkap</label>
								<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Masukan Nama Lengkap" required="required">
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username" required="required">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password" required="required">
							</div>
							<div class="form-group">
								<label for="pass">Ulangi Password</label>
								<input type="password" name="pass" id="pass" class="form-control" placeholder="Ulangi Password" required="required">
							</div>
							<div class="form-group pull-right">
								<input type="submit" name="simpan" class="btn btn-success" value="Daftar">
								<input type="reset" name="reset" class="btn btn-danger" value="Batal">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php } ?>