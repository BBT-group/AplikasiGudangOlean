<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class Laporan_Stok extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index(): string
    {
        $data = [
            'barang' => $this->barangModel->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_laporan_stok', $data);
    }

    public function exports()
    {
        $data = $this->barangModel->getBarangWithKategori();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header file
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'LAPORAN STOK BARANG GUDANG PT.OLEAN PERMATA');
        $sheet->mergeCells('A2:H2');
        $sheet->setCellValue('A2', 'Periode Januari 2024');

        // Header kolom
        $sheet->setCellValue('A3', 'ID Barang');
        $sheet->setCellValue('B3', 'Nama');
        $sheet->setCellValue('C3', 'Satuan');
        $sheet->setCellValue('D3', 'Foto');
        $sheet->setCellValue('E3', 'Merk');
        $sheet->setCellValue('F3', 'Stok');
        $sheet->setCellValue('G3', 'Harga Beli');
        $sheet->setCellValue('H3', 'Kategori');

        // Data
        $row = 4;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_barang']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['nama_satuan']);
            $sheet->setCellValue('E' . $row, $item['merk']);
            $sheet->setCellValue('F' . $row, $item['stok']);
            $sheet->setCellValue('G' . $row, $item['harga_beli']);
            $sheet->setCellValue('H' . $row, $item['nama_kategori']);
            
            // Add image
            if (!empty($item['foto']) && file_exists(FCPATH . 'public/uploads/' . $item['foto'])) {
                $drawing = new Drawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto');
                $drawing->setPath(FCPATH . 'public/uploads/' . $item['foto']);
                $drawing->setHeight(80);
                $drawing->setCoordinates('D' . $row);
                $drawing->setOffsetX(10);
                $drawing->setOffsetY(10);
                $drawing->setWorksheet($sheet);
            }

            $row++;
        }

        // Styling header
        $sheet->getStyle('A1:H2')->getFont()->setBold(true);
        $sheet->getStyle('A1:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_stok_barang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}