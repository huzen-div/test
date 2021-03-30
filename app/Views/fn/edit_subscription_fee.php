<form method="post" action="<?= base_url('finance/edit_subscription_fee/' . $data[0]['id']) ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="write_at">เขียนที่</label>
            <input type="text" id="write_at" class="form-control" name="write_at" value="<?= $data[0]['write_at'] ? $data[0]['write_at'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-7">
            <label for="date">วันที่</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="sub_name">ข้าพเจ้า</label>
            <input type="text" id="sub_name" class="form-control" name="sub_name" value="<?= $data[0]['sub_name'] ? $data[0]['sub_name'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="birthday">เกิดวันที่</label>
            <input type="text" id="birthday" class="datetimepicker2 form-control" name="birthday" value="<?= $data[0]['birthday'] ? $data[0]['birthday'] : '' ?>" required>
        </div>
        <div class="col-md-3">
            <label for="age">อายุ(ปี)</label>
            <input type="number" id="age" class="form-control" name="age" value="<?= $data[0]['age'] ? $data[0]['age'] : '' ?>" required readonly />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="id_card">เลขบัตรประจำตัวประชาชน</label>
            <input type="number" id="id_card" class="form-control" name="id_card" value="<?= $data[0]['id_card'] ? $data[0]['id_card'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <font>
                <label style="margin-right: 5%;">เป็น</label>
                <input type="radio" id="ข้าราชการ" name="career" value="1" <?php $data[0]['career'] == '1' ? print 'checked' : ''; ?> required>
                <label for="ข้าราชการ" style="margin-right: 1%;">ข้าราชการ</label>
                <input type="radio" id="พนักงานข้าราชการ" name="career" value="2" <?php $data[0]['career'] == '2' ? print 'checked' : ''; ?>>
                <label for="พนักงานข้าราชการ" style="margin-right: 1%;">พนักงานราชการ</label>
                <input type="radio" id="พนักงานกระทรวง" name="career" value="3" <?php $data[0]['career'] == '3' ? print 'checked' : ''; ?>>
                <label for="พนักงานกระทรวง" style="margin-right: 1%;">พนักงานกระทรวง</label>
                <input type="radio" id="ลูกจ้างชั่วคราว" name="career" value="4" <?php $data[0]['career'] == '4' ? print 'checked' : ''; ?>>
                <label for="ลูกจ้างชั่วคราว" style="margin-right: 1%;">ลูกจ้างชั่วคราว</label>
                <input type="radio" id="อื่นๆ" name="career" value="5" <?php $data[0]['career'] == '5' ? print 'checked' : ''; ?>>
                <label for="อื่นๆ">อื่นๆ</label>
            </font>
        </div>
        <!-- <div class="col-md-3">
            <input type="text" id="career_another" class="form-control" name="career_another" value="<?= $data[0]['career_another'] ? $data[0]['career_another'] : '' ?>" required />
        </div> -->
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="position">ตำแหน่ง</label>
            <input type="text" id="position" class="form-control" name="position" value="<?= $data[0]['position'] ? $data[0]['position'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="at_work">ปฎิบัติงานที่</label>
            <input type="text" id="at_work" class="form-control" name="at_work" value="<?= $data[0]['at_work'] ? $data[0]['at_work'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="payroll_location">สถานที่รับเงินเดือนหรือค่าจ้าง</label>
            <input type="text" id="payroll_location" class="form-control" name="payroll_location" value="<?= $data[0]['payroll_location'] ? $data[0]['payroll_location'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <label for="house_number">ที่อยู่ปัจจุบัน บ้านเลขที่</label>
            <input type="text" id="house_number" class="form-control" name="house_number" value="<?= $data[0]['house_number'] ? $data[0]['house_number'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="swine">หมู่ที่</label>
            <input type="text" id="swine" class="form-control" name="swine" value="<?= $data[0]['swine'] ? $data[0]['swine'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="alley">ซอย/ตรอก</label>
            <input type="text" id="alley" class="form-control" name="alley" value="<?= $data[0]['alley'] ? $data[0]['alley'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="street">ถนน</label>
            <input type="text" id="street" class="form-control" name="street" value="<?= $data[0]['street'] ? $data[0]['street'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-3">
            <label for="canton">ตำบล/แขวง</label>
            <input type="text" id="canton" class="form-control" name="canton" value="<?= $data[0]['canton'] ? $data[0]['canton'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="district">อำเภอ/เขต</label>
            <input type="text" id="district" class="form-control" name="district" value="<?= $data[0]['district'] ? $data[0]['district'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="province">จังหวัด</label>
            <input type="text" id="province" class="form-control" name="province" value="<?= $data[0]['province'] ? $data[0]['province'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="postal_code">รหัสไปรษณีย์</label>
            <input type="text" id="postal_code" class="form-control" name="postal_code" value="<?= $data[0]['postal_code'] ? $data[0]['postal_code'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="phone">โทรศัพท์</label>
            <input type="text" id="phone" class="form-control" name="phone" value="<?= $data[0]['phone'] ? $data[0]['phone'] : '' ?>" required />
        </div>
        <div class="col-md-8">
            <label for="email">ไปรษณีย์อิเล็กทรอนิกส์ (E-mail)</label>
            <input type="email" id="email" class="form-control" name="email" value="<?= $data[0]['email'] ? $data[0]['email'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="withdrawal">ขอสมัครเป็นสมาชิก ฌกส.</label>
        </div>
    </div>
    <div class="row" style="margin-left: 5%;margin-bottom: 1%;">
        <div class="col-md-12">
            <font>
                <input type="radio" class="sub_type" id="สามัญ" name="sub_type" value="1" <?php $data[0]['sub_type'] == '1' ? print 'checked' : ''; ?> required>
                <label for="สามัญ">ประเภท สามัญ และยินยอมให้หน่วยงานต้นสังกัดหักเงินเดือนเพื่อชำระเงินสงเคราะห์</label>
            </font>
        </div>
    </div>
    <div class="row" style="margin-left: 5%;margin-bottom: 1%;">
        <div class="col-md-12">
            <font>
                <input type="radio" class="sub_type" id="สมทบ" name="sub_type" value="2" <?php $data[0]['sub_type'] == '2' ? print 'checked' : ''; ?> required>
                <label for="สมทบ">ประเภท สมทบ โดยเป็น</label>
            </font>
        </div>
    </div>
    <div class="row" style="margin-left: 10%;margin-bottom: 1%;">
        <div class="col-md-5">
            <font>
                <input type="radio" class="sub_for" id="บุตร" name="sub_for" value="1" <?php $data[0]['sub_for'] == '1' ? print 'checked' : ''; ?> required>
                <label for="บุตร">บุตร</label>
                <input type="radio" class="sub_for" id="คู่สมรส" name="sub_for" value="2" <?php $data[0]['sub_for'] == '2' ? print 'checked' : ''; ?>>
                <label for="คู่สมรส">คู่สมรส</label>
                <input type="radio" class="sub_for" id="บิดา" name="sub_for" value="3" <?php $data[0]['sub_for'] == '3' ? print 'checked' : ''; ?>>
                <label for="บิดา">บิดา</label>
                <input type="radio" class="sub_for" id="มารดา" name="sub_for" value="4" <?php $data[0]['sub_for'] == '4' ? print 'checked' : ''; ?>>
                <label for="มารดา">มารดา</label>
                <input type="radio" class="sub_for" id="พี่น้อง" name="sub_for" value="5" <?php $data[0]['sub_for'] == '5' ? print 'checked' : ''; ?>>
                <label for="พี่น้อง">พี่น้องร่วมบิดามารดาเดียวกัน</label>
            </font>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="sub_relationships">ของสมาชิกสามัญเลขทะเบียน</label>
            <input type="number" id="sub_relationships" class="form-control sub_for" name="sub_relationships" value="<?= $data[0]['sub_relationships'] ? $data[0]['sub_relationships'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="date" style="margin-bottom: 1%;">และยินยอมชำระเงินสงเคราะห์โดย</label><br>
            <font>
                <input type="radio" class="sub_for" id="รายปี" name="yearly_monthly" value="1" <?php $data[0]['yearly_monthly'] == '1' ? print 'checked' : ''; ?> required>
                <label for="รายปี" style="margin-bottom: 1%; margin-right: 1%;">ชำระล่วงหน้ารายปี หรือ</label>
                <input type="radio" class="sub_for" id="รายเดือน" name="yearly_monthly" value="2" <?php $data[0]['yearly_monthly'] == '2' ? print 'checked' : ''; ?>>
                <label for="รายเดือน">ชำระรายเดือน</label>
            </font>
        </div>
    </div>

    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <font>
                <label style="margin-right: 1%;">โดยยินยอมให้</label>
                <input type="radio" class="sub_for type_payment" id="เงินเดือน" name="type_payment" value="1" <?php $data[0]['type_payment'] == '1' ? print 'checked' : ''; ?> required>
                <label for="เงินเดือน" style="margin-right: 1%;">หักเงินเดือนจากผู้สมัครสมาชิก หรือ</label>
                <input type="radio" class="sub_for type_payment" id="ธนาคาร" name="type_payment" value="2" <?php $data[0]['type_payment'] == '2' ? print 'checked' : ''; ?>>
                <label for="ธนาคาร">หักเงินจากธนาคาร</label>
            </font>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="account_name">ชื่อบัญชี</label>
            <input type="text" id="account_name" class="form-control type_payment_detail" name="account_name" value="<?= $data[0]['account_name'] ? $data[0]['account_name'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="account_number">บัญชีเลขที่</label>
            <input type="text" id="account_number" class="form-control type_payment_detail" name="account_number" value="<?= $data[0]['account_number'] ? $data[0]['account_number'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="withdrawal" style="margin-left: 5%;">ข้าพเจ้าขอรับรองว่าจะปฏิบัติตามข้อบังคับกระทรวงสาธาารณสุข ว่าด้วยการฌาปนกิจสงเคราะห์ของ กระทรวงสาธารณสุข พ.ศ.๒๕๖๑ และที่แก้ไขเพิ่มเติมทุกประการ</label>

        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="withdrawal" style="margin-left: 5%;">ข้าพเจ้าขอระบุชื่อผู้จัดการศพและหรือผู้มีสิทธิรับเงินสงเคราะห์ ดังต่อไปนี้</label>

        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="funeral_name">๑. ชื่อผู้จัดการศพ</label>
            <input type="text" id="funeral_name" class="form-control" name="funeral_name" value="<?= $data[0]['funeral_name'] ? $data[0]['funeral_name'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="funeral_concerned">เกี่ยวข้องเป็น</label>
            <input type="text" id="funeral_concerned" class="form-control" name="funeral_concerned" value="<?= $data[0]['funeral_concerned'] ? $data[0]['funeral_concerned'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="funeral_address">ที่อยู่</label>
            <input type="text" id="funeral_address" class="form-control" name="funeral_address" value="<?= $data[0]['funeral_address'] ? $data[0]['funeral_address'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="funeral_tel">โทรศัพท์</label>
            <input type="text" id="funeral_tel" class="form-control" name="funeral_tel" value="<?= $data[0]['funeral_tel'] ? $data[0]['funeral_tel'] : '' ?>" required pattern="[0-9]{10}" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label>๒.ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์</label>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="recipient_name1">(๑)</label>
            <input type="text" id="recipient_name1" class="form-control" name="recipient_name1" value="<?= $data[0]['recipient_name1'] ? $data[0]['recipient_name1'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="recipient_concerned1">เกี่ยวข้องเป็น</label>
            <input type="text" id="recipient_concerned1" class="form-control" name="recipient_concerned1" value="<?= $data[0]['recipient_concerned1'] ? $data[0]['recipient_concerned1'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="recipient_address1">ที่อยู่</label>
            <input type="text" id="recipient_address1" class="form-control" name="recipient_address1" value="<?= $data[0]['recipient_address1'] ? $data[0]['recipient_address1'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="recipient_tel1">โทรศัพท์</label>
            <input type="text" id="recipient_tel1" class="form-control" name="recipient_tel1" value="<?= $data[0]['recipient_tel1'] ? $data[0]['recipient_tel1'] : '' ?>" required pattern="[0-9]{10}" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="recipient_name2">(๒)</label>
            <input type="text" id="recipient_name2" class="form-control" name="recipient_name2" value="<?= $data[0]['recipient_name2'] ? $data[0]['recipient_name2'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="recipient_concerned2">เกี่ยวข้องเป็น</label>
            <input type="text" id="recipient_concerned2" class="form-control" name="recipient_concerned2" value="<?= $data[0]['recipient_concerned2'] ? $data[0]['recipient_concerned2'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="recipient_address2">ที่อยู่</label>
            <input type="text" id="recipient_address2" class="form-control" name="recipient_address2" value="<?= $data[0]['recipient_address2'] ? $data[0]['recipient_address2'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="recipient_tel2">โทรศัพท์</label>
            <input type="text" id="recipient_tel2" class="form-control" name="recipient_tel2" value="<?= $data[0]['recipient_tel2'] ? $data[0]['recipient_tel2'] : '' ?>" required pattern="[0-9]{10}" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="recipient_name3">(๓)</label>
            <input type="text" id="recipient_name3" class="form-control" name="recipient_name3" value="<?= $data[0]['recipient_name3'] ? $data[0]['recipient_name3'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="recipient_concerned3">เกี่ยวข้องเป็น</label>
            <input type="text" id="recipient_concerned3" class="form-control" name="recipient_concerned3" value="<?= $data[0]['recipient_concerned3'] ? $data[0]['recipient_concerned3'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="recipient_address3">ที่อยู่</label>
            <input type="text" id="recipient_address3" class="form-control" name="recipient_address3" value="<?= $data[0]['recipient_address3'] ? $data[0]['recipient_address3'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="recipient_tel3">โทรศัพท์</label>
            <input type="text" id="recipient_tel3" class="form-control" name="recipient_tel3" value="<?= $data[0]['recipient_tel3'] ? $data[0]['recipient_tel3'] : '' ?>" required pattern="[0-9]{10}" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-8">
            <label for="recipient_name4">(๔)</label>
            <input type="text" id="recipient_name4" class="form-control" name="recipient_name4" value="<?= $data[0]['recipient_name4'] ? $data[0]['recipient_name4'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="recipient_concerned4">เกี่ยวข้องเป็น</label>
            <input type="text" id="recipient_concerned4" class="form-control" name="recipient_concerned4" value="<?= $data[0]['recipient_concerned4'] ? $data[0]['recipient_concerned4'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="recipient_address4">ที่อยู่</label>
            <input type="text" id="recipient_address4" class="form-control" name="recipient_address4" value="<?= $data[0]['recipient_address4'] ? $data[0]['recipient_address4'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="recipient_tel4">โทรศัพท์</label>
            <input type="text" id="recipient_tel4" class="form-control" name="recipient_tel4" value="<?= $data[0]['recipient_tel4'] ? $data[0]['recipient_tel4'] : '' ?>" required pattern="[0-9]{10}" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12" style="margin-top: 1%;text-align: left;">
            <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary " value="เคลียร์" />
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        // $('.sub_type').change(function() {
        //     if ($('.sub_type:checked').val() == '2') {
        //         $('.sub_for').prop('disabled', false);
        //         $(".sub_for").prop('required', true);

        //     } else {
        //         $(".sub_for").prop('required', false);
        //         $('.sub_for').prop('disabled', true);
        //     }
        //     $(".type_payment").trigger("change");
        // });
        // $('.type_payment').change(function() {
        //     if ($('.sub_type:checked').val() == '2') {
        //         if ($('.type_payment:checked').val() == '2') {
        //             $('.type_payment_detail').prop('disabled', false);
        //             $(".type_payment_detail").prop('required', true);

        //         } else {
        //             $(".type_payment_detail").prop('required', false);
        //             $('.type_payment_detail').prop('disabled', true);
        //         }
        //     } else {
        //         $(".type_payment_detail").prop('required', false);
        //         $('.type_payment_detail').prop('disabled', true);
        //     }
        // });

        $("#birthday").change(function() {
            var test = $(this).val().split('/');
            var test1 = test[1] + '/' + test[0] + '/' + test[2];

            var date = new Date(test1);
            var today = new Date();

            var year = today.getFullYear() + 543;
            var month = today.getMonth();
            var day = today.getDate();

            var today = new Date(year, month, day);
            var age = Math.floor((today - date) / (365.25 * 24 * 60 * 60 * 1000));
            $("#age").val(age);
        });
        $("#birthday").trigger("change");
        // $(".sub_type").trigger("change");
        // $(".type_payment").trigger("change");
    });
</script>