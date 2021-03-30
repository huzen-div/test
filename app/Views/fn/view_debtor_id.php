<div class="modal-header">
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>-->
    <h4 class="modal-title" id="myModalLabel">
        <center>ข้อมูลสมาชิก</center>
    </h4>
    <?php
    $bk = [
        '1' => 'kt.png',
        '2' => 'scb.jpg'
    ];

    $bk_name = [
        null => 'ข้อมูลผิดพลาด',
        '1' => 'ธนาคารกรุงไทย',
        '2' => 'ธนาคารไทยพาณิชย์',
    ];
    if ($data[0]['bank'] != null) { ?>
        <img src="<?= base_url($bk[$data[0]['bank']]) ?>" alt="image" style="width: 50px;">
    <?php } else { ?>
        <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" style="width: 50px;">

    <?php } ?>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-borderless table-striped dfTable table-right-left">
                    <tbody>
                        <?php foreach ($data as $x) : ?>
                            <tr style="font-size: 20pt;">
                                <td>ข้อมูล : </td>
                                <td>สมาชิก</td>
                            </tr>
                            <tr>
                                <td class="text_imgdeb">รูปภาพสมาชิก :</td>
                                <td><img src="<?= base_url('files') . '/' . $x['image'] ?>" alt="image" class="imgdeb"></td>
                            </tr>
                            <tr>
                                <td>รหัสสมาชิก</td>
                                <!-- <td><?php echo $x['id']; ?></td> -->
                                <td>MOPH-<?php echo sprintf('%07d', $x['id']); ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อ - นามสกุล :</td>
                                <td><?php echo $x['name']; ?></td>
                            </tr>
                            <tr>
                                <td>วัน/เดือน/ปีเกิด :</td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($x['date'])); ?>
                                    <!-- <?php echo $x['date']; ?> -->
                                </td>
                            </tr>
                            <tr>
                                <td>เพศ :</td>
                                <td><?php echo $x['gender']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่บัตรประชาชน :</td>
                                <td><?php echo $x['taxpayer_number']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['address']; ?></td>
                            </tr>
                            <tr>
                                <td>อีเมล์ :</td>
                                <td><?php echo $x['email']; ?></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร :</td>
                                <td><?php echo $x['telephone']; ?></td>
                            </tr>
                            <tr>
                                <td>สถานะสมาชิก :</td>
                                <td><?php echo $x['alive']; ?></td>
                            </tr>
                            <tr style="font-size: 20pt;">
                                <td>ข้อมูล :</td>
                                <td>ทายาท</td>
                            </tr>
                            <tr>
                                <td class="text_imgdeb">รูปภาพทายาท</td>

                                <td> <img src="<?= base_url('files') . '/' . $x['follower_image'] ?>" alt="image" class="imgdeb"></td>
                            </tr>
                            <tr>
                                <td>ชื่อ - นามสกุล :</td>
                                <td><?php echo $x['follower_name']; ?></td>
                            </tr>
                            <tr>
                                <td>วัน/เดือน/ปีเกิด :</td>
                                <td> <?php echo date('d/m/Y', strtotime($x['follower_date'])); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>เลขที่บัตรประชาชน :</td>
                                <td><?php echo $x['follower_taxpayer_number']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['follower_address']; ?></td>
                            </tr>
                            <tr>
                                <td>อีเมล์ :</td>
                                <td><?php echo $x['follower_email']; ?></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร :</td>
                                <td><?php echo $x['follower_telephone']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่บัญชีธนาคาร :</td>
                                <td><?php echo $x['follower_account_number']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อธนาคาร :</td>
                                <td><?php echo $x['follower_account_name']; ?></td>
                            </tr>
                            <tr>
                                <td>ประเภทบัญชี :</td>
                                <td><?php echo $x['follower_account_type']; ?></td>
                            </tr>
                            <tr>
                                <td>สาขา :</td>
                                <td><?php echo $x['follower_account_branch']; ?></td>
                            </tr>

                            <tr style="font-size: 20pt;">
                                <td>ข้อมูล :</td>
                                <td>ผู้ติดต่อ กรณีฉุกเฉิน</td>
                            </tr>


                            <tr>
                                <td>ชื่อ - นามสกุล :</td>
                                <td><?php echo $x['emergency_name']; ?></td>
                            </tr>
                            <tr>
                                <td>วัน/เดือน/ปีเกิด :</td>
                                <td> <?php echo date('d/m/Y', strtotime($x['emergency_date'])); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>เลขที่บัตรประชาชน :</td>
                                <td><?php echo $x['emergency_taxpayer_number']; ?></td>
                            </tr>
                            <tr>
                                <td>ความสัมพันธ์ :</td>
                                <td><?php echo $x['relationship']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['emergency_address']; ?></td>
                            </tr>
                            <tr>
                                <td>อีเมล์ :</td>
                                <td><?php echo $x['emergency_email']; ?></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร :</td>
                                <td><?php echo $x['emergency_telephone']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่บัญชีธนาคาร :</td>
                                <td><?php echo $x['emergency_account_number']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อธนาคาร :</td>
                                <td><?php echo $x['emergency_account_name']; ?></td>
                            </tr>
                            <tr>
                                <td>ประเภทบัญชี :</td>
                                <td><?php echo $x['emergency_account_type']; ?></td>
                            </tr>
                            <tr>
                                <td>สาขา :</td>
                                <td><?php echo $x['emergency_account_branch']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>