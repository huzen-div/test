<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ประเภท :</td>
                    <td><?php echo $x['type_id']; ?></td>
                </tr>
                <tr>
                    <td>สถานะ :</td>
                    <td><?php echo $x['status_id']; ?></td>
                </tr>
                <tr>
                    <td>ตัดเลขที่บัญชี(จากฝังบัญชี) :</td>
                    <td><?php echo $x['no_id']; ?></td>
                </tr>
                <tr>
                    <td>วันที่ :</td>
                    <td>
                        <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['date']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                    </td>
                </tr>
                <tr>
                    <td>เลขที่เอกสาร :</td>
                    <td><?php echo $x['withdrawal_slip']; ?></td>
                </tr>
                <tr>
                    <td>เพิ่มเติม :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินทั้งสิ้น :</td>
                    <td><?php echo $x['amount']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- <div class="col-md-12" style="text-align: center;">
    <div class="buttons">
        <div class="btn-group btn-group-justified ">
            <div class="btn-group">
                <a href="" class="tip btn btn-warning tip btn-lg " title="แก้ไข">
                    <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">แก้ไข</span>
                </a>
            </div>
            <div class="btn-group">
                <a href="" class="tip btn btn-danger tip btn-lg " title="ลบ">
                    <i class="fa fa-trash"></i> <span class="hidden-sm hidden-xs">ลบ</span>
                </a>
            </div>
        </div>
    </div>
</div> -->
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>