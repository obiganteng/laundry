<?php 
include_once '../config/koneksi.php';
// memanggil library FPDF
require('../assets/fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Courier','B',16);
// mencetak string 
$pdf->Cell(190,7,'Laundrying',0,1,'C');
$pdf->setFont('Courier', 'B', 14);
$pdf->Cell(190,7, 'Jl. Sian, Kp. Tegal Rotan.',0,1,'C');
$pdf->SetFont('Courier','B',12);
$pdf->Cell(190,7,'Telp. 08558047055, website: www.laundrying.g.net',0,1,'C');
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
 
$pdf->SetFont('Courier','B',10);
$pdf->Cell(8,6,'No',1,0);
$pdf->Cell(37,6,'Kasir',1,0);
$pdf->Cell(38,6,'Nama Konsumen',1,0);
$pdf->Cell(38,6,'Tanggal Transaksi',1,0);
$pdf->Cell(30,6,'Tanggal Ambil',1,0);
$pdf->Cell(25,6,'Jenis Ambil',1,0);
$pdf->Cell(42,6,'Jenis Laundry',1,0);
$pdf->Cell(20,6,'Jumlah',1,0);
$pdf->Cell(20,6,'Status',1,0);
$pdf->Cell(25,6,'Total',1,1);
 
$pdf->SetFont('Courier','',10);
 
$no = 1;

        if(isset($_GET['tanggal_transaksi'])){
            $tgl = $_GET['tanggal_transaksi'];
            $sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user WHERE tanggal_transaksi = '$tgl'");
                        //Jika Pencarian Menggunakan Jenis Ambil
                    } else if(isset($_GET['jenis_ambil'])) {
                        $cja = $_GET['jenis_ambil'];
                        $sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
                                                        INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
                                                        INNER JOIN user ON transaksi.id_user = user.id_user WHERE jenis_ambil = '$cja'");
                        //Jika Pencarian Menggunakan Jenis Laundry
                    } else if(isset($_GET['nama_jl'])) {
                        $cnjl = $_GET['nama_jl'];
                        $sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
                                                        INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
                                                        INNER JOIN user ON transaksi.id_user = user.id_user WHERE nama_jl = '$cnjl'");
                    } else {
                        $sql = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen
                                                        INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl
                                                        INNER JOIN user ON transaksi.id_user = user.id_user");
                    }
    if (mysqli_num_rows($sql) > 0) {
	while ($data = mysqli_fetch_array($sql)) {
	$pdf->Cell(8,6,$no++,1,0);
    $pdf->Cell(37,6,$data['nama_lengkap'],1,0);
    $pdf->Cell(38,6,$data['nama_konsumen'],1,0);
    $pdf->Cell(38,6,$data['tanggal_transaksi'],1,0);
    $pdf->Cell(30,6,$data['tanggal_ambil'],1,0); 
    $pdf->Cell(25,6,$data['jenis_ambil'],1,0);
    $pdf->Cell(42,6,$data['nama_jl'],1,0);
    $pdf->Cell(20,6,$data['jumlah'],1,0);
    $pdf->Cell(20,6,$data['status'],1,0);
    $antarq = 10000;
    $total1 = $data['jumlah'] * $data['tarif'] + $antarq;
    $total2 = $data['jumlah'] * $data['tarif'];
    if ($data['jenis_ambil'] == 'Antar') {
    $pdf->Cell(25,6, 'Rp.'. number_format($total1),1,1);
    } else if ($data['jenis_ambil'] == 'Ambil') {
    $pdf->Cell(25,6, 'Rp.'. number_format($total2),1,1);
    }
	}
}
 
$pdf->Output();
?>