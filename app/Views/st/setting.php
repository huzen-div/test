<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('setting/index') ?>">
        <h4>สินค้า/ครุภัณฑ์</h4><br>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="tax_product">ภาษีสินค้า</label>
                <select class="form-control" name="tax_product" id="tax_product" required>
                    <option value="1" <?php $data[0]['tax_product'] == 1 ? print 'selected' : ''; ?>>เปิดใช้งาน</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="shelf">ชั้นวาง</label>
                <select class="form-control" name="shelf" id="shelf" required>
                    <option value="1" <?php $data[0]['shelf'] == 1 ? print 'selected' : ''; ?>>เปิดใช้งาน</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="variety">ความหลากหลายของสินค้า</label>
                <select class="form-control" name="variety" id="variety" required>
                    <option value="1" <?php $data[0]['variety'] == 1 ? print 'selected' : ''; ?>>เปิดใช้งาน</option>

                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="expired_product">สินค้าหมดอายุ</label>
                <select class="form-control" name="expired_product" id="expired_product" required>
                    <option value="1" <?php $data[0]['expired_product'] == 1 ? print 'selected' : ''; ?>>ปิดใช้งาน</option>
                    <option value="2" <?php $data[0]['expired_product'] == 2 ? print 'selected' : ''; ?>>เปิดใช้งาน</option>


                </select>
            </div>
            <div class="col-md-4">
                <label for="expired_remove">Remove expired</label>
                <select class="form-control" name="expired_remove" id="expired_remove" required>
                    <option value="1" <?php $data[0]['expired_remove'] == 1 ? print 'selected' : ''; ?>>ไม่, i ll remove</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="image">ขนาดรูปภาพ (Width : Height)</label>
                <div class="row col-md-12">
                    <input type="number" id="image" class="form-control col-md-5" name="image_width" value="<?= $data[0]['image_width'] ? $data[0]['image_width'] : '' ?>" required />
                    <input type="number" id="image" class="form-control col-md-5 offset-md-2" name="image_height" value="<?= $data[0]['image_height'] ? $data[0]['image_height'] : '' ?>" required />
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="image_short">ขนาดของรูปย่อ (Width : Height)</label>
                <div class="row col-md-12">
                    <input type="number" id="image_short" class="form-control col-md-5" name="image_short_width" value="<?= $data[0]['image_short_width'] ? $data[0]['image_short_width'] : '' ?>" required />
                    <input type="number" id="image_short" class="form-control col-md-5 offset-md-2" name="image_short_height" value="<?= $data[0]['image_short_height'] ? $data[0]['image_short_height'] : '' ?>" required />
                </div>
            </div>
            <div class="col-md-4">
                <label for="watermark">ลายน้ำ</label>
                <select class="form-control" name="watermark" id="watermark" required>
                    <option value="1" <?php $data[0]['watermark'] == 1 ? print 'selected' : ''; ?>>ไม่</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="show_product">แสดงผลิตภัณฑ์ของคลังสินค้า</label>
                <select class="form-control" name="show_product" id="show_product" required>
                    <option value="1" <?php $data[0]['show_product'] == 1 ? print 'selected' : ''; ?>>ซ่อนกับ 0 จำนวน</option>

                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="barcode_separator">Barcode separator</label>
                <select class="form-control" name="barcode_separator" id="barcode_separator" required>
                    <option value="1" <?php $data[0]['barcode_separator'] == 1 ? print 'selected' : ''; ?>>dash</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="barcode_renderer">Barcode renderer</label>
                <select class="form-control" name="barcode_renderer" id="barcode_renderer" required>
                    <option value="1" <?php $data[0]['barcode_renderer'] == 1 ? print 'selected' : ''; ?>>รูปภาพ</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="update_cost_with_purchese">Update cost with purchese</label>
                <select class="form-control" name="update_cost_with_purchese" id="update_cost_with_purchese" required>
                    <option value="1" <?php $data[0]['update_cost_with_purchese'] == 1 ? print 'selected' : ''; ?>>ไม่</option>
                </select>
            </div>
        </div>
        <h4>ขาย</h4><br>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="oversold">การขายเกิน</label>
                <select class="form-control" name="oversold" id="oversold" required>
                    <option value="1" <?php $data[0]['oversold'] == 1 ? print 'selected' : ''; ?>>ไม่</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="format_referent">รูปแบบการอ้างอิง</label>
                <select class="form-control" name="format_referent" id="format_referent" required>
                    <option value="1" <?php $data[0]['format_referent'] == 1 ? print 'selected' : ''; ?>>ปี / เดือน /ลำดับหมายเลข(SL/2014/08/001)</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="tax_purchase">ภาษีการสั่งซื้อ</label>
                <select class="form-control" name="tax_purchase" id="tax_purchase" required>
                    <option value="1" <?php $data[0]['tax_purchase'] == 1 ? print 'selected' : ''; ?>>No Tax</option>

                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="discount_product">ระดับสินค้าส่วนลด</label>
                <select class="form-control" name="discount_product" id="discount_product" required>
                    <option value="1" <?php $data[0]['discount_product'] == 1 ? print 'selected' : ''; ?>>เปิดใช้งาน</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="no_product">หมายเลขสินค้า</label>
                <select class="form-control" name="no_product" id="no_product" required>
                    <option value="1" <?php $data[0]['no_product'] == 1 ? print 'selected' : ''; ?>>เปิดใช้งาน</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="detect_barcode">ตรวจจับอัตโนมัติเครื่องอ่านบาร์โค๊ด</label>
                <select class="form-control" name="detect_barcode" id="detect_barcode" required>
                    <option value="1" <?php $data[0]['detect_barcode'] == 1 ? print 'selected' : ''; ?>>เปิดใช้งาน</option>

                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="count_barcode">ผลิตภัณฑ์นับในการแก้ไขปัญหาการป้อนข้อมูลบาร์โค๊ด</label>
                <input type="number" id="count_barcode" class="form-control" name="count_barcode" value="<?= $data[0]['count_barcode'] ? $data[0]['count_barcode'] : '' ?>" required />
            </div>
            <div class="col-md-4">
                <label for="add_products">วิธีเพิ่มรายการรถเข็น</label>
                <select class="form-control" name="add_products" id="add_products" required>
                    <option value="1" <?php $data[0]['add_products'] == 1 ? print 'selected' : ''; ?>>เพิ่มรายการใหม่ใสรถเข็น</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="set_forcus">Set focus</label>
                <select class="form-control" name="set_forcus" id="set_forcus" required>
                    <option value="1" <?php $data[0]['set_forcus'] == 1 ? print 'selected' : ''; ?>>add item input</option>

                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-4">
                <label for="view_invoice">ดูใบแจ้งหนี้</label>
                <select class="form-control" name="view_invoice" id="view_invoice" required>
                    <option value="1" <?php $data[0]['view_invoice'] == 1 ? print 'selected' : ''; ?>>มาตรฐาน</option>
                </select>
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