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
                                <td>รหัสสมาชิก :</td>
                                <td><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                            </tr>
                            <tr>
                                <td>Bill to :</td>
                                <td><?php echo $x['bill_to']; ?></td>
                            </tr>
                            <tr>
                                <td>แผนก :</td>
                                <td><?php echo $x['department_id']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่กำหนด :</td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                                    <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['date']))); ?> -->

                                </td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['address']; ?></td>
                            </tr>
                            <tr>
                                <td>โทร :</td>
                                <td><?php echo $x['telephone']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสาร :</td>
                                <td><?php echo $x['document_id']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่ใบเพิ่มหนี้ :</td>
                                <td><?php echo $x['add_debt_id']; ?></td>
                            </tr>
                            <tr>
                                <td>ประเภท :</td>
                                <td><?php echo $x['type_id']; ?></td>
                            </tr>
                            <tr>
                                <td>เครดิต(วัน) :</td>
                                <td><?php echo $x['day']; ?></td>
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