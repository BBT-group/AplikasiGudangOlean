<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ms_user extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'operator',
            'password' => password_hash('456', PASSWORD_DEFAULT),
            'role' => 'operator',
            'nama' => 'operator',
            'status' => 'aktif'
        ];
        $this->db->table('ms_user')->insert($data);
    }
}
