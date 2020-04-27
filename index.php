<?php 
require_once "config/koneksi.php";
//cek login di dashboard dan login
if(isset($_SESSION['username'])) {
	echo "<script>window.location='".base_url('dashboard')."';</script>";
} else {
	echo "<script>window.location='".base_url('log/login.php')."';</script>";
}
?>