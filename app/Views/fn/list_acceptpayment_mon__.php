<!-- <?php var_dump($data); ?> -->
<style>
    th {
        color: #ffffff;
        background-color: #10b95c;
    }
</style>

<div class="row" style="margin-bottom: 1%;">
  
    <label id="date-label-from" class="col-md-1">เริ่ม:</label><input  autocomplete="off" class="form-control col-md-3" type="date" id="datepicker_from" />
    <label id="date-label-to" class="col-md-1">สิ้นสุด:</label><input  autocomplete="off" class="form-control col-md-3" type="date" id="datepicker_to" />
</div>
<form action="<?= base_url('finance/actions_acceptpayment') ?>" method="POST">

    <div class="row" style="margin-bottom: 1%;">
        <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excel" style="margin-right: 2%; margin-left: 2%;" />

        
        <!--<input type="button" class="btn btn-primary offset-md-1" onclick="myFunction()" value="เพิ่มรับชำระ" style="margin-right: 2%;" />-->
   
   
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
                                   <!-- <a class="dropdown-item" href="<?= base_url('finance/edit_acceptpayment') . '/' . $x['id'] ?>">แก้ไข<?= $title ?></a>
                                    <a class="dropdown-item" href="<?= base_url('finance/delete_acceptpayment') . '/' . $x['id'] ?>"onclick="return confirm('ยืนยัน ?')">ลบ<?= $title ?></a>-->
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
        location.replace("/finance/acceptpayment")
    }
</script>