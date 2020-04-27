<?php 
include_once '../config/koneksi.php';
// memanggil library FPDF
require('../assets/fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
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

$pdf->SetMargins(30,20,30);

$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Courier','B',10);
$pdf->Cell(8,6,'No',1,0);
$pdf->Cell(60,6,'Nama Barang',1,0);
$pdf->Cell(15,6,'Stok',1,0);
$pdf->Cell(35,6,'Tanggal Masuk',1,0);
$pdf->Cell(30,6,'Harga Barang',1,1);
 
$pdf->SetFont('Courier','',10);
 
	$no = 1;
		$sql_transaksi = mysqli_query($db, "SELECT * FROM barang_laundry") or die ($db->error);
    if (mysqli_num_rows($sql_transaksi) > 0) {
	while ($data = mysqli_fetch_array($sql_transaksi)) {

	$pdf->SetMargins(30,20,30);

	$pdf->Cell(8,6,$no++,1,0);
    $pdf->Cell(60,6,$data['nama_barang'],1,0);
    $pdf->Cell(15,6,$data['stok'],1,0);
    $pdf->Cell(35,6,$data['tgl_update'],1,0);
    $pdf->Cell(30,6,'Rp.'. number_format($data['harga']),1,1); 
	}
}
 
$pdf->Output();
?>