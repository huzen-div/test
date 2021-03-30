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
        }

        table.table thead th {
            height: 50px;
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
## วิธีใช้งาน
// $num1 = '3500.01';
// $num2 = '120000.50';
// echo  $num1  . "&nbsp;=&nbsp;" . Convert($num1), "<br>";
// echo  $num2  . "&nbsp;=&nbsp;" . Convert($num2), "<br>";
?>

<body>

    <div class="container">
        <table width="100%" style="margin-bottom:15px;">
            <tr>
                <td width="10%">
                    <img src="files/S__6103177.jpg" alt="" style="width:90px;">
                </td>
                <td width="90%" style="text-align: center;">
                    <p style="text-align: center;margin:0px;padding:0px;"><?= $title ?></p>
                    <p style="text-align: center;margin:0px;padding:0px;">สำนักงานฌาปนกิจสงเคราะห์ กระทรวงสาธารณสุข</p>
                    <p style="text-align: center;margin:0px;padding:0px;">ตั้งแต่วันที่ ถึงวันที่</p>
                </td>
            </tr>
        </table>
        <!-- <div class="row">
            <div class="col-md-6">
                <img src="files/S__6103177.jpg" alt="" style="width:90px;">
            </div>
            <div class="col-md-6">
                <p style="text-align: center;margin:0px;padding:0px;"><?= $title ?></p>
                <p style="text-align: center;margin:0px;padding:0px;">สำนักงานฌาปนกิจสงเคราะห์ กระทรวงสาธารณสุข</p>
                <p style="text-align: center;margin:0px;padding:0px;">ตั้งแต่วันที่ ถึงวันที่</p>
            </div>
        </div> -->
        <table width="100%" style="margin-left: auto;  margin-right: auto;" class="table">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>วันที่</th>
                    <th>ประเภทงบประมาณ</th>
                    <th>อนุมัติครั้งที่</th>
                    <th>พักสำรองส่วนกลาง (%) </th>
                    <th>พักสำรองส่วนกลาง (บาท) </th>
                    <th>รับจัดสรรสุทธิ (บาท)</th>
                    <th>งบประมาณที่ผ่าน การอนุมัติแล้ว (บาท)</th>
                    <th>ผู้ดำเนินการ</th>
                </tr>
            </thead>
            <tbody style="min-height: 600px;">
                <?php foreach ($data as $x) : ?>
                    <tr>
                        <td align='center'><?= $x['id'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                        <td><?php echo $x['main_item']; ?></td>
                        <td align='right'><?php echo $x['type']; ?></td>
                        <td align='right'><?php echo number_format($x['central_percent'], 2); ?></td>
                        <td align='right'><?php echo number_format($x['central_amount'], 2); ?></td>
                        <td align='right'><?php echo number_format($x['allocated'], 2); ?></td>
                        <td align='right'><?php echo number_format($x['approved_budget'], 2); ?></td>
                        <td><?php echo $x['operator']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php for ($i = 2; $i <= 11; $i++) : ?>
                    <tr>
                        <td style="height: 20px;" align='center'></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td align='center' colspan="9" valign="top">รวม</td>
                    <!-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td> -->
                    <!-- <td align='center' colspan="5" valign="top"><?php echo number_format($x['amount'], 2); ?></td> -->
                </tr>
            </tfoot>
        </table>

    </div>


</body>

</html>