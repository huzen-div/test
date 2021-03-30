<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>แผนก :</td>
                    <td><?php echo $x['department_id']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่เอกสาร :</td>
                    <td><?php echo $x['no']; ?></td>
                </tr>
                <tr>
                    <td>วันที่  :</td>
                    <td>
                        <!-- <?php echo thaidate(date('d/m/Y', strtotime($x['date']))); ?> -->
                        <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                    </td>
                </tr>
                <tr>
                    <td>หมายเหตุ :</td>
                    <td><?php echo $x['reason']; ?></td>
                </tr>
                <tr>
                    <td>โอนจากบัญชี :</td>
                    <td><?php echo $x['transfer_from']; ?></td>
                </tr>
                <tr>
                    <td>โอนเข้าบัญชี :</td>
                    <td><?php echo $x['transfer_to']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินที่โอน :</td>
                    <td><?php echo $x['amount']; ?></td>
                </tr>
                <tr>
                    <td>ค่าธรรมเนียม :</td>
                    <td><?php echo $x['fee']; ?></td>
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