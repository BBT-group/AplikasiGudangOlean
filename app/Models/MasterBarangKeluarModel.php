<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBarangKeluarModel extends Model
{
    protected $table = 'ms_barang_Keluar';
    protected $primaryKey = 'id_barang_keluar';

    public function getBarangKeluar()
    {
        return $this->findAll();
    }
}
