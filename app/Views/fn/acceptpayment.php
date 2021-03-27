<form method="post" action="<?= base_url('finance/acceptpayment') ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <!-- <label for="customer_id">รหัสสมาชิก</label>
            <input type="number" id="customer_id" class="form-control" name="customer_id" value="<?= $_POST['customer_id'] ? $_POST['customer_id'] : '' ?>" required /> -->
            <label for="customer_id">รหัสสมาชิก</label>
            <select class="form-control select2" name="customer_id" id="customer_id" required>
                <option selected value="">เลือกรหัสสมาชิก</option>
                <?php foreach ($debtor as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $_POST['customer_id'] == $row['id'] ? print 'selected' : ''; ?>><?= 'MOPH-'.sprintf('%07d', $row['id']) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="bill_to">Bill to</label>
            <input type="text" id="bill_to" class="form-control" name="bill_to" value="<?= $_POST['bill_to'] ? $_POST['bill_to'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="department_id">แผนก</label>
            <input type="text" id="department_id" class="form-control" name="department_id" value="<?= $_POST['department_id'] ? $_POST['department_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="date">วันที่กำหนด</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required >   
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="address">ที่อยู่</label>
            <input type="text" id="address" class="form-control" name="address" value="<?= $_POST['address'] ? $_POST['address'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="telephone">โทร</label>
            <input type="text" id="telephone" class="form-control" name="telephone" value="<?= $_POST['telephone'] ? $_POST['telephone'] : '' ?>" pattern="[0-9]{10}" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="document_id">เลขที่เอกสาร</label>
            <input type="number" id="document_id" class="form-control" name="document_id" value="<?= $_POST['document_id'] ? $_POST['document_id'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="add_debt_id">เลขที่ใบเพิ่มหนี้</label>
            <input type="number" id="add_debt_id" class="form-control" name="add_debt_id" value="<?= $_POST['add_debt_id'] ? $_POST['add_debt_id'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="type_id">ประเภท</label>
            <!-- <input type="number" id="type_id" class="form-control" name="type_id" value="<?= $_POST['type_id'] ? $_POST['type_id'] : '' ?>" required /> -->
            <select class="form-control" name="type_id" id="type_id" required>
                <option selected value="">เลือกประเภท</option>
                <option value="1" <?php $_POST['type_id'] == 1 ? print 'selected' : ''; ?>>รับชำระเงินแล้ว</option>
                <option value="2" <?php $_POST['type_id'] == 2 ? print 'selected' : ''; ?>>ยังไม่ชำระเงิน</option>
                <option value="3" <?php $_POST['type_id'] == 3 ? print 'selected' : ''; ?>>ระหว่างดำเนินการ</option>
            </select>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <label for="vat">VAT(กรณีรับ)</label>
            <input type="text" id="vat" class="form-control money" name="vat" value="<?= $_POST['vat'] ? $_POST['vat'] : '' ?>" />
        </div>
    </div>
    <div class="row textcenter" style="margin-bottom: 1%;">
        <div class="col-md-2">
            <label for="interest">อัตราดอกเบี้ย(%)</label>
            <input type="text" id="interest" class="form-control money" name="interest" value="<?= $_POST['interest'] ? $_POST['interest'] : '' ?>" />
        </div>
        <div class="col-md-2">
            <label for="cash">เงินสด</label>
            <input type="text" id="cash" class="form-control money" name="cash" value="<?= $_POST['cash'] ? $_POST['cash'] : '' ?>" />
        </div>
        <div class="col-md-2">
            <label for="another">ชำระโดยอื่นๆ</label>
            <input type="text" id="another" class="form-control money" name="another" value="<?= $_POST['another'] ? $_POST['another'] : '' ?>" />
        </div>
        <div class="col-md-2">
            <label for="withholding_tax">ภาษี ณ ที่จ่าย</label>
            <input type="text" id="withholding_tax" class="form-control money" name="withholding_tax" value="<?= $_POST['withholding_tax'] ? $_POST['withholding_tax'] : '' ?>" />
        </div>
        <div class="col-md-2">
            <label for="discount">ส่วนลดเเงินสด</label>
            <input type="text" id="discount" class="form-control money" name="discount" value="<?= $_POST['discount'] ? $_POST['discount'] : '' ?>" />
        </div>
        <div class="col-md-2">
            <label for="payment_amount">ยอดชำระเงินจริง</label>
            <input type="text" id="payment_amount" class="form-control money" name="payment_amount" value="<?= $_POST['payment_amount'] ? $_POST['payment_amount'] : '' ?>" />
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