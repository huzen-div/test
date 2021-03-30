<form method="post" action="<?= base_url('finance/import_billing') ?>" enctype="multipart/form-data">
    <!-- <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="fn_moneyreciev_bank1">แนบเอกสาร (fn_moneyreciev_bank1)</label>
            <input type='file' class="form-control" id="fn_moneyreciev_bank1" name="fn_moneyreciev_bank1" />
        </div>
        <div class="col-md-6">
            <hr>
            <a title="<?php echo $x['name']; ?>" href="<?= base_url('files/import') . '/example_1.csv'  ?>" target="_blank">ตัวอย่าง สำหรับ fn_moneyreciev_bank1
            </a>
        </div>
    </div> -->
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="fn_moneyreciev_bank2">แนบเอกสาร</label>
            <input type='file' class="form-control" id="fn_moneyreciev_bank2" name="fn_moneyreciev_bank2" />
        </div>
        <div class="col-md-6">
            <br>
            <a title="<?php echo $x['name']; ?>" href="<?= base_url('files/import') . '/example_2.csv'  ?>" target="_blank">ตัวอย่าง Excell
            </a>
        </div>
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12" style="margin-top: 1%;text-align: right;">
            <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
            <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
            <input type="reset" class="btn btn-secondary " value="เคลียร์" />
        </div>
    </div>
    <hr>

    <form action="<?= base_url('finance/import_billing') ?>" method="POST">

        <div class="row" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1" style="text-align: center;">ค้นหา </label>
            <input type="text" id="txt_search" class="form-control col-md-3 txt_search" placeholder="ค้นหา" autocomplete="">
            <label id="date-label-from" class="col-md-1" style="text-align: center;">เริ่ม</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1" style="text-align: center;">สิ้นสุด</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" value="ค้นหา" style="margin-left: 2%;" />
        </div>
    </form>
    <table class="table" id="dataTable">
        <thead>
            <!-- <tr>
                <th>
                    ลำดับรายการ
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
            </tr> -->
            <tr>
                <th>
                    No
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
            </tr>
        </thead>
        <tbody>
            <?php
            if ($data) :
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
            ?>
                <?php foreach ($data as $x) : ?>
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

                        <!-- <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a class="dropdown-item" href="<?= base_url('finance/view_acceptpayment') . '/' . $x['id'] ?>">รายละเอียด</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/edit_acceptpayment') . '/' . $x['id'] ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/delete_acceptpayment') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/view_acceptpaymentpdf') . '/' . $x['id'] ?>" target="_blank">พิมพ์ใบเสร็จรับเงิน</a>

                                </div>
                            </div>
                        </td>  -->
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <style>
        th {
            color: #ffffff;
            background-color: #10b95c;
        }
    </style>
</form>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ]
        });
        $('#txt_search').on('keyup change', function() {
            var text = $('#txt_search').val();

            table.search(text).draw();
        });
    });
</script>