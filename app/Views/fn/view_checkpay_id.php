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
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>