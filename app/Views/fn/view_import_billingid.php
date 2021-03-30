<div class="modal-header">
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
                            'NET' => 'ATM',
                            'CSH' => 'เคาท์เตอร์'
                        ];
                        $bk = [
                            '0' => '',
                            '1' => '',
                            '2' => '',
                            '3' => '',
                            '4' => '',
                            '5' => '',
                            '6' => 'ธนาคารกรุงไทย',
                        ];
                        foreach ($data as $x) : ?>
                            <tr>
                                <td>ลำดับ :</td>
                                <td><?php echo $x['id']; ?></td>
                            </tr>
                            <tr>
                                <td>Record Type :</td>
                                <td><?php echo $x['record_type']; ?></td>
                            </tr>
                            <tr>
                                <td>Sequence No. :</td>
                                <td>
                                    <?php echo $x['sequence_no']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>ชื่อธนาคาร :</td>
                                <td><?php echo $bk[$x['bank_code']]; ?></td>
                            </tr>
                            <tr>
                                <td>Company Account :</td>
                                <td><?php echo $x['company_account']; ?></td>
                            </tr>
                            <tr>
                                <td>วันที่ชำระ :</td>
                                <td> <?php echo date('d/m/Y', strtotime($x['payment_date'])) . '.'; ?></td>
                            </tr>
                            <tr>
                                <td>เวลาที่ชำระ :</td>
                                <td><?php echo $x['payment_time']; ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อลูกค้า :</td>
                                <td><?php echo $x['customer_name']; ?></td>
                            </tr>
                            <tr>
                                <td>เลขบัตรประชาชน :</td>
                                <td><?php echo $x['customer_ref1']; ?></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร :</td>
                                <td><?php echo '0' . $x['customer_ref2']; ?></td>
                            </tr>
                            <tr>
                                <td>Reg 3 :</td>
                                <td><?php echo $x['customer_ref3']; ?></td>
                            </tr>
                            <tr>
                                <td>Branch No. :</td>
                                <td><?php echo $x['branch_no']; ?></td>
                            </tr>
                            <tr>
                                <td>Teller No. :</td>
                                <td><?php echo $x['teller_no']; ?></td>
                            </tr>
                            <tr>
                                <td>Kind of Transaction :</td>
                                <td><?php echo $x['kind_of_transaction']; ?></td>
                            </tr>
                            <tr>
                                <td>ช่องทางการชำระ :</td>
                                <td><?php echo $ar[$x['transaction_code']]; ?></td>
                            </tr>
                            <tr>
                                <td>Cheque No. :</td>
                                <td><?php echo $x['cheque_no']; ?></td>
                            </tr>
                            <tr>
                                <td>จำนวนเงิน :</td>
                                <td><?php echo number_format($x['amount'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>Cheque Bank Code :</td>
                                <td><?php echo $x['cheque_bank_code']; ?></td>
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