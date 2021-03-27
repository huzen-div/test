<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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



        <!----<h4 style="text-align: right;">เล่มที่ <?php //echo $data[0]['teller_no']; 
                                                        ?></h4>-->
        <h2 style="text-align: center;"><?= $title ?></h2>
        <?php foreach ($data as $x) : ?>
            <table width="100%">
                <tr>
                    <td width="150"><strong>
                            <!-- ลูกค้า / Customer -->
                            ผู้ถอน :
                        </strong></td>
                    <td width="30%"><?php echo $x['withdrawal']; ?></td>
                    <td width="150"><strong>
                            <!-- เลขที่ / No. -->
                            เลขที่ :
                        </strong></td>
                    <td width="30%"><?php echo $x['no']; ?></td>
                </tr>
                <tr>
                    <td valign="top" width="150" rowspan="2"><strong>
                            <!-- บัญชีลูกค้า -->
                            ผู้ดำเนินการ :
                        </strong></td>
                    <td valign="top" width="30%" rowspan="2"><?php echo $x['operator']; ?></td>
                    <td width="150"><strong>
                            <!-- วันที่ / Issue.  -->
                            วันที่ถอนเงิน :
                        </strong></td>
                    <td width="30%">
                        <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                    </td>

                </tr>

                <tr>
                    <td>
                        <!-- อ้างอิง / Ref. -->
                        <strong>
                            หน่วยงาน :
                        </strong>
                    </td>
                    <td><?php echo $x['agency']; ?></td>
                </tr>
            </table>

            <hr>

            <table width="100%">
                <tr>
                    <td width="150" style="vertical-align: text-top;"><strong>ผู้ออก :</strong></td>
                    <td width="30%">
                        สำนักงานฌาปนกิจสงเคราะห์ กระทรวงสาธารณสุข.
                        <hr> ซอย สาธารณสุข 5 ตำบลบางเขน อำเภอเมืองนนทบุรี นนทบุรี 11000
                    </td>
                    <td width="150" style="vertical-align: text-top;"><strong>เลขที่ผู้เสียภาษี :</strong></td>
                    <td width="30%" style="vertical-align: text-top;">0994000246714</td>
                </tr>
                <tr>
                    <td width="150" rowspan="3" valign="top"><strong></strong></td>
                    <td width="30%" rowspan="3" valign="top">&nbsp;</td>
                    <td width="150"><strong>จัดเตรียมโดย :</strong></td>
                    <td width="30%">&nbsp;</td>
                </tr>
            </table>

            <br>
            <br>
            <table width="100%" style="margin-left: auto;  margin-right: auto;" class="table">
                <thead>
                    <tr>
                        <th width="80">ลำดับ</th>
                        <th>รายการ</th>
                        <th width="100">จำนวน</th>
                        <th width="100">ราคาต่อหน่วย</th>
                        <th width="120">จำนวนเงิน</th>
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
                        <td>xxxxxxxxxxx</td>
                        <td align='center'>1</td>
                        <td align='right'><?php echo number_format($x['amount'], 2); ?></td>
                        <td align='right'><?php echo number_format($x['amount'], 2); ?></td>
                    </tr>
                    <?php $sum = $sum + $x['amount']; ?>
                </tbody>
                <tfoot>
                    <?php
                    $vat = $x['service_charge'];
                    $total = $sum + $vat;
                    ?>
                    <tr>
                        <td rowspan="5" colspan="2" valign="top">หมายเหตุ <?= $x['note']; ?></td>
                    </tr>
                    <tr height="30">
                        <!-- <td colspan="2">รวมสุทธิ (บาท) / Pre-Vat amount</td> -->
                        <td colspan="2">รวมเงิน (บาท)</td>
                        <td height="30" align='right'><?= number_format($sum, 2) ?></td>
                    </tr>

                    <tr>
                        <!-- <td colspan="2">ภาษี (บาท) / Vat</td> -->
                        <td colspan="2">ค่าบริการ (บาท)</td>
                        <td height="30" align='right'><?= number_format($vat, 2); ?></td>
                    </tr>

                    <tr>
                        <!-- <td colspan="2">ทั้งสิ้น (บาท) / Grand Total</td> -->
                        <td colspan="2">รวมเงินทั้งสิ้น (บาท) </td>
                        <td height="30" align='right'><?= number_format($total, 2); ?></td>
                    </tr>

                    <tr style="background-color: #ccc;">
                        <!-- <td colspan="2"></td> -->
                        <td height="30" colspan="3" align=''><?php echo Convert($total); ?></td>
                    </tr>


                </tfoot>
            </table>

            <br>
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
            </table>
        <?php endforeach; ?>

    </div>


</body>

</html>