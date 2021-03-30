<form method="post" action="<?= base_url('finance/edit_checkpay') . '/' . $data[0]['id'] ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="check_date">วันที่เช็ค</label>
            <input type="text" id="check_date" class="datetimepicker2 form-control" name="check_date" value="<?= $data[0]['check_date'] ? $data[0]['check_date'] : '' ?>" required>
            <!-- <input type="date" id="check_date" class="form-control" name="check_date" value="<?= $data[0]['check_date'] ? $data[0]['check_date'] : '' ?>" required /> -->
        </div>
        <div class="col-md-4">
            <label for="check_issue">วันที่ออกเช็ค</label>
            <input type="text" id="check_issue" class="datetimepicker2 form-control" name="check_issue" value="<?= $data[0]['check_issue'] ? $data[0]['check_issue'] : '' ?>" required>
            <!-- <input type="date" id="check_issue" class="form-control" name="check_issue" value="<?= $data[0]['check_issue'] ? $data[0]['check_issue'] : '' ?>" required /> -->
        </div>
        <div class="col-md-4">
            <label for="cheack_id">

                เลขที่เช็ค

            </label>
            <input type="number" id="cheack_id" class="form-control" name="cheack_id" value="<?= $data[0]['cheack_id'] ? $data[0]['cheack_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <label for="type_id">

                ตัดบัญชี

            </label>
            <input type="number" id="type_id" class="form-control" name="type_id" value="<?= $data[0]['type_id'] ? $data[0]['type_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="debit_id">รหัส</label>
            <input type="number" id="debit_id" class="form-control" name="debit_id" value="<?= $data[0]['debit_id'] ? $data[0]['debit_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="amount">จำนวนเงิน</label>
            <!-- <input type="number" id="amount" class="form-control" name="amount" value="<?= $data[0]['amount'] ? $data[0]['amount'] : '' ?>" /> -->
            <input type="text" id="amount" class="form-control money" name="amount" value="<?= $data[0]['amount'] ? $data[0]['amount'] : 0 ?>" required />
        </div>
        <div class="col-md-3">
            <label for="pay_for">

                จ่ายให้ (ทายาทผู้รับผลประโยชน์)

            </label>
            <input type="text" id="pay_for" class="form-control" name="pay_for" value="<?= $data[0]['pay_for'] ? $data[0]['pay_for'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <label for="check_status">สถานะเช็ค</label>
            <input type="text" id="check_status" class="form-control" name="check_status" value="<?= $data[0]['check_status'] ? $data[0]['check_status'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="balance">ยอดเหลือ</label>
            <!-- <input type="number" id="balance" class="form-control" name="balance" value="<?= $data[0]['balance'] ? $data[0]['balance'] : '' ?>" /> -->
            <input type="text" id="balance" class="form-control money" name="balance" value="<?= $data[0]['balance'] ? $data[0]['balance'] : 0 ?>" required />
        </div>
        <div class="col-md-3">
            <label for="passed_date">วันที่ผ่านเช็ค</label>
            <input type="text" id="passed_date" class="datetimepicker2 form-control" name="passed_date" value="<?= $data[0]['passed_date'] ? $data[0]['passed_date'] : '' ?>" required>
            <!-- <input type="date" id="passed_date" class="form-control" name="passed_date" value="<?= $data[0]['passed_date'] ? $data[0]['passed_date'] : '' ?>" required /> -->
        </div>
        <div class="col-md-3">
            <label for="cost">ยอดค่าใช้จ่าย</label>
            <!-- <input type="number" id="cost" class="form-control" name="cost" value="<?= $data[0]['cost'] ? $data[0]['cost'] : '' ?>" /> -->
            <input type="text" id="cost" class="form-control money" name="cost" value="<?= $data[0]['cost'] ? $data[0]['cost'] : 0 ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">เพิ่มเติม</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $data[0]['note'] ? $data[0]['note'] : '' ?></textarea>
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