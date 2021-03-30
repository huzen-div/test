<form method="post" action="<?= base_url('account/debtor') ?>" enctype="multipart/form-data">
    <h2>ข้อมูลสมาชิก</h2>

    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="name">ชื่อ - นามสกุล</label>
            <input type="text" id="name" class="form-control" name="name" value="<?= $_POST['name'] ? $_POST['name'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="date">วัน/เดือน/ปีเกิด <font >สมาชิกมีอายุ (<span id="age"></span>)</font></label>
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
            <input type="text" id="date" class="datetimepicker2 form-control findage" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            <!-- <input id="inputdatepicker" class="testdate form-control findage" data-date-format="mm/dd/yyyy"> -->
        </div>
        <div class="col-md-4">
            <label for="image">รูปสมาชิก</label>
            <input type='file' class="form-control" id="image" accept="image/*" name="image" />
            <img id="preview_image" class="img-fluid" src="<?= base_url('files') . '/No_image_available.png' ?>" alt="your image" style="margin: 1%;width: 100px;" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;"> 
        <div class="col-md-6">
            <label for="taxpayer_number">เลขที่บัตรประชาชน</label>
            <input type="number" id="taxpayer_number" class="form-control" name="taxpayer_number" value="<?= $_POST['taxpayer_number'] ? $_POST['taxpayer_number'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="gender">เพศ</label><br>
            <!-- <input type="text" id="gender" class="form-control" name="gender" value="<?= $_POST['gender'] ? $_POST['gender'] : '' ?>" required/> -->
            <input type="radio" id="male" name="gender" value="ผู้ชาย" required>
            <label for="male">ผู้ชาย</label>
            <input type="radio" id="female" name="gender" value="ผู้หญิง">
            <label for="female">ผู้หญิง</label>
            <input type="radio" id="Other" name="gender" value="อื่นๆ">
            <label for="Other">อื่นๆ</label>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="address">ที่อยู่</label>
            <!-- <input type="text" id="address" class="form-control" name="address" value="<?= $_POST['address'] ? $_POST['address'] : '' ?>"/> -->
            <textarea class="form-control" rows="1" name="address" id="address"><?= $_POST['address'] ?? $_POST['address']  ?></textarea>

        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="email">อีเมล์</label>
            <input type="email" id="email" class="form-control" name="email" value="<?= $_POST['email'] ? $_POST['email'] : '' ?>" />
        </div>
        <div class="col-md-6">
            <label for="telephone">เบอร์โทร</label>
            <input type="text" id="telephone" class="form-control telephone" name="telephone" value="<?= $_POST['telephone'] ? $_POST['telephone'] : '' ?>" pattern="[0-9]{10}" placeholder="xxxxxxxxxx"/>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <font>
                <label for="alive" style="margin-right: 5%;">สถานะสมาชิก</label>
                <input type="radio" id="มีชีวิต" name="alive" value="มีชีวิต" required>
                <label for="มีชีวิต">มีชีวิต</label>
                <input type="radio" id="เสียชีวิต" name="alive" value="เสียชีวิต">
                <label for="เสียชีวิต">เสียชีวิต</label>
            </font>

        </div>
    </div>
    <!-- <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="follower_name">ชื่อผู้ติดต่อ
                <font >(ทายาท ผู้รับผลประโยชน์)</font></label>
            <input type="text" id="follower_name" class="form-control" name="follower_name" value="<?= $_POST['follower_name'] ? $_POST['follower_name'] : '' ?>" />
        </div>
    </div> -->
    <h2>ข้อมูลทายาท</h2>

    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="follower_name">ชื่อ - นามสกุล</label>
            <input type="text" id="follower_name" class="form-control" name="follower_name" value="<?= $_POST['follower_name'] ? $_POST['follower_name'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="follower_date">วัน/เดือน/ปีเกิด <font >สมาชิกมีอายุ (<span id="age2"></span>)</font></label>
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
            <input type="text" id="follower_date" class="datetimepicker2 form-control findage2" name="follower_date" value="<?= $_POST['follower_date'] ? $_POST['follower_date'] : '' ?>" required>
        </div>
        <div class="col-md-4">
            <label for="image2">รูปทายาท</label>
            <input type='file' class="form-control" id="image2" accept="image/*" name="follower_image" />
            <img id="preview_image2" class="img-fluid" src="<?= base_url('files') . '/No_image_available.png' ?>" alt="your image" style="margin: 1%;width: 100px;" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="follower_taxpayer_number">เลขที่บัตรประชาชน</label>
            <input type="number" id="follower_taxpayer_number" class="form-control" name="follower_taxpayer_number" value="<?= $_POST['follower_taxpayer_number'] ? $_POST['follower_taxpayer_number'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="follower_relationship">ความสัมพันธ์กับสมาชิก</label>
            <input type="text" id="follower_relationship" class="form-control" name="follower_relationship" value="<?= $_POST['follower_relationship'] ? $_POST['follower_relationship'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="follower_address">ที่อยู่</label>
            <!-- <input type="text" id="address" class="form-control" name="address" value="<?= $_POST['address'] ? $_POST['address'] : '' ?>"/> -->
            <textarea class="form-control" rows="1" name="follower_address" id="follower_address"><?= $_POST['follower_address'] ?? $_POST['follower_address']  ?></textarea>

        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="follower_email">อีเมล์</label>
            <input type="email" id="follower_email" class="form-control" name="follower_email" value="<?= $_POST['follower_email'] ? $_POST['follower_email'] : '' ?>" />
        </div>
        <div class="col-md-6">
            <label for="follower_telephone">เบอร์โทร</label>
            <input type="text" id="follower_telephone" class="form-control" name="follower_telephone" value="<?= $_POST['follower_telephone'] ? $_POST['follower_telephone'] : '' ?>" pattern="[0-9]{10}" placeholder="xxxxxxxxxx"/>
        </div>
    </div>


    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="follower_account_number">เลขที่บัญชีธนาคาร</label>
            <input type="text" id="follower_account_number" class="form-control" name="follower_account_number" value="<?= $_POST['follower_account_number'] ? $_POST['follower_account_number'] : '' ?>" required  pattern="\d{10}|\d{13}" placeholder="10 ตัว หรือ 13 ตัว"/>
        </div>
        <div class="col-md-6">
            <label for="follower_account_name">ชื่อธนาคาร</label>
            <input type="text" id="follower_account_name" class="form-control" name="follower_account_name" value="<?= $_POST['follower_account_name'] ? $_POST['follower_account_name'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">

            <label for="follower_account_type">ประเภทบัญชี</label>
            <!-- <select class="form-control " name="follower_account_type" id="follower_account_type" required>
                <option selected value="">เลือกประเภทบัญชี</option>
                <option value="1" <?php $_POST['follower_account_type'] == 1 ? print 'selected' : ''; ?>>test</option>
            </select> -->
            <input type="text" id="follower_account_type" class="form-control" name="follower_account_type" value="<?= $_POST['follower_account_type'] ? $_POST['follower_account_type'] : '' ?>" />


        </div>
        <div class="col-md-6">
            <label for="document">แนบเอกสาร</label>
            <input type='file' class="form-control" id="document" name="document" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="branch">สาขา</label>
            <input type="text" id="follower_account_branch" class="form-control" name="follower_account_branch" value="<?= $_POST['follower_account_branch'] ? $_POST['follower_account_branch'] : '' ?>" />
        </div>
    </div>



    <h2>ชื่อผู้ติดต่อ กรณีฉุกเฉิน</h2>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="emergency_name">ชื่อ - นามสกุล</label>
            <input type="text" id="emergency_name" class="form-control" name="emergency_name" value="<?= $_POST['emergency_name'] ? $_POST['emergency_name'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="emergency_date">วัน/เดือน/ปีเกิด <font >สมาชิกมีอายุ (<span id="age3"></span>)</font></label>
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
            <input type="text" id="emergency_date" class="datetimepicker2 form-control findage3" name="emergency_date" value="<?= $_POST['emergency_date'] ? $_POST['emergency_date'] : '' ?>" required>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="emergency_taxpayer_number">เลขที่บัตรประชาชน</label>
            <input type="number" id="emergency_taxpayer_number" class="form-control" name="emergency_taxpayer_number" value="<?= $_POST['emergency_taxpayer_number'] ? $_POST['emergency_taxpayer_number'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="relationship">ความสัมพันธ์กับสมาชิก</label>
            <input type="text" id="relationship" class="form-control" name="relationship" value="<?= $_POST['relationship'] ? $_POST['relationship'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="emergency_address">ที่อยู่</label>
            <!-- <input type="text" id="address" class="form-control" name="address" value="<?= $_POST['address'] ? $_POST['address'] : '' ?>"/> -->
            <textarea class="form-control" rows="1" name="emergency_address" id="emergency_address"><?= $_POST['emergency_address'] ?? $_POST['emergency_address']  ?></textarea>

        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="emergency_email">อีเมล์</label>
            <input type="email" id="emergency_email" class="form-control" name="emergency_email" value="<?= $_POST['emergency_email'] ? $_POST['emergency_email'] : '' ?>" />
        </div>
        <div class="col-md-6">
            <label for="emergency_telephone">เบอร์โทร</label>
            <input type="text" id="emergency_telephone" class="form-control" name="emergency_telephone" value="<?= $_POST['emergency_telephone'] ? $_POST['emergency_telephone'] : '' ?>" pattern="[0-9]{10}" placeholder="xxxxxxxxxx"/>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="emergency_account_number">เลขที่บัญชีธนาคาร</label>
            <input type="text" id="emergency_account_number" class="form-control" name="emergency_account_number" value="<?= $_POST['emergency_account_number'] ? $_POST['emergency_account_number'] : '' ?>" required  pattern="\d{10}|\d{13}" placeholder="10 ตัว หรือ 13 ตัว"/>
        </div>
        <div class="col-md-6">
            <label for="emergency_account_name">ชื่อธนาคาร</label>
            <input type="text" id="emergency_account_name" class="form-control" name="emergency_account_name" value="<?= $_POST['emergency_account_name'] ? $_POST['emergency_account_name'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">

            <label for="emergency_account_type">ประเภทบัญชี</label>
            <!-- <select class="form-control " name="emergency_account_type" id="emergency_account_type" required>
                <option selected value="">เลือกประเภทบัญชี</option>
                <option value="1" <?php $_POST['emergency_account_type'] == 1 ? print 'selected' : ''; ?>>test</option>
            </select> -->
            <input type="text" id="emergency_account_type" class="form-control" name="emergency_account_type" value="<?= $_POST['emergency_account_type'] ? $_POST['emergency_account_type'] : '' ?>" />

        </div>
        <div class="col-md-6">
            <label for="emergency_document">แนบเอกสาร</label>
            <input type='file' class="form-control" id="emergency_document" name="emergency_document" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="branch">สาขา</label>
            <input type="text" id="emergency_account_branch" class="form-control" name="emergency_account_branch" value="<?= $_POST['emergency_account_branch'] ? $_POST['emergency_account_branch'] : '' ?>" />
        </div>
    </div>

    <!-- <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="">รหัสสมาชิก</label>
            <input type="text" disabled id="" class="form-control" name="" value="MOPH-<?php echo sprintf('%07d', $id); ?>" />
        </div>


        <div class="col-md-4">
            <label for="postal_code">รหัสไปรษณี</label>
            <input type="number" id="postal_code" class="form-control" name="postal_code" value="<?= $_POST['postal_code'] ? $_POST['postal_code'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="note">หมายเหตุ</label>
            <input type="text" id="note" class="form-control" name="note" value="<?= $_POST['note'] ? $_POST['note'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="branch">สาขา</label>
            <input type="text" id="branch" class="form-control" name="branch" value="<?= $_POST['branch'] ? $_POST['branch'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="payout_type"> อัตราเรียกเก็บ</label>
            <input type="text" id="payout_type" class="form-control" name="payout_type" value="<?= $_POST['payout_type'] ? $_POST['payout_type'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="tax_rate">อัตราภาษี ณ ที่หัก</label>
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
            <label for="unit">เครดิต(วัน)</label>
            <input type="number" id="unit" class="form-control" name="unit" value="<?= $_POST['unit'] ? $_POST['unit'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="vat">ภาษีมูลค่าเพิ่ม(VAT)</label>
            <input type="number" id="vat" class="form-control" name="vat" value="<?= $_POST['vat'] ? $_POST['vat'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="discount">ส่วนลด</label>
            <input type="number" id="discount" class="form-control" name="discount" value="<?= $_POST['discount'] ? $_POST['discount'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="approval_limit">วงเงินอนุมัติ</label>
            <input type="number" id="approval_limit" class="form-control" name="approval_limit" value="<?= $_POST['approval_limit'] ? $_POST['approval_limit'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="total_early_year">ยอดต้นปี(บาท)</label>
            <input type="number" id="total_early_year" class="form-control" name="total_early_year" value="<?= $_POST['total_early_year'] ? $_POST['total_early_year'] : '' ?>" />
        </div>
        <div class="col-md-4">
            <label for="balance">ยอดคงเหลือ(บาท)</label>
            <input type="number" id="balance" class="form-control" name="balance" value="<?= $_POST['balance'] ? $_POST['balance'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="prepaid_checks">เช็คจ่ายล่วงหน้า</label>
            <input type="text" id="prepaid_checks" class="form-control" name="prepaid_checks" value="<?= $_POST['prepaid_checks'] ? $_POST['prepaid_checks'] : '' ?>" />
        </div>
    </div> -->
    <div class="row">
        <div class="col-md-12" style="margin-top: 1%;text-align: right;">
            <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary " value="เคลียร์" />
        </div>
    </div>
</form>