<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>โครงการจัดซื้อจัดจ้าง :</td>
                    <td><?php echo $x['supplie_name']; ?></td>
                </tr>
                <tr>
                    <td>ผู้รับผิดชอบ :</td>
                    <td><?php echo $x['responsible']; ?></td>
                </tr>
                <tr>
                    <td>แผนก :</td>
                    <td><?php echo $x['department']; ?></td>
                </tr>
                <tr>
                    <td>งบประมาณ(บาท) :</td>
                    <td> <?php echo number_format($x['price'], 2); ?> </td>
                </tr>
                <?php
                $vat = 0;
                if ($tax[0]['type'] == '1') {
                    $vat = $tax[0]['tax_rate'];
                } elseif ($tax[0]['type'] == '2') {
                    $vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
                }
                ?>
                <tr>
                    <td>ภาษี(บาท) :</td>
                    <td> <?php echo number_format($vat, 2); ?> </td>
                </tr>
                <tr>
                    <td>จำนวนทั้งสิ้น(บาท) :</td>
                    <td> <?php echo number_format($x['price']+$vat, 2); ?> </td>
                </tr>
                <tr>
                    <td>วันที่ :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>