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
                        <?php foreach ($data as $x) :  $ar = ['1' => 'วัสดุสิ้นเปลือง', '2' => 'สินทรัพย์', '3' => 'วัตถุดิบ', '4' => 'อื่นๆ: ' . $x['type_detail']]; ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>ผู้ขอซื้อ :</td>
                                <td><?php echo $x['employees_id']; ?></td>
                            </tr>
                            <tr>
                                <td>แผนก/ฝ่าย :</td>
                                <td> <?php echo $x['department']; ?> </td>
                            </tr>
                            <tr>
                                <td>เลขที่ :</td>
                                <td><?php echo $x['reference']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>ประเภท :</td>
                                <td> <?php echo $ar[$x['type_id']]; ?> </td>
                            </tr>
                            <tr>
                                <td>ผู้จัดจำหน่าย :</td>
                                <td> <?php echo $x['distributor']; ?> </td>
                            </tr>
                            <tr>
                                <td>เอกสารแนบ :</td>
                                <td> <?php echo $x['document']; ?> </td>
                            </tr>
                            <tr>
                                <td>ใบสั่ง ภาษี :</td>
                                <td> <?php echo $tax[0]['name']; ?> </td>
                            </tr>
                            <tr>
                                <td>ส่วนลด :</td>
                                <td> <?php echo $x['discount']; ?> </td>
                            </tr>
                            <tr>
                                <td>ประเภทการซ่อม :</td>
                                <td> <?php echo $x['type_maintenance']; ?> </td>
                            </tr>
                            <tr>
                                <td>Payment term :</td>
                                <td> <?php echo $x['payment_term']; ?> </td>
                            </tr>
                            <tr>
                                <td>อื่นๆ :</td>
                                <td> <?php echo $x['note']; ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" class="btn btn-warning " value="ปริ้น" />
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>