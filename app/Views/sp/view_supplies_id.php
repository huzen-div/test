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
                        <?php
                        $ar = [
                            '0' => '',
                            '1' => 'active',
                            '2' => 'inactive',
                            '3' => 'other',
                        ];
                        foreach ($data as $x) :
                            
                            $vat = 0;
                            $total = 0;
                            if ($x['type'] == '1') {
                                $vat = $x['tax_rate'];
                            } elseif ($x['type'] == '2') {
                                $vat = ($x['price'] * $x['tax_rate']) / 100;
                            }
                            $total = $vat + $x['price'];
                        ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสาร :</td>
                                <td><?php echo $x['supplies_supplies']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขพัสดุ :</td>
                                <td><?php echo $x['product_code']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อสินค้า :</td>
                                <td><?php echo $x['name']; ?></td>
                            </tr>
                            <tr>
                                <td>ผู้ดำเนินการ :</td>
                                <td><?php echo $x['responsible']; ?></td>
                            </tr>
                            <tr>
                                <td>หน่วยนับ :</td>
                                <td><?php echo $x['unit_name']; ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงิน(บาท) :</td>
                                <td><?php echo $x['price']; ?></td>
                            </tr>
                            <tr>
                                <td>ภาษี7%(VAT) :</td>
                                <td> <?php echo $vat; ?> </td>
                            </tr>
                            <tr>
                                <td>จำนวนทั้งสิ้น(บาท) :</td>
                                <td> <?php echo $total; ?> </td>
                            </tr>
                            <tr>
                                <td>วันที่ :</td>
                                <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
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