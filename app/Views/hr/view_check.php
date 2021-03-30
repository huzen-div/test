<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php

            $mt = [
                '0' => '',
                '1' => 'วิธี E-Bidding',
                '2' => 'วิธีแบบพิเศษ',
                '3' => 'วิธีจัดหา',
                '4' => 'วิธีตกลงราคา',
            ];
            foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ผู้รับผิดชอบ :</td>
                    <td><?php echo $x['responsible_person']; ?></td>
                </tr>
                <tr>
                    <td>วิธีการจัดหา :</td>
                    <td><?php echo $mt[$x['contract']]; ?></td>
                </tr>
                <tr>
                    <td>หน่วยงาน :</td>
                    <td><?php echo $x['agency_code']; ?></td>
                </tr>
                <tr>
                    <td>ประเภท :</td>
                    <td>
                        <?php echo $x['purchasing_type']; ?>
                    </td>
                </tr>
                <tr>
                    <td>จำนวนเงิน (หน่วย:บาท) :</td>
                    <td><?php echo number_format($x['amount'], 2); ?></td>
                </tr>
                <tr>
                    <td>ภาษีมูลค่าเพิ่ม (7%) :</td>
                    <td><?php echo number_format($x['tax'], 2); ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินทั้งสิ้น (หน่วย:บาท) :</td>
                    <td><?php echo number_format($x['total'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>