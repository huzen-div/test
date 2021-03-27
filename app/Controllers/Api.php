<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Model;

header('Access-Control-Allow-Origin: *');

class Api extends Controller
{
	public function __construct()
	{
		
	}

	public function permissions($id = null)
	{
		$db = db_connect();
        $table = $db->prefixTable('permissions_group');
        $builder = $db->table($table);
		$builder->select('id,group_name');
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        $data['group'] = $query->getResultArray();
		// $data['group'] 	= $this->supplie_model->getPermissionsGroup();
		// echo "<pre>";
		// var_dump($data['group']);
		// echo "</pre>";
		// die();
		return json_encode($data['group']);
	}
}
