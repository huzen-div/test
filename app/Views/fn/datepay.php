<form method="post" action="<?= base_url('finance/datepay') ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">

            <label for="customer_id">รหัสสมาชิก</label>
            <select class="form-control select2" name="customer_id" id="customer_id" required>
                <option selected value="">เลือกรหัสสมาชิก</option>
                <?php foreach ($debtor as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $_POST['customer_id'] == $row['id'] ? print 'selected' : ''; ?>><?= 'MOPH-' . sprintf('%07d', $row['id']) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="document_id">เลขที่เอกสาร</label>
            <input type="number" id="document_id" class="form-control" name="document_id" value="<?= $_POST['document_id'] ? $_POST['document_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="date">กำหนดนัดหมาย</label>
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
        </div>
        <div class="col-md-4">
            <label for="status_id">สถานะ</label>
            <select class="form-control" name="status_id" id="status_id" required>
                <option selected value="">เลือกสถานะ</option>
                <option value="ชำระแล้ว">ชำระแล้ว</option>
                <option value="ยังไม่ชำระ">ยังไม่ชำระ</option>
                <option value="ติดตามผล">ติดตามผล</option>
            </select>
            <!-- <input type="text" id="status_id" class="form-control" name="status_id" value="<?= $_POST['status_id'] ? $_POST['status_id'] : '' ?>" required /> -->
        </div>
        <div class="col-md-4">
            <label for="unit_id">เครดิต(วัน)</label>
            <input type="number" id="unit_id" class="form-control" name="unit_id" value="<?= $_POST['unit_id'] ? $_POST['unit_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="employee_id">รหัสพนักงาน</label>
            <input type="number" id="employee_id" class="form-control" name="employee_id" value="<?= $_POST['employee_id'] ? $_POST['employee_id'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>
        <div class="col-md-12" style="margin-top: 1%;text-align: right;">
            <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary " value="เคลียร์" />
        </div>
    </div>
    <div class="row">

    </div>
</form>