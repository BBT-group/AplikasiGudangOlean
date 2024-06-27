<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;



class Barang extends Controller
{
    protected $barangModel;
    protected $kategoriModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->dataList = $this->loadExistingData();
    }

    public function loadExistingData()
    {
        session();

        return session()->get('datalist') ?? [];
    }

    public function saveData()
    {
        if ($this->barangModel->find($this->request->getVar('id_barang')) == null) {
            $this->simpan();
            $data2 = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'merk' => $this->request->getVar('merk'),
                'stok' => $this->request->getVar('stok'),
                'harga_beli' => $this->request->getVar('harga_beli'),
                'id_kategori' => $this->request->getVar('id_kategori'),
            ];
            $this->dataList[] = $data2;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang/index'));
        } else {
            return redirect()->to(base_url('/barang/index'));
        }
    }

    public function index()
    {
        d($this->request->getVar('searchinput'));
        $data = [
            'barang' => session()->get('datalist'),
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('admin\percobaan', $data);
    }

    public function simpan()
    {
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            // Check if the record exists
            $existingRecord = $this->kategoriModel->where('nama_kategori', strtolower($this->request->getVar('id_kategori')))->first();
            if ($existingRecord) {
                // Update the existing record
                $this->kategoriModel->update($existingRecord['id_kategori'], $existingRecord);
            } else {
                // Insert a new record
                $this->kategoriModel->insert(['nama_kategori' => $this->request->getVar('id_kategori')]);
            }
            $newID = $this->kategoriModel->where('nama_kategori', strtolower($this->request->getVar('id_kategori')))->first();
            $data = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'foto' => $foto_path,
                'merk' => $this->request->getVar('merk'),
                'stok' => $this->request->getVar('stok'),
                'harga_beli' => $this->request->getVar('harga_beli'),
                'id_kategori' => $newID['id_kategori'],
            ];
            return redirect()->to(base_url('/barang/index'));
        }
    }
    public function search()
    {
        // Load necessary libraries and helpers
        helper('url');
        $validation = \Config\Services::validation();

        // Set form validation rules
        $validation->setRules([
            'searchInput' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed
            echo '<p>' . $validation->listErrors() . '</p>';
        } else {
            // Validation successful
            $searchInput = $this->request->getVar('searchInput');


            $results = $this->barangModel->getBarangByName($searchInput);

            foreach ($results as $result) {
                echo '<p>' . $result['nama'] . '</p>';
                echo '<p>' . $result['nama_kategori'] . '</p>';
            }
            return dd($results);
        }
    }
}
