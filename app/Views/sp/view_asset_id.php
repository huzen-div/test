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
                        $ty = [
                            '0' => '',
                            '1' => 'เส้นตรง',

                        ];
                        foreach ($data as $x) : ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>คำนวณค่าเสื่อมแบบ :</td>
                                <td><?php echo $ty[$x['type']]; ?></td>
                            </tr>
                            <tr>
                                <td>หมวดสินทรัพย์ :</td>
                                <td><?php echo $x['category_name']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่เริ่มคิดค่าเสื่อม :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>ราคาที่ใช้คิดค่าเสื่อม :</td>
                                <td><?php echo number_format($x['price'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>ราคาซาก :</td>
                                <td><?php echo number_format($x['carcass'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>อัตราค่าเสื่อม :</td>
                                <td><?php echo $x['rate_value'] . ($x['rate_type'] == 1 ? ' ปี' : ($x['rate_type'] == 2 ? '%' : '')); ?></td>
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