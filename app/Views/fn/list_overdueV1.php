<style>
    th {
        color: #ffffff;
        background-color: #10b95c;
    }
</style>
<form action="<?= base_url('finance/actions_overdue') ?>" method="POST">
    <div class="row" style="margin-bottom: 1%;">
        <label id="date-label-from" class="col-md-1">ค้นหา </label>
        <input type="text" id="search" autocomplete="off" class=" form-control col-md-2" name="txt_search">
        <label id="date-label-from" class="col-md-1">เริ่ม:</label>
        <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
        <label id="date-label-to" class="col-md-1">สิ้นสุด:</label>
        <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 1%;" />
        <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 1%;" />
        <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
    </div>
    <hr>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>
                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                </th>
                <th>วันที่ </th>
                <th>รหัสสมาชิก </th>
                <th>ชื่อสมาชิก </th>
                <th>ประเภท</th>
                <th>จำนวนเงิน(บาท) </th>
                <th>ภาษี 7% (บาท)</th>
                <th>จำนวนทั้งสิ้น(บาท) </th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $ty = [
                '1' => 'ค้างชำระ',
                '2' => 'ชำระแล้ว'
            ];
            if ($data) : ?>
                <?php foreach ($data as $x) : ?>
                    <tr>
                        <td class="textnum"><?php echo $x['id']; ?></td>
                        <td>
                            <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                        </td>
                        <td><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                        <td><?php echo $x['name']; ?></td>
                        <td class="textnum">
                            <center><?php echo $ty[$x['type_id']]; ?></center>
                        </td>
                        <td class="textnum"><?php echo number_format($x['amount'], 2); ?></td>
                        <?php
                        $vat = $x['amount'] * 0.07;
                        ?>
                        <td class="textnum"><?php echo number_format($vat, 2); ?></td>
                        <td class="textnum"><?php echo number_format($x['amount'] + $vat, 2); ?></td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a class="dropdown-item" href="<?= base_url('finance/view_overdue') . '/' . $x['id'] ?>">รายละเอียด</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/edit_overdue') . '/' . $x['id'] ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/delete_overdue') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
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
        window.location = "/finance/overdue";
    }
</script>