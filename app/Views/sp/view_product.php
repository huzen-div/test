<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php
            $ar = [
                '0' => '',
                '1' => 'ครุภัณฑ์ที่ใช้งานได้',
                '2' => 'ครุภัณฑ์เสื่อมสภาพ',
                '3' => 'ครุภัณฑ์ที่รอจำหน่าย',
            ];
            $gr = [
                '0' => '',
                '1' => 'ครุภัณฑ์',
                '2' => 'วัสดุภัณฑ์',
            ];
            foreach ($data as $x) :
            ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ชื่อครุภัณฑ์/วัสดุภัณฑ์ :</td>
                    <td><?php echo $x['name']; ?></td>
                </tr>
                <tr>
                    <td>รหัสครุภัณฑ์/วัสดุภัณฑ์ :</td>
                    <td><?php echo $x['product_code']; ?></td>
                </tr>
                <tr>
                    <td>ประเภท :</td>
                    <td><?php echo $type[0]['name']; ?></td>
                </tr>
                <tr>
                    <td>สถานะ :</td>
                    <td> <?php echo $ar[$x['status']]; ?> </td>
                </tr>
                <tr>
                    <td>หมวดหมู่หลัก :</td>
                    <td> <?php echo $category[0]['category_name']; ?> </td>
                </tr>
                <?php if ($x['category_minor_id'] != null) { ?>
                    <tr>
                        <td>หมวดหมู่ย่อย :</td>
                        <td> <?php echo $category_sub[0]['category_name']; ?> </td>
                    </tr>
                <?php } ?>
                <?php if ($x['document'] != null) { ?>
                    <tr>
                        <td>เอกสารแนบ :</td>
                        <td><a href="<?php echo base_url('files') . '/' . $x['document']; ?>">ไฟล์</a></td>

                    </tr>
                <?php } ?>
                <tr>
                    <td>หน่วยนับ :</td>
                    <td><?php echo $unit[0]['unit_name']; ?></td>
                </tr>
                <tr>
                    <td>ผู้รับผิดชอบ :</td>
                    <td><?php echo $x['responsible']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงิน (บาท) :</td>
                    <td><?php echo number_format($x['price'], 2); ?></td>
                </tr>
                <tr>
                    <td>รวมภาษี :</td>
                    <td><?php
                        $vat = 0;
                        if ($tax[0]['type'] == '1') {
                            $vat = $tax[0]['tax_rate'] + $x['price'];
                        } elseif ($tax[0]['type'] == '2') {
                            $vat = (($x['price'] * $tax[0]['tax_rate']) / 100) + $x['price'];
                        }
                        echo number_format($vat, 2); ?></td>
                </tr>
                <tr>
                    <td>หมายเหตุ :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
                <tr>
                    <td>วันที่ :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr>
                <?php if ($x['image1'] != null) { ?>
                    <tr>
                        <td>รูปภาพ 1 :</td>
                        <td><img class="img-fluid" src="<?= base_url('files') . '/' . $data[0]['image1'] ?>" style="margin: 1%;width: 100px;" /></td>
                    </tr>
                <?php }
                if ($x['image2'] != null) { ?>
                    <tr>
                        <td>รูปภาพ 2 :</td>
                        <td> <img class="img-fluid" src="<?= base_url('files') . '/' . $data[0]['image2'] ?>" style="margin: 1%;width: 100px;" />
                        </td>
                    </tr>
                <?php } ?>
                <!-- <tr>
                    <td>ประเภท :</td>
                    <td> <?php echo $gr[$x['group']]; ?> </td>
                </tr> -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>