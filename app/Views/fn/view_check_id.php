<div class="modal-header">
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>-->
    <h4 class="modal-title" id="myModalLabel">
        <center><?= $title ?></center>
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>