<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="<?= base_url('css/pdf.css'); ?>" rel="stylesheet"> -->
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <link href="cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />
    <title><?= $title ?></title>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
</head>
<style>
    .container {
        font-family: "Garuda";
    }
</style>

<body>
    <div class="container">
        <h5 style="text-align: center;">การฌาปนกิจสงเคราะห์กระทรวงสาธารณสุข<br>รายงานการพิมพ์ใบเสร็จรับเงิน<br>วันที่: <?php echo date("d/m/Y"); ?></h5>
        <table class="table table-bordered" style="font-family: 'Garuda'; font-size: 12px;">
            <thead style="border-bottom: 2px solid black;border-top: 2px solid black;">
                <tr>
                    <th style="text-align: left;">ลำดับที่</th>
                    <th style="text-align: left;">เลขที่สมาชิก</th>
                    <th style="text-align: left;">ชื่อ-นามสกุล</th>
                    <th style="text-align: left;">วันที่</th>
                    <th style="text-align: left;">เล่มที่</th>
                    <th style="text-align: left;">เดือนที่ชำระ</th>
                    <th style="text-align: center;">จำนวนเงิน</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $y) : ?>
                        <?php foreach ($y as $x) : ?>
                            <tr>
                                <td style="text-align: right;"><?php echo $x['id']; ?></td>
                                <td style="text-align: left;"><?php echo $x['customer_id']; ?></td>
                                <td style="text-align: left;"><?php echo $x['bill_to']; ?></td>
                                <td style="text-align: left;"><?php echo $x['date']; ?></td>
                                <td style="text-align: left;"><?php echo $x['document_id']; ?></td>
                                <td style="text-align: left;"><?php echo date("F Y ", strtotime($x['date'])); ?></td>
                                <!-- <td style="text-align: left;"><?php echo $x['date']; ?></td> -->
                                <td style="text-align: center;"><?php echo $x['payment_amount']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="6"></td>
                                <td style="text-align: center;border-bottom: 2px solid black;"><?php echo $x['payment_amount']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>