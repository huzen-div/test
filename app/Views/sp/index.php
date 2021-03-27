<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>พัสดุทั้งหมด</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $sumproduct ? $sumproduct : 0; ?> </font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('supplies/list_product'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>จัดซื้อทั้งหมด</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $sumapurchase ? $sumapurchase : 0; ?> </font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('purchase/list_purchase'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>จัดจ้างทั้งหมด</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $sumhire ? $sumhire : 0; ?> </font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('hire/list_hire'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <font size="+2">
                    <center>โครงการทั้งหมด</center>
                </font><br>
                <p class="text-center">
                    <font size="+2"><?php echo $sumbudget ? $sumbudget : 0; ?></font>
                </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('account/budget'); ?>">ดูทั้งหมด</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab">พัสดุล่าสุด</button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('supplies') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-2" placeholder="<?= $search ?>" autocomplete="">
            <label id="date-label-from" class="col-md-1 textwhite">เริ่ม:</label>
            <input type="text" id="datepicker_from" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from">
            <label id="date-label-to" class="col-md-1 textwhite">สิ้นสุด:</label>
            <input type="text" id="datepicker_to" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to">
            <input type="submit" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />

            <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่มสินค้า" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th>
                                <th align="center">ลำดับ</th>
                                <th align="center">เลขที่เอกสาร(เลขที่ PO) </th>
                                <th align="center">ประเภท </th>
                                <th align="center">ชื่อพัสดุ/วัสดุ </th>
                                
                                <!-- <th align="center">หน่วยนับ</th> -->
                                <!-- <th align="center">จำนวนเงิน (บาท) </th> -->
                                <!-- <th align="center">ภาษี7% (VAT) </th> -->
                                <th align="center">จำนวนทั้งสิ้น (บาท) </th>
                                <th align="center">ผู้ดำเนินการ </th>
                                <th align="center">วันที่ </th>
                                <th align="center">จัดการ </th>


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
                                    $total = $vat + $x['price']; ?>
                                    <tr>
                                        <td><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['product_code']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['product_type_name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['name']; ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($total, 2); ?></td>
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['responsible']; ?></td>
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['unit_name']; ?></td> -->
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo number_format($x['price'], 2); ?></td> -->
                                        <!-- <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textnum"><?php echo $vat; ?></td> -->
                                        
                                        <td href="<?= base_url('supplies/view_product_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="<?= base_url('supplies/view_product') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/edit_product') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('supplies/delete_product') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                                    <!-- <a class="dropdown-item" href="<?= base_url('supplies/modal_barcode') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal">สร้าง Barcode</a> -->
                                                    <a class="dropdown-item" href="<?= base_url('supplies/print_barcodes') ?>">สร้าง Barcode</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
    function myFunction() {
        window.location = "/supplies/product";
    }
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
        //     // console.log(this.value);
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
<!-- <script type="text/javascript">
    google.charts.load('current', {
        packages: ['bar']
    });
    google.charts.setOnLoadCallback(drawChart1);

    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses', 'Profit'],
            ['2014', 1000, 400, 200],
            ['2015', 1170, 460, 250],
            ['2016', 660, 1120, 300],
            ['2017', 1030, 540, 350]
        ]);

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses', 'Profit'],
            ['2014', 1000, 400, 200],
            ['2015', 1170, 460, 250],
            ['2016', 660, 1120, 300],
            ['2017', 1030, 540, 350]
        ]);

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        var options = {
            title: 'My Daily Activities',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);

    }
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart4() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2004', 1000, 400],
            ['2005', 1170, 460],
            ['2006', 660, 1120],
            ['2007', 1030, 540]
        ]);

        var options = {
            title: 'Company Performance',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChart5);

    function drawChart5() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2013', 1000, 400],
            ['2014', 1170, 460],
            ['2015', 660, 1120],
            ['2016', 1030, 540]
        ]);

        var options = {
            title: 'Company Performance',
            hAxis: {
                title: 'Year',
                titleTextStyle: {
                    color: '#333'
                }
            },
            vAxis: {
                minValue: 0
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart6);

    function drawChart6() {
        var data = google.visualization.arrayToDataTable([
            ['Mon', 20, 28, 38, 45],
            ['Tue', 31, 38, 55, 66],
            ['Wed', 50, 55, 77, 80],
            ['Thu', 77, 77, 66, 50],
            ['Fri', 68, 66, 22, 15]
            // Treat first row as data as well.
        ], true);

        var options = {
            legend: 'none'
        };

        var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div_2'));

        chart.draw(data, options);
    }
</script>
<style>
    .drawChart{
        height: 500px;
    }
</style>
<div class="row">
    <div id="columnchart_material" class="col-md-6 drawChart"></div>

    <div id="piechart_3d" class="col-md-6 drawChart"></div>
</div>
<div class="row">

    <div id="barchart_material" class="col-md-6 drawChart"></div>
    <div id="curve_chart" class="col-md-6 drawChart"></div>
</div>
<div class="row">
    <div id="chart_div" class="col-md-6 drawChart"></div>
    <div id="chart_div_2" class="col-md-6 drawChart"></div>
</div> -->