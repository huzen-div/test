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
                    <th>ลำดับ</th>
                    <th>วันที่เช็คเข้า </th>
                    <th>วันที่เช็คออก </th>
                    <th>เลขที่เช็ค </th>
                    <th>ตัดบัญชี </th>
                    <th>รหัส </th>
                    <th width="10%">จำนวนเงิน (บาท) </th>
                    <th>จ่ายให้ </th>
                    <th>สถานะเช็ค </th>
                    <th width="10%">ยอดเหลือ </th>
                    <th>วันที่ผ่านเช็ค </th>
                    <th width="10%">ยอดค่าใช้จ่าย </th>
                    <th>เพิ่มเติม </th>
                </tr>
            </thead>
            <tbody style="min-height: 600px;">
                <?php
                foreach ($data as $x) : ?>
                    <tr>
                        <td><?php echo $x['id']; ?></td>
                        <td> <?php echo date('d/m/Y', strtotime($x['check_date'])); ?> </td>
                        <td> <?php echo date('d/m/Y', strtotime($x['check_issue'])); ?> </td>
                        <td><?php echo $x['cheack_id']; ?></td>
                        <td class="textnum"> <?php echo $x['type_id']; ?> </td>
                        <td class="textnum"> <?php echo $x['debit_id']; ?> </td>
                        <td class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                        <td class="textnum"><?php echo $x['pay_for']; ?></td>
                        <td class="textnum"> <?php echo $x['check_status']; ?> </td>
                        <td class="textnum"><?php echo number_format($x['balance'], 2); ?></td>
                        <td> <?php echo date('d/m/Y', strtotime($x['passed_date'])); ?> </td>
                        <td class="textnum"><?php echo number_format($x['cost'], 2) ?></td>
                        <td><?php echo $x['note']; ?></td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td align='center' colspan="13" valign="top">รวม</td>
                </tr>
            </tfoot>
        </table>

    </div>


</body>

</html>