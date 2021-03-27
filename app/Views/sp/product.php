<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('supplies/product') ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="name">ชื่อครุภัณฑ์/วัสดุภัณฑ์</label>
                <input type="text" id="name" class="form-control" name="name" value="<?= $_POST['name'] ? $_POST['name'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="product_code">รหัสครุภัณฑ์/วัสดุภัณฑ์</label>
                <input type="number" id="product_code" class="form-control" name="product_code" value="<?= $_POST['product_code'] ? $_POST['product_code'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="type_id">ประเภท</label>
                <select class="form-control" name="type_id" id="type_id" required>
                    <option selected value="">เลือกประเภท</option>
                    <?php foreach ($type as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['type_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6"><br>
                <label for="status">สถานะ</label>
                <input type="radio" id="active" name="status" value="1" required <?php $_POST['status'] == 1 ? print 'checked' : ''; ?>>
                <label for="active">ครุภัณฑ์ที่ใช้งานได้</label>
                <input type="radio" id="inactive" name="status" value="2" <?php $_POST['status'] == 2 ? print 'checked' : ''; ?>>
                <label for="inactive">ครุภัณฑ์เสื่อมสภาพ</label>
                <input type="radio" id="other" name="status" value="3" <?php $_POST['status'] == 3 ? print 'checked' : ''; ?>>
                <label for="other">ครุภัณฑ์ที่รอจำหน่าย</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="category_main_id">หมวดหมู่หลัก</label>
                <select class="form-control" name="category_main_id" id="category_main_id" required>
                    <option selected value="">เลือกหมวดหมู่หลัก</option>
                    <?php foreach ($category as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['category_main_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['category_name'] ?></option>
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
                <label for="document">ไฟล์แนบ</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document" title="กดเพื่อลบไฟล์"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="document" name="document" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="unit">หน่วยนับ</label>
                <select class="form-control" name="unit" id="unit" required>
                    <option selected value="">เลือกหน่วยนับ</option>
                    <?php foreach ($unit as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['unit'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['unit_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="responsible">ผู้รับผิดชอบ</label>
                <input type="text" id="responsible" class="form-control" name="responsible" value="<?= $_POST['responsible'] ? $_POST['responsible'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="price">จำนวนเงิน (บาท)</label>
                <input type="text" id="price" class="form-control money" name="price" value="<?= $_POST['price'] ? $_POST['price'] : 0 ?>" required />

            </div>
            <div class="col-md-6">
                <label for="vat">รวมภาษี 7%</label>
                <select class="form-control" name="vat" id="vat" required>
                    <option selected value="">เลือกภาษี</option>
                    <?php foreach ($taxrate as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['vat'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
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
                        <option value="<?= $row['id'] ?>" <?php $_POST['pr'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['reference'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="po">PO</label>
                <select class="form-control" name="po" id="po" required>
                    <option selected value="">เลือกPO</option>
                    <?php foreach ($po as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['po'] == $row['id'] ? print 'selected' : ''; ?>><?= 'PO-' . $row['purchase_order1'] . '/' . $row['purchase_order2'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div> -->
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">หมายเหตุ</label>
                <textarea class="form-control" rows="3" name="note" id="note"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="noti">แจ้งเตือนครุภัณฑ์/วัสดุภัณฑ์</label>
                <input type="text" id="noti" class="form-control" name="noti" value="<?= $_POST['noti'] ? $_POST['noti'] : '' ?>" required />
                <!-- <select class="form-control" name="noti" id="noti" required>
                    <option selected value="">เลือกแจ้งเตือนครุภัณฑ์/วัสดุภัณฑ์</option>
                </select> -->
            </div>
            <!-- <div class="col-md-6">
                <label for="group">ประเภท</label>
                <select class="form-control" name="group" id="group" required>
                    <option selected value="">เลือกประเภท</option>
                    <option value="1" <?php $_POST['group'] == 1 ? print 'selected' : ''; ?>>ครุภัณฑ์</option>
                    <option value="2" <?php $_POST['group'] == 2 ? print 'selected' : ''; ?>>วัสดุภัณฑ์</option>
                </select>
            </div> -->
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="image">รูปภาพ</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_image" title="กดเพื่อลบรูปภาพ"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="image" accept="image/*" name="image1" />
                <img id="preview_image" class="img-fluid" src="<?= base_url('files') . '/No_image_available.png' ?>" alt="your image" style="margin: 1%;width: 100px;" />
            </div>
            <div class="col-md-6">
                <label for="image2">รูปภาพ</label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_image2" title="กดเพื่อลบรูปภาพ"><i class="fas fa-minus-circle"></i></span>
                <input type='file' class="form-control" id="image2" accept="image/*" name="image2" />
                <img id="preview_image2" class="img-fluid" src="<?= base_url('files') . '/No_image_available.png' ?>" alt="your image" style="margin: 1%;width: 100px;" />
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
    $(document).ready(function() {
        $('#category_main_id').change(function() {
            var account_category = $(this).val();
            var options = '<option value="">เลือกหมวดหมู่ย่อย</option>';
            $.ajax({
                type: "POST",
                url: base_url + "/supplies/getsupcategory/" + account_category,
                success: function(data) {
                    $('#category_minor_id2').html('');
                    for (var i = 0; i < data.length; i++) { // Loop through the data & construct the options
                        options += '<option value="' + data[i].id + '">' + data[i].category_name + '</option>';
                    }
                    // Append to the html
                    $('#category_minor_id2').append(options);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#del_document").click(function() {
            $('#document').val("");
        });
        $("#del_image").click(function() {
            $('#image').val("");
            $('#preview_image').attr('src', '<?= base_url('files') . '/No_image_available.png' ?>')
        });
        $("#del_image2").click(function() {
            $('#image2').val("");
            $('#preview_image2').attr('src', '<?= base_url('files') . '/No_image_available.png' ?>')
        });

    });
</script>