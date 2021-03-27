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
                        <?php foreach ($data as $x) :

                            $gen = [
                                '1' => 'นาย',
                                '2' => 'นาง',
                                '3' => 'นางสาว',
                            ];
                        ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่ สธ :</td>
                                <td><?php echo $x['id_cus']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>ผ่านหัวหน้าฝ่าย :</td>
                                <td><?php echo $x['responsible']; ?></td>
                            </tr>
                            <tr>
                                <td>คำนำหน้า :</td>
                                <td><?php echo $gen[$x['gender']]; ?></td>
                            </tr>
                            <tr>
                                <td>ฝ่าย :</td>
                                <td>
                                    <?php echo $x['group']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>มีความประสงค์จะขอแจ้งซ่อม :</td>
                                <td><?php echo $x['request']; ?></td>
                            </tr>
                            <tr>
                                <td>เนื่องจาก :</td>
                                <td><?php echo $x['since']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่ครุภัณฑ์ :</td>
                                <td><?php echo $x['number']; ?></td>
                            </tr>
                            <tr>
                                <td>รายละเอียด/หมายเหตุ :</td>
                                <td><?php echo $x['note']; ?></td>
                            </tr>
                            <tr>
                                <td>สถานะ :</td>
                                <td><?php echo $x['reason']; ?></td>
                            </tr>
                            <tr>
                                <td>เรียน :</td>
                                <td><?php echo $x['to']; ?></td>
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