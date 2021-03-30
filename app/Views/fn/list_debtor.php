<!-- <?php var_dump($data); ?> -->

<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('finance/list_debtor') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
            <!-- <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" /> -->
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่มข้อมูลสมาชิก" style="margin-right: 2%;margin-left: 1%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th>ลำดับ</th>
                    <th>รูปภาพสมาชิก</th>
                    <th>ชื่อสมาชิก</th>
                    <th>รหัสสมาชิก</th>
                    <th>อายุสมาชิก</th>
                    <th>เลขบัตรประชาชน</th>
                    <th>เลขที่บัญชี</th>
                    <th>วันเกิด</th>
                    <th>สถานะ</th>
                    <th>ยอดคงเหลือ</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php
                    foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td style="width: 150px;">
                                <?php if ($x['image'] != null) { ?>
                                    <a title="<?php echo $x['name']; ?>" href="<?= base_url('files') . '/' . $x['image'] ?>" target="_blank">
                                        <img src="<?= base_url('files') . '/' . $x['image'] ?>" alt="image" class="imgdeb_pre">
                                    </a>
                                <?php } else { ?>
                                    <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" class="imgdeb_pre">

                                <?php } ?>
                            </td>
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">MOPH-<?php echo sprintf('%07d', $x['id']); ?></td>
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php
                                $date = new DateTime($x['date']);
                                $now = new DateTime();
                                $now = $now->modify('+543 year');
                                $interval = $now->diff($date);
                                echo $interval->y;
                                ?></td>
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['taxpayer_number']; ?></td>
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['follower_account_number']; ?></td>
                            <!-- <td class="textnum"><?php echo $x['account_number']; ?></td> -->
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            <!-- <td><?php echo $x['date']; ?></td> -->
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['alive']; ?></td>
                            <td href="<?= base_url('finance/view_debtor_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['balance'], 2); ?></td>
                            <!-- <td><?php echo $x['balance']; ?></td> -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('finance/view_debtor') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/edit_debtor') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/delete_debtor') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่ ?')">ลบ</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>

<script>
    function myFunction() {
        window.location = "/finance/debtor";
        // location.replace("/finance/debtor")
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
            table.search($(this).val()).draw();
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