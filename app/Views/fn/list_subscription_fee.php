<!-- <div class="row" style="margin-bottom: 1%;">
    <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" />
</div> -->
<hr>
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'all')" id="all_tab">ค่าสมัครสมาชิก</button>
</div>
<div id="all" class="tabcontent" style="padding-top: 0; ">
    <form method="post" action="<?= base_url('finance/list_subscription_fee') ?>">
        <div class="row search_tab" style="margin-bottom: 1%;">

            <label id="date-label-from" class="col-md-1 textwhite" for="txt_search1">ค้นหา </label>
            <input type="text" id="txt_search1" autocomplete="off" class=" form-control col-md-2" name="txt_search1">
            <label id="date-label-from" class="textwhite" for="datepicker_from1" style="margin-left: 30px; margin-right: 10px;">เริ่ม:</label>
            <input type="text" id="datepicker_from1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_from1">
            <label id="date-label-to" class="textwhite" for="datepicker_to1" style="margin-left: 30px; margin-right: 10px;">สิ้นสุด:</label>
            <input type="text" id="datepicker_to1" autocomplete="off" class="datetimepicker2 form-control col-md-2" name="datepicker_to1">
            <input type="submit" class="btn btn-primary" name="search" value="ค้นหา" style="margin-left: 2%;" />
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <table class="table display nowrap" id="dataTable1" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all1" type="checkbox" /></div>
                    </th>
                    <th>ลำดับ</th>
                    <th>วันที่</th>
                    <th>ชื่อสมาชิก</th>
                    <th>เลขที่บัตรประชาชน</th>
                    <th>ประเภทสมาชิก</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>อีเมล์</th>
                    <th>ประเภทชำระ</th>
                    <th>ชื่อบัญชี</th>
                    <th>เลขที่บัญชี</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($all) : ?>
                    <?php foreach ($all as $x) : 
                        $cr = [
                            '1' => 'ข้าราชการ',
                            '2' => 'พนักงานราชการ',
                            '3' => 'พนักงานกระทรวง',
                            '4' => 'ลูกจ้างชั่วคราว',
                            '5' => 'ลูกจ้างชั่วคราว',
                        ];
                        $ym = [
                            // null => 'เทส',
                            // '0' => 'เทส',
                            '1' => 'รายปี',
                            '2' => 'รายเดือน',
                        ];
                        ?>
                        <tr>
                            <td><?php echo $x['id']; ?>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['sub_name']; ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id_card']; ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $cr[$x['career']]; ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['phone']; ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['email']; ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $ym[$x['sub_for']]; ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['account_name']; ?></td>
                            <td href="<?= base_url('finance/view_subscription_fee_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['account_number']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('finance/view_subscription_fee') . '/' . $x['id'] ?>">รายละเอียด</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/edit_subscription_fee') . '/' . $x['id'] ?>">แก้ไข</a>
                                        <a class="dropdown-item" href="<?= base_url('finance/delete_subscription_fee') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                        <!-- <a class="dropdown-item" href="<?= base_url('finance/view_subscription_fee_pdf') . '/' . $x['id'] ?>" target="_blank">พิมพ์ใบเสร็จ</a> -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>

<style>
    th {
        /* color: #ffffff;
        background-color: #10b95c; */
        color: #656565;
        background-color: #e5f3ff;
    }


    .textwhite {
        color: white;
    }

    .search_tab {
        padding: 11px 0 11px 0;
        background: #0f7d41;
        margin-bottom: 4px;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        /* border: 1px solid #ccc;
        background-color: #f1f1f1; */
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #0f7d41;
        color: white;
        /* background-color: #ccc; */
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<script>
    function myFunction() {
        window.location = "/finance/subscription_fee";
    }

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
        var table1 = $('#dataTable1').DataTable({
            scrollX: true,
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center chk_table1',
                'render': checkbox
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [1, "asc"]
            ],
            // scrollX: true
        });
        $('#txt_search1').on('keyup change', function() {
            var text = $('#txt_search1').val();

            table1.search(text).draw();
        });
        $('#select-all1').on('click', function() {
            var rows = table1.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#dataTable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#select-all1').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
    });
</script>