<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('purchase/buy_supplies') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="employees_id">ผู้ขอซื้อ</label>
                <input type="text" id="employees_id" class="form-control" name="employees_id" value="<?= $_POST['employees_id'] ? $_POST['employees_id'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="department">แผนก/ฝ่าย</label>
                <input type="text" id="department" class="form-control" name="department" value="<?= $_POST['department'] ? $_POST['department'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="reference">เลขที่</label>
                <input type="text" id="reference" class="form-control" name="reference" value="<?= $_POST['reference'] ? $_POST['reference'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="type_id" style="margin-right: 5%;">ประเภท</label>
                <input type="radio" class="type_id" id="consumables" name="type_id" value="1" required <?php $_POST['type_id'] == 1 ? print 'checked' : ''; ?>>
                <label for="consumables" style="margin-right: 2%;">วัสดุสิ้นเปลือง</label>
                <input type="radio" class="type_id" id="asset" name="type_id" value="2" <?php $_POST['type_id'] == 2 ? print 'checked' : ''; ?>>
                <label for="asset" style="margin-right: 2%;">สินทรัพย์</label>
                <input type="radio" class="type_id" id="material" name="type_id" value="3" <?php $_POST['type_id'] == 3 ? print 'checked' : ''; ?>>
                <label for="material" style="margin-right: 2%;">วัตถุดิบ</label>
                <input type="radio" class="type_id" id="other" name="type_id" value="4" <?php $_POST['type_id'] == 4 ? print 'checked' : ''; ?>>
                <label for="other">อื่นๆ</label>
            </div>

            <div class="col-md-3">
                <input type="text" id="type_detail" class="form-control" name="type_detail" value="<?= $_POST['type_detail'] ? $_POST['type_detail'] : '' ?>">
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="tax_invoice_id">ใบสั่ง ภาษี</label>
                <select class="form-control" name="tax_invoice_id" id="tax_invoice_id" required>
                    <option selected value="">เลือกใบสั่ง ภาษี</option>
                    <?php foreach ($tax as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['tax_invoice_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="discount">ส่วนลด (5/5%)</label>
                <input type="number" id="discount" class="form-control" name="discount" value="<?= $_POST['discount'] ? $_POST['discount'] : 0 ?>">
            </div>
            <div class="col-md-4">
                <label for="type_maintenance">ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)</label>
                <input type="text" id="type_maintenance" class="form-control" name="type_maintenance" value="<?= $_POST['type_maintenance'] ? $_POST['type_maintenance'] : '' ?>">
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="distributor">ผู้จัดจำหน่าย</label>
                <input type="text" id="distributor" class="form-control" name="distributor" value="<?= $_POST['distributor'] ? $_POST['distributor'] : '' ?>" required>
            </div>
            <div class="col-md-4">
                <label for="order_status">สถานะการชำระ</label>
                <select class="form-control" name="order_status" id="order_status" required>
                    <option selected value="">เลือกสถานะการชำระ</option>
                    <option value="1">ยังไม่ชำระ</option>
                    <option value="2">ค้างจ่าย</option>
                    <option value="3">ระหว่างดำเนินการ</option>
                    <option value="4">ยกเลิก</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="payment_status">สถานะการจ่ายเงิน</label>
                <select class="form-control" name="payment_status" id="payment_status" required>
                    <option selected value="">เลือกสถานะการจ่ายเงิน</option>
                    <option value="1">จ่ายเงินแล้ว</option>
                    <option value="2">ยังไม่ชำระ</option>
                    <option value="3">ค้างจ่าย</option>
                    <option value="4">ระหว่างดำเนินการ</option>
                    <option value="5">ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="payment_term">Payment term</label>
                <input type="text" id="payment_term" class="form-control" name="payment_term" value="<?= $_POST['payment_term'] ? $_POST['payment_term'] : '' ?>">
                <!-- <textarea class="form-control" rows="1" name="payment_term" id="payment_term"><?= $_POST['payment_term'] ?? $_POST['payment_term']  ?></textarea> -->
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">อื่นๆ</label>
                <textarea class="form-control" rows="3" name="note" id="note"><?= $_POST['note'] ?? $_POST['note']  ?></textarea>
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