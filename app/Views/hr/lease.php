<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('hire/lease') ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="no">เลขพัสดุ</label>
                <input type="number" id="no" class="form-control" name="no" value="<?= $_POST['no'] ? $_POST['no'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="name">โครงการจัดจ้าง</label>
                <input type="text" id="name" class="form-control" name="name" value="<?= $_POST['name'] ? $_POST['name'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="responsible_id">ผู้รับผิดชอบ</label>
                <input type="text" id="responsible_id" class="form-control" name="responsible_id" value="<?= $_POST['responsible_id'] ? $_POST['responsible_id'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="status">สถานะเช่า</label>
                <select class="form-control" name="status" id="status" required>
                    <option selected value="">เลือกสถานะเช่า</option>
                    <option value="1" <?php $_POST['status'] == 1 ? print 'selected' : ''; ?>>เรียบร้อย</option>
                    <option value="2" <?php $_POST['status'] == 2 ? print 'selected' : ''; ?>>ระหว่างดำเนินการ</option>
                    <option value="3" <?php $_POST['status'] == 3 ? print 'selected' : ''; ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="agency">หน่วยงาน</label>
                <input type="text" id="agency" class="form-control" name="agency" value="<?= $_POST['agency'] ? $_POST['agency'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="type_id" style="margin-right: 5%;">ประเภท</label>
                <input type="radio" id="consumables" name="type_id" value="1" <?php $_POST['type_id'] == 1 ? print 'checked' : ''; ?> required>
                <label for="consumables" style="margin-right: 2%;">วัสดุสิ้นเปลือง</label>
                <input type="radio" id="asset" name="type_id" value="2" <?php $_POST['type_id'] == 2 ? print 'checked' : ''; ?>>
                <label for="asset" style="margin-right: 2%;">สินทรัพย์</label>
                <input type="radio" id="material" name="type_id" value="3" <?php $_POST['type_id'] == 3 ? print 'checked' : ''; ?>>
                <label for="material" style="margin-right: 2%;">วัตถุดิบ</label>
                <input type="radio" id="other" name="type_id" value="4" <?php $_POST['type_id'] == 4 ? print 'checked' : ''; ?>>
                <label for="other">อื่นๆ</label>
            </div>
        </div><br>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="number">เบอร์ภายใน</label>
                <input type="text" id="number" class="form-control" name="number" value="<?= $_POST['number'] ? $_POST['number'] : '' ?>" pattern="[0-9]{10}" placeholder="xxxxxxxxxx" />
            </div>
            <div class="col-md-6">
                <label for="document">เอกสารแนบ</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="document" name="document" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="document2">เอกสารแนบ2</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document2" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="document2" name="document2" />
            </div>
            <div class="col-md-6">
                <label for="document3">เอกสารแนบ3</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document3" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="document3" name="document3" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <!-- <label for="tax_invoice_id">ใบสั่ง ภาษี</label>
                <select class="form-control" name="tax_invoice_id" id="tax_invoice_id" required>
                    <option selected value="">เลือกใบสั่ง ภาษี</option>
                    <?php foreach ($tax as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['tax_invoice_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                    <?php } ?>
                </select> -->
                <label for="tax_invoice_id">ใบสั่งเช่า</label>
                <input type="text" id="tax_invoice_id" class="form-control" name="tax_invoice_id" value="<?= $_POST['tax_invoice_id'] ? $_POST['tax_invoice_id'] : '' ?>">
            </div>
            <div class="col-md-4">
                <label for="discount">ส่วนลด (ถ้ามี)</label>
                <input type="text" id="discount" class="form-control money" name="discount" value="<?= $_POST['discount'] ? $_POST['discount'] : 0 ?>">
            </div>
            <div class="col-md-4">
                <label for="type_maintenance">ประเภทเช่า (เช่น อาคาร, อุปกรณ์)</label>
                <input type="text" id="type_maintenance" class="form-control" name="type_maintenance" value="<?= $_POST['type_maintenance'] ? $_POST['type_maintenance'] : '' ?>">
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="payment_term">Payment term</label>
                <input type="text" id="payment_term" class="form-control" name="payment_term" value="<?= $_POST['payment_term'] ? $_POST['payment_term'] : '' ?>">
                <!-- <textarea class="form-control" rows="1" name="payment_term" id="payment_term"><?= $_POST['payment_term'] ?? $_POST['payment_term']  ?></textarea> -->
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">อื่นๆ</label>
                <textarea class="form-control" rows="3" name="note" id="note"><?= $_POST['note'] ?? $_POST['note']  ?></textarea>
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
    setInputFilter(document.getElementById("number"), function(value) {
        return /^-?\d*$/.test(value);
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

    });
</script>