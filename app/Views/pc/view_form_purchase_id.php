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
                        <?php foreach ($data as $x) :  ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>ผู้ขาย/ผู้รับจ้าง :</td>
                                <td><?php echo $x['seller_name']; ?></td>
                            </tr>
                            <tr>
                                <td>ใบสั่งซื้อ/สั่งจ้าง :</td>
                                <td> <?php echo 'PO-' . $x['purchase_order1'] . '/' . $x['purchase_order2']; ?> </td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['house_no']; ?></td>
                            </tr>
                            <tr>
                                <td>ซอย :</td>
                                <td><?php echo $x['alley']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>ถนน :</td>
                                <td> <?php echo $x['road']; ?> </td>
                            </tr>
                            <tr>
                                <td>ตำบล :</td>
                                <td> <?php echo $x['sub_district']; ?> </td>
                            </tr>
                            <tr>
                                <td>อำเภอ :</td>
                                <td> <?php echo $x['district']; ?> </td>
                            </tr>
                            <tr>
                                <td>จังหวัด :</td>
                                <td> <?php echo $x['province']; ?> </td>
                            </tr>
                            <tr>
                                <td>รหัสไปรษณีย์ :</td>
                                <td> <?php echo $x['postal_code']; ?> </td>
                            </tr>
                            <tr>
                                <td>ปีงบประมาณ :</td>
                                <td> <?php echo $x['fiscal_year']; ?> </td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td> <?php echo $x['house_no2']; ?> </td>
                            </tr>
                            <tr>
                                <td>หมู่ที่ :</td>
                                <td> <?php echo $x['swine2']; ?> </td>
                            </tr>
                            <tr>
                                <td>ซอย :</td>
                                <td> <?php echo $x['alley2']; ?> </td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td> <?php echo $x['tel']; ?> </td>
                            </tr>
                            <tr>
                                <td>ถนน :</td>
                                <td> <?php echo $x['road2']; ?> </td>
                            </tr>
                            <tr>
                                <td>ตำบล :</td>
                                <td> <?php echo $x['sub_district2']; ?> </td>
                            </tr>
                            <tr>
                                <td>อำเภอ :</td>
                                <td> <?php echo $x['district2']; ?> </td>
                            </tr>
                            <tr>
                                <td>เลขที่ประจำตัวผู้เสียภาษี :</td>
                                <td> <?php echo $x['taxpayer_id']; ?> </td>
                            </tr>
                            <tr>
                                <td>จังหวัด :</td>
                                <td> <?php echo $x['province2']; ?> </td>
                            </tr>
                            <tr>
                                <td>รหัสไปรษณีย์ :</td>
                                <td> <?php echo $x['postal_code2']; ?> </td>
                            </tr>
                            <tr>
                                <td>เลขที่บัญชีเงินฝากธนาคาร :</td>
                                <td> <?php echo $x['bank_account_number']; ?> </td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td> <?php echo $x['tel2']; ?> </td>
                            </tr>
                            <tr>
                                <td>ชื่อบัญชี :</td>
                                <td> <?php echo $x['account_name']; ?> </td>
                            </tr>
                            <tr>
                                <td>ธนาคาร :</td>
                                <td> <?php echo $x['bank_number']; ?> </td>
                            </tr>
                            <tr>
                                <td>สาขา :</td>
                                <td> <?php echo $x['bank_branch']; ?> </td>
                            </tr>
                            <tr>
                                <td>อื่นๆ :</td>
                                <td> <?php echo $x['other']; ?> </td>
                            </tr>
                            <tr>
                                <td>รายละเอียด :</td>
                                <td> <?php echo $x['detail']; ?> </td>
                            </tr>
                            <tr>
                                <td>รายการ :</td>
                                <td> <?php echo $x['list']; ?> </td>
                            </tr>
                            <tr>
                                <td>ราคาหน่วย (บาท/สตางค์) :</td>
                                <td> <?php echo $x['unit_price']; ?> </td>
                            </tr>
                            <tr>
                                <td>จำนวนเงิน (บาท/สตางค์) :</td>
                                <td> <?php echo $x['amount']; ?> </td>
                            </tr>
                            <tr>
                                <td>ราคาก่อนรวมภาษีมูลค่าเพิ่ม :</td>
                                <td> <?php echo $x['before_vat']; ?> </td>
                            </tr>
                            <tr>
                                <td>ภาษีมูลค่าเพิ่ม 7% :</td>
                                <td> <?php echo $x['vat']; ?> </td>
                            </tr>
                            <tr>
                                <td>รวมเป็นเงินทั้งสิ้น :</td>
                                <td> <?php echo $x['total']; ?> </td>
                            </tr>
                            <?php if ($x['document'] != null) { ?>
                                <tr>
                                    <td>เอกสารแนบ :</td>
                                    <td><a href="<?php echo base_url('files/form_purchase_files') . '/' . $x['document']; ?>">ไฟล์</a></td>

                                </tr>
                            <?php } ?>
                            <?php if ($x['document2'] != null) { ?>
                                <tr>
                                    <td>เอกสารแนบ2 :</td>
                                    <td><a href="<?php echo base_url('files/form_purchase_files') . '/' . $x['document2']; ?>">ไฟล์</a></td>

                                </tr>
                            <?php } ?>
                            <?php if ($x['document3'] != null) { ?>
                                <tr>
                                    <td>เอกสารแนบ3 :</td>
                                    <td><a href="<?php echo base_url('files/form_purchase_files') . '/' . $x['document3']; ?>">ไฟล์</a></td>

                                </tr>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" class="btn btn-warning " value="ปริ้น" />
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>