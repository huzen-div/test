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
    <div class="tablinks" onclick="openCity(event, 'tab2')">บันทึกคิดค่าเสื่อม</div>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block; ">
    <form method="post" action="<?= base_url('supplies/depreciation') ?>">
        <div class="row search_tab" style="margin:0;margin-bottom: 1%; padding: 11px 0 11px 0;background: #0f7d41;">
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
                        <option value="<?= $row['id'] ?>" <?php $_POST['category'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['category_name'] ?></option>
                    <?php } ?>
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
                <input type="number" id="rate_value" class="form-control" name="rate_value" value="<?= $_POST['rate_value'] ? $_POST['rate_value'] : 1 ?>" required />
            </div>
            <div class="col-md-2" id="unit">ปี</div>
        </div>
        <!-- <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="year">อายุการใช้งาน</label>
            </div>
            <div class="col-md-2">
                <input type="number" id="year" class="form-control" name="year" value="<?= $_POST['year'] ? $_POST['year'] : 1 ?>" required />
            </div>
            <div class="col-md-2">ปี</div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="rate">อัตราค่าเสื่อม</label>
            </div>
            <div class="col-md-2">
                <input type="number" id="rate" class="form-control" name="rate" value="<?= $_POST['rate'] ? $_POST['rate'] : 0 ?>" required />
            </div>
            <div class="col-md-2">%</div>
        </div> -->

        <div class="row">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="asset" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
    <form action="<?= base_url('supplies/depreciation') ?>" method="POST">
        <div class="row search_tab" style="margin:0;margin-top: 1%; ">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search1" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
            <select class="form-control col-md-2" name="category_search1" id="category_search1" style="margin-left: 1%;">
                <option selected value="">เลือกหมวดสินทรัพย์</option>
                <?php foreach ($category as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                <?php } ?>
            </select>
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell1" value="Export to Excel" alt="Submit" class="excelimg">
        </div>

        <div class="table-responsive p-2">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <div class="text-center"><input name="select_all1" id="select-all1" type="checkbox" /></div>
                        </th>
                        <th>ลำดับ</th>
                        <th>คำนวณค่าเสื่อมแบบ</th>
                        <th>หมวดสินทรัพย์</th>
                        <th>วันที่เริ่มคิดค่าเสื่อม </th>
                        <th>ราคาที่ใช้คิดค่าเสื่อม</th>
                        <th>ราคาซาก </th>
                        <th>อัตราค่าเสื่อม </th>
                        <th>การจัดการ </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ty = [
                        '1' => 'เส้นตรง'
                    ];
                    $no = 1;
                    if ($asset) : ?>
                        <?php foreach ($asset as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td href="<?= base_url('supplies/view_asset_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                <td href="<?= base_url('supplies/view_asset_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $ty[$x['type']]; ?></td>
                                <td href="<?= base_url('supplies/view_asset_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['category_name']; ?></td>
                                <td href="<?= base_url('supplies/view_asset_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                <td href="<?= base_url('supplies/view_asset_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['price'], 2); ?></td>
                                <td href="<?= base_url('supplies/view_asset_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['carcass'], 2); ?></td>
                                <td href="<?= base_url('supplies/view_asset_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['rate_value'] . ($x['rate_type'] == 1 ? ' ปี' : ($x['rate_type'] == 2 ? '%' : '')); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            การจัดการ
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actions">
                                            <a class="dropdown-item" href="<?= base_url('supplies/view_asset') . '/' . $x['id'] ?>">รายละเอียด</a>
                                            <a class="dropdown-item" href="<?= base_url('supplies/edit_asset') . '/' . $x['id'] ?>">แก้ไข</a>
                                            <a class="dropdown-item" href="<?= base_url('supplies/delete_asset') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
<div id="tab2" class="tabcontent" style="padding-top: 0;">
    <form method="post" action="<?= base_url('supplies/depreciation') ?>">
        <div class="row search_tab" style="margin:0;margin-bottom: 1%;padding: 11px 0 11px 0;background: #0f7d41;">
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
                        <option value="<?= $row['id'] ?>" <?php $_POST['category'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="charged">คิดค่าเสื่อมสะสมยกมา</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="charged" class="form-control money" name="charged" value="<?= $_POST['charged'] ? $_POST['charged'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="calculated">ค่าเสื่อมที่คำนวณเอง</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="calculated" class="form-control money" name="calculated" value="<?= $_POST['calculated'] ? $_POST['calculated'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="calculated_date">คำนวณเองถึงวันที่</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="calculated_date" class="datetimepicker2 form-control" name="calculated_date" value="<?= $_POST['calculated_date'] ? $_POST['calculated_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="initial">ค่าเสื่อมเบื้องต้น</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="initial" class="form-control money" name="initial" value="<?= $_POST['initial'] ? $_POST['initial'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="sale_date">วันที่ขาย</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="sale_date" class="datetimepicker2 form-control" name="sale_date" value="<?= $_POST['sale_date'] ? $_POST['sale_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="sale_price">ราคาขาย</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="sale_price" class="form-control money" name="sale_price" value="<?= $_POST['sale_price'] ? $_POST['sale_price'] : 0 ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6" style="text-align: right;">
                <label for="profit_loss">กำไร / ขาดทุน</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="profit_loss" class="form-control money" name="profit_loss" value="<?= $_POST['profit_loss'] ? $_POST['profit_loss'] : 0 ?>" required />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="depreciation" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
    <form action="<?= base_url('supplies/depreciation') ?>" method="POST">
        <div class="row search_tab" style="margin:0;margin-top: 1%;">
            <label for="txt_search2" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search2" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
            <!-- <select class="form-control col-md-2" name="category_search2" id="category_search1" style="margin-left: 1%;">
                <option selected value="">เลือกหมวดสินทรัพย์</option>
                <?php foreach ($category as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                <?php } ?>
            </select> -->
            <input type="button" id="bt_search2" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell2" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <div class="text-center"><input name="select_all2" id="select-all2" type="checkbox" /></div>
                        </th>
                        <th>ลำดับ</th>
                        <th>คิดค่าเสื่อม</th>
                        <th>คิดค่าเสื่อมสะสมยกมา</th>
                        <th>ค่าเสื่อมคำนวณ </th>
                        <th>คำนวณเองถึงวันที่</th>
                        <th>ค่าเสื่อมเบื้องต้น </th>
                        <th>วันที่ขาย </th>
                        <th>ราคาขาย </th>
                        <th>กำไร/ขาดทุน </th>
                        <th>การจัดการ </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ty = [
                        '1' => 'รายปี'
                    ];
                    $no = 1;
                    if ($depreciation) : ?>
                        <?php foreach ($depreciation as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $ty[$x['type']]; ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['charged'], 2); ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['calculated'], 2); ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['calculated_date'])); ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['initial'], 2); ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['sale_date'])); ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['sale_price'], 2); ?></td>
                                <td href="<?= base_url('supplies/view_depreciation_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['profit_loss'], 2); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            การจัดการ
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actions">
                                            <a class="dropdown-item" href="<?= base_url('supplies/view_depreciation') . '/' . $x['id'] ?>">รายละเอียด</a>
                                            <a class="dropdown-item" href="<?= base_url('supplies/edit_depreciation') . '/' . $x['id'] ?>">แก้ไข</a>
                                            <a class="dropdown-item" href="<?= base_url('supplies/delete_depreciation') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
        var table = $('#dataTable').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ],
            responsive: true

        });
        $("#txt_search1").on('keyup click', function() {
            table.search($(this).val()).draw();
        });

        $('#select-all1').on('click', function() {
            var rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all1').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });



        $('#rate_type').trigger('change');
        var table2 = $('#dataTable2').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ],
            responsive: true

        });
        // $("#txt_search2").on('keyup click', function() {
        //     table2.search($(this).val()).draw();
        // });
        $('#bt_search2').on('click', function() {
            if (table2.search() !== $("#txt_search2").val()) {
                table2
                    .search($("#txt_search2").val())
                    .draw();
            }
        });
        $('#select-all2').on('click', function() {
            var rows = table2.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all2').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
    });
</script>