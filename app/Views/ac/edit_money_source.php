<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>
<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 0;">
    </div>
    <form method="post" action="<?= base_url('account/edit_money_source/' . $data[0]['id']) ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="operator">ผู้ดำเนินการ</label>
                <input type="text" id="operator" class="form-control" name="operator" value="<?= $data[0]['operator'] ? $data[0]['operator'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="year">รายจ่ายตามปีงบประมาณ</label>
                <select class="form-control select2" name="year" id="year" required>
                    <option selected value="">เลือกรายจ่ายตามปีงบประมาณ</option>
                    <?php foreach ($cost as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php if($row['id'] == $data[0]['year']) echo "selected";?>><?= $row['main_item'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="show">แสดงผล</label>
                <br>
                <input type="radio" id="แสดงผล" name="show" value="1" required <?= $data[0]['show'] == 1 ? 'checked' : '' ?>>
                <label for="แสดงผล" style="margin-right: 1%;">แสดงผล</label>
                <input type="radio" id="ไม่แสดงผล" name="show" value="0" <?= $data[0]['show'] == 0 ? 'checked' : '' ?>>
                <label for="ไม่แสดงผล" style="margin-right: 1%;">ไม่แสดงผล</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="document">แนบเอกสาร</label>
                <input type='file' class="form-control" id="document" name="document" />
            </div>
            <div class="col-md-6">
                <label for="budget ">งบขั้นตํ่า</label>
                <br>
                <input type="radio" id="งบขั้นตํ่า" name="budget" value="1" required <?= $data[0]['budget'] == 1 ? 'checked' : '' ?>>
                <label for="งบขั้นตํ่า" style="margin-right: 1%;">งบขั้นตํ่า</label>
                <input type="radio" id="งบกลาง" name="budget" value="2" <?= $data[0]['budget'] == 2 ? 'checked' : '' ?>>
                <label for="งบกลาง" style="margin-right: 1%;">งบกลาง</label>
                <input type="radio" id="งบสูงสุด" name="budget" value="3" <?= $data[0]['budget'] == 3 ? 'checked' : '' ?>>
                <label for="งบสูงสุด" style="margin-right: 1%;">งบสูงสุด</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">หมายเหตุ</label>
                <textarea class="form-control" rows="1" name="note" id="note"><?= $data[0]['note'] ? $data[0]['note'] : '' ?></textarea>
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