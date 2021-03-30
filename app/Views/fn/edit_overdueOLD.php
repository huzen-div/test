<form method="post" action="<?= base_url('finance/edit_overdue') . '/' . $data[0]['id'] ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <label for="customer_id">รหัสสมาชิก</label>
            <select class="form-control select2" name="customer_id" id="customer_id" required>
                <option selected value="">เลือกรหัสสมาชิก</option>
                <?php foreach ($debtor as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['customer_id'] == $row['id'] ? print 'selected' : ''; ?>><?= 'MOPH-' . sprintf('%07d', $row['id']) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="bill_to">Bill to</label>
            <input type="text" id="bill_to" class="form-control" name="bill_to" value="<?= $data[0]['bill_to'] ? $data[0]['bill_to'] : '' ?>" required />
        </div>

        <div class="col-md-3">
            <label for="department_id">แผนก</label>
            <input type="text" id="department_id" class="form-control" name="department_id" value="<?= $data[0]['department_id'] ? $data[0]['department_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="date">วันที่กำหนด</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required /> -->
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="address">ที่อยู่</label>
            <input type="text" id="address" class="form-control" name="address" value="<?= $data[0]['address'] ? $data[0]['address'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="telephone">โทร</label>
            <input type="text" id="telephone" class="form-control" name="telephone" value="<?= $data[0]['telephone'] ? $data[0]['telephone'] : '' ?>" pattern="[0-9]{10}" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <label for="document_id">เลขที่เอกสาร</label>
            <input type="number" id="document_id" class="form-control" name="document_id" value="<?= $data[0]['document_id'] ? $data[0]['document_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="add_debt_id">เลขที่ใบเพิ่มหนี้</label>
            <input type="number" id="add_debt_id" class="form-control" name="add_debt_id" value="<?= $data[0]['add_debt_id'] ? $data[0]['add_debt_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="type_id">ประเภท</label>
            <!-- <input type="text" id="type_id" class="form-control" name="type_id" value="<?= $data[0]['type_id'] ? $data[0]['type_id'] : '' ?>" required /> -->
            <select class="form-control" name="type_id" id="type_id" required>
                <option selected value="">เลือกประเภท</option>
                <option value="1" <?php $data[0]['type_id'] == 1 ? print 'selected' : ''; ?>>ค้างชำระ</option>
                <option value="2" <?php $data[0]['type_id'] == 2 ? print 'selected' : ''; ?>>ชำระแล้ว</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="unit_id">เครดิต(วัน)</label>
            <input type="number" id="unit_id" class="form-control" name="unit_id" value="<?= $data[0]['day'] ? $data[0]['day'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $data[0]['note'] ? $data[0]['note'] : '' ?></textarea>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="amount">จำนวนเงิน (หน่วย:บาท)</label>
            <input type="text" id="amount" class="form-control vat money" name="amount" value="<?= $data[0]['amount'] ? $data[0]['amount'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="vat">ภาษีมูลค่าเพิ่ม (7%)</label>
            <input type="text" id="vat" class="form-control money" readonly />
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-8">
            <label for="total">จำนวนเงินทั้งสิ้น (หน่วย:บาท)</label>
            <input type="text" id="total" class="form-control money" readonly />
        </div>
        <div class="col-md-12" style="margin-top: 1%;text-align: right;">
            <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary " value="เคลียร์" />
        </div>
    </div>
</form>