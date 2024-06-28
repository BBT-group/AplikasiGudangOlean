<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $allowedFields = ['id_barang', 'nama', 'satuan', 'foto', 'merk', 'stok', 'harga_beli', 'id_kategori'];

    public function getBarang()
    {
        return $this->findAll();
    }

    public function getBarangById($id)
    {
        return $this->find($id);
    }

    public function getBarangByName($name)
    {
        return $this->select('barang.*, kategori.name as category_name')
            ->join('kategori', 'kategori.id_kategori = barang.id_kategori')
            ->groupStart()
            ->like('barang.name', $name)
            ->orLike('kategori.name', $name)
            ->orLike('barang.id_barang', $name)
            ->groupEnd()
            ->findAll();
    }
    public function getBarangWithKategori()
    {
        return $this
                    ->join('kategori', 'kategori.id_kategori = barang.id_kategori')
                    ->findAll();
    }
    public function insertBarang($data)
    {
        $this->insert($data);
    }
    public function updateBarang($id, $data)
    {
        $this->update($id, $data);
    }
}
