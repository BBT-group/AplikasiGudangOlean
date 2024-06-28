<?php

namespace App\Models;

use CodeIgniter\Model;
//Bintang
class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $tableBarang = 'barang';

    protected $tableMsBarangMasuk = 'ms_barang_masuk';
    protected $primaryKey = 'id_barang_masuk';

    public function getBarangMasuk()
    {
        return $this->findAll();
    }

    public function getBarangMasukGabung()
    {
        return $this->db->table($this->table)
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->get()
            ->getResultArray()
            ;
    }
}
//Bintang