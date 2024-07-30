<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $allowedFields = ['id_inventaris', 'nama_inventaris', 'stok', 'harga_beli', 'foto'];

    // public function getAlatById()
    // {
    // }
    public function getAlatById($id_inventaris)
    {
        return $this->where('id_inventaris', $id_inventaris)->first();
    }

    public function insertAlat($data)
    {
        return $this->insert($data);
    }

    public function updateAlat($id_inventaris, $data)
    {
        return $this->update($id_inventaris, $data);
    }
}
