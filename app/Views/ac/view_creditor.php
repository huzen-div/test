<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ที่อยู่ :</td>
                    <td><?php echo $x['address']; ?></td>
                </tr>
                <tr>
                    <td>รหัสไปรษณีย์ :</td>
                    <td><?php echo $x['postal_code']; ?></td>
                </tr>
                <tr>
                    <td>เบอร์โทร :</td>
                    <td><?php echo $x['telephone']; ?></td>
                </tr>
                <tr>
                    <td>อีเมล์ :</td>
                    <td><?php echo $x['email']; ?></td>
                </tr>
                <tr>
                    <td>ชื่อผู้ติดต่อ :</td>
                    <td><?php echo $x['follower_name']; ?></td>
                </tr>
                <tr>
                    <td>หมายเหตุ :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่ผู้เสียภาษี :</td>
                    <td><?php echo $x['taxpayer_number']; ?></td>
                </tr>
                <tr>
                    <td>สาขา :</td>
                    <td><?php echo $x['branch']; ?></td>
                </tr>
                <tr>
                    <td>ประเภทเงินจ่าย :</td>
                    <td><?php echo $x['payout_type']; ?></td>
                </tr>
                <tr>
                    <td>อัตราภาษี ณ ที่หัก :</td>
                    <td><?php echo $x['tax_rate']; ?></td>
                </tr>
                <tr>
                    <td>หมวดภาษี ณ ที่จ่าย :</td>
                    <td><?php echo $x['tax_type']; ?></td>
                </tr>
                <tr>
                    <td>เงื่อนไขการหักภาษี :</td>
                    <td><?php echo $x['tax_conditions']; ?></td>
                </tr>
                <tr>
                    <td>ประเภทผู้จ่าย :</td>
                    <td><?php echo $x['payer_type']; ?></td>
                </tr>
                <tr>
                    <td>เลขที่บัญชี :</td>
                    <td><?php echo $x['account_number']; ?></td>
                </tr>
                <tr>
                    <td>เครดิต (วัน) :</td>
                    <td><?php echo $x['unit']; ?></td>
                </tr>
                <tr>
                    <td>ภาษีมูลค่าเพิ่ม (VAT) :</td>
                    <td><?php echo number_format($x['vat'], 2); ?></td>
                </tr>
                <tr>
                    <td>ส่วนลด :</td>
                    <td><?php echo number_format($x['discount'], 2); ?></td>
                </tr>
                <tr>
                    <td>วงเงินที่อนุมัติ :</td>
                    <td><?php echo number_format($x['approval_limit'], 2); ?></td>
                </tr>
                <tr>
                    <td>ยอดต้นปี (บาท) :</td>
                    <td><?php echo number_format($x['total_early_year'], 2); ?></td>
                </tr>
                <tr>
                    <td>วันที่ :</td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                    </td>
                </tr>
                <tr>
                    <td>ยอดคงเหลือ (บาท) :</td>
                    <td><?php echo number_format($x['balance'], 2); ?></td>
                </tr>
                <tr>
                    <td>เช็คจ่ายล่วงหน้า :</td>
                    <td><?php echo number_format($x['prepaid_checks'], 2); ?></td>
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
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />

</div>