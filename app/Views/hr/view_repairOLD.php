<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) :

                $ar = [
                    '0' => '',
                    '1' => 'เทส1',
                    '2' => 'เทส2',
                    '3' => 'เทส3',
                    '4' => 'เทส4',
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
                        <td>เอกสารแนบ : :</td>
                    <td><a href="<?php echo base_url('files/repair_files') . '/' . $x['document']; ?>">ไฟล์</a></td>

                    </tr>
                <?php } ?>
                <tr>
                    <td>ใบสั่ง ภาษี :</td>
                    <td><?php echo $tax[0]['name']; ?></td>
                </tr>
                <tr>
                    <td>ส่วนลด (5/5%) :</td>
                    <td><?php echo number_format($x['discount'], 2); ?></td>
                </tr>
                <tr>
                    <td>ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม) :</td>
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
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>