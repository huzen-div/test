<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Permissions extends Controller
{
    public function __construct()
    {
        $this->test_model = model('test_model');
        $this->finance_model = model('finance_model');
        $this->account_model = model('account_model');
        $this->supplie_model = model('supplie_model');
        $this->noti_model = model('noti_model');

        $session = session();
        if (!$session->has('login')) {
            return redirect()->to('/login');
        }
    }
    //--------------------------------------------------------------------
    public function view_group($id = null)
    {
        if ($id == null)
            return redirect()->to('/permissions');
        // $data['data'] 	= $this->noti_model->get_noti();
        $data['title'] = 'รายละเอียดการกำหนดสิทธิ์';
        $data['pages'] = [['link' => base_url('/permissions'), 'title' => 'กำหนดสิทธิ์'], ['link' => '#', 'title' => $data['title']]];

        echo view('header', $data);
        echo view('view_group');
        echo view('footer');
    }

    //--------------------------------------------------------------------
    public function add_group()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'group_name'                        => $this->request->getPost('group_name'),
                'statement_view'                    => $this->request->getPost('statement_view') ? $this->request->getPost('statement_view') : 0,
                'debtor_view'                       => $this->request->getPost('debtor_view') ? $this->request->getPost('debtor_view') : 0,
                'debtor_add_edit'                   => $this->request->getPost('debtor_add_edit') ? $this->request->getPost('debtor_add_edit') : 0,
                'debtor_del'                        => $this->request->getPost('debtor_del') ? $this->request->getPost('debtor_del') : 0,
                'subscription_fee_view'             => $this->request->getPost('subscription_fee_view') ? $this->request->getPost('subscription_fee_view') : 0,
                'subscription_fee_add_edit'         => $this->request->getPost('subscription_fee_add_edit') ? $this->request->getPost('subscription_fee_add_edit') : 0,
                'subscription_fee_del'              => $this->request->getPost('subscription_fee_del') ? $this->request->getPost('subscription_fee_del') : 0,
                'datepay_view'                      => $this->request->getPost('datepay_view') ? $this->request->getPost('datepay_view') : 0,
                'datepay_add_edit'                  => $this->request->getPost('datepay_add_edit') ? $this->request->getPost('datepay_add_edit') : 0,
                'datepay_del'                       => $this->request->getPost('datepay_del') ? $this->request->getPost('datepay_del') : 0,
                'billing_view'                      => $this->request->getPost('billing_view') ? $this->request->getPost('billing_view') : 0,
                'billing_add_edit'                  => $this->request->getPost('billing_add_edit') ? $this->request->getPost('billing_add_edit') : 0,
                'billing_del'                       => $this->request->getPost('billing_del') ? $this->request->getPost('billing_del') : 0,
                'import_billing_view'               => $this->request->getPost('import_billing_view') ? $this->request->getPost('import_billing_view') : 0,
                'import_billing_add_edit'           => $this->request->getPost('import_billing_add_edit') ? $this->request->getPost('import_billing_add_edit') : 0,
                'receiving_money_view'              => $this->request->getPost('receiving_money_view') ? $this->request->getPost('receiving_money_view') : 0,
                'receiving_money_add_edit'          => $this->request->getPost('receiving_money_add_edit') ? $this->request->getPost('receiving_money_add_edit') : 0,
                'receiving_money_del'               => $this->request->getPost('receiving_money_del') ? $this->request->getPost('receiving_money_del') : 0,
                'check_view'                        => $this->request->getPost('check_view') ? $this->request->getPost('check_view') : 0,
                'check_add_edit'                    => $this->request->getPost('check_add_edit') ? $this->request->getPost('check_add_edit') : 0,
                'check_del'                         => $this->request->getPost('check_del') ? $this->request->getPost('check_del') : 0,
                'acceptpayment_complete_view'       => $this->request->getPost('acceptpayment_complete_view') ? $this->request->getPost('acceptpayment_complete_view') : 0,
                'deposit_view'                      => $this->request->getPost('deposit_view') ? $this->request->getPost('deposit_view') : 0,
                'deposit_add_edit'                  => $this->request->getPost('deposit_add_edit') ? $this->request->getPost('deposit_add_edit') : 0,
                'deposit_del'                       => $this->request->getPost('deposit_del') ? $this->request->getPost('deposit_del') : 0,
                'overdue_view'                      => $this->request->getPost('overdue_view') ? $this->request->getPost('overdue_view') : 0,
                'overdue_add_edit'                  => $this->request->getPost('overdue_add_edit') ? $this->request->getPost('overdue_add_edit') : 0,
                'overdue_del'                       => $this->request->getPost('overdue_del') ? $this->request->getPost('overdue_del') : 0,
                'payoffdebt_view'                   => $this->request->getPost('payoffdebt_view') ? $this->request->getPost('payoffdebt_view') : 0,
                'payoffdebt_add_edit'               => $this->request->getPost('payoffdebt_add_edit') ? $this->request->getPost('payoffdebt_add_edit') : 0,
                'payoffdebt_del'                    => $this->request->getPost('payoffdebt_del') ? $this->request->getPost('payoffdebt_del') : 0,
                'print_check_pay_view'              => $this->request->getPost('print_check_pay_view') ? $this->request->getPost('print_check_pay_view') : 0,
                'print_check_pay_add_edit'          => $this->request->getPost('print_check_pay_add_edit') ? $this->request->getPost('print_check_pay_add_edit') : 0,
                'print_check_pay_del'               => $this->request->getPost('print_check_pay_del') ? $this->request->getPost('print_check_pay_del') : 0,
                'checkpay_view'                     => $this->request->getPost('checkpay_view') ? $this->request->getPost('checkpay_view') : 0,
                'checkpay_add_edit'                 => $this->request->getPost('checkpay_add_edit') ? $this->request->getPost('checkpay_add_edit') : 0,
                'checkpay_del'                      => $this->request->getPost('checkpay_del') ? $this->request->getPost('checkpay_del') : 0,
                'pettycash_view'                    => $this->request->getPost('pettycash_view') ? $this->request->getPost('pettycash_view') : 0,
                'pettycash_add_edit'                => $this->request->getPost('pettycash_add_edit') ? $this->request->getPost('pettycash_add_edit') : 0,
                'pettycash_del'                     => $this->request->getPost('pettycash_del') ? $this->request->getPost('pettycash_del') : 0,
                'withdraw_view'                     => $this->request->getPost('withdraw_view') ? $this->request->getPost('withdraw_view') : 0,
                'withdraw_add_edit'                 => $this->request->getPost('withdraw_add_edit') ? $this->request->getPost('withdraw_add_edit') : 0,
                'withdraw_del'                      => $this->request->getPost('withdraw_del') ? $this->request->getPost('withdraw_del') : 0,
                'transfer_view'                     => $this->request->getPost('transfer_view') ? $this->request->getPost('transfer_view') : 0,
                'transfer_add_edit'                 => $this->request->getPost('transfer_add_edit') ? $this->request->getPost('transfer_add_edit') : 0,
                'transfer_del'                      => $this->request->getPost('transfer_del') ? $this->request->getPost('transfer_del') : 0,
                'acceptpayment_view'                => $this->request->getPost('acceptpayment_view') ? $this->request->getPost('acceptpayment_view') : 0,
                'fn_setting_add_edit'               => $this->request->getPost('fn_setting_add_edit') ? $this->request->getPost('fn_setting_add_edit') : 0,
                'account_book_view'                 => $this->request->getPost('account_book_view') ? $this->request->getPost('account_book_view') : 0,
                'account_book_add_edit'             => $this->request->getPost('account_book_add_edit') ? $this->request->getPost('account_book_add_edit') : 0,
                'account_book_del'                  => $this->request->getPost('account_book_del') ? $this->request->getPost('account_book_del') : 0,
                'cost_estimate_view'                => $this->request->getPost('cost_estimate_view') ? $this->request->getPost('cost_estimate_view') : 0,
                'cost_estimate_add_edit'            => $this->request->getPost('cost_estimate_add_edit') ? $this->request->getPost('cost_estimate_add_edit') : 0,
                'cost_estimate_del'                 => $this->request->getPost('cost_estimate_del') ? $this->request->getPost('cost_estimate_del') : 0,
                'budget_view'                       => $this->request->getPost('budget_view') ? $this->request->getPost('budget_view') : 0,
                'budget_add_edit'                   => $this->request->getPost('budget_add_edit') ? $this->request->getPost('budget_add_edit') : 0,
                'budget_approve'                    => $this->request->getPost('budget_approve') ? $this->request->getPost('budget_approve') : 0,
                'budget_del'                        => $this->request->getPost('budget_del') ? $this->request->getPost('budget_del') : 0,
                'money_source_view'                 => $this->request->getPost('money_source_view') ? $this->request->getPost('money_source_view') : 0,
                'money_source_add_edit'             => $this->request->getPost('money_source_add_edit') ? $this->request->getPost('money_source_add_edit') : 0,
                'generaljournal_view'               => $this->request->getPost('generaljournal_view') ? $this->request->getPost('generaljournal_view') : 0,
                'generaljournal_add_edit'           => $this->request->getPost('generaljournal_add_edit') ? $this->request->getPost('generaljournal_add_edit') : 0,
                'generaljournal_del'                => $this->request->getPost('generaljournal_del') ? $this->request->getPost('generaljournal_del') : 0,
                'payjournal_view'                   => $this->request->getPost('payjournal_view') ? $this->request->getPost('payjournal_view') : 0,
                'payjournal_add_edit'               => $this->request->getPost('payjournal_add_edit') ? $this->request->getPost('payjournal_add_edit') : 0,
                'payjournal_del'                    => $this->request->getPost('payjournal_del') ? $this->request->getPost('payjournal_del') : 0,
                'receiptjournal_view'               => $this->request->getPost('receiptjournal_view') ? $this->request->getPost('receiptjournal_view') : 0,
                'receiptjournal_add_edit'           => $this->request->getPost('receiptjournal_add_edit') ? $this->request->getPost('receiptjournal_add_edit') : 0,
                'receiptjournal_del'                => $this->request->getPost('receiptjournal_del') ? $this->request->getPost('receiptjournal_del') : 0,
                'salesjournal_view'                 => $this->request->getPost('salesjournal_view') ? $this->request->getPost('salesjournal_view') : 0,
                'salesjournal_add_edit'             => $this->request->getPost('salesjournal_add_edit') ? $this->request->getPost('salesjournal_add_edit') : 0,
                'salesjournal_del'                  => $this->request->getPost('salesjournal_del') ? $this->request->getPost('salesjournal_del') : 0,
                'purchasejournal_view'              => $this->request->getPost('purchasejournal_view') ? $this->request->getPost('purchasejournal_view') : 0,
                'purchasejournal_add_edit'          => $this->request->getPost('purchasejournal_add_edit') ? $this->request->getPost('purchasejournal_add_edit') : 0,
                'purchasejournal_del'               => $this->request->getPost('purchasejournal_del') ? $this->request->getPost('purchasejournal_del') : 0,
                'creditor_view'                     => $this->request->getPost('creditor_view') ? $this->request->getPost('creditor_view') : 0,
                'creditor_add_edit'                 => $this->request->getPost('creditor_add_edit') ? $this->request->getPost('creditor_add_edit') : 0,
                'creditor_del'                      => $this->request->getPost('creditor_del') ? $this->request->getPost('creditor_del') : 0,
                'report_budget_disbursement_view'   => $this->request->getPost('report_budget_disbursement_view') ? $this->request->getPost('report_budget_disbursement_view') : 0,
                'report_cost_estimate_view'         => $this->request->getPost('report_cost_estimate_view') ? $this->request->getPost('report_cost_estimate_view') : 0,
                'sp_index_view'                     => $this->request->getPost('sp_index_view') ? $this->request->getPost('sp_index_view') : 0,
                'sp_index_add_edit'                 => $this->request->getPost('sp_index_add_edit') ? $this->request->getPost('sp_index_add_edit') : 0,
                'sp_index_del'                      => $this->request->getPost('sp_index_del') ? $this->request->getPost('sp_index_del') : 0,
                'product_view'                      => $this->request->getPost('product_view') ? $this->request->getPost('product_view') : 0,
                'product_add_edit'                  => $this->request->getPost('product_add_edit') ? $this->request->getPost('product_add_edit') : 0,
                'product_del'                       => $this->request->getPost('product_del') ? $this->request->getPost('product_del') : 0,
                'supplies_view'                     => $this->request->getPost('supplies_view') ? $this->request->getPost('supplies_view') : 0,
                'supplies_add_edit'                 => $this->request->getPost('supplies_add_edit') ? $this->request->getPost('supplies_add_edit') : 0,
                'supplies_del'                      => $this->request->getPost('supplies_del') ? $this->request->getPost('supplies_del') : 0,
                'print_barcodes_view'               => $this->request->getPost('print_barcodes_view') ? $this->request->getPost('print_barcodes_view') : 0,
                'receive_supplies_view'             => $this->request->getPost('receive_supplies_view') ? $this->request->getPost('receive_supplies_view') : 0,
                'receive_supplies_add_edit'         => $this->request->getPost('receive_supplies_add_edit') ? $this->request->getPost('receive_supplies_add_edit') : 0,
                'receive_supplies_del'              => $this->request->getPost('receive_supplies_del') ? $this->request->getPost('receive_supplies_del') : 0,
                'check_stock_view'                  => $this->request->getPost('check_stock_view') ? $this->request->getPost('check_stock_view') : 0,
                'check_stock_add_edit'              => $this->request->getPost('check_stock_add_edit') ? $this->request->getPost('check_stock_add_edit') : 0,
                'check_stock_del'                   => $this->request->getPost('check_stock_del') ? $this->request->getPost('check_stock_del') : 0,
                'borrow_view'                       => $this->request->getPost('borrow_view') ? $this->request->getPost('borrow_view') : 0,
                'borrow_add_edit'                   => $this->request->getPost('borrow_add_edit') ? $this->request->getPost('borrow_add_edit') : 0,
                'borrow_del'                        => $this->request->getPost('borrow_del') ? $this->request->getPost('borrow_del') : 0,
                'asset_view'                        => $this->request->getPost('asset_view') ? $this->request->getPost('asset_view') : 0,
                'asset_add_edit'                    => $this->request->getPost('asset_add_edit') ? $this->request->getPost('asset_add_edit') : 0,
                'asset_del'                         => $this->request->getPost('asset_del') ? $this->request->getPost('asset_del') : 0,
                'depreciation_view'                 => $this->request->getPost('depreciation_view') ? $this->request->getPost('depreciation_view') : 0,
                'depreciation_add_edit'             => $this->request->getPost('depreciation_add_edit') ? $this->request->getPost('depreciation_add_edit') : 0,
                'depreciation_del'                  => $this->request->getPost('depreciation_del') ? $this->request->getPost('depreciation_del') : 0,
                'requisition_view'                  => $this->request->getPost('requisition_view') ? $this->request->getPost('requisition_view') : 0,
                'requisition_add_edit'              => $this->request->getPost('requisition_add_edit') ? $this->request->getPost('requisition_add_edit') : 0,
                'requisition_del'                   => $this->request->getPost('requisition_del') ? $this->request->getPost('requisition_del') : 0,
                'registration_responsible_view'     => $this->request->getPost('registration_responsible_view') ? $this->request->getPost('registration_responsible_view') : 0,
                'registration_bring_forward_view'   => $this->request->getPost('registration_bring_forward_view') ? $this->request->getPost('registration_bring_forward_view') : 0,
                'registration_depreciation_view'    => $this->request->getPost('registration_depreciation_view') ? $this->request->getPost('registration_depreciation_view') : 0,
                'registration_transfer_repair_view' => $this->request->getPost('registration_transfer_repair_view') ? $this->request->getPost('registration_transfer_repair_view') : 0,
                'depreciations_view'                => $this->request->getPost('depreciations_view') ? $this->request->getPost('depreciations_view') : 0,
                'depreciations_add_edit'            => $this->request->getPost('depreciations_add_edit') ? $this->request->getPost('depreciations_add_edit') : 0,
                'depreciations_del'                 => $this->request->getPost('depreciations_del') ? $this->request->getPost('depreciations_del') : 0,
                'form_purchase_view'                => $this->request->getPost('form_purchase_view') ? $this->request->getPost('form_purchase_view') : 0,
                'form_purchase_add_edit'            => $this->request->getPost('form_purchase_add_edit') ? $this->request->getPost('form_purchase_add_edit') : 0,
                'form_purchase_del'                 => $this->request->getPost('form_purchase_del') ? $this->request->getPost('form_purchase_del') : 0,
                'buy_supplies_view'                 => $this->request->getPost('buy_supplies_view') ? $this->request->getPost('buy_supplies_view') : 0,
                'buy_supplies_add_edit'             => $this->request->getPost('buy_supplies_add_edit') ? $this->request->getPost('buy_supplies_add_edit') : 0,
                'buy_supplies_del'                  => $this->request->getPost('buy_supplies_del') ? $this->request->getPost('buy_supplies_del') : 0,
                'report_form_purchase_view'         => $this->request->getPost('report_form_purchase_view') ? $this->request->getPost('report_form_purchase_view') : 0,
                'report_form_purchase_add_edit'     => $this->request->getPost('report_form_purchase_add_edit') ? $this->request->getPost('report_form_purchase_add_edit') : 0,
                'report_form_purchase_del'          => $this->request->getPost('report_form_purchase_del') ? $this->request->getPost('report_form_purchase_del') : 0,
                'hire_view'                         => $this->request->getPost('hire_view') ? $this->request->getPost('hire_view') : 0,
                'hire_add_edit'                     => $this->request->getPost('hire_add_edit') ? $this->request->getPost('hire_add_edit') : 0,
                'hire_del'                          => $this->request->getPost('hire_del') ? $this->request->getPost('hire_del') : 0,
                'supply_view'                       => $this->request->getPost('supply_view') ? $this->request->getPost('supply_view') : 0,
                'supply_add_edit'                   => $this->request->getPost('supply_add_edit') ? $this->request->getPost('supply_add_edit') : 0,
                'supply_del'                        => $this->request->getPost('supply_del') ? $this->request->getPost('supply_del') : 0,
                'repair_view'                       => $this->request->getPost('repair_view') ? $this->request->getPost('repair_view') : 0,
                'repair_add_edit'                   => $this->request->getPost('repair_add_edit') ? $this->request->getPost('repair_add_edit') : 0,
                'repair_del'                        => $this->request->getPost('repair_del') ? $this->request->getPost('repair_del') : 0,
                'lease_view'                        => $this->request->getPost('lease_view') ? $this->request->getPost('lease_view') : 0,
                'lease_add_edit'                    => $this->request->getPost('lease_add_edit') ? $this->request->getPost('lease_add_edit') : 0,
                'lease_del'                         => $this->request->getPost('lease_del') ? $this->request->getPost('lease_del') : 0,
                'reveal_view'                       => $this->request->getPost('reveal_view') ? $this->request->getPost('reveal_view') : 0,
                'reveal_add_edit'                   => $this->request->getPost('reveal_add_edit') ? $this->request->getPost('reveal_add_edit') : 0,
                'reveal_del'                        => $this->request->getPost('reveal_del') ? $this->request->getPost('reveal_del') : 0,
                'report_repair_view'                => $this->request->getPost('report_repair_view') ? $this->request->getPost('report_repair_view') : 0,
                'report_repair_add_edit'            => $this->request->getPost('report_repair_add_edit') ? $this->request->getPost('report_repair_add_edit') : 0,
                'report_repair_del'                 => $this->request->getPost('report_repair_del') ? $this->request->getPost('report_repair_del') : 0,
                'report_lease_view'                 => $this->request->getPost('report_lease_view') ? $this->request->getPost('report_lease_view') : 0,
                'report_lease_add_edit'             => $this->request->getPost('report_lease_add_edit') ? $this->request->getPost('report_lease_add_edit') : 0,
                'report_supply_del'                 => $this->request->getPost('report_supply_del') ? $this->request->getPost('report_supply_del') : 0,
                'report_hire_view'                  => $this->request->getPost('report_hire_view') ? $this->request->getPost('report_hire_view') : 0,
                'report_hire_add_edit'              => $this->request->getPost('report_hire_add_edit') ? $this->request->getPost('report_hire_add_edit') : 0,
                'report_hire_del'                   => $this->request->getPost('report_hire_del') ? $this->request->getPost('report_hire_del') : 0,
                'sp_setting'                        => $this->request->getPost('sp_setting') ? $this->request->getPost('sp_setting') : 0,
                'tax_rate_view'                     => $this->request->getPost('tax_rate_view') ? $this->request->getPost('tax_rate_view') : 0,
                'tax_rate_add_edit'                 => $this->request->getPost('tax_rate_add_edit') ? $this->request->getPost('tax_rate_add_edit') : 0,
                'tax_rate_del'                      => $this->request->getPost('tax_rate_del') ? $this->request->getPost('tax_rate_del') : 0,
                'unit_view'                         => $this->request->getPost('unit_view') ? $this->request->getPost('unit_view') : 0,
                'unit_add_edit'                     => $this->request->getPost('unit_add_edit') ? $this->request->getPost('unit_add_edit') : 0,
                'unit_del'                          => $this->request->getPost('unit_del') ? $this->request->getPost('unit_del') : 0,
                'category_view'                     => $this->request->getPost('category_view') ? $this->request->getPost('category_view') : 0,
                'category_add_edit'                 => $this->request->getPost('category_add_edit') ? $this->request->getPost('category_add_edit') : 0,
                'category_del'                      => $this->request->getPost('category_del') ? $this->request->getPost('category_del') : 0,
                'type_view'                         => $this->request->getPost('type_view') ? $this->request->getPost('type_view') : 0,
                'type_add_edit'                     => $this->request->getPost('type_add_edit') ? $this->request->getPost('type_add_edit') : 0,
                'type_del'                          => $this->request->getPost('type_del') ? $this->request->getPost('type_del') : 0,
                'warehouse_view'                    => $this->request->getPost('warehouse_view') ? $this->request->getPost('warehouse_view') : 0,
                'warehouse_add_edit'                => $this->request->getPost('warehouse_add_edit') ? $this->request->getPost('warehouse_add_edit') : 0,
                'warehouse_del'                     => $this->request->getPost('warehouse_del') ? $this->request->getPost('warehouse_del') : 0,
            ];
            $this->supplie_model->addPermissionsGroup($add);
            $this->supplie_model->addLog(1);
            // var_dump($add);
            return redirect()->to('/permissions');
        } else {
            $data['title'] = 'เพิ่มกลุ่มกำหนดสิทธิ์';
            $data['pages'] = [['link' => base_url('/permissions'), 'title' => 'กำหนดสิทธิ์'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('add_group');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_group($id = null)
    {
        if ($id == null)
            return redirect()->to('/permissions');

        if ($this->request->getPost('save') != null) {
            $add = [
                'group_name'                        => $this->request->getPost('group_name'),
                'statement_view'                    => $this->request->getPost('statement_view') ? $this->request->getPost('statement_view') : 0,
                'debtor_view'                       => $this->request->getPost('debtor_view') ? $this->request->getPost('debtor_view') : 0,
                'debtor_add_edit'                   => $this->request->getPost('debtor_add_edit') ? $this->request->getPost('debtor_add_edit') : 0,
                'debtor_del'                        => $this->request->getPost('debtor_del') ? $this->request->getPost('debtor_del') : 0,
                'subscription_fee_view'             => $this->request->getPost('subscription_fee_view') ? $this->request->getPost('subscription_fee_view') : 0,
                'subscription_fee_add_edit'         => $this->request->getPost('subscription_fee_add_edit') ? $this->request->getPost('subscription_fee_add_edit') : 0,
                'subscription_fee_del'              => $this->request->getPost('subscription_fee_del') ? $this->request->getPost('subscription_fee_del') : 0,
                'datepay_view'                      => $this->request->getPost('datepay_view') ? $this->request->getPost('datepay_view') : 0,
                'datepay_add_edit'                  => $this->request->getPost('datepay_add_edit') ? $this->request->getPost('datepay_add_edit') : 0,
                'datepay_del'                       => $this->request->getPost('datepay_del') ? $this->request->getPost('datepay_del') : 0,
                'billing_view'                      => $this->request->getPost('billing_view') ? $this->request->getPost('billing_view') : 0,
                'billing_add_edit'                  => $this->request->getPost('billing_add_edit') ? $this->request->getPost('billing_add_edit') : 0,
                'billing_del'                       => $this->request->getPost('billing_del') ? $this->request->getPost('billing_del') : 0,
                'import_billing_view'               => $this->request->getPost('import_billing_view') ? $this->request->getPost('import_billing_view') : 0,
                'import_billing_add_edit'           => $this->request->getPost('import_billing_add_edit') ? $this->request->getPost('import_billing_add_edit') : 0,
                'receiving_money_view'              => $this->request->getPost('receiving_money_view') ? $this->request->getPost('receiving_money_view') : 0,
                'receiving_money_add_edit'          => $this->request->getPost('receiving_money_add_edit') ? $this->request->getPost('receiving_money_add_edit') : 0,
                'receiving_money_del'               => $this->request->getPost('receiving_money_del') ? $this->request->getPost('receiving_money_del') : 0,
                'check_view'                        => $this->request->getPost('check_view') ? $this->request->getPost('check_view') : 0,
                'check_add_edit'                    => $this->request->getPost('check_add_edit') ? $this->request->getPost('check_add_edit') : 0,
                'check_del'                         => $this->request->getPost('check_del') ? $this->request->getPost('check_del') : 0,
                'acceptpayment_complete_view'       => $this->request->getPost('acceptpayment_complete_view') ? $this->request->getPost('acceptpayment_complete_view') : 0,
                'deposit_view'                      => $this->request->getPost('deposit_view') ? $this->request->getPost('deposit_view') : 0,
                'deposit_add_edit'                  => $this->request->getPost('deposit_add_edit') ? $this->request->getPost('deposit_add_edit') : 0,
                'deposit_del'                       => $this->request->getPost('deposit_del') ? $this->request->getPost('deposit_del') : 0,
                'overdue_view'                      => $this->request->getPost('overdue_view') ? $this->request->getPost('overdue_view') : 0,
                'overdue_add_edit'                  => $this->request->getPost('overdue_add_edit') ? $this->request->getPost('overdue_add_edit') : 0,
                'overdue_del'                       => $this->request->getPost('overdue_del') ? $this->request->getPost('overdue_del') : 0,
                'payoffdebt_view'                   => $this->request->getPost('payoffdebt_view') ? $this->request->getPost('payoffdebt_view') : 0,
                'payoffdebt_add_edit'               => $this->request->getPost('payoffdebt_add_edit') ? $this->request->getPost('payoffdebt_add_edit') : 0,
                'payoffdebt_del'                    => $this->request->getPost('payoffdebt_del') ? $this->request->getPost('payoffdebt_del') : 0,
                'print_check_pay_view'              => $this->request->getPost('print_check_pay_view') ? $this->request->getPost('print_check_pay_view') : 0,
                'print_check_pay_add_edit'          => $this->request->getPost('print_check_pay_add_edit') ? $this->request->getPost('print_check_pay_add_edit') : 0,
                'print_check_pay_del'               => $this->request->getPost('print_check_pay_del') ? $this->request->getPost('print_check_pay_del') : 0,
                'checkpay_view'                     => $this->request->getPost('checkpay_view') ? $this->request->getPost('checkpay_view') : 0,
                'checkpay_add_edit'                 => $this->request->getPost('checkpay_add_edit') ? $this->request->getPost('checkpay_add_edit') : 0,
                'checkpay_del'                      => $this->request->getPost('checkpay_del') ? $this->request->getPost('checkpay_del') : 0,
                'pettycash_view'                    => $this->request->getPost('pettycash_view') ? $this->request->getPost('pettycash_view') : 0,
                'pettycash_add_edit'                => $this->request->getPost('pettycash_add_edit') ? $this->request->getPost('pettycash_add_edit') : 0,
                'pettycash_del'                     => $this->request->getPost('pettycash_del') ? $this->request->getPost('pettycash_del') : 0,
                'withdraw_view'                     => $this->request->getPost('withdraw_view') ? $this->request->getPost('withdraw_view') : 0,
                'withdraw_add_edit'                 => $this->request->getPost('withdraw_add_edit') ? $this->request->getPost('withdraw_add_edit') : 0,
                'withdraw_del'                      => $this->request->getPost('withdraw_del') ? $this->request->getPost('withdraw_del') : 0,
                'transfer_view'                     => $this->request->getPost('transfer_view') ? $this->request->getPost('transfer_view') : 0,
                'transfer_add_edit'                 => $this->request->getPost('transfer_add_edit') ? $this->request->getPost('transfer_add_edit') : 0,
                'transfer_del'                      => $this->request->getPost('transfer_del') ? $this->request->getPost('transfer_del') : 0,
                'acceptpayment_view'                => $this->request->getPost('acceptpayment_view') ? $this->request->getPost('acceptpayment_view') : 0,
                'fn_setting_add_edit'               => $this->request->getPost('fn_setting_add_edit') ? $this->request->getPost('fn_setting_add_edit') : 0,
                'account_book_view'                 => $this->request->getPost('account_book_view') ? $this->request->getPost('account_book_view') : 0,
                'account_book_add_edit'             => $this->request->getPost('account_book_add_edit') ? $this->request->getPost('account_book_add_edit') : 0,
                'account_book_del'                  => $this->request->getPost('account_book_del') ? $this->request->getPost('account_book_del') : 0,
                'cost_estimate_view'                => $this->request->getPost('cost_estimate_view') ? $this->request->getPost('cost_estimate_view') : 0,
                'cost_estimate_add_edit'            => $this->request->getPost('cost_estimate_add_edit') ? $this->request->getPost('cost_estimate_add_edit') : 0,
                'cost_estimate_del'                 => $this->request->getPost('cost_estimate_del') ? $this->request->getPost('cost_estimate_del') : 0,
                'budget_view'                       => $this->request->getPost('budget_view') ? $this->request->getPost('budget_view') : 0,
                'budget_add_edit'                   => $this->request->getPost('budget_add_edit') ? $this->request->getPost('budget_add_edit') : 0,
                'budget_approve'                    => $this->request->getPost('budget_approve') ? $this->request->getPost('budget_approve') : 0,
                'budget_del'                        => $this->request->getPost('budget_del') ? $this->request->getPost('budget_del') : 0,
                'money_source_view'                 => $this->request->getPost('money_source_view') ? $this->request->getPost('money_source_view') : 0,
                'money_source_add_edit'             => $this->request->getPost('money_source_add_edit') ? $this->request->getPost('money_source_add_edit') : 0,
                'generaljournal_view'               => $this->request->getPost('generaljournal_view') ? $this->request->getPost('generaljournal_view') : 0,
                'generaljournal_add_edit'           => $this->request->getPost('generaljournal_add_edit') ? $this->request->getPost('generaljournal_add_edit') : 0,
                'generaljournal_del'                => $this->request->getPost('generaljournal_del') ? $this->request->getPost('generaljournal_del') : 0,
                'payjournal_view'                   => $this->request->getPost('payjournal_view') ? $this->request->getPost('payjournal_view') : 0,
                'payjournal_add_edit'               => $this->request->getPost('payjournal_add_edit') ? $this->request->getPost('payjournal_add_edit') : 0,
                'payjournal_del'                    => $this->request->getPost('payjournal_del') ? $this->request->getPost('payjournal_del') : 0,
                'receiptjournal_view'               => $this->request->getPost('receiptjournal_view') ? $this->request->getPost('receiptjournal_view') : 0,
                'receiptjournal_add_edit'           => $this->request->getPost('receiptjournal_add_edit') ? $this->request->getPost('receiptjournal_add_edit') : 0,
                'receiptjournal_del'                => $this->request->getPost('receiptjournal_del') ? $this->request->getPost('receiptjournal_del') : 0,
                'salesjournal_view'                 => $this->request->getPost('salesjournal_view') ? $this->request->getPost('salesjournal_view') : 0,
                'salesjournal_add_edit'             => $this->request->getPost('salesjournal_add_edit') ? $this->request->getPost('salesjournal_add_edit') : 0,
                'salesjournal_del'                  => $this->request->getPost('salesjournal_del') ? $this->request->getPost('salesjournal_del') : 0,
                'purchasejournal_view'              => $this->request->getPost('purchasejournal_view') ? $this->request->getPost('purchasejournal_view') : 0,
                'purchasejournal_add_edit'          => $this->request->getPost('purchasejournal_add_edit') ? $this->request->getPost('purchasejournal_add_edit') : 0,
                'purchasejournal_del'               => $this->request->getPost('purchasejournal_del') ? $this->request->getPost('purchasejournal_del') : 0,
                'creditor_view'                     => $this->request->getPost('creditor_view') ? $this->request->getPost('creditor_view') : 0,
                'creditor_add_edit'                 => $this->request->getPost('creditor_add_edit') ? $this->request->getPost('creditor_add_edit') : 0,
                'creditor_del'                      => $this->request->getPost('creditor_del') ? $this->request->getPost('creditor_del') : 0,
                'report_budget_disbursement_view'   => $this->request->getPost('report_budget_disbursement_view') ? $this->request->getPost('report_budget_disbursement_view') : 0,
                'report_cost_estimate_view'         => $this->request->getPost('report_cost_estimate_view') ? $this->request->getPost('report_cost_estimate_view') : 0,
                'sp_index_view'                     => $this->request->getPost('sp_index_view') ? $this->request->getPost('sp_index_view') : 0,
                'sp_index_add_edit'                 => $this->request->getPost('sp_index_add_edit') ? $this->request->getPost('sp_index_add_edit') : 0,
                'sp_index_del'                      => $this->request->getPost('sp_index_del') ? $this->request->getPost('sp_index_del') : 0,
                'product_view'                      => $this->request->getPost('product_view') ? $this->request->getPost('product_view') : 0,
                'product_add_edit'                  => $this->request->getPost('product_add_edit') ? $this->request->getPost('product_add_edit') : 0,
                'product_del'                       => $this->request->getPost('product_del') ? $this->request->getPost('product_del') : 0,
                'supplies_view'                     => $this->request->getPost('supplies_view') ? $this->request->getPost('supplies_view') : 0,
                'supplies_add_edit'                 => $this->request->getPost('supplies_add_edit') ? $this->request->getPost('supplies_add_edit') : 0,
                'supplies_del'                      => $this->request->getPost('supplies_del') ? $this->request->getPost('supplies_del') : 0,
                'print_barcodes_view'               => $this->request->getPost('print_barcodes_view') ? $this->request->getPost('print_barcodes_view') : 0,
                'receive_supplies_view'             => $this->request->getPost('receive_supplies_view') ? $this->request->getPost('receive_supplies_view') : 0,
                'receive_supplies_add_edit'         => $this->request->getPost('receive_supplies_add_edit') ? $this->request->getPost('receive_supplies_add_edit') : 0,
                'receive_supplies_del'              => $this->request->getPost('receive_supplies_del') ? $this->request->getPost('receive_supplies_del') : 0,
                'check_stock_view'                  => $this->request->getPost('check_stock_view') ? $this->request->getPost('check_stock_view') : 0,
                'check_stock_add_edit'              => $this->request->getPost('check_stock_add_edit') ? $this->request->getPost('check_stock_add_edit') : 0,
                'check_stock_del'                   => $this->request->getPost('check_stock_del') ? $this->request->getPost('check_stock_del') : 0,
                'borrow_view'                       => $this->request->getPost('borrow_view') ? $this->request->getPost('borrow_view') : 0,
                'borrow_add_edit'                   => $this->request->getPost('borrow_add_edit') ? $this->request->getPost('borrow_add_edit') : 0,
                'borrow_del'                        => $this->request->getPost('borrow_del') ? $this->request->getPost('borrow_del') : 0,
                'asset_view'                        => $this->request->getPost('asset_view') ? $this->request->getPost('asset_view') : 0,
                'asset_add_edit'                    => $this->request->getPost('asset_add_edit') ? $this->request->getPost('asset_add_edit') : 0,
                'asset_del'                         => $this->request->getPost('asset_del') ? $this->request->getPost('asset_del') : 0,
                'depreciation_view'                 => $this->request->getPost('depreciation_view') ? $this->request->getPost('depreciation_view') : 0,
                'depreciation_add_edit'             => $this->request->getPost('depreciation_add_edit') ? $this->request->getPost('depreciation_add_edit') : 0,
                'depreciation_del'                  => $this->request->getPost('depreciation_del') ? $this->request->getPost('depreciation_del') : 0,
                'requisition_view'                  => $this->request->getPost('requisition_view') ? $this->request->getPost('requisition_view') : 0,
                'requisition_add_edit'              => $this->request->getPost('requisition_add_edit') ? $this->request->getPost('requisition_add_edit') : 0,
                'requisition_del'                   => $this->request->getPost('requisition_del') ? $this->request->getPost('requisition_del') : 0,
                'registration_responsible_view'     => $this->request->getPost('registration_responsible_view') ? $this->request->getPost('registration_responsible_view') : 0,
                'registration_bring_forward_view'   => $this->request->getPost('registration_bring_forward_view') ? $this->request->getPost('registration_bring_forward_view') : 0,
                'registration_depreciation_view'    => $this->request->getPost('registration_depreciation_view') ? $this->request->getPost('registration_depreciation_view') : 0,
                'registration_transfer_repair_view' => $this->request->getPost('registration_transfer_repair_view') ? $this->request->getPost('registration_transfer_repair_view') : 0,
                'depreciations_view'                => $this->request->getPost('depreciations_view') ? $this->request->getPost('depreciations_view') : 0,
                'depreciations_add_edit'            => $this->request->getPost('depreciations_add_edit') ? $this->request->getPost('depreciations_add_edit') : 0,
                'depreciations_del'                 => $this->request->getPost('depreciations_del') ? $this->request->getPost('depreciations_del') : 0,
                'form_purchase_view'                => $this->request->getPost('form_purchase_view') ? $this->request->getPost('form_purchase_view') : 0,
                'form_purchase_add_edit'            => $this->request->getPost('form_purchase_add_edit') ? $this->request->getPost('form_purchase_add_edit') : 0,
                'form_purchase_del'                 => $this->request->getPost('form_purchase_del') ? $this->request->getPost('form_purchase_del') : 0,
                'buy_supplies_view'                 => $this->request->getPost('buy_supplies_view') ? $this->request->getPost('buy_supplies_view') : 0,
                'buy_supplies_add_edit'             => $this->request->getPost('buy_supplies_add_edit') ? $this->request->getPost('buy_supplies_add_edit') : 0,
                'buy_supplies_del'                  => $this->request->getPost('buy_supplies_del') ? $this->request->getPost('buy_supplies_del') : 0,
                'report_form_purchase_view'         => $this->request->getPost('report_form_purchase_view') ? $this->request->getPost('report_form_purchase_view') : 0,
                'report_form_purchase_add_edit'     => $this->request->getPost('report_form_purchase_add_edit') ? $this->request->getPost('report_form_purchase_add_edit') : 0,
                'report_form_purchase_del'          => $this->request->getPost('report_form_purchase_del') ? $this->request->getPost('report_form_purchase_del') : 0,
                'hire_view'                         => $this->request->getPost('hire_view') ? $this->request->getPost('hire_view') : 0,
                'hire_add_edit'                     => $this->request->getPost('hire_add_edit') ? $this->request->getPost('hire_add_edit') : 0,
                'hire_del'                          => $this->request->getPost('hire_del') ? $this->request->getPost('hire_del') : 0,
                'supply_view'                       => $this->request->getPost('supply_view') ? $this->request->getPost('supply_view') : 0,
                'supply_add_edit'                   => $this->request->getPost('supply_add_edit') ? $this->request->getPost('supply_add_edit') : 0,
                'supply_del'                        => $this->request->getPost('supply_del') ? $this->request->getPost('supply_del') : 0,
                'repair_view'                       => $this->request->getPost('repair_view') ? $this->request->getPost('repair_view') : 0,
                'repair_add_edit'                   => $this->request->getPost('repair_add_edit') ? $this->request->getPost('repair_add_edit') : 0,
                'repair_del'                        => $this->request->getPost('repair_del') ? $this->request->getPost('repair_del') : 0,
                'lease_view'                        => $this->request->getPost('lease_view') ? $this->request->getPost('lease_view') : 0,
                'lease_add_edit'                    => $this->request->getPost('lease_add_edit') ? $this->request->getPost('lease_add_edit') : 0,
                'lease_del'                         => $this->request->getPost('lease_del') ? $this->request->getPost('lease_del') : 0,
                'reveal_view'                       => $this->request->getPost('reveal_view') ? $this->request->getPost('reveal_view') : 0,
                'reveal_add_edit'                   => $this->request->getPost('reveal_add_edit') ? $this->request->getPost('reveal_add_edit') : 0,
                'reveal_del'                        => $this->request->getPost('reveal_del') ? $this->request->getPost('reveal_del') : 0,
                'report_repair_view'                => $this->request->getPost('report_repair_view') ? $this->request->getPost('report_repair_view') : 0,
                'report_repair_add_edit'            => $this->request->getPost('report_repair_add_edit') ? $this->request->getPost('report_repair_add_edit') : 0,
                'report_repair_del'                 => $this->request->getPost('report_repair_del') ? $this->request->getPost('report_repair_del') : 0,
                'report_lease_view'                 => $this->request->getPost('report_lease_view') ? $this->request->getPost('report_lease_view') : 0,
                'report_lease_add_edit'             => $this->request->getPost('report_lease_add_edit') ? $this->request->getPost('report_lease_add_edit') : 0,
                'report_supply_del'                 => $this->request->getPost('report_supply_del') ? $this->request->getPost('report_supply_del') : 0,
                'report_hire_view'                  => $this->request->getPost('report_hire_view') ? $this->request->getPost('report_hire_view') : 0,
                'report_hire_add_edit'              => $this->request->getPost('report_hire_add_edit') ? $this->request->getPost('report_hire_add_edit') : 0,
                'report_hire_del'                   => $this->request->getPost('report_hire_del') ? $this->request->getPost('report_hire_del') : 0,
                'sp_setting'                        => $this->request->getPost('sp_setting') ? $this->request->getPost('sp_setting') : 0,
                'tax_rate_view'                     => $this->request->getPost('tax_rate_view') ? $this->request->getPost('tax_rate_view') : 0,
                'tax_rate_add_edit'                 => $this->request->getPost('tax_rate_add_edit') ? $this->request->getPost('tax_rate_add_edit') : 0,
                'tax_rate_del'                      => $this->request->getPost('tax_rate_del') ? $this->request->getPost('tax_rate_del') : 0,
                'unit_view'                         => $this->request->getPost('unit_view') ? $this->request->getPost('unit_view') : 0,
                'unit_add_edit'                     => $this->request->getPost('unit_add_edit') ? $this->request->getPost('unit_add_edit') : 0,
                'unit_del'                          => $this->request->getPost('unit_del') ? $this->request->getPost('unit_del') : 0,
                'category_view'                     => $this->request->getPost('category_view') ? $this->request->getPost('category_view') : 0,
                'category_add_edit'                 => $this->request->getPost('category_add_edit') ? $this->request->getPost('category_add_edit') : 0,
                'category_del'                      => $this->request->getPost('category_del') ? $this->request->getPost('category_del') : 0,
                'type_view'                         => $this->request->getPost('type_view') ? $this->request->getPost('type_view') : 0,
                'type_add_edit'                     => $this->request->getPost('type_add_edit') ? $this->request->getPost('type_add_edit') : 0,
                'type_del'                          => $this->request->getPost('type_del') ? $this->request->getPost('type_del') : 0,
                'warehouse_view'                    => $this->request->getPost('warehouse_view') ? $this->request->getPost('warehouse_view') : 0,
                'warehouse_add_edit'                => $this->request->getPost('warehouse_add_edit') ? $this->request->getPost('warehouse_add_edit') : 0,
                'warehouse_del'                     => $this->request->getPost('warehouse_del') ? $this->request->getPost('warehouse_del') : 0,
            ];
            $this->supplie_model->editPermissionsGroup($id, $add);
            $this->supplie_model->addLog(1);
            // var_dump($add);
            return redirect()->to('/permissions');
        } else {
            $data['data']   = $this->supplie_model->getPermissionsGroup($id);
            $data['title'] = 'แก้ไขกลุ่มกำหนดสิทธิ์';
            $data['pages'] = [['link' => base_url('/permissions'), 'title' => 'กำหนดสิทธิ์'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('edit_group');
            echo view('footer');
        }
    }

    //--------------------------------------------------------------------
    public function delete_group($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deletePermissionsGroup($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/permissions');
        }
    }
    // -----------------------------------------------------------------
    public function view_user($id = null)
    {
        if ($id == null)
            return redirect()->to('/permissions');
        // $data['data'] 	= $this->noti_model->get_noti();
        $data['title'] = 'รายละเอียดการกำหนดสิทธิ์';
        $data['pages'] = [['link' => base_url('/permissions'), 'title' => 'กำหนดสิทธิ์'], ['link' => '#', 'title' => $data['title']]];

        echo view('header', $data);
        echo view('view_user');
        echo view('footer');
    }

    //--------------------------------------------------------------------
    public function edit_user($id = null)
    {
        if ($id == null)
            return redirect()->to('/permissions');
        // $data['data'] 	= $this->noti_model->get_noti();
        $data['title'] = 'แก้ไขการกำหนดสิทธิ์';
        $data['pages'] = [['link' => base_url('/permissions'), 'title' => 'กำหนดสิทธิ์'], ['link' => '#', 'title' => $data['title']]];

        echo view('header', $data);
        echo view('edit_user');
        echo view('footer');
    }

    //--------------------------------------------------------------------
    public function delete_user($id = null)
    {
        if ($id == null)
            return false;
        else {
            // $this->supplie_model->deleteTaxRateByID($id);
            // $this->supplie_model->addLog(1);
            return redirect()->to('/permissions');
        }
    }
    // -----------------------------------------------------------------
}
