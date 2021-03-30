<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('supplies/requisition') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="date">วันที่เบิก</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="reference">เลขที่เอกสาร</label>
                <input type="text" id="reference" class="form-control" name="reference" value="<?= $_POST['reference'] ? $_POST['reference'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="supplies_id">เลขที่พัสดุ</label>
                <input type="number" id="supplies_id" class="form-control" name="supplies_id" value="<?= $_POST['supplies_id'] ? $_POST['supplies_id'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="employees_id">ผู้เบิก</label>
                <input type="text" id="employees_id" class="form-control" name="employees_id" value="<?= $_POST['employees_id'] ? $_POST['employees_id'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="department">แผนก/ฝ่าย</label>
                <input type="text" id="department" class="form-control" name="department" value="<?= $_POST['department'] ? $_POST['department'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="status">สถานะ</label>
                <select class="form-control" name="status" id="status">
                    <option selected value="">เลือกสถานะ</option>
                    <option value="1"<?php if ($_POST['status'] == 1) echo 'selected'; ?>>จ่ายแล้ว</option>
                    <option value="2"<?php if ($_POST['status'] == 1) echo 'selected'; ?>>ระหว่างดำเนินการ</option>
                    <option value="3"<?php if ($_POST['status'] == 1) echo 'selected'; ?>>ยกเลิก</option>
                    <!-- <option value="4"<?php if ($_POST['status'] == 1) echo 'selected'; ?>>เรียบร้อย</option> -->
                </select>
            </div>
        </div>
        <!-- <div class="row" style="margin-bottom: 1%;margin-top: 3%;">
        <div class="col-md-12">
            <select class="form-control" name="product" id="product" required>
                <option selected value="">โปรดเลือกสินค้าในรายการ</option>
            </select>
        </div>
    </div> -->
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="name">โครงการจัดซื้อจัดจ้าง</label>
                <input type="text" id="name" class="form-control" name="name" value="<?= $_POST['name'] ? $_POST['name'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="price">จำนวนเงิน (บาท)</label>
                <input type="text" id="price" class="form-control money" name="price" value="<?= $_POST['price'] ? $_POST['price'] : 0 ?>" required />

            </div>
            <div class="col-md-6">
                <label for="taxrate">รวมภาษี 7%</label>
                <select class="form-control" name="taxrate" id="taxrate">
                    <option selected value="">เลือกรวมภาษี 7%</option>
                    <?php foreach ($taxrate as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['vat'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="return_note">Return note</label>
                <textarea class="form-control" rows="3" name="return_note" id="return_note"><?= $_POST['return_note'] ?? $_POST['return_note']  ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="staff_note">Staff note</label>
                <textarea class="form-control" rows="3" name="staff_note" id="staff_note"><?= $_POST['staff_note'] ?? $_POST['staff_note']  ?></textarea>
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