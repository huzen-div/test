<?php

namespace App\Models;

use CodeIgniter\Model;

class account_model extends Model
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
    public function sumBudget()
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_budget');
        $builder = $this->db->table($table);
        $query = $builder->selectCount('id')->get();

        return $query->getRow()->id;
    }
    public function getGeneralJournal($search = null, $from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_general_journal');
        $builder = $this->db->table($table);
        // if ($search != null) {
        //     $builder->where('id', $search);
        //     $builder->orwhere('no_id', $search);
        //     $builder->orwhere('refer', $search);
        //     $builder->orwhere('detail', $search);
        //     $builder->orwhere('amount', $search);
        // }
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
    public function getGeneralJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_general_journal');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addGeneralJournal($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_general_journal');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editGeneralJournal($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_general_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteGeneralJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_general_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getPayJournal($search = null, $from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_pay_journal');
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
    public function getPayJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_pay_journal');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addPayJournal($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_pay_journal');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPayJournal($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_pay_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePayJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_pay_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getReceiptJournal($search = null, $from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_receipt_journal');
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
    public function getReceiptJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_receipt_journal');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addReceiptJournal($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_receipt_journal');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editReceiptJournal($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_receipt_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteReceiptJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_receipt_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getSalesJournal($search = null, $from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_sales_journal');
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
    public function getSalesJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_sales_journal');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addSalesJournal($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_sales_journal');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editSalesJournal($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_sales_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteSalesJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_sales_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getPurchaseJournal($search = null, $from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_purchase_journal');
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
    public function getPurchaseJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_purchase_journal');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addPurchaseJournal($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_purchase_journal');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPurchaseJournal($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_purchase_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePurchaseJournalByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_purchase_journal');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getCreditor($startmon = null, $endmon = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_creditor');
        $builder = $this->db->table($table);

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('date >=', $startmon);
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $endmon);
        }
        // if ($search != null) {
        //     $builder->where('document_id', $search);
        //     $builder->orwhere('customer_id', $search);
        //     $builder->orwhere('amount', $search);
        //     $builder->orwhere('day', $search);
        // }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getCreditorByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_creditor');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }

    public function addCreditor($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_creditor');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editCreditor($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_creditor');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteCreditorByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_creditor');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getDebtor($startmon = null, $endmon = null, $search = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        $builder->orderBy('id', 'ASC');
        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('date >=', $startmon);
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $endmon);
        }
        if ($search != null) {
            $builder->where('document_id', $search);
            $builder->orwhere('customer_id', $search);
            $builder->orwhere('amount', $search);
            $builder->orwhere('day', $search);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function countDebtor()
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        $query = $builder->selectCount('id')->get();

        return $query->getRow()->id;
    }
    public function getDebtorByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }

    public function getDebtorLastID()
    {

        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        $count = $builder->limit(1)->orderBy('id', 'DESC')->get();

        $c = $count->getRow();

        if (!isset($c)) {
            return 1;
        } else {
            $id = $c->id;
            $id++;
            return $id;
        }

        /*
        if ($builder->countAllResults() == 0) {
            return 1;
        } else {
            return 0;
        }
        */
    }


    public function addDebtor($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editDebtor($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteDebtorByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function addAccountBook($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_account_book');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function updateAccountBook($data, $id)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_account_book');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }

    public function getAccountBookByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_account_book');
        $builder = $this->db->table($table);
        $query = $builder->where('supervisory_account', $id)->get();
        return $query->getResultArray();

        // return $data;
    }
    public function deleteAccountBook($id = null)
    {
        if ($id == null)
            return false;
        $data = $this->getAccountBookByID($id);
        if ($data != false) {
            foreach ($data as $row) {
                $this->deleteAccountBook($row['id']);
            }
        }
        $db = db_connect();
        $table = $db->prefixTable('ac_account_book');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }


    public function getAccountCategory()
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_account_book');
        $builder = $this->db->table($table);
        $query = $builder->where(['separate_department' => 1])
            ->where(['separate_department' => 1])
            ->where(['account_level' => 1])
            ->where(['type' => TRUE])
            ->where(['supervisory_account' => 0])
            ->orderBy('id', 'ASC')
            ->get();
        return $query->getResultArray();
    }
    public function getAccountCategoryByID($id = Null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_account_book');
        $builder = $this->db->table($table);
        $query = $builder
            ->where(['account_category' => $id])
            ->where(['type' => TRUE])
            ->get();
        return $query->getResultArray();
    }

    public function getFancyTree($id = null)
    {
        if ($id == null)
            return false;

        $db = db_connect();
        $table = $db->prefixTable('ac_account_book');
        $builder = $this->db->table($table);
        $query = $builder->where(['supervisory_account' => $id])->get();
        return $query->getResultArray();
    }


    public function getDebtorByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_debtor');
        $builder = $this->db->table($table);
        if ($startmon != null && $endmon != null) {
            $query = $builder
                ->where('date >=', $startmon)
                ->where('date <=', $endmon)
                ->get();
        } else if ($startmon != null) {
            $query = $builder
                ->where('date >=', $startmon)
                ->get();
        } else if ($endmon != null) {
            $query = $builder
                ->where('date <=', $endmon)
                ->get();
        }
        return $query->getResultArray();
    }


    public function getMoneysource($id = null, $year = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_money_source');
        $builder = $this->db->table($table);
        $builder->select('ac_money_source.*,ac_cost_estimate.main_item');
        $builder->join('ac_cost_estimate', 'ac_cost_estimate.id = ac_money_source.year', 'left');
        if ($id != null) {
            $builder->where('ac_money_source.id', $id);
        }
        if ($year != null) {
            $builder->where('ac_money_source.year', $year);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addMoneysource($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_money_source');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editMoneysource($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_money_source');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteMoneysource($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_money_source');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getCostestimate($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_cost_estimate');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addCostestimate($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_cost_estimate');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editCostestimate($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_cost_estimate');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteCostestimate($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_cost_estimate');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getBudget($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_budget');
        $builder = $this->db->table($table);
        $builder->select('ac_budget.*,ac_cost_estimate.main_item');
        $builder->join('ac_cost_estimate', 'ac_cost_estimate.id = ac_budget.type', 'left');
        if ($id != null) {
            $builder->where('ac_budget.id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addBudget($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_budget');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editBudget($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_budget');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteBudget($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('ac_budget');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    public function getCostestimateAPI($id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('ac_cost_estimate');
        $builder = $this->db->table($table);
        if ($id != null) {
            $builder->where('id', $id);
        }
        $builder->limit(1);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
