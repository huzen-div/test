<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>รหัสลูกหนี้ :</td>
                    <td><?php echo 'MOPH-'.sprintf('%07d', $x['customer_id']); ?></td>
                </tr>
                <tr>
                    <td>Bill to :</td>
                    <td><?php echo $x['bill_to']; ?></td>
                </tr>
                <tr>
                    <td>แผนก :</td>
                    <td><?php echo $x['department_id']; ?></td>
                </tr>
                <tr>
                    <td>วันที่กำหนด :</td>
                    <td><?php echo $x['date']; ?></td>
                </tr>
                <tr>
                    <td>ที่อยู่ :</td>
                    <td><?php echo $x['address']; ?></td>
                </tr>
                <tr>
                    <td>โทร :</td>
                    <td><?php echo $x['telephone']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่เอกสาร :</td>
                    <td><?php echo $x['document_id']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่ใบเพิ่มหนี้ :</td>
                    <td><?php echo $x['add_debt_id']; ?></td>
                </tr>
                <tr>
                    <td>ประเภท :</td>
                    <td><?php echo $x['type_id']; ?></td>
                </tr>
                <tr>
                    <td>เครดิต(วัน) :</td>
                    <td><?php echo $x['day']; ?></td>
                </tr>
                <tr>
                    <td>หมายเหตุ :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงิน :</td>
                    <td><?php echo $x['amount']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
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
</div>