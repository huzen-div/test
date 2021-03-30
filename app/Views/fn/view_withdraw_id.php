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
                                <td>ผู้ถอน :</td>
                                <td><?php echo $x['withdrawal']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ถอนเงิน :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>ผู้ดำเนินการ :</td>
                                <td><?php echo $x['operator']; ?></td>
                            </tr>
                            <tr>
                                <td>หน่วยงาน :</td>
                                <td><?php echo $x['agency']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่ :</td>
                                <td><?php echo $x['no']; ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงิน :</td>
                                <td><?php echo number_format($x['amount'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>ค่าบริการ :</td>
                                <td><?php echo number_format($x['service_charge'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงินทั้งสิ้น :</td>
                                <td><?php echo number_format($x['total'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>หมายเหตุ :</td>
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