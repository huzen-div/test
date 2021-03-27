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

<body>

    <div class="container">

        <h2 style="text-align: center;">พิมพ์เช็คจ่าย</h2>
        <?php foreach ($data as $x) : ?>
            <table width="100%">
                <tr>
                    <td width="150"><strong>
                            <!-- ลูกค้า / Customer -->
                            จ่าย :
                        </strong></td>
                    <td width="30%"><?php echo $x['recipient_name']; ?></td>
                    <td width="150"><strong>
                            <!-- เลขที่ / No. -->
                            จำนวนเงิน (ภาษาไทย) :
                        </strong></td>
                    <td width="30%"><?php echo $x['amount_th']; ?></td>
                </tr>
                <tr>
                    <td valign="top" width="150" rowspan="2"><strong>
                            <!-- บัญชีลูกค้า -->
                            จำนวนเงิน (บาท) :
                        </strong></td>
                    <td valign="top" width="30%" rowspan="2"><?php echo $x['amount_int']; ?></td>
                </tr>
            </table>

            <hr>

        <?php endforeach; ?>

    </div>


</body>

</html>