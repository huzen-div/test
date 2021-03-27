<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php
            $ty = [
                '0' => '',
                '1' => 'รายปี',

            ];
            foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>คิดค่าเสื่อม :</td>
                    <td><?php echo $ty[$x['type']]; ?></td>
                </tr>
                <tr>
                    <td>คิดค่าเสื่อมสะสมยกมา :</td>
                    <td><?php echo number_format($x['charged'], 2); ?></td>
                </tr>
                <tr>
                    <td>ค่าเสื่อมคำนวณ :</td>
                    <td><?php echo number_format($x['calculated'], 2); ?></td>
                </tr>
                <tr>
                    <td>คำนวณเองถึงวันที่ :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['calculated_date'])); ?></td>
                </tr>
                <tr>
                    <td>ค่าเสื่อมเบื้องต้น :</td>
                    <td> <?php echo number_format($x['initial'], 2); ?> </td>
                </tr>
                <tr>
                    <td>วันที่ขาย :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['sale_date'])); ?></td>
                </tr>
                <tr>
                    <td>ราคาขาย :</td>
                    <td> <?php echo number_format($x['sale_price'], 2); ?> </td>
                </tr>
                <tr>
                    <td>กำไร/ขาดทุน :</td>
                    <td> <?php echo number_format($x['profit_loss'], 2); ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>