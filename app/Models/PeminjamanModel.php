<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $allowedFields = ['foto', 'id_ms_peminjaman', 'id_barang', 'jumlah'];
}
