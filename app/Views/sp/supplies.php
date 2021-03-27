<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('supplies/supplies'). '/' . $data[0]['id'] ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="supplies_purchase_id">โครงการจัดซื้อจัดจ้าง</label>
                <!-- <input type="text" id="supplie_name" class="form-control" name="supplie_name" value="<?= $data[0]['supplie_name'] ? $data[0]['supplie_name'] : $_POST['supplies_responsible'] ?>" required /> -->
                <select class="form-control select2" name="supplies_purchase_id" id="supplies_purchase_id" required>
                    <option selected value="">เลือกโครงการจัดซื้อจัดจ้าง</option>
                    <?php foreach ($purchase as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $data[0]['supplies_purchase_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['reference'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="supplies_responsible">ผู้รับผิดชอบ</label>
                <input type="text" id="supplies_responsible" class="form-control" name="supplies_responsible" value="<?= $data[0]['supplies_responsible'] ? $data[0]['supplies_responsible'] : $_POST['supplies_responsible'] ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="supplies_department">แผนก</label>
                <input type="text" id="supplies_department" class="form-control" name="supplies_department" value="<?= $data[0]['supplies_department'] ? $data[0]['supplies_department'] :  $_POST['supplies_department'] ?>" required />
            </div>
            <div class="col-md-6">
                <label for="supplies_supplies">ออกเลขพัสดุ</label>
                <input type="text" id="supplies_supplies" class="form-control" name="supplies_supplies" value="<?= $data[0]['supplies_supplies'] ? $data[0]['supplies_supplies'] :$_POST['supplies_supplies'] ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="supplies_date">วันที่ออกเลขพัสดุ</label>
                <input type="text" id="supplies_date" class="datetimepicker2 form-control" name="supplies_date" value="<?= $data[0]['supplies_date'] ? $data[0]['supplies_date'] : $_POST['supplies_date'] ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="supplies_note">อื่นๆ</label>
                <textarea class="form-control test" name="supplies_note" id="supplies_note"><?= $data[0]['supplies_note'] ?? $data[0]['supplies_note']  ?></textarea>
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