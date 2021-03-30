<?php

namespace App\Models;

use CodeIgniter\Model;

class noti_model extends Model
{
    protected $db;
    public function __construct() {
        parent::__construct();
        $this->db = db_connect();
    }
    public function get_data_table($table = "",$close)
    {
        $date = date('Y-m-d', strtotime('+543 years'));

        $table = $this->db->prefixTable($table);
        $builder = $this->db->table($table);

        $builder->select('sp_borrow.*,notifications_del.id as noti_id,1 as type_noti
        ,notifications_read.id_noti_fk as id_noti_fk_read
        ,1 as type_noti');
        
        $builder->join('notifications_del', 'notifications_del.idnoti = sp_borrow.id', 'left');//table del
        $builder->join('notifications_read', 'notifications_read.id_noti_fk = sp_borrow.id', 'left');//table read
        $builder->join('notifications_hide', 'notifications_hide.id_noti_fk = sp_borrow.id', 'left');//table read
        // $builder->where(['date_return <'=> $date]);
        $builder->where(['date_return <'=> $date,'notifications_hide.id_noti_fk is null'=> null]);
        if($close == true){
            // $query = $builder->where(['date_return <'=> $date,'notifications_del.idnoti is null'=> null])->get();//ให้เลือกที่ยังไม่ปิด
            $builder->where(['notifications_del.idnoti is null'=> null]);//ให้เลือกที่ยังไม่ปิด
        }else if($close == false){
            // $query = $builder->where(['date_return <'=> $date])->get();
            // $builder->where(['date_return <'=> $date])->get();
        }
        $query = $builder->get();
        // $query = $builder->where(['date_return <'=> $date,'notifications_del.idnoti is null'=> null])->get();
        // $query = $builder->where(['date_return <'=> $date, 'idnoti is NULL'=> null])->get();
        return $query->getResultArray();
    }
    public function get_noti($id = null,$close = true)
    {
        return $this->get_data_table('sp_borrow',$close);
    }
    public function delNotifications($id = null, $type = "")
    {
        $table = $this->db->prefixTable('notifications_del');
        $builder = $this->db->table($table);
        $array = array('idnoti' => $id, 'type' => $type);
        $query = $builder->where($array)->get();
        $query->getResultArray();
        
        if (count($query->getResultArray()) > 0){
            return true;
        }
        else{
            $data = [
                'idnoti' => $id,
                'type' => $type
            ];
            $table = $this->db->prefixTable('notifications_del');
            $builder = $this->db->table($table);
            $result = $builder->insert($data);
            return $result;
        }

        // $data = [
        //     'idnoti' => $id,
        //     'type' => $type
        // ];
        // $table = $this->db->prefixTable('notifications_del');
        // $builder = $this->db->table($table);
        // $result = $builder->insert($data);
    }
    public function readNotifications($id_noti_fk = null, $type_noti = "")
    {
        $table = $this->db->prefixTable('notifications_read');
        $builder = $this->db->table($table);
        $array = array('id_noti_fk' => $id_noti_fk, 'type_noti' => $type_noti);
        $query = $builder->where($array)->get();
        $query->getResultArray();
        
        if (count($query->getResultArray()) > 0){
            return true;
        }
        else{
            $data = [
                'id_noti_fk' => $id_noti_fk,
                'type_noti' => $type_noti
            ];
            $table = $this->db->prefixTable('notifications_read');
            $builder = $this->db->table($table);
            $result = $builder->insert($data);
            return $result;
        }
    }
    public function hideNotifications($id_noti_fk = null, $type_noti = "")
    {
        $table = $this->db->prefixTable('notifications_hide');
        $builder = $this->db->table($table);
        $array = array('id_noti_fk' => $id_noti_fk, 'type_noti' => $type_noti);
        $query = $builder->where($array)->get();
        $query->getResultArray();
        
        if (count($query->getResultArray()) > 0){
            return true;
        }
        else{
            $data = [
                'id_noti_fk' => $id_noti_fk,
                'type_noti' => $type_noti
            ];
            $table = $this->db->prefixTable('notifications_hide');
            $builder = $this->db->table($table);
            $result = $builder->insert($data);
            return $result;
        }
    }
    // public function addLog($id)
    // {
    //     $data = [
    //         'date' => date("Y-m-d"),
    //         'time' => date("h:i:s"),
    //         'action_by' => $id
    //     ];
    //     $db = db_connect();
    //     $table = $db->prefixTable('log');
    //     $builder = $this->db->table($table);
    //     $builder->insert($data);
    // }
}