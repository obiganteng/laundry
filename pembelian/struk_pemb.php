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
		$no_pembelian = $_GET['no_pembelian'];
		$sql_pembelian = mysqli_query($db, "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user WHERE no_pembelian = '$no_pembelian'") or die ($db->error);
    if (mysqli_num_rows($sql_pembelian) > 0) {
	while ($data = mysqli_fetch_array($sql_pembelian)) {

	$pdf->SetMargins(50,30,20);

	$pdf->Cell(10,7,'',0,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Kasir',1,0);
	$pdf->Cell(60,6,$data['nama_lengkap'],1,1);

	$pdf->Cell(10,7,'',0,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Supplier',1,0);
	$pdf->SetFont('Courier','B',11);
	$pdf->Cell(60,6,$data['nama_supplier'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Nama Barang',1,0);
	$pdf->Cell(60,6,$data['nama_barang'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Stok',1,0);
	$pdf->Cell(60,6,$data['stok'],1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Harga per Unit',1,0);
	$pdf->Cell(60,6,'Rp.' . number_format($data['harga']),1,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Tanggal Beli',1,0);
	$pdf->Cell(60,6,$data['tgl_update'],1,1);

	$pdf->Cell(10,7,'',0,1);

	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(50,6,'Total',1,0);
	$pdf->SetFont('Courier','B',13);
	$pdf->Cell(60,6, 'Rp.'. number_format($data['total']),1,1);
    // $pdf->Cell(37,6,$data['nama_konsumen'],1,1);
    // $pdf->Cell(25,6, 'Rp.'. number_format($data['jumlah'] * $data['tarif']),1,1);
	}
}
 
$pdf->Output();
?>