<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>รายการ :</td>
                    <td><?php echo $x['main_item']; ?></td>
                </tr>
                <!-- <tr>
                    <td>วันที่ :</td>
                    <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                </tr> -->
                <tr>
                    <td>ได้รับจัดสรรปี :</td>
                    <td><?php echo $x['allocate_year']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินได้รับจัดสรร :</td>
                    <td><?php echo $x['allocate_year_amount']; ?></td>
                </tr>
                <tr>
                    <td>คำขอตั้งปี :</td>
                    <td><?php echo $x['request_year']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินคำขอตั้ง :</td>
                    <td><?php echo $x['request_year_amount']; ?></td>
                </tr>
                <tr>
                    <td>ประมาณการจ่านล่วงหน้า ปี :</td>
                    <td><?php echo $x['estimate_year1']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินประมาณการจ่านล่วงหน้า :</td>
                    <td><?php echo $x['estimate_year1_amount']; ?></td>
                </tr>
                <tr>
                    <td>ประมาณการจ่านล่วงหน้า ปี :</td>
                    <td><?php echo $x['estimate_year2']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินประมาณการจ่านล่วงหน้า :</td>
                    <td><?php echo $x['estimate_year2_amount']; ?></td>
                </tr>
                <tr>
                    <td>ประมาณการจ่านล่วงหน้า ปี :</td>
                    <td><?php echo $x['estimate_year3']; ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินประมาณการจ่านล่วงหน้า :</td>
                    <td><?php echo $x['estimate_year3_amount']; ?></td>
                </tr>
                <?php if ($x['document'] != null) { ?>
                    <tr>
                        <td>แนบเอกสาร</td>
                        <td><a href="<?php echo base_url('files/cost_estimate_files') . '/' . $x['document']; ?>">ไฟล์</a> </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>ระบุคำชี้แจงและเหตุผลความจำเป็น :</td>
                    <td><?php echo $x['note']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />

</div>