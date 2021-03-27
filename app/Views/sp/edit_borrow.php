<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('supplies/edit_borrow') . '/' . $data[0]['id'] ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-3">
                <label for="date">วันที่ยืม</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
            </div>
            <div class="col-md-3">
                <label for="date_return">วันที่คืน</label>
                <input type="text" id="date_return" class="datetimepicker2 form-control" name="date_return" value="<?= $data[0]['date_return'] ? $data[0]['date_return'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="reference">เลขที่เอกสาร</label>
                <input type="text" id="reference" class="form-control" name="reference" value="<?= $data[0]['reference'] ? $data[0]['reference'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="supplies_id">เลขที่พัสดุ</label>
                <input type="number" id="supplies_id" class="form-control" name="supplies_id" value="<?= $data[0]['supplies_id'] ? $data[0]['supplies_id'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="employees_id">ผู้เบิก</label>
                <input type="text" id="employees_id" class="form-control" name="employees_id" value="<?= $data[0]['employees_id'] ? $data[0]['employees_id'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="department">แผนก/ฝ่าย</label>
                <input type="text" id="department" class="form-control" name="department" value="<?= $data[0]['department'] ? $data[0]['department'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="status">สถานะ</label>
                <select class="form-control" name="status" id="status">
                    <option selected value="">เลือกสถานะ</option>
                    <option value="1" <?php if ($data[0]['status'] == 1) echo 'selected'; ?>>ยืมพัสดุ</option>
                    <option value="2" <?php if ($data[0]['status'] == 2) echo 'selected'; ?>>ระหว่างดำเนินการ</option>
                    <option value="3" <?php if ($data[0]['status'] == 3) echo 'selected'; ?>>คืนแล้ว</option>
                    <option value="4" <?php if ($data[0]['status'] == 4) echo 'selected'; ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="return_note">Return note</label>
                <textarea class="form-control" rows="3" name="return_note" id="return_note"><?= $data[0]['return_note'] ?? $data[0]['return_note']  ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="staff_note">Staff note</label>
                <textarea class="form-control" rows="3" name="staff_note" id="staff_note"><?= $data[0]['staff_note'] ?? $data[0]['staff_note']  ?></textarea>
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