<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $tableBarang = 'barang';
    protected $tableMsBarangMasuk = 'ms_barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang', 'id_ms_barang_masuk', 'jumlah'];

    public function getBarangMasuk()
    {
        return $this->findAll();
    }
}
