<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>เข้าบัญชี :</td>
                    <td><?php echo $x['into_account']; ?></td>
                </tr>
                <tr>
                    <td>แผนก :</td>
                    <td><?php echo $x['department_id']; ?></td>
                </tr>
                <tr>
                    <td>หมายเหตุ :</td>
                    <td><?php echo $x['comment']; ?></td>
                </tr>
                <tr>
                    <td>ใบที่นำฝาก :</td>
                    <td>
                        <?php echo $x['deposit_id']; ?>
                    </td>
                </tr>
                <tr>
                    <td>วันที่นำฝาก :</td>
                    <td>
                        <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['deposit_date']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['deposit_date'])); ?>

                    </td>
                </tr>
                <tr>
                    <td>วันที่ผ่าน :</td>
                    <td>
                        <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['passed_date']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['passed_date'])); ?>

                    </td>
                </tr>
                <tr>
                    <td>วันที่ดำเนินการ :</td>
                    <td>
                        <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['implementation_date']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['implementation_date'])); ?>
                    </td>
                </tr>
                <tr>
                    <td>หมายเหตุ :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงิน :</td>
                    <td><?php echo $x['amount']; ?></td>
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