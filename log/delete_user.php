<?php 
require_once "../config/koneksi.php";

mysqli_query($db, "DELETE FROM user WHERE id_user = '$_GET[id_user]'") or die ($db->error);
echo "<script>window.location='data_user.php';</script>";
?>