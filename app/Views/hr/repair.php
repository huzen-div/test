<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('hire/repair') ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="no">ที่ สธ </label>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <input type="number" id="no1" class="form-control" name="no1" value="<?= $_POST['no1'] ? $_POST['no1'] : '' ?>" required style="float:left;" />
                    </div>
                    <div class="col-md-1">
                        <h4>/</h4>
                    </div>
                    <!-- <h4 style="float:left;">/</h4> -->
                    <div class="col-md-6">
                        <input type="number" id="no2" class="form-control" name="no2" value="<?= $_POST['no2'] ? $_POST['no2'] : '' ?>" required style="float:left;" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="date">วันที่</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $_POST['date'] ? $_POST['date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="responsible_id">ผ่านหัวหน้าฝ่าย</label>
                <input type="text" id="responsible_id" class="form-control" name="responsible_id" value="<?= $_POST['responsible_id'] ? $_POST['responsible_id'] : '' ?>" required />
            </div>
            <div class="col-md-2">
                <label for="gender">คำนำหน้า ข้าพเจ้า</label><br>
                <!-- <input type="text" id="gender" class="form-control" name="gender" value="<?= $_POST['gender'] ? $_POST['gender'] : '' ?>" required/> -->
                <input type="radio" id="male" name="gender" value="1" required>
                <label for="male">นาย</label>
                <input type="radio" id="female" name="gender" value="2">
                <label for="female">นาง</label>
                <input type="radio" id="Other" name="gender" value="3">
                <label for="Other">นางสาว</label>
            </div>
            <div class="col-md-4">
                <label for="fullname">ชื่อ</label>
                <input type="text" id="fullname" class="form-control col-md-12" name="fullname" value="<?= $_POST['fullname'] ? $_POST['fullname'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="group">ฝ่าย</label>
                <input type="text" id="group" class="form-control col-md-12" name="group" value="<?= $_POST['group'] ? $_POST['group'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="request">มีความประสงค์จะขอแจ้งซ่อม</label>
                <input type="text" id="request" class="form-control" name="request" value="<?= $_POST['request'] ? $_POST['request'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="since">เนื่องจาก</label>
                <input type="text" id="since" class="form-control" name="since" value="<?= $_POST['since'] ? $_POST['since'] : '' ?>" required>
            </div>
            <!-- </div>
        <div class="row" style="margin-bottom: 1%;"> -->
            <div class="col-md-6">
                <label for="number">เลขที่ครุภัณฑ์</label>
                <!-- <input type="text" id="number" class="form-control" name="number" value="<?= $_POST['number'] ? $_POST['number'] : '' ?>" required> -->
                <select class="form-control select2" name="number" id="number" required>
                    <option selected value="">เลือกเลขที่ครุภัณฑ์</option>
                    <?php foreach ($product as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $_POST['number'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="officer">เจ้าหน้าที่ผู้รับเรื่อง</label>
                <input type="text" id="officer" class="form-control" name="officer" value="<?= $_POST['officer'] ? $_POST['officer'] : '' ?>" />
            </div>
            <div class="col-md-6">
                <label for="date_completion">วันที่แล้วเสร็จ</label>
                <input type="text" id="date_completion" class="datetimepicker2 form-control" name="date_completion" value="<?= $_POST['date_completion'] ? $_POST['date_completion'] : '' ?>">
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">รายละเอียด/หมายเหตุ</label>
                <textarea class="form-control" rows="3" name="note" id="note"><?= $_POST['note'] ?? $_POST['note']  ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="status">สถานะ</label>
            </div>
            <div class="col-md-11">
                <div class="row">
                    <input type="radio" class="status" id="1" name="status" value="1" required>
                    <label for="1">ดำเนินการซ่อมเรียบร้อยสามารถใช้งานได้ปกติ</label>
                </div>
                <div class="row">
                    <input type="radio" class="status" id="2" name="status" value="2" required>
                    <label for="2">ไม่สามารถซ่อมได้เนื่องจาก</label>
                    <input type="text" id="reason" class="form-control col-md-3" style="margin-left:1%;" name="reason" value="<?= $_POST['reason'] ? $_POST['reason'] : '' ?>" readonly>
                </div>
            </div>
        </div>
        <hr>
        <h3>ส่วนงานพัสดุ</h3>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-3">
                <label for="to">เรียน</label>
                <input type="text" id="to" class="form-control" name="to" value="<?= $_POST['to'] ? $_POST['to'] : '' ?>" required />
                <p>งานพัสดุขอนุมัติซ่อมครุภัณฑ์ ตามรายการดังต่อไปนี้</p>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <!-- <div class="col-md-12">
                <label for="search">ค้นหาพัสดุ</label>
                <input type="text" id="search" class="form-control" name="search" value="<?= $_POST['search'] ? $_POST['search'] : '' ?>">
                Selected user id : <input type="text" id="test" value='0'>
            </div> -->
            <!-- <div class="ui-widget">
                <label for="city">Your city: </label>
                <input id="city">
                Powered by <a href="http://geonames.org">geonames.org</a>
            </div>

            <div class="ui-widget" style="margin-top:2em; font-family:Arial">
                Result:
                <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
            </div> -->
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="search">ค้นหาพัสดุ</label>
                <input type="text" id="search" class="form-control" name="search" value="<?= $_POST['search'] ? $_POST['search'] : '' ?>">
                <!-- <div id="result_search" style="
                    width: 50%;
                    background: #efefef;
                    position: absolute;
                    z-index: 1;
                    border-radius: 2px;
                ">
                    <p style="
                    background: #c1c1c1;
                    padding: 8px;
                    border-radius: 6px;
                    margin-bottom: 1px;
                ">Lorem Ipsum</p>
                </div> -->
                <!-- Selected user id : <input type="text" id="test" value='0'> -->
            </div>
        </div>
    </form>

    <div class="card mb-4 main-dataTable" style="display:none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- <th>
                                    <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                                </th> -->
                            <th align="center">ลำดับ</th>
                            <th align="center">ที่ สธ </th>
                            <th align="center">วันที่ </th>
                            <th align="center">ผ่านหัวหน้าฝ่าย </th>
                            <th align="center">คำนำหน้า</th>
                            <th align="center">ฝ่าย </th>
                            <th align="center">ความประสงค์แจ้งซ่อม </th>
                            <th align="center">เนื่องจาก </th>
                            <th align="center">เลขที่ครุภัณฑ์ </th>
                            <th align="center">รายละเอียด/หมายเหตุ </th>
                            <th align="center">สถานะ </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($repair_new) {
                            foreach ($repair_new as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['id_cus'] ?></td>
                                    <td><?= $value['date'] ?></td>
                                    <td><?= $value['responsible'] ?></td>
                                    <td><?= $value['gender'] ?></td>
                                    <td><?= $value['group'] ?></td>
                                    <td><?= $value['request'] ?></td>
                                    <td><?= $value['since'] ?></td>
                                    <td><?= $value['number'] ?></td>
                                    <td><?= $value['note'] ?></td>
                                    <td><?= $value['status'] ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<script>
    // function setInputFilter(textbox, inputFilter) {
    //     ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    //         textbox.addEventListener(event, function() {
    //             if (inputFilter(this.value)) {
    //                 this.oldValue = this.value;
    //                 this.oldSelectionStart = this.selectionStart;
    //                 this.oldSelectionEnd = this.selectionEnd;
    //             } else if (this.hasOwnProperty("oldValue")) {
    //                 this.value = this.oldValue;
    //                 this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
    //             } else {
    //                 this.value = "";
    //             }
    //         });
    //     });
    // }
    // setInputFilter(document.getElementById("number"), function(value) {
    //     return /^-?\d*$/.test(value);
    // })    ;
    $(function() {
        var table = $('#dataTable').DataTable({
            columnDefs: [{
                // 'targets': 0,
                // 'searchable': false,
                // 'orderable': false,
                // 'className': 'dt-body-center',
                // 'render': checkbox
            }],
        });
        $('#search').on('keyup', function() {
            if (table.search() !== $("#search").val()) {
                table.search($("#search").val()).draw();
                $(".main-dataTable").css("display", "block");
            }
            if ($("#search").val() == "") {
                $(".main-dataTable").css("display", "none");
            }
        });

        function log(message) {
            $("<div>").text(message).prependTo("#log");
            $("#log").scrollTop(0);
        }

        $("#city").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "http://gd.geobytes.com/AutoCompleteCity",
                    dataType: "jsonp",
                    data: {
                        q: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                log(ui.item ?
                    "Selected: " + ui.item.label :
                    "Nothing selected, input was " + this.value);
            },
            open: function() {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function() {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });
    });
    $(document).ready(function() {
        $("#status").on("click", function() {
            $("#supervisory_account").prop('required', false);
        });
        // console.log(x "<?= base_url() ?>/hire/getProduct");
        // console.log(base_url+'/hire/getProduct') ;
        // $("#search").autocomplete({
        //     source: "<?php echo base_url('hire/getProduct'); ?>",
        // });
        // Initialize 
        // $("#search").autocomplete({
        //     source: function(request, response) {
        //         // Fetch data
        //         $.ajax({
        //             url: "<?php echo base_url('hire/getProduct'); ?>",
        //             type: 'post',
        //             dataType: "json",
        //             data: {
        //                 search: request.term
        //             },
        //             success: function(data) {
        //                 response(data);
        //             }
        //         });
        //     },
        //     select: function(event, ui) {
        //         // Set selection
        //         $('#search').val(ui.item.label); // display the selected text
        //         $('#test').val(ui.item.value); // save selected id to input
        //         return false;
        //     }
        // });
        var countries = [{
                value: 'Andorra',
                data: 'AD'
            },
            {
                value: 'Zimbabwe',
                data: 'ZZ'
            }
        ];
        $('#search').autocomplete({
            // lookup: countries,
            lookup: base_url + "hire/getProduct",
            onSelect: function(suggestion) {
                alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });
        $('.status').change(function() {

            if ($(this).val() == 1) {
                $("#reason").prop('required', false);
                $("#reason").prop('readonly', true);

            } else if ($(this).val() == 2) {
                $("#reason").prop('required', true);
                $("#reason").prop('readonly', false);

            }
            // console.log($(this).val());
        });
    });
</script>