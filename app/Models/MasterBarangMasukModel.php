<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBarangMasukModel extends Model
{
    protected $table = 'ms_barang_masuk';
    protected $primaryKey = 'id_ms_barang_masuk';
    protected $allowedFields = ['waktu', 'id_supplier'];
    protected bool $allowEmptyInserts = true;
}
