<div class="table-responsive">
    <table class="table table-borderless table-striped dfTable table-right-left">
        <tbody>
            <?php foreach ($data as $x) : ?>
                <tr>
                    <td>ลำดับ :</td>
                    <td><?php echo $x['id']; ?></td>
                </tr>
                <tr>
                    <td>ชื่อ :</td>
                    <td><?php echo $x['name']; ?></td>
                </tr>
                <tr>
                    <td>โทรศัพท์ :</td>
                    <td><?php echo $x['tel']; ?></td>
                </tr>
                <tr>
                    <td>อีเมลล์ :</td>
                    <td><?php echo $x['email']; ?></td>
                </tr>
                <tr>
                    <td>ที่อยู่ :</td>
                    <td> <?php echo $x['address']; ?> </td>
                </tr>
                <tr>
                    <td>แผนที่ :</td>
                    <td style="width: 150px;">
                        <?php if ($x['map'] != null) { ?>
                            <a title="<?php echo $x['name']; ?>" href="<?= base_url('files') . '/' . $x['map'] ?>" target="_blank">
                                <img src="<?= base_url('files') . '/' . $x['map'] ?>" alt="image" class="imgdeb_pre">
                            </a>
                        <?php } else { ?>
                            <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" class="imgdeb_pre">

                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-12" style="text-align: center;">
    <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" />
</div>