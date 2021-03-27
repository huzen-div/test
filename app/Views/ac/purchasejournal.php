<form method="post" action="<?= base_url('account/purchasejournal') ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4">
            <label for="no_id ">เลขที่</label>
            <input type="number" id="no_id" class="form-control" name="no_id" value="<?= $_POST['no_id'] ? $_POST['no_id'] : '' ?>" required />
        </div>
        <div class="col-md-4">
            <label for="date">วันที่</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required >   
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
        </div>
        <div class="col-md-4">
            <label for="refer">อ้างอิง</label>
            <input type="text" id="refer" class="form-control" name="refer" value="<?= $_POST['refer'] ? $_POST['refer'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="detail">รายละเอียด</label>
            <textarea class="form-control" rows="1" name="detail" id="detail"><?= $_POST['detail'] ? $_POST['detail'] : '' ?></textarea>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">เพิ่มเติม</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>
    </div>

    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-4 offset-md-8">
            <label for="amount">รวม (หน่วย:บาท)</label>
            <input type="text" id="amount" class="form-control money" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : 0 ?>" />
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