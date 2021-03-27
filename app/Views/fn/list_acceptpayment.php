<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form method="post" action="<?= base_url('finance/list_acceptpayment') ?>">
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
                    <th>การจัดการ</th>
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
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('finance/view_import_billing_pdf') . '/' . $x['id'] ?>" target="_blank">รายงาน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>

<script>
    function myFunction() {
        location.replace("/finance/acceptpayment")
    }
    $(document).ready(function() {
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
    });
</script>