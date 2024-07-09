<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBarangMasukModel extends Model
{
    protected $table = 'ms_barang_masuk';
    protected $primaryKey = 'id_ms_barang_masuk';
    protected $allowedFields = ['waktu', 'id_supplier'];
    protected bool $allowEmptyInserts = true;

    public function getAll()
    {
        return $this->select('ms_barang_masuk.*, supplier.nama ')
            ->join('supplier', 'supplier.id_supplier = ms_barang_masuk.id_supplier')
            ->findAll();
    }
}
