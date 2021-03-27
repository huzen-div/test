<!-- <?php var_dump($data); ?> -->
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('finance/list_receiving_money') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite">ค้นหา </label>
            <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">


            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <!-- <input class="form-control col-md-3" name="datepicker_from" type="date" id="datepicker_from" /> -->
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <!-- <input class="form-control col-md-3" name="datepicker_to" type="date" id="datepicker_to" /> -->
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">

            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />

            <!-- <label id="search-label-from" class="col-md-1">ค้นหา:</label><input class="form-control col-md-3" type="text" name="txt" value="<?php echo isset($txt) ? $txt : ''; ?>" id="search" /> -->
            <!-- <label id="date-label-from" class="col-md-1">เริ่ม:</label><input class="form-control col-md-3" name="datepicker_from" value="<?php echo isset($from) ? $from : ''; ?>" type="date" id="datepicker_from" />
        <label id="date-label-to" class="col-md-1">สิ้นสุด:</label><input class="form-control col-md-3" name="datepicker_to"  value="<?php echo isset($to) ? $to : ''; ?>"  type="date" id="datepicker_to" /> -->
            <!-- <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" /> -->
            <!-- <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" /> -->

            <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" />
            <!-- <input type="submit" class="btn btn-success offset-md-3" name="excell" value="Export to Excel" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">

        </div>
        <hr>
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>

                    <th>เลขที่ใบเสร็จรับเงิน</th>
                    <th>รหัสสมาชิก</th>
                    <th>ชื่อสมาชิก</th>
                    <th>เลขที่เอกสาร </th>
                    <th>รหัสพนักงาน </th>
                    <th>เครดิต(วัน)</th>
                    <th>วันนัดรับชำระ </th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_receiving_money_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_receiving_money_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <center><?php echo "MOPH-" . sprintf('%07d', $x['customer_id']); ?></center>
                            </td>
                            <td href="<?= base_url('finance/view_receiving_money_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                            <td href="<?= base_url('finance/view_receiving_money_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum">
                                <center><?php echo $x['bill_id']; ?></center>
                            </td>
                            <td href="<?= base_url('finance/view_receiving_money_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum">
                                <center><?php echo $x['employee_id']; ?></center>
                            </td>
                            <td href="<?= base_url('finance/view_receiving_money_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum">
                                <center><?php echo $x['unit_id']; ?></center>
                            </td>

                            <!-- <td><?php echo thaidate(date('d/m/Y', strtotime($x['bill_date']))); ?></td> -->
                            <td href="<?= base_url('finance/view_receiving_money_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['bill_date'])); ?></td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('finance/view_receiving_money') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/edit_receiving_money') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/delete_receiving_money') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/view_receiving_moneypdf') . '/' . $x['id'] ?>" target="_blank">พิมพ์ใบเสร็จ</a>
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
        window.location = "/finance/receiving_money";
        // location.replace("/finance/receiving_money")
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
        // $("#search").on('keyup click', function() {
        //     table.columns(2).search($(this).val()).draw();
        // });
        // $('#search').on('keyup change', function() {
        //     // console.log(this.value);
        //     if (table.search() !== this.value) {
        //         table
        //             .search(this.value)
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