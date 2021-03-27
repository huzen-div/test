<form method="post" action="<?= base_url('finance/check') ?>">

    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="into_account">เข้าบัญชี</label>
            <input type="text" id="into_account" class="form-control" name="into_account" value="<?= $_POST['into_account'] ? $_POST['into_account'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="department_id">แผนก</label>
            <input type="text" id="department_id" class="form-control" name="department_id" value="<?= $_POST['department_id'] ? $_POST['department_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="comment">หมายเหตุ</label>
            <input type="text" id="comment" class="form-control" name="comment" value="<?= $_POST['comment'] ? $_POST['comment'] : '' ?>" />
        </div>
        <div class="col-md-6">
            <label for="deposit_id">ใบที่นำฝาก</label>
            <input type="number" id="deposit_id" class="form-control" name="deposit_id" value="<?= $_POST['deposit_id'] ? $_POST['deposit_id'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="deposit_date">วันที่นำฝาก</label>
            <input type="text" id="deposit_date" class="datetimepicker2 form-control" name="deposit_date" value="<?= $_POST['deposit_date'] ? $_POST['deposit_date'] : '' ?>" required >   
            <!-- <input type="date" id="deposit_date" class="form-control" name="deposit_date" value="<?= $_POST['deposit_date'] ? $_POST['deposit_date'] : '' ?>" required /> -->
        </div>
        <div class="col-md-4">
            <label for="passed_date">วันที่ผ่าน</label>
            <input type="text" id="passed_date" class="datetimepicker2 form-control" name="passed_date" value="<?= $_POST['passed_date'] ? $_POST['passed_date'] : '' ?>" required >   
            <!-- <input type="date" id="passed_date" class="form-control" name="passed_date" value="<?= $_POST['passed_date'] ? $_POST['passed_date'] : '' ?>" required /> -->
        </div>
        <div class="col-md-4">
            <label for="implementation_date">วันที่ดำเนินการ</label>
            <input type="text" id="implementation_date" class="datetimepicker2 form-control" name="implementation_date" value="<?= $_POST['implementation_date'] ? $_POST['implementation_date'] : '' ?>" required >   
            <!-- <input type="date" id="implementation_date" class="form-control" name="implementation_date" value="<?= $_POST['implementation_date'] ? $_POST['implementation_date'] : '' ?>" required /> -->
        </div>
    </div>
    <!-- <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3 offset-md-8">
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
    <div class="row">
        <div class="col-md-4 offset-md-8">
            <label for="total">จำนวนเงินทั้งสิ้น</label>
            <input type="number" id="total" class="form-control " readonly />
        </div>
        <div class="col-md-12" style="margin-top: 1%;text-align: right;">
            <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary " value="เคลียร์" />
        </div>
    </div> -->
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>
        <div class="col-md-4">
            <!-- <div class="col-md-12 ">
                <label for="amount">จำนวนเงิน (หน่วย:บาท)</label>
                <input type="number" id="amount" class="form-control vat" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : '' ?>" />
            </div>
            <div class="col-md-12">
                <label for="vat">ภาษีมูลค่าเพิ่ม (7%)</label>
                <input type="number" id="vat" class="form-control " readonly />
            </div>
            <div class="col-md-12">
                <label for="total">จำนวนเงินทั้งสิ้น (หน่วย:บาท)</label>
                <input type="number" id="total" class="form-control " readonly />
            </div>
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div> -->
            <div class="col-md-12 ">
                <label for="amount">จำนวนเงิน (หน่วย:บาท)</label>
                <input type="text" id="amount" class="form-control cal money" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : 0 ?>" />
            </div>
            <div class="col-md-12">
                <label for="fee">หักค่าธรรมเนียมธนาคาร (หน่วย:บาท)</label>
                <input type="text" id="fee" class="form-control cal money" name="fee" value="<?= $_POST['fee'] ? $_POST['fee'] : 0 ?>" />

            </div>
            <div class="col-md-12">
                <label for="vat">ภาษีมูลค่าเพิ่ม(ของค่าธรรมเนียม) (หน่วย:บาท)</label>
                <input type="text" id="vat" class="form-control cal money" name="vat" value="<?= $_POST['vat'] ? $_POST['vat'] : 0 ?>" />

            </div>
            <div class="col-md-12">
                <label for="tax ">หัก ภาษีถูกหัก ณ ที่จ่าย (หน่วย:บาท)</label>
                <input type="text" id="tax" class="form-control cal money" name="tax" value="<?= $_POST['tax'] ? $_POST['tax'] : 0 ?>" />

            </div>
            <div class="col-md-12">
                <label for="total">เงินเข้าบัญชีสุทธิ (หน่วย:บาท)</label>
                <input type="text" id="total" class="form-control caltotal money" name="total" value="<?= $_POST['total'] ? $_POST['total'] : 0 ?>" readonly/>

            </div>
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </div>
</form>