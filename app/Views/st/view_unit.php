<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>รหัสหน่วยนับ :</td>
                    <td><?php echo $x['unit_code']; ?></td>
                </tr>
                <tr>
                    <td>ชื่อหน่วยนับ :</td>
                    <td><?php echo $x['unit_name']; ?></td>
                </tr>
                <!-- <tr>
                    <td>หน่วยมูลฐาน :</td>
                    <td><?php echo $x['unit_base']; ?></td>
                </tr>
                <tr>
                    <td>ตัวดำเนินการ :</td>
                    <td> <?php echo $x['operater']; ?> </td>
                </tr>
                <tr>
                    <td>การดำเนินการ :</td>
                    <td> <?php echo $x['operater_value']; ?> </td>
                </tr> -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>