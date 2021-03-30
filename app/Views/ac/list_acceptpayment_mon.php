<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 0;">
        <label id="search-label-from" class="col-md-1 textwhite">รหัสสินทรัพย์:</label><input class="form-control col-md-4" type="text" id="search" />
        <div class="btn-group col-md-2" style="margin: 1%;">
            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ประเภท
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
        <div class="btn-group col-md-2" style="margin: 1%;">
            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ผู้ดูแล
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
        <div class="btn-group col-md-2" style="margin: 1%;">
            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                หน่วยงาน
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
    </div>
    <form action="<?= base_url('account/actions_acceptpayment_mon') ?>" method="POST">

        <div class="row search_tab" style="margin-bottom: 1%;">
            <!-- <input type="submit" class="btn btn-success col-md-2" name="excell" value="Export to Excell" style="margin-right: 2%; margin-left: 2%;" /> -->
            <input type="image" src="<?= base_url('files/excel.png') ?>" name="excell" value="Export to Excel" alt="Submit" class="excelimg">
            <!-- <input type="submit" class="btn btn-success col-md-2" name="report" value="Print Report" style="margin-right: 2%;" />
        <input type="submit" class="btn btn-success col-md-2" name="pdf" value="Export to PDF" style="margin-right: 2%;" /> -->
        </div>
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>
                        <div class="text-center"><input name="select_all" id="select-all" type="checkbox" /></div>
                    </th>
                    <th>รายการ</th>
                    <th>ผู้นำฝาก</th>
                    <th>เจ้าหน้าที่ดำเนินการ</th>
                    <th>วันที่</th>
                    <th>จำนวนเงิน</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data as $x) : ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td class="textnum"><?php echo $x['document_id']; ?></td>
                            <td class="textnum"><?php echo $x['customer_id']; ?></td>
                            <td class="textnum"><?php echo $x['customer_id']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($x['date'])); ?></td>
                            <!-- <td><?php echo $x['date']; ?></td> -->
                            <td class="textnum"><?php echo number_format($x['payment_amount'], 2); ?></td>
                            <!-- <td><?php echo $x['payment_amount']; ?></td> -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        การจัดการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actions">
                                        <a class="dropdown-item" href="<?= base_url('account/view_acceptpayment_mon') . '/' . $x['id'] ?>">รายละเอียด<?= $title ?></a>
                                        <a class="dropdown-item" href="<?= base_url('account/edit_acceptpayment') . '/' . $x['id'] ?>">แก้ไข<?= $title ?></a>
                                        <a class="dropdown-item" href="<?= base_url('account/delete_acceptpayment') . '/' . $x['id'] ?>" onclick="return confirm('ยืนยัน ?')">ลบ<?= $title ?></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>