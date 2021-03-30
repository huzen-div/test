<div class="modal-header">
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>-->
    <h4 class="modal-title" id="myModalLabel">
        <center><?= $title; ?></center>
    </h4>
    <?php
    $bk = [
        '1' => 'kt.png',
        '2' => 'scb.jpg'
    ];

    $bk_name = [
        null => 'ข้อมูลผิดพลาด',
        '1' => 'ธนาคารกรุงไทย',
        '2' => 'ธนาคารไทยพาณิชย์',
    ];
    if ($data[0]['bank'] != null) { ?>
        <img src="<?= base_url($bk[$data[0]['bank']]) ?>" alt="image" style="width: 50px;">
    <?php } else { ?>
        <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" style="width: 50px;">

    <?php } ?>
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
                                <td>เลขที่เช็ค :</td>
                                <td><?php echo $x['no']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่เขียนเช็ค :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>วันที่เช็คครบกำหนด :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['out_date'])); ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อธนาคาร :</td>
                                <td><?php echo $bk_name[$x['bank']]; ?></td>
                            </tr>
                            <tr>
                                <td>สาขา :</td>
                                <td><?php echo '-'; ?></td>
                            </tr>
                            <tr>
                                <td>รหัสสาขา :</td>
                                <td><?php echo '-'; ?></td>
                            </tr>
                            <tr>
                                <td>ประเภทเช็ค :</td>
                                <td><?php echo '-'; ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงิน :</td>
                                <td><?php echo $x['amount_int']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" class="btn btn-warning " onclick="window.location = '/finance/view_print_check_paypdf/'+<?= $x['id'] ?>;" value="พิมพ์เช็คจ่าย" />
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>