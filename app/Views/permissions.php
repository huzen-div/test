<div class="tab">
    <button class="tablinks" onclick="openCity(event, '1')" id="1_tab">กลุ่มสิทธิ์</button>
    <button class="tablinks" onclick="openCity(event, '2')">รายชื่อผู้ใช้งาน</button>
</div>
<div id="1" class="tabcontent" style="padding-top: 0; ">
    <div class="row search_tab" style="margin-bottom: 1%;">
        <input type="button" class="btn btn-warning" onclick="add_group()" value="เพิ่มกลุ่ม<?= $title ?>" style="margin-left: 2%;" />
    </div>
    <table class="table display nowrap" id="dataTable1" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th width="10%">ลำดับ</th>
                <th>แผนก</th>
                <th width="15%">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($group) : ?>
                <?php foreach ($group as $x) : ?>
                    <tr>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $x['group_name']; ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <!-- <a class="dropdown-item" href="<?= base_url('permissions/view_group') . '/' . $x['id'] ?>">รายละเอียด</a> -->
                                    <a class="dropdown-item" href="<?= base_url('permissions/edit_group') . '/' . $x['id'] ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?= base_url('permissions/delete_group') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div id="2" class="tabcontent" style="padding-top: 0; ">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <table class="table display nowrap" id="dataTable2" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ-นามสกุล</th>
                <th>ตำแหน่ง</th>
                <th>ฝ่าย</th>
                <th>วันเดือนปีที่เพิ่ม</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($user) : ?>
                <?php foreach ($user as $x) : ?>
                    <tr>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $x['record_type']; ?></td>
                        <td><?php echo $x['id']; ?></td>
                        <td><?php echo $x['id']; ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    การจัดการ
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <!-- <a class="dropdown-item" href="<?= base_url('permissions/view_user') . '/' . $x['id'] ?>">แสดงรายละเอียด</a> -->
                                    <a class="dropdown-item" href="<?= base_url('permissions/edit_user') . '/' . $x['id'] ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?= base_url('permissions/delete_user') . '/' . $x['id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">ลบ</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    function add_group() {
        window.location = "/permissions/add_group";
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
        $("#1_tab").addClass("active");
        $("#1").css("display", "block");
        var table1 = $('#dataTable1').DataTable({
            scrollX: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

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
            // scrollX: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],

            ],
            order: [
                [0, "asc"]
            ],
        });
        $('#txt_search2').on('keyup change', function() {
            var text = $('#txt_search2').val();

            table2.search(text).draw();
        });
    });
</script>