<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>
<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('finance/report_billing') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite">ค้นหา </label>
            <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th>รหัสสมาชิก </th>
                    <th>ชื่อสมาชิก </th>
                    <th>วันที่</th>
                    <th>เครดิต(วัน)</th>
                    <th>จำนวนเงิน(บาท) </th>
                    <th>ภาษี 7% (บาท)</th>
                    <th>จำนวนทั้งสิ้น(บาท) </th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/report_billing_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                            <td href="<?= base_url('finance/report_billing_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                            <td href="<?= base_url('finance/report_billing_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <?php echo Date('d/m/Y', strtotime($x['date'])); ?>
                            </td>
                            <td href="<?= base_url('finance/report_billing_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum">
                                <center><?php echo $x['day']; ?></center>
                            </td>
                            <td href="<?= base_url('finance/report_billing_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <?php
                            $vat = $x['amount'] * 0.07;
                            ?>
                            <td href="<?= base_url('finance/report_billing_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($vat, 2); ?></scenter>
                            </td>
                            <td href="<?= base_url('finance/report_billing_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'] + $vat, 2); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <!-- <a class="dropdown-item" href="<?= base_url('finance/view_billing') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/edit_billing') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/delete_billing') . '/' . $x['id'] ?>" onclick="return confirm('ยืนยัน ?')">ลบ</a> -->
                                        <a class="dropdown-item" href="<?= base_url('finance/report_billing_pdf') . '/' . $x['id'] ?>">รายงาน</a>
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