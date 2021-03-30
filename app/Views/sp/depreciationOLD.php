<style>
    .textright {
        text-align: right;
    }
</style>
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('supplies/depreciation') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="type">คำนวนค่าเสื่อมแบบ</label>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="type" id="type" required>
                    <option selected value="1">เส้นตรง</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="date">วันที่เริ่มคิดค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="rate">อัตราค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="rate" id="rate" required>
                    <option selected value="1">อายุการใช้งาน</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-2 offset-md-6">
                <input type="number" id="year" class="form-control" name="year" value="<?= $_POST['year'] ? $_POST['year'] : 1 ?>" required />
            </div>
            <div class="col-md-2">ปี</div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="price">ราคาที่ใช้คิดค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="price" class="form-control money" name="price" value="<?= $_POST['price'] ? $_POST['price'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="carcass">ราคาซาก</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="carcass" class="form-control money" name="carcass" value="<?= $_POST['carcass'] ? $_POST['carcass'] : 0 ?>" required />
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
    <table style="margin-left: auto;  margin-right: auto;">
        <thead class="table cell-border">
            <tr>
                <th class="align-middle" rowspan="2">ช่องทางการชำระเงิน</th>
                <th class="align-middle" rowspan="2">ออฟไลน์</th>
                <th class="align-middle" colspan="2">ออนไลน์ (แพลตฟอร์ใดๆ ที่ไม่ใช่เนื้อหาแบบดิจิทัล)</th>
                <th class="align-middle" rowspan="2">ออนไลน์ (แพลตฟอร์ใดๆ ที่มีเนื้อหาแบบดิจิทัล*)</th>
            </tr>
            <tr>
                <th class="align-middle">API & LinkPay</th>
                <th class="align-middle">WooCommerce/SAAS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Wechat Pay</td>
                <td>0.90%</td>
                <td>1.00%</td>
                <td>1.30%</td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>Alipay</td>
                <td>1.20%</td>
                <td>1.40%</td>
                <td>1.70%</td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>Promptpay</td>
                <td>0.25%</td>
                <td>0.35%</td>
                <td>0.65%</td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>True Money</td>
                <td>1.30%</td>
                <td>1.60%</td>
                <td>1.90%</td>
                <td>12%$</td>
            </tr>
            <tr>
                <td>Linepay</td>
                <td>1.80%</td>
                <td>2.70%</td>
                <td>2.90%</td>
                <td>แล้วแต่กรณี</td>
            </tr>
            <tr>
                <td>Airpay</td>
                <td>1.20%</td>
                <td>2.70%</td>
                <td>2.90%</td>
                <td>5%</td>
            </tr>
            <tr>
                <td>Visa</td>
                <td></td>
                <td>2.30%</td>
                <td>2.70%</td>
                <td>แล้วแต่กรณี</td>
            </tr>
            <tr>
                <td>Master</td>
                <td></td>
                <td>2.30%</td>
                <td>2.70%</td>
                <td>แล้วแต่กรณี</td>
            </tr>
            <tr>
                <td>JCB</td>
                <td></td>
                <td>2.30%</td>
                <td>2.70%</td>
                <td>แล้วแต่กรณี</td>
            </tr>
            <tr>
                <td>Unionpay</td>
                <td></td>
                <td>2.30%</td>
                <td>2.70%</td>
                <td>แล้วแต่กรณี</td>
            </tr>
        </tbody>
    </table>
</div>