<div class="row">
    <style>
        .test {
            padding-top: 11%;
        }


        /* th {

            color: #000000;
            background-color: #FFFFFF;
        } */
    </style>
    <div class="col-xl-3 col-md-6 ">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>รายการรับเงินสงเคราะห์สมาชิกทั้งหมด (บาท)</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo number_format($sumimportbilling, 2); ?> ฿</font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="http://chapanakit.airtimes.co/finance/import_billing">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>บันทึกจ่ายเงินสงเคราะห์ทายาท (บาท) </center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo number_format($sumpayoffdebt * 1.07, 2); ?> ฿</font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="http://chapanakit.airtimes.co/finance/list_payoffdebt">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4 test">
            <div class="card-body">
                <font size="+2">
                    <center>เช็คจ่าย (บาท)</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo number_format($sumcheckpay, 2); ?> ฿</font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="http://chapanakit.airtimes.co/finance/list_checkpay">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4 test">
            <div class="card-body">
                <font size="+2">
                    <center>สมาชิก (คน)</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo number_format($sumdebtor, 0); ?></font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="http://chapanakit.airtimes.co/account/list_debtor">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="http://chapanakit.airtimes.co" method="POST">

        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite" style="text-align: center;">ค้นหา </label>
            <input type="text" id="txt_search" class="form-control col-md-3 txt_search" placeholder="ค้นหา" name="txt_search" autocomplete="">
            <label id="date-label-from" class="col-md-1 textwhite" style="text-align: center;">เริ่ม</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2 txt_search" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite" style="text-align: center;">สิ้นสุด</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2 txt_search" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        </div>
    </form>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            รายการชำระล่าสุด
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th align="center">ลำดับ</th>
                            <th align="center">เลขที่เอกสาร </th>
                            <th align="center">รหัสสมาชิก </th>
                            <th align="center">วันที่ </th>
                            <th align="center">จำนวนเงิน(บาท) </th>
                            <th align="center">เครดิต(วัน) </th>
                            <th align="center">ภาษี 7% (บาท) </th>
                            <th align="center"> จำนวนทั้งสิ้น(บาท) </th>

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
                        $no = 1;
                        if ($data) : ?>
                            <?php foreach ($data as $x) : ?>

                                <tr href="<?= base_url('finance/view_payoffdebtid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                    <td><?php echo $no; ?>.
                                    <td><?php echo $x['document_id']; ?></td>
                                    <td align="center"><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>

                                    <td class="textnum">
                                        <align="right"><?php echo number_format($x['amount'], 2); ?>
                                    </td>
                                    <td><?php echo $x['day']; ?></td>
                                    <?php
                                    $vat = $x['amount'] * 0.07;
                                    ?>
                                    <td class="textnum"><?php echo number_format($vat, 2); ?></td>
                                    <td class="textnum"><?php echo number_format($x['amount'] + $vat, 2); ?></td>

                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
        // $('#txt_search').on('keyup change', function() {
        //     var text = $('#txt_search').val();
        //     table.search(text).draw();
        // });
    });
</script>