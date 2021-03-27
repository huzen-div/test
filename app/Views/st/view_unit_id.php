<div class="modal-header">
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>-->
    <h4 class="modal-title" id="myModalLabel">
        <center><?= $title ?></center>
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
</div>