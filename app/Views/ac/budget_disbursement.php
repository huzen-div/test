<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: <?php echo number_format(0, 2); ?>; display:block;">
    <form action="<?= base_url('account/budget_disbursement') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <div class="col-md-11">
                <label for="project" class="textwhite">กิจกรรม</label>
                <select class="form-control select2" name="project" id="project">
                    <option selected value=""> ---- กรุณาเลือกโครงการ -----</option>
                </select>
            </div>
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" style="margin-top:1%">
        </div>
        <table class="table cell-border" id="dataTable" style="width:100%">
            <thead>
                <tr>
                    <th rowspan="2">
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th class="align-middle" rowspan="2">งบรายการจ่าย</th>
                    <th class="align-middle" rowspan="2">งบประมาณได้รับ</th>
                    <th class="align-middle" colspan="2">เบิกจ่าย</th>
                    <th class="align-middle" rowspan="2">คงเหลือ</th>
                    <th class="align-middle" rowspan="2">หมายเหตุ</th>
                </tr>
                <tr>
                    <th>จำนวน</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="textcenter">รวมทั้งสิ้น</td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td class="textright"><?php echo number_format(0, 2); ?></td>
                    <td></td>
                </tr>

                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td class="textleft">-</td>
                            <td class="textright"><?php echo number_format($x[''], 2); ?></td>
                            <td class="textright"><?php echo number_format($x['central_amount'], 2); ?></td>
                            <td class="textright"><?php echo number_format($x['central_percent'], 2); ?></td>
                            <td class="textright"><?php echo number_format($x[''], 2); ?></td>
                            <td><?php echo $x['note']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12 textcenter">
                <input type="button" class="btn btn-success" value="อนุมัติเงินงวด." />
            </div>
        </div>
    </form>
</div>
<script>
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
                [-1],
                ["All"],

            ],
            ordering: false,
            // order: [
            //     [1, "asc"]
            // ],
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
    });
</script>
<style>
    table td,
    table th {
        border: 1px solid #E5E7E9;
    }
</style>