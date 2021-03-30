<style>
    .fancytree-container {
        outline: none;
    }
</style>
<!-- <?php var_dump($fancytree); ?> -->
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- <p>
            <a id="button1" href="#">Toggle 'The Hobbit'</a>
        </p> -->
            <div id="tree"></div>
            <div id="statusLine">Fancytree Demo - Click any node!</div>
        </div>
        <div class="col-md-6">
            <form method="post" action="<?= base_url('account/account_book')  ?><?php $selectedid ? '/' . $selectedid : ''; ?> ">
                <div class="row" style="margin-bottom: 1%;">
                    <div class="col-md-4">
                        <label for="account_number">เลขที่บัญชี</label>
                        <input type="text" id="account_number" class="form-control" name="account_number" value="<?= $_POST['account_number'] ? $_POST['account_number'] : '' ?>" maxlength="10" />
                    </div>
                </div>
                <div class="row" style="margin-bottom: 1%;">
                    <div class="col-md-12">
                        <label for="th_name">ชื่อภาษาไทย</label>
                        <input type="text" id="th_name" class="form-control" name="th_name" value="<?= $_POST['th_name'] ? $_POST['th_name'] : '' ?>" />
                    </div>
                </div>
                <div class="row" style="margin-bottom: 1%;">
                    <div class="col-md-12">
                        <label for="en_name">ชื่อภาษาอังกฤษ</label>
                        <input type="text" id="en_name" class="form-control" name="en_name" value="<?= $_POST['en_name'] ? $_POST['en_name'] : '' ?>" />
                    </div>
                </div>
                <div class="row" style="margin-bottom: 1%;">
                    <div class="col-md-12">
                        <label for="account_category">หมวดบัญชี</label>
                        <select class="form-control" name="account_category" id="account_category" required>
                            <option value="">เลือกหมวดบัญชี</option>
                            <?php if ($account_category) : ?>
                                <?php foreach ($account_category as $x) : ?>
                                    <option value="<?= $x['id'] ?>"><?= $x['id'] . ' ' . $x['th_name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 1%;">
                    <div class="col-md-12">
                        <label for="supervisory_account">บัญชีคุม</label>
                        <select class="form-control" name="supervisory_account" id="supervisory_account" required>
                            <option value="">เลือกบัญชีคุม</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-4">
                    <label for="account_level">ระดับบัญชี</label>
                    <input type="text" id="account_level" class="form-control col-md-4" name="account_level" value="<?= $_POST['account_level'] ? $_POST['account_level'] : '' ?>" />
                </div> -->
                </div>
                <div class="row" style="margin-bottom: 1%;">
                    <div class="col-md-12">
                        <label for="type">ประเภท</label>
                        <select class="form-control" name="type" id="type">
                            <option value=true>บัญชีคุม</option>
                            <option value=false>บัญชีย่อย</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="row" style="margin-bottom: 1%;">
                <div class="col-md-12">
                    <label class="col-md-2" for="separate_department">แยกแผนก</label>
                    <input type="checkbox" class="form-check-input" id="separate_department" name="separate_department" value="1" <?= $_POST['separate_department'] ? 'checked="checked"' : ''; ?> />
                </div>
            </div> -->
                <div class="row">
                    <div class="col-md-7 offset-md-5 " style="margin-top: 1%; float: right;">
                        <input type="reset" class="btn btn-secondary col-md-3 float-right" value="เคลียร์" />
                        <input type="button" class="btn btn-primary float-right" onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                        <input hidden type="submit" class="btn btn-danger col-md-3 float-right" name="delete" id="delete" value="ลบข้อมูล" style="margin-right: 2%;" onclick="return confirm('ยืนยัน ?')" />
                        <input type="submit" class="btn btn-success float-right" name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // $("#account_number").mask("999-999-999");
});
</script>