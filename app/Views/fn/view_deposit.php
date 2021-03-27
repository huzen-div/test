<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ผู้นำฝาก :</td>
                    <td><?php echo $x['depositor']; ?></td>
                </tr>
                <tr>
                    <td>วันที่นำฝาก :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr>
                <tr>
                    <td>ผู้ดำเนินการ :</td>
                    <td><?php echo $x['operator']; ?></td>
                </tr>
                <tr>
                    <td>หน่วยงาน :</td>
                    <td><?php echo $x['agency']; ?></td>
                </tr>
                <tr>
                    <td>รายการที่นำฝาก :</td>
                    <td><?php echo $x['deposit_items']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่ :</td>
                    <td><?php echo $x['no']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงิน :</td>
                    <td><?php echo number_format($x['amount'], 2); ?></td>
                </tr>
                <tr>
                    <td>ค่าบริการ :</td>
                    <td><?php echo number_format($x['service_charge'], 2); ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินทั้งสิ้น :</td>
                    <td><?php echo number_format($x['total'], 2); ?></td>
                </tr>
                <tr>
                    <td>หมายเหตุ :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>