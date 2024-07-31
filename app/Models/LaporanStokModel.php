<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanStokModel extends Model
{
    protected $table = 'barang';
    protected $tableSatuan = 'satuan';
    protected $tableKategori = 'kategori';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['id_barang', 'nama', 'kategori', 'stok', 'satuan', 'harga_beli'];

    public function getBarangGabung($search = '')
    {
        $builder = $this->db->table($this->table)
            ->select('barang.*, kategori.nama_kategori, satuan.nama_satuan')
            ->join('kategori', 'kategori.id_kategori = barang.id_kategori')
            ->join('satuan', 'satuan.id_satuan = barang.id_satuan');

        if (!empty($search)) {
            $builder->like('barang.nama', $search);
        }

        return $builder->get()->getResultArray();
    }
}
