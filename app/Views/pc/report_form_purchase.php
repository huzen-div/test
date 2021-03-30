<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("<?php echo base_url('fonts/THSarabunNew.ttf'); ?>") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("<?php echo base_url('fonts/THSarabunNew Bold.ttf'); ?>") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("<?php echo base_url('fonts/THSarabunNew Italic.ttf'); ?>") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("<?php echo base_url('fonts/THSarabunNew BoldItalic.ttf'); ?>") format('truetype');
        }

        body {
            font-family: 'THSarabunNew';
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        table.table {
            border-collapse: collapse;
            border: 1px solid #000;
            cell
        }

        table.table thead th {
            height: 60px;
        }

        table.table tbody {
            min-height: 500px;
            padding: 2px;
        }

        table.table tbody td {
            padding: 5px;
        }

        table.table td,
        table.table th {
            border: 1px solid #000;
            height: 40px;
        }

        table.table tfoot {
            border-top: 1px solid #000;
            border-bottom-style: double;

        }

        table.table tbody tr:not(:last-child) td {
            border-bottom: 1px solid #fff;
        }

        h2 {
            font-size: 16px;
        }

        table td,
        table th {
            font-size: 14px;
        }
    </style>
</head>
<?php
function Convert($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".", "");
    $pt = strpos($amount_number, ".");
    $number = $fraction = "";
    if ($pt === false)
        $number = $amount_number;
    else {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }

    $ret = "";
    $baht = ReadNumber($number);
    if ($baht != "")
        $ret .= $baht . "บาท";

    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else
        $ret .= "ถ้วน";
    return $ret;
}

function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000) {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }

    $divider = 100000;
    $pos = 0;
    while ($number > 0) {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}
?>

