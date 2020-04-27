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
$pdf->Cell(53,6,'Supplier',1,0);
$pdf->Cell(60,6,'Barang',1,0);
$pdf->Cell(12,6,'Stok',1,0);
$pdf->Cell(22,6,'Harga',1,0);
$pdf->Cell(30,6,'Tanggal Beli',1,0);
$pdf->Cell(27,6,'Total',1,1);
 
$pdf->SetFont('Courier','',10);
 
$no = 1;
		$total = 0;
		$sql_pembelian = mysqli_query($db, "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user") or die ($db->error);
    if (mysqli_num_rows($sql_pembelian) > 0) {
	while ($data = mysqli_fetch_array($sql_pembelian)) {
	$pdf->Cell(8,6,$no++,1,0);
    $pdf->Cell(37,6,$data['nama_lengkap'],1,0);
    $pdf->Cell(53,6,$data['nama_supplier'],1,0);
    $pdf->Cell(60,6,$data['nama_barang'],1,0);
    $pdf->Cell(12,6,$data['stok'],1,0); 
    $pdf->Cell(22,6,$data['harga'],1,0);
    $pdf->Cell(30,6,$data['tgl_update'],1,0);
    $pdf->Cell(27,6,'Rp.'. number_format($data['total']),1,1);
    $total += $data['total'];
	}
}

	$pdf->Cell(10,7, '', 0,1);
	$pdf->SetFont('Courier','B',20);
	$pdf->Cell(80,10,'Total Pendapatan : ',1,0);
	$pdf->Cell(52,10, 'Rp.'. number_format($total),1,1);
 
$pdf->Output();
?>