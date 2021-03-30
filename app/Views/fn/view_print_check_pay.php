<div style="text-align: right; margin-right:3%">
    <?php
    $bk = [
        '1' => 'kt.png',
        '2' => 'scb.jpg'
    ];
    if ($data[0]['bank'] != null) { ?>
        <img src="<?= base_url($bk[$data[0]['bank']]) ?>" alt="image" style="width: 100px;">
    <?php } else { ?>
        <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" style="width: 100px;">

    <?php } ?>
</div>
<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php
            $bk_name = [
                null => 'ข้อมูลผิดพลาด',
                '1' => 'ธนาคารกรุงไทย',
                '2' => 'ธนาคารไทยพาณิชย์',
            ];
            foreach ($data as $x) : ?>
                <!-- <tr>
                    <td>รหัส</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่เช็ค</td>
                    <td><?php echo $x['no']; ?></td>
                </tr>
                <tr>
                    <td>วันที่เขียนเช็ค</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr>
                <tr>
                    <td>วันที่เช็คครบกำหนด</td>
                    <td><?php echo date('d/m/Y', strtotime($x['out_date'])); ?></td>
                </tr>
                <tr>
                    <td>ชื่อผู้รับ</td>
                    <td>
                        <?php echo $x['recipient_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td>จำนวนเงิน(ภาษาไทย)</td>
                    <td><?php echo $x['amount_th']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงิน</td>
                    <td><?php echo $x['amount_int']; ?></td>
                </tr>
                <tr>
                    <td>หมายเหตุการจ่าย</td>
                    <td><?php echo $x['note']; ?></td>
                </tr> -->
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
            <tr>
                <td>
                    <input type="button" class="btn btn-warning " onclick="window.location = '/finance/view_print_check_paypdf/'+<?= $x['id'] ?>;" value="พิมพ์เช็คจ่าย" />
                </td>
                <td>
                    <input type="button" class="btn btn-primary " onclick="Cookies.set('tab', 'data'); history.go(-1);" value="ย้อนกลับ" />
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- <div class="col-md-12" style="text-align: center;">
                    <input type="button" class="btn btn-warning " value="พิมพ์เช็คจ่าย" />
<input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div> -->