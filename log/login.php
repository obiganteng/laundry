<?php  
//koneksi ke database dan memanggil fungsi base_url
require_once "../config/koneksi.php";
//cek login

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
	<title>Login Page - Laundrying</title>
	<!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- JavaScript -->
    <script src="<?=base_url()?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
</head>
<body class="text-center">
		<div class="container">
			<div align="center" style="margin-top: 100px;">
				<?php 
				if(isset($_POST['login'])){
					$username = trim(mysqli_real_escape_string($db, $_POST['username']));
					$password = sha1(trim(mysqli_real_escape_string($db, $_POST['password'])));
					$sql = mysqli_query($db, "SELECT * FROM user WHERE username = '$username' AND password = '$password'") or die ($db->error);

					if(mysqli_num_rows($sql) > 0) {
						$_SESSION['username'] = $username;
						echo "<script>window.location='".base_url()."';</script>";
					} else { ?>
						<div class="row">
							<div class="col-lg-6 col-lg-offset-3">
								<div class="alert alert-danger alert-dismissable" role="alert">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<strong>Login Gagal,</strong> Username atau Password Salah!
								</div>
							</div>
						</div>
				<?php
					}
				}
				?>
				<img class="mb-4 rounded-circle" src="<?=base_url()?>/assets/img/logo.png" alt="" width="100" height="100">
					<div class="col-lg-6">
						<h1 class="text-info">Login Page - Laundrying</h1>
						<div class="panel-body">
							<form role="form" method="post" action="">
								<div class="form-group">
									<label class="float-left">Username</label>
									<input type="text" id="username" name="username" class="form-control" required="required" autofocus>
								</div>
								<div class="form-group">
									<label class="float-left">Password</label>
									<input type="password" id="password" name="password" class="form-control" required="required">
								</div>
								<div class="form-group float-right">
									<input type="submit" name="login" class="btn btn-primary" value="Log In">
									<a href="pendaftaran.php" class="btn btn-success">Daftar Akun</a>
								</div>
								<center>
									<p class="text-muted float-left mt-3">&copy; Laundrying - 2019</p>
								</center>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
</body>
</html>
<?php } ?>