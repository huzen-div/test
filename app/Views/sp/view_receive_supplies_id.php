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
                        <?php
                        $ar = [
                            '0' => '',
                            '1' => 'รับเรียบร้อย',
                            '2' => 'ระหว่างดำเนินการ',
                            '3' => 'ยังไม่ได้รับ',
                            '4' => 'ยกเลิก',
                        ];
                        foreach ($data as $x) : ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่รับเข้า :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสาร :</td>
                                <td><?php echo $x['reference']; ?></td>
                            </tr>
                            <tr>
                                <td>ผู้นำเข้า :</td>
                                <td><?php echo $x['importer']; ?></td>
                            </tr>
                            <tr>
                                <td>รหัสพนักงาน :</td>
                                <td><?php echo $x['employees_id']; ?></td>
                            </tr>
                            <tr>
                                <td>แผนก/ฝ่าย :</td>
                                <td><?php echo $x['department']; ?></td>
                            </tr>
                            <?php if ($x['document'] != null) { ?>
                                <tr>
                                    <td>เอกสารแนบ :</td>
                                    <td><a href="<?php echo base_url('files/receive_supplies_files') . '/' . $x['document']; ?>">ไฟล์</a></td>

                                </tr>
                            <?php } ?>
                            <tr>
                                <td>นำเข้าคลัง :</td>
                                <td><?php echo $x['name']; ?></td>
                            </tr>
                            <tr>
                                <td>สถานะ :</td>
                                <td><?php echo $ar[$x['status']]; ?></td>
                            </tr>
                            <tr>
                                <td>อื่นๆ :</td>
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