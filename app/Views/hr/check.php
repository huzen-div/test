<div class="tab">
    <button class="tablinksfix active" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontentfix" style="padding-top: 0; display:block;">
    <form method="post" action="<?= base_url('hire/check') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="agency_code">รหัสหน่วยงาน</label>
                <input type="number" id="agency_code" class="form-control" name="agency_code" value="<?= $_POST['agency_code'] ? $_POST['agency_code'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="document_date">วันที่เอกสาร</label>
                <input type="text" id="document_date" class="datetimepicker2 form-control" name="document_date" value="<?= $_POST['document_date'] ? $_POST['document_date'] : '' ?>" required>
            </div>
            <div class="col-md-3">
                <label for="passed_date">วันที่ผ่านรายการ</label>
                <input type="text" id="passed_date" class="datetimepicker2 form-control" name="passed_date" value="<?= $_POST['passed_date'] ? $_POST['passed_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="responsible_person">ผู้รับผิดชอบ</label>
                <input type="text" id="responsible_person" class="form-control" name="responsible_person" value="<?= $_POST['responsible_person'] ? $_POST['responsible_person'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="unit_code ">รหัสหน่วยเบิกจ่าย</label>
                <input type="text" id="unit_code" class=" form-control" name="unit_code" value="<?= $_POST['unit_code'] ? $_POST['unit_code'] : '' ?>" required>
            </div>
            <div class="col-md-3">
                <label for="delivery_number ">เลขที่ส่งมอบ</label>
                <input type="text" id="delivery_number" class="form-control" name="delivery_number" value="<?= $_POST['delivery_number'] ? $_POST['delivery_number'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="record">ความคิดเห็นกรรมการ/คณะกรรมการ</label>
                <textarea class="form-control" rows="1" name="record" id="record"><?= $_POST['record'] ?? $_POST['record']  ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">หมายเหตุ</label>
                <textarea class="form-control" rows="1" name="note" id="note"><?= $_POST['note'] ?? $_POST['note']  ?></textarea>

            </div>
        </div>
        <div class="tab">
            <button type="button" class="tablinks" onclick="openCity(event, 'general')" id="general_tab">ข้อมูลทั่วไป</button>
            <button type="button" class="tablinks" onclick="openCity(event, 'supplie')">รายการพัสดุ</button>
        </div>
        <div id="general" class="tabcontent" style="padding-top: 0; ">
            <div class="row search_tab" style="margin-bottom: 1%;">
            </div>
            <div class="row" style="margin-bottom: 1%;padding-top: 1%;">
                <div class="col-md-6">
                    <label for="order_number">เลขที่ใบสั่งซื้อ</label>
                    <input type="number" id="order_number" class="form-control" name="order_number" value="<?= $_POST['order_number'] ? $_POST['order_number'] : '' ?>" required />
                </div>
                <div class="col-md-6">
                    <label for="contract_date">วันที่สัญญา</label>
                    <input type="text" id="contract_date" class="datetimepicker2 form-control" name="contract_date" value="<?= $_POST['contract_date'] ? $_POST['contract_date'] : '' ?>" required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
                <div class="col-md-6">
                    <label for="purchasing_type">ประเภทจัดซื้อ</label>
                    <input type="text" id="purchasing_type" class="form-control" name="purchasing_type" value="<?= $_POST['purchasing_type'] ? $_POST['purchasing_type'] : '' ?>" required />
                </div>
                <div class="col-md-6">
                    <label for="take_action">ดำเนินการ</label>
                    <input type="text" id="take_action" class=" form-control" name="take_action" value="<?= $_POST['take_action'] ? $_POST['take_action'] : '' ?>" required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
                <div class="col-md-6">
                    <label for="seller_name">ชื่อผู้ขาย</label>
                    <input type="text" id="seller_name" class="form-control" name="seller_name" value="<?= $_POST['seller_name'] ? $_POST['seller_name'] : '' ?>" required />
                </div>
                <div class="col-md-6">
                    <label for="contract">วิธีจัดซื้อจัดจ้าง</label>
                    <select class="form-control" name="contract" id="contract" required>
                        <option selected value="">เลือกรูปแบบการจ้าง</option>
                        <option value="1" <?php $_POST['contract'] == 1 ? print 'selected' : ''; ?>>วิธี E-Bidding</option>
                        <option value="2" <?php $_POST['contract'] == 2 ? print 'selected' : ''; ?>>วิธีแบบพิเศษ</option>
                        <option value="3" <?php $_POST['contract'] == 3 ? print 'selected' : ''; ?>>วิธีจัดหา</option>
                        <option value="4" <?php $_POST['contract'] == 4 ? print 'selected' : ''; ?>>วิธีตกลงราคา</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
                <div class="col-md-6">
                    <label for="contract_end_date">วันที่สิ้นสุดสัญญา</label>
                    <input type="text" id="contract_end_date" class="datetimepicker2 form-control" name="contract_end_date" value="<?= $_POST['contract_end_date'] ? $_POST['contract_end_date'] : '' ?>" required />
                </div>
                <div class="col-md-6">
                    <label for="inspection_number">เลขที่คุมตรวจรับ</label>
                    <input type="number" id="inspection_number" class="form-control" name="inspection_number" value="<?= $_POST['inspection_number'] ? $_POST['inspection_number'] : '' ?>" required>
                </div>
            </div>
        </div>
        <div id="supplie" class="tabcontent" style="padding-top: 0; ">
            <div class="row search_tab" style="margin-bottom: 1%;">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">


                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>วันที่ส่งมอบ</th>
                            <th>รหัสGPSC</th>
                            <th>รายละเอียดพัสดุ</th>
                            <th>จำนวน </th>
                            <th>หน่วย </th>
                            <th>งวดเงิน </th>
                            <th>มูลค่ารวม</th>
                            <th>ตรวจรับ </th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <?php
                        $no = 1;
                        if ($data) : ?>
                            <?php foreach ($data as $x) : ?>

                                <tr>
                                    <td class="textnum"><?php echo $x['id']; ?></td>
                                    <td><?php echo $x['operator']; ?></td>
                                    <td><?php echo $mt[$x['method']]; ?></td>
                                    <td><?php echo $x['agency']; ?></td>
                                    <td><?php echo $ar[$x['type']]; ?></td>
                                    <td><?php echo number_format($x['amount'], 2); ?></td>
                                    <td><?php echo number_format($x['tax'], 2); ?></td>
                                    <td><?php echo number_format($x['total'], 2); ?></td>
                                    <td class="textnum"><?php echo $x['id']; ?></td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        <?php endif; ?>
                    </tbody> -->
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>1/1/64</td>
                            <td>017000333</td>
                            <td>โต๊ะทำงานผู้บริหาร</td>
                            <td>1.00</td>
                            <td>อัน</td>
                            <td>1</td>
                            <td>50,000.00</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>4/1/64</td>
                            <td>017000334</td>
                            <td>เก้าอี้สำนักงาน</td>
                            <td>1.00</td>
                            <td>อัน</td>
                            <td>1</td>
                            <td>50,000.00</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    $(document).ready(function() {
        $("#general_tab").addClass("active");
        $("#general").css("display", "block");
        var table = $('#dataTable').DataTable({
            columnDefs: [{
                'targets': 8,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ],
            responsive: true

        });
    });
</script>