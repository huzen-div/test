<!-- <style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'all')" id="all_tab">รายการรับชำระทั้งหมด</button>
    <button class="tablinks" onclick="openCity(event, 'atm')">ชำระผ่านธนาคาร</button>
    <button class="tablinks" onclick="openCity(event, 'counter')">ชำระผ่าน 7-11</button>
    <button class="tablinks" onclick="openCity(event, 'check')">ชำระผ่านเช็ค</button>
    <button class="tablinks" onclick="openCity(event, 'cash')">ชำระผ่านเงินสด</button>
</div>
<div id="all" class="tabcontent" style="padding-top: 1%; ">
    <form method="post" action="<?= base_url('finance/deposit_withdraw') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1" for="txt_search1">ค้นหา </label>
            <input type="text" id="txt_search1" autocomplete="off" class=" form-control col-md-2" name="txt_search1">
            <label id="date-label-from" class="col-md-1" for="datepicker_from1">เริ่ม:</label>
            <input type="text" id="datepicker_from1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from1">
            <label id="date-label-to" class="col-md-1" for="datepicker_to1">สิ้นสุด:</label>
            <input type="text" id="datepicker_to1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to1">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        </div>
        <table class="table" id="dataTable1" width="100%" cellspacing="0">
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
            <tbody>
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
                $no = 1;
                if ($all) : ?>
                    <?php foreach ($all as $x) : ?>
                        <tr href="<?= base_url('finance/view_deposit_withdrawid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                            <td><?php echo $x['id']; ?>
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
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="atm" class="tabcontent" style="padding-top: 1%; ">
    <form method="post" action="<?= base_url('finance/deposit_withdraw') ?>">
        <div class="row" style="margin-bottom: 1%;">

            <label id="date-label-from" class="col-md-1" for="txt_search2">ค้นหา </label>
            <input type="text" id="txt_search2" autocomplete="off" class=" form-control col-md-2" name="txt_search2">
            <label id="date-label-from" class="col-md-1" for="datepicker_from2">เริ่ม:</label>
            <input type="text" id="datepicker_from2" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from2">
            <label id="date-label-to" class="col-md-1" for="datepicker_to2">สิ้นสุด:</label>
            <input type="text" id="datepicker_to2" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to2">

            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        </div>
        <table class="table" id="dataTable2" width="100%" cellspacing="0">
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
            <tbody>
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
                $no = 1;
                if ($atm) : ?>
                    <?php foreach ($atm as $x) : ?>
                        <tr href="<?= base_url('finance/view_deposit_withdrawid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                            <td><?php echo $x['id']; ?>
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
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="counter" class="tabcontent" style="padding-top: 1%; ">
    <form method="post" action="<?= base_url('finance/deposit_withdraw') ?>">
        <div class="row" style="margin-bottom: 1%;">

            <label id="date-label-from" class="col-md-1" for="txt_search3">ค้นหา </label>
            <input type="text" id="txt_search3" autocomplete="off" class=" form-control col-md-2" name="txt_search3">
            <label id="date-label-from" class="col-md-1" for="datepicker_from3">เริ่ม:</label>
            <input type="text" id="datepicker_from3" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from3">
            <label id="date-label-to" class="col-md-1" for="datepicker_to3">สิ้นสุด:</label>
            <input type="text" id="datepicker_to3" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to3">

            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        </div>
        <table class="table" id="dataTable3" width="100%" cellspacing="0">
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
            <tbody>
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
                $no = 1;
                if ($counter) : ?>
                    <?php foreach ($counter as $x) : ?>
                        <tr href="<?= base_url('finance/view_deposit_withdrawid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                            <td><?php echo $x['id']; ?>
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
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="check" class="tabcontent" style="padding-top: 1%; ">
    <form method="post" action="<?= base_url('finance/deposit_withdraw') ?>">
        <div class="row" style="margin-bottom: 1%;">

            <label id="date-label-from" class="col-md-1" for="txt_search4">ค้นหา </label>
            <input type="text" id="txt_search4" autocomplete="off" class=" form-control col-md-2" name="txt_search4">
            <label id="date-label-from" class="col-md-1" for="datepicker_from4">เริ่ม:</label>
            <input type="text" id="datepicker_from4" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from4">
            <label id="date-label-to" class="col-md-1" for="datepicker_to4">สิ้นสุด:</label>
            <input type="text" id="datepicker_to4" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to4">

            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        </div>
        <table class="table" id="dataTable4" width="100%" cellspacing="0">
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
            <tbody>
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
                $no = 1;
                if ($check) : ?>
                    <?php foreach ($check as $x) : ?>
                        <tr href="<?= base_url('finance/view_deposit_withdrawid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                            <td><?php echo $x['id']; ?>
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
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="cash" class="tabcontent" style="padding-top: 1%; ">
    <form method="post" action="<?= base_url('finance/deposit_withdraw') ?>">
        <div class="row" style="margin-bottom: 1%;">

            <label id="date-label-from" class="col-md-1" for="txt_search5">ค้นหา </label>
            <input type="text" id="txt_search5" autocomplete="off" class=" form-control col-md-2" name="txt_search5">
            <label id="date-label-from" class="col-md-1" for="datepicker_from5">เริ่ม:</label>
            <input type="text" id="datepicker_from5" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from5">
            <label id="date-label-to" class="col-md-1" for="datepicker_to5">สิ้นสุด:</label>
            <input type="text" id="datepicker_to5" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to5">

            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        </div>
        <table class="table" id="dataTable5" width="100%" cellspacing="0">
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
            <tbody>
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
                $no = 1;
                if ($cash) : ?>
                    <?php foreach ($cash as $x) : ?>
                        <tr href="<?= base_url('finance/view_deposit_withdrawid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                            <td><?php echo $x['id']; ?>
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
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    $(document).ready(function() {
        $("#all_tab").addClass("active");
        $("#all").css("display", "block");
        var table1 = $('#dataTable1').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ]
        });
        $('#txt_search1').on('keyup change', function() {
            var text = $('#txt_search1').val();

            table1.search(text).draw();
        });
        var table2 = $('#dataTable2').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ]
        });
        $('#txt_search2').on('keyup change', function() {
            var text = $('#txt_search2').val();

            table2.search(text).draw();
        });
        var table3 = $('#dataTable3').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ]
        });
        $('#txt_search3').on('keyup change', function() {
            var text = $('#txt_search3').val();

            table3.search(text).draw();
        });
        var table4 = $('#dataTable4').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ]
        });
        $('#txt_search4').on('keyup change', function() {
            var text = $('#txt_search4').val();

            table4.search(text).draw();
        });
        var table5 = $('#dataTable5').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ]
        });
        $('#txt_search5').on('keyup change', function() {
            var text = $('#txt_search5').val();

            table5.search(text).draw();
        });
    });
</script> -->