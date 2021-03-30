<style>
    /* Style the tab */
    .tab {
        overflow: hidden;
    }

    /* Style the buttons inside the tab */
    .tab div {
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
    .tab div:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab div.active {
        background-color: #0f7d41;
        color: white;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 0;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<div class="col-sm-12" style="margin-bottom: 1%;padding: 12px 0px;box-shadow: 0px 0px 4px #ccc;">
    <div class="row">
        <div class="col-sm-3" style="text-align: center;">
            <p>เงินเข้ารวม (30 วัน)</p>
            <h5 style="color: #44aae6;">+<?php echo number_format($sumimportbilling, 2); ?> ฿</h5>
        </div>
        <div class="col-sm-3" style="text-align: center;">
            <p>เงินออกรวม (30 วัน)</p>
            <h5 style="color: #f77676;"><?php echo number_format($sumpayoffdebt * 1.07, 2); ?> ฿</h5>
        </div>
        <div class="col-sm-3" style="text-align: center;">
            <p>ยอดคงเหลือล่าสุด</p>
            <h5 style="color: #6855d2;"><?php echo number_format($sumimportbilling - ($sumpayoffdebt * 1.07), 2); ?> ฿</h5>
        </div>
        <div class="col-sm-3" style="text-align: center;">
            <!-- <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #00bf9c;border-color: #00bf9c;margin-left: 2%;color:#fff;">
                    โอนรับจ่าย
                </button>
                <div class="dropdown-menu" aria-labelledby="actions">
                    <a class="dropdown-item" href="#">รายละเอียด</a>
                    <a class="dropdown-item" href="#">แก้ไข</a>
                </div>
            </div> -->
            <!-- <input type="button" class="btn btn-warning offset-md-2" value="โอนรับจ่าย" style="background: #00bf9c;border-color: #00bf9c;margin-left: 2%;color:#fff;"/> -->
        </div>
    </div>
</div>
<!-- <div class="col-sm-12" style="margin-bottom: 1%;padding: 12px 12px;box-shadow: 0px 0px 4px #ccc;">
    <div class="row">
        <label id="date-label-to" class="col-md-1">ค้นหา:</label>
        <input type="text" id="txt_search" autocomplete="off" class=" form-control col-md-2" name="txt_search">

        <label id="date-label-from" class="col-md-1" for="datepicker_from1">เลือกช่วงเวลา</label>
        <label style="margin-right:8px;">จาก:</label>
        <input type="text" id="datepicker_from1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from1">

        <label style="margin-left:8px;margin-right:8px;">ถึง:</label>
        <input type="text" id="datepicker_to1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to1">

        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        <input type="button" class="btn btn-warning offset-md-2" onclick="myFunction()" value="อัพเดท" style="margin-left: 2%;" />
        <input type="button" class="btn offset-md-2" value="Export" style="background: #00bf9c;border-color: #00bf9c;margin-left: 2%;color:#fff;" />
    </div>
</div> -->
<div class="col-sm-12" style="margin-bottom: 1%;padding: 12px 0px;box-shadow: 0px 0px 4px #ccc;">
    <div class="col-sm-12 tab">
        <div class="tablinks" onclick="openCity(event, 'all')" id="all_tab">รายการบันทึกบัญชี</div>
        <!-- <div class="tablinks" onclick="openCity(event, 'tab2')">รายการใน Statement</div> -->
    </div>

    <div class="col-sm-12">
        <form method="post" action="<?= base_url('finance/statement') ?>">
            <div id="all" class="tabcontent" style="padding-top: 0;">
                <div class="row" style="margin:0 0 0 0;padding: 11px 0 11px 0;background: #0f7d41;margin-bottom: 13px;color: #fff;">
                    <!-- <input type="button" class="btn btn-primary" value="ยกเลิกการกระทบยอด" style="margin-left: 2%;background: #15b0b7;border: #0b9ea5 2px solid;" />
                    <input type="button" class="btn btn-primary" value="เพิ่มรายการ" style="margin-left: 2%;background: #15b0b7;border: #0b9ea5 2px solid;" />
                    <input type="button" class="btn btn-primary" value="Import" style="margin-left: 2%;background: #157bb7;border: #06649c 2px solid;" /> -->
                    

                    <label id="date-label-to" class="col-md-1">ค้นหา:</label>
        <input type="text" id="txt_search" autocomplete="off" class=" form-control col-md-2" name="txt_search">

        <!-- <label id="date-label-from" class="col-md-2" for="datepicker_from1">เลือกช่วงเวลา</label> -->
        <label id="date-label-from" class="col-md-1" for="datepicker_from1">เลือกช่วงเวลา</label>
        <label style="margin-right:8px;">จาก:</label>
        <input type="text" id="datepicker_from1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from1">

        <!-- <label id="date-label-to" class="col-md-1" for="datepicker_to1">ถึง:</label> -->
        <label style="margin-left:8px;margin-right:8px;">ถึง:</label>
        <input type="text" id="datepicker_to1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to1">

        <!-- <label id="date-label-to" class="col-md-1">ค้นหา:</label>
        <input type="text" id="txt_search" autocomplete="off" class=" form-control col-md-2" name="txt_search"> -->
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        <!-- <input type="button" class="btn btn-warning offset-md-2" onclick="myFunction()" value="อัพเดท" style="margin-left: 2%;" /> -->
        <!-- <input type="button" class="btn offset-md-2" value="Export" style="background: #00bf9c;border-color: #00bf9c;margin-left: 2%;color:#fff;" /> -->
        <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" style="margin-left: 2%;">


                </div>
                <div class="col-sm-12">
                    <table class="table display nowrap" id="dataTable1" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <div class="text-center"><input name="select_all1" id="select-all1" type="checkbox" /></div>
                                </th>
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
                                    <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                                        <td width="50px;"><?php echo $bk[$x['bank_code']]; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['company_account']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['payment_date'])); ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['payment_time']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_name']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_ref1']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo '0' . $x['customer_ref2']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_ref3']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['branch_no']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['teller_no']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['kind_of_transaction']; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $ar[$x['transaction_code']]; ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_no']; ?></td>
                                        <td class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                                        <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div id="tab2" class="tabcontent" style="padding-top: 0;">
                <div class="row" style="margin:0 0 0 0; padding: 11px 0 11px 0;background: #0f7d41;">
                    <input type="button" class="btn btn-primary" value="ยกเลิกการกระทบยอด" style="margin-left: 2%;background: #15b0b7;border: #0b9ea5 2px solid;" />
                    <input type="button" class="btn btn-primary" value="เพิ่มรายการ" style="margin-left: 2%;background: #15b0b7;border: #0b9ea5 2px solid;" />
                    <input type="button" class="btn btn-primary" value="Import" style="margin-left: 2%;background: #157bb7;border: #06649c 2px solid;" />
                    <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" style="margin-left: 2%;">
                </div>
        </form>
        <form method="post" action="<?= base_url('finance/statement') ?>">
            <div class="col-sm-12">
                <table class="table display nowrap" id="dataTable2" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <div class="text-center"><input name="select_all2" id="select-all2" type="checkbox" /></div>
                            </th>
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
                                <tr>
                                    <td><?php echo $x['id']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                                    <td width="50px;"><?php echo $bk[$x['bank_code']]; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['company_account']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['payment_date'])); ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['payment_time']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_name']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_ref1']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo '0' . $x['customer_ref2']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['customer_ref3']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['branch_no']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['teller_no']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['kind_of_transaction']; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $ar[$x['transaction_code']]; ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_no']; ?></td>
                                    <td class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                                    <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div> -->
</div>
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
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            scrollX: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ]
        });
        var table2 = $('#dataTable2').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            scrollX: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ]
        });
        $('#txt_search').on('keyup change', function() {
            var text = $('#txt_search').val();
            table1.search(text).draw();
            table2.search(text).draw();
        });
        $('#select-all1').on('click', function() {
            var rows = table1.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all1').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });

        $('#select-all2').on('click', function() {
            var rows = table2.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all2').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
    });
</script>