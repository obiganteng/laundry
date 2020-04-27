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
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
 
$no = 1;
		$total = 0;
		$no_transaksi = $_GET['no_transaksi'];
		$sql_transaksi = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user WHERE no_transaksi = '$no_transaksi'") or die ($db->error);
    if (mysqli_num_rows($sql_transaksi) > 0) {
	while ($data = mysqli_fetch_array($sql_transaksi)) {

	$pdf->SetMargins(55,30,20);

	$pdf->Cell(10,7,'',0,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Kasir',1,0);
	$pdf->Cell(55,6,$data['nama_lengkap'],1,1);

	$pdf->Cell(10,7,'',0,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Nama Konsumen',1,0);
	$pdf->SetFont('Courier','B',13);
	$pdf->Cell(55,6,$data['nama_konsumen'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Tanggal Transaksi',1,0);
	$pdf->Cell(55,6,$data['tanggal_transaksi'],1,1);	

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Tanggal Ambil',1,0);
	$pdf->Cell(55,6,$data['tanggal_ambil'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Jenis Ambil',1,0);
	$pdf->SetFont('Courier','B',13);
	$pdf->Cell(55,6,$data['jenis_ambil'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Jenis Laundry',1,0);
	$pdf->SetFont('Courier','B',13);
	$pdf->Cell(55,6,$data['nama_jl'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Jumlah Kg/Satuan (Qty)',1,0);
	$pdf->SetFont('Courier','B',13);
	$pdf->Cell(55,6,$data['jumlah'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Nama Pakaian',1,0);
	$pdf->Cell(55,6,$data['nama_pakaian'],1,1);

	$pdf->Cell(10,7,'',0,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Total',1,0);
	$pdf->SetFont('Courier','B',13);
	$antarq = 10000;
	$total = $data['jumlah'] * $data['tarif'] + $antarq;
	$total2 = $data['jumlah'] * $data['tarif'];
	if ($data['jenis_ambil'] == 'Antar') {
	$pdf->Cell(55,6, 'Rp.'. number_format($total),1,1);
	} else if ($data['jenis_ambil'] == 'Ambil') {
	$pdf->Cell(55,6, 'Rp.'. number_format($total2),1,1);
	}
	}
}
 
$pdf->Output();
?>