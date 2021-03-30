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
        p {
            margin:0px;
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
        <!-- <table width="100%" style="margin-bottom:15px;">
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
        </table> -->
        <div>
            <div style="width:150px;float:left;">
                <img src="files/S__6103177.jpg" alt="" style="width:90px;">
            </div>
            <div style="width:400px;float:left;text-align:center;">
                <h1>บันทึกข้อความ</h1>
            </div>
        </div>
        <div style="margin-top:10px;">
            <span style="font-weight:bold;">ส่วนราชการ </span><span>สำนักงาน ฌกส. ฝ่าย โทร. ๐ ๒๕๘๙ ๙๑๐๗ - ๑๐ ต่อ</span>
        </div>
        <div>
            <div style="float:left;width:20px;font-weight:bold;">ที่ </div>
            <div style="float:left;width:35px;">สธ </div>
            <div style="float:left;width:120px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;"><?=$data[0]["id_cus"]?></div>
            <div style="float:left;width:50px;font-weight:bold;">วันที่ </div>
            <div style="float:left;width:200px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;"><?php echo date('d/m/Y', strtotime($data[0]["date"])); ?></div>
        </div>
        <div>
            <div style="float:left;width:330px;">1. เรียนหัวหน้าฝ่ายบริหารงานทั่วไป (ผ่านหัวหน้าฝ่าย </div>
            <div style="float:left;width:300px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;"><?=$data[0]["responsible"]?></div>
            <div style="float:left;width:40px;"> )</div>
        </div>
        <div>
            <div style="float:left;width:105px;margin-left:50px;">ข้าพเจ้า <?php if($data[0]["gender"] == "1"){ echo "นาย";} else if($data[0]["gender"] == "2"){ echo "นาง";} else if($data[0]["gender"] == "3"){ echo "นางสาว";}?></div>
            <div style="float:left;width:250px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;"><?=$data[0]["fullname"]?></div>
            <div style="float:left;width:40px;">ฝ่าย</div>
            <div style="float:left;width:200px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;"><?=$data[0]["group"]?></div>
        </div>
        <div>
            <div style="float:left;width:190px;">มีความประสงค์จะขอแจ้งซ่อม</div>
            <div style="float:left;min-width:250px;border-bottom: 2px dotted #353535;padding-bottom:-8px;"><?=$data[0]["request"]?></div>
        </div>
        <div>
            <div style="float:left;width:80px;">เนื่องจาก</div>
            <div style="float:left;min-width:200px;border-bottom: 2px dotted #353535;padding-bottom:-8px;"><?=$data[0]["since"]?></div>
        </div>
        <div>
            <div style="float:left;width:240px;">เลขที่ครุภัณฑ์/รายละเอียด/หมายเหตุ</div>
            <div style="float:left;min-width:320px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;"><?=$data[0]["number"]?></div>
        </div>
        
        <p style="margin-left:50px;">จึงเรียนมาเพื่อโปรดพิจารณาดำเนินการต่อไปด้วย จะเป็นพระคุณ</p>
        <div style="float:right;width:400px;height:100px;text-align:center;">
            <div>
                <div style="float:left;width:50px;">ลงชื่อ</div>
                <div style="float:left;width:240px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
                <div style="float:left;width:70px;">(ผู้ร้องขอ)</div>
            </div>
            <div>
                <div style="float:left;width:70px;">ตำแหน่ง</div>
                <div style="float:left;width:270px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
            </div>
            <div>
                <div style="float:left;width:50px;">ลงชื่อ</div>
                <div style="float:left;width:220px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
                <div style="float:left;width:90px;">(หัวหน้าฝ่าย)</div>
            </div>
        </div>
        <div style="clear:both;">
            <div style="float:left;width:260px;">2. เรียน เจ้าหน้าที่ฝ่ายบริหารงานทั่วไป งาน </div>
            <div style="float:left;width:240px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
            <div style="float:left;width:110px;">โปรดดำเนินการ</div>
        </div>
        <div style="float:right;width:500px;">
            <div>
                <div style="float:left;width:50px;">ลงชื่อ</div>
                <div style="float:left;width:240px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
                <div style="float:left;width:180px;">หัวหน้าฝ่ายบริหารงานทั่วไป</div>
            </div>
        </div>
        <div style="clear:both;">
            <div style="width:20px;float:left;">
                <p>3.</p>
            </div>
            <div style="float:left;">
                <?php
                    $status_check = "<span style='font-family:helvetica;border: 2px solid #3e3e3e;color:#3e3e3e;'> &nbsp;&#10004; </span>";
                    $status_uncheck = "<span style='font-family:helvetica;border: 2px solid #3e3e3e;color:#3e3e3e;'> &nbsp;&nbsp;&nbsp; </span>";
                ?>
                <p><?php if($data[0]["status"] == 1){echo $status_check;} else { echo $status_uncheck;}?> &nbsp;ดำเนินการซ่อมเรียบร้อยสามารถใช้งานได้ปกติ</p>
                <div>
                    <div style="float:left;width:200px;"><?php if($data[0]["status"] == 2){echo $status_check;} else { echo $status_uncheck;}?> &nbsp;ไม่สามารถซ่อมได้เนื่องจาก </div>
                    <div style="float:left;width:450px;border-bottom: 2px dotted #353535;padding-bottom:-8px;">&nbsp;<?php if($data[0]["status"] == 2){ echo $data[0]["reason"];} ?></div>
                </div>
            </div>
        </div>
        <div style="float:right;width:600px;clear:both;">
            <div>
                <div style="float:left;width:40px;">ลงชื่อ</div>
                <div style="float:left;width:150px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
                <div style="float:left;width:120px;">(ผู้ดำเนินการ) งาน</div>
                <div style="float:left;width:150px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
                <div style="float:left;width:130px;">ฝ่ายบริหารงานทั่วไป</div>
            </div>
        </div>
        <div style="clear:both;">
            <p>จัดทำเอกสารเดือนมีนาคม 2563: ฝ่ายบริหารงานทั่วไป</p>
            <hr>
            <div>
                <div style="width:400px;float:left;">ส่วนงานพัสดุ</div>
                <div style="float:left;width:40px;">วันที่</div>
                <div style="float:left;width:200px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
            </div>
            <p style="clear:right;">เรียน   ผู้อำนวยการสำนักงาน ฌกส.</p>
            <p style="margin-left:50px;">งานพัสดุขออนุมัติซ่อมครุภัณฑ์ ตามรายการดังต่อไปนี้</p>
            <p>1 ................................................................................................................................................................</p>
            <p>2 ................................................................................................................................................................</p>
            <p>3 ................................................................................................................................................................</p>
            <div>
            <?php $outgoings = 285062; ?>
                <div style="width:300px;float:left;">
                    <p>โดยมีค่าใช้จ่าย รวมเป็นจำนวนเงิน <?php echo number_format($outgoings, 0); ?> บาท</p>
                </div>
                <div style="float:left;">
                    <p>( <?=ReadNumber($outgoings);?>บาทถ้วน )</p>
                </div>
            </div>
            <p style="margin-left:50px;">จึงเรียนมาเพื่อโปรดอนุมัติการซ่อมแซมและค่าใช้จ่าย</p>
            <div style="float:right;width:400px;text-align:center;">
                <div>
                    <div style="float:left;width:40px;">ลงชื่อ</div>
                    <div style="float:left;width:280px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
                </div>
                <div>
                    <div style="float:left;width:30px;">(</div>
                    <div style="float:left;width:260px;border-bottom: 2px dotted #353535;text-align:center;padding-bottom:-8px;">&nbsp;</div>
                    <div style="float:left;width:30px;">)</div>
                </div>
            </div>
        </div>
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
        
        <!-- <table width="100%" style="margin-left: auto;  margin-right: auto;" class="table">
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align='center' colspan="5" valign="top"><?php echo number_format($x['amount'], 2); ?></td>
                </tr>
            </tfoot>
        </table> -->
    </div>
</body>
</html>