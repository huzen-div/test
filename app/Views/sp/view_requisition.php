<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php
            $ar = [
                '0' => '',
                '1' => 'จ่ายแล้ว',
                '2' => 'ระหว่างดำเนินการ',
                '3' => 'ยกเลิก',
                // '4' => 'เรียบร้อย',
            ];
            foreach ($data as $x) :
                $vat = 0;
                $total = 0;
                if ($x['type'] == '1') {
                    $vat = $x['tax_rate_rate'];
                } elseif ($x['type'] == '2') {
                    $vat = ($x['price'] * $x['tax_rate_rate']) / 100;
                }
                $total = $vat + $x['price'];
            ?>
                <tr>
                    <td>วันที่เบิก :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr>
                <tr>
                    <td>เลขที่เอกสาร :</td>
                    <td><?php echo $x['reference']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่พัสดุ :</td>
                    <td><?php echo $x['supplies_id']; ?></td>
                </tr>
                <tr>
                    <td>ผู้เบิก :</td>
                    <td><?php echo $x['employees_id']; ?></td>
                </tr>
                <tr>
                    <td>แผนก/ฝ่าย :</td>
                    <td><?php echo $x['department']; ?></td>
                </tr>
                <tr>
                    <td>สถานะ :</td>
                    <td> <?php echo $ar[$x['status']]; ?> </td>
                </tr>
                <tr>
                    <td>โครงการจัดซื้อจัดจ้าง :</td>
                    <td> <?php echo $x['name']; ?> </td>
                </tr>
                <tr>
                    <td>จำนวนเงิน (บาท) :</td>
                    <td> <?php echo $x['price']; ?> </td>
                </tr>
                <tr>
                    <td>ภาษี (บาท) :</td>
                    <td> <?php echo $vat; ?> </td>
                </tr>
                <tr>
                    <td>จำนวนทั้งสิ้น (บาท) :</td>
                    <td> <?php echo $total; ?> </td>
                </tr>
                <tr>
                    <td>Return note :</td>
                    <td> <?php echo $x['return_note']; ?> </td>
                </tr>
                <tr>
                    <td>Staff note :</td>
                    <td><?php echo $x['staff_note']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>