<form method="post" action="<?= base_url('finance/import_excell') ?>" enctype="multipart/form-data">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="excell">แนบเอกสาร</label>
            <input type='file' class="form-control" id="excell" name="excell" />
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