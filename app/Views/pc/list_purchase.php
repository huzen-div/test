<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('purchase/actions_purchase') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-1 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-3" placeholder="<?= $search ?>" autocomplete="">
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />

            <input type="button" class="btn btn-warning" onclick="myFunction()" value="<?= $title ?>" style="margin-left: 2%;" />
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
                                <th>ลำดับ</th>
                                <th>วันที่</th>
                                <th>เลขอ้างอิง </th>
                                <th>ผู้จัดจำหน่าย </th>
                                <th>สถานะการชำระ </th>
                                <th>ทั้งหมด </th>
                                <th>การชำระเงิน </th>
                                <th>คงเหลือ </th>
                                <th>สถานะการจ่ายเงิน </th>
                                <th>จัดการ </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $os = [
                                '1' => 'ยังไม่ชำระ',
                                '2' => 'ค้างจ่าย',
                                '3' => 'ระหว่างดำเนินการ',
                                '4' => 'ยกเลิก',
                            ];
                            if ($data) : ?>
                                <?php foreach ($data as $x) : ?>
                                    <tr data-toggle="modal" data-remote="false" data-target="#myModal">
                                        <td><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['id']; ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['reference']; ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $x['distributor']; ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo $os[$x['order_status']]; ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['amount'], 2); ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['tax'], 2); ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php echo number_format($x['total'], 2); ?></td>
                                        <td href="<?= base_url('purchase/view_purchase_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal"><?php
                                            if($x['payment_status'] == "1"){
                                                $x['payment_status'] = "จ่ายเงินแล้ว";
                                            }else if($x['payment_status'] == "2"){
                                                $x['payment_status'] = "ยังไม่ชำระ";
                                            }else if($x['payment_status'] == "3"){
                                                $x['payment_status'] = "ค้างจ่าย";
                                            }else if($x['payment_status'] == "4"){
                                                $x['payment_status'] = "ระหว่างดำเนินการ";
                                            }else if($x['payment_status'] == "5"){
                                                $x['payment_status'] = "ยกเลิก";
                                            }
                                         echo $x['payment_status']; 
                                        ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    การจัดการ
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="<?= base_url('purchase/view_purchase') . '/' . $x['id'] ?>">รายละเอียด</a>
                                                    <a class="dropdown-item" href="<?= base_url('purchase/edit_purchase') . '/' . $x['id'] ?>">แก้ไข</a>
                                                    <a class="dropdown-item" href="<?= base_url('purchase/delete_purchase') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
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
        window.location = "/purchase/purchase";

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
            "order": [
                [1, "asc"]
            ]
        });
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