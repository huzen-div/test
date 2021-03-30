<?php

namespace App\Models;

use CodeIgniter\Model;

class finance_model extends Model
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
    public function editSetting($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_setting');
        $builder = $this->db->table($table);
        $builder->where('id', 1)->update($data);
    }
    public function getSetting()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_setting');
        $builder = $this->db->table($table);
        $query = $builder->where('id', 1)->get();
        return $query->getResultArray();
    }
    public function getReceiveMoney($startmon = null, $endmon = null, $search = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_receive_money');
        $builder = $this->db->table($table);
        $builder->select('fn_receive_money.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_receive_money.customer_id', 'left');
        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('fn_receive_money.bill_date >=', $startmon);
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('fn_receive_money.bill_date <=', $endmon);
        }
        if ($search != null) {
            // $builder->like('ac_debtor.name', $search);

            $builder->where('fn_receive_money.id', $search);
            $builder->orwhere('fn_receive_money.customer_id', $search);
            $builder->orwhere('fn_receive_money.bill_id', $search);
            $builder->orwhere('fn_receive_money.employee_id', $search);
            $builder->orwhere('fn_receive_money.unit_id', $search);
            $builder->orwhere('ac_debtor.name', $search);
        }

        // if ($txt != '') {
        //     $builder->like('bill_id', $txt);
        // }
        // if ($from != '' && $to != '') {
        //     $array = ['bill_date >=' => $from, 'bill_date <=' => $to];
        //     $builder->where($array);
        // }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getReceiveMoneyByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_receive_money');
        $builder = $this->db->table($table);
        $builder->select('fn_receive_money.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_receive_money.customer_id', 'left');
        $query = $builder->where('fn_receive_money.id', $id)->get();
        return $query->getResultArray();
    }
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
    public function deleteReceiveMoneyByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_receive_money');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getDatePay()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_date_pay');
        $builder = $this->db->table($table);
        $builder->select('fn_date_pay.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_date_pay.customer_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function getDatePayByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_date_pay');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addDatePay($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_date_pay');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editDatePay($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_date_pay');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteDatePayByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_date_pay');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getAddDebt()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_add_debt');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAddDebtByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_add_debt');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addDebt($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_add_debt');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editaddDebt($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_add_debt');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteaddDebtByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_add_debt');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getReduceDebt()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_reduce_debt');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getReduceDebtByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_reduce_debt');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function reduceDebt($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_reduce_debt');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editreduceDebt($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_reduce_debt');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletereduceDebtByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_reduce_debt');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getAcceptPayment($sort = 'ASC')
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
        $builder = $this->db->table($table);
        $builder->select('fn_accept_payment.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_accept_payment.customer_id', 'left');
        $query = $builder->orderBy('id', $sort)->get();
        return $query->getResultArray();
    }
    public function getAcceptPaymentByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addAcceptPayment($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editAcceptPayment($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteAcceptPaymentByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getOverdue()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_overdue');
        $builder = $this->db->table($table);
        $builder->select('fn_overdue.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_overdue.customer_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getOverdueByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_overdue');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addOverdue($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_overdue');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editOverdue($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_overdue');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteOverdueByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_overdue');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getBilling()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_billing');
        $builder = $this->db->table($table);
        $builder->select('fn_billing.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_billing.customer_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getBillingByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_billing');
        $builder = $this->db->table($table);
        $builder->select('fn_billing.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_billing.customer_id', 'left');
        $query = $builder->where('fn_billing.id', $id)->get();
        return $query->getResultArray();
    }
    public function addBilling($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_billing');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editBilling($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_billing');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteBillingByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_billing');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    // public function getPayoffDebt()
    // {
    //     $db = db_connect();
    //     $table = $db->prefixTable('fn_payoff_debt');
    //     $builder = $this->db->table($table);
    //     $builder->select('fn_payoff_debt.*,ac_debtor.name');
    //     $builder->join('ac_debtor', 'ac_debtor.id = fn_payoff_debt.customer_id', 'left');
    //     $query = $builder->get();
    //     return $query->getResultArray();
    // }

    public function getPayoffDebt($from = null, $to = null, $type = null, $not_equal = null, $search = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);
        $builder->select('fn_payoff_debt.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_payoff_debt.customer_id', 'left');
        // change date format
        if ($from != null) {
            $ex1 = explode('/', $from);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $from = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('fn_payoff_debt.date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('fn_payoff_debt.date <=', $to);
        }
        if ($not_equal == null) {
            if ($type != null) {
                $builder->where('fn_payoff_debt.type_id', $type);
            }
        } else if ($not_equal == 1) {
            if ($type != null) {
                $builder->where('fn_payoff_debt.type_id !=', $type);
            }
        }

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPayoffDebtByAdddeptid()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);
        $query = $builder->where('add_debt_id', 2)->get();
        return $query->getResultArray();
    }

    public function sumPayoffDebt()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);

        $builder->where('type_id', 2);
        $query = $builder->selectSum('amount')->get();

        return $query->getRow()->amount;
    }
    public function sumImportBilling()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_moneyreciev_bank2');
        $builder = $this->db->table($table);
        $query = $builder->selectSum('amount')->get();

        return $query->getRow()->amount;
    }

    public function getPayoffDebtByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);
        $builder->select('fn_payoff_debt.*,ac_debtor.name');
        $builder->join('ac_debtor', 'ac_debtor.id = fn_payoff_debt.customer_id', 'left');
        $query = $builder->where('fn_payoff_debt.id', $id)->get();
        return $query->getResultArray();
    }
    public function addPayoffDebt($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPayoffDebt($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePayoffDebtByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getPayment()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payment');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPaymentByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_payment');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addPayment($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payment');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPayment($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_payment');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePaymentByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_payment');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getCheck()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_check');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getCheckByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_check');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addCheck($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_check');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editCheck($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_check');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteCheckByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_check');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getPettyCash()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_petty_cash');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPettyCashByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_petty_cash');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addPettyCash($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_petty_cash');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPettyCash($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_petty_cash');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletePettyCashByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_petty_cash');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getCheckPay()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_check_pay');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function sumCheckPay()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_check_pay');
        $builder = $this->db->table($table);
        $query = $builder->selectSum('cost')->get();

        return $query->getRow()->cost;
    }

    public function getCheckPayByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_check_pay');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addCheckPay($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_check_pay');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editCheckPay($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_check_pay');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteCheckPayByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_check_pay');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getTransfer()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_transfer');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getTransferByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_transfer');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }

    public function addTransfer($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_transfer');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editTransfer($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_transfer');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteTransferByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_transfer');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }




    public function getAcceptPaymentPresentByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;
        $ex1 = explode('/', $startmon);
        $ex2 = explode('/', $endmon);
        $y1 = $ex1[2] - 543;
        $y1 = $ex1[2];
        $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];

        $y2 = $ex2[2] - 543;
        $y2 = $ex2[2];
        $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];

        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
        $builder = $this->db->table($table);
        $query = $builder
            ->where('date >=', $startmon)
            ->where('date <=', $endmon)
            ->where('type_id !=', '2')
            ->get();
        return $query->getResultArray();
    }
    public function getAcceptPaymentOverdueByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;
        $ex1 = explode('/', $startmon);
        $ex2 = explode('/', $endmon);
        $y1 = $ex1[2] - 543;
        $y1 = $ex1[2];
        $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];

        $y2 = $ex2[2] - 543;
        $y2 = $ex2[2];
        $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];

        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
        $builder = $this->db->table($table);
        $query = $builder
            ->where('date >=', $startmon)
            ->where('date <=', $endmon)
            ->where('type_id =', '2')
            ->get();
        return $query->getResultArray();
    }
    public function getReceiveMoneyByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }


        // $db = db_connect();
        // $table = $db->prefixTable('fn_receive_money');
        // $builder = $this->db->table($table);
        // if ($startmon != null && $endmon != null) {
        //     $query = $builder
        //         ->where('bill_date >=', $startmon)
        //         ->where('bill_date <=', $endmon)
        //         ->get();
        // } else if ($startmon != null) {
        //     $query = $builder
        //         ->where('bill_date >=', $startmon)
        //         ->get();
        // } else if ($endmon != null) {
        //     $query = $builder
        //         ->where('bill_date <=', $endmon)
        //         ->get();
        // }
        $db = db_connect();
        $table = $db->prefixTable('fn_receive_money');
        $builder = $this->db->table($table);
        $builder->select('fn_receive_money.*,ac_debtor.name');


        if ($startmon != null) {
            $builder->where('fn_receive_money.bill_date >=', $startmon);
        }
        if ($endmon != null) {
            $builder->where('fn_receive_money.bill_date <=', $endmon);
        }
        $builder->join('ac_debtor', 'ac_debtor.id = fn_receive_money.customer_id',);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getDatePayByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }

        $db = db_connect();
        $table = $db->prefixTable('fn_date_pay');
        $builder = $this->db->table($table);
        $builder->select('fn_date_pay.*,ac_debtor.name');


        if ($startmon != null) {
            $builder->where('fn_date_pay.date >=', $startmon);
        }
        if ($endmon != null) {
            $builder->where('fn_date_pay.date <=', $endmon);
        }
        $builder->join('ac_debtor', 'ac_debtor.id = fn_date_pay.customer_id',);
        $query = $builder->get();

        return $query->getResultArray();
    }
    public function getAddDebtByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        $ex1 = explode('/', $startmon);
        $ex2 = explode('/', $endmon);
        $y1 = $ex1[2] - 543;
        $y1 = $ex1[2];
        $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];

        $y2 = $ex2[2] - 543;
        $y2 = $ex2[2];
        $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];


        $db = db_connect();
        $table = $db->prefixTable('fn_add_debt');
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
    public function getReduceDebtByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;
        $ex1 = explode('/', $startmon);
        $ex2 = explode('/', $endmon);
        $y1 = $ex1[2] - 543;
        $y1 = $ex1[2];
        $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];

        $y2 = $ex2[2] - 543;
        $y2 = $ex2[2];
        $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];

        $db = db_connect();
        $table = $db->prefixTable('fn_reduce_debt');
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
    public function getAcceptPaymentByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        $ex1 = explode('/', $startmon);
        $ex2 = explode('/', $endmon);
        $y1 = $ex1[2] - 543;
        $y1 = $ex1[2];
        $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];

        $y2 = $ex2[2] - 543;
        $y2 = $ex2[2];
        $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];


        $db = db_connect();
        $table = $db->prefixTable('fn_accept_payment');
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
    public function getOverdueByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }
        $db = db_connect();
        $table = $db->prefixTable('fn_overdue');
        $builder = $this->db->table($table);
        $builder->select('fn_overdue.*,ac_debtor.name');


        if ($startmon != null) {
            $builder->where('fn_overdue.date >=', $startmon);
        }
        if ($endmon != null) {
            $builder->where('fn_overdue.date <=', $endmon);
        }
        $builder->join('ac_debtor', 'ac_debtor.id = fn_overdue.customer_id',);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getBillingByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }
        $db = db_connect();
        $table = $db->prefixTable('fn_billing');
        $builder = $this->db->table($table);
        $builder->select('fn_billing.*,ac_debtor.name');


        if ($startmon != null) {
            $builder->where('fn_billing.date >=', $startmon);
        }
        if ($endmon != null) {
            $builder->where('fn_billing.date <=', $endmon);
        }
        $builder->join('ac_debtor', 'ac_debtor.id = fn_billing.customer_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPayoffDebtByDate($startmon = null, $endmon = null, $search = null)
    {
        // if ($startmon == null && $endmon == null)
        //     return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_payoff_debt');
        $builder = $this->db->table($table);
        $builder->select('fn_payoff_debt.*,ac_debtor.name');
        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('fn_payoff_debt.date >=', $startmon);
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('fn_payoff_debt.date <=', $endmon);
        }
        if ($search != null) {
            // $builder->like('fn_payoff_debt.document_id', $search);
            // $builder->orLike('fn_payoff_debt.customer_id', $search);
            // $builder->orLike('fn_payoff_debt.amount', $search);
            // $builder->orLike('fn_payoff_debt.day', $search);

            $builder->where('fn_payoff_debt.document_id', $search);
            $builder->orwhere('fn_payoff_debt.customer_id', $search);
            $builder->orwhere('fn_payoff_debt.amount', $search);
            $builder->orwhere('fn_payoff_debt.day', $search);
        }

        $builder->join('ac_debtor', 'ac_debtor.id = fn_payoff_debt.customer_id',);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getCheckByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }


        $db = db_connect();
        $table = $db->prefixTable('fn_check');
        $builder = $this->db->table($table);
        if ($startmon != null && $endmon != null) {
            $query = $builder
                ->where('implementation_date >=', $startmon)
                ->where('implementation_date <=', $endmon)
                ->get();
        } else if ($startmon != null) {
            $query = $builder
                ->where('implementation_date >=', $startmon)
                ->get();
        } else if ($endmon != null) {
            $query = $builder
                ->where('implementation_date <=', $endmon)
                ->get();
        }
        return $query->getResultArray();
    }
    public function getPettyCashByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }


        $db = db_connect();
        $table = $db->prefixTable('fn_petty_cash');
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
    public function getCheckPayByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;

        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }


        $db = db_connect();
        $table = $db->prefixTable('fn_check_pay');
        $builder = $this->db->table($table);
        if ($startmon != null && $endmon != null) {
            $query = $builder
                ->where('check_date >=', $startmon)
                ->where('check_date <=', $endmon)
                ->get();
        } else if ($startmon != null) {
            $query = $builder
                ->where('check_date >=', $startmon)
                ->get();
        } else if ($endmon != null) {
            $query = $builder
                ->where('check_date <=', $endmon)
                ->get();
        }
        return $query->getResultArray();
    }
    public function getTransferByDate($startmon = null, $endmon = null)
    {




        $db = db_connect();
        $table = $db->prefixTable('fn_transfer');
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
        $query = $builder->get();

        return $query->getResultArray();
    }
    public function sumOverdue()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_overdue');
        $builder = $this->db->table($table);
        $query = $builder->selectSum('amount')->get();

        return $query->getRow()->amount;
    }

    public function moneyreciev2($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_moneyreciev_bank2');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }

    // public function getmoneyreciev2()
    // {
    //     $db = db_connect();
    //     $table = $db->prefixTable('fn_moneyreciev_bank2');
    //     $builder = $this->db->table($table);
    //     $query = $builder->get();
    //     return $query->getResultArray();
    // }

    public function getmoneyreciev2($from = null, $to = null, $type = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_moneyreciev_bank2');
        $builder = $this->db->table($table);
        // change date format
        if ($from != null) {
            $ex1 = explode('/', $from);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $from = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('payment_date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('payment_date <=', $to);
        }
        if ($type != null) {
            $builder->where('transaction_code', $type);
        }

        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getmoneyreciev2ByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_moneyreciev_bank2');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }
    public function addBillingCsvFile($filesop)
    {
        $day = substr($filesop[4], 0, 2);
        $mon = substr($filesop[4], 2, 2);
        $year = substr($filesop[4], 4);
        $newtime = strtotime($year . $mon . $day);
        $filesop[4] = date('Y-m-d', $newtime);
        $data = [
            'record_type'           => $filesop[0],
            'sequence_no'           => $filesop[1],
            'bank_code'             => $filesop[2],
            'company_account'       => $filesop[3],
            'payment_date'          => date("Y-m-d", strtotime(date("Y-m-d", strtotime($filesop[4])) . " + 543 year")),
            // 'payment_date'          => $filesop[4],
            'payment_time'          => $filesop[5],
            'customer_name'         => $filesop[6],
            'customer_ref1'         => intval($filesop[7]),
            'customer_ref2'         => $filesop[8],
            'customer_ref3'         => $filesop[9],
            'branch_no'             => $filesop[10],
            'teller_no'             => $filesop[11],
            'kind_of_transaction'   => $filesop[12],
            'transaction_code'      => $filesop[13],
            'cheque_no'             => $filesop[14],
            'amount'                => $filesop[15],
            'cheque_bank_code'      => $filesop[16]
        ];
        $db = db_connect();
        $table = $db->prefixTable('fn_moneyreciev_bank2');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function getmoneyreciev2ByDate($startmon = null, $endmon = null)
    {
        if ($startmon == null && $endmon == null)
            return false;
        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }

        $db = db_connect();
        $table = $db->prefixTable('fn_moneyreciev_bank2');
        $builder = $this->db->table($table);


        if ($startmon != null) {
            $builder->where('payment_date >=', $startmon);
        }
        if ($endmon != null) {
            $builder->where('payment_date <=', $endmon);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPrintcheckpay()
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_print_check_pay');
        $builder = $this->db->table($table);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getPrintcheckpayByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_print_check_pay');
        $builder = $this->db->table($table);
        $query = $builder->where('id', $id)->get();
        return $query->getResultArray();
    }

    public function addPrintcheckpay($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_print_check_pay');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editPrintcheckpay($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_print_check_pay');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deleteTPrintcheckpayByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_print_check_pay');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
    public function getPrintcheckpayByDate($startmon = null, $endmon = null)
    {
        // if ($startmon == null && $endmon == null)
        //     return false;
        if ($startmon != null) {
            $ex1 = explode('/', $startmon);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $startmon = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
        }
        if ($endmon != null) {
            $ex2 = explode('/', $endmon);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $endmon = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
        }
        $db = db_connect();
        $table = $db->prefixTable('fn_print_check_pay');
        $builder = $this->db->table($table);
        if ($startmon != null) {
            $builder->where('date >=', $startmon);
        }
        if ($endmon != null) {
            $builder->where('date <=', $endmon);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getDeposit($from = null, $to = null, $id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_deposit');
        $builder = $this->db->table($table);
        if ($from != null) {
            $ex1 = explode('/', $from);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $from = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addDeposit($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_deposit');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editDeposit($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_deposit');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletetDepositByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_deposit');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }


    public function getWithdraw($from = null, $to = null, $id = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_withdraw');
        $builder = $this->db->table($table);
        if ($from != null) {
            $ex1 = explode('/', $from);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $from = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function addWithdraw($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_withdraw');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editWithdraw($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_withdraw');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletetWithdrawByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_withdraw');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }

    
    public function getSubscriptionfee($id = null,$from = null, $to = null)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_subscription_fee');
        $builder = $this->db->table($table);
        if ($from != null) {
            $ex1 = explode('/', $from);
            $y1 = $ex1[2];
            $y1 = $ex1[2];
            $from = $y1 . '-' . $ex1[1] . '-' . $ex1[0];
            $builder->where('date >=', $from);
        }
        if ($to != null) {
            $ex2 = explode('/', $to);
            $y2 = $ex2[2];
            $y2 = $ex2[2];
            $to = $y2 . '-' . $ex2[1] . '-' . $ex2[0];
            $builder->where('date <=', $to);
        }
        if ($id != null) {
            $builder->where('id', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function addSubscriptionfee($data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_subscription_fee');
        $builder = $this->db->table($table);
        $builder->insert($data);
    }
    public function editSubscriptionfee($id, $data)
    {
        $db = db_connect();
        $table = $db->prefixTable('fn_subscription_fee');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->update($data);
    }
    public function deletetSubscriptionfeeByID($id = null)
    {
        if ($id == null)
            return false;
        $db = db_connect();
        $table = $db->prefixTable('fn_subscription_fee');
        $builder = $this->db->table($table);
        $builder->where('id', $id)->delete();
    }
}
