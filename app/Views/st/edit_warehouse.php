<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('setting/edit_warehouse/' . $data[0]['id']) ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="name">ชื่อ</label>
                <input type="text" id="name" class="form-control" name="name" value="<?= $data[0]['name'] ? $data[0]['name'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="tel">โทรศัพท์</label>
                <input type="text" id="tel" class="form-control telephone" name="tel" value="<?= $data[0]['tel'] ? $data[0]['tel'] : '' ?>" pattern="[0-9]{10}" placeholder="xxxxxxxxxx" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="email">อีเมลล์</label>
                <input type="email" id="email" class="form-control" name="email" value="<?= $data[0]['email'] ? $data[0]['email'] : '' ?>" />
            </div>
            <div class="col-md-5">

                <label for="map">แผนที่คลังสินค้า</label>
                <input type='file' class="form-control" id="image" accept="image/*" name="map" />
            </div>
            <div class="col-md-1">
                <?php
                if ($data[0]['map'] == NULL) {
                    $data[0]['map'] = 'noimages.png';
                }
                ?>
                <img id="preview_image" class="img-fluid" src="<?= base_url('files/' . $data[0]['map']); ?>" alt="your image" style="margin: 1%;width: 100px;" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="address">ที่อยู่</label>
                <textarea class="form-control" rows="1" name="address" id="address"><?= $data[0]['address'] ?? $data[0]['address']  ?></textarea>
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
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }
    setInputFilter(document.getElementById("tel"), function(value) {
        return /^-?\d{0,10}$/.test(value);
    });
</script>