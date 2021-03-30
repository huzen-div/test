<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php $ar = ['1' => 'Full', '2' => 'บางส่วน']; foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
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
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>