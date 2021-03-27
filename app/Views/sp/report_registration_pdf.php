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
        <table width="100%" style="margin-left: auto;  margin-right: auto;" class="table">
            <thead>
                <tr>

                    <th rowspan="2">
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th rowspan="2">ลำดับ</th>
                    <th rowspan="2">รหัสครุภัณฑ์/วัสดุภัณฑ์ </th>
                    <th rowspan="2">รหัสบาร์โค๊ด</th>
                    <th rowspan="2">ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                    <th rowspan="2">หน่วยนับ</th>


                    <th colspan="2">รายการจำหน่าย </th>
                    <th colspan="2">รายการซื้อ </th>
                    <th rowspan="2">ค่าเสื่อมราคาสะสม</th>
                    <th rowspan="2">กำไร (ขาดทุน)จากการจำหน่ายสินทรัพย์ </th>
                    <th rowspan="2">ผู้รับผิดชอบ</th>
                    <th rowspan="2">หมายเหตุ</th>


                </tr>
                <tr>
                    <th>วันที่</th>
                    <th>จำนวนเงิน (บาท)</th>
                    <th>วันที่</th>
                    <th>จำนวนเงิน (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // var_dump($product);
                if ($data) :
                    $ar = [
                        '0' => '',
                        '1' => 'active',
                        '2' => 'inactive',
                        '3' => 'other',
                    ];
                    foreach ($data as $x) :
                        $vat = 0;
                        $total = 0;
                        if ($x['type'] == '1') {
                            $vat = $x['tax_rate'];
                        } elseif ($x['type'] == '2') {
                            $vat = ($x['price'] * $x['tax_rate']) / 100;
                        }
                        $total = $vat + $x['price'];

                        $rate_type = "";
                        if ($x['asset_rate_type'] == 1) {
                            $rate_type = "ปี";
                            $ResidualCurYear = ($x['asset_price'] - $x['asset_carcass']) / $x['asset_rate_value']; // ค่าเสื่อมปีปัจจุบัน = ราคาซื้อมา-ราคาซาก/จำนวนปี => 40,0000/5 = 8,000
                            $ResidualCurYearFixPer = (($ResidualCurYear / $x['asset_price'] - $x['asset_carcass'])) * 100; //ค่าเสื่อมราคา percent = ราคาสินทรัพย์/ราคาเสื่อมต่อ*100
                            $ResidualCurYearFix = $ResidualCurYear; //ค่าเสื่อมราคา บาท
                        } else if ($x['asset_rate_type'] == 2) {
                            $rate_type = "%";
                            $ResidualCurYear = ($x['asset_price'] - $x['asset_carcass']) * $x['asset_rate_value'] / 100; // ค่าเสื่อมปีปัจจุบัน = ราคาซื้อมา-ราคาซาก*เปอร์เซนของปีปัจจุบัน/100
                            $ResidualCurYearFixPer = (($ResidualCurYear / $x['asset_price'] - $x['asset_carcass'])) * 100; //ค่าเสื่อมราคา percent = ราคาสินทรัพย์/ราคาเสื่อมต่อ*100
                            $ResidualCurYearFix = $ResidualCurYear; //ค่าเสื่อมราคา บาท
                        }

                        $Ad_date = date("Y-m-d", strtotime("-543 years", strtotime($x['asset_date']))); //เอาปีวันที่เริ่มคิดค่าเสื่อม พ.ศ มาแปลง เป็น ค.ศ
                        $AdDateYear = date('Y', strtotime($Ad_date));
                        $curYear = date('Y');

                        $date_diff1 = new DateTime($Ad_date); //ปีที่เริ่มคิด 59
                        $date_diff2 = new DateTime(date("Y-m-d")); //ปีปัจจุบัน 64
                        $interval = $date_diff1->diff($date_diff2); // ห่าง 2 ปี
                        // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
                        // $intervalplus = $interval->y+1;
                        $intervalplus = $interval->y;
                        // echo "ห่าง ".$intervalplus;

                        $date1 = date_create($AdDateYear . "-01-01");
                        $date2 = date_create($AdDateYear . "-12-31");
                        $diffAdDate = date_diff($date1, $date2);

                        $DateAllYear = $diffAdDate->format("%a") + 1;
                        $x['asset_amount_first_year'] = $x['asset_amount_first_year'] + 1;

                        $ResidualFirstYear = $ResidualCurYear * $x['asset_amount_first_year'] / $DateAllYear; //จำนวนเงินที่คิดปีแรก

                        $LastYearDate = $DateAllYear - $x['asset_amount_first_year']; //ปีสุดท้าย = 365-361 = 4
                        $ResidualLastYear = $ResidualCurYear * $LastYearDate / $DateAllYear; //จำนวนเงินที่คิดปีสุดท้าย

                        $price1_before = 0; //ค่าเสื่อมราคาสะสมยกมาต้นปี
                        $price1_after = 0; //ค่าเสื่อมราคาสะสมยกไป
                        $price2_before = 0; //ราคาคงเหลือยกมาต้นปี
                        $price2_after = 0; //ราคาคงเหลือยกไป
                        for ($i = 1; $i <= $intervalplus; $i++) {
                            if ($i == 1) { //ถ้าแรก
                                $price1_before += $ResidualFirstYear;
                                $price1_after += $price1_before + $ResidualCurYear; //เอาราคาปีที่+ปีกลาง
                            }
                            if (($i > 1) && ($i <= $intervalplus)) { //ถ้าปีที่ 2 ขึ้นไป และน้อยกว่าหรือเท่ากับปีสุดท้าย
                                if ($i == $x['asset_rate_value']) { //ถ้าเป็นปีสุดท้ายที่คีย์
                                    $price1_before += $ResidualCurYear;
                                    $ResidualCurYear = $ResidualLastYear; //ค่าเสื่อมปีปัจจุบัน
                                    $price1_after = $price1_before + $ResidualLastYear;
                                } else {
                                    $price1_before += $ResidualCurYear;
                                    $price1_after = $price1_before + $ResidualCurYear; //เพิ่มปีต่อไป
                                }
                            }
                        }
                        // echo "price1_before ค่าเสื่อมราคาสะสม ".$price1_before;

                        $price2_before = ($x['asset_price'] - $x['asset_carcass']) - $price1_before;
                        $price2_after = $x['asset_price'] - $x['asset_carcass'] - $price1_after;

                        if ($curYear == $AdDateYear) { //ถ้าปีปัจจุบันเท่ากับปีที่เริ่มคิดค่าเสื่อม
                            $ResidualCurYear = $ResidualFirstYear;
                        }

                        $cur_date = date("Y-m-d", strtotime("+543 years", strtotime(date("Y-m-d"))));
                        $cur_year = date('Y', strtotime($cur_date));

                        $pri_date = date("Y-m-d", strtotime("+544 years", strtotime(date("Y-m-d"))));
                        $pri_year = date('Y', strtotime($pri_date));

                        $asset_year = date('Y', strtotime($x['asset_date']));
                        $cal_year = $cur_year - $asset_year;
                        $cal_pri_year = $pri_year - $asset_year;

                        $ResidualYearAllPri = $x['asset_price'] - ($ResidualCurYear * $cal_pri_year); //ราคาคงเหลือยกมาต้นปี
                        $ResidualYearAllEnd = $x['asset_price'] - ($ResidualCurYear * $cal_year); //ราคาคงเหลือยกมาต้นปี
                        $Acm_Depreciation = $ResidualCurYear * $cal_pri_year; //ค่าเสื่อมราคาสะสม Accumulated Depreciation
                        // $Acm_DepreciationEnd = $ResidualCurYear*$cal_year;//ค่าเสื่อมราคาสะสม Accumulated Depreciation 
                ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['product_code']; ?></td>
                            <td><img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $x['id']; ?>&code=Code128&translate-esc=on" style="width: 50%;"></td>
                            <td><?php echo $x['name']; ?></td>
                            <td><?php echo $x['unit_name']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($x['asset_date'])); ?></td>
                            <td class="textnum"><?php echo number_format($x['asset_price'], 2); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($x['asset_date'])); ?></td>
                            <td class="textnum"><?php echo number_format($x['asset_price'], 2); ?></td>
                            <td class="textnum"><?php echo number_format($price1_after, 2); ?></td>
                            <td><?php echo number_format($x['asset_price'] - ($x['asset_price'] - $price1_after), 2); ?></td>
                            <td><?php echo $x['responsible']; ?></td>
                            <td><?php echo $x['note']; ?></td>
                        </tr>
                    <?php
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td align='center' colspan="15" valign="top">รวม</td>
                </tr>
            </tfoot>
        </table>

    </div>


</body>

</html>