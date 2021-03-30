<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('permissions/edit_group/'.$data[0]['id']) ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="group_name">ชื่อกลุ่ม</label>
                <input type="text" id="group_name" class="form-control" name="group_name" value="<?= $data[0]['group_name'] ? $data[0]['group_name'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <table class="table table-bordered" id="test" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="textleft" width="50%">ชื่อสิทธิ์</th>
                            <th width="12%">ดู</th>
                            <th width="12%">เพิ่ม/แก้ไข</th>
                            <th width="12%">อนุมัติ</th>
                            <th width="12%">ยกเลิก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="textleft">กระทบยอดการเงิน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['statement_view'] == 1 ? print 'checked' : ''; ?> name="statement_view"> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกข้อมูลสมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['debtor_view'] == 1 ? print 'checked' : ''; ?> name="debtor_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['debtor_add_edit'] == 1 ? print 'checked' : ''; ?> name="debtor_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['debtor_del'] == 1 ? print 'checked' : ''; ?> name="debtor_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ค่าสมัครสมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['subscription_fee_view'] == 1 ? print 'checked' : ''; ?> name="subscription_fee_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['subscription_fee_add_edit'] == 1 ? print 'checked' : ''; ?> name="subscription_fee_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['subscription_fee_del'] == 1 ? print 'checked' : ''; ?> name="subscription_fee_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกวันนัดชำระ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['datepay_view'] == 1 ? print 'checked' : ''; ?> name="datepay_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['datepay_add_edit'] == 1 ? print 'checked' : ''; ?> name="datepay_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['datepay_del'] == 1 ? print 'checked' : ''; ?> name="datepay_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการเรียกเก็บเงินสงเคราะห์สมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['billing_view'] == 1 ? print 'checked' : ''; ?> name="billing_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['billing_add_edit'] == 1 ? print 'checked' : ''; ?> name="billing_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['billing_del'] == 1 ? print 'checked' : ''; ?> name="billing_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการรับชำระเงินสงเคราะห์สมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['import_billing_view'] == 1 ? print 'checked' : ''; ?> name="import_billing_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['import_billing_add_edit'] == 1 ? print 'checked' : ''; ?> name="import_billing_add_edit"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการรับเงินสด</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receiving_money_view'] == 1 ? print 'checked' : ''; ?> name="receiving_money_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receiving_money_add_edit'] == 1 ? print 'checked' : ''; ?> name="receiving_money_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receiving_money_del'] == 1 ? print 'checked' : ''; ?> name="receiving_money_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเช็ครับ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['check_view'] == 1 ? print 'checked' : ''; ?> name="check_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['check_add_edit'] == 1 ? print 'checked' : ''; ?> name="check_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['check_del'] == 1 ? print 'checked' : ''; ?> name="check_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">พิมพ์ใบเสร็จรับเงิน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['acceptpayment_complete_view'] == 1 ? print 'checked' : ''; ?> name="acceptpayment_complete_view"> </td>
                            <td></td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ฝากเงินสด</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['deposit_view'] == 1 ? print 'checked' : ''; ?> name="deposit_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['deposit_add_edit'] == 1 ? print 'checked' : ''; ?> name="deposit_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['deposit_del'] == 1 ? print 'checked' : ''; ?> name="deposit_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเงินสงเคราะห์ค้างจ่ายทายาท</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['overdue_view'] == 1 ? print 'checked' : ''; ?> name="overdue_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['overdue_add_edit'] == 1 ? print 'checked' : ''; ?> name="overdue_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['overdue_del'] == 1 ? print 'checked' : ''; ?> name="overdue_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกจ่ายเงินสงเคราะห์ทายาท</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['payoffdebt_view'] == 1 ? print 'checked' : ''; ?> name="payoffdebt_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['payoffdebt_add_edit'] == 1 ? print 'checked' : ''; ?> name="payoffdebt_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['payoffdebt_del'] == 1 ? print 'checked' : ''; ?> name="payoffdebt_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">พิมพ์เช็คจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['print_check_pay_view'] == 1 ? print 'checked' : ''; ?> name="print_check_pay_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['print_check_pay_add_edit'] == 1 ? print 'checked' : ''; ?> name="print_check_pay_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['print_check_pay_del'] == 1 ? print 'checked' : ''; ?> name="print_check_pay_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเช็คจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['checkpay_view'] == 1 ? print 'checked' : ''; ?> name="checkpay_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['checkpay_add_edit'] == 1 ? print 'checked' : ''; ?> name="checkpay_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['checkpay_del'] == 1 ? print 'checked' : ''; ?> name="checkpay_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเบิกเงินสดย่อย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['pettycash_view'] == 1 ? print 'checked' : ''; ?> name="pettycash_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['pettycash_add_edit'] == 1 ? print 'checked' : ''; ?> name="pettycash_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['pettycash_del'] == 1 ? print 'checked' : ''; ?> name="pettycash_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ถอนเงินสด</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['withdraw_view'] == 1 ? print 'checked' : ''; ?> name="withdraw_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['withdraw_add_edit'] == 1 ? print 'checked' : ''; ?> name="withdraw_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['withdraw_del'] == 1 ? print 'checked' : ''; ?> name="withdraw_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">โอนเงินระหว่างบัญชี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['transfer_view'] == 1 ? print 'checked' : ''; ?> name="transfer_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['transfer_add_edit'] == 1 ? print 'checked' : ''; ?> name="transfer_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['transfer_del'] == 1 ? print 'checked' : ''; ?> name="transfer_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานการรับชำระเงิน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['acceptpayment_view'] == 1 ? print 'checked' : ''; ?> name="acceptpayment_view"> </td>
                            <td> </td>
                            <td></td>
                            <td> </td>
                        </tr>
                        <!-- <tr>
                            <td class="textleft">รายงานทะเบียนเช็คจ่ายตามรอบระยะการจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานการค้างจ่ายของสมาชิกเป็นรายบุคคล</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานสรุปยอดการจ่ายเงินสงเคราะห์แบบรายเดือนและรายปี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานเรื่องค้างจ่ายเป็นรายบุคคล</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0][''] == 1 ? print 'checked' : ''; ?> name=""> </td>
                        </tr> -->
                        <tr>
                            <td class="textleft">ตั้งค่าการเงิน</td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['fn_setting_add_edit'] == 1 ? print 'checked' : ''; ?> name="fn_setting_add_edit"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="textleft">ผังบัญชี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['account_book_view'] == 1 ? print 'checked' : ''; ?> name="account_book_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['account_book_add_edit'] == 1 ? print 'checked' : ''; ?> name="account_book_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['account_book_del'] == 1 ? print 'checked' : ''; ?> name="account_book_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ประมาณการค่าใช้จ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['cost_estimate_view'] == 1 ? print 'checked' : ''; ?> name="cost_estimate_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['cost_estimate_add_edit'] == 1 ? print 'checked' : ''; ?> name="cost_estimate_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['cost_estimate_del'] == 1 ? print 'checked' : ''; ?> name="cost_estimate_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">งบประมาณโครงการ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['budget_view'] == 1 ? print 'checked' : ''; ?> name="budget_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['budget_add_edit'] == 1 ? print 'checked' : ''; ?> name="budget_add_edit"> </td>
                            <td><input class="form-check-input" type="checkbox" value="1" <?php $data[0]['budget_approve'] == 1 ? print 'checked' : ''; ?> name="budget_approve"> </td>
                            <td><input class="form-check-input" type="checkbox" value="1" <?php $data[0]['budget_del'] == 1 ? print 'checked' : ''; ?> name="budget_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ประเภทแหล่งเงิน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['money_source_view'] == 1 ? print 'checked' : ''; ?> name="money_source_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['money_source_add_edit'] == 1 ? print 'checked' : ''; ?> name="money_source_add_edit"> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันทั่วไป</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['generaljournal_view'] == 1 ? print 'checked' : ''; ?> name="generaljournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['generaljournal_add_edit'] == 1 ? print 'checked' : ''; ?> name="generaljournal_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['generaljournal_del'] == 1 ? print 'checked' : ''; ?> name="generaljournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['payjournal_view'] == 1 ? print 'checked' : ''; ?> name="payjournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['payjournal_add_edit'] == 1 ? print 'checked' : ''; ?> name="payjournal_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['payjournal_del'] == 1 ? print 'checked' : ''; ?> name="payjournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันรับ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receiptjournal_view'] == 1 ? print 'checked' : ''; ?> name="receiptjournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receiptjournal_add_edit'] == 1 ? print 'checked' : ''; ?> name="receiptjournal_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receiptjournal_del'] == 1 ? print 'checked' : ''; ?> name="receiptjournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันขาย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['salesjournal_view'] == 1 ? print 'checked' : ''; ?> name="salesjournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['salesjournal_add_edit'] == 1 ? print 'checked' : ''; ?> name="salesjournal_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['salesjournal_del'] == 1 ? print 'checked' : ''; ?> name="salesjournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันซื้อ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['purchasejournal_view'] == 1 ? print 'checked' : ''; ?> name="purchasejournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['purchasejournal_add_edit'] == 1 ? print 'checked' : ''; ?> name="purchasejournal_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['purchasejournal_del'] == 1 ? print 'checked' : ''; ?> name="purchasejournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกข้อมูลเจ้าหนี้</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['creditor_view'] == 1 ? print 'checked' : ''; ?> name="creditor_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['creditor_add_edit'] == 1 ? print 'checked' : ''; ?> name="creditor_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['creditor_del'] == 1 ? print 'checked' : ''; ?> name="creditor_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานการเบิกจ่ายงบประมาณ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_budget_disbursement_view'] == 1 ? print 'checked' : ''; ?> name="report_budget_disbursement_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานประมาณการค่าใช้จ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_cost_estimate_view'] == 1 ? print 'checked' : ''; ?> name="report_cost_estimate_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ภาพรวมงานพัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['sp_index_view'] == 1 ? print 'checked' : ''; ?> name="sp_index_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['sp_index_add_edit'] == 1 ? print 'checked' : ''; ?> name="sp_index_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['sp_index_del'] == 1 ? print 'checked' : ''; ?> name="sp_index_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">จัดการคลังครุภัณฑ์/วัสดุภัณฑ์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['product_view'] == 1 ? print 'checked' : ''; ?> name="product_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['product_add_edit'] == 1 ? print 'checked' : ''; ?> name="product_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['product_del'] == 1 ? print 'checked' : ''; ?> name="product_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ออกเลขพัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['supplies_view'] == 1 ? print 'checked' : ''; ?> name="supplies_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['supplies_add_edit'] == 1 ? print 'checked' : ''; ?> name="supplies_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['supplies_del'] == 1 ? print 'checked' : ''; ?> name="supplies_del"></td>
                        </tr>
                        <tr>
                            <td class="textleft">พิมพ์ Barcode / label</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['print_barcodes_view'] == 1 ? print 'checked' : ''; ?> name="print_barcodes_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการรับพัสดุเข้าคลังครุภัณฑ์/วัสดุภัณฑ์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receive_supplies_view'] == 1 ? print 'checked' : ''; ?> name="receive_supplies_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receive_supplies_add_edit'] == 1 ? print 'checked' : ''; ?> name="receive_supplies_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['receive_supplies_del'] == 1 ? print 'checked' : ''; ?> name="receive_supplies_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">นับสต๊อก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['check_stock_view'] == 1 ? print 'checked' : ''; ?> name="check_stock_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['check_stock_add_edit'] == 1 ? print 'checked' : ''; ?> name="check_stock_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['check_stock_del'] == 1 ? print 'checked' : ''; ?> name="check_stock_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ยืม - คืน พัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['borrow_view'] == 1 ? print 'checked' : ''; ?> name="borrow_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['borrow_add_edit'] == 1 ? print 'checked' : ''; ?> name="borrow_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['borrow_del'] == 1 ? print 'checked' : ''; ?> name="borrow_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">คิดค่าเสื่อม บันทึกสินทรัพย์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['asset_view'] == 1 ? print 'checked' : ''; ?> name="asset_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['asset_add_edit'] == 1 ? print 'checked' : ''; ?> name="asset_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['asset_del'] == 1 ? print 'checked' : ''; ?> name="asset_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">คิดค่าเสื่อม บันทึกคิดค่าเสื่อม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['depreciation_view'] == 1 ? print 'checked' : ''; ?> name="depreciation_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['depreciation_add_edit'] == 1 ? print 'checked' : ''; ?> name="depreciation_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['depreciation_del'] == 1 ? print 'checked' : ''; ?> name="depreciation_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ประวัติการเบิกจ่ายพัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['requisition_view'] == 1 ? print 'checked' : ''; ?> name="requisition_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['requisition_add_edit'] == 1 ? print 'checked' : ''; ?> name="requisition_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['requisition_del'] == 1 ? print 'checked' : ''; ?> name="requisition_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์ แยกชื่อผู้รับผิดชอบ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['registration_responsible_view'] == 1 ? print 'checked' : ''; ?> name="registration_responsible_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์ที่แสดงยอดยกมาต้นปี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['registration_bring_forward_view'] == 1 ? print 'checked' : ''; ?> name="registration_bring_forward_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์และค่าเสื่อมราคา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['registration_depreciation_view'] == 1 ? print 'checked' : ''; ?> name="registration_depreciation_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์/โอนย้ายสินทรัพย์/ประวัติการซ่อมแซม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['registration_transfer_repair_view'] == 1 ? print 'checked' : ''; ?> name="registration_transfer_repair_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานคำนวณค่าเสื่อมราคาตามช่วงเวลา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['depreciations_view'] == 1 ? print 'checked' : ''; ?> name="depreciations_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['depreciations_add_edit'] == 1 ? print 'checked' : ''; ?> name="depreciations_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['depreciations_del'] == 1 ? print 'checked' : ''; ?> name="depreciations_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการสั่งซื้อสั่งจ้าง (PO List)</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['form_purchase_view'] == 1 ? print 'checked' : ''; ?> name="form_purchase_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['form_purchase_add_edit'] == 1 ? print 'checked' : ''; ?> name="form_purchase_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['form_purchase_del'] == 1 ? print 'checked' : ''; ?> name="form_purchase_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ใบขอซื้อพัสดุทั้งหมด (PR)</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['buy_supplies_view'] == 1 ? print 'checked' : ''; ?> name="buy_supplies_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['buy_supplies_add_edit'] == 1 ? print 'checked' : ''; ?> name="buy_supplies_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['buy_supplies_del'] == 1 ? print 'checked' : ''; ?> name="buy_supplies_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานขอซื้อขอจ้าง</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_form_purchase_view'] == 1 ? print 'checked' : ''; ?> name="report_form_purchase_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_form_purchase_add_edit'] == 1 ? print 'checked' : ''; ?> name="report_form_purchase_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_form_purchase_del'] == 1 ? print 'checked' : ''; ?> name="report_form_purchase_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">งานจัดจ้าง</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['hire_view'] == 1 ? print 'checked' : ''; ?> name="hire_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['hire_add_edit'] == 1 ? print 'checked' : ''; ?> name="hire_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['hire_del'] == 1 ? print 'checked' : ''; ?> name="hire_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">งานจัดหา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['supply_view'] == 1 ? print 'checked' : ''; ?> name="supply_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['supply_add_edit'] == 1 ? print 'checked' : ''; ?> name="supply_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['supply_del'] == 1 ? print 'checked' : ''; ?> name="supply_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการซ่อม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['repair_view'] == 1 ? print 'checked' : ''; ?> name="repair_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['repair_add_edit'] == 1 ? print 'checked' : ''; ?> name="repair_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['repair_del'] == 1 ? print 'checked' : ''; ?> name="repair_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการเช่า</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['lease_view'] == 1 ? print 'checked' : ''; ?> name="lease_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['lease_add_edit'] == 1 ? print 'checked' : ''; ?> name="lease_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['lease_del'] == 1 ? print 'checked' : ''; ?> name="lease_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการเบิก อนุมัติ งวดงาน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['reveal_view'] == 1 ? print 'checked' : ''; ?> name="reveal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['reveal_add_edit'] == 1 ? print 'checked' : ''; ?> name="reveal_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['reveal_del'] == 1 ? print 'checked' : ''; ?> name="reveal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานซ่อม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_repair_view'] == 1 ? print 'checked' : ''; ?> name="report_repair_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_repair_add_edit'] == 1 ? print 'checked' : ''; ?> name="report_repair_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_repair_del'] == 1 ? print 'checked' : ''; ?> name="report_repair_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานเช่า</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_lease_view'] == 1 ? print 'checked' : ''; ?> name="report_lease_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_lease_add_edit'] == 1 ? print 'checked' : ''; ?> name="report_lease_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_lease_del'] == 1 ? print 'checked' : ''; ?> name="report_lease_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานจัดหา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_supply_view'] == 1 ? print 'checked' : ''; ?> name="report_supply_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_supply_add_edit'] == 1 ? print 'checked' : ''; ?> name="report_supply_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_supply_del'] == 1 ? print 'checked' : ''; ?> name="report_supply_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานจัดจ้าง</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_hire_view'] == 1 ? print 'checked' : ''; ?> name="report_hire_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_hire_add_edit'] == 1 ? print 'checked' : ''; ?> name="report_hire_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['report_hire_del'] == 1 ? print 'checked' : ''; ?> name="report_hire_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ตั้งค่าระบบพัสดุ</td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['sp_setting'] == 1 ? print 'checked' : ''; ?> name="sp_setting"> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดอัตราภาษี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['tax_rate_view'] == 1 ? print 'checked' : ''; ?> name="tax_rate_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['tax_rate_add_edit'] == 1 ? print 'checked' : ''; ?> name="tax_rate_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['tax_rate_del'] == 1 ? print 'checked' : ''; ?> name="tax_rate_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดหน่วยนับ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['unit_view'] == 1 ? print 'checked' : ''; ?> name="unit_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['unit_add_edit'] == 1 ? print 'checked' : ''; ?> name="unit_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['unit_del'] == 1 ? print 'checked' : ''; ?> name="unit_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดหมวดหมู่พัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['category_view'] == 1 ? print 'checked' : ''; ?> name="category_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['category_add_edit'] == 1 ? print 'checked' : ''; ?> name="category_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['category_del'] == 1 ? print 'checked' : ''; ?> name="category_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดประเภท</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['type_view'] == 1 ? print 'checked' : ''; ?> name="type_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['type_add_edit'] == 1 ? print 'checked' : ''; ?> name="type_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['type_del'] == 1 ? print 'checked' : ''; ?> name="type_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['warehouse_view'] == 1 ? print 'checked' : ''; ?> name="warehouse_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['warehouse_add_edit'] == 1 ? print 'checked' : ''; ?> name="warehouse_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" <?php $data[0]['warehouse_del'] == 1 ? print 'checked' : ''; ?> name="warehouse_del"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            // order: [
            //     [1, "asc"]
            // ],
            order: false,
            paging: false

        });
    });
</script>