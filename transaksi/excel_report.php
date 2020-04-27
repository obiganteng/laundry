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
$sheet->setCellValue('B6', 'Data Hasil Transaksi');
$sheet->setCellValue('A8', 'No');
$sheet->setCellValue('B8', 'Kasir');
$sheet->setCellValue('D8', 'Nama Konsumen');
$sheet->setCellValue('F8', 'Tanggal Transaksi');
$sheet->setCellValue('H8', 'Tanggal Ambil');
$sheet->setCellValue('J8', 'Jenis Laundry');
$sheet->setCellValue('L8', 'Jumlah');
$sheet->setCellValue('M8', 'Status');
$sheet->setCellValue('N8', 'Total');
 
$query = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen INNER JOIN jenis_laundry ON transaksi.id_jl = jenis_laundry.id_jl INNER JOIN user ON transaksi.id_user = user.id_user");
$i = 9;
$no = 1;
$total = 0;
while($data = mysqli_fetch_array($query))
{
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $data['nama_lengkap']);	
	$sheet->setCellValue('D'.$i, $data['nama_konsumen']);
	$sheet->setCellValue('F'.$i, $data['tanggal_transaksi']);
	$sheet->setCellValue('H'.$i, $data['tanggal_ambil']);
	$sheet->setCellValue('J'.$i, $data['nama_jl']);
	$sheet->setCellValue('L'.$i, $data['jumlah']);
	$sheet->setCellValue('M'.$i, $data['status']);
	$antarq = 10000;
    $total1 = $data['jumlah'] * $data['tarif'] + $antarq;
    $total2 = $data['jumlah'] * $data['tarif'];
    if ($data['jenis_ambil'] == 'Antar') {
    $sheet->setCellValue('N'.$i, 'Rp.' .number_format($total1),1,1);
    } else if ($data['jenis_ambil'] == 'Ambil') {
    $sheet->setCellValue('N'.$i, 'Rp.' .number_format($total2),1,1);
    }
	$i++;
	$total += $total2 + $antarq;
}
 
	$sheet->setCellValue('K6', 'Total Pendapatan : ');
	$sheet->setCellValue('M6', ' Rp. '. number_format($total));

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Report Excel Transaksi.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
 
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>