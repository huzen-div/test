<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('purchase/form_purchase') ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="seller_name">ผู้ขาย/ผู้รับจ้าง</label>
                <input type="text" id="seller_name" class="form-control" name="seller_name" value="<?= $_POST['seller_name'] ? $_POST['seller_name'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="purchase_order1">ใบสั่งซื้อ/สั่งจ้าง เลขที่</label>
                <div class="row">
                    <input type="text" id="purchase_order" class="form-control col-md-1" name="purchase_order" value="PO-" readonly />
                    <input type="text" id="purchase_order1" class="form-control col-md-5" name="purchase_order1" value="<?= $_POST['purchase_order1'] ? $_POST['purchase_order1'] : '' ?>" required />
                    <h2>/</h2>
                    <input type="text" id="purchase_order2" class="form-control col-md-5" name="purchase_order2" value="<?= $_POST['purchase_order2'] ? $_POST['purchase_order2'] : '' ?>" required />
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-3">
                <label for="house_no">ที่อยู่</label>
                <input type="text" id="house_no" class="form-control" name="house_no" value="<?= $_POST['house_no'] ? $_POST['house_no'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="alley">ซอย</label>
                <input type="text" id="alley" class="form-control" name="alley" value="<?= $_POST['alley'] ? $_POST['alley'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-2">
                <label for="road">ถนน</label>
                <input type="text" id="road" class="form-control" name="road" value="<?= $_POST['road'] ? $_POST['road'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="sub_district">ตำบล</label>
                <input type="text" id="sub_district" class="form-control" name="sub_district" value="<?= $_POST['sub_district'] ? $_POST['sub_district'] : '' ?>" required>
            </div>
            <div class="col-md-2">
                <label for="district">อำเภอ</label>
                <input type="text" id="district" class="form-control" name="district" value="<?= $_POST['district'] ? $_POST['district'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <!-- <label for="reference" class="textmiddle">สํานักงานฌาปนกิจสงเคราะห์กระทรวงสาธารณสุข</label> -->
                <label for="fiscal_year">ปีงบประมาณ พ.ศ</label>
                <?php
                echo '<select class="form-control select2" name="fiscal_year" id="fiscal_year" required>';
                $var_y = date("Y") + 543;
                $ys = $var_y - 30;
                $ys_go = $var_y + 20;

                for ($i = $ys; $i <= $ys_go; $i++) {
                    if ($i == date("Y") + 543) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='{$i}' $selected>{$i}</option>";
                }
                echo '</select>';
                ?>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-3">
                <label for="province">จังหวัด</label>
                <input type="text" id="province" class="form-control" name="province" value="<?= $_POST['province'] ? $_POST['province'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="postal_code">รหัสไปรษณีย์</label>
                <input type="number" id="postal_code" class="form-control" name="postal_code" value="<?= $_POST['postal_code'] ? $_POST['postal_code'] : '' ?>" required>
            </div>
            <div class="col-md-2">
                <label for="house_no2">ที่อยู่</label>
                <input type="text" id="house_no2" class="form-control" name="house_no2" value="<?= $_POST['house_no2'] ? $_POST['house_no2'] : '' ?>" required>
            </div>
            <div class="col-md-2">
                <label for="swine2">หมู่ที่</label>
                <input type="text" id="swine2" class="form-control" name="swine2" value="<?= $_POST['swine2'] ? $_POST['swine2'] : '' ?>" required>
            </div>
            <div class="col-md-2">
                <label for="alley2">ซอย</label>
                <input type="text" id="alley2" class="form-control" name="alley2" value="<?= $_POST['alley2'] ? $_POST['alley2'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="tel">โทรศัพท์</label>
                <input type="text" id="tel" class="form-control" name="tel" value="<?= $_POST['tel'] ? $_POST['tel'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="road2">ถนน</label>
                <input type="text" id="road2" class="form-control" name="road2" value="<?= $_POST['road2'] ? $_POST['road2'] : '' ?>" required>
            </div>
            <div class="col-md-2">
                <label for="sub_district2">ตำบล</label>
                <input type="text" id="sub_district2" class="form-control" name="sub_district2" value="<?= $_POST['sub_district2'] ? $_POST['sub_district2'] : '' ?>" required>
            </div>
            <div class="col-md-2">
                <label for="district2">อำเภอ</label>
                <input type="text" id="district2" class="form-control" name="district2" value="<?= $_POST['district2'] ? $_POST['district2'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="taxpayer_id">เลขที่ประจำตัวผู้เสียภาษี</label>
                <input type="text" id="taxpayer_id" class="form-control" name="taxpayer_id" value="<?= $_POST['taxpayer_id'] ? $_POST['taxpayer_id'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="province2">จังหวัด</label>
                <input type="text" id="province2" class="form-control" name="province2" value="<?= $_POST['province2'] ? $_POST['province2'] : '' ?>" required>
            </div>
            <div class="col-md-3">
                <label for="postal_code2">รหัสไปรษณีย์</label>
                <input type="number" id="postal_code2" class="form-control" name="postal_code2" value="<?= $_POST['postal_code2'] ? $_POST['postal_code2'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="bank_account_number">เลขที่บัญชีเงินฝากธนาคาร</label>
                <input type="text" id="bank_account_number" class="form-control" name="bank_account_number" value="<?= $_POST['bank_account_number'] ? $_POST['bank_account_number'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="tel2">โทรศัพท์</label>
                <input type="text" id="tel2" class="form-control" name="tel2" value="<?= $_POST['tel2'] ? $_POST['tel2'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="account_name">ชื่อบัญชี</label>
                <input type="text" id="account_name" class="form-control" name="account_name" value="<?= $_POST['account_name'] ? $_POST['account_name'] : '' ?>" required />
                <label for="bank_number">ธนาคาร</label>
                <input type="text" id="bank_number" class="form-control" name="bank_number" value="<?= $_POST['bank_number'] ? $_POST['bank_number'] : '' ?>" required />
                <label for="bank_branch">สาขา</label>
                <input type="text" id="bank_branch" class="form-control" name="bank_branch" value="<?= $_POST['bank_branch'] ? $_POST['bank_branch'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="other">อื่นๆ</label>
                <textarea class="form-control" rows="3" name="other" id="other"><?= $_POST['other'] ?? $_POST['other']  ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="detail">รายละเอียด</label>
                <textarea class="form-control" rows="3" name="detail" id="detail"><?= $_POST['detail'] ?? $_POST['detail']  ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="list">รายการ</label>
                <input type="text" id="list" class="form-control" name="list" value="<?= $_POST['list'] ? $_POST['list'] : '' ?>" required>
                <label for="document">ไฟล์แนบ1</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="document" name="document" />
                <label for="document2">ไฟล์แนบ2</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document2" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="document2" name="document2" />
                <label for="document3">ไฟล์แนบ3</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document3" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="document3" name="document3" />
            </div>
            <div class="col-md-6">
                <label for="unit_price">ราคาหน่วย (บาท/สตางค์)</label>
                <input type="text" id="unit_price" class="form-control money test" name="unit_price" value="<?= $_POST['unit_price'] ? $_POST['unit_price'] : 0 ?>" required />
                <label for="amount">จำนวนเงิน (บาท/สตางค์)</label>
                <input type="text" id="amount" class="form-control money test" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : 0 ?>" required />
                <label for="before_vat">ราคาก่อนรวมภาษีมูลค่าเพิ่ม</label>
                <input type="text" id="before_vat" class="form-control money" name="before_vat" value="<?= $_POST['before_vat'] ? $_POST['before_vat'] : 0 ?>" readonly />
                <label for="vat">ภาษีมูลค่าเพิ่ม 7%</label>
                <input type="text" id="vat" class="form-control money" name="vat" value="<?= $_POST['vat'] ? $_POST['vat'] : 0 ?>" readonly />
                <label for="total">รวมเป็นเงินทั้งสิ้น</label>
                <input type="text" id="total" class="form-control money" name="total" value="<?= $_POST['total'] ? $_POST['total'] : 0 ?>" readonly />
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
    setInputFilter(document.getElementById("bank_account_number"), function(value) {
        return /^-?\d*$/.test(value);
    });
    setInputFilter(document.getElementById("tel"), function(value) {
        return /^-?\d{0,10}$/.test(value);
    });
    setInputFilter(document.getElementById("tel2"), function(value) {
        return /^-?\d{0,10}$/.test(value);
    });
    $(document).ready(function() {

        $("#del_document").click(function() {
            $('#document').val("");
        });
        $("#del_document2").click(function() {
            $('#document2').val("");
        });
        $("#del_document3").click(function() {
            $('#document3').val("");
        });
        $(".test").change(function() {
            var total = 0;
            var unit_price = parseFloat($("#unit_price").autoNumeric('get'));
            var amount = parseFloat($("#amount").autoNumeric('get'));
            total = (parseFloat(unit_price) + parseFloat(amount)).toFixed(2);
            $('#before_vat').val(total);

            var vat = (total * 0.07).toFixed(2);
            total = (parseFloat(total) + parseFloat(vat)).toFixed(2);

            $('#vat').val(vat);
            $('#total').val(total);
            $('.money').trigger('keyup');
            c
        });
        $('.test').trigger('change');
    });
</script>