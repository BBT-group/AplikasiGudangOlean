<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $tableBarang = 'barang';
    protected $tableMsBarangMasuk = 'ms_barang_masuk';
    protected $tableSatuan = 'satuan';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang', 'id_ms_barang_masuk', 'jumlah'];

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
            ->getResultArray();
    }

    public function getBarangMasukGabungFilter($startDate, $endDate)
    {
        return $this->db->table($this->table)
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->where('DATE(waktu) >=', $startDate)
            ->where('DATE(waktu) <=', $endDate)
            ->get()
            ->getResultArray();
    }
    

    public function getByMasterId($id)
    {
        return $this->where('id_barang_masuk', $id)->findAll();

    }
}
