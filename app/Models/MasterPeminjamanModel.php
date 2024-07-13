<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterPeminjamanModel extends Model
{

    protected $table = 'ms_peminjaman';
    protected $primaryKey = 'id_ms_peminjaman';

    protected $allowedFields = ['tanggal_pinjam', 'tanggal_kembali', 'id_penerima', 'status'];
}
