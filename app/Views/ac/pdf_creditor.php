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
        <table class="table" id="datatable" style="text-align: center;" border="1" style="width: 100%; text-align:center;">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ที่อยู่</th>
                    <th>รหัสไปรษณี</th>
                    <th>เบอร์โทร</th>
                    <th>อีเมล์</th>
                    <th>ชื่อผู้ติดต่อ</th>
                    <th>หมายเหตุ</th>
                    <th>เลขผู้เสียภาษี</th>
                    <th>สาขา</th>
                    <th>ประเภทเงินจ่าย</th>
                    <th>อัตราภาษี ณ ที่หัก</th>
                    <th>หมวดภาษี ณ ที่จ่าย</th>
                    <th>เงื่อนไขการหักภาษี</th>
                    <th>ประเภทผู้จ่าย</th>
                    <th>เลขที่บัญชี</th>
                    <th>เครดิต(วัน)</th>
                    <th>ภาษีมูลค่าเพิ่ม(VAT)</th>
                    <th>ส่วนลด</th>
                    <th>วงเงินอนุมัติ</th>
                    <th>ยอดต้นปี(บาท)</th>
                    <th>วันที่</th>
                    <th>ยอดคงเหลือ(บาท)</th>
                    <th>เช็คจ่ายล่วงหน้า</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $y) : ?>
                        <?php foreach ($y as $x) : ?>
                            <tr>
                                <td><?php echo $x['id']; ?></td>
                                <td><?php echo $x['address']; ?></td>
                                <td><?php echo $x['postal_code']; ?></td>
                                <td><?php echo $x['telephone']; ?></td>
                                <td><?php echo $x['email']; ?></td>
                                <td><?php echo $x['follower_name']; ?></td>
                                <td><?php echo $x['note']; ?></td>
                                <td><?php echo $x['taxpayer_number']; ?></td>
                                <td><?php echo $x['branch']; ?></td>
                                <td><?php echo $x['payout_type']; ?></td>
                                <td><?php echo $x['tax_rate']; ?></td>
                                <td><?php echo $x['tax_type']; ?></td>
                                <td><?php echo $x['tax_conditions']; ?></td>
                                <td><?php echo $x['payer_type']; ?></td>
                                <td><?php echo $x['account_number']; ?></td>
                                <td><?php echo $x['unit']; ?></td>
                                <td><?php echo $x['vat']; ?></td>
                                <td><?php echo $x['discount']; ?></td>
                                <td><?php echo $x['approval_limit']; ?></td>
                                <td><?php echo $x['total_early_year']; ?></td>
                                <td><?php echo $x['date']; ?></td>
                                <td><?php echo $x['balance']; ?></td>
                                <td><?php echo $x['prepaid_checks']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>