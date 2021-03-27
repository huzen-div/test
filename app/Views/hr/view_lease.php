<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) :

                $ar = [
                    '0' => '',
                    '1' => 'เรียบร้อย',
                    '2' => 'ระหว่างดำเนินการ',
                    '3' => 'ยกเลิก',
                ];
                $ty = [
                    '0' => '',
                    '1' => 'วัสดุสิ้นเปลือง',
                    '2' => 'สินทรัพย์',
                    '3' => 'วัตถุดิบ',
                    '4' => 'อื่นๆ',
                ];
            ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ผู้รับผิดชอบ :</td>
                    <td><?php echo $x['responsible_id']; ?></td>
                </tr>
                <tr>
                    <td>สถานะซ่อม :</td>
                    <td><?php echo $ar[$x['status']]; ?></td>
                </tr>
                <tr>
                    <td>หน่วยงาน :</td>
                    <td><?php echo $x['agency']; ?></td>
                </tr>
                <tr>
                    <td>วันที่ :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr>
                <tr>
                    <td>ประเภท :</td>
                    <td>
                        <?php echo $ty[$x['type_id']]; ?>
                    </td>
                </tr>
                <tr>
                    <td>เบอร์ภายใน :</td>
                    <td><?php echo $x['number']; ?></td>
                </tr>
                <?php if ($x['document'] != null) { ?>
                    <tr>
                        <td>เอกสารแนบ 1 :</td>
                        <td><a href="<?php echo base_url('files/lease_files') . '/' . $x['document']; ?>">ไฟล์</a></td>

                    </tr>
                <?php } ?>
                <?php if ($x['document2'] != null) { ?>
                    <tr>
                        <td>เอกสารแนบ 2 :</td>
                        <td><a href="<?php echo base_url('files/lease_files') . '/' . $x['document2']; ?>">ไฟล์</a></td>

                    </tr>
                <?php } ?>
                <?php if ($x['document3'] != null) { ?>
                    <tr>
                        <td>เอกสารแนบ 3 :</td>
                        <td><a href="<?php echo base_url('files/lease_files') . '/' . $x['document3']; ?>">ไฟล์</a></td>

                    </tr>
                <?php } ?>
                <tr>
                    <td>ใบสั่งเช่า :</td>
                    <td><?php echo $x['tax_invoice_id']; ?></td>
                </tr>
                <tr>
                    <td>ส่วนลด (ถ้ามี) :</td>
                    <td><?php echo number_format($x['discount'], 2); ?></td>
                </tr>
                <tr>
                    <td>ประเภทเช่า (เช่น อาคาร, อุปกรณ์) :</td>
                    <td><?php echo $x['type_maintenance']; ?></td>
                </tr>
                <tr>
                    <td>Payment term :</td>
                    <td><?php echo $x['payment_term']; ?></td>
                </tr>
                <tr>
                    <td>อื่นๆ :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
                <tr>
                    <td>1.ชื่อกรรมการ :</td>
                    <td><?php echo $x['director_name1']; ?></td>
                </tr>
                <tr>
                    <td>1.ตำแหน่ง :</td>
                    <td><?php echo $x['position1']; ?></td>
                </tr>
                <tr>
                    <td>2.ชื่อกรรมการ :</td>
                    <td><?php echo $x['director_name2']; ?></td>
                </tr>
                <tr>
                    <td>2.ตำแหน่ง :</td>
                    <td><?php echo $x['position2']; ?></td>
                </tr>
                <tr>
                    <td>3.ชื่อกรรมการ :</td>
                    <td><?php echo $x['director_name3']; ?></td>
                </tr>
                <tr>
                    <td>3.ตำแหน่ง :</td>
                    <td><?php echo $x['position3']; ?></td>
                </tr>
                <tr>
                    <td>4.ชื่อกรรมการ :</td>
                    <td><?php echo $x['director_name4']; ?></td>
                </tr>
                <tr>
                    <td>4.ตำแหน่ง :</td>
                    <td><?php echo $x['position4']; ?></td>
                </tr>
                <tr>
                    <td>5.ชื่อกรรมการ :</td>
                    <td><?php echo $x['director_name5']; ?></td>
                </tr>
                <tr>
                    <td>5.ตำแหน่ง :</td>
                    <td><?php echo $x['position5']; ?></td>
                </tr>
                <tr>
                    <td>6.ชื่อกรรมการ :</td>
                    <td><?php echo $x['director_name6']; ?></td>
                </tr>
                <tr>
                    <td>6.ตำแหน่ง :</td>
                    <td><?php echo $x['position6']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>