<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('hire/supply') ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="operator">ผู้ประสงค์จัดหา</label>
                <input type="text" id="operator" class="form-control" name="operator" value="<?= $_POST['operator'] ? $_POST['operator'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="method">วิธีการจัดหา</label>
                <!-- <input type="text" id="method" class="form-control" name="method" value="<?= $_POST['method'] ? $_POST['method'] : '' ?>" required /> -->
                <select class="form-control" name="method" id="method" required>
                    <option selected value="">เลือกวิธีการจัดหา</option>
                    <option value="1" <?php $_POST['method'] == 1 ? print 'selected' : ''; ?>>ตกลงราคา</option>
                    <option value="2" <?php $_POST['method'] == 2 ? print 'selected' : ''; ?>>สอบราคา</option>
                    <option value="3" <?php $_POST['method'] == 3 ? print 'selected' : ''; ?>>วิธีพิเศษ</option>
                    <!-- <option value="4" <?php $_POST['method'] == 4 ? print 'selected' : ''; ?>>อื่นๆ</option> -->
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="agency">ฝ่ายงาน</label>
                <input type="text" id="agency" class="form-control" name="agency" value="<?= $_POST['agency'] ? $_POST['agency'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="financial_amount">วงเงิน</label>
                <input type="text" id="financial_amount" class="form-control money" name="financial_amount" value="<?= $_POST['financial_amount'] ? $_POST['financial_amount'] : 0 ?>" required />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="type" style="margin-right: 3%;">ประเภท</label>
                <input type="radio" id="นิติบุคคล" name="type" value="1" required <?php $_POST['type'] == 1 ? print 'checked' : ''; ?>>
                <label for="นิติบุคคล" style="margin-right: 1%;">นิติบุคคล</label>
                <input type="radio" id="ผู้รับเหมา" name="type" value="2" <?php $_POST['type'] == 2 ? print 'checked' : ''; ?>>
                <label for="ผู้รับเหมา" style="margin-right: 1%;">ผู้รับเหมา</label>
                <input type="radio" id="บุคคลทั่วไป" name="type" value="3" <?php $_POST['type'] == 3 ? print 'checked' : ''; ?>>
                <label for="บุคคลทั่วไป" style="margin-right: 1%;">บุคคลทั่วไป</label>
                <input type="radio" id="ภาครัฐ" name="type" value="4" <?php $_POST['type'] == 3 ? print 'checked' : ''; ?>>
                <label for="ภาครัฐ" style="margin-right: 1%;">ภาครัฐ / คู่ค้า</label>
            </div>
        </div><br>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="contract">กำหนดเวลาที่ต้องใช้</label>
                <!-- <select class="form-control" name="contract" id="contract" required>
                    <option selected value="">เลือกกำหนดเวลาที่ต้องใช้การจ้าง</option>
                    <option value="1" <?php $_POST['contract'] == 1 ? print 'selected' : ''; ?>>วิธี E-Bidding</option>
                    <option value="2" <?php $_POST['contract'] == 2 ? print 'selected' : ''; ?>>วิธีแบบพิเศษ</option>
                    <option value="3" <?php $_POST['contract'] == 3 ? print 'selected' : ''; ?>>วิธีจัดหา</option>
                    <option value="4" <?php $_POST['contract'] == 4 ? print 'selected' : ''; ?>>วิธีตกลงราคา</option>
                </select> -->
                <input type="text" id="contract" class="form-control" name="contract" value="<?= $_POST['contract'] ? $_POST['contract'] : '' ?>" required />
            </div>
            <div class="col-md-4">
                <label for="share">แบ่งจ่าย %</label>
                <input type="text" id="share" class="form-control money" name="share" value="<?= $_POST['share'] ? $_POST['share'] : 0 ?>" required />
            </div>
            <div class="col-md-4">
                <label for="document">เอกสารแนบ</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document" title="กดเพื่อลบไฟล์" ><i class="fas fa-minus-circle" ></i></span>
                <input type='file' class="form-control" id="document" name="document" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="period">งวดงาน</label>
                <input type="text" id="period" class="form-control" name="period" value="<?= $_POST['period'] ? $_POST['period'] : '' ?>" required />
            </div>
            <div class="col-md-4">
                <label for="document2">เอกสารแนบ2</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document2" title="กดเพื่อลบไฟล์" ><i class="fas fa-minus-circle" ></i></span>
                <input type='file' class="form-control" id="document2" name="document2" />
            </div>
            <div class="col-md-4">
                <label for="document3">เอกสารแนบ3</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document3" title="กดเพื่อลบไฟล์" ><i class="fas fa-minus-circle" ></i></span>
                <input type='file' class="form-control" id="document3" name="document3" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-8">
                <label for="note">เหตุผลความจำเป็น</label>
                <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
            </div>
            <div class="col-md-4">
                <div class="col-md-12 ">
                    <label for="amount">จำนวนเงิน (หน่วย:บาท)</label>
                    <input type="text" id="amount" class="form-control vat money" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : 0 ?>" />
                </div>
                <div class="col-md-12">
                    <label for="vat">ภาษีมูลค่าเพิ่ม (7%)</label>
                    <input type="text" id="vat" name="tax" class="form-control money" readonly />
                </div>
                <div class="col-md-12">
                    <label for="total">จำนวนเงินทั้งสิ้น (หน่วย:บาท)</label>
                    <input type="text" id="total" name="total" class="form-control money" readonly />
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-2">
                <label for="director_name1">1.ชื่อกรรมการ</label>
                <input type="text" id="director_name1" class="form-control" name="director_name1" value="<?= $_POST['director_name1'] ? $_POST['director_name1'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="position1">1.ตำแหน่ง</label>
                <input type="text" id="position1" class="form-control" name="position1" value="<?= $_POST['position1'] ? $_POST['position1'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="director_name2">2.ชื่อกรรมการ</label>
                <input type="text" id="director_name2" class="form-control" name="director_name2" value="<?= $_POST['director_name2'] ? $_POST['director_name2'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="position2">2.ตำแหน่ง</label>
                <input type="text" id="position2" class="form-control" name="position2" value="<?= $_POST['position2'] ? $_POST['position2'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="director_name3">3.ชื่อกรรมการ</label>
                <input type="text" id="director_name3" class="form-control" name="director_name3" value="<?= $_POST['director_name3'] ? $_POST['director_name3'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="position3">3.ตำแหน่ง</label>
                <input type="text" id="position3" class="form-control" name="position3" value="<?= $_POST['position3'] ? $_POST['position3'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-2">
                <label for="director_name4">4.ชื่อกรรมการ</label>
                <input type="text" id="director_name4" class="form-control" name="director_name4" value="<?= $_POST['director_name4'] ? $_POST['director_name4'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="position4">4.ตำแหน่ง</label>
                <input type="text" id="position4" class="form-control" name="position4" value="<?= $_POST['position4'] ? $_POST['position4'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="director_name5">5.ชื่อกรรมการ</label>
                <input type="text" id="director_name5" class="form-control" name="director_name5" value="<?= $_POST['director_name5'] ? $_POST['director_name5'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="position5">5.ตำแหน่ง</label>
                <input type="text" id="position5" class="form-control" name="position5" value="<?= $_POST['position5'] ? $_POST['position5'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="director_name6">6.ชื่อกรรมการ</label>
                <input type="text" id="director_name6" class="form-control" name="director_name6" value="<?= $_POST['director_name6'] ? $_POST['director_name6'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="position6">6.ตำแหน่ง</label>
                <input type="text" id="position6" class="form-control" name="position6" value="<?= $_POST['position6'] ? $_POST['position6'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>
<script>
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

    });
</script>