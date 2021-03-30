<form method="post" action="<?= base_url('finance/edit_receiving_money').'/'.$data[0]['id'] ?>">
    <!-- <?php var_dump($data[0]['id']); ?> -->
    <div class="row" style="margin-bottom: 1%;">

        <div class="col-md-6"><label for="customer_id">รหัสสมาชิก</label>
            <select class="form-control select2" name="customer_id" id="customer_id" required>
                <option selected value="">เลือกรหัสสมาชิก</option>
                <?php foreach ($debtor as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['customer_id'] == $row['id'] ? print 'selected' : ''; ?>><?= 'MOPH-'.sprintf('%07d', $row['id']) ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="bill_id">เลขที่เอกสาร</label>
            <input type="number" id="bill_id" class="form-control" name="bill_id" value="<?= $data[0]['bill_id'] ? $data[0]['bill_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">

        <div class="col-md-6"><label for="employee_id">รหัสพนักงาน</label>
            <input type="number" id="employee_id" class="form-control" name="employee_id" value="<?= $data[0]['employee_id'] ? $data[0]['employee_id'] : '' ?>" required />
        </div>

        <div class="col-md-3"><label for="unit_id">เครดิต(วัน)</label>
            <input type="number" id="unit_id" class="form-control" name="unit_id" value="<?= $data[0]['unit_id'] ? $data[0]['unit_id'] : '' ?>" required />
        </div>

        <div class="col-md-3"><label for="bill_date">วันที่วางบิล</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="bill_date" value="<?= $data[0]['bill_date'] ? $data[0]['bill_date'] : '' ?>" required >   
            <!-- <input type="date" id="bill_date" class="form-control" name="bill_date" value="<?= $data[0]['bill_date'] ? $data[0]['bill_date'] : '' ?>" required /> -->
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="group_id">กลุ่มลูกค้า</label>
            <input type="text" id="group_id" class="form-control" name="group_id" value="<?= $data[0]['group_id'] ? $data[0]['group_id'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="receive_date">วันนัดรับชำระ</label>
            <input type="text" id="receive_date" class="datetimepicker2 form-control" name="receive_date" value="<?= $data[0]['receive_date'] ? $data[0]['receive_date'] : '' ?>" required >   
            <!-- <input type="date" id="receive_date" class="form-control" name="receive_date" value="<?= $data[0]['receive_date'] ? $data[0]['receive_date'] : '' ?>" required /> -->
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="contact">ผู้ติดต่อ</label>
            <input type="text" id="contact" class="form-control" name="contact" value="<?= $data[0]['contact'] ? $data[0]['contact'] : '' ?>" />
        </div>
        <div class="col-md-6">
            <label for="status_id">สถานะ</label>
            <input type="text" id="status_id" class="form-control" name="status_id" value="<?= $data[0]['status_id'] ? $data[0]['status_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="additional_conditions">เงื่อนไขเพิ่มเติม</label>
            <input type="text" id="additional_conditions" class="form-control" name="additional_conditions" value="<?= $data[0]['additional_conditions'] ? $data[0]['additional_conditions'] : '' ?>" />
        </div>
        <div class="col-md-6">
            <label for="note">หมายเหตุ</label>
            <!-- <input type="text" id="note" class="form-control" name="note" value="<?= $data[0]['note'] ? $data[0]['note'] : '' ?>" /> -->

            <textarea class="form-control" rows="1" name="note" id="note"><?= $data[0]['note'] ? $data[0]['note'] : '' ?></textarea>
        </div>
    </div>

    <div class="row">
        <!-- <div class="col-md-6">
            <label class="col-md-2" for="additional_conditions">ยกเลิกใบวางบิล</label>
            <input type="checkbox" class="form-check-input" name="cancel_bill" value="1" <?= $data[0]['cancel_bill'] == 1 ? 'checked="checked"' : ''; ?> />
        </div> -->
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
    </div>
</form>