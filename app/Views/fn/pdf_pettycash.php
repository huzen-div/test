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
                    <th>ประเภท</th>
                    <th>สถานะ</th>
                    <th>เลขที่</th>
                    <th>วันที่</th>
                    <th>ใบที่เบิก</th>
                    <th>เพิ่มเติม</th>
                    <th>จำนวนเงินทั้งสิ้น</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $y) : ?>
                        <?php foreach ($y as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td><?php echo $x['type_id']; ?></td>
                                <td><?php echo $x['status_id']; ?></td>
                                <td><?php echo $x['no_id']; ?></td>
                                <td><?php echo $x['date']; ?></td>
                                <td><?php echo $x['withdrawal_slip']; ?></td>
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