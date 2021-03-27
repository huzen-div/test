<!-- <?php var_dump($data); ?> -->
<style>
    th {
        color: #ffffff;
        background-color: #10b95c;
    }
</style>
<form action="<?= base_url('finance/actions_datepay') ?>" method="POST">

    <div class="row" style="margin-bottom: 1%;">

    <label id="date-label-from" class="col-md-1">ค้นหา </label>
        <input type="text" id="txt_search"  autocomplete="off" class=" form-control col-md-2" name="txt_search">
        

        <label id="date-label-from" class="col-md-1">เริ่ม:</label>
        <input type="text" id="datepicker_from"  autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
        <!-- <input class="form-control col-md-3" name="datepicker_from" type="date" id="datepicker_from" /> -->
        <label id="date-label-to" class="col-md-1">สิ้นสุด:</label>
        <!-- <input class="form-control col-md-3" name="datepicker_to" type="date" id="datepicker_to" /> -->
        <input type="text" id="datepicker_to"  autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />

        <!-- <input type="button" class="btn btn-warning offset-md-3" onclick="myFunction()" value="บันทึกวันนัดชำระ" style="margin-left: 2%;" /> -->
        <!-- <input type="submit" class="btn btn-success offset-md-3" name="excell" value="Export to Excel" style="margin-left: 2%;" /> -->
        <input type="image" src="<?= base_url('files/excel.png')?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" >



    </div>
    <hr>
    <div class="row" style="margin-bottom: 1%;">
        <!-- <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excel" style="margin-right: 2%; margin-right: 2%;" />
       
	 <input type="submit" class="btn btn-success col-md-2" name="report" value="Print Report" style="margin-right: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" />

        <input type="button" class="btn btn-primary offset-md-3" onclick="myFunction()" value="บันทึกวันนัดชำระ" style="margin-left: 2%;" />
-->
    </div>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>
                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                </th>

                <th>รหัสสมาชิก </th>
                <th>ชื่อสมาชิก </th>
                <th>วันที่ </th>
                <th>สถานะ</th>
                <th>เครดิต(วัน)</th>
                <th>รหัสพนักงาน</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data) : ?>
                <?php foreach ($data as $x) : ?>
                    <tr>

                        <td class="textnum" align="center"><?php echo $x['id']; ?></td>
                        <td><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                        <td ><?php echo $x['name']; ?></td>
                        <td>
                            <?php echo date('d-m-Y', strtotime($x['date'])); ?>
                            <!-- <?php echo thaidate(date('d-m-Y', strtotime($x['date']))); ?>  -->
                        </td>
                        <!-- <td><?php echo $x['date']; ?></td> -->
                        <td class="textnum">
                            <center><?php echo $x['status_id']; ?></center>
                        </td>

                        <td >
                            <?php echo $x['unit_id']; ?>
                        </td>
                        <td >
                            <?php echo $x['employee_id']; ?>
                        </td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a class="dropdown-item" href="<?= base_url('finance/view_datepay') . '/' . $x['id'] ?>">รายละเอียด</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/edit_datepay') . '/' . $x['id'] ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/delete_datepay') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
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
        window.location = "/finance/datepay";
        // location.replace("/finance/datepay")
    }
</script>

<!-- 
<style>
    th {
        color: #ffffff;
        background-color: #10b95c;
    }
</style>

<div class="row" style="margin-bottom: 1%;">
  
    <label id="date-label-from" class="col-md-1">เริ่ม:</label><input class="form-control col-md-3" type="date" id="datepicker_from" />
    <label id="date-label-to" class="col-md-1">สิ้นสุด:</label><input class="form-control col-md-3" type="date" id="datepicker_to" />
</div>
<form action="<?= base_url('finance/actions_acceptpayment') ?>" method="POST">

    <div class="row" style="margin-bottom: 1%;">
        <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excel" style="margin-right: 2%; margin-left: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="report" value="Print Report" style="margin-right: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" />

        
        <input type="button" class="btn btn-primary offset-md-1" onclick="myFunction()" value="เพิ่มรับชำระ" style="margin-right: 2%;" />
   
   
    </div>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>
                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                </th>
                <th>วันที่</th>
                <th>รหัส</th>
                <th>รายละเอียด</th>
                <th>จำนวน</th>
                <th>ราคาต่อหน่วย</th>
                <th>ยอดคงเหลือ</th>
                <th>จำนวนเงิน</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($data) : ?>
                <?php foreach ($data as $x) : ?>
                    <tr>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo thaidate($x['date']); ?></td>
                        <td><?php echo $x['customer_id']; ?></td>
                        <td><?php echo $x['note']; ?></td>
                        <td><?php echo '' ?></td>
                        <td><?php echo '' ?></td>
                        <td><?php echo '' ?></td>
                        <td><?php echo $x['payment_amount']; ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a class="dropdown-item" href="<?= base_url('finance/view_acceptpayment') . '/' . $x['id'] ?>">รายละเอียด<?= $title ?></a>
                                    
                                    <a class="dropdown-item" href="<?= base_url('finance/edit_acceptpayment') . '/' . $x['id'] ?>">แก้ไข<?= $title ?></a>
                                    <a class="dropdown-item" href="<?= base_url('finance/delete_acceptpayment') . '/' . $x['id'] ?>"onclick="return confirm('ยืนยัน ?')">ลบ<?= $title ?></a>
                               
                            
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
</script> -->
