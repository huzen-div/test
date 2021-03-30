<form method="post" action="<?= base_url('supplies/edit_product') . '/' . $data[0]['id'] ?>" enctype="multipart/form-data">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="name">ชื่อครุภัณฑ์/วัสดุภัณฑ์</label>
            <input type="text" id="name" class="form-control" name="name" value="<?= $data[0]['name'] ? $data[0]['name'] : '' ?>" required />
        </div>
        <div class="col-md-6">
            <label for="product_code">รหัสครุภัณฑ์/วัสดุภัณฑ์</label>
            <input type="number" id="product_code" class="form-control" name="product_code" value="<?= $data[0]['product_code'] ? $data[0]['product_code'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="type_id">ประเภท</label>
            <select class="form-control" name="type_id" id="type_id" required>
                <option selected value="">เลือกประเภท</option>
                <?php foreach ($type as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['type_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6"><br>
            <label for="status">สถานะ</label>
            <input type="radio" id="active" name="status" value="1" required <?php $data[0]['status'] == 1 ? print 'checked' : ''; ?>>
            <label for="active">ครุภัณฑ์ที่ใช้งานได้</label>
            <input type="radio" id="inactive" name="status" value="2" <?php $data[0]['status'] == 2 ? print 'checked' : ''; ?>>
            <label for="inactive">ครุภัณฑ์เสื่อมสภาพ</label>
            <input type="radio" id="other" name="status" value="3" <?php $data[0]['status'] == 3 ? print 'checked' : ''; ?>>
            <label for="other">ครุภัณฑ์ที่รอจำหน่าย</label>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="category_main_id">หมวดหมู่หลัก</label>
            <select class="form-control" name="category_main_id" id="category_main_id" required>
                <option selected value="">เลือกหมวดหมู่หลัก</option>
                <?php foreach ($category as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['category_main_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['category_name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="category_minor_id2">หมวดหมู่ย่อย</label>
            <select class="form-control" name="category_minor_id2" id="category_minor_id2">
                <option selected value="">เลือกหมวดหมู่ย่อย</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="document">ไฟล์แนบ <?php if ($data[0]['document'] != null) { ?><a href="<?php echo base_url('files') . '/' . $data[0]['document']; ?>">ไฟล์</a> <?php } ?></label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
            <input type='file' class="form-control" id="document" name="document" />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="unit">หน่วยนับ</label>
            <select class="form-control" name="unit" id="unit" required>
                <option selected value="">เลือกหน่วยนับ</option>
                <?php foreach ($unit as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['unit'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['unit_name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="responsible">ผู้รับผิดชอบ</label>
            <input type="text" id="responsible" class="form-control" name="responsible" value="<?= $data[0]['responsible'] ? $data[0]['responsible'] : '' ?>" required />
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="price">จำนวนเงิน (บาท)</label>
            <input type="text" id="price" class="form-control money" name="price" value="<?= $data[0]['price'] ? $data[0]['price'] : 0 ?>" required />

        </div>
        <div class="col-md-6">
            <label for="vat">รวมภาษี 7%</label>
            <select class="form-control" name="vat" id="vat" required>
                <option selected value="">เลือกภาษี</option>
                <?php foreach ($taxrate as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['vat'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <!-- <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="pr">PR</label>
            <select class="form-control" name="pr" id="pr" required>
                <option selected value="">เลือกPR</option>
                <?php foreach ($pr as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['pr'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['reference'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="po">PO</label>
            <select class="form-control" name="po" id="po" required>
                <option selected value="">เลือกPO</option>
                <?php foreach ($po as $row) { ?>
                    <option value="<?= $row['id'] ?>" <?php $data[0]['po'] == $row['id'] ? print 'selected' : ''; ?>><?= 'PO-' . $row['purchase_order1'] . '/' . $row['purchase_order2'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div> -->
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" rows="3" name="note" id="note"><?= $data[0]['note'] ? $data[0]['note'] : '' ?></textarea>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="date">วันที่</label>
            <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
        </div>
        <div class="col-md-6">
            <label for="noti">แจ้งเตือนครุภัณฑ์/วัสดุภัณฑ์</label>
            <input type="text" id="noti" class="form-control" name="noti" value="<?= $data[0]['noti'] ? $data[0]['noti'] : '' ?>" required />
            <!-- <select class="form-control" name="noti" id="noti" required>
                <option selected value="">เลือกแจ้งเตือนครุภัณฑ์/วัสดุภัณฑ์</option>
            </select> -->
        </div>
        <!-- <div class="col-md-6">
            <label for="group">ประเภท</label>
            <select class="form-control" name="group" id="group" required>
                <option selected value="">เลือกประเภท</option>
                <option value="1" <?php $data[0]['group'] == 1 ? print 'selected' : ''; ?>>ครุภัณฑ์</option>
                <option value="2" <?php $data[0]['group'] == 2 ? print 'selected' : ''; ?>>วัสดุภัณฑ์</option>
            </select>
        </div> -->
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="image">รูปภาพ</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_image" title="กดเพื่อลบรูปภาพ"><i class="fas fa-minus-circle"></i></span>
            <input type="submit" class="btn btn-danger " name="del_image1" value="ลบรูปภาพ" style="margin-right: 2%;" />
            <input type='file' class="form-control" id="image" accept="image/*" name="image1" />
            <img id="preview_image" class="img-fluid" src="<?= $data[0]['image1'] ? base_url('files') . '/' . $data[0]['image1'] : base_url('files') . '/No_image_available.png' ?>" alt="your image" style="margin: 1%;width: 100px;" />
        </div>
        <div class="col-md-6">
            <label for="image2">รูปภาพ</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_image2" title="กดเพื่อลบรูปภาพ"><i class="fas fa-minus-circle"></i></span>
            <input type="submit" class="btn btn-danger " name="del_image2" value="ลบรูปภาพ" style="margin-right: 2%;" />
            <input type='file' class="form-control" id="image2" accept="image/*" name="image2" />
            <img id="preview_image2" class="img-fluid" src="<?= $data[0]['image2'] ? base_url('files') . '/' . $data[0]['image2'] : base_url('files') . '/No_image_available.png' ?>" alt="your image" style="margin: 1%;width: 100px;" />
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
<script>
    $(document).ready(function() {
        // console.log(category_minor_id2_val);
        $('#category_main_id').change(function() {
            var category_minor_id2_val = "<?php echo $data[0]['category_minor_id'] ?>";
            var account_category = $(this).val();
            var options = '<option value="">เลือกหมวดหมู่ย่อย</option>';
            $.ajax({
                type: "POST",
                url: base_url + "/supplies/getsupcategory/" + account_category,
                success: function(data) {
                    $('#category_minor_id2').html('');
                    for (var i = 0; i < data.length; i++) { // Loop through the data & construct the options
                        if (category_minor_id2_val == data[i].id)
                            options += '<option value="' + data[i].id + '" selected >' + data[i].category_name + '</option>';
                        else
                            options += '<option value="' + data[i].id + '">' + data[i].category_name + '</option>';

                        // console.log(category_minor_id2_val + ' : ' + data[i].id);
                    }
                    // Append to the html
                    $('#category_minor_id2').append(options);
                }
            });
        });
        $("#category_main_id").trigger("change");
    });
</script>
<script>
    $(document).ready(function() {
        $("#del_document").click(function() {
            $('#document').val("");
        });
        $("#del_image").click(function() {
            $('#image').val("");
            $('#preview_image').attr('src', '<?= $data[0]['image1'] ? base_url('files') . '/' . $data[0]['image1'] : base_url('files') . '/No_image_available.png' ?>')
        });
        $("#del_image2").click(function() {
            $('#image2').val("");
            $('#preview_image2').attr('src', '<?= $data[0]['image2'] ? base_url('files') . '/' . $data[0]['image2'] : base_url('files') . '/No_image_available.png' ?>')
        });

    });
</script>