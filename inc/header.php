<?php 
//koneksi dengan database dan memanggil fungsi dari base_url
require_once "../config/koneksi.php";
//meload uuid autoload composer
require "../assets/libs/vendor/autoload.php";
//cek login
if(!isset($_SESSION['username'])) {
    echo "<script>window.location='".base_url('log/login.php')."';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="text/css" href="<?=base_url()?>/assets/img/logo.png">
    <title>Laundry - Cuci Cucian</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/bootstrap.min.css">
    <link href="<?=base_url()?>/assets/css/sb-admin.css" rel="stylesheet">
    
    <script type="text/javascript" src="<?=base_url()?>/assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/assets/js/jquery.js"></script>
  </head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Laundrying</a>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('log/logout.php')?>">Log Out</a>
        </li>
      </ul>
</nav>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block sidebar">
      <div class="sidebar-sticky position-fixed">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>">
             Dashboard
            </a>
          </li>
          <h4 class="px-3 mt-4 mb-1 text-muted">
          <span>Master</span>
        </h4>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('barang/data.php')?>">
              Barang Laundry
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('supplier/data.php')?>">
              Supplier
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('konsumen/data.php')?>">
              Konsumen
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('jenis_laundry/data.php')?>">
              Jenis Laundry
            </a>
          </li>
        </ul>

        <h4 class="px-3 mt-4 mb-1 text-muted">
          <span>Transaksi</span>
        </h4>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('pemakaian/data.php')?>">
              Pemakaian Barang
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('pembelian/data.php')?>">
              Pembelian Barang
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('transaksi/data.php')?>">
              Transaksi
            </a>
          </li>
        </ul>
        <h4 class="px-3 mt-4 mb-1 text-muted">
          <span>User</span>
        </h4>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('log/profil.php')?>">
              Profile
            </a>
          </li>
          <?php if(@$_SESSION['level'] == 'Admin') { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('log/data_user.php')?>">
              Users
            </a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </nav>