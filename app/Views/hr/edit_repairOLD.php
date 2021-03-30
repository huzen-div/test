<form method="post" action="<?= base_url('hire/edit_repair') . '/' . $data[0]['id'] ?>" enctype="multipart/form-data">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="no">เลขพัสดุ</label>
            <input type="number" id="no" class="form-control" name="no" value="<?= $data[0]['no'] ? $data[0]['no'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="name">โครงการจัดจ้าง</label>
            <input type="text" id="name" class="form-control" name="name" value="<?= $data[0]['name'] ? $data[0]['name'] : '' ?>" required>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="responsible_id">ผู้รับผิดชอบ</label>
            <input type="text" id="responsible_id" class="form-control" name="responsible_id" value="<?= $data[0]['responsible_id'] ? $data[0]['responsible_id'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="status">สถานะซ่อม</label>
            <select class="form-control" name="status" id="status" required>
                <option selected value="">เลือกสถานะซ่อม</option>
                <option value="1" <?php $data[0]['status'] == 1 ? print 'selected' : ''; ?>>ซ่อมแล้ว</option>
                <option value="2" <?php $data[0]['status'] == 2 ? print 'selected' : ''; ?>>ระว่างดำเนินการ</option>
                <option value="3" <?php $data[0]['status'] == 3 ? print 'selected' : ''; ?>>ยกเลิก</option>
            </select>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="agency">หน่วยงาน</label>
            <input type="text" id="agency" class="form-control" name="agency" value="<?= $data[0]['agency'] ? $data[0]['agency'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="date">วันที่</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="type_id" style="margin-right: 5%;">ประเภท</label>
            <input type="radio" id="consumables" name="type_id" value="1" <?php $data[0]['type_id'] == 1 ? print 'checked' : ''; ?> required>
            <label for="consumables" style="margin-right: 2%;">วัสดุสิ้นเปลือง</label>
            <input type="radio" id="asset" name="type_id" value="2" <?php $data[0]['type_id'] == 2 ? print 'checked' : ''; ?>>
            <label for="asset" style="margin-right: 2%;">สินทรัพย์</label>
            <input type="radio" id="material" name="type_id" value="3" <?php $data[0]['type_id'] == 3 ? print 'checked' : ''; ?>>
            <label for="material" style="margin-right: 2%;">วัตถุดิบ</label>
            <input type="radio" id="other" name="type_id" value="4" <?php $data[0]['type_id'] == 4 ? print 'checked' : ''; ?>>
            <label for="other">อื่นๆ</label>
        </div>
    </div><br>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="number">เบอร์ภายใน</label>
            <input type="text" id="number" class="form-control" name="number" value="<?= $data[0]['number'] ? $data[0]['number'] : '' ?>" pattern="[0-9]{10}" placeholder="xxxxxxxxxx" />
        </div>
        <div class="col-md-6">
            <label for="document">เอกสารแนบ</label>
            <input type='file' class="form-control" id="document" name="document" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="tax_invoice_id">ใบสั่ง ภาษี</label>
            <select class="form-control" name="tax_invoice_id" id="tax_invoice_id" required>
                <option selected value="">เลือกใบสั่ง ภาษี</option>
                <?php foreach ($tax as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['tax_invoice_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="discount">ส่วนลด (5/5%)</label>
            <input type="text" id="discount" class="form-control money" name="discount" value="<?= $data[0]['discount'] ? $data[0]['discount'] : 0 ?>">
        </div>
        <div class="col-md-4">
            <label for="type_maintenance">ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)</label>
            <input type="text" id="type_maintenance" class="form-control" name="type_maintenance" value="<?= $data[0]['type_maintenance'] ? $data[0]['type_maintenance'] : '' ?>">
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="payment_term">Payment term</label>
            <input type="text" id="payment_term" class="form-control" name="payment_term" value="<?= $data[0]['payment_term'] ? $data[0]['payment_term'] : '' ?>">
            <!-- <textarea class="form-control" rows="1" name="payment_term" id="payment_term"><?= $data[0]['payment_term'] ?? $data[0]['payment_term']  ?></textarea> -->
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">อื่นๆ</label>
            <textarea class="form-control" rows="3" name="note" id="note"><?= $data[0]['note'] ?? $data[0]['note']  ?></textarea>
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
</script>