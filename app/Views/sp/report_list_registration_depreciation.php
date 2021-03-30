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
                    <!-- <p style="text-align: center;margin:0px;padding:0px;">ตั้งแต่วันที่ ถึงวันที่</p> -->
                </td>
            </tr>
        </table>
        <table width="100%" style="margin-left: auto;  margin-right: auto;" class="table">
            <thead>
                <!-- <tr>

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
                </tr> -->

                <th align="center" style="height: 50px; vertical-align: inherit;">ลำดับ</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">วันที่ซื้อ</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">รหัสครุภัณฑ์/วัสดุภัณฑ์</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">รหัสบาร์โค๊ด</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">ราคาที่ซื้อ</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">ราคาคงเหลือ ยกมาต้นปี</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">อัตราค่าเสื่อมราคา (%)</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">อัตราค่าเสื่อมราคา (ปี)</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">ค่าเสื่อมราคาปีปัจจุบัน</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">ค่าเสื่อมราคาสะสม ยกมาต้นปี</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">ค่าเสื่อมราคาสะสม ยกไป</th>
                <th align="center" style="height: 50px; vertical-align: inherit;">ราคาคงเหลือ  ยกไป</th>

                
            </thead>
            <tbody>

			<!-- $data = [
				"id" => $id,
				"date" => $date,
				"product_code" => $product_code,
				"product_code2" => $product_code2,
				"name" => $name,
				"asset_price" => $asset_price,
				"price2_before" => $price2_before,
				"ResidualCurYearFixPer" => $ResidualCurYearFixPer,
				"asset_rate_value" => $asset_rate_value,
				"ResidualCurYear" => $ResidualCurYear,
				"price1_before" => $price1_before,
				"price1_after" => $price1_after,
				"price2_after" => $price2_after
			]; -->
                <tr>
                    <!-- <td><img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $product_code2; ?>&code=Code128&translate-esc=on" style="width: 50%;"></td> -->
                    <td><?php echo $id; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($date)); ?></td>
                    <td><?php echo $product_code; ?></td>
                    <td><?php echo $product_code2; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo number_format($asset_price, 2); ?></td>
                    <td><?php echo number_format($price2_before, 2); ?></td>
                    <td><?php echo number_format($ResidualCurYearFixPer, 0)."%"; ?></td>
                    <td><?php echo $asset_rate_value; ?></td>
                    <td><?php echo number_format($ResidualCurYear, 2); ?></td>
                    <td><?php echo number_format($price1_before, 2); ?></td>
                    <td><?php echo number_format($price1_after, 2); ?></td>
                    <td><?php echo number_format($price2_after, 2); ?></td>
                </tr>
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