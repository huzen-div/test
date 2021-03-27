<form method="post" action="<?= base_url('account/creditor') ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="address">ที่อยู่</label>
            <!-- <input type="text" id="address" class="form-control" name="address" value="<?= $_POST['address'] ? $_POST['address'] : '' ?>"/> -->
            <textarea class="form-control" rows="1" name="address" id="address"><?= $_POST['address'] ? $_POST['address'] : '' ?></textarea>

        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="postal_code">รหัสไปรษณีย์</label>
            <input type="number" id="postal_code" class="form-control" name="postal_code" value="<?= $_POST['postal_code'] ? $_POST['postal_code'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="telephone">เบอร์โทร</label>
            <input type="text" id="telephone" class="form-control" name="telephone" value="<?= $_POST['telephone'] ? $_POST['telephone'] : '' ?>" pattern="[0-9]{10}" />
        </div>
        <div class="col-md-4">
            <label for="email">อีเมล์</label>
            <input type="email" id="email" class="form-control" name="email" value="<?= $_POST['email'] ? $_POST['email'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="follower_name">ชื่อผู้ติดต่อ</label>
            <input type="text" id="follower_name" class="form-control" name="follower_name" value="<?= $_POST['follower_name'] ? $_POST['follower_name'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="taxpayer_number">เลขผู้เสียภาษี</label>
            <input type="number" id="taxpayer_number" class="form-control" name="taxpayer_number" value="<?= $_POST['taxpayer_number'] ? $_POST['taxpayer_number'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="branch">สาขา</label>
            <input type="text" id="branch" class="form-control" name="branch" value="<?= $_POST['branch'] ? $_POST['branch'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="payout_type">ประเภทเงินจ่าย</label>
            <input type="text" id="payout_type" class="form-control" name="payout_type" value="<?= $_POST['payout_type'] ? $_POST['payout_type'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="tax_rate">อัตราภาษีหัก ณ ที่จ่าย (%)</label>
            <input type="text" id="tax_rate" class="form-control" name="tax_rate" value="<?= $_POST['tax_rate'] ? $_POST['tax_rate'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="tax_type">หมวดภาษี ณ ที่จ่าย</label>
            <input type="text" id="tax_type" class="form-control" name="tax_type" value="<?= $_POST['tax_type'] ? $_POST['tax_type'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="tax_conditions">เงื่อนไขการหักภาษี</label>
            <input type="text" id="tax_conditions" class="form-control" name="tax_conditions" value="<?= $_POST['tax_conditions'] ? $_POST['tax_conditions'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="payer_type">ประเภทผู้จ่าย</label>
            <input type="text" id="payer_type" class="form-control" name="payer_type" value="<?= $_POST['payer_type'] ? $_POST['payer_type'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="account_number">เลขที่บัญชี</label>
            <input type="text" id="account_number" class="form-control" name="account_number" value="<?= $_POST['account_number'] ? $_POST['account_number'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="unit">เครดิต (วัน)</label>
            <input type="number" id="unit" class="form-control" name="unit" value="<?= $_POST['unit'] ? $_POST['unit'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="vat">ภาษีมูลค่าเพิ่ม (VAT)</label>
            <input type="number" id="vat" class="form-control" name="vat" value="<?= $_POST['vat'] ? $_POST['vat'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="discount">ส่วนลด (บาท)</label>
            <input type="number" id="discount" class="form-control" name="discount" value="<?= $_POST['discount'] ? $_POST['discount'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="approval_limit">วงเงินอนุมัติ (บาท)</label>
            <input type="number" id="approval_limit" class="form-control" name="approval_limit" value="<?= $_POST['approval_limit'] ? $_POST['approval_limit'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="total_early_year">ยอดต้นปี (บาท)</label>
            <input type="number" id="total_early_year" class="form-control" name="total_early_year" value="<?= $_POST['total_early_year'] ? $_POST['total_early_year'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <!-- <label for="date">วันที่</label>
            <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required/> -->
            <label for="date">วัน/เดือน/ปีเกิด <font>สมาชิกมีอายุ (<span id="age"></span>)</font></label>
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
            <input type="text" id="date" class="datetimepicker2 form-control findage" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
        </div>
        <div class="col-md-4">
            <label for="balance">ยอดคงเหลือ (บาท)</label>
            <input type="text" id="balance" class="form-control money" name="balance" value="<?= $_POST['balance'] ? $_POST['balance'] : 0 ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="note">หมายเหตุ</label>
            <input type="text" id="note" class="form-control" name="note" value="<?= $_POST['note'] ? $_POST['note'] : '' ?>" />
        </div>
        <div class="col-md-4 ">
            <label for="prepaid_checks">เช็คจ่ายล่วงหน้า (บาท)</label>
            <input type="text" id="prepaid_checks" class="form-control money" name="prepaid_checks" value="<?= $_POST['prepaid_checks'] ? $_POST['prepaid_checks'] : 0 ?>" />
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

<script>
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }
    setInputFilter(document.getElementById("telephone"), function(value) {
        return /^-?\d*$/.test(value);
    });
</script>