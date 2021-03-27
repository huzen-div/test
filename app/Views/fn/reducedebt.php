<form method="post" action="<?= base_url('finance/reducedebt') ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <!-- <label for="customer_id">รหัสลูกหนี้</label>
            <input type="number" id="customer_id" class="form-control" name="customer_id" value="<?= $_POST['customer_id'] ? $_POST['customer_id'] : '' ?>" required /> -->
            <label for="customer_id">รหัสลูกหนี้</label>
            <select class="form-control" name="customer_id" id="customer_id" required>
                <option selected value="">เลือกรหัสลูกหนี้</option>
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
            <input type="number" id="department_id" class="form-control" name="department_id" value="<?= $_POST['department_id'] ? $_POST['department_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="date">วันที่กำหนด</label>
            <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required />
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
            <input type="number" id="type_id" class="form-control" name="type_id" value="<?= $_POST['type_id'] ? $_POST['type_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>

    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="amount">จำนวนเงิน</label>
            <input type="number" id="amount" class="form-control vat" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="vat">ภาษีมูลค่าเพิ่ม</label>
            <input type="number" id="vat" class="form-control " readonly />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="total">จำนวนเงินทั้งสิ้น</label>
            <input type="number" id="total" class="form-control " readonly />
        </div>
        <div class="col-md-3 offset-md-9" style="margin-top: 1%;">
            <input type="submit" class="btn btn-success col-md-5" name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary col-md-5" value="เคลียร์" />
        </div>
    </div>
</form>