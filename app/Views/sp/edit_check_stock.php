<form method="post" action="<?= base_url('supplies/edit_check_stock').'/'.$data[0]['id'] ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="warehouse_id">คลังสินค้า</label>
            <select class="form-control" name="warehouse_id" id="warehouse_id">
                <option selected value="">เลือกคลังสินค้า</option>
                    <?php foreach ($warehouse as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $data[0]['warehouse_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="date">วันที่</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
        </div>
        <div class="col-md-4">
            <label for="reference">เลขอ้างอิง</label>
            <input type="text" id="reference" class="form-control" name="reference" value="<?= $data[0]['reference'] ? $data[0]['reference'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="type">สถานะ</label><br>
            <input type="radio" id="full" name="type" value="1" required <?php $data[0]['type'] == 1 ? print 'checked' : ''; ?>>
            <label for="full" style="margin-right: 5%;">Full</label>
            <input type="radio" id="some" name="type" value="2" <?php $data[0]['type'] == 2 ? print 'checked' : ''; ?>>
            <label for="some">บางส่วน</label>
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