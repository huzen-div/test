
<!DOCTYPE html>
<html>

	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <style>


@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("<?php echo base_url('fonts/THSarabunNew.ttf');?>") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("<?php echo base_url('fonts/THSarabunNew Bold.ttf');?>") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("<?php echo base_url('fonts/THSarabunNew Italic.ttf');?>") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("<?php echo base_url('fonts/THSarabunNew BoldItalic.ttf');?>") format('truetype');
        }

        body { font-family: 'THSarabunNew'; }
        .container {
            width: 960px;
            margin: 0 auto;
        }

        table.table {
            border-collapse: collapse;
            border: 1px solid #000;
            cell
        }

        table.table thead th{
            height: 60px;
        }
        table.table tbody {
            min-height: 500px;
            padding: 5px;
        }
        table.table tbody td {
            padding: 5px;
        }

        table.table td, table.table th {
            border: 1px solid #000;
        }
        table.table tfoot {
            border-top: 1px solid #000;
            border-bottom-style: double;

        }

        table.table tbody tr:not(:last-child) td {
            border-bottom: 1px solid #fff;
        }
    </style>
    </head>
    <body>
    <div class="container">
    <table width="100%">
        <tr>
            <td width="100"><h2>ใบกำกับภาษี <br>Tax Invoice</h2></td>
            <td><p>( ตันฉบับ /  Original )</p></td>
            <td style="text-align: right;">
                &nbsp;
            </td>
        </tr>
    </table>

    
    <?php foreach ($data as $x) : ?>
        <table width="100%" >
        <tr>
            <td width="150"><strong>ลูกค้า / Customer</strong></td>
            <td width="30%"><?php echo "MOPH-".sprintf('%07d', $x['customer_id']); ?></td>
            <td width="150"><strong>เลขที่ / No.</strong></td>
            <td width="30%"><?php echo $x['id']; ?></td>
        </tr>
        

        <tr>
            <td valign="top" width="150" rowspan="2"><strong>ที่อยู่ / Address</strong></td>
            <td valign="top" width="30%" rowspan="2"><?php echo $x['address']; ?></td>
            <td width="150"><strong>วันที่ / Issue. </strong></td>
            <td width="30%"><?php echo $x['date']; ?></td>

        </tr>
        <tr>
            <td>อ้างอิง / Ref.</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td valign="top" width="150" ><strong>เลขผู้เสียภาษี  / Tax ID</strong></td>
            <td valign="top" width="30%" >&nbsp;</td>
            <td width="150"><strong>Email</strong></td>
            <td width="30%"></td>

        </tr>

        <tr>
            <td valign="top" width="150" ><strong>ผู้ติดต่อ  / Attention</strong></td>
            <td valign="top" width="30%" >&nbsp;</td>
            <td width="150"><strong>Tel:</strong></td>
            <td width="30%"></td>

        </tr>

       

        </table>

        <hr>

        <table width="100%" >
        <tr>
            <td width="150"><strong>ผู้ออก</strong></td>
            <td width="30%">&nbsp;</td>
            <td width="150"><strong>เลขที่ผุ้เสียภาษี / Tax ID.</strong></td>
            <td width="30%">&nbsp;</td>
        </tr>

        <tr>
            <td width="150" rowspan="3" valign="top"><strong>issuser</strong></td>
            <td width="30%" rowspan="3" valign="top">&nbsp;</td>
            <td width="150"><strong>จัดเตรียมโดย / Prepared by</strong></td>
            <td width="30%">&nbsp;</td>
        </tr>
        

        <tr>
            <td width="150"><strong>T:</strong></td>
            <td width="30%">E: </td>
        </tr>

        <tr>
            <td width="150"><strong>W:</strong></td>
            <td width="30%">&nbsp;</td>
        </tr>

        
       

        </table>

        <br>
        <br>
        <table width="100%" class="table">
            <thead>
                <tr>
                    <th>รหัส
                    <th>คำอธิบาย</th>
                    <th width="200">จำนวน</th>
                    <th width="200">ราคาต่อหน่วย</th>
                    <th width="200">มูลค่าก่อนภาษี</th>
                </tr>
            </thead>
            <tbody style="min-height: 600px;">
                <tr>
                    <td>XXXX</td>
                    <td>งานตรวจสอบดับเพลิง</td>
                    <td align='right'>1</td>
                    <td align='right'>10,000.00</td>
                    <td align='right'>10,000.00</td>
                </tr>

                <tr>
                    <td>XXXX</td>
                    <td>งานตรวจสอบดับเพลิง</td>
                    <td align='right'>1</td>
                    <td align='right'>10,000.00</td>
                    <td align='right'>10,000.00</td>
                </tr>
                <tr>
                    <td>XXXX</td>
                    <td>งานตรวจสอบดับเพลิง</td>
                    <td align='right'>1</td>
                    <td align='right'>10,000.00</td>
                    <td align='right'>10,000.00</td>
                </tr>
                <tr>
                    <td>XXXX</td>
                    <td>งานตรวจสอบดับเพลิง</td>
                    <td align='right'>1</td>
                    <td align='right'>10,000.00</td>
                    <td align='right'>10,000.00</td>
                </tr>
                <tr>
                    <td>XXXX</td>
                    <td>งานตรวจสอบดับเพลิง</td>
                    <td align='right'>1</td>
                    <td align='right'>10,000.00</td>
                    <td align='right'>10,000.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td rowspan="5" colspan="3" valign="top">หมายเหตุ</td>
                </tr>
                <tr>
                    <td>รวมสุทธิ (บาท) / Pre-Vat amount</td>
                    <td align='right'>10,000.00</td>
                </tr>

                <tr>
                    <td>ภาษีมูลค่าเพิ่ม (บาท) / Vat</td>
                    <td align='right'>700.00</td>
                </tr>

                <tr>
                    <td>จำนวนเงินรวมทั้งสิ้น (บาท) / Grand Total</td>
                    <td align='right'>10,700.00</td>
                </tr>

                <tr style="background-color: #ccc;">
                    <td>จำนวนเงินรวมทั้งสิ้น</td>
                    <td align=''>หนึ่งหมื่นเจ็ดร้อยบาท</td>
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
    <?php endforeach;?>

    </div>
    

    </body>
</html>
