<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php 
            foreach ($data as $x) :
            ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ชื่อหมวดหมู่หลัก :</td>
                    <td><?php echo $x['category_name']; ?></td>
                </tr>
                <?php if ($x['category_sub'] != 0) { ?>
                    <tr>
                        <td>ชื่อหมวดหมู่ย่อย :</td>
                        <td>
                            <?php echo $category_sub[0]['category_name']; ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>รายละเอียด :</td>
                    <td><?php echo $x['detail']; ?></td>
                </tr>
                <tr>
                    <td>รูปภาพ :</td>
                    <td><img src="<?= base_url('files') . '/' . $x['image'] ?>" alt="image" class="imgdeb"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>