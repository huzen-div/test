<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab">รายงานจำหน่ายสินทรัพย์</button>
    <button class="tablinks" onclick="openCity(event, 'transfer')">รายงานโอนย้ายสินทรัพย์ </button>
    <button class="tablinks" onclick="openCity(event, 'repair')">รายงานประวัติการซ่อมแซม </button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0;">
    <form action="<?= base_url('supplies/list_registration_transfer_repair') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
            <!-- <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" /> -->
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= 'เพิ่ม' . $title ?>" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="card mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
                    <table class="table display nowrap" id="dataTable" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th rowspan="2">
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th>
                                <th rowspan="2">ลำดับ</th>
                                <th rowspan="2">รหัสครุภัณฑ์/วัสดุภัณฑ์ </th>
                                <th rowspan="2">รหัสบาร์โค๊ด</th>
                                <th rowspan="2">ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                                <th rowspan="2">หน่วยนับ</th>


                                <th colspan="2">รายการจำหน่าย </th>
                                <th colspan="2">รายการซื้อ </th>
                                <th rowspan="2">ค่าเสื่อมราคาสะสม</th>
                                <th rowspan="2">กำไร (ขาดทุน)จากการจำหน่ายสินทรัพย์ </th>
                                <th rowspan="2">ผู้รับผิดชอบ</th>
                                <th rowspan="2">หมายเหตุ</th>
                                <th rowspan="2">จัดการ </th>


                            </tr>
                            <tr>
                                <th>วันที่</th>
                                <th>จำนวนเงิน (บาท)</th>
                                <th>วันที่</th>
                                <th>จำนวนเงิน (บาท)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // var_dump($product);
                            if ($product) :
                                $ar = [
                                    '0' => '',
                                    '1' => 'active',
                                    '2' => 'inactive',
                                    '3' => 'other',
                                ];
                                foreach ($product as $x) :
                                    $vat = 0;
                                    $total = 0;
                                    if ($x['type'] == '1') {
                                        $vat = $x['tax_rate'];
                                    } elseif ($x['type'] == '2') {
                                        $vat = ($x['price'] * $x['tax_rate']) / 100;
                                    }
                                    $total = $vat + $x['price'];

                                    $rate_type = "";
                                    if ($x['asset_rate_type'] == 1) {
                                        $rate_type = "ปี";
                                        $ResidualCurYear = ($x['asset_price'] - $x['asset_carcass']) / $x['asset_rate_value']; // ค่าเสื่อมปีปัจจุบัน = ราคาซื้อมา-ราคาซาก/จำนวนปี => 40,0000/5 = 8,000
                                        $ResidualCurYearFixPer = (($ResidualCurYear / $x['asset_price'] - $x['asset_carcass'])) * 100; //ค่าเสื่อมราคา percent = ราคาสินทรัพย์/ราคาเสื่อมต่อ*100
                                        $ResidualCurYearFix = $ResidualCurYear; //ค่าเสื่อมราคา บาท
                                    } else if ($x['asset_rate_type'] == 2) {
                                        $rate_type = "%";
                                        $ResidualCurYear = ($x['asset_price'] - $x['asset_carcass']) * $x['asset_rate_value'] / 100; // ค่าเสื่อมปีปัจจุบัน = ราคาซื้อมา-ราคาซาก*เปอร์เซนของปีปัจจุบัน/100
                                        $ResidualCurYearFixPer = (($ResidualCurYear / $x['asset_price'] - $x['asset_carcass'])) * 100; //ค่าเสื่อมราคา percent = ราคาสินทรัพย์/ราคาเสื่อมต่อ*100
                                        $ResidualCurYearFix = $ResidualCurYear; //ค่าเสื่อมราคา บาท
                                    }

                                    $Ad_date = date("Y-m-d", strtotime("-543 years", strtotime($x['asset_date']))); //เอาปีวันที่เริ่มคิดค่าเสื่อม พ.ศ มาแปลง เป็น ค.ศ
                                    $AdDateYear = date('Y', strtotime($Ad_date));
                                    $curYear = date('Y');

                                    $date_diff1 = new DateTime($Ad_date); //ปีที่เริ่มคิด 59
                                    $date_diff2 = new DateTime(date("Y-m-d")); //ปีปัจจุบัน 64
                                    $interval = $date_diff1->diff($date_diff2); // ห่าง 2 ปี
                                    // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
                                    // $intervalplus = $interval->y+1;
                                    $intervalplus = $interval->y;
                                    // echo "ห่าง ".$intervalplus;

                                    $date1 = date_create($AdDateYear . "-01-01");
                                    $date2 = date_create($AdDateYear . "-12-31");
                                    $diffAdDate = date_diff($date1, $date2);

                                    $DateAllYear = $diffAdDate->format("%a") + 1;
                                    $x['asset_amount_first_year'] = $x['asset_amount_first_year'] + 1;

                                    $ResidualFirstYear = $ResidualCurYear * $x['asset_amount_first_year'] / $DateAllYear; //จำนวนเงินที่คิดปีแรก

                                    $LastYearDate = $DateAllYear - $x['asset_amount_first_year']; //ปีสุดท้าย = 365-361 = 4
                                    $ResidualLastYear = $ResidualCurYear * $LastYearDate / $DateAllYear; //จำนวนเงินที่คิดปีสุดท้าย

                                    $price1_before = 0; //ค่าเสื่อมราคาสะสมยกมาต้นปี
                                    $price1_after = 0; //ค่าเสื่อมราคาสะสมยกไป
                                    $price2_before = 0; //ราคาคงเหลือยกมาต้นปี
                                    $price2_after = 0; //ราคาคงเหลือยกไป
                                    for ($i = 1; $i <= $intervalplus; $i++) {
                                        if ($i == 1) { //ถ้าแรก
                                            $price1_before += $ResidualFirstYear;
                                            $price1_after += $price1_before + $ResidualCurYear; //เอาราคาปีที่+ปีกลาง
                                        }
                                        if (($i > 1) && ($i <= $intervalplus)) { //ถ้าปีที่ 2 ขึ้นไป และน้อยกว่าหรือเท่ากับปีสุดท้าย
                                            if ($i == $x['asset_rate_value']) { //ถ้าเป็นปีสุดท้ายที่คีย์
                                                $price1_before += $ResidualCurYear;
                                                $ResidualCurYear = $ResidualLastYear; //ค่าเสื่อมปีปัจจุบัน
                                                $price1_after = $price1_before + $ResidualLastYear;
                                            } else {
                                                $price1_before += $ResidualCurYear;
                                                $price1_after = $price1_before + $ResidualCurYear; //เพิ่มปีต่อไป
                                            }
                                        }
                                    }
                                    // echo "price1_before ค่าเสื่อมราคาสะสม ".$price1_before;

                                    $price2_before = ($x['asset_price'] - $x['asset_carcass']) - $price1_before;
                                    $price2_after = $x['asset_price'] - $x['asset_carcass'] - $price1_after;

                                    if ($curYear == $AdDateYear) { //ถ้าปีปัจจุบันเท่ากับปีที่เริ่มคิดค่าเสื่อม
                                        $ResidualCurYear = $ResidualFirstYear;
                                    }

                                    $cur_date = date("Y-m-d", strtotime("+543 years", strtotime(date("Y-m-d"))));
                                    $cur_year = date('Y', strtotime($cur_date));

                                    $pri_date = date("Y-m-d", strtotime("+544 years", strtotime(date("Y-m-d"))));
                                    $pri_year = date('Y', strtotime($pri_date));

                                    $asset_year = date('Y', strtotime($x['asset_date']));
                                    $cal_year = $cur_year - $asset_year;
                                    $cal_pri_year = $pri_year - $asset_year;

                                    $ResidualYearAllPri = $x['asset_price'] - ($ResidualCurYear * $cal_pri_year); //ราคาคงเหลือยกมาต้นปี
                                    $ResidualYearAllEnd = $x['asset_price'] - ($ResidualCurYear * $cal_year); //ราคาคงเหลือยกมาต้นปี
                                    $Acm_Depreciation = $ResidualCurYear * $cal_pri_year; //ค่าเสื่อมราคาสะสม Accumulated Depreciation
                                    // $Acm_DepreciationEnd = $ResidualCurYear*$cal_year;//ค่าเสื่อมราคาสะสม Accumulated Depreciation 
                            ?>
                                    <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['product_code']; ?></td>

                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $x['id']; ?>&code=Code128&translate-esc=on" style="width: 50%;"></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['unit_name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['asset_date'])); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['asset_price'], 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['asset_date'])); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['asset_price'], 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($price1_after, 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['asset_price'] - ($x['asset_price'] - $price1_after), 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['responsible']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['note']; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <!-- <a class="dropdown-item" href="<?= base_url('supplies/view_product') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/delete_product') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a> -->
                                                    <a class="dropdown-item" href="<?= base_url('supplies/report_registration_pdf') . '/' . $x['id'] ?>">รายงาน</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="transfer" class="tabcontent" style="padding-top: 0;">
    <div class="row search_tab" style="margin-bottom: 1%;">
        <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
        <input type="text" id="txt_search2" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
        <!-- <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" /> -->
        <label for="datepicker_from2" class="col-md-1 textwhite">เริ่ม:</label>
        <input type="text" id="datepicker_from2" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from2">
        <label for="datepicker_to2" class="col-md-1 textwhite">สิ้นสุด:</label>
        <input type="text" id="datepicker_to2" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to2">
        <input type="submit" class="btn btn-primary" name="search_transfer" value="ค้นหา" style="margin-left: 2%;" />
        <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= 'เพิ่ม' . $title ?>" style="margin-left: 2%;" /> -->
        <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display nowrap" id="dataTable2" style="width:100%" cellspacing="0">
                    <!-- <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0"> -->
                    <thead>
                        <!-- <tr>

                            <th rowspan="2">
                                <div class="text-center"><input name="select_all2" id="select-all2" type="checkbox" /></div>
                            </th>
                            <th rowspan="2">ลำดับ</th>
                            <th rowspan="2">เลขที่เอกสาร </th>
                            <th rowspan="2">รหัสครุภัณฑ์/วัสดุภัณฑ์ </th>
                            <th rowspan="2">ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                            <th rowspan="2">จำนวนโอน</th>
                            <th colspan="2">โอนออกจาก </th>
                            <th colspan="2">โอนเข้า </th>
                            <th rowspan="2">จัดการ </th>
                        </tr>
                        <tr>
                            <th>รหัสแผนก</th>
                            <th>รหัสที่ตั้ง</th>
                            <th>รหัสแผนก</th>
                            <th>รหัสที่ตั้ง</th>
                        </tr> -->
                        <tr>

                            <th>
                                <div class="text-center"><input name="select_all2" id="select-all2" type="checkbox" /></div>
                            </th>
                            <th>ลำดับ</th>
                            <th>เลขที่เอกสาร </th>
                            <th>รหัสครุภัณฑ์/วัสดุภัณฑ์ </th>
                            <th>รหัสบาร์โค๊ด</th>
                            <th>ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                            <th>วันที่/เวลาดำเนินการ</th>
                            <th>ผู้ดำเนินการ </th>
                            <th>จำนวนโอน</th>
                            <th>โอนย้ายออก</th>
                            <th>โอนย้ายเข้า</th>
                            <th>ชื่อคลังพัสดุ/ครุภัณฑ์</th>
                            <th>บันทึกส่วนเจ้าหน้าที่</th>
                            <th>จัดการ </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($transfer) :
                            $ar = [
                                '0' => '',
                                '1' => 'active',
                                '2' => 'inactive',
                                '3' => 'other',
                            ];
                            foreach ($transfer as $x) :
                                $vat = 0;
                                $total = 0;
                                if ($x['type'] == '1') {
                                    $vat = $x['tax_rate'];
                                } elseif ($x['type'] == '2') {
                                    $vat = ($x['price'] * $x['tax_rate']) / 100;
                                }
                                $total = $vat + $x['price']; ?>
                                <tr>
                                    <td><?php echo $x['id']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x[''])); ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                การจัดการ
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actions">
                                                <!-- <a class="dropdown-item" href="<?= base_url('supplies/view_product') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">แก้ไข</a>
                                                <a class="dropdown-item" href="<?= base_url('supplies/delete_product') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a> -->

                                                <a class="dropdown-item" href="#">รายงาน</a>
                                                <!-- <a class="dropdown-item" href="<?= base_url('supplies/report_product') . '/' . $x['id'] ?>">รายงาน</a> -->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="repair" class="tabcontent" style="padding-top: 0;">
    <div class="row search_tab" style="margin-bottom: 1%;">
        <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
        <input type="text" id="txt_search3" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
        <!-- <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" /> -->
        <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
        <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
        <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
        <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
        <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
        <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= 'เพิ่ม' . $title ?>" style="margin-left: 2%;" /> -->
        <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
    </div>
    <div class="card mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table display nowrap" id="dataTable3" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <div class="text-center"><input name="select_all3" id="select-all3" type="checkbox" /></div>
                            </th>
                            <th>ลำดับ</th>
                            <th>เลขที่ สธ</th>
                            <th>ฝ่าย /แผนก </th>
                            <th>รหัสครุภัณฑ์/วัสดุภัณฑ์ </th>
                            <th>รหัสบาร์โค๊ด</th>
                            <th>ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                            <th>รายการซ่อมแซม</th>
                            <th>เจ้าหน้าที่ผู้รับเรื่อง</th>
                            <th>เจ้าหน้าที่ผู้แจ้งเรื่อง</th>
                            <th>วันที่รับซ่อม</th>
                            <th>วันที่แล้วเสร็จ</th>
                            <th>สถานะ</th>
                            <th>จัดการ </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($repair) :
                            $st = [
                                '1' => 'ดำเนินการซ่อมเรียบร้อยสามารถใช้งานได้ปกติ',
                                // '1' => 'สามารถซ่อมได้',
                                '2' => 'ไม่สามารถซ่อมได้',
                            ];
                            foreach ($repair as $x) : ?>
                                <tr>
                                    <td><?php echo $x['id']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id_cus']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['group']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['pro_id']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $x['pro_id']; ?>&code=Code128&translate-esc=on" style="width: 50%;"></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['pro_name']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['pro_name']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['responsible']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['fullname']; ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date_completion'])); ?></td>
                                    <td href="<?= base_url('hire/view_repair_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $st[$x['status']]; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                การจัดการ
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actions">
                                                <a class="dropdown-item" href="<?= base_url('hire/report_repair_pdf') . '/' . $x['id'] ?>">รายงาน</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // function myFunction() {
    //     window.location = "/supplies/requisition";

    // }
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
        $("#all_tab").addClass("active");
        $("#all").css("display", "block");
        var table = $('#dataTable').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            // scrollX: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ],
            responsive: true

        });
        $("#txt_search").on('keyup click', function() {
            table.search($(this).val()).draw();
        });
        $('#select-all').on('click', function() {
            var rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
        var table2 = $('#dataTable2').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            // scrollX: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ],
            responsive: true

        });
        $("#txt_search2").on('keyup click', function() {
            table2.search($(this).val()).draw();
        });
        $('#select-all2').on('click', function() {
            var rows = table2.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all2').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });

        var table3 = $('#dataTable3').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            // scrollx: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ],
            responsive: true
        });
        $("#txt_search3").on('keyup click', function() {
            table3.search($(this).val()).draw();
        });
        $('#select-all3').on('click', function() {
            var rows = table3.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all3').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
    });
</script>