<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"> <?= $title ?> </button>
</div>
<div id="all" class="tabcontent" style="padding-top: 0;">
    <form action="<?= base_url('supplies/list_transfer') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="card mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th rowspan="2">
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th>
                                <th rowspan="2" align="center">ลำดับ</th>
                                <th rowspan="2" align="center">เลขที่เอกสาร </th>
                                <th rowspan="2" align="center">รหัสครุภัณฑ์/วัสดุภัณฑ์ </th>
                                <th rowspan="2" align="center">ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                                <th rowspan="2" align="center">จำนวนโอน</th>
                                <th colspan="2" align="center">โอนออกจาก </th>
                                <th colspan="2" align="center">โอนเข้า </th>
                                <th rowspan="2" align="center">จัดการ </th>
                            </tr>
                            <tr>
                                <th>รหัสแผนก</th>
                                <th>รหัสที่ตั้ง</th>
                                <th>รหัสแผนก</th>
                                <th>รหัสที่ตั้ง</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($data) :
                                $ar = [
                                    '0' => '',
                                    '1' => 'active',
                                    '2' => 'inactive',
                                    '3' => 'other',
                                ];
                                foreach ($data as $x) :
                                    $vat = 0;
                                    $total = 0;
                                    if ($x['type'] == '1') {
                                        $vat = $x['tax_rate'];
                                    } elseif ($x['type'] == '2') {
                                        $vat = ($x['price'] * $x['tax_rate']) / 100;
                                    }
                                    $total = $vat + $x['price']; ?>
                                    <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['product_code']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['responsible']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['unit_name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $x['price']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $vat; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $total; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="<?= base_url('supplies/view_product') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/delete_product') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                                    <!-- <a class="dropdown-item" href="<?= base_url('supplies/modal_barcode') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">สร้าง Barcode</a> -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function myFunction() {
        window.location = "/supplies/transfer";

    }
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

        $("#all_tab").addClass("active");
        $("#all").css("display", "block");
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
        $("#txt_search").on('keyup click', function() {
            table.search($(this).val()).draw();
        });
        $('#select-all').on('click', function() {
            var rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
    });
</script>