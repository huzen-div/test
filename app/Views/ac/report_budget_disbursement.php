<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: <?php echo number_format(0, 2); ?>; display:block;">
    <form action="<?= base_url('account/report_budget_disbursement') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 0;">
            <div class="col-md-11">
                <label for="project" class="textwhite">กิจกรรม</label>
                <select class="form-control select2" name="project" id="project">
                    <option selected value=""> ---- กรุณาเลือกโครงการ -----</option>
                    <?php foreach ($project as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['main_item'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" style="margin-top:2%">
        </div>
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search1" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search1" value="ค้นหา" style="margin-left: 2%;" />
            <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-left: 2%;" /> -->
        </div>
        <table class="table cell-border" id="dataTable1" style="width:100%">
            <thead>
                <tr>
                    <th>เลือก</th>
                    <th>ลำดับ</th>
                    <th>ประเภทงบประมาณ</th>
                    <th>อนุมัติจัดสรร(บาท)</th>
                    <th>พักสำรองส่วนกลาง(%)</th>
                    <th>พักสำรองส่วนกลาง(บาท)</th>
                    <th>รับจัดสรรสุทธิ(บาท)</th>
                    <th>การจัดการ</th>
                </tr>
                <tr>
                    <td colspan="8" class="textleft blue">งบประมาณที่ผ่านการอนุมัติแล้ว</td>
                </tr>

                <?php if ($data) :
                    $total_central_percent = 0;
                    $total_central_amount = 0;
                    $total_allocated = 0;
                    foreach ($data as $x) :
                        $total_central_percent += $x['central_percent'];
                        $total_central_amount += $x['central_amount'];
                        $total_allocated += $x['allocated'];
                    endforeach;
                endif; ?>
                <tr>
                    <td>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </td>
                    <td> 0 </td>
                    <td class="textleft">รวมทั้งหมด</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format($total_central_percent, 2); ?></td>
                    <td class="textright"><?php echo number_format($total_central_amount, 2); ?></td>
                    <td class="textright"><?php echo number_format($total_allocated, 2); ?></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>

                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['id']; ?></td>
                            <td class="textleft"><?php echo $x['main_item']; ?></td>
                            <td class="textright"><?php echo number_format($x[''], 2); ?></td>
                            <td class="textright"><?php echo number_format($x['central_percent'], 2); ?></td>
                            <td class="textright"><?php echo number_format($x['central_amount'], 2); ?></td>
                            <td class="textright"><?php echo number_format($x['allocated'], 2); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <!-- <a class="dropdown-item" href="<?= base_url('account/view_budget') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('account/edit_budget') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('account/delete_budget') . '/' . $x['id'] ?>" onclick="return confirm('ยืนยัน ?')">ลบ</a> -->
                                        <a class="dropdown-item" href="<?= base_url('account/report_budget_disbursement_pdf') . '/' . $x['id'] ?>">รายงาน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- <table class="table cell-border" id="dataTable3" style="width:100%">
            <thead>
                <tr>
                    <th>เลือก</th>
                    <th>ประเภทงบประมาณ</th>
                    <th>อนุมัติจัดสรร(บาท)</th>
                    <th>พักสำรองส่วนกลาง(%)</th>
                    <th>พักสำรองส่วนกลาง(บาท)</th>
                    <th>รับจัดสรรสุทธิ(บาท)</th>
                </tr>
                <tr>
                    <td colspan="6" class="textleft blue">งบประมาณที่ขอนุมัติครั้งล่าสุด(ครั้งที่ 1)</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">รวมทั้งหมด</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบบุคลากร</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบดำเนินการ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบขั้นต่ำ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบทั่วไป</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบลงทุน</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบรายจ่ายื่น</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบทดสอบ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="row" style="margin-bottom: 1%;">
        <div class="col-md-12" style="margin-top: 1%;text-align: right;">
            <input type="button" class="btn btn-success" value="อนุมัติงบจัดสรรตามพรบ." style="margin-right: 2%;" />
            <input type="button" class="btn btn-secondary " onclick="history.go(-1);" value="ย้อนกลับหน้าที่แล้ว" />
        </div>
    </div>
    <div class="row search_tab" style="margin-bottom: 1%;">
        <label for="search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
        <input type="text" id="txt_search2" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
        <input type="button" class="btn btn-primary" name="search" id="bt_search2" value="ค้นหา" style="margin-left: 2%;" />
    </div>
    <table class="table cell-border" id="dataTable2" style="width:100%">
        <thead>
            <tr>
                <th>เลือก</th>
                <th>โครงการ/งาน/งวดงาน</th>
                <th>ยอดล่าสุด(บาท)</th>
                <th>อนุมัติเงินงวด(บาท)</th>
                <th>คงเหลือ(บาท)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> 1 </td>
                <td class="textleft">จัดซื้อเครื่องพิมพ์(งวดที่1)</td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
            </tr>
            <tr>
                <td> 1 </td>
                <td class="textleft">งบบุคลากร</td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
            </tr>
            <tr>
                <td> 1 </td>
                <td class="textleft">งบดำเนินงาน</td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
            </tr>
            <tr>
                <td> 1 </td>
                <td class="textleft">งบลงทุน</td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
            </tr>
            <tr>
                <td> 1 </td>
                <td class="textleft">งบรายจ่ายอื่น</td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
            </tr>
            <tr>
                <td> 1 </td>
                <td class="textleft">งบทดสอบ</td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
                <td class="textright"><?php echo number_format(0, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12 textcenter">
            <input type="button" class="btn btn-success" value="อนุมัติเงินงวด." />
        </div>
    </div> -->
</div>
<script>
    function myFunction() {
        window.location = "/account/add_budget";
    }
    $(document).ready(function() {
        var table1 = $('#dataTable1').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            lengthMenu: [
                [-1],
                ["All"],

            ],
            ordering: true,
            order: [
                [1, "asc"]
            ],
            responsive: true,
            paging: false
        });
        $('#select-all').on('click', function() {
            var rows = table1.rows({
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
        var table3 = $('#dataTable3').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': checkbox
            }],
            lengthMenu: [
                [-1],
                ["All"],

            ],
            ordering: false,
            order: [
                [1, "desc"]
            ],
            responsive: true,
            paging: false
        });
        var table2 = $('#dataTable2').DataTable({
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
        $('#bt_search1').on('click', function() {
            // console.log(this.value);
            if (table1.search() !== $("#txt_search1").val()) {
                table1
                    .search($("#txt_search1").val())
                    .draw();
            }
            if (table3.search() !== $("#txt_search1").val()) {
                table3
                    .search($("#txt_search1").val())
                    .draw();
            }
        });
        $('#bt_search2').on('click', function() {
            // console.log(this.value);
            if (table2.search() !== $("#txt_search2").val()) {
                table2
                    .search($("#txt_search2").val())
                    .draw();
            }
        });
    });
</script>
<style>
    table td {
        border: 1px solid #E5E7E9;
    }
</style>