<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $allowedFields = ['nama_inventaris', 'stok', 'harga_beli', 'foto'];

    public function getAlatById()
    {
    }
}
