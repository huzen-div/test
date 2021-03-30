<form method="post" action="<?= base_url('finance/withdraw') ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="withdrawal">ผู้ถอน</label>
            <input type="text" id="withdrawal" class="form-control" name="withdrawal" value="<?= $_POST['withdrawal'] ? $_POST['withdrawal'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="date">วันที่ถอนเงิน</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
        </div>
        <div class="col-md-4">
            <label for="operator">ผู้ดำเนินการ</label>
            <input type="text" id="operator" class="form-control" name="operator" value="<?= $_POST['operator'] ? $_POST['operator'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="agency">หน่วยงาน</label>
            <input type="text" id="agency" class="form-control" name="agency" value="<?= $_POST['agency'] ? $_POST['agency'] : '' ?>" required/>
        </div>
        <div class="col-md-4">
            <label for="no"> เลขที่ </label>
            <input type="number" id="no" class="form-control" name="no" value="<?= $_POST['no'] ? $_POST['no'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="7" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>
        <div class="col-md-4">
            <div class="col-md-12 ">
                <label for="amount">จำนวนเงิน (หน่วย:บาท)</label>
                <input type="text" id="amount" class="form-control money deposit_withdraw" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : 0 ?>" required />
            </div>
            <div class="col-md-12">
                <label for="service_charge">ค่าบริการ (หน่วย:บาท)</label>
                <input type="text" id="service_charge" class="form-control money deposit_withdraw" name="service_charge" value="<?= $_POST['service_charge'] ? $_POST['service_charge'] : 0 ?>" required />
            </div>
            <div class="col-md-12">
                <label for="total">จำนวนเงินทั้งสิ้น (หน่วย:บาท)</label>
                <input type="text" id="total" class="form-control money" name="total" readonly required/>
            </div>
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </div>
</form>