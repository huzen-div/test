<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('hire/report_hire') ?>" method="POST">
        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />

            <!-- <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่ม<?= $title ?>" style="margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div>
        <div class="card mb-4">


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <!-- <table class="table" id="datatable"> -->

                        <thead>
                            <tr>
                                <th>
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th>
                                <th>ลำดับ</th>
                                <th>ผู้รับผิดชอบ</th>
                                <th>ผู้ว่าจ้าง</th>
                                <th>ผู้รับจ้าง</th>
                                <th>ประเภท </th>
                                <th>งบประมาณ(บาท) </th>
                                <th>ภาษี 7%(VAT) </th>
                                <th>จำนวนเงินทั้งสิ้น(บาท)</th>
                                <th>จัดการ </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $ar = [
                                '0' => '',
                                '1' => 'นิติบุคคล',
                                '2' => 'ผู้รับเหมา',
                                '3' => 'บุคคลทั่วไป',
                                '4' => 'ภาครัฐ / คู่ค้า',
                            ];
                            $no = 1;
                            if ($data) : ?>
                                <?php foreach ($data as $x) : ?>

                                    <!-- <tr href="<?= base_url('hire/view_hireid') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"> -->
                                    <tr>
                                        <td class="textnum"><?php echo $x['id']; ?></td>

                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['operator']; ?></td>
                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['employer']; ?></td>
                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['contractor']; ?></td>
                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $ar[$x['type']]; ?></td>
                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['amount'], 2); ?></td>
                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['tax'], 2); ?></td>
                                        <td href="<?= base_url('hire/view_hire_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['total'], 2); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="<?= base_url('hire/view_hire') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('hire/edit_hire') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('hire/delete_hire') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $no++;
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
        window.location = "/hire/hire";
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
        // $("#search").on('keyup click', function() {
        //     table.columns(2).search($(this).val()).draw();
        // });
        $('#bt_search').on('click', function() {
            // console.log(this.value);
            if (table.search() !== $("#txt_search").val()) {
                table
                    .search($("#txt_search").val())
                    .draw();
            }
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