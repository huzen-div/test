<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>วันที่เช็ค :</td>
                    <td>
                            <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['check_date']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['check_date'])); ?>
                </td>
                </tr>
                <tr>
                    <td>วันที่ออกเช็ค :</td>
                    <td>
                            <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['check_issue']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['check_issue'])); ?>
                </td>
                </tr>
                <tr>
                    <td>เลขที่เช็ค :</td>
                    <td><?php echo $x['cheack_id']; ?></td>
                </tr>
                <tr>
                    <td>ตัดบัญชี :</td>
                    <td><?php echo $x['type_id']; ?></td>
                </tr>
                <tr>
                    <td>รหัส :</td>
                    <td><?php echo $x['debit_id']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงิน :</td>
                    <td><?php echo $x['amount']; ?></td>
                </tr>
                <tr>
                    <td>จ่ายให้ :</td>
                    <td><?php echo $x['pay_for']; ?></td>
                </tr>
                <tr>
                    <td>สถานะเช็ค :</td>
                    <td><?php echo $x['check_status']; ?></td>
                </tr>
                <tr>
                    <td>ยอดเหลือ :</td>
                    <td><?php echo $x['balance']; ?></td>
                </tr>
                <tr>
                    <td>วันที่ผ่านเช็ค :</td>
                    <td>
                            <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['passed_date']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['passed_date'])); ?>
                    </td>
                </tr>
                <tr>
                    <td>ยอดค่าใช้จ่าย :</td>
                    <td><?php echo $x['cost']; ?></td>
                </tr>
                <tr>
                    <td>เพิ่มเติม :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- <div class="col-md-12" style="text-align: center;">
    <div class="buttons">
        <div class="btn-group btn-group-justified ">
            <div class="btn-group">
                <a href="" class="tip btn btn-warning tip btn-lg " title="แก้ไข">
                    <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">แก้ไข</span>
                </a>
            </div>
            <div class="btn-group">
                <a href="" class="tip btn btn-danger tip btn-lg " title="ลบ">
                    <i class="fa fa-trash"></i> <span class="hidden-sm hidden-xs">ลบ</span>
                </a>
            </div>
        </div>
    </div>
</div> -->
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>