<body>

    <div class="container">
        <table width="100%" style="margin-bottom:15px;">
            <tr>
                <td width="40%">
                    <img src="files/S__6103177.jpg" alt="" style="width:90px;">
                </td>
                <td width="60%">
                    <h2 style="text-align: center;"><?= $title ?></h2>
                </td>
            </tr>
        </table>

        <!-- <img src="files/S__6103177.jpg" alt="" style="width:90px;">
        <h2 style="text-align: center;"><?= $title ?></h2> -->
        <?php foreach ($data as $x) : ?>
            <table width="100%">
                <tr>
                    <td width="20%"><strong>
                            ผู้ขาย/ผู้รับจ้าง :
                        </strong></td>
                    <td width="30%"><?php echo $x['seller_name']; ?></td>
                    <td width="20%">
                        <strong> ใบสั่งซื้อ/สั่งจ้าง : </strong>
                    </td>
                    <td width="30%" colspan="2"> <?php echo 'PO-' . $x['purchase_order1'] . '/' . $x['purchase_order2']; ?> </td>
                </tr>
                <tr>
                    <td width="20%">
                        <strong> ที่อยู่ : </strong>
                        <?php echo $x['house_no']; ?>
                    </td>
                    <td valign="top" width="30%">
                        <strong> ซอย </strong>
                        <?php echo $x['alley']; ?>
                    </td>
                    <td width="20%"><strong>
                            วันที่ :
                        </strong></td>
                    <td width="30%" colspan="2">
                        <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                    </td>

                </tr>
                <tr>
                    <td width="20%">
                        <strong> ถนน : </strong>
                        <?php echo $x['road']; ?>
                    </td>
                    <td width="30%">
                        <strong> ตำบล </strong>
                        <?php echo $x['sub_district']; ?>
                    </td>
                    <td width="50%" colspan="3">
                        <strong> สํานักงานฌาปนกิจสงเคราะห์กระทรวงสาธารณสุข </strong>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2">
                        <strong> อำเภอ : </strong>
                        <?php echo $x['district']; ?>
                    </td>
                    <td width="15%">
                        <strong> ที่อยู่ : </strong>
                        <?php echo $x['house_no2']; ?>
                    </td>
                    <td width="15%">
                        <strong> หมู่ที่ : </strong>
                        <?php echo $x['swine2']; ?>
                    </td>
                    <td width="20%">
                        <strong> ซอย : </strong>
                        <?php echo $x['alley2']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">
                        <strong> จังหวัด : </strong>
                        <?php echo $x['province']; ?>
                    </td>
                    <td width="30%">
                        <strong> รหัสไปรษณีย์ </strong>
                        <?php echo $x['postal_code']; ?>
                    </td>
                    <td width="15%">
                        <strong> ถนน : </strong>
                        <?php echo $x['road2']; ?>
                    </td>
                    <td width="15%">
                        <strong> ตำบล : </strong>
                        <?php echo $x['sub_district2']; ?>
                    </td>
                    <td width="20%">
                        <strong> อำเภอ : </strong>
                        <?php echo $x['district2']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2">
                        <strong> โทรศัพท์ : </strong>
                        <?php echo $x['tel']; ?>
                    </td>
                    <td width="20%">
                        <strong> จังหวัด : </strong>
                        <?php echo $x['province2']; ?>
                    </td>
                    <td width="30%" colspan="2">
                        <strong> รหัสไปรษณีย์ : </strong>
                        <?php echo $x['postal_code2']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2">
                    </td>
                    <td width="50%" colspan="3">
                        <strong> โทรศัพท์ : </strong>
                        <?php echo $x['tel2']; ?>
                    </td>
                </tr>
            </table>

            <hr>

            <table width="100%">
                <tr>
                    <td width="30%" style="vertical-align: text-top;"><strong>เลขที่ประจำตัวผู้เสียภาษี :</strong></td>
                    <td style="vertical-align: text-top;"><?php echo $x['taxpayer_id']; ?></td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: text-top;"><strong>เลขที่บัญชีเงินฝากธนาคาร :</strong></td>
                    <td style="vertical-align: text-top;"><?php echo $x['bank_account_number']; ?></td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: text-top;"><strong>ชื่อบัญชี :</strong></td>
                    <td style="vertical-align: text-top;"><?php echo $x['account_name']; ?></td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: text-top;"><strong>ธนาคาร :</strong></td>
                    <td style="vertical-align: text-top;"><?php echo $x['bank_number']; ?></td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: text-top;"><strong>สาขา :</strong></td>
                    <td style="vertical-align: text-top;"><?php echo $x['bank_branch']; ?></td>
                </tr>
            </table>
            <br>
            <br>
            <table width="100%" style="margin-left: auto;  margin-right: auto;" class="table">
                <thead>
                    <tr>
                        <th width="80">ลำดับ</th>
                        <th>รายละเอียด</th>
                        <th>รายการ</th>
                        <th width="15%">ราคาหน่วย (บาท/สตางค์)</th>
                        <th width="15%">จำนวนเงิน (บาท/สตางค์)</th>
                        <!-- <th>ราคาก่อนรวมภาษีมูลค่าเพิ่ม</th>
                        <th>ภาษีมูลค่าเพิ่ม 7%</th>
                        <th>รวมเป็นเงินทั้งสิ้น</th> -->
                    </tr>
                </thead>
                <tbody style="min-height: 600px;">
                    <?php
                    $no = 1;
                    $sum = 0;
                    $total = 0;
                    ?>
                    <tr>
                        <td align='center'><?= $no ?></td>
                        <td><?= $x['detail'] ?></td>
                        <td align='center'><?= $x['list'] ?></td>
                        <td align='right'><?php echo number_format($x['unit_price'], 2); ?></td>
                        <td align='right'><?php echo number_format($x['amount'], 2); ?></td>
                        <!-- <td align='right'><?php echo number_format($x['before_vat'], 2); ?></td>
                        <td align='right'><?php echo number_format($x['vat'], 2); ?></td>
                        <td align='right'><?php echo number_format($x['total'], 2); ?></td> -->
                    </tr>
                    <?php $sum = $sum + $x['amount']; ?>
                </tbody>
                <tfoot>
                    <!-- <tr>
                        <td colspan="5" valign="top" style="border: #fff;"></td>
                    </tr>
                    <tr>
                        <td colspan="5" valign="top" style="border: #fff;"></td>
                    </tr> -->
                    <tr style="border: none;">
                        <td rowspan="5" colspan="2" valign="top"></td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" align='right'>ราคาก่อนรวมภาษีมูลค่าเพิ่ม</td>
                        <td height="30" align='right'><?= number_format($x['before_vat'], 2) ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align='right'>ภาษีมูลค่าเพิ่ม 7%</td>
                        <td height="30" align='right'><?= number_format($x['vat'], 2); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align='right'>รวมเป็นเงินทั้งสิ้น </td>
                        <td height="30" align='right'><?= number_format($x['total'], 2); ?></td>
                    </tr>
                    <tr style="background-color: #ccc;">
                        <td height="30" colspan="3" align='right'><?php echo '(' . Convert($x['total']) . ')'; ?></td>
                    </tr>
                </tfoot>
            </table>
            <!-- <br>
            <hr>
            <table width="100%">
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td>
                        <table width="100%">
                            <tr>
                                <td width="50%" style="text-align: center;">
                                    อนุมัติโดย / Approve by
                                    <br><br><br><br><br>
                                    .............................................................<br>
                                    วันที่ ... / ... / .......
                                </td>

                                <td width="50%" style="text-align: center;">
                                    ผู้รับใบกำกับภาษี / Recipient
                                    <br><br><br><br><br>
                                    .............................................................<br>
                                    วันที่ ... / ... / .......

                                </td>
                            </tr>


                        </table>
                    </td>
                </tr>
            </table> -->
        <?php endforeach; ?>

    </div>


</body>

</html>