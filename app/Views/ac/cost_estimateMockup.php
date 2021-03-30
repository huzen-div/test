<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: <?php echo number_format(0, 2); ?>; display:block;">
    <form action="<?= base_url('account/cost_estimate') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 0;">
            <div class="col-md-11">
                <label for="project" class="textwhite">กิจกรรม</label>
                <select class="form-control " name="project" id="project">
                    <option selected value=""> ---- กรุณาเลือกโครงการ -----</option>
                </select>
            </div>
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" style="margin-top:2%">
        </div>
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-left: 2%;" />
        </div>
        <table class="table cell-border" id="dataTable" style="width:100%">
            <thead>
                <tr>
                    <th rowspan="2">
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th class="align-middle" rowspan="2">รายการ</th>
                    <th class="align-middle" rowspan="2">ได้รับจัดสรรปี 2561</th>
                    <th class="align-middle" rowspan="2">คำขอตั้งปี 2562</th>
                    <th class="align-middle" colspan="3">ประมาณการจ่ายล่วงหน้า</th>
                    <th class="align-middle" rowspan="2">ระบุคำชี้แจงและเหตุผลความจำเป็น</th>
                </tr>
                <tr>
                    <th>ปี 2563</th>
                    <th>ปี 2564</th>
                    <th>ปี 2565</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="textleft">รวมงบประมาณ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">1 งบบุคลากร</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">1.1 เงินเดือนและเงินประจำตำแหน่ง</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">1.2 ค่าจ้างประจำ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">1.3 ค่าจ้างชั่วคราว</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">1.4 ค่าตอบแทนพนักงานราชการ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">1.5 เงินช่วยพิเศษพนักงานราชการ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">2 งบดำเนินงาน</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">2.1 ค่าตอบแทน</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">เงินค่าเข้าข้าราชการ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="textleft">เงินตอบแทนตำแหน่งและเงินอื่นๆ</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="row">
        <div class="col-md-12 textcenter">
            <input type="button" class="btn btn-success" value="อนุมัติเงินงวด." />
        </div>
    </div> -->
    </form>
</div>
<script>
    function myFunction() {
        window.location = "/account/add_cost_estimate";
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
            ordering: true,
            order: [
                [1, "asc"]
            ],
            responsive: true
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
        $('#bt_search').on('click', function() {
            // console.log(this.value);
            if (table.search() !== $("#txt_search").val()) {
                table
                    .search($("#txt_search").val())
                    .draw();
            }
        });
    });
</script>
<style>
    table td,
    table th {
        border: 1px solid #E5E7E9;
    }
</style>