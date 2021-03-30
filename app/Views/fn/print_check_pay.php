<style>
    th {
        /* color: #ffffff;
        background-color: #10b95c; */
        color: #656565;
        background-color: #e5f3ff;
    }

    .textwhite {
        color: white;
    }

    .search_tab {
        padding: 11px 0 11px 0;
        background: #0f7d41;
        margin-bottom: 4px;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        /* border: 1px solid #ccc;
        background-color: #f1f1f1; */
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
        background-color: #0f7d41;
        color: white;
        /* background-color: #ccc; */
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
    <button class="tablinks" id="data_tab" onclick="openCity(event, 'data')">รายการที่ออกเช็คจ่ายทั้งหมด</button>
    <button class="tablinks" id="krungthai_tab" onclick="openCity(event, 'krungthai')">พิมพ์เช็ค ธนาคารกรุงไทย</button>
    <button class="tablinks" onclick="openCity(event, 'scb')">พิมพ์เช็ค ธนาคารไทยพาณิชย์</button>
</div>

<div id="krungthai" class="tabcontent" style="padding-top: 0;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('finance/print_check_pay') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-8">
                <img src="<?= base_url('kt.png'); ?>" alt="kt_logo" style="width: 100px;">
            </div>
            <input type="hidden" class="form-control" name="bank" value="1" required>

            <div class="col-md-1">
                <label for="no_kt">เลขที่เช็ค</label>
            </div>
            <div class="col-md-3">
                <input type="number" id="no_kt" class="form-control" name="no" value="<?= $_POST['no'] ? $_POST['no'] : '' ?>" required>
            </div>
        </div>

        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="date_kt">วันที่เขียนเช็ค</label>
            </div>
            <div class="col-md-5">
                <input type="text" id="date_kt" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
            <div class="col-md-1">
                <label for="out_date_kt">วันที่เช็คครบกำหนด</label>
            </div>
            <div class="col-md-5">
                <input type="text" id="out_date_kt" class="datetimepicker2 form-control" name="out_date" value="<?= $_POST['out_date'] ? $_POST['out_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="recipient_name_kt">ชื่อผู้รับ</label>
            </div>
            <div class="col-md-11">
                <input type="text" id="recipient_name_kt" class="form-control" name="recipient_name" value="<?= $_POST['recipient_name'] ? $_POST['recipient_name'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="amount_int_kt">จำนวนเงิน</label>
            </div>
            <div class="col-md-9">
                <input type="text" id="amount_th_kt" class="form-control" name="amount_th" value="<?= $_POST['amount_th'] ? $_POST['amount_th'] : '' ?>" readonly>
            </div>
            <div class="col-md-2">
                <input type="text" id="amount_int_kt" class="form-control money" name="amount_int" value="<?= $_POST['amount_int'] ? $_POST['amount_int'] : 0 ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">

            <div class="col-md-1">
                <label for="note_kt">หมายเหตุการจ่าย</label>
            </div>
            <div class="col-md-11">
                <textarea class="form-control" rows="1" name="note" id="note_kt"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <!-- <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" /> -->
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>

<div id="scb" class="tabcontent" style="padding-top: 0;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('finance/print_check_pay') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-8">
                <img src="<?= base_url('scb.jpg'); ?>" alt="" style="width: 100px;">
            </div>
            <input type="hidden" class="form-control" name="bank" value="2" required>
            <div class="col-md-1">
                <label for="no_scb">เลขที่เช็ค</label>
            </div>
            <div class="col-md-3">
                <input type="number" id="no_scb" class="form-control" name="no" value="<?= $_POST['no'] ? $_POST['no'] : '' ?>" required>
            </div>
        </div>

        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="date_scb">วันที่เขียนเช็ค</label>
            </div>
            <div class="col-md-5">
                <input type="text" id="date_scb" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
            <div class="col-md-1">
                <label for="out_date_scb">วันที่เช็คครบกำหนด</label>
            </div>
            <div class="col-md-5">
                <input type="text" id="out_date_scb" class="datetimepicker2 form-control" name="out_date" value="<?= $_POST['out_date'] ? $_POST['out_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="recipient_name_scb">ชื่อผู้รับ</label>
            </div>
            <div class="col-md-11">
                <input type="text" id="recipient_name_scb" class="form-control" name="recipient_name" value="<?= $_POST['recipient_name'] ? $_POST['recipient_name'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="amount_int_scb">จำนวนเงิน</label>
            </div>
            <div class="col-md-9">
                <input type="text" id="amount_th_scb" class="form-control" name="amount_th" value="<?= $_POST['amount_th'] ? $_POST['amount_th'] : '' ?>" readonly>
            </div>
            <div class="col-md-2">
                <input type="text" id="amount_int_scb" class="form-control money" name="amount_int" value="<?= $_POST['amount_int'] ? $_POST['amount_int'] : 0 ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">

            <div class="col-md-1">
                <label for="note_scb">หมายเหตุการจ่าย</label>
            </div>
            <div class="col-md-11">
                <textarea class="form-control" rows="1" name="note" id="note_scb"><?= $_POST['note'] ? $_POST['note'] : '' ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <!-- <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" /> -->
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>

<div id="data" class="tabcontent" style="padding-top: 0; ">
    <form method="post" action="<?= base_url('finance/print_check_pay') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">

            <label id="date-label-from" class="col-md-1 textwhite">ค้นหา </label>
            <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">

            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">


        </div>
        <table class="table" id="datatable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th align="center">ลำดับ</th>
                    <th align="center">Logo</th>
                    <th align="center">วันที่เขียนเช็ค</th>
                    <th align="center">เลขที่เช็ค</th>
                    <th align="center">วันที่เช็คครบกำหนด</th>
                    <th align="center">ชื่อธนาคาร</th>
                    <th align="center">สาขา</th>
                    <th align="center">รหัสสาขา</th>
                    <th align="center">ประเภทเช็ค</th>
                    <th align="center">จำนวนเงิน</th>
                    <th align="center">จัดการ</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $bk_name = [
                    null => 'ข้อมูลผิดพลาด',
                    '1' => 'ธนาคารกรุงไทย',
                    '2' => 'ธนาคารไทยพาณิชย์',
                ];
                $bk = [
                    '1' => 'kt.png',
                    '2' => 'scb.jpg'
                ];
                $no = 1;
                if ($data) : ?>
                    <?php foreach ($data as $x) : ?>

                        <tr>
                            <td><?php echo $x['id']; ?>
                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $no; ?>
                            <td style="width: 100px;">
                                <?php if ($x['bank'] != null) { ?>
                                    <!-- <a title="<?php echo $x['bank']; ?>" href="<?= base_url($bk[$x['bank']]) ?>" target="_blank"> -->
                                    <img src="<?= base_url($bk[$x['bank']]) ?>" alt="image" style="width: 50px;">
                                    <!-- </a> -->
                                <?php } else { ?>
                                    <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" style="width: 50px;">

                                <?php } ?>
                            </td>
                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['no']; ?></td>
                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"> <?php echo date('d/m/Y', strtotime($x['out_date'])); ?></td>

                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"> <?php echo $bk_name[$x['bank']]; ?> </td>
                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo '-'; ?></td>
                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo '-'; ?></td>
                            <td href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo '-'; ?></td>

                            <td class="textnum" href="<?= base_url('finance/view_print_check_payid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['amount_int'] + $vat, 2); ?></td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('finance/view_print_check_pay') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/edit_print_check_pay') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/delete_print_check_pay') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                        <!-- <a class="dropdown-item" href="<?= base_url('finance/view_print_check_paypdf') . '/' . $x['id'] ?>" target="_blank">พิมพ์ใบเสร็จรับเงิน</a> -->
                                        <a class="dropdown-item" href="<?= base_url('finance/view_print_check_paypdf') . '/' . $x['id'] ?>" target="_blank">พิมพ์เช็คจ่าย</a>

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
        $('#amount_int_kt').change(function() {
            var thaibath = ArabicNumberToText(this.value);
            $('#amount_th_kt').val(thaibath);

        });
        $('#amount_int_scb').change(function() {
            var thaibath = ArabicNumberToText(this.value);
            $('#amount_th_scb').val(thaibath);

        });
        $("#amount_int_kt").trigger('change');
        $("#amount_int_scb").trigger('change');

        // if (Cookies.get("tab") == 'data') {
        //     console.log(Cookies.get("tab"));

        $("#data_tab").addClass("active");
        $("#data").css("display", "block");
        // } else {
        // $("#krungthai_tab").addClass("active");
        // $("#krungthai").css("display", "block");

        // }
    });
</script>