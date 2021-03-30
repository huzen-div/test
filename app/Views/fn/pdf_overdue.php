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
                    <th>Bill to</th>
                    <th>แผนก</th>
                    <th>วันที่กำหนด</th>
                    <th>ที่อยู่</th>
                    <th>โทร</th>
                    <th>เลขที่เอกสาร</th>
                    <th>เลขที่ใบเพิ่มหนี้</th>
                    <th>ประเภท</th>
                    <th>เครดิต(วัน)</th>
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
                                <td><?php echo $x['customer_id']; ?></td>
                                <td><?php echo $x['bill_to']; ?></td>
                                <td><?php echo $x['department_id']; ?></td>
                                <td><?php echo $x['date']; ?></td>
                                <td><?php echo $x['address']; ?></td>
                                <td><?php echo $x['telephone']; ?></td>
                                <td><?php echo $x['document_id']; ?></td>
                                <td><?php echo $x['add_debt_id']; ?></td>
                                <td><?php echo $x['type_id']; ?></td>
                                <td><?php echo $x['day']; ?></td>
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