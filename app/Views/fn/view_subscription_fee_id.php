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
                            $cr = [
                                '1' => 'ข้าราชการ',
                                '2' => 'พนักงานราชการ',
                                '3' => 'พนักงานกระทรวง',
                                '4' => 'ลูกจ้างชั่วคราว',
                                '5' => 'อื่นๆ',
                            ];
                            $mb_t = [
                                '1' => 'สามัญ',
                                '2' => 'สมทบ',
                            ];
                            $sf = [
                                '1' => 'บุตร',
                                '2' => 'คู่สมรส',
                                '3' => 'บิดา',
                                '4' => 'มารดา',
                                '5' => 'พี่น้องร่วมบิดามารดาเดียวกัน',
                            ];
                            $ym = [
                                // null => 'เทส',
                                // '0' => 'เทส',
                                '1' => 'รายปี',
                                '2' => 'รายเดือน',
                            ];
                            $tp = [
                                // null => 'เทส',
                                // '0' => 'เทส',
                                '1' => 'หักเงินเดือนจากผู้สมัครสมาชิก',
                                '2' => 'หักเงินจากธนาคาร',
                            ];
                        ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>เขียนที่ :</td>
                                <td><?php echo $x['write_at']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อสมาชิก :</td>
                                <td><?php echo $x['sub_name']; ?></td>
                            </tr>
                            <tr>
                                <td>เกิดวันที่ :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['birthday'])); ?></td>
                            </tr>
                            <tr>
                                <td>อายุ(ปี) :</td>
                                <td><?php echo $x['age']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขบัตรประจำตัวประชาชน :</td>
                                <td><?php echo $x['id_card']; ?></td>
                            </tr>
                            <tr>
                                <td>อาชีพ :</td>
                                <td><?php echo $cr[$x['career']]; ?></td>
                            </tr>
                            <tr>
                                <td>ตำแหน่ง :</td>
                                <td><?php echo $x['position']; ?></td>
                            </tr>
                            <tr>
                                <td>ปฎิบัติงานที่ :</td>
                                <td><?php echo $x['at_work']; ?></td>
                            </tr>
                            <tr>
                                <td>สถานที่รับเงินเดือนหรือค่าจ้าง :</td>
                                <td><?php echo $x['payroll_location']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <h4>ที่อยู่ปัจจุบัน</h4>
                                </td>
                                <!-- <td></td> -->
                            </tr>
                            <tr>
                                <td>บ้านเลขที่ :</td>
                                <td><?php echo $x['house_number']; ?></td>
                            </tr>
                            <tr>
                                <td>หมู่ที่ :</td>
                                <td><?php echo $x['swine']; ?></td>
                            </tr>
                            <tr>
                                <td>ซอย/ตรอก :</td>
                                <td><?php echo $x['alley']; ?></td>
                            </tr>
                            <tr>
                                <td>ถนน :</td>
                                <td><?php echo $x['street']; ?></td>
                            </tr>
                            <tr>
                                <td>ตำบล/แขวง :</td>
                                <td><?php echo $x['canton']; ?></td>
                            </tr>
                            <tr>
                                <td>อำเภอ/เขต :</td>
                                <td><?php echo $x['district']; ?></td>
                            </tr>
                            <tr>
                                <td>จังหวัด :</td>
                                <td><?php echo $x['province']; ?></td>
                            </tr>
                            <tr>
                                <td>รหัสไปรษณีย์ :</td>
                                <td><?php echo $x['postal_code']; ?></td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td><?php echo $x['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>ไปรษณีย์อิเล็กทรอนิกส์ (E-mail) :</td>
                                <td><?php echo $x['email']; ?></td>
                            </tr>
                            <tr>
                                <td>ประเภทสมาชิก :</td>
                                <td><?php echo $mb_t[$x['sub_type']]; ?></td>
                            </tr>
                            <!-- <?php if ($x['sub_type'] == 2) { ?> -->
                            <tr>
                                <td>โดยเป็น :</td>
                                <td><?php echo $sf[$x['sub_for']]; ?></td>
                            </tr>
                            <tr>
                                <td>ของสมาชิกสามัญเลขทะเบียน :</td>
                                <td><?php echo $x['sub_relationships']; ?></td>
                            </tr>
                            <tr>
                                <td>ชำระเงินสงเคราะห์โดย :</td>
                                <td><?php echo $ym[$x['yearly_monthly']]; ?></td>
                            </tr>
                            <tr>
                                <td>หักเงินจาก :</td>
                                <td><?php echo $tp[$x['type_payment']]; ?></td>
                            </tr>
                            <!-- <?php if ($x['type_payment'] == 2) { ?> -->
                            <tr>
                                <td>ชื่อบัญชี :</td>
                                <td><?php echo $x['account_name']; ?></td>
                            </tr>
                            <tr>
                                <td>บัญชีเลขที่ :</td>
                                <td><?php echo $x['account_number']; ?></td>
                            </tr>
                            <!-- <?php } ?> -->
                            <!-- <?php } ?> -->
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <h4>ผู้จัดการศพและหรือผู้มีสิทธิรับเงินสงเคราะห์</h4>
                                </td>
                                <!-- <td></td> -->
                            </tr>
                            <tr>
                                <td>ชื่อผู้จัดการศพ :</td>
                                <td><?php echo $x['funeral_name']; ?></td>
                            </tr>
                            <tr>
                                <td>เกี่ยวข้องเป็น :</td>
                                <td><?php echo $x['funeral_concerned']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['funeral_address']; ?></td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td><?php echo $x['funeral_tel']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 1 :</td>
                                <td><?php echo $x['recipient_name1']; ?></td>
                            </tr>
                            <tr>
                                <td>เกี่ยวข้องเป็น :</td>
                                <td><?php echo $x['recipient_concerned1']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['recipient_address1']; ?></td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td><?php echo $x['recipient_tel1']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 2 :</td>
                                <td><?php echo $x['recipient_name2']; ?></td>
                            </tr>
                            <tr>
                                <td>เกี่ยวข้องเป็น :</td>
                                <td><?php echo $x['recipient_concerned2']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['recipient_address2']; ?></td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td><?php echo $x['recipient_tel2']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 3 :</td>
                                <td><?php echo $x['recipient_name3']; ?></td>
                            </tr>
                            <tr>
                                <td>เกี่ยวข้องเป็น :</td>
                                <td><?php echo $x['recipient_concerned3']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['recipient_address3']; ?></td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td><?php echo $x['recipient_tel3']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 4 :</td>
                                <td><?php echo $x['recipient_name4']; ?></td>
                            </tr>
                            <tr>
                                <td>เกี่ยวข้องเป็น :</td>
                                <td><?php echo $x['recipient_concerned4']; ?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td><?php echo $x['recipient_address4']; ?></td>
                            </tr>
                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td><?php echo $x['recipient_tel4']; ?></td>
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