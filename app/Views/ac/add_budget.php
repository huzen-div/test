<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 0;">
    </div>
    <form method="post" action="<?= base_url('account/add_budget') ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="operator">ผู้ดำเนินการ</label>
                <input type="text" id="operator" class="form-control" name="operator" value="<?= $_POST['operator'] ? $_POST['operator'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="type">ประเภทงบประมาณ</label>
                <select class="form-control select2" name="type" id="type" required>
                    <option selected value="">เลือกประเภทงบประมาณ</option>
                    <?php foreach ($main as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['type'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['main_item'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="approve">อนุมัติครั้งที่</label>
                <!-- <input type="text" id="approve" class="form-control" name="approve" value="<?= $_POST['approve'] ? $_POST['approve'] : '' ?>" required /> -->
                <select class="form-control select2" name="approve" id="approve" required>
                    <option selected value="">เลือกอนุมัติครั้งที่</option>
                    <?php for ($time=1;$time<=100;$time++) { ?>
                        <option value="<?= $time ?>" <?php $_POST['approve'] == $time ? print 'selected' : ''; ?>><?= $time ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="central_percent">พักสำรองส่วนกลาง&nbsp; %</label>
                <input type="number" id="central_percent" class="form-control" name="central_percent" value="<?= $_POST['central_percent'] ? $_POST['central_percent'] : 0 ?>" />
            </div>
            <div class="col-md-6">
                <label for="central_amount">พักสำรองส่วนกลาง&nbsp; (บาท)</label>
                <input type="text" id="central_amount" class="form-control money" name="central_amount" value="<?= $_POST['central_amount'] ? $_POST['central_amount'] : 0 ?>" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="allocated">รับจัดสรรสุทธิ &nbsp; (บาท)</label>
                <input type="text" id="allocated" class="form-control money" name="allocated" value="<?= $_POST['allocated'] ? $_POST['allocated'] : 0 ?>" />
            </div>
            <div class="col-md-6">
                <label for="approved_budget">งบประมาณที่ผ่านการอนุมัติแล้ว</label>
                <input type="text" id="approved_budget" class="form-control money" name="approved_budget" value="<?= $_POST['approved_budget'] ? $_POST['approved_budget'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">หมายเหตุ</label>
                <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="document">แนบเอกสาร</label>
                <input type='file' class="form-control" id="document" name="document" />
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
<script>
    // $(function() {
    //     var thaiYear = function(ct) {
    //         var leap = 3;
    //         var dayWeek = ["พฤ.", "ศ.", "ส.", "อา.", "จ.", "อ.", "พ."];
    //         if (ct) {
    //             var yearL = new Date(ct).getFullYear() - 543;
    //             leap = (((yearL % 4 == 0) && (yearL % 100 != 0)) || (yearL % 400 == 0)) ? 2 : 3;
    //             if (leap == 2) {
    //                 dayWeek = ["ศ.", "ส.", "อา.", "จ.", "อ.", "พ.", "พฤ."];
    //             }
    //         }
    //         this.setOptions({
    //             i18n: {
    //                 th: {
    //                     dayOfWeek: dayWeek
    //                 }
    //             },
    //             dayOfWeekStart: leap,
    //         })
    //     };
    //     $(".datetimepicker2").datetimepicker({
    //         timepicker: false,
    //         format: 'd/m/Y', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
    //         lang: 'th', // แสดงภาษาไทย
    //         onChangeMonth: thaiYear,
    //         onShow: thaiYear,
    //         yearOffset: 543, // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
    //         closeOnDateSelect: true,
    //     });
    // });
</script>