<form method="post" action="<?= base_url('finance/pettycash') ?>">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-2">
            <label for="type_id">ประเภท</label>
            <input type="text" id="type_id" class="form-control" name="type_id" value="<?= $_POST['type_id'] ? $_POST['type_id'] : '' ?>" required />
        </div>
        <div class="col-md-2">
            <label for="status_id">สถานะ</label>
            <input type="text" id="status_id" class="form-control" name="status_id" value="<?= $_POST['status_id'] ? $_POST['status_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="no_id">
                ตัดเลขที่บัญชี (จากผังบัญชี)
            </label>
            <input type="text" id="no_id" class="form-control" name="no_id" value="<?= $_POST['no_id'] ? $_POST['no_id'] : '' ?>" required />
        </div>
        <div class="col-md-3">
            <label for="date">วันที่</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required >   
            <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
        </div>
        <div class="col-md-2">
            <label for="withdrawal_slip">เลขที่เอกสาร</label>
            <input type="text" id="withdrawal_slip" class="form-control" name="withdrawal_slip" value="<?= $_POST['withdrawal_slip'] ? $_POST['withdrawal_slip'] : '' ?>" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">เพิ่มเติม</label>
            <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-8">
            <label for="amount">จำนวนเงินทั้งสิ้น (หน่วย:บาท)</label>
            <input type="number" id="amount" class="form-control" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : '' ?>" />
        </div>
        <div class="col-md-12" style="margin-top: 1%;text-align: right;">
            <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary " value="เคลียร์" />
        </div>
    </div>
</form>