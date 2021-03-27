<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: <?php echo number_format(0, 2); ?>; display:block;">
    <form action="<?= base_url('account/money_source') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 0;">
            <div class="col-md-11">
                <label for="year" class="textwhite">เลือกปีงบประมาณ</label>
                <select class="form-control select2" name="year" id="year">
                    <option selected value=""> ---- กรุณาเลือกปีงบประมาณ -----</option>
                    <?php foreach ($project as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['main_item'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <!-- <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" style="margin-top:2%"> -->
            <!-- <div class="col-md-12"> -->
            <!-- </div> -->
        </div>
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>

        <table class="table cell-border" id="dataTable" style="width:100%">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th class="align-middle">ลำดับ</th>
                    <th class="align-middle">รายจ่ายตามงบประมาณ</th>
                    <th class="align-middle">แสดงผล</th>
                    <th class="align-middle">งบขั้นต่ำ</th>
                    <th class="align-middle">แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['id']; ?></td>
                            <td class="textleft"><?php echo $x['main_item']; ?></td>
                            <td>
                                <!-- <input type="checkbox" name="show" value="1" disabled <?php if ($x['show'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?>> -->
                                <?php ($x['show'] == 1) ? $check_status = '<i class="fa fa-check-square" style="color:#0f7d41;"></i>' 
                                : $check_status = '<i class="fa fa-times" style="color:#d61f1f;"></i>'; echo $check_status; ?>
                            </td>
                            <td>
                                <!-- <input type="checkbox" name="budget" value="1" disabled <?php if ($x['budget'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?>> -->
                                <?php
                                    if($x['budget'] == 1){
                                        echo '<span style=" background: #ffc107; padding: 1px 5px; color: white; border-radius: 4px; ">งบขั้นตํ่า</span>';
                                    }else if($x['budget'] == 2){
                                        echo '<span style=" background: #0f7d41; padding: 1px 5px; color: white; border-radius: 4px; ">งบกลาง</span>';
                                    }else if($x['budget'] == 3){
                                        echo '<span style=" background: #0f317d; padding: 1px 5px; color: white; border-radius: 4px; ">งบสูงสุด</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('account/edit_money_source/'.$x['id']) ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>

<script>
    function myFunction() {
        window.location = "/account/add_money_source";
        // location.replace("/account/generaljournal")
    }
    $(document).ready(function() {


        var table = $('#dataTable').DataTable({
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" class="cb_money_source" name="val[]" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            // lengthMenu: [
            //     [10, 25, 50, -1],
            //     [10, 25, 50, "All"],

            // ],
            lengthMenu: [
                [-1],
                ["All"],

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
            $('.cb_money_source', rows).prop('checked', this.checked);
        });

        $('#datatable tbody').on('change', '.cb_money_source', function() {
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
        // $("#txt_search").on('keyup click', function() {
        //     table.search($(this).val()).draw();
        // });
        $("#year").on('change', function() {
            table.search($(this).find('option:selected').text()).draw();
        });
        

        // $('#year').change(function() {
        //     value = $(this).val();
        //     link = "http://chapanakit.airtimes.co/account/money_source/" + value;
        //     window.location.replace(link);

        // });
    });
</script>
<style>
    table td,
    table th {
        border: 1px solid #E5E7E9;
    }
</style>