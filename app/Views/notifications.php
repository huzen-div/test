<div class="tab">
    <button class="tablinks" onclick="openCity(event, '1')" id="1_tab">แจ้งเตือนพัสดุที่เลยกำหนดคืน</button>
    <!-- <button class="tablinks" onclick="openCity(event, '2')">แทบ2</button> -->
</div>

<div id="1" class="tabcontent" style="padding-top: 0; ">

    <div class="row search_tab" style="margin-bottom: 1%;">
        <label id="date-label-from" class="col-md-1 textwhite" for="txt_search6">ค้นหา </label>
        <input type="text" id="txt_search1" autocomplete="off" class=" form-control col-md-2" name="txt_search6">
    </div>
    <!-- <?php foreach ($borrow as $x) : ?>
        <div>
            <div class="not_data" data-id_borrow="<?= $x["id"] ?>">
                <div class="row">
                    <div class="col-md-1">
                        <img style="width: 40px;margin-left: 14px;margin-top: 7px;" src="//www.pinclipart.com/picdir/big/337-3377481_general-cargo-think-outside-the-box-icon-clipart.png">
                    </div>
                    <div class="col-md-10">
                        <h3 class="not_h3_sub">พัสดุที่เลยกำหนดคืนของ <?= $x["employees_id"] ?></h3>
                        <p class="not_h3_content">วันที่ที่ต้องคืน <?= $x["date_return"] ?></p>
                    </div>
                    <div class="col-md-1" style="padding-top: 13px; padding-left: 20px;">
                        <span data-data_del_noti='<?= $x["id"] ?>' class="delete_noti"><i class="fas fa-trash-alt" style="text-align:center;"></i></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?> -->

    <table class="table display nowrap" id="dataTable1" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>รายละเอียด</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($borrow) : ?>
                <?php foreach ($borrow as $x) : 
                    $read_style = "#ebeff3;";
                    $read_style_head = "font-weight: bold !important;";
                    if($x['id_noti_fk_read'] != null){
                        $read_style = "#fff;";
                        $read_style_head = "font-weight: 400 !important;";
                    }
                ?>
                    <tr style="background:<?=$read_style;?>">
                        <!-- <td href="<?= base_url('supplies/view_borrow_id') . '/' . $x['id'] ?>" data-toggle="modal" data-remote="false" data-target="#myModal" class="textleft"> -->
                        <td class="td_ac textleft" data-id_noti="<?=$x['id'];?>" data-type_noti="<?=$x['type_noti'];?>">
                            <div class="row">
                                <div class="col-md-1">
                                    <img style="width: 40px;margin-left: 14px;margin-top: 7px;" src="//www.pinclipart.com/picdir/big/337-3377481_general-cargo-think-outside-the-box-icon-clipart.png">
                                </div>
                                <div class="col-md-11">
                                    <h3 class="not_h3_sub" style="<?=$read_style_head;?>">พัสดุที่เลยกำหนดคืนของ <?= $x["employees_id"] ?></h3>
                                    <p class="not_h3_content">วันที่ที่ต้องคืน <?= $x["date_return"] ?></p>
                                </div>
                            </div>
                        </td>
                        <td width="10%"> <span data-data_del_noti='<?= $x["id"] ?>' data-type_noti="<?=$x['type_noti'];?>" class="delete_noti"><i class="fas fa-trash-alt" style="text-align:center;"></i></span> </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div id="2" class="tabcontent" style="padding-top: 0;">
    <div class="row search_tab" style="margin-bottom: 1%;">
        <label id="date-label-from" class="col-md-1 textwhite" for="txt_search6">ค้นหา </label>
        <input type="text" id="txt_search2" autocomplete="off" class=" form-control col-md-2" name="txt_search6">
    </div>
</div>

<script>
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
        $("#1_tab").addClass("active");
        $("#1").css("display", "block");
        var table1 = $('#dataTable1').DataTable({
            scrollX: true,
            lengthMenu: [
                [-1, 10, 25, 50],
                ["All", 10, 25, 50],

            ],
            order: [
                [0, "asc"]
            ],
        });
        $('#txt_search1').on('keyup change', function() {
            var text = $('#txt_search1').val();
            table1.search(text).draw();
        });
        var table2 = $('#dataTable2').DataTable({
            scrollX: true,
            lengthMenu: [
                [-1, 10, 25, 50],
                ["All", 10, 25, 50],

            ],
            order: [
                [0, "asc"]
            ],
        });
        $('#txt_search2').on('keyup change', function() {
            var text = $('#txt_search1').val();
            table2.search(text).draw();
        });


        $('.td_ac').click(function() {
            var id_noti = $(this).data("id_noti");
            var type_noti = $(this).data("type_noti");
            // var jsonString = JSON.stringify(id_product_all);
            $.ajax({
                url: "/notifications/create_read",
                type: "POST",
                dataType: "json",
                data: {
                    "id_noti": id_noti,
                    "type": type_noti
                },
                success: function(data) {
                }
            });
            window.location.href = window.location.origin+"/supplies/view_borrow/"+id_noti;
        });

        $('.delete_noti').click(function() {
            var id_noti = $(this).data("data_del_noti");
            var type_noti = $(this).data("type_noti");
            $.ajax({
                url: "/notifications/create_hide",
                type: "POST",
                dataType: "json",
                data: {
                    "id_noti": id_noti,
                    "type": type_noti
                },
                success: function(data) {
                    // response(data);
                }
            });
            location.reload();
        });


    });
</script>