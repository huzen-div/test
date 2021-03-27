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
                                <td>แผนก :</td>
                                <td><?php echo $x['department_id']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสาร :</td>
                                <td><?php echo $x['no']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td>
                                    <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['date']))); ?> -->
                                    <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>หมายเหตุ :</td>
                                <td><?php echo $x['reason']; ?></td>
                            </tr>
                            <tr>
                                <td>โอนจากบัญชี :</td>
                                <td><?php echo $x['transfer_from']; ?></td>
                            </tr>
                            <tr>
                                <td>โอนเข้าบัญชี :</td>
                                <td><?php echo $x['transfer_to']; ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงินที่โอน :</td>
                                <td><?php echo $x['amount']; ?></td>
                            </tr>
                            <tr>
                                <td>ค่าธรรมเนียม :</td>
                                <td><?php echo $x['fee']; ?></td>
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