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
        <table class="table" id="datatable" style="text-align: center;" border="1" >
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>วันที่เช็ค</th>
                    <th>วันที่ออกเช็ค</th>
                    <th>เลขที่เช็ค</th>
                    <th>ตัดบัญชี</th>
                    <th>รหัส</th>
                    <th>จำนวนเงิน</th>
                    <th>จ่ายให้</th>
                    <th>สถานะเช็ค</th>
                    <th>ยอดเหลือ</th>
                    <th>วันที่ผ่านเช็ค</th>
                    <th>ยอดค่าใช้จ่าย</th>
                    <th>เพิ่มเติม</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $y) : ?>
                        <?php foreach ($y as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td><?php echo $x['check_date']; ?></td>
                                <td><?php echo $x['check_issue']; ?></td>
                                <td><?php echo $x['cheack_id']; ?></td>
                                <td><?php echo $x['type_id']; ?></td>
                                <td><?php echo $x['debit_id']; ?></td>
                                <td><?php echo $x['amount']; ?></td>
                                <td><?php echo $x['pay_for']; ?></td>
                                <td><?php echo $x['check_status']; ?></td>
                                <td><?php echo $x['balance']; ?></td>
                                <td><?php echo $x['passed_date']; ?></td>
                                <td><?php echo $x['cost']; ?></td>
                                <td><?php echo $x['note']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>