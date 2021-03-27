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
                    <th>แผนก</th>
                    <th>เลขที่</th>
                    <th>วันที่</th>
                    <th>เพื่อ</th>
                    <th>โอนจากบัญชี</th>
                    <th>โอนเข้าบัญชี</th>
                    <th>จำนวนเงินที่โอน</th>
                    <th>ค่าธรรมเนียม</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $y) : ?>
                        <?php foreach ($y as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td><?php echo $x['department_id']; ?></td>
                                <td><?php echo $x['no']; ?></td>
                                <td><?php echo $x['date']; ?></td>
                                <td><?php echo $x['reason']; ?></td>
                                <td><?php echo $x['transfer_from']; ?></td>
                                <td><?php echo $x['transfer_to']; ?></td>
                                <td><?php echo $x['amount']; ?></td>
                                <td><?php echo $x['fee']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>