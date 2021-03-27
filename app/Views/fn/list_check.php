<!-- <?php var_dump($data); ?> -->
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('finance/actions_check') ?>" method="POST">

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
            <input type="button" class="btn btn-warning offset-md-3" onclick="myFunction()" value="บันทึกเช็คนำฝาก" style="margin-left: 2%;" />
            <!-- <input type="submit" class="btn btn-success offset-md-3" name="excell" value="Export to Excel" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">

        </div>
        <hr>
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th>เข้าบัญชี </th>
                    <th>ใบที่นำฝาก </th>
                    <th>วันที่นำฝาก </th>
                    <th>วันที่ผ่าน </th>
                    <th>วันที่ดำเนินการ </th>
                    <th>ภาษี 7% (บาท)</th>
                    <th>จำนวนทั้งสิ้น(บาท) </th>
                    <th>จัดการ </th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('finance/view_check_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <center><?php echo $x['into_account']; ?></center>
                            </td>
                            <td href="<?= base_url('finance/view_check_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum">
                                <center><?php echo $x['deposit_id']; ?></center>
                            </td>
                            <!-- <td><?php echo $x['deposit_date']; ?></td>
                        <td><?php echo $x['passed_date']; ?></td>
                        <td><?php echo $x['implementation_date']; ?></td> -->
                            <td href="<?= base_url('finance/view_check_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <?php echo date('d/m/Y', strtotime($x['deposit_date'])); ?>
                                <!-- <?php echo date('d/m/Y', strtotime($x['deposit_date'])); ?> -->
                            </td>
                            <td href="<?= base_url('finance/view_check_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['passed_date']))); ?> -->
                                <?php echo date('d/m/Y', strtotime($x['passed_date'])); ?>
                            </td>
                            <td href="<?= base_url('finance/view_check_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">
                                <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['implementation_date']))); ?> -->
                                <?php echo date('d/m/Y', strtotime($x['implementation_date'])); ?>
                            </td>

                            <?php
                            $vat = $x['vat'];
                            ?>
                            <td href="<?= base_url('finance/view_check_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($vat, 2); ?></td>
                            <td href="<?= base_url('finance/view_check_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['total'], 2); ?></td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('finance/view_check') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/edit_check') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/delete_check') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
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
        window.location = "/finance/check";
        // location.replace("/finance/check")
    }
</script>