<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('setting/category') ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="category_name">ชื่อหมวดหมู่หลัก</label>
                <input type="text" id="category_name" class="form-control" name="category_name" value="<?= $_POST['category_name'] ? $_POST['category_name'] : '' ?>" required />
            </div>

            <div class="col-md-6">
                <label for="category_sub">หมวดหมู่ย่อย</label>
                <!-- <input type="text" id="category_sub" class="form-control" name="category_sub" value="<?= $_POST['category_sub'] ? $_POST['category_sub'] : '' ?>" /> -->

                <select class="form-control select2" name="category_sub" id="category_sub">
                    <option selected value="0">เลือกหมวดหมู่ย่อย</option>
                    <?php foreach ($category as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['category_sub'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="detail">รายละเอียด</label>
                <textarea class="form-control" rows="1" name="detail" id="detail"><?= $_POST['detail'] ? $_POST['detail'] : '' ?></textarea>

            </div>
            <div class="col-md-6">
                <label for="image">รูปภาพ</label>
                <input type='file' class="form-control" id="image" accept="image/*" name="image" />
                <img id="preview_image" class="img-fluid" src="#" alt="your image" style="margin: 1%;width: 100px;" />
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