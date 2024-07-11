<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang', 'id_ms_barang_masuk', 'jumlah'];

    public function getBarangMasuk()
    {
        return $this->findAll();
    }
    public function getByMasterId($id)
    {
        return $this->where('id_barang_masuk', $id)->findAll();
    }
}
