<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('supplies/transfer') ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="reference">เลขที่เอกสาร</label>
                <input type="text" id="reference" class="form-control" name="reference" value="<?= $_POST['reference'] ? $_POST['reference'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">หมายเหตุ</label>
                <textarea class="form-control" rows="3" name="note" id="note"><?= $_POST['note'] ?? $_POST['note']  ?></textarea>
            </div>
        </div>
        <div class="col-mb-12" style="margin-top: 1rem;">
            <div class="form-group">
                <div class="input-group wide-tip">
                    <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                        <i class="fa fa-2x fa-barcode addIcon"></i>
                    </div>
                    <input type="text" id="search" class="form-control input-lg ui-autocomplete-input" placeholder="โปรดเพิ่มสินค้าในรายการ" autocomplete="">
                    <!-- <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" /> -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="card mb-4 main-dataTable" style="display:none;">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>ชื่อสินค้า</th>
                                <th>คลังสินค้า</th>
                                <th>ชนิด</th>
                                <th>รหัสสินค้า</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($product) {
                                foreach ($product as $key => $value) { ?>

                                    <tr>
                                        <td class="textleft"><?= $value['name'] . " (" . $value['product_code'] . ")"; ?></td>
                                        <td><?= $value['category_name']; ?></td>
                                        <td><?= $value['unit_name']; ?></td>
                                        <td><?= $value['product_code']; ?></td>
                                        <td><input type="button" class="btn btn-primary add_item" name="add_item" value="เพิ่ม" data-item=<?= $value['id']; ?> /></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();
        $('#search').on('keyup', function() {
            if (table.search() !== $("#search").val()) {
                table.search($("#search").val()).draw();
                $(".main-dataTable").css("display", "block");
            }
            if ($("#search").val() == "") {
                $(".main-dataTable").css("display", "none");
            }
        });
    });
</script>