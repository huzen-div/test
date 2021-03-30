<?php

namespace App\Models;

use CodeIgniter\Model;

class supplie_model extends Model
{
    public function addLog($id)
    {
        $data = [
            'date' => date("Y-m-d"),
            'time' => date("h:i:s"),
            'action_by' => $id
        ];
        $db = db_connect();
        $table = $db->prefixTable('log');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }

    public function sumPurchase()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase');
        $builder = $this->db->table($table);
        $query = $builder->selectCount('id')->get();

        return $query->getRow()->id;
    }
    public function sumHire()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_hire');
        $builder = $this->db->table($table);
        $query = $builder->selectCount('id')->get();

        return $query->getRow()->id;
    }
    public function sumProductByStatus($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_product');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('status', $id);
        }
        $query = $builder->selectCount('id')->get();

        return $query->getRow()->id;
    }
    public function getProduct($status = null, $from = null, $to = null, $type_id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_product');
        $builder = $this->db->table($table);
        $builder->select('sp_product.*,sp_tax_rate.tax_rate,sp_tax_rate.type,sp_unit.unit_name as unit_name,sp_type.name as product_type_name
        ,sp_category.category_name
        ,sp_asset.id as asset_id,sp_asset.type as asset_type,sp_asset.date as asset_date,sp_asset.price as asset_price
        ,sp_asset.carcass as asset_carcass,sp_asset.rate_type as asset_rate_type,sp_asset.rate_value as asset_rate_value
        ,sp_asset.amount_first_year as asset_amount_first_year
        ,sp_depreciation.sale_date as dep_sale_date,sp_depreciation.sale_price as dep_sale_price,sp_depreciation.profit_loss as dep_profit_loss');
        $builder->join('sp_tax_rate', 'sp_tax_rate.id = sp_product.vat', 'left');
        $builder->join('sp_unit', 'sp_unit.id = sp_product.unit', 'left');
        $builder->join('sp_type', 'sp_type.id = sp_product.type_id', 'left');
        $builder->join('sp_category', 'sp_category.id = sp_product.category_main_id', 'left');

        // $builder->join('sp_asset', 'sp_asset.category = sp_category.id', 'left');
        // $builder->join('sp_depreciation', 'sp_depreciation.category = sp_category.id', 'left');
        $builder->join('sp_asset', 'sp_asset.category = sp_product.category_main_id', 'left');
        $builder->join('sp_depreciation', 'sp_depreciation.category = sp_product.category_main_id', 'left');
        if ($status != null) {
            $builder->where('sp_product.status', $status);
        }
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_product.date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_product.date <=', $to);
        }
        if ($type_id != null) {
            $builder->where('sp_product.type_id', $type_id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getProductForSelect($test)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_product');
        $builder = $this->db->table($table);
        $builder->select('name');
        if ($test != null) {
            $builder->like('name', $test);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_product');
        $builder = $this->db->table($table);
        // $builder->select('sp_product.*,sp_tax_rate.tax_rate,sp_tax_rate.type,sp_unit.unit_name as unit_name');
        // $builder->join('sp_tax_rate', 'sp_tax_rate.id = sp_product.vat', 'left');
        // $builder->join('sp_unit', 'sp_unit.id = sp_product.unit', 'left');
        
        $builder->select('sp_product.*,sp_tax_rate.tax_rate,sp_tax_rate.type,sp_unit.unit_name as unit_name,sp_type.name as product_type_name
        ,sp_category.category_name
        ,sp_asset.id as asset_id,sp_asset.type as asset_type,sp_asset.date as asset_date,sp_asset.price as asset_price
        ,sp_asset.carcass as asset_carcass,sp_asset.rate_type as asset_rate_type,sp_asset.rate_value as asset_rate_value
        ,sp_asset.amount_first_year as asset_amount_first_year
        ,sp_depreciation.sale_date as dep_sale_date,sp_depreciation.sale_price as dep_sale_price,sp_depreciation.profit_loss as dep_profit_loss');
        $builder->join('sp_tax_rate', 'sp_tax_rate.id = sp_product.vat', 'left');
        $builder->join('sp_unit', 'sp_unit.id = sp_product.unit', 'left');
        $builder->join('sp_type', 'sp_type.id = sp_product.type_id', 'left');
        $builder->join('sp_category', 'sp_category.id = sp_product.category_main_id', 'left');
        
        // $builder->join('sp_asset', 'sp_asset.category = sp_category.id', 'left');
        // $builder->join('sp_depreciation', 'sp_depreciation.category = sp_category.id', 'left');
        $builder->join('sp_asset', 'sp_asset.category = sp_product.category_main_id', 'left');
        $builder->join('sp_depreciation', 'sp_depreciation.category = sp_product.category_main_id', 'left');
        $query = $builder->where('sp_product.id', $id)->get();
        return $query->getResultArray();
    }
    public function addProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    public function getSupplies()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_supplies');
        $builder = $this->db->table($table);
        $builder->select('sp_supplies.*,sp_tax_rate.tax_rate,sp_tax_rate.type');
        $builder->join('sp_tax_rate', 'sp_tax_rate.id = sp_supplies.vat', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function getSuppliesByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_supplies');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addSupplies($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_supplies');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editSupplies($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_supplies');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteSuppliesByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_supplies');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    public function getReceiveSupplies($from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies');
        $builder = $this->db->table($table);
        $builder->select('sp_receive_supplies.*,sp_warehouse.name');
        $builder->join('sp_warehouse', 'sp_warehouse.id = sp_receive_supplies.warehouse_id', 'left');
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_receive_supplies.date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_receive_supplies.date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function getReceiveSuppliesByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies');
        $builder = $this->db->table($table);
        $builder->select('sp_receive_supplies.*,sp_warehouse.name');
        $builder->join('sp_warehouse', 'sp_warehouse.id = sp_receive_supplies.warehouse_id', 'left');
        $query = $builder->where('sp_receive_supplies.id', $id)->get();
        return $query->getResultArray();
    }
    public function addReceiveSupplies($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editReceiveSupplies($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteReceiveSuppliesByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getReceiveSuppliesProduct()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies_product');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getReceiveSuppliesProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies_product');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addReceiveSuppliesProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editReceiveSuppliesProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteReceiveSuppliesProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_receive_supplies_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getCheckStock($from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_check_stock');
        $builder = $this->db->table($table);
        $builder->select('sp_check_stock.*,sp_warehouse.name as warehouse_name');
        $builder->join('sp_warehouse', 'sp_warehouse.id = sp_check_stock.warehouse_id', 'left');
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_check_stock.date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_check_stock.date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getCheckStockByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_check_stock');
        $builder = $this->db->table($table);
        $builder->select('sp_check_stock.*,sp_warehouse.name as warehouse_name');
        $builder->join('sp_warehouse', 'sp_warehouse.id = sp_check_stock.warehouse_id', 'left');
        $query = $builder->where('sp_check_stock.id', $id)->get();
        return $query->getResultArray();
    }
    public function addCheckStock($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_check_stock');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editCheckStock($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_check_stock');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteCheckStockByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_check_stock');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getRequisition($from, $to)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition');
        $builder = $this->db->table($table);
        $builder->select('sp_requisition.*,sp_tax_rate.tax_rate,sp_tax_rate.type');
        $builder->join('sp_tax_rate', 'sp_tax_rate.id = sp_requisition.tax_rate', 'left');
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_requisition.date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_requisition.date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getRequisitionByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition');
        $builder = $this->db->table($table);
        $builder->select('sp_requisition.*,sp_tax_rate.tax_rate as tax_rate_rate,sp_tax_rate.type');
        $builder->join('sp_tax_rate', 'sp_tax_rate.id = sp_requisition.tax_rate', 'left');
        $query = $builder->where('sp_requisition.id', $id)->get();
        return $query->getResultArray();
    }
    public function addRequisition($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editRequisition($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteRequisitionByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getRequisitionProduct()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition_product');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getRequisitionProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition_product');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addRequisitionProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editRequisitionProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteRequisitionProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_requisition_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getBorrow($from, $to)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow');
        $builder = $this->db->table($table);
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getBorrowByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addBorrow($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editBorrow($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteBorrowByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getBorrowProduct()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow_product');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getBorrowProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow_product');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addBorrowProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editBorrowProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteBorrowProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_borrow_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getBuySupplies($from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies');
        $builder = $this->db->table($table);
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getBuySuppliesByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addBuySupplies($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editBuySupplies($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteBuySuppliesByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getBuySuppliesProduct()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies_product');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getBuySuppliesProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies_product');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addBuySuppliesProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editBuySuppliesProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteBuySuppliesProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_buy_supplies_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getPurchase()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPurchaseByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addPurchase($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPurchase($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePurchaseByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getPurchaseProduct()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase_product');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPurchaseProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase_product');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addPurchaseProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPurchaseProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePurchaseProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_purchase_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getSettingByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_setting');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function editSetting($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_setting');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function getTaxRate()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_tax_rate');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getTaxRateByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_tax_rate');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addTaxRate($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_tax_rate');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editTaxRate($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_tax_rate');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteTaxRateByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_tax_rate');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getUnit()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_unit as sp_unit');
        $builder = $this->db->table($table);
        // $builder->select('sp_unit.*,ste.unit_name as s_name');
        // $builder->join('sp_unit ste', 'sp_unit.unit_base = ste.id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getUnitByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_unit');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addUnit($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_unit');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editUnit($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_unit');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteUnitByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_unit');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getCategory()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getCategoryByCategorysub($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $query = $builder->where('category_sub', $id)->get();
        return $query->getResultArray();
    }
    public function getSubCategory($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_sub_category');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getCategoryByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function getCategoryByExceptID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $query = $builder->where('category_sub', 0);
        $query = $builder->where('id !=', $id)->get();
        return $query->getResultArray();
    }
    public function getCategoryBySubID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $query = $builder->where('category_sub', $id)->get();
        return $query->getResultArray();
    }
    public function getCategoryMain()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $query = $builder->where('category_sub', 0)->get();
        return $query->getResultArray();
    }
    public function addCategory($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $builder->insert($data);

        // ******************
        $builder->select('MAX(id) as max_id');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getResultArray();
        // ******************
    }
    public function addCategorySub($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_sub_category');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editCategory($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteCategoryByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_category');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getHire()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_hire');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getHireByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_hire');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addHire($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_hire');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editHire($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_hire');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteHireByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_hire');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getSupply()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_supply');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getSupplyByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_supply');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addSupply($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_supply');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editSupply($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_supply');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteSupplyByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_supply');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getInspection()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_inspection');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getInspectionByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_inspection');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addInspection($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_inspection');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editInspection($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_inspection');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteInspectionByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_inspection');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getRepair($from, $to)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair');
        $builder = $this->db->table($table);
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getRepairByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_repair');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addRepair($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function addRepairNew($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_new');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function getRepairNew($from, $to)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_new');
        $builder = $this->db->table($table);
        $builder->select('sp_repair_new.*,sp_product.id as pro_id,sp_product.name as pro_name');
        $builder->join('sp_product', 'sp_product.id = sp_repair_new.number', 'left');
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_repair_new.date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('sp_repair_new.date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getRepairNewByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_new');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function editRepair($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function editRepairNew($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_new');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteRepairByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_repair');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getRepairProduct()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_product');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getRepairProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_product');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addRepairProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editRepairProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteRepairProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_repair_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getLease($from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_lease');
        $builder = $this->db->table($table);
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getLeaseByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_lease');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addLease($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_lease');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editLease($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_lease');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteLeaseByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_lease');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getLeaseProduct()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_lease_product');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getLeaseProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_lease_product');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addLeaseProduct($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_lease_product');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editLeaseProduct($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_lease_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteLeaseProductByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_lease_product');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }


    public function getType()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_type');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getTypeByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_type');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addType($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_type');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editType($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_type');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteTypeByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_type');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    public function getDepreciation()
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_depreciation');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getDepreciationByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_depreciation');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addDepreciation($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_depreciation');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editDepreciation($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_depreciation');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteDepreciationByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_depreciation');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    // ------------------------------------------------------------------------

    public function getAsset($id = null, $category_search = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_asset');
        $builder = $this->db->table($table);
        $builder->select('sp_asset.*,sp_category.category_name');
        $builder->join('sp_category', 'sp_category.id = sp_asset.category', 'left');
        if ($id != null) {
            $builder->where('sp_asset.id', $id);
        }
        if ($category_search != null) {
            $builder->where('sp_asset.category', $category_search);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addAsset($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_asset');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editAsset($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_asset');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteAssetByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_asset');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    // ------------------------------------------------------------------------


    public function getWarehouse($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_warehouse');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addWarehouse($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_warehouse');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editWarehouse($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_warehouse');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteWarehouseByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_warehouse');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    public function getCheck($id = null, $from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_check');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addCheck($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_check');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editCheck($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_check');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteCheckByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_check');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    public function getFormpurchase($id = null, $from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_form_purchase');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('id', $id);
        }
        if ($from != null) {
            $ex2 = explode('/', $from);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $from = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addFormpurchase($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_form_purchase');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editFormpurchase($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('sp_form_purchase');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteFormpurchaseByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('sp_form_purchase');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    
    public function getPermissionsGroup($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('permissions_group');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addPermissionsGroup($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('permissions_group');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPermissionsGroup($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('permissions_group');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePermissionsGroup($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('permissions_group');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
}
