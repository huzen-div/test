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
                    <th>Record Type</th>
                    <th>Sequence No.</th>
                    <th>ชื่อธนาคาร</th>
                    <th>Company Account</th>
                    <th>วันที่ชำระ</th>
                    <th>เวลาที่ชำระ</th>
                    <th>ชื่อลูกค้า</th>
                    <th>เลขบัตรประชาชน</th>
                    <th>เบอร์โทร</th>
                    <th>Reg 3</th>
                    <th>Branch No.</th>
                    <th>Teller No.</th>
                    <th>Kind of Transaction</th>
                    <th>ช่องทางการชำระ</th>
                    <th>Cheque No.</th>
                    <th>จำนวนทั้งสิ้น</th>
                    <th>Cheque Bank Code</th>
                </tr>
            </thead>
            <tbody style="min-height: 600px;">
                <?php
                $ar = [
                    'NET' => 'ATM',
                    'CSH' => 'เคาท์เตอร์'
                ];
                $bk = [
                    '0' => '',
                    '1' => '',
                    '2' => '',
                    '3' => '',
                    '4' => '',
                    '5' => '',
                    '6' => 'ธนาคารกรุงไทย',
                ];
                foreach ($data as $x) : ?>
                    <tr>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $x['record_type']; ?></td>
                        <td><?php echo $x['sequence_no']; ?></td>
                        <td><?php echo $bk[$x['bank_code']]; ?></td>
                        <td><?php echo $x['company_account']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($x['payment_date'])); ?></td>
                        <td><?php echo $x['payment_time']; ?></td>
                        <td><?php echo $x['customer_name']; ?></td>
                        <td><?php echo $x['customer_ref1']; ?></td>
                        <td><?php echo '0' . $x['customer_ref2']; ?></td>
                        <td><?php echo $x['customer_ref3']; ?></td>
                        <td><?php echo $x['branch_no']; ?></td>
                        <td><?php echo $x['teller_no']; ?></td>
                        <td><?php echo $x['kind_of_transaction']; ?></td>
                        <td><?php echo $ar[$x['transaction_code']]; ?></td>
                        <td><?php echo $x['cheque_no']; ?></td>
                        <td class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                        <td><?php echo $x['cheque_bank_code']; ?></td>
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
                    <td align='center' colspan="18" valign="top">รวม</td>
                </tr>
            </tfoot>
        </table>

    </div>


</body>

</html>