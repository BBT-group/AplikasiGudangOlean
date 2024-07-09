<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['id_barang', 'id_ms_barang_keluar', 'jumlah'];

    public function getBarangKeluar()
    {
        return $this->findAll();
    }
}
