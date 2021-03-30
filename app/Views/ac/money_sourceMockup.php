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
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg" style="margin-top:2%">
            <!-- <div class="col-md-12"> -->
            <!-- </div> -->
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
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th class="align-middle">รายจ่ายตามงบประมาณ</th>
                    <th class="align-middle">ลำดับ</th>
                    <th class="align-middle">แสดงผล</th>
                    <th class="align-middle">งบขั้นต่ำ</th>
                    <th class="align-middle">แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="textleft"><label>1. รายจ่ายส่วนราชการและรัฐวิสาหกิจ</label></td>
                    <td>1</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="textleft"><label style="margin-left: 3%;">1.1 งบบุคคลกร</label></td>
                    <td>1</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="textleft"><label style="margin-left: 3%;">1.2 งบดำเนินงาน</label></td>
                    <td>2</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="textleft"><label style="margin-left: 6%;">1.2.1 ค่าตอบแทน</label></td>
                    <td>1</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="textleft"><label style="margin-left: 6%;">1.2.2 ค่าใช้สอย</label></td>
                    <td>2</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="textleft"><label style="margin-left: 6%;">1.2.3 ค่าวัสดุ</label></td>
                    <td>3</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="textleft"><label style="margin-left: 6%;">1.2.4 ค่าสาธารญูปโภค</label></td>
                    <td>4</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td class="textleft"><label style="margin-left: 3%;">1.3 งบลงทุน</label></td>
                    <td>3</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td class="textleft"><label style="margin-left: 3%;">1.4 งบเงินอุดหนุน</label></td>
                    <td>4</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td class="textleft"><label style="margin-left: 3%;">1.5 งบรายจ่ายอื่น</label></td>
                    <td>5</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td class="textleft"><label>2. รายจ่ายกลาง</label></td>
                    <td>2</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td class="textleft"><label>3. เงินนอกงบประมาณ</label></td>
                    <td>3</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
                <tr>
                    <td>13</td>
                    <td class="textleft"><label>4. เงินกองทุนอพท.</label></td>
                    <td>4</td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <input type="checkbox" name="show" value="1">
                    </td>
                    <td>
                        <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                    </td>
                </tr>
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