<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBarangMasukModel extends Model
{
    protected $table = 'ms_barang_masuk';
    protected $primaryKey = 'id_barang_keluar';

    public function getBarangKeluar()
    {
        return $this->findAll();
    }
}
