<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('setting/unit') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="unit_code">รหัสหน่วยนับ</label>
                <input type="text" id="unit_code" class="form-control" name="unit_code" value="<?= $_POST['unit_code'] ? $_POST['unit_code'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="unit_name">ชื่อหน่วยนับ</label>
                <input type="text" id="unit_name" class="form-control" name="unit_name" value="<?= $_POST['unit_name'] ? $_POST['unit_name'] : '' ?>" required />
            </div>
        </div>
        <!-- <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="unit_base">หน่วยมูลฐาน</label>
                <select class="form-control select2" name="unit_base" id="unit_base">
                    <option selected value="">เลือกหน่วยนับ</option>
                    <?php foreach ($unit as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['unit_base'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['unit_name'] . ' (' . $row['unit_code'] . ')' ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6" id="operater_div">
                <label for="operater">ตัวดำเนินการ</label>
                <select class="form-control" name="operater" id="operater" >
                    <option selected value="">เลือกตัวดำเนินการ</option>
                    <option value="1" <?php $_POST['operater'] == 1 ? print 'selected' : ''; ?>>คูณ (*)</option>
                    <option value="2" <?php $_POST['operater'] == 2 ? print 'selected' : ''; ?>>หาร (/)</option>
                    <option value="3" <?php $_POST['operater'] == 3 ? print 'selected' : ''; ?>>บวก (+)</option>
                    <option value="4" <?php $_POST['operater'] == 4 ? print 'selected' : ''; ?>>ลบ (-)</option>
                </select>
            </div>
            <div class="col-md-6" id="operater_value_div">
                <label for="operater_value">การดำเนินการ</label>
                <input type="text" id="operater_value" class="form-control" name="operater_value" value="<?= $_POST['operater_value'] ? $_POST['operater_value'] : '' ?>" />
            </div>
        </div> -->
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
    $(document).ready(function() {
        $('#unit_base').on('change', function() {
            // console.log($(this).val());
            if ($(this).val()) {
                $("#operater_div").show();
                $("#operater_value_div").show();
                $("#operater").prop("disabled", false);
                $("#operater").prop("required", true);
                $("#operater_value").prop("disabled", false);
                $("#operater_value").prop("required", true);
            } else {
                $("#operater_div").hide();
                $("#operater_value_div").hide();
                $("#operater").prop("disabled", true);
                $("#operater").prop("required", false);
                $("#operater_value").prop("disabled", true);
                $("#operater_value").prop("required", false);
            }
        });
        $("#unit_base").trigger("change");
    });
</script>