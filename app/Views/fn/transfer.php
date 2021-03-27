<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('finance/transfer') ?>">
        <!-- <div class="container"> -->
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="department_id">แผนก</label>
                <input type="text" id="department_id" class="form-control" name="department_id" value="<?= $_POST['department_id'] ? $_POST['department_id'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="no">เลขที่เอกสาร</label>
                <input type="number" id="no" class="form-control" name="no" value="<?= $_POST['no'] ? $_POST['no'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
                <!-- <input type="date" id="date" class="form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required /> -->
            </div>
            <div class="col-md-3">
                <label for="transfer_from">โอนจากบัญชี</label>
                <input type="text" id="transfer_from" class="form-control" name="transfer_from" value="<?= $_POST['transfer_from'] ? $_POST['transfer_from'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="transfer_to">โอนเข้าบัญชี</label>
                <input type="text" id="transfer_to" class="form-control" name="transfer_to" value="<?= $_POST['transfer_to'] ? $_POST['transfer_to'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-8">
                <label for="reason">หมายเหตุ</label>
                <!-- <input type="text" id="reason" class="form-control" name="reason" value="<?= $_POST['reason'] ? $_POST['reason'] : '' ?>" /> -->
                <textarea class="form-control" rows="1" name="reason" id="reason"><?= $_POST['reason'] ?? $_POST['reason']  ?></textarea>

            </div>
            <div class="col-md-4">
                <div class="col-md-12">
                    <label for="amount">จำนวนเงิน (หน่วย:บาท)</label>
                    <input type="number" id="amount" class="form-control value" name="amount" value="<?= $_POST['amount'] ? $_POST['amount'] : 0 ?>" />
                </div>
                <div class="col-md-12">
                    <label for="fee">ค่าธรรมเนียม (หน่วย:บาท)</label>
                    <input type="number" id="fee" class="form-control value" name="fee" value="<?= $data['0']['fee'] ? $data['0']['fee'] : 0 ?>" readonly />
                </div>
                <div class="col-md-12">
                    <label for="total">จำนวนเงินทั้งสิ้น (หน่วย:บาท)</label>
                    <input type="number" id="total" class="form-control" readonly />
                </div>
                <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                    <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                    <input type="reset" class="btn btn-secondary " value="เคลียร์" />
                </div>
            </div>
        </div>
    </form>
</div>