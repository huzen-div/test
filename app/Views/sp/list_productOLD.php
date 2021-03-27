<!-- <?php var_dump($sumproduct); ?> -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>ครุภัณฑ์ทั้งหมด</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $sumproduct ? $sumproduct : 0; ?> </font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('supplies/list_product'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>ครุภัณฑ์ที่ใช้งานได้</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $sumactive ? $sumactive : 0; ?> </font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('supplies/list_product/1'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>ครุภัณฑ์เสื่อมสภาพ</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $suminactive ? $suminactive : 0; ?> </font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('supplies/list_product/2'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>ครุภัณฑ์ที่รอจำหน่าย</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $sumother ? $sumother : 0; ?></font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('supplies/list_product/3'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('supplies/list_product') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">

            <!-- <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" /> -->

            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่มครุภัณฑ์" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th>
                                <th align="center">ลำดับ</th>
                                <th align="center">เลขที่เอกสาร </th>
                                <th align="center">ชื่อสินค้า </th>
                                <th align="center">ผู้ดำเนินการ </th>
                                <th align="center">หน่วยนับ</th>
                                <th align="center">จำนวนเงิน(บาท) </th>
                                <th align="center">ภาษี7%(VAT) </th>
                                <th align="center">จำนวนทั้งสิ้น(บาท) </th>
                                <th align="center">วันที่ </th>
                                <th align="center">จำนวนพัสดุทั้งหมด </th>
                                <th align="center">จัดการ </th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($data) :
                                $ar = [
                                    '0' => '',
                                    '1' => 'ครุภัณฑ์ที่ใช้งานได้',
                                    '2' => 'ครุภัณฑ์เสื่อมสภาพ',
                                    '3' => 'ครุภัณฑ์ที่รอจำหน่าย',
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
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['price'], 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $vat; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($total, 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $sumproduct ? $sumproduct : 0; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="<?= base_url('supplies/view_product') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/delete_product') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/modal_barcode') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">สร้าง Barcode</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
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
        window.location = "/supplies/product";
    }
    $(document).ready(function() {
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
            table.columns(2).search($(this).val()).draw();
        });
        // $('#bt_search').on('click', function() {
        //     // console.log(this.value);
        //     if (table.search() !== $("#txt_search").val()) {
        //         table
        //             .search($("#txt_search").val())
        //             .draw();
        //     }
        // });
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
