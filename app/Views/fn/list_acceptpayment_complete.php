<!-- <?php var_dump($data); ?> -->
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('finance/actions_acceptpayment_complete') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite">ค้นหา </label>
            <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <!-- <input class="form-control col-md-3" name="datepicker_from" type="date" id="datepicker_from" /> -->
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <!-- <input class="form-control col-md-3" name="datepicker_to" type="date" id="datepicker_to" /> -->
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <!-- <input type="button" class="btn btn-warning offset-md-3" onclick="myFunction()" value="พิมพ์ใบเสร็จ" style="margin-left: 2%;" /> -->
            <!-- <input type="submit" class="btn btn-success offset-md-3" name="excell" value="Export to Excel" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <hr>
        <table class="table display nowrap" id="dataTable">
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
                    <th>Bill No.</th>
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
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['teller_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo  $bk[$x['bank_code']]; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['company_account']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['payment_date'])); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['payment_time']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_name']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_ref1']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_ref2']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_ref3']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['branch_no']; ?></td>

                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['kind_of_transaction']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $ar[$x['transaction_code']]; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
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
</div>

<script>
    function myFunction() {
        window.location = "/finance/acceptpayment";
        // location.replace("/finance/acceptpayment")
    }
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            scrollX: true,
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ]
        });
        // $("#search").on('keyup click', function() {
        //     table.columns(2).search($(this).val()).draw();
        // });
        $('#search').on('keyup change', function() {
            // console.log(this.value);
            if (table.search() !== this.value) {
                table
                    .search(this.value)
                    .draw();
            }
        });
    });
</script>