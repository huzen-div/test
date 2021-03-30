<!-- <?php var_dump($data); ?> -->
<style>
    th {
        color: #ffffff;
        background-color: #10b95c;
    }
</style>
<form action="<?= base_url('finance/actions_acceptpayment_complete') ?>" method="POST">

    <div class="row" style="margin-bottom: 1%;">
        <label id="date-label-from" class="col-md-1">ค้นหา </label>
        <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">


        <label id="date-label-from" class="col-md-1">เริ่ม:</label>
        <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
        <!-- <input class="form-control col-md-3" name="datepicker_from" type="date" id="datepicker_from" /> -->
        <label id="date-label-to" class="col-md-1">สิ้นสุด:</label>
        <!-- <input class="form-control col-md-3" name="datepicker_to" type="date" id="datepicker_to" /> -->
        <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        <input type="button" class="btn btn-warning offset-md-3" onclick="myFunction()" value="พิมพ์ใบเสร็จ" style="margin-left: 2%;" />
        <!-- <input type="submit" class="btn btn-success offset-md-3" name="excell" value="Export to Excel" style="margin-left: 2%;" /> -->
        <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">


    </div>

    <div class="row" style="margin-bottom: 1%;">
        <!-- <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excel" style="margin-right: 2%; margin-left: 2%;" />
        <input type="submit" class="btn btn-primary offset-md-1" name="pdf" value="พิมพ์ใบเสร็จรับเงิน" style="margin-left: 2%;" />
       -->
        <!-- <input type="submit" class="btn btn-success col-md-2" name="report" value="Print Report" style="margin-right: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" /> -->

        <!-- <input type="button" class="btn btn-primary offset-md-1" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-right: 2%;" />-->

        <!-- <a href="https://drive.google.com/file/d/1UhxlaiWYODi8G2p0qeP_3LKS-2lt7Iyo/view?usp=sharing" target=_blank>
            <input type="button" class="btn btn-primary offset-md-1" value="พิมพ์ใบเสร็จรับเงิน" style="margin-right: 2%;" />
        </a> -->
        <!-- <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" /> -->



    </div>
    <hr>
    <table class="table" id="datatable">
        <thead>
            <!-- <tr>
                <th>
                </th>
                <th>record_type</th>
                <th>sequence_no</th>
                <th>bank_code</th>
                <th>company_account</th>
                <th>วันที่ชำระ</th>
                <th>เวลาที่ชำระ</th>
                <th>ชื่อ</th>
                <th>บัตรประชาชน</th>
                <th>เบอร์โทรศัพท์</th>
                <th>customer_ref3</th>
                <th>branch_no</th>
                <th>teller_no</th>
                <th>kind_of_transaction</th>
                <th>ประเภทการชำระ</th>
                <th>cheque_no</th>
                <th>จำนวนเงิน</th>
                <th>cheque_bank_code</th>
                <th>การจัดการ</th>
            </tr> -->
            <tr>
                <th>
                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                </th>
                <th>Record Type</th>
                <th>Sequence No.</th>
                <th>Bank Code</th>
                <th>Company Account</th>
                <th>Payment Date</th>
                <th>Payment Time</th>
                <th>Customer Name</th>
                <th>Customer No./Ref 1</th>
                <th>Ref 2</th>
                <th>Reg 3</th>
                <th>Branch No.</th>
                <th>Teller No.</th>
                <th>Kind of Transaction</th>
                <th>Transaction Code</th>
                <th>Cheque No.</th>
                <th>Amount</th>
                <th>Cheque Bank Code</th>
                <th>Management</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $ar = [
            //     '0' => '',
            //     '1' => 'ชำระเงินแล้ว',
            //     '2' => 'ยังไม่ชำระเงิน',
            //     '3' => 'ระหว่างดำเนินการ',
            // ];
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
                '6' => 'KrungThai Bank',
            ];
            if ($data) : ?>
                <?php foreach ($data as $x) : ?>
                    <tr>

                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $x['record_type']; ?></td>
                        <td><?php echo $x['sequence_no']; ?></td>
                        <td><?php echo  $bk[$x['bank_code']]; ?></td>
                        <td><?php echo $x['company_account']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($x['payment_date'])); ?></td>
                        <td><?php echo $x['payment_time']; ?></td>
                        <td><?php echo $x['customer_name']; ?></td>
                        <td><?php echo $x['customer_ref1']; ?></td>
                        <td><?php echo $x['customer_ref2']; ?></td>
                        <td><?php echo $x['customer_ref3']; ?></td>
                        <td><?php echo $x['branch_no']; ?></td>
                        <td><?php echo $x['teller_no']; ?></td>
                        <td><?php echo $x['kind_of_transaction']; ?></td>
                        <td><?php echo $ar[$x['transaction_code']]; ?></td>
                        <td><?php echo $x['cheque_no']; ?></td>
                        <td class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                        <td><?php echo $x['cheque_bank_code']; ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <!--
                                        <a class="dropdown-item" href="<?= base_url('finance/view_acceptpayment') . '/' . $x['id'] ?>">รายละเอียด</a>
										-->

                                    <a class="dropdown-item" href="<?= base_url('finance/view_acceptpaymentpdf') . '/' . $x['id'] ?>" target="_blank">พิมพ์ใบเสร็จรับเงิน</a>
                                    <!-- <a class="dropdown-item" href="<?= base_url('finance/edit_acceptpayment') . '/' . $x['id'] ?>">แก้ไข</a> -->

                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>



</form>

<script>
    function myFunction() {
        window.location = "/finance/acceptpayment";
        // location.replace("/finance/acceptpayment")
    }
</script>