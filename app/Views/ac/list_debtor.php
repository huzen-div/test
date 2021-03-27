<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('account/actions_debtor') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="search" class="col-md-2 textwhite"><?= $search = 'ค้นหาข้อมูลสมาชิก'; ?>:</label>
            <input type="text" id="search" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">


            <!-- <label id="date-label-from" class="col-md-1">เริ่ม:</label>
        <input type="text" id="datepicker_from" class="datetimepicker2 form-control col-md-3" name="datepicker_from">
        <label id="date-label-to" class="col-md-1">สิ้นสุด:</label>
        <input type="text" id="datepicker_to" class="datetimepicker2 form-control col-md-3" name="datepicker_to">
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" /> -->

            <input type="button" class="btn btn-warning offset-md-1" onclick="myFunction()" value="เพิ่มข้อมูลสมาชิก" style="margin-right: 2%;" />

            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">

        </div>

        <!--  <div class="row" style="margin-bottom: 1%;">
         <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excell" style="margin-right: 2%; margin-left: 2%;" />
        <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        <input type="submit" class="btn btn-success col-md-2" name="report" value="Print Report" style="margin-right: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" />

        <input type="button" class="btn btn-primary offset-md-1" onclick="myFunction()" value="เพิ่มข้อมูลสมาชิก" style="margin-right: 2%;" />
        </div>-->
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th>รูปภาพสมาชิก</th>
                    <th>ชื่อสมาชิก</th>
                    <th>รหัสสมาชิก</th>
                    <th>อายุสมาชิก</th>
                    <th>เลขบัตรประชาชน</th>
                    <th>เลขที่บัญชี</th>
                    <th>วันเกิด</th>
                    <th>สถานะ</th>
                    <th>ยอดคงเหลือ</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td style="width: 150px;">
                                <?php if ($x['image'] != null) { ?>
                                    <a title="<?php echo $x['name']; ?>" href="<?= base_url('files') . '/' . $x['image'] ?>" target="_blank">
                                        <img src="<?= base_url('files') . '/' . $x['image'] ?>" alt="image" class="imgdeb_pre">
                                    </a>
                                <?php } else { ?>
                                    <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" class="imgdeb_pre">

                                <?php } ?>
                            </td>
                            <td><?php echo $x['name']; ?></td>
                            <td>MOPH-<?php echo sprintf('%07d', $x['id']); ?></td>
                            <td><?php
                                $date = new DateTime($x['date']);
                                $now = new DateTime();
                                $now = $now->modify('+543 year');
                                $interval = $now->diff($date);
                                echo $interval->y;
                                ?></td>
                            <td><?php echo $x['taxpayer_number']; ?></td>
                            <td><?php echo $x['follower_account_number']; ?></td>
                            <!-- <td class="textnum"><?php echo $x['account_number']; ?></td> -->
                            <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            <!-- <td><?php echo $x['date']; ?></td> -->
                            <td><?php echo $x['alive']; ?></td>
                            <td class="textnum"><?php echo number_format($x['balance'], 2); ?></td>
                            <!-- <td><?php echo $x['balance']; ?></td> -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('account/view_debtor') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('account/edit_debtor') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('account/delete_debtor') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่ ?')">ลบ</a>
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
        window.location = "/account/debtor";
        // location.replace("/account/debtor")
    }
</script>