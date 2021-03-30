<style>
    th {
        color: #ffffff;
        background-color: #10b95c;
    }
</style>
<form action="<?= base_url('finance/list_subscription_fee') ?>" method="POST">
    <div class="row" style="margin-bottom: 1%;">
        <label id="date-label-from" class="col-md-1">ค้นหา </label>
        <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">
        <label id="date-label-from" class="col-md-1">เริ่ม:</label>
        <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
        <label id="date-label-to" class="col-md-1">สิ้นสุด:</label>
        <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" />
        <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
    </div>
    <hr>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>
                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                </th>
                <th>ลำดับ</th>
                <th>ผู้ถอน</th>
                <th>วันที่ถอนเงิน </th>
                <th>ผู้ดำเนินการ </th>
                <th>จำนวนเงิน</th>
                <th>ค่าบริการ </th>
                <th>จำนวนเงินทั้งสิ้น</th>
                <th>การจัดการ</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($data) : ?>
                <?php
                $no = 1;
                foreach ($data as $x) : ?>
                    <tr>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $no; ?></td>
                        <td>
                            <?php echo $x['subscription_feeal']; ?>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                        <td><?php echo $x['operator']; ?></td>
                        <td class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                        <td class="textnum"><?php echo number_format($x['service_charge'], 2); ?></td>
                        <td class="textnum"><?php echo number_format($x['total'], 2); ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a class="dropdown-item" href="<?= base_url('finance/view_subscription_fee') . '/' . $x['id'] ?>">รายละเอียด</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/edit_subscription_fee') . '/' . $x['id'] ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/delete_subscription_fee') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                    $no = $no + 1;
                endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</form>
<script>
    function myFunction() {
        window.location = "/finance/subscription_fee";
    }
</script>