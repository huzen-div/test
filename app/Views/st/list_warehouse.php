<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>
<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('setting/list_warehouse') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />

            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <!-- <table class="table" id="datatable"> -->

                        <thead>
                            <tr>
                                <th>
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th>
                                <th align="center">แผนที่</th>
                                <th align="center">รหัส</th>
                                <th align="center">ชื่อ</th>
                                <th align="center">โทรศัพท์</th>
                                <th align="center">อีเมลล์</th>
                                <th align="center">ที่อยู่ </th>
                                <th align="center">จัดการ </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($data) : ?>
                                <?php foreach ($data as $x) : ?>
                                    <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <!-- <td><?php echo $x['map']; ?></td> -->
                                        <td href="<?= base_url('setting/view_warehouse_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" style="width: 150px;">
                                            <?php if ($x['map'] != null) { ?>
                                                <a title="<?php echo $x['name']; ?>" href="<?= base_url('files') . '/' . $x['map'] ?>" target="_blank">
                                                    <img src="<?= base_url('files') . '/' . $x['map'] ?>" alt="image" class="imgdeb_pre">
                                                </a>
                                            <?php } else { ?>
                                                <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" class="imgdeb_pre">

                                            <?php } ?>
                                        </td>
                                        <td href="<?= base_url('setting/view_warehouse_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('setting/view_warehouse_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                                        <td href="<?= base_url('setting/view_warehouse_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['tel']; ?></td>
                                        <td href="<?= base_url('setting/view_warehouse_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['email']; ?></td>
                                        <td href="<?= base_url('setting/view_warehouse_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['address']; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="<?= base_url('setting/view_warehouse') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('setting/edit_warehouse') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('setting/delete_warehouse') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
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
        window.location = "/setting/warehouse";
    }
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }, {
                'targets': 1,
                'searchable': false,
                'orderable': false
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [2, "asc"]
            ],
            responsive: true

        });
        // $("#search").on('keyup click', function() {
        //     table.columns(2).search($(this).val()).draw();
        // });
        $('#bt_search').on('click', function() {
            // console.log(this.value);
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