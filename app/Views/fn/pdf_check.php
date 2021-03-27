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
                    <th>เข้าบัญชี</th>
                    <th>แผนก</th>
                    <th>หมายเหตุ</th>
                    <th>ใบที่นำฝาก</th>
                    <th>วันที่นำฝาก</th>
                    <th>วันที่ผ่าน</th>
                    <th>วันที่ดำเนินการ</th>
                    <th>หมายเหตุ</th>
                    <th>จำนวนเงิน</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $y) : ?>
                        <?php foreach ($y as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td><?php echo $x['into_account']; ?></td>
                                <td><?php echo $x['department_id']; ?></td>
                                <td><?php echo $x['comment']; ?></td>
                                <td><?php echo $x['deposit_id']; ?></td>
                                <td><?php echo $x['deposit_date']; ?></td>
                                <td><?php echo $x['passed_date']; ?></td>
                                <td><?php echo $x['implementation_date']; ?></td>
                                <td><?php echo $x['note']; ?></td>
                                <td><?php echo $x['amount']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>