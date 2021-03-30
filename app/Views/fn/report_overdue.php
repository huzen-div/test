<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('finance/report_overdue') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite">ค้นหา </label>
            <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <!-- <input type="button" class="btn btn-warning offset-md-3" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="row" style="margin-bottom: 1%;">
        </div>
        <hr>
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th>รหัสสมาชิก </th>
                    <th>ชื่อสมาชิก </th>
                    <th>วันที่</th>
                    <th>เครดิต(วัน) </th>
                    <th>จำนวนเงิน(บาท) </th>
                    <th>ภาษี 7% (บาท)</th>
                    <th>จำนวนทั้งสิ้น(บาท) </th>
                    <th>อนุมัติ </th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php
                    $ty = [
                        '1' => 'ยังไม่ชำระเงิน',
                        '2' => 'ชำระเงินแล้ว',
                        '3' => 'ค้างชำระ',
                        '4' => 'ระหว่างชำระ',
                    ];
                    foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                            </td>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum">
                                <center><?php echo $x['day']; ?></center>
                            </td>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <?php
                            $vat = $x['amount'] * 0.07;
                            ?>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($vat, 2); ?></td>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'] + $vat, 2); ?></td>
                            <td href="<?= base_url('finance/view_overdue_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <?php if ($x['add_debt_id'] == 3) { ?>
                                    <font color="green"><?php echo "ดำเนินการ"; ?> </font>
                                <?php } else if ($x['add_debt_id'] == 1) { ?>
                                    <font color="red"><?php echo "ไม่อนุมัติ"; ?> </font>
                                <?php } else if ($x['add_debt_id'] == 2) { ?>
                                    <font color="blue">
                                        <?php echo "อนุมัติ"; ?>
                                    </font>
                                <?php } else if ($x['add_debt_id'] == 4) { ?>
                                    <font color="pink"><?php echo "จ่ายเงินทายาท"; ?> </font>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <!-- <a class="dropdown-item" href="<?= base_url('finance/view_overdue') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/edit_overdue') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/delete_overdue') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a> -->
                                        <a class="dropdown-item" href="<?= base_url('finance/report_overdue_pdf') . '/' . $x['id'] ?>">รายงาน</a>

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
        window.location = "/finance/overdue";
    }
</script>