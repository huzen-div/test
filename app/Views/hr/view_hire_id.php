<div class="modal-header">
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>-->
    <h4 class="modal-title" id="myModalLabel">
        <center><?= $title ?></center>
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-borderless table-striped dfTable table-right-left">
                    <tbody>
                        <?php foreach ($data as $x) :

                            $ar = [
                                '0' => '',
                                '1' => 'นิติบุคคล',
                                '2' => 'ผู้รับเหมา',
                                '3' => 'บุคคลทั่วไป',
                                '4' => 'ภาครัฐ / คู่ค้า',
                            ];
                        ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>ผู้รับผิดชอบ :</td>
                                <td><?php echo $x['operator']; ?></td>
                            </tr>
                            <tr>
                                <td>ผู้ว่าจ้าง :</td>
                                <td><?php echo $x['employer']; ?></td>
                            </tr>
                            <tr>
                                <td>ผู้รับจ้าง :</td>
                                <td><?php echo $x['contractor']; ?></td>
                            </tr>
                            <tr>
                                <td>วงเงิน :</td>
                                <td><?php echo number_format($x['financial_amount'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>ประเภท :</td>
                                <td>
                                    <?php echo $ar[$x['type']]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>งวดงาน :</td>
                                <td><?php echo $x['period']; ?></td>
                            </tr>
                            <tr>
                                <td>แบ่งจ่าย % :</td>
                                <td><?php echo number_format($x['share'], 2); ?></td>
                            </tr>
                            <?php if ($x['document'] != null) { ?>
                                <tr>
                                    <td>เอกสารแนบ 1 :</td>
                                    <td><a href="<?php echo base_url('files/hire_files') . '/' . $x['document']; ?>">ไฟล์</a></td>

                                </tr>
                            <?php } ?>
                            <?php if ($x['document2'] != null) { ?>
                                <tr>
                                    <td>เอกสารแนบ 2 :</td>
                                    <td><a href="<?php echo base_url('files/hire_files') . '/' . $x['document2']; ?>">ไฟล์</a></td>

                                </tr>
                            <?php } ?>
                            <?php if ($x['document3'] != null) { ?>
                                <tr>
                                    <td>เอกสารแนบ 3 :</td>
                                    <td><a href="<?php echo base_url('files/hire_files') . '/' . $x['document3']; ?>">ไฟล์</a></td>

                                </tr>
                            <?php } ?>
                            <tr>
                                <td>หมายเหตุ :</td>
                                <td><?php echo $x['note']; ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงิน (หน่วย:บาท) :</td>
                                <td><?php echo number_format($x['amount'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>ภาษีมูลค่าเพิ่ม (7%) :</td>
                                <td><?php echo number_format($x['tax'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงินทั้งสิ้น (หน่วย:บาท) :</td>
                                <td><?php echo number_format($x['total'], 2); ?></td>
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
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>