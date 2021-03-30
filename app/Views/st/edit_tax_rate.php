<form method="post" action="<?= base_url('setting/edit_tax_rate'). '/' . $data[0]['id'] ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="name">ชื่อ</label>
            <input type="text" id="name" class="form-control" name="name" value="<?= $data[0]['name'] ? $data[0]['name'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="code">รหัส</label>
            <input type="text" id="code" class="form-control" name="code" value="<?= $data[0]['code'] ? $data[0]['code'] : '' ?>" required/>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="tax_rate">อัตราภาษี</label>
            <input type="text" id="tax_rate" class="form-control money" name="tax_rate" value="<?= $data[0]['tax_rate'] ? $data[0]['tax_rate'] : 0 ?>" required />
        </div>
        <div class="col-md-6">
            <label for="type">ประเภท</label>
            
            <select class="form-control" name="type" id="type" required>
                <option selected value="">เลือกประเภท</option>
                <option value="1" <?php $data[0]['type'] == 1 ? print 'selected' : ''; ?>>ประจำ</option>
                <option value="2" <?php $data[0]['type'] == 2 ? print 'selected' : ''; ?>>เปอร์เซ็นต์</option>
            </select>
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