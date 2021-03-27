<style>
    .textright {
        text-align: right;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
    }

    /* Style the buttons inside the tab */
    .tab div {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab div:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab div.active {
        background-color: #0f7d41;
        color: white;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 0;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<div class="tab">
    <!-- <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button> -->
    <div class="tablinks active" onclick="openCity(event, 'all')" id="all_tab">บันทึกสินทรัพย์</div>
    <!-- <div class="tablinks" onclick="openCity(event, 'tab2')">บันทึกคิดค่าเสื่อม</div> -->
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block; ">
    <form method="post" action="<?= base_url('supplies/edit_asset/'.$data[0]['id']) ?>">
        <div class="row search_tab" style="margin-bottom: 1%;margin:0 0 0 0; padding: 11px 0 11px 0;background: #0f7d41;">
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="type">คำนวณค่าเสื่อมแบบ</label>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="type" id="type" required>
                    <option selected value="1">เส้นตรง</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="category">หมวดสินทรัพย์</label>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="category" id="category" required>
                    <option selected value="">เลือกหมวดสินทรัพย์</option>
                    <?php foreach ($category as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $data[0]['category'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="date">วันที่เริ่มคิดค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="price">ราคาที่ใช้คิดค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="price" class="form-control money" name="price" value="<?= $data[0]['price'] ? $data[0]['price'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="carcass">ราคาซาก</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="carcass" class="form-control money" name="carcass" value="<?= $data[0]['carcass'] ? $data[0]['carcass'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="rate_type">อัตราค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="rate_type" id="rate_type" required>
                    <option selected value="1">อายุการใช้งาน</option>
                    <option value="2">อัตราค่าเสื่อม</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-2 offset-md-6">
                <input type="number" id="rate_value" class="form-control" name="rate_value" value="<?= $data[0]['rate_value'] ? $data[0]['rate_value'] : 1 ?>" required />
            </div>
            <div class="col-md-2" id="unit">ปี</div>
        </div>
        <!-- <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="year">อายุการใช้งาน</label>
            </div>
            <div class="col-md-2">
                <input type="number" id="year" class="form-control" name="year" value="<?= $data[0]['year'] ? $data[0]['year'] : 1 ?>" required />
            </div>
            <div class="col-md-2">ปี</div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="rate">อัตราค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <input type="number" id="rate" class="form-control" name="rate" value="<?= $data[0]['rate'] ? $data[0]['rate'] : 0 ?>" required />
            </div>
            <div class="col-md-2">%</div>
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
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $(document).ready(function() {
        $('#rate_type').change(function() {
            if ($(this).val() == 1) {
                $("#unit").text("ปี");
            } else if ($(this).val() == 2) {
                $("#unit").text("%");
            }
        });
        $('#rate_type').trigger('change');
    });
</script>