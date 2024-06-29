<?php

namespace App\Models;

use CodeIgniter\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';

    public function getBarangKeluar()
    {
        return $this->findAll();
    }
}
