<?php

require_once '../config/koneksi.php';
require '../assets/excel/vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Helper\Sample; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('G2', 'Laundrying');
$sheet->setCellValue('F3', 'Jl. Sian, Kp. Tegal Rotan, Tangsel');
$sheet->setCellValue('E4', 'Telp. 08558047055, website: www.laundrying.g.net');
$sheet->setCellValue('B6', 'Data Pembelian Barang');
$sheet->setCellValue('A8', 'No');
$sheet->setCellValue('B8', 'Kasir');
$sheet->setCellValue('D8', 'Nama Supplier');
$sheet->setCellValue('G8', 'Nama Barang');
$sheet->setCellValue('J8', 'Stok');
$sheet->setCellValue('K8', 'Harga');
$sheet->setCellValue('L8', 'Tanggal Beli');
$sheet->setCellValue('N8', 'Total');
 
$query = mysqli_query($db, "SELECT * FROM pembelian_barang INNER JOIN supplier ON pembelian_barang.id_supplier = supplier.id_supplier INNER JOIN user ON pembelian_barang.id_user = user.id_user");
$i = 9;
$no = 1;
$total = 0;
while($data = mysqli_fetch_array($query))
{
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $data['nama_lengkap']);	
	$sheet->setCellValue('D'.$i, $data['nama_supplier']);
	$sheet->setCellValue('G'.$i, $data['nama_barang']);
	$sheet->setCellValue('J'.$i, $data['stok']);
	$sheet->setCellValue('K'.$i, $data['harga']);
	$sheet->setCellValue('L'.$i, $data['tgl_update']);
	$sheet->setCellValue('N'.$i, $data['total']);
	$i++;
	$total += $data['total'];
}
 
	$sheet->setCellValue('K6', 'Total Pembelian : ');
	$sheet->setCellValue('M6', ' Rp. '. number_format($total));
 
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Report Pembelian Barang.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
 
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>