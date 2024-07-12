<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_Masuk extends BaseController
{
    protected $barangmasukModel;
    
    public function __construct()
    {
        $this->barangmasukModel = new BarangMasukModel();
    }
    
    public function index()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data['barangmasuk'] = $this->barangmasukModel->getBarangMasukGabungFilter($start_date, $end_date);
        } else {
            $data['barangmasuk'] = $this->barangmasukModel->getBarangMasukGabung();
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        echo view('v_header');
        return view('v_laporan_masuk', $data);
    }

    public function exportm()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data = $this->barangmasukModel->getBarangMasukGabungFilter($start_date, $end_date);
        } else {
            $data = $this->barangmasukModel->getBarangMasukGabung();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header file
        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'LAPORAN MASUK STOK BARANG GUDANG PT.OLEAN PERMATA');
        $sheet->mergeCells('A2:I2');
        $sheet->setCellValue('A2', 'Periode ' . ($start_date ? $start_date : 'Semua') . ' - ' . ($end_date ? $end_date : 'Semua'));

        // Header kolom
        $sheet->setCellValue('A3', 'Id');
        $sheet->setCellValue('B3', 'Tanggal');
        $sheet->setCellValue('C3', 'Nama barang');
        $sheet->setCellValue('D3', 'Satuan');
        $sheet->setCellValue('E3', 'Harga masuk');
        $sheet->setCellValue('F3', 'Stock Awal');
        $sheet->setCellValue('G3', 'Stock masuk');
        $sheet->setCellValue('H3', 'Stok akhir');

        // Data
        $row = 4;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_barang']);
            $sheet->setCellValue('B' . $row, $item['waktu']);
            $sheet->setCellValue('C' . $row, $item['nama']);
            $sheet->setCellValue('D' . $row, $item['satuan']);
            $sheet->setCellValue('E' . $row, $item['harga_beli']);
            $sheet->setCellValue('F' . $row, $item['stok']);
            $sheet->setCellValue('G' . $row, $item['jumlah']);
            $sheet->setCellValue('H' . $row, $item['stok']);
            $row++;
        }

        // Styling header
        $sheet->getStyle('A1:I2')->getFont()->setBold(true);
        $sheet->getStyle('A1:I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Mengubah warna background header
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:I1')->getFill()->getStartColor()->setARGB('FF4CAF50'); // Warna hijau, gunakan kode warna hex RGB  

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_masuk_stok_barang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
