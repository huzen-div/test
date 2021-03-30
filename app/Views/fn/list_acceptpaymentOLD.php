<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
<form action="<?= base_url('finance/actions_acceptpayment') ?>" method="POST">

    <div class="row search_tab" style="margin-bottom: 1%;">
    <label id="date-label-from" class="col-md-1 textwhite">ค้นหา </label>
        <input type="text" id="search"  autocomplete="off" class=" form-control col-md-2" name="txt_search">
        

        <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
        <input type="text" id="datepicker_from"  autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
        <!-- <input class="form-control col-md-3" name="datepicker_from" type="date" id="datepicker_from" /> -->
        <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
        <!-- <input class="form-control col-md-3" name="datepicker_to" type="date" id="datepicker_to" /> -->
        <input type="text" id="datepicker_to"  autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        <input type="image" src="<?= base_url('files/excel.png')?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" >
    </div>

    <div class="row" style="margin-bottom: 1%;">
        <!-- <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excel" style="margin-right: 2%; margin-left: 2%;" /> -->
        <!--<input type="submit" class="btn btn-success col-md-2" name="report" value="Print Report" style="margin-right: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" />-->

        <!--  <input type="button" class="btn btn-primary offset-md-1" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-right: 2%;" />-->
    </div>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>
                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                </th>
                <th>รหัสสมาชิก</th>
                <th>วันที่กำหนด</th>
                <th>ชื่อสมาชิก</th>
                <th>เลขที่เอกสาร</th>
                <!--<th>แผนก</th>-->
                <th>ประเภท</th>
                <th>จำนวนเงิน (บาท)</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ar = [
                '0' => '',
                '1' => 'ชำระเงินแล้ว',
                '2' => 'ยังไม่ชำระเงิน',
                '3' => 'ระหว่างดำเนินการ',
            ];
            if ($data) : ?>
                <?php foreach ($data as $x) : ?>
                    <tr>

                        <td><?php echo $x['id']; ?></td>

                        <!-- <td><?php echo thaidate(date('d/m/Y',strtotime($x['date']))); ?></td> -->
                        <td><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                        <td><?php echo date('d/m/Y',strtotime($x['date'])); ?></td>
                        <td><?php echo $x['name']; ?></td>
                        <td><?php echo $x['id']; ?></td>


                        <!---<td><?php echo $x['department_id']; ?></td>-->
                        <td ><?php echo $ar[$x['type_id']]; ?>
                        </td>
                        <td class="textnum"><?php echo number_format($x['payment_amount'], 2); ?></td>

                        <td>
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
        location.replace("/finance/acceptpayment")
    }
</script>