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
                        <?php $ar = ['1' => 'Full', '2' => 'บางส่วน'];
                        foreach ($data as $x) : ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $no; ?></td>
                            </tr>
                            <tr>
                                <td>คลังสินค้า :</td>
                                <td><?php echo $x['warehouse_name']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            </tr>
                            <tr>
                                <td>เลขอ้างอิง :</td>
                                <td><?php echo $x['reference']; ?></td>
                            </tr>
                            <tr>
                                <td>ชนิด :</td>
                                <td> <?php echo $ar[$x['type']]; ?> </td>
                            </tr>
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