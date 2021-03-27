<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">
        <center><?= $title ?></center>
    </h4>
</div>
<form method="post" action="<?= base_url('supplies/print_barcode').'/'.$id; ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label for="num">จำนวน Barcode</label>
                <input type="number" id="num" class="form-control" name="num" value="<?= $_POST['num'] ? $_POST['num'] : 0 ?>" required />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"> พิมพ์ Barcode</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> ปิดหน้าต่าง</button>
    </div>
</form>