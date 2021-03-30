<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) :

                $st = [
                    '1' => 'ยืมพัสดุ',
                    '2' => 'ระหว่างดำเนินการ',
                    '3' => 'คืนแล้ว',
                    '4' => 'ยกเลิก',
                ];
            ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>วันที่ยืม :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr>
                <tr>
                    <td>วันที่คืน :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date_return'])); ?></td>
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
                    <td>
                        <?php echo $x['department']; ?>
                    </td>
                </tr>
                <tr>
                    <td>สถานะ :</td>
                    <td><?php echo $st[$x['status']]; ?></td>
                </tr>
                <tr>
                    <td>Return note :</td>
                    <td><?php echo $x['return_note']; ?></td>
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