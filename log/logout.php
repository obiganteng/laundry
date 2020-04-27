<?php 
require_once "../config/koneksi.php";

unset($_SESSION['username']);
echo "<script>window.location='".base_url('log/login.php')."';</script>";
?>