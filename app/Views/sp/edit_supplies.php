<form method="post" action="<?= base_url('supplies/edit_supplies') . '/' . $data[0]['id'] ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="supplie_name">โครงการจัดซื้อจัดจ้าง</label>
            <input type="text" id="supplie_name" class="form-control" name="supplie_name" value="<?= $data[0]['supplie_name'] ? $data[0]['supplie_name'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="responsible">ผู้รับผิดชอบ</label>
            <input type="text" id="responsible" class="form-control" name="responsible" value="<?= $data[0]['responsible'] ? $data[0]['responsible'] : '' ?>" required/>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="department">แผนก</label>
            <input type="text" id="department" class="form-control" name="department" value="<?= $data[0]['department'] ? $data[0]['department'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="price">งบประมาณ(บาท)</label>
            <input type="text" id="price" class="form-control money" name="price" value="<?= $data[0]['price'] ? $data[0]['price'] : 0 ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="vat">รวมภาษี 7%</label>
            <select class="form-control" name="vat" id="vat" required>
                <option selected value="">เลือกภาษี</option>
                <?php foreach ($taxrate as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['vat'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="date">วันที่</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
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