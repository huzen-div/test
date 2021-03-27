<!-- <div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
<style>
/* .barcode {
    width: 8.45in;
    height: 10.3in;
    display: block;
    border: 1px solid #CCC;
    margin: 10px auto;
    padding-top: 0.1in;
    page-break-after: always;
}
.barcodea4 {
    width: 8.25in;
    height: 11.6in;
    display: block;
    border: 1px solid #CCC;
    margin: 10px auto;
    padding: 0.1in 0 0 0.1in;
    page-break-after: always;
}

.barcode .item {
    display: block;
    overflow: hidden;
    text-align: center;
    border: 1px dotted #CCC;
    font-size: 12px;
    line-height: 14px;
    text-transform: uppercase;
    float: left;
}
.barcode .style10 {
    width: 4in;
    height: 2in;
    margin: 0 0.1in;
    padding-top: 0.1in;
    font-size: 14px;
    line-height: 20px;
} */

@media print {
    html, body, .container, #content,
    .box-content, .col-lg-12, .table-responsive,
    .table-responsive .table, .dataTable, .box, .row  { width: 100% !important; height: auto !important; border: none !important; padding: 0 !important; margin: 0 !important; }
    .lt .sidebar-con { width: 0; display: none;  }
    body:before, body:after, .no-print,
    #header, #sidebar-left, .sidebar-nav, .main-menu,
    footer, .breadcrumb, .box-header, .box-header .fa, .box-icon, .alert, .introtext,
    .table-responsive .row, .table-responsive .table th:first-child,
    .table-responsive .table td:first-child, .table-responsive .table tfoot,
    .buttons, .modal-open #content, .modal-body .close, .pagination, .close, .staff_note {
        display: none;
    }
    .container { width: auto !important; }
    h3 { margin-top: 0; }
    .modal { position: static; }
    .modal .table-responsive { display: block; }
    .modal .table th:first-child, .modal .table td:first-child, .modal .table th, .modal .table td { display: table-cell !important; }
    .modal-content { display: block !important; background: white !important; border: none !important; }
    .modal-content .table tfoot { display: table-row-group !important; }
    .modal-header { border-bottom: 0; }
    .modal-lg { width: 100%; }
    .table-responsive .table th,
    .table-responsive .table td { display: table-cell; border-top: none !important; border-left: none !important; border-right: none !important; border-bottom: 1px solid #CCC !important; }
    a:after {
        display: none;
    }
    .print-table thead th:first-child, .print-table thead th:last-child, .print-table td:first-child, .print-table td:last-child {
        display: table-cell !important;
    }
    .fa-3x { font-size: 1.5em; }
    .border-right {
        border-right: 0 !important;
    }
    .table thead th { background: #F5F5F5 !important; background-color: #F5F5F5 !important; border-top: 1px solid #f5F5F5 !important; }
    .well { border-top: 0 !important; }
    .box-header { border: 0 !important; }
    .box-header h2 { display: block; border: 0 !important; }
    .order-table tfoot { display: table-footer-group !important; }
    .print-only { display: block !important; }
    .reports-table th, .reports-table td { display: table-cell !important; }
    table thead { display: table-header-group; }
    .white-text { color: #FFF !important;  text-shadow: 0 0 3px #FFF !important; -webkit-print-color-adjust: exact; }
    #bl .barcodes td { padding: 2px !important; }
    #bl .barcodes .bcimg { max-width: 100%; }
    #lp .labels { text-align:center;font-size:10pt;page-break-after:always;padding:1px; }
    #lp .labels img { max-width: 100%; }
    #lp .labels .name { font-size:0.8em; font-weight:bold; }
    #lp .labels .price { font-size:0.8em; font-weight:bold; }
    .well { border: none !important; box-shadow: none; }
    .table { margin-bottom: 20px !important;  }
}

/*Please modify the styles below for barcode/label printing */
.barcode { width: 8.45in; height: 10.3in; display: block; border: 1px solid #CCC; margin: 10px auto; padding-top: 0.1in; page-break-after:always; }
.barcode .item { display: block; overflow: hidden; text-align: center; border: 1px dotted #CCC; font-size: 12px; line-height: 14px; text-transform: uppercase; float: left; }
.style50 { font-size: 10px; line-height: 12px; margin: 0 auto; display: block; text-align: center; border: 1px dotted #CCC; font-size: 12px; line-height: 14px; text-transform: uppercase; page-break-after:always; }
.barcode .style30 { width: 2.625in; height: 1in; margin: 0 0.07in; padding-top: 0.05in; }
.barcode .style30:nth-child(3n+1) {  margin-left: 0.1in; }
.barcode .style20 { width: 4in; height: 1in; margin: 0 0.1in; padding-top: 0.05in; }
.barcode .style14 { width: 4in; height: 1.33in; margin: 0 0.1in; padding-top: 0.1in; }
.barcode .style10 { width: 4in; height: 2in; margin: 0 0.1in; padding-top: 0.1in; font-size: 14px; line-height: 20px; }
.barcode .barcode_site, .barcode .barcode_name, .barcode .barcode_image, .barcode .variants { display: block; }
.barcode .barcode_price, .barcode .barcode_unit, .barcode .barcode_category { display: inline-block; }
.barcode .product_image { width: 0.8in; float: left; margin: 5px; }
.barcode .style10 .product_image { width: 1in; }
.barcode .style30 .product_image { width: 0.5in; float: left; margin: 5px; }
.barcode .product_image img { max-width: 100%; }
.style50 .product_image, .style40 .product_image { display: none; }
.style50 .barcode_site, .style50 .barcode_name, .style50 .barcode_image, .style50 .barcode_price { display: block; }
.barcode .barcode_image img, .style50 .barcode_image img { max-width: 100%; }
.barcode .barcode_site { font-weight: bold; }
.barcode .barcode_site, .barcode .barcode_name { font-size: 14px; }
.barcode .style10 .barcode_site, .barcode .style10 .barcode_name { font-size: 16px; }

.barcodea4 { width: 8.25in; height: 11.6in; display: block; border: 1px solid #CCC; margin: 10px auto; padding: 0.1in 0 0 0.1in; page-break-after:always; }
.barcodea4 .item { display: block; overflow: hidden; text-align: center; border: 1px dotted #CCC; font-size: 12px; line-height: 14px; text-transform: uppercase; float: left; }
.barcodea4 .style40 { width: 1.799in; height: 1.003in; margin: 0 0.07in; padding-top: 0.05in; }
.barcodea4 .style24 { width: 2.48in; height: 1.335in; margin-left: 0.079in; padding-top: 0.05in; }
.barcodea4 .style18 { width: 2.5in; height: 1.835in; margin-left: 0.079in; padding-top: 0.05in; font-size: 13px; line-height: 20px; }
.barcodea4 .style12 { width: 2.5in; height: 2.834in; margin-left: 0.079in; padding-top: 0.05in; font-size: 14px; line-height: 20px; }
.barcodea4 .barcode_site, .barcodea4 .barcode_name, .barcodea4 .barcode_image, .barcodea4 .variants { display: block; }
.barcodea4 .barcode_price, .barcodea4 .barcode_unit, .barcodea4 .barcode_category { display: inline-block; }
.barcodea4 .product_image { width: 0.8in; float: left; margin: 5px; }
.barcodea4 .style12 .product_image { width: 100%; height:auto; max-height: 1.5in; display: block; }
.barcodea4 .style12 .product_image img { max-width: 100%; max-height: 100%; }
.barcodea4 .style24 .barcode_site, .barcodea4 .style24 .barcode_name { font-size: 14px; }
.barcodea4 .style18 .barcode_site, .barcodea4 .style18 .barcode_name { font-size: 14px; font-weight: bold; }
.barcodea4 .style12 .barcode_site, .barcodea4 .style12 .barcode_name { font-size: 15px; font-weight: bold; }

@media print {
    .tooltip, #sliding-ad { display: none !important; }
    .barcode, .barcodea4 { margin: 0; }
    .barcode, .barcode .item, .barcodea4, .barcodea4 .item, .style50, .div50 { border: none !important; }
    .div50, .modal-content { page-break-after:always; }
}

</style>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <form action="<?= base_url('supplies/barcode') ?>" method="POST">
        <!-- <div class="row search_tab" style="margin-bottom: 1%;">
            <label for="txt_search" class="col-md-2 textwhite"><?= $search = 'ค้นหา'; ?>:</label>
            <input type="text" id="txt_search" class="form-control col-md-12" placeholder="<?= $search ?>" autocomplete="">
   
            <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" />
        
            <input type="button" class="btn btn-warning" onclick="myFunction()" value="เพิ่มสินค้า" style="margin-left: 2%;" />
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
        </div> -->

        <div class="col-mb-12" style="margin-top: 1rem;">
            <div class="form-group">
                <div class="input-group wide-tip">
                    <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                        <i class="fa fa-2x fa-barcode addIcon"></i>
                    </div>
                    <input type="text" id="txt_search" class="form-control input-lg ui-autocomplete-input" placeholder="โปรดเพิ่มสินค้าในรายการ" autocomplete="">
                    <!-- <input type="button" class="btn btn-primary" name="search" id="bt_search" value="ค้นหา" style="margin-left: 2%;" /> -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>ชื่อสินค้า</th>
                                <th>คลังสินค้า</th>
                                <th>ชนิด</th>
                                <th>จำนวน</th>
                                <!-- <th>ซีเรียล นัมเบอร์</th> -->
                                <th>รหัสสินค้า</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($data) :
                                foreach ($data as $x) :
                            ?>
                                    <tr>
                                        <td class="textleft"><?php echo $x['name'] . " (" . $x['product_code'] . ")"; ?></td>
                                        <td><?php echo $x['category_name']; ?></td>
                                        <td><?php echo $x['unit_name']; ?></td>
                                        <td class="textnum"><?php echo number_format($x[''], 2); ?></td>
                                        <!-- <td><?php echo $x['product_code']; ?></td> -->
                                        <!-- <td><?php echo $x['responsible']; ?></td> -->
                                        <td><?php echo $x['product_code']; ?></td>
                                        <td><input type="button" class="btn btn-primary add_item" name="add_item" value="เพิ่ม" data-item=<?= $x['id']; ?> /></td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h3>รายการที่เพิ่ม</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>ชื่อสินค้า</th>
                                <th>คลังสินค้า</th>
                                <th>ชนิด</th>
                                <th>จำนวน</th>
                                <th>รหัสสินค้า</th>
                                <th>จำนวนที่พิมพ์</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody2">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- <div class="col-md-12">
            <label for="style">style<span style="color:red;"> *</span></label>
            <select class="form-control" name="account_category" id="account_category" required="">
                <option value="">เลือก style</option>
                <option value="40">40 per sheet</option>
                <option value="30">30 per sheet</option>
                <option value="24">24 per sheet</option>
                <option value="25">25 per sheet</option>
                <option value="18">18 per sheet</option>
                <option value="14">14 per sheet</option>
                <option value="12">12 per sheet</option>
                <option value="10">10 per sheet</option>
            </select>
        </div> -->
        <div class="col-md-12">
            <p style="margin-top: 14px;">barcode tip</p>
            <label for="style">พิมพ์:</label>
            <!-- <input type="checkbox" name="name1" value="1">
            <label for="name1">site name</label> -->
            <input type="checkbox" name="name2" value="1">
            <label for="name2">ชื่อสินค้า</label>
            <!-- <input type="checkbox" name="name3" value="1">
            <label for="name3">ราคา</label>
            <input type="checkbox" name="name4" value="1">
            <label for="name4">สกุลเงิน</label> -->
            <input type="checkbox" name="name5" value="1">
            <label for="name5">จำนวน</label>
            <input type="checkbox" name="name6" value="1">
            <label for="name6">ประเภท</label>
            <!-- <input type="checkbox" name="name7" value="1">
            <label for="name7">ประเภทที่หลากหลาย</label> -->
            <input type="checkbox" name="product_image" value="1">
            <label for="product_image">รูปภาพสินค้า</label>
            <!-- <input type="checkbox" name="name9" value="1">
            <label for="name9">check promo</label> -->
        </div>

        <input type="button" class="btn btn-primary" id="submit_print" value="ปริ้นท์" style="margin-left: 2%;" />
        <input type="button" class="btn btn-danger" id="reset" value="รีเซ็ต" style="margin-left: 2%;">

    </form>
</div>

<div id="preview" class="tabcontent barcodea4" style="padding-top: 0; display:block;">
    <!-- <div class="item style12">
        <span class="barcode_site">ERP</span>
        <span class="barcode_name">น้ำยาทำความสะอาด2</span>
        <span class="barcode_price">Price 140.00</span>
        <span class="barcode_image"><img src="http://narapos.com/Asset/admin/products/barcode/10476127/code128/50" alt="10476127" class="bcimg">
        </span>
    </div> -->
    <div class="row barcode_sheet2">
    </div>
</div>
<div class="col-md-12 text-center">
    <button type="button" onclick="window.print();return false;" class="btn btn-primary tip no-print" title="" data-original-title="Print"><i class="icon fa fa-print"></i> Print</button>
</div>

<!-- Modal -->
<div class="modal fade " id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">พิมพ์ Barcode/ Label</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="row">    
            <div class="col-sm-3">
                <select class="form-control" name="account_category" id="account_category" required="">
                    <option value="">รูปแบบ: A4</option>
                    <option value="">รูปแบบ: A3</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="account_category" id="account_category" required="">
                    <option value="">จำนวน: 16/ชิ้น</option>
                    <option value="">จำนวน: 14/ชิ้น</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="account_category" id="account_category" required="">
                    <option value="">แนวกระดาษ: แนวนอน</option>
                    <option value="">แนวกระดาษ: แนวตั้ง</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="account_category" id="account_category" required="">
                    <option value="">บาร์โค๊ด</option>
                </select>
            </div>
        </div>     -->
                <div class="row barcode_sheet">
                    <!-- <?php for ($i = 0; $i < 5; $i++) { ?>
                        <div class="col-sm-4">
                            <img src="https://image.shutterstock.com/image-vector/realistic-barcode-icon-isolated-modern-260nw-350980079.jpg" style="
                    width: 89px;
                    float: left;
                ">
                            <img src="https://upload.wikimedia.org/wikipedia/th/thumb/b/b5/Qrcode.png/220px-Qrcode.png" style="
                    width: 44px;
                    float: left;
                    margin-top: 3px;
                ">
                        </div>
                        <div class="col-sm-4">
                            <img src="https://image.shutterstock.com/image-vector/realistic-barcode-icon-isolated-modern-260nw-350980079.jpg" style="
                    width: 89px;
                    float: left;
                ">
                            <img src="https://upload.wikimedia.org/wikipedia/th/thumb/b/b5/Qrcode.png/220px-Qrcode.png" style="
                    width: 44px;
                    float: left;
                    margin-top: 3px;
                ">
                        </div>
                        <div class="col-sm-4">
                            <img src="https://image.shutterstock.com/image-vector/realistic-barcode-icon-isolated-modern-260nw-350980079.jpg" style="
                    width: 89px;
                    float: left;
                ">
                            <img src="https://upload.wikimedia.org/wikipedia/th/thumb/b/b5/Qrcode.png/220px-Qrcode.png" style="
                    width: 44px;
                    float: left;
                    margin-top: 3px;
                ">
                        </div>
                    <?php } ?> -->
                    <!-- <div class="col-sm-12">
                        <img src="<?= base_url('files/barcode_test.jpg') ?>" style="width: 100%;">
                    </div> -->
                    <?php for ($i = 0; $i <= 8; $i++) { ?>
                        <div class="col-sm-4">
                            <img src="https://barcode.tec-it.com/barcode.ashx?data=024585685&code=&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96" style="width: 100%;padding: 20px 30px;">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">ปริ้นท์บาร์โค๊ด</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ย้อนกลับ</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มรายการ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" style=" text-align: right; color: #007bff; margin-bottom: 12px; ">จำนวนคงเหลือ <span id="remain_print"></span> ต่อ 1 หน้ากระดาษ</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">จำนวน
                        </div>
                        <div class="col-sm-6">
                        <input type="number" id="quantity" class="form-control" placeholder="จำนวน">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary qty_submit">ตกลง</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ย้อนกลับ</button>
            </div>
        </div>
    </div>
</div>

<!-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>
    // function myFunction() {
    //     window.location = "/supplies/product";
    // }
    $(document).ready(function() {
        // var table = $('#dataTable').DataTable({
        //     columnDefs: [{
        //         'targets': 0,
        //         'searchable': false,
        //         'orderable': false,
        //         'className': 'dt-body-center',
        //         'render': checkbox
        //     }],
        //     lengthMenu: [
        //         [10, 25, 50, -1],
        //         [10, 25, 50, "All"],

        //     ],
        //     order: [
        //         [1, "asc"]
        //     ],
        //     responsive: true

        // });
        // $('#bt_search').on('click', function() {
        //     if (table.search() !== $("#txt_search").val()) {
        //         table
        //             .search($("#txt_search").val())
        //             .draw();
        //     }
        // });
        // $('#select-all').on('click', function() {
        //     var rows = table.rows({
        //         'search': 'applied'
        //     }).nodes();
        //     $('input[type="checkbox"]', rows).prop('checked', this.checked);
        // });

        // $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
        //     if (!this.checked) {
        //         var el = $('#select-all').get(0);
        //         if (el && el.checked && ('indeterminate' in el)) {
        //             el.indeterminate = true;
        //         }
        //     }
        // });

        var table = $('#dataTable').DataTable();
        $('#txt_search').on('keyup', function() {
            if (table.search() !== $("#txt_search").val()) {
                table
                    .search($("#txt_search").val())
                    .draw();
            }
        });

        var all_product = <?php echo json_encode($data); ?>;
        // console.log(all_product);
        var listItem2 = [];
        var quantityList = [];
        function findProductId(data_item = null,quantity = null,type = null){
            if(type == "remove"){
                // for (let key in quantityList) {
                for (let i = 0; i < quantityList.length; i++) {
                    // quantityList = quantityList.filter(function(item) {
                    //     return item !== data_item;
                    // });
                    if(data_item == quantityList[i][0]){
                        quantityList[i][0] = 0;
                    }
                }
                // console.log(quantityList);

                // listItem2 = [];
                for (let key in all_product) {
                    // let obj_data2 = all_product[key];
                    for(let key2 in listItem){
                        if(listItem[key2] == all_product[key].id){
                            all_product[key].quantity = quantity;
                            // console.log(all_product[key].test);
                            // listItem2.unshift(34);
                            // listItem2.push([all_product[key],quantity]);
                            listItem2.push(all_product[key]);
                        }
                    }
                }
                // console.log(listItem2);
                // console.log(quantityList);
                showListProduct();

            }else if(type == "add"){
                quantityList.push([data_item,quantity,type]);
                // listItem2 = [];
                // console.log(all_product);
                // console.log(listItem);
                for (let key in all_product) { //สินค้าทั้งหมด
                    // let obj_data2 = all_product[key];
                    // for(let key2 in listItem){
                        if(data_item == all_product[key].id){
                            all_product[key].quantity_print = quantity;
                            // console.log(all_product[key].test);
                            // listItem2.unshift(34);
                            // listItem2.push([all_product[key],quantity]);
                            listItem2.push(all_product[key]);
                        }
                    // }
                }
                // console.log(quantityList);
                // console.log(listItem2);
                showListProduct();
            }
            
        }
        function showListProduct(){
            var htmlTag = "";
            for (i = 0; i < listItem2.length; i++) {
                htmlTag += '<tr>\
                    <td class="textleft">' + listItem2[i].name + ' ('+ listItem2[i].product_code +')</td>\
                    <td>' + listItem2[i].category_name + '</td>\
                    <td>' + listItem2[i].unit_name + '</td>\
                    <td>\
                    </td>\
                    <td>'+ listItem2[i].product_code +'</td>\
                    <td>'+ listItem2[i].quantity_print +'</td>\
                    <td>\
                    <input type="button" class="btn btn-danger remove_item" name="remove_item" value="ลบ" data-item="' + listItem2[i].id + '" />\
                    </td>\
                </tr>';
            }
            $('#tbody2').html(htmlTag);
        }

        var listItem = [];
        var data_item;

        var total_print = 25;
        var remain_print = 0;

        $('.add_item').on('click', function() {
            data_item;
            data_item = $(this).data("item");
            const found = listItem.find(element => element == data_item);
            if (!found) {
                // listItem.push(data_item);
                // findProductId();

                total_print = 25;
                remain_print = 0;
                if(listItem2){
                    for(i = 0;i < listItem2.length;i++){
                        remain_print += parseInt(listItem2[i].quantity_print);
                    }
                }
                total_print = total_print - remain_print;
                $("#remain_print").text(total_print);

                $('#modal2').modal('show');
            } else {
                // $(".add_item").css("background", "red");
            }
        });
        $(document).on('click', '.remove_item', function() {
            var data_item = $(this).data("item");
            listItem = listItem.filter(function(item) {
                return item !== data_item;
            });
            // findProductId();
            findProductId(data_item,null,type = "remove");
        });

        $('.qty_submit').on('click', function() {
            listItem.push(data_item);
            var quantity = $("#quantity").val();
            if(quantity == 0){
                swal({
                    icon: 'info',
                    title: 'กรุณาเลือกจำนวน',
                });
                return false;
            }
            var chk_quantity = total_print-quantity;
            if(chk_quantity < 0){
                swal({
                    icon: 'info',
                    title: 'ไม่สามารถเพิ่มจำนวนได้ เหลือจำนวนที่เลือกได้ '+total_print+' จำนวน',
                });
                return false;
            }

            findProductId(data_item,quantity,type = "add");
            $('#modal2').modal('hide');
            $('#quantity').val('');
        });

        // $('#submit_print').on('click', function() {
        //     console.log(listItem2);
        //     var page_per_sheet = parseInt($('select[name=account_category] option').filter(':selected').val());
        //     if (!listItem2[0]) {
        //         swal({
        //             icon: 'info',
        //             title: 'กรุณาเลือกสินค้า',
        //         });
        //         return false;
        //     }
        //     if (!page_per_sheet) {
        //         alert("กรุณาเลือก Style");
        //         return false;
        //     }
        //     // $('#modal1').modal('show');
        //     var html_tag = "";
        //     // for(i = 0;i <= page_per_sheet;i++){
        //     //     html_tag += '<div class="col-sm-3">\
        //     //             <img src="https://barcode.tec-it.com/barcode.ashx?data='+listProductCode[0]+'&code=&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96" style="width: 100%;padding: 20px 30px 0px 30px;">\
        //     //             '+name2+'\
        //     //         </div>';
        //     // }
        //     for (i = 0; i < listItem2.length; i++) {
        //         for (x = 0; x < page_per_sheet; x++) {
        //             name2 = $('input[name=name2]:checked').is(':checked') ? name2 = '<p style="text-align: center;margin-bottom: 0px;clear: both;">ชื่อสินค้า: ' + listItem2[i].name + '</p>' : name2 = '';
        //             name5 = $('input[name=name5]:checked').is(':checked') ? name5 = '<p style="text-align: center;margin-bottom: 0px;">จำนวน: ' + listItem2[i].unit + '</p>' : name5 = '';
        //             category_name = $('input[name=name6]:checked').is(':checked') ? category_name = '<p style="text-align: center;margin-bottom: 0px;clear: both;">ประเภทสินค้า: ' + listItem2[i].category_name + '</p>' : category_name = '';
        //             product_image = $('input[name=product_image]:checked').is(':checked') ? product_image = '<img src="http://chapanakit.airtimes.co/files/' + listItem2[i].image1 + ' " style="width: 65%;padding: 20px 30px 0px 30px;">' : product_image = '';
        //             if(listItem2[i].image1 == "/" || listItem2[i].image1 == null){
        //                 product_image = $('input[name=product_image]:checked').is(':checked') ? product_image = '<img src="http://chapanakit.airtimes.co/files/noimages.png" style="width: 65%;padding: 20px 30px 0px 30px;">' : product_image = '';
        //             }
        //             // product_image = $('input[name=product_image]:checked').is(':checked') ? product_image = '<img src="http://chapanakit.airtimes.co/files/' + listProductImage[i] + ' " style="width: 65%;padding: 20px 30px 0px 30px;">' : product_image = '<img src="https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg" style="width: 65%;padding: 20px 30px 0px 30px;">';

        //             // html_tag += '<div class="col-sm-3">\
        //             //     <img src="https://barcode.tec-it.com/barcode.ashx?data=' + listProductCode[i] + '&code=&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96" style="width: 100%;padding: 20px 30px 0px 30px;">\
        //             //     ' + name2 + '\
        //             //     ' + name3 + '\
        //             // </div>';
        //             html_tag += '<div class="col-sm-4" style="padding: 5px 0px 20px 0px;margin: 9px 0;">\
        //                 <div class="col-sm-12">\
        //                     <div class="col-sm-4" style="float:left;padding: 0px 14px 0px 0px;">\
        //                         <img src="https://barcode.tec-it.com/barcode.ashx?data=http%3A%2F%2Fchapanakit.airtimes.co%2Fsupplies%2Fview_product%2F' + listItem2[i].product_code + '&code=MobileQRPhone&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=Default&qunit=Mm&quiet=0&eclevel=L" style="width: 100%;">\
        //                     </div>\
        //                     <div class="col-sm-8" style="float:right;">\
        //                         <img src="https://barcode.tec-it.com/barcode.ashx?data=' + listItem2[i].product_code + '&code=Code128&translate-esc=on" style="width: 100%;">\
        //                     </div>\
        //                 </div>\
        //                 <div class="text-center">\
        //                     ' + product_image + '\
        //                 </div>\
        //                     ' + name2 + '\
        //                     ' + name5 + '\
        //                     ' + category_name + '\
        //             </div>';
        //         }
        //     }
        //     // for(i = 0;i < listItem.length;i++){
        //     //     name2 = $('input[name=name2]:checked').is(':checked') ? name2 = '<p style="text-align: center;margin-bottom: 0px;">ชื่อสินค้า '+listNameItem[i]+'</p>' : name2 = '';
        //     //     name3 = $('input[name=name3]:checked').is(':checked') ? name3 = '<p style="text-align: center;margin-bottom: 0px;">ราคา '+formatNumber(listProductPrice[i])+'</p>' : name3 = '';

        //     //     html_tag += '<div class="col-sm-3">\
        //     //             <img src="https://barcode.tec-it.com/barcode.ashx?data='+listProductCode[i]+'&code=&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96" style="width: 100%;padding: 20px 30px 0px 30px;">\
        //     //             '+name2+'\
        //     //             '+name3+'\
        //     //         </div>';
        //     // }
        //     // $(".barcode_sheet").html(html_tag);
        //     $(".barcode_sheet2").html(html_tag);
        // });
        $('#submit_print').on('click', function() {
            console.log(listItem2);
            // var page_per_sheet = parseInt($('select[name=account_category] option').filter(':selected').val());
            if (!listItem2[0]) {
                swal({
                    icon: 'info',
                    title: 'กรุณาเลือกสินค้า',
                });
                return false;
            }
            var html_tag = "";
            for (i = 0; i < listItem2.length; i++) {
                // for (x = 0; x < page_per_sheet; x++) {
                for (x = 0; x < listItem2[i].quantity_print; x++) {
                    name2 = $('input[name=name2]:checked').is(':checked') ? name2 = '<p style="text-align: center;margin-bottom: 0px;clear: both;">ชื่อสินค้า: ' + listItem2[i].name + '</p>' : name2 = '';
                    name5 = $('input[name=name5]:checked').is(':checked') ? name5 = '<p style="text-align: center;margin-bottom: 0px;">จำนวน: ' + listItem2[i].unit + '</p>' : name5 = '';
                    category_name = $('input[name=name6]:checked').is(':checked') ? category_name = '<p style="text-align: center;margin-bottom: 0px;clear: both;">ประเภทสินค้า: ' + listItem2[i].category_name + '</p>' : category_name = '';
                    product_image = $('input[name=product_image]:checked').is(':checked') ? product_image = '<img src="http://chapanakit.airtimes.co/files/' + listItem2[i].image1 + ' " style="width: 65%;padding: 20px 30px 0px 30px;">' : product_image = '';
                    if(listItem2[i].image1 == "/" || listItem2[i].image1 == null){
                        product_image = $('input[name=product_image]:checked').is(':checked') ? product_image = '<img src="http://chapanakit.airtimes.co/files/noimages.png" style="width: 65%;padding: 20px 30px 0px 30px;">' : product_image = '';
                    }
                    html_tag += '<div class="col-sm-4" style="padding: 5px 0px 20px 0px;margin: 9px 0;">\
                        <div class="col-sm-12">\
                            <div class="col-sm-4" style="float:left;padding: 0px 14px 0px 0px;">\
                                <img src="https://barcode.tec-it.com/barcode.ashx?data=http%3A%2F%2Fchapanakit.airtimes.co%2Fsupplies%2Fview_product%2F' + listItem2[i].product_code + '&code=MobileQRPhone&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=Default&qunit=Mm&quiet=0&eclevel=L" style="width: 100%;">\
                            </div>\
                            <div class="col-sm-8" style="float:right;">\
                                <img src="https://barcode.tec-it.com/barcode.ashx?data=' + listItem2[i].product_code + '&code=Code128&translate-esc=on" style="width: 100%;">\
                            </div>\
                        </div>\
                        <div class="text-center">\
                            ' + product_image + '\
                        </div>\
                            ' + name2 + '\
                            ' + name5 + '\
                            ' + category_name + '\
                    </div>';
                // }
                }
            }
            $(".barcode_sheet2").html(html_tag);
        });
        
        $('#reset').on('click', function() {
            location.reload();
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
    });

    // $( function() {
    //     var availableTags = [
    //         "ชั้น",
    //         "เก้าอี้",
    //         "เทส2",
    //         "table"
    //     ];
    //     $( "#txt_search" ).autocomplete({
    //         source: availableTags
    //     });
    // });
</script>