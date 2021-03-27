<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('permissions/add_group') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="group_name">ชื่อกลุ่ม</label>
                <input type="text" id="group_name" class="form-control" name="group_name" value="<?= $_POST['group_name'] ? $_POST['group_name'] : '' ?>" required />
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
                            <td> <input class="form-check-input" type="checkbox" value="1" name="statement_view"> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกข้อมูลสมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="debtor_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="debtor_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="debtor_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ค่าสมัครสมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="subscription_fee_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="subscription_fee_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="subscription_fee_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกวันนัดชำระ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="datepay_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="datepay_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="datepay_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการเรียกเก็บเงินสงเคราะห์สมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="billing_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="billing_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="billing_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการรับชำระเงินสงเคราะห์สมาชิก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="import_billing_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="import_billing_add_edit"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการรับเงินสด</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receiving_money_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receiving_money_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receiving_money_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเช็ครับ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="check_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="check_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="check_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">พิมพ์ใบเสร็จรับเงิน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="acceptpayment_complete_view"> </td>
                            <td></td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ฝากเงินสด</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="deposit_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="deposit_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="deposit_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเงินสงเคราะห์ค้างจ่ายทายาท</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="overdue_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="overdue_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="overdue_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกจ่ายเงินสงเคราะห์ทายาท</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="payoffdebt_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="payoffdebt_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="payoffdebt_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">พิมพ์เช็คจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="print_check_pay_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="print_check_pay_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="print_check_pay_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเช็คจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="checkpay_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="checkpay_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="checkpay_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกเบิกเงินสดย่อย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="pettycash_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="pettycash_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="pettycash_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ถอนเงินสด</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="withdraw_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="withdraw_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="withdraw_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">โอนเงินระหว่างบัญชี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="transfer_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="transfer_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="transfer_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานการรับชำระเงิน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="acceptpayment_view"> </td>
                            <td> </td>
                            <td></td>
                            <td> </td>
                        </tr>
                        <!-- <tr>
                            <td class="textleft">รายงานทะเบียนเช็คจ่ายตามรอบระยะการจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานการค้างจ่ายของสมาชิกเป็นรายบุคคล</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานสรุปยอดการจ่ายเงินสงเคราะห์แบบรายเดือนและรายปี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานเรื่องค้างจ่ายเป็นรายบุคคล</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name=""> </td>
                        </tr> -->
                        <tr>
                            <td class="textleft">ตั้งค่าการเงิน</td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="fn_setting_add_edit"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="textleft">ผังบัญชี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="account_book_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="account_book_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="account_book_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ประมาณการค่าใช้จ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="cost_estimate_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="cost_estimate_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="cost_estimate_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">งบประมาณโครงการ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="budget_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="budget_add_edit"> </td>
                            <td><input class="form-check-input" type="checkbox" value="1" name="budget_approve"> </td>
                            <td><input class="form-check-input" type="checkbox" value="1" name="budget_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ประเภทแหล่งเงิน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="money_source_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="money_source_add_edit"> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันทั่วไป</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="generaljournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="generaljournal_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="generaljournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันจ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="payjournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="payjournal_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="payjournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันรับ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receiptjournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receiptjournal_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receiptjournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันขาย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="salesjournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="salesjournal_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="salesjournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">สมุดรายวันซื้อ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="purchasejournal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="purchasejournal_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="purchasejournal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">บันทึกข้อมูลเจ้าหนี้</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="creditor_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="creditor_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="creditor_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานการเบิกจ่ายงบประมาณ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_budget_disbursement_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานประมาณการค่าใช้จ่าย</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_cost_estimate_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ภาพรวมงานพัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="sp_index_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="sp_index_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="sp_index_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">จัดการคลังครุภัณฑ์/วัสดุภัณฑ์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="product_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="product_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="product_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ออกเลขพัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="supplies_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="supplies_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="supplies_del"></td>
                        </tr>
                        <tr>
                            <td class="textleft">พิมพ์ Barcode / label</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="print_barcodes_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการรับพัสดุเข้าคลังครุภัณฑ์/วัสดุภัณฑ์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receive_supplies_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receive_supplies_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="receive_supplies_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">นับสต๊อก</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="check_stock_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="check_stock_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="check_stock_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ยืม - คืน พัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="borrow_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="borrow_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="borrow_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">คิดค่าเสื่อม บันทึกสินทรัพย์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="asset_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="asset_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="asset_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">คิดค่าเสื่อม บันทึกคิดค่าเสื่อม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="depreciation_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="depreciation_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="depreciation_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ประวัติการเบิกจ่ายพัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="requisition_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="requisition_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="requisition_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์ แยกชื่อผู้รับผิดชอบ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="registration_responsible_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์ที่แสดงยอดยกมาต้นปี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="registration_bring_forward_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์และค่าเสื่อมราคา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="registration_depreciation_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานทะเบียนสินทรัพย์/โอนย้ายสินทรัพย์/ประวัติการซ่อมแซม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="registration_transfer_repair_view"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานคำนวณค่าเสื่อมราคาตามช่วงเวลา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="depreciations_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="depreciations_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="depreciations_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการสั่งซื้อสั่งจ้าง (PO List)</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="form_purchase_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="form_purchase_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="form_purchase_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ใบขอซื้อพัสดุทั้งหมด (PR)</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="buy_supplies_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="buy_supplies_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="buy_supplies_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานขอซื้อขอจ้าง</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_form_purchase_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_form_purchase_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_form_purchase_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">งานจัดจ้าง</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="hire_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="hire_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="hire_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">งานจัดหา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="supply_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="supply_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="supply_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการซ่อม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="repair_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="repair_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="repair_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการเช่า</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="lease_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="lease_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="lease_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายการเบิก อนุมัติ งวดงาน</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="reveal_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="reveal_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="reveal_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานซ่อม</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_repair_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_repair_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_repair_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานเช่า</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_lease_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_lease_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_lease_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานจัดหา</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_supply_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_supply_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_supply_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">รายงานจัดจ้าง</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_hire_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_hire_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="report_hire_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ตั้งค่าระบบพัสดุ</td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="sp_setting"> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดอัตราภาษี</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="tax_rate_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="tax_rate_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="tax_rate_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดหน่วยนับ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="unit_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="unit_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="unit_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดหมวดหมู่พัสดุ</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="category_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="category_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="category_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">กำหนดประเภท</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="type_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="type_add_edit"> </td>
                            <td></td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="type_del"> </td>
                        </tr>
                        <tr>
                            <td class="textleft">ตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์</td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="warehouse_view"> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="warehouse_add_edit"> </td>
                            <td> </td>
                            <td> <input class="form-check-input" type="checkbox" value="1" name="warehouse_del"> </td>
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