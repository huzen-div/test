<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="<?= base_url('css/pdf.css'); ?>" rel="stylesheet"> -->
    <!-- <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" /> -->
    <title><?= $title ?></title>
</head>
<style>
    .container {
        font-family: "Garuda";
    }
</style>

<body>
    <div class="container">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <table class="table" id="datatable" style="text-align: center;" border="1">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>รหัสลูกหนี้</th>
                    <th>เลขบิล</th>
                    <th>รหัสพนักงาน</th>
                    <th>เครดิต(วัน)</th>
                    <th>วันที่วางบิล</th>
                    <th>กลุ่มลูกค้า</th>
                    <th>วันนัดรับชำระ</th>
                    <th>ผู้ติดต่อ</th>
                    <th>สถานะ</th>
                    <th>เงื่อนไขเพิ่มเติม</th>
                    <th>หมายเหตุ</th>
                    <th>ยกเลิกใบวางบิล</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $y) : ?>
                        <?php foreach ($y as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td><?php echo $x['customer_id']; ?></td>
                                <td><?php echo $x['bill_id']; ?></td>
                                <td><?php echo $x['employee_id']; ?></td>
                                <td><?php echo $x['unit_id']; ?></td>
                                <td><?php echo $x['bill_date']; ?></td>
                                <td><?php echo $x['group_id']; ?></td>
                                <td><?php echo $x['receive_date']; ?></td>
                                <td><?php echo $x['contact']; ?></td>
                                <td><?php echo $x['status_id']; ?></td>
                                <td><?php echo $x['additional_conditions']; ?></td>
                                <td><?php echo $x['note']; ?></td>
                                <td><?php echo $x['cancel_bill']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>