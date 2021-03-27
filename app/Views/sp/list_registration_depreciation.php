<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('supplies/list_registration_depreciation') ?>" method="POST">
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
                    <table class="table table-bordered" id="dataTable" width="2000" cellspacing="0">
                        <thead>
                            <tr>

                                <th style="height: 50px; vertical-align: inherit;">
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th>
                                <!-- <th align="center">ลำดับ</th>
                                <th align="center">เลขที่เอกสาร </th>
                                <th align="center">โครงการจัดซื้อจัดจ้าง </th>
                                <th align="center">ผู้ดำเนินการ </th>
                                <th align="center">หน่วยนับ</th>
                                <th align="center">งบประมาณ(บาท) </th>
                                <th align="center">ภาษี7%(VAT) </th>
                                <th align="center">จำนวนทั้งสิ้น(บาท) </th>
                                <th align="center">วันที่ </th>
                                <th align="center">จัดการ </th> -->
                                <th align="center" style="height: 50px; vertical-align: inherit;">ลำดับ</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">วันที่ซื้อ</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">รหัสครุภัณฑ์/วัสดุภัณฑ์</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">รหัสบาร์โค๊ด</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">ชื่อครุภัณฑ์/วัสดุภัณฑ์</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">ราคาที่ซื้อ</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">ราคาคงเหลือ ยกมาต้นปี</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">อัตราค่าเสื่อมราคา (%)</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">อัตราค่าเสื่อมราคา (ปี)</th>
                                <!-- <th align="center" style="height: 50px; vertical-align: inherit;">อัตราค่าเสื่อมราคา (บาท)</th> -->
                                <th align="center" style="height: 50px; vertical-align: inherit;">ค่าเสื่อมราคาปีปัจจุบัน</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">ค่าเสื่อมราคาสะสม ยกมาต้นปี</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">ค่าเสื่อมราคาสะสม ยกไป</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">ราคาคงเหลือ  ยกไป</th>
                                <th align="center" style="height: 50px; vertical-align: inherit;">จัดการ</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($data) :
                                $ar = [
                                    '0' => '',
                                    '1' => 'active',
                                    '2' => 'inactive',
                                    '3' => 'other',
                                ];
                                foreach ($data as $x) :
                                    $vat = 0;
                                    $total = 0;
                                    if ($x['type'] == '1') {
                                        $vat = $x['tax_rate'];
                                    } elseif ($x['type'] == '2') {
                                        $vat = ($x['price'] * $x['tax_rate']) / 100;
                                    }
                                    $total = $vat + $x['price']; 

                                    $rate_type = "";
                                    if($x['asset_rate_type'] == 1){
                                        $rate_type = "ปี";
                                        $ResidualCurYear = ($x['asset_price']-$x['asset_carcass'])/$x['asset_rate_value'];// ค่าเสื่อมปีปัจจุบัน = ราคาซื้อมา-ราคาซาก/จำนวนปี => 40,0000/5 = 8,000
                                        $ResidualCurYearFixPer = (($ResidualCurYear/$x['asset_price']-$x['asset_carcass']))*100;//ค่าเสื่อมราคา percent = ราคาสินทรัพย์/ราคาเสื่อมต่อ*100
                                        $ResidualCurYearFix = $ResidualCurYear;//ค่าเสื่อมราคา บาท
                                    } else if($x['asset_rate_type'] == 2){
                                        $rate_type = "%";
                                        $ResidualCurYear = ($x['asset_price']-$x['asset_carcass'])*$x['asset_rate_value']/100;// ค่าเสื่อมปีปัจจุบัน = ราคาซื้อมา-ราคาซาก*เปอร์เซนของปีปัจจุบัน/100
                                        $ResidualCurYearFixPer = (($ResidualCurYear/$x['asset_price']-$x['asset_carcass']))*100;//ค่าเสื่อมราคา percent = ราคาสินทรัพย์/ราคาเสื่อมต่อ*100
                                        $ResidualCurYearFix = $ResidualCurYear;//ค่าเสื่อมราคา บาท
                                    }

                                    $Ad_date = date("Y-m-d", strtotime("-543 years", strtotime($x['asset_date'])));//เอาปีวันที่เริ่มคิดค่าเสื่อม พ.ศ มาแปลง เป็น ค.ศ
                                    $AdDateYear = date('Y', strtotime($Ad_date));
                                    $curYear = date('Y');

                                    $date_diff1 = new DateTime($Ad_date);//ปีที่เริ่มคิด 59
                                    $date_diff2 = new DateTime(date("Y-m-d"));//ปีปัจจุบัน 64
                                    $interval = $date_diff1->diff($date_diff2); // ห่าง 2 ปี
                                    // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
                                    // $intervalplus = $interval->y+1;
                                    $intervalplus = $interval->y;
                                    // echo "ห่าง ".$intervalplus;

                                    $date1=date_create($AdDateYear."-01-01");
                                    $date2=date_create($AdDateYear."-12-31");
                                    $diffAdDate=date_diff($date1,$date2);

                                    $DateAllYear = $diffAdDate->format("%a")+1;
                                    $x['asset_amount_first_year'] = $x['asset_amount_first_year']+1;

                                    $ResidualFirstYear = $ResidualCurYear*$x['asset_amount_first_year']/$DateAllYear;//จำนวนเงินที่คิดปีแรก

                                    $LastYearDate = $DateAllYear-$x['asset_amount_first_year'];//ปีสุดท้าย = 365-361 = 4
                                    $ResidualLastYear = $ResidualCurYear*$LastYearDate/$DateAllYear;//จำนวนเงินที่คิดปีสุดท้าย

                                    $price1_before = 0; //ค่าเสื่อมราคาสะสมยกมาต้นปี
                                    $price1_after = 0;//ค่าเสื่อมราคาสะสมยกไป
                                    $price2_before = 0;//ราคาคงเหลือยกมาต้นปี
                                    $price2_after = 0;//ราคาคงเหลือยกไป
                                    for($i = 1;$i <= $intervalplus; $i++){
                                        if($i == 1){//ถ้าแรก
                                            $price1_before+=$ResidualFirstYear;
                                            $price1_after+=$price1_before+$ResidualCurYear;//เอาราคาปีที่+ปีกลาง
                                        }
                                        if(($i > 1) && ($i <= $intervalplus)){//ถ้าปีที่ 2 ขึ้นไป และน้อยกว่าหรือเท่ากับปีสุดท้าย
                                            if($i == $x['asset_rate_value']){//ถ้าเป็นปีสุดท้ายที่คีย์
                                                $price1_before+=$ResidualCurYear;
                                                $ResidualCurYear = $ResidualLastYear;//ค่าเสื่อมปีปัจจุบัน
                                                $price1_after = $price1_before+$ResidualLastYear;
                                            }else{
                                                $price1_before+=$ResidualCurYear;
                                                $price1_after = $price1_before+$ResidualCurYear;//เพิ่มปีต่อไป
                                            }
                                        }
                                    }
                                    // echo "price1_before ค่าเสื่อมราคาสะสม ".$price1_before;

                                    $price2_before = ($x['asset_price']-$x['asset_carcass'])-$price1_before;
                                    $price2_after = $x['asset_price']-$x['asset_carcass']-$price1_after;

                                    if($curYear == $AdDateYear){//ถ้าปีปัจจุบันเท่ากับปีที่เริ่มคิดค่าเสื่อม
                                        $ResidualCurYear = $ResidualFirstYear;
                                    }

                                    $cur_date = date("Y-m-d", strtotime("+543 years", strtotime(date("Y-m-d"))));
                                    $cur_year = date('Y', strtotime($cur_date));

                                    $pri_date = date("Y-m-d", strtotime("+544 years", strtotime(date("Y-m-d"))));
                                    $pri_year = date('Y', strtotime($pri_date));

                                    $asset_year = date('Y', strtotime($x['asset_date']));
                                    $cal_year = $cur_year-$asset_year;
                                    $cal_pri_year = $pri_year-$asset_year;

                                    $ResidualYearAllPri = $x['asset_price']-($ResidualCurYear*$cal_pri_year);//ราคาคงเหลือยกมาต้นปี
                                    $ResidualYearAllEnd = $x['asset_price']-($ResidualCurYear*$cal_year);//ราคาคงเหลือยกมาต้นปี
                                    $Acm_Depreciation = $ResidualCurYear*$cal_pri_year;//ค่าเสื่อมราคาสะสม Accumulated Depreciation
                                    // $Acm_DepreciationEnd = $ResidualCurYear*$cal_year;//ค่าเสื่อมราคาสะสม Accumulated Depreciation
                            ?>

                                    <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del"><?php echo $x['product_code']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del"><?php echo $x['product_code']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del"><?php echo $x['name']; ?></td>
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($x['price'], 2); ?></td> -->
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($x['asset_price'], 2); ?></td>
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($ResidualYearAllPri, 2); ?></td> -->
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($price2_before, 2); ?></td>
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?=$x['asset_rate_value']." ".$rate_type;?></td> -->
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($ResidualCurYearFixPer, 0)."%"; ?></td>
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($ResidualCurYearFix, 2); ?></td> -->
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo $x['asset_rate_value']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($ResidualCurYear, 2); ?></td>
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($Acm_Depreciation, 2); ?></td> -->
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($price1_before, 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($price1_after, 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal_del" class="textnum"><?php echo number_format($price2_after, 2); ?></td>
                                        
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <!-- <a class="dropdown-item" href="<?= base_url('supplies/view_product') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/delete_product') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a> -->
                                                    <!-- <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">รายงาน</a> -->
                                                    <a class="dropdown-item" href="<?= base_url('supplies/report_list_registration_depreciation')
                                                    .'/'.$x['id']
                                                    .'/'.$x['date']
                                                    .'/'.$x['product_code']
                                                    .'/'.$x['product_code']
                                                    .'/'.$x['name']
                                                    // .'/'.$x['price']
                                                    .'/'.$x['asset_price']
                                                    // .'/'.$ResidualYearAllPri
                                                    .'/'.$price2_before
                                                    // .'/'.$x['asset_rate_value'].' '.$rate_type
                                                    .'/'.$ResidualCurYearFixPer
                                                    // .'/'.$ResidualCurYearFix
                                                    .'/'.$x['asset_rate_value']
                                                    .'/'.$ResidualCurYear
                                                    // .'/'.$Acm_Depreciation
                                                    .'/'.$price1_before
                                                    .'/'.$price1_after
                                                    .'/'.$price2_after
                                                     ?>">รายงาน</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['product_code']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['responsible']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['unit_name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $x['price']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $vat; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $total; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions"> -->
                                                    <!-- <a class="dropdown-item" href="<?= base_url('supplies/view_product') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/delete_product') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a> -->
                                                    <!-- <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">รายงาน</a> -->
                                                    <!-- <a class="dropdown-item" href="#">รายงาน</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> -->
                                <?php
                                    $no++;
                                endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // function myFunction() {
    //     window.location = "/supplies/requisition";

    // }
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            columnDefs: [{
                'targets': 0,
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
                [1, "asc"]
            ],
            responsive: true

        });
        $("#txt_search").on('keyup click', function() {
            table.search($(this).val()).draw();
        });
        // $('#bt_search').on('click', function() {
        //     if (table.search() !== $("#txt_search").val()) {
        //         table
        //             .search($("#txt_search").val())
        //             .draw();
        //     }
        // });
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
    });
</script>