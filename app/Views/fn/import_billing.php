<form method="post" action="<?= base_url('finance/import_billing') ?>" enctype="multipart/form-data">
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-6">
            <label for="fn_moneyreciev_bank2">แนบเอกสาร</label>
            <input type='file' class="form-control" id="fn_moneyreciev_bank2" name="fn_moneyreciev_bank2" />
        </div>
        <div class="col-md-6">
            <br>
            <a title="<?php echo $x['name']; ?>" href="<?= base_url('files/import') . '/example_2.csv'  ?>" target="_blank">ตัวอย่าง Excel
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
</form>

<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'all')" id="all_tab">รายการรับชำระทั้งหมด</button>
    <button class="tablinks" onclick="openCity(event, 'atm')">ชำระผ่านธนาคาร</button>
    <button class="tablinks" onclick="openCity(event, 'counter')">ชำระผ่าน 7-11</button>
    <button class="tablinks" onclick="openCity(event, 'check')">ชำระผ่านเช็ค</button>
    <button class="tablinks" onclick="openCity(event, 'cash')">ชำระผ่านเงินสด</button>
    <button class="tablinks" onclick="openCity(event, 'order')">ชำระผ่านธนาณัติ</button>
</div>
<div id="all" class="tabcontent" style="padding-top: 0; ">
    <form method="post" action="<?= base_url('finance/import_billing') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite" for="txt_search1">ค้นหา </label>
            <input type="text" id="txt_search1" autocomplete="off" class=" form-control col-md-2" name="txt_search1">
            <label id="date-label-from" class="col-md-1 textwhite" for="datepicker_from1">เริ่ม:</label>
            <input type="text" id="datepicker_from1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from1">
            <label id="date-label-to" class="col-md-1 textwhite" for="datepicker_to1">สิ้นสุด:</label>
            <input type="text" id="datepicker_to1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to1">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
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
                        <tr >
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $bk[$x['bank_code']]; ?></td>
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
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="atm" class="tabcontent" style="padding-top: 0; ">
    <form method="post" action="<?= base_url('finance/import_billing') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite" for="txt_search2">ค้นหา </label>
            <input type="text" id="txt_search2" autocomplete="off" class=" form-control col-md-2" name="txt_search2">
            <label id="date-label-from" class="col-md-1 textwhite" for="datepicker_from2">เริ่ม:</label>
            <input type="text" id="datepicker_from2" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from2">
            <label id="date-label-to" class="col-md-1 textwhite" for="datepicker_to2">สิ้นสุด:</label>
            <input type="text" id="datepicker_to2" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to2">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table display nowrap" id="dataTable2" width="100%" cellspacing="0">
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
                if ($atm) : ?>
                    <?php foreach ($atm as $x) : ?>
                        <tr >
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $bk[$x['bank_code']]; ?></td>
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
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="counter" class="tabcontent" style="padding-top: 0; ">
    <form method="post" action="<?= base_url('finance/import_billing') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite" for="txt_search3">ค้นหา </label>
            <input type="text" id="txt_search3" autocomplete="off" class=" form-control col-md-2" name="txt_search3">
            <label id="date-label-from" class="col-md-1 textwhite" for="datepicker_from3">เริ่ม:</label>
            <input type="text" id="datepicker_from3" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from3">
            <label id="date-label-to" class="col-md-1 textwhite" for="datepicker_to3">สิ้นสุด:</label>
            <input type="text" id="datepicker_to3" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to3">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table display nowrap" id="dataTable3" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all3" id="select-all3" type="checkbox" /></div>
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
                if ($counter) : ?>
                    <?php foreach ($counter as $x) : ?>
                        <tr >
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $bk[$x['bank_code']]; ?></td>
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
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="check" class="tabcontent" style="padding-top: 0; ">
    <form method="post" action="<?= base_url('finance/import_billing') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite" for="txt_search4">ค้นหา </label>
            <input type="text" id="txt_search4" autocomplete="off" class=" form-control col-md-2" name="txt_search4">
            <label id="date-label-from" class="col-md-1 textwhite" for="datepicker_from4">เริ่ม:</label>
            <input type="text" id="datepicker_from4" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from4">
            <label id="date-label-to" class="col-md-1 textwhite" for="datepicker_to4">สิ้นสุด:</label>
            <input type="text" id="datepicker_to4" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to4">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table display nowrap" id="dataTable4" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all4" id="select-all4" type="checkbox" /></div>
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
                if ($check) : ?>
                    <?php foreach ($check as $x) : ?>
                        <tr >
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $bk[$x['bank_code']]; ?></td>
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
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="cash" class="tabcontent" style="padding-top: 0; ">
    <form method="post" action="<?= base_url('finance/import_billing') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite" for="txt_search5">ค้นหา </label>
            <input type="text" id="txt_search5" autocomplete="off" class=" form-control col-md-2" name="txt_search5">
            <label id="date-label-from" class="col-md-1 textwhite" for="datepicker_from5">เริ่ม:</label>
            <input type="text" id="datepicker_from5" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from5">
            <label id="date-label-to" class="col-md-1 textwhite" for="datepicker_to5">สิ้นสุด:</label>
            <input type="text" id="datepicker_to5" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to5">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table display nowrap" id="dataTable5" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all5" id="select-all5" type="checkbox" /></div>
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
                if ($cash) : ?>
                    <?php foreach ($cash as $x) : ?>
                        <tr >
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $bk[$x['bank_code']]; ?></td>
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
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<div id="order" class="tabcontent" style="padding-top: 0;">
    <form method="post" action="<?= base_url('finance/import_billing') ?>">
        <div class="row search_tab">
            <label id="date-label-from" class="col-md-1 textwhite" for="txt_search6">ค้นหา </label>
            <input type="text" id="txt_search6" autocomplete="off" class=" form-control col-md-2" name="txt_search6">
            <label id="date-label-from" class="col-md-1 textwhite" for="datepicker_from5">เริ่ม:</label>
            <input type="text" id="datepicker_from6" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from6">
            <label id="date-label-to" class="col-md-1 textwhite" for="datepicker_to5">สิ้นสุด:</label>
            <input type="text" id="datepicker_to6" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to6">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table display nowrap" id="dataTable6" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all6" id="select-all6" type="checkbox" /></div>
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
                if ($order) : ?>
                    <?php foreach ($order as $x) : ?>
                        <tr >
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['record_type']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sequence_no']; ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $bk[$x['bank_code']]; ?></td>
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
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <td href="<?= base_url('finance/view_import_billingid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['cheque_bank_code']; ?></td>
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
            ],
            scrollX: true
        });
        $('#txt_search1').on('keyup change', function() {
            var text = $('#txt_search1').val();

            table1.search(text).draw();
        });
        var table2 = $('#dataTable2').DataTable({
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
        $('#txt_search2').on('keyup change', function() {
            var text = $('#txt_search2').val();

            table2.search(text).draw();
        });
        var table3 = $('#dataTable3').DataTable({
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
        $('#txt_search3').on('keyup change', function() {
            var text = $('#txt_search3').val();

            table3.search(text).draw();
        });
        var table4 = $('#dataTable4').DataTable({
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
        $('#txt_search4').on('keyup change', function() {
            var text = $('#txt_search4').val();

            table4.search(text).draw();
        });
        var table5 = $('#dataTable5').DataTable({
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
        $('#txt_search5').on('keyup change', function() {
            var text = $('#txt_search5').val();

            table5.search(text).draw();
        });
        var table6 = $('#dataTable6').DataTable({
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
        $('#txt_search6').on('keyup change', function() {
            var text = $('#txt_search6').val();

            table6.search(text).draw();
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
        $('#select-all3').on('click', function() {
            var rows = table3.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all3').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
        $('#select-all4').on('click', function() {
            var rows = table4.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all4').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
        $('#select-all5').on('click', function() {
            var rows = table5.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all5').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
        $('#select-all6').on('click', function() {
            var rows = table6.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all6').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
    });
</script>