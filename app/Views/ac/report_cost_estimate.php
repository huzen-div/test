<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: <?php echo number_format(0, 2); ?>; display:block;">
    <form action="<?= base_url('account/report_cost_estimate') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 0;">
            <div class="col-md-12">
                <label for="project" class="textwhite">กิจกรรม</label>
                <select class="form-control select2" name="project" id="project">
                    <option selected value=""> ---- กรุณาเลือกโครงการ -----</option>
                    <?php foreach ($project as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['main_item'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />
            <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table cell-border" id="dataTable" style="width:100%">
            <?php if ($data) : ?>
                <?php foreach ($data as $x) : ?>
                    <thead>
                        <tr>
                            <th rowspan="2">
                                <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                            </th>
                            <th class="align-middle" rowspan="2">รายการ</th>
                            <th class="align-middle" rowspan="2">ได้รับจัดสรรปี <?= $x['allocate_year']; ?></th>
                            <th class="align-middle" rowspan="2">คำขอตั้งปี <?= $x['request_year']; ?></th>
                            <th class="align-middle" colspan="3">ประมาณการจ่ายล่วงหน้า</th>
                            <th class="align-middle" rowspan="2">ระบุคำชี้แจงและเหตุผลความจำเป็น</th>
                            <th class="align-middle" rowspan="2">การจัดการ</th>
                        </tr>
                        <tr>
                            <th>ปี <?= $x['estimate_year1']; ?></th>
                            <th>ปี <?= $x['estimate_year2']; ?></th>
                            <th>ปี <?= $x['estimate_year3']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="textleft"><?php echo $x['main_item']; ?></td>
                            <td class="textright"><?php echo number_format(0, 2); ?></td>
                            <td class="textright"><?php echo number_format(0, 2); ?></td>
                            <td class="textright"><?php echo number_format(0, 2); ?></td>
                            <td class="textright"><?php echo number_format(0, 2); ?></td>
                            <td class="textright"><?php echo number_format(0, 2); ?></td>
                            <td><?php echo $x['note']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <!-- <a class="dropdown-item" href="<?= base_url('account/view_cost_estimate') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('account/edit_cost_estimate') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('account/delete_cost_estimate') . '/' . $x['id'] ?>" onclick="return confirm('ยืนยัน ?')">ลบ</a> -->
                                        <a class="dropdown-item" href="<?= base_url('account/report_cost_estimate_pdf') . '/' . $x['id'] ?>">รายงาน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                <?php endforeach; ?>
            <?php endif; ?>
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
            if (table.search() !== $("#txt_search").val()) {
                table
                    .search($("#txt_search").val())
                    .draw();
            }
        });


        $('#project').change(function() {
            value = $(this).val();
            link = "http://chapanakit.airtimes.co/account/report_cost_estimate/" + value;
            // table.ajax.url('getCost_estimate_api/'+id).load();
            // window.location = "/account/cost_estimate/".id;
            window.location.replace(link);
            // window.location.replace("https://www.google.co.th/");

        });
    });
</script>
<style>
    table td,
    table th {
        border: 1px solid #E5E7E9;
    }
</style>