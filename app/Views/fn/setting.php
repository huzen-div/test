<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('finance/setting') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="organization_name">ชื่อหน่วยงาน</label>
                <input type="text" id="organization_name" class="form-control" name="organization_name" value="<?= $setting['0']['organization_name'] ? $setting['0']['organization_name'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="telephone">เบอร์โทร</label>
                <input type="text" id="telephone" class="form-control" name="telephone" value="<?= $setting['0']['telephone'] ? $setting['0']['telephone'] : '' ?>" required pattern="[0-9]{10}" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="address">ที่อยู่</label>
                <textarea class="form-control" rows="1" name="address" id="address"><?= $setting['0']['address'] ? $setting['0']['address'] : '' ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="email">อีเมล์</label>
                <input type="email" id="email" class="form-control" name="email" value="<?= $setting['0']['email'] ? $setting['0']['email'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="fax">แฟกช์</label>
                <input type="text" id="fax" class="form-control" name="fax" value="<?= $setting['0']['fax'] ? $setting['0']['fax'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="logo">Logo หน่วยงาน</label>
                <input type="text" id="logo" class="form-control" name="logo" value="<?= $setting['0']['logo'] ? $setting['0']['logo'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="website">เว็บไซต์</label>
                <input type="text" id="website" class="form-control" name="website" value="<?= $setting['0']['website'] ? $setting['0']['website'] : '' ?>" required />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="rate">อัตราเรียกเก็บ(บาท)</label>
                <input type="number" id="rate" class="form-control" name="rate" value="<?= $setting['0']['rate'] ? $setting['0']['rate'] : '' ?>" required />
                <!-- <textarea class="form-control" rows="1" name="rate" id="rate"><?= $setting['0']['rate'] ? $setting['0']['rate'] : '' ?></textarea> -->
            </div>
            <div class="col-md-3">
                <label for="maintenance">เงินบำรุง(บาท)</label>
                <input type="number" id="maintenance" class="form-control" name="maintenance" value="<?= $setting['0']['maintenance'] ? $setting['0']['maintenance'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="vat">อัตรา หักภาษี ณ ที่จ่าย (%)</label>
                <input type="number" id="vat" class="form-control" name="vat" value="<?= $setting['0']['vat'] ? $setting['0']['vat'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="fee">ค่าธรรมเนียม(บาท)</label>
                <input type="text" id="fee" class="form-control" name="fee" value="<?= $setting['0']['fee'] ? $setting['0']['fee'] : '' ?>" required />
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