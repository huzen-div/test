<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('supplies/barcode') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-2 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />

            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่มสินค้า" style="margin-left: 2%;" />
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
                                <th align="center">โครงการจัดซื้อจัดจ้าง </th>
                                <th align="center">ผู้ดำเนินการ </th>
                                <th align="center">หน่วยนับ</th>
                                <th align="center">งบประมาณ(บาท) </th>
                                <th align="center">ภาษี7%(VAT) </th>
                                <th align="center">จำนวนทั้งสิ้น(บาท) </th>
                                <th align="center">วันที่ </th>
                                <th align="center">จัดการ </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
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
                                    $total = $vat + $x['price'];
                            ?>
                                    <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $x['product_code']; ?></td>
                                        <td><?php echo $x['name']; ?></td>
                                        <td><?php echo $x['responsible']; ?></td>
                                        <td><?php echo $x['unit_name']; ?></td>
                                        <td class="textnum"><?php echo $x['price']; ?></td>
                                        <td class="textnum"><?php echo $vat; ?></td>
                                        <td class="textnum"><?php echo $total; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
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
                                <?php $no++;
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
        $('#bt_search').on('click', function() {
            if (table.search() !== $("#txt_search").val()) {
                table
                    .search($("#txt_search").val())
                    .draw();
            }
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