<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: <?php echo number_format(0, 2); ?>; display:block;">
    <form action="<?= base_url('account/budget') ?>" method="POST">
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
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-left: 2%;" />
        </div>
        <table class="table cell-border" id="dataTable1" style="width:100%">
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
                    <td colspan="6" class="textleft blue">งบประมาณที่ผ่านการอนุมัติแล้ว</td>
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
                    <td class="textleft">งบลงทุน</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td class="textleft">งบรายจ่ายยื่น</td>
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
        <table class="table cell-border" id="dataTable3" style="width:100%">
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
    </div>
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
                [1, "desc"]
            ],
            responsive: true,
            paging: false
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
            ordering: true,
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