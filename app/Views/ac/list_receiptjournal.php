<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('account/list_receiptjournal') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label id="date-label-from" class="col-md-1 textwhite" style="text-align: center;">ค้นหา </label>
            <input type="text" id="search" class="form-control col-md-3 txt_search" placeholder="ค้นหา" autocomplete="">
            <label id="date-label-from" class="col-md-1 textwhite" style="text-align: center;">เริ่ม</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite" style="text-align: center;">สิ้นสุด</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" value="ค้นหา" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
            <input type="button" class="btn btn-warning offset-md-1" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-right: 2%;" />
        </div>
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th>เลขที่</th>
                    <th>วันที่</th>
                    <th>อ้างอิง</th>
                    <th>รายละอียด</th>
                    <th>จำนวนเงิน</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td href="<?= base_url('account/view_receiptjournal_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['no_id']; ?></td>
                            <td href="<?= base_url('account/view_receiptjournal_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            <!-- <td><?php echo $x['date']; ?></td> -->
                            <td href="<?= base_url('account/view_receiptjournal_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['refer']; ?></td>
                            <td href="<?= base_url('account/view_receiptjournal_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['detail']; ?></td>
                            <td href="<?= base_url('account/view_receiptjournal_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                            <!-- <td><?php echo $x['amount']; ?></td> -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('account/view_receiptjournal') . '/' . $x['id'] ?>">รายละเอียด<?= $title ?></a>
                                        <a class="dropdown-item" href="<?= base_url('account/edit_receiptjournal') . '/' . $x['id'] ?>">แก้ไข<?= $title ?></a>
                                        <a class="dropdown-item" href="<?= base_url('account/delete_receiptjournal') . '/' . $x['id'] ?>" onclick="return confirm('ยืนยัน ?')">ลบ<?= $title ?></a>
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
        window.location = "/account/receiptjournal";
        // location.replace("/account/receiptjournal")
    }
</script>