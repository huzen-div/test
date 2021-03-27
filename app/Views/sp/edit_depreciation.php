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
    <div class="tablinks active" onclick="openCity(event, 'tab2')">บันทึกคิดค่าเสื่อม</div>
</div>

<div id="tab2" class="tabcontent" style="padding-top: 0; display:block;">
    <form method="post" action="<?= base_url('supplies/edit_depreciation/'.$data[0]['id']) ?>">
        <div class="row search_tab" style="margin-bottom: 1%;margin:0 0 0 0; padding: 11px 0 11px 0;background: #0f7d41;">
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="type">คิดค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="type" id="type" required>
                    <option selected value="1">รายปี</option>
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
                <label for="charged">คิดค่าเสื่อมสะสมยกมา</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="charged" class="form-control money" name="charged" value="<?= $data[0]['charged'] ? $data[0]['charged'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="calculated">ค่าเสื่อมที่คำนวณเอง</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="calculated" class="form-control money" name="calculated" value="<?= $data[0]['calculated'] ? $data[0]['calculated'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="calculated_date">คำนวณเองถึงวันที่</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="calculated_date" class="datetimepicker2 form-control" name="calculated_date" value="<?= $data[0]['calculated_date'] ? $data[0]['calculated_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="initial">ค่าเสื่อมเบื้องต้น</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="initial" class="form-control money" name="initial" value="<?= $data[0]['initial'] ? $data[0]['initial'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="sale_date">วันที่ขาย</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="sale_date" class="datetimepicker2 form-control" name="sale_date" value="<?= $data[0]['sale_date'] ? $data[0]['sale_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="sale_price">ราคาขาย</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="sale_price" class="form-control money" name="sale_price" value="<?= $data[0]['sale_price'] ? $data[0]['sale_price'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="profit_loss">กำไร / ขาดทุน</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="profit_loss" class="form-control money" name="profit_loss" value="<?= $data[0]['profit_loss'] ? $data[0]['profit_loss'] : 0 ?>" required />
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
        var table = $('#dataTable2').DataTable({
            // columnDefs: [{
            //     'targets': 0,
            //     'searchable': false,
            //     'orderable': false,
            //     'className': 'dt-body-center',
            //     'render': checkbox
            // }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ],
            responsive: true

        });
    });
</script>