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
                                <td>ประเภท :</td>
                                <td><?php echo $x['type_id']; ?></td>
                            </tr>
                            <tr>
                                <td>สถานะ :</td>
                                <td><?php echo $x['status_id']; ?></td>
                            </tr>
                            <tr>
                                <td>ตัดเลขที่บัญชี(จากฝังบัญชี) :</td>
                                <td><?php echo $x['no_id']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td>
                                    <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['date']))); ?> -->
                                    <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสาร :</td>
                                <td><?php echo $x['withdrawal_slip']; ?></td>
                            </tr>
                            <tr>
                                <td>เพิ่มเติม :</td>
                                <td><?php echo $x['note']; ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงินทั้งสิ้น :</td>
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