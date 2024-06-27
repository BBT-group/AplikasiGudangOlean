<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model{
    protected $table = "ms_user";

    public function getData($parameter){
        $builder = $this->table($this->table);
        $builder->where('username', $parameter);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
