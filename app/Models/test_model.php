<?php

namespace App\Models;

use CodeIgniter\Model;

class test_model extends Model
{
    public function getCustomers()
    {
        $db = db_connect();
        $table = $db->prefixTable('customers');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function addCustomer($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('customers');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }

    public function getPayJournal()
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_pay_journal');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function addPayJournal($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_pay_journal');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }

}
