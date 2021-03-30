<!-- <?php var_dump($data); ?> -->
<style>
    th {
        color: #ffffff;
        background-color: #10b95c;
    }
</style>
<form action="<?= base_url('finance/actions_reducedebt') ?>" method="POST">

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
    </div>
    <div class="row" style="margin-bottom: 1%;">
        <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excel" style="margin-right: 2%; margin-left: 2%;" />
        <!--  <input type="submit" class="btn btn-success col-md-2" name="report" value="Print Report" style="margin-right: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" />-->

        <input type="button" class="btn btn-primary offset-md-3" onclick="myFunction()" value="บันทึกข้อมูล" style="margin-left: 2%;" />
    </div>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>
                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                </th>
                <th>เลขที่เอกสาร </th>
                <th>รหัสลูกหนี้ </th>
                <th>แผนก</th>
                <th>ประเภท </th>
                <th>จำนวนเงิน </th>
                <th>ภาษีมูลค่าเพิ่ม</th>
                <th>จำนวนทั้งสิ้น </th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data) : ?>
                <?php foreach ($data as $x) : ?>
                    <tr>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo 'MOPH-' . sprintf('%07d', $x['customer_id']); ?></td>
                        <td><?php echo $x['department_id']; ?></td>
                        <td><?php echo $x['type_id']; ?></td>
                        <td><?php echo $x['amount']; ?></td>
                        <?php
                        $vat = $x['amount'] * 0.07;
                        ?>
                        <td><?php echo number_format($vat, 0); ?></td>
                        <td><?php echo number_format($x['amount'] + $vat, 2); ?></td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a class="dropdown-item" href="<?= base_url('finance/view_reducedebt') . '/' . $x['id'] ?>">รายละเอียด</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/edit_reducedebt') . '/' . $x['id'] ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?= base_url('finance/delete_reducedebt') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
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
        location.replace("/finance/reducedebt")
    }
</script>