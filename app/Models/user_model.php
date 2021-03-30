<?php

namespace App\Models;

use CodeIgniter\Model;

class user_model extends Model
{

    public function addReceiveMoney($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_receive_money');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editReceiveMoney($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_receive_money');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
}
