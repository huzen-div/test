<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : 
                
                $ar = [
                    '0' => '',
                    '1' => 'ประจำ',
                    '2' => 'เปอร์เซ็นต์',
                ];?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ชื่อ :</td>
                    <td><?php echo $x['name']; ?></td>
                </tr>
                <tr>
                    <td>Code :</td>
                    <td><?php echo $x['code']; ?></td>
                </tr>
                <tr>
                    <td>อัตราภาษี :</td>
                    <td><?php echo number_format($x['tax_rate'], 2); ?></td>
                </tr>
                <tr>
                    <td>ประเภท :</td>
                    <td>
                        <?php echo $ar[$x['type']]; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>