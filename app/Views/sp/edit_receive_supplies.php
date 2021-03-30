<style>
    .autocomplete-suggestions {
        border: 1px solid #999;
        background: #FFF;
        overflow: auto;
    }

    .autocomplete-suggestion {
        padding: 2px 5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .autocomplete-selected {
        background: #F0F0F0;
    }

    .autocomplete-suggestions strong {
        font-weight: normal;
        color: #3399FF;
    }

    .autocomplete-group {
        padding: 2px 5px;
    }

    .autocomplete-group strong {
        display: block;
        border-bottom: 1px solid #000;
    }
</style>
<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 1%;">
    </div>
    <form method="post" action="<?= base_url('supplies/edit_receive_supplies/'.$data[0]['id']) ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="date">วันที่รับเข้า</label>
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="reference">เลขที่ใบPO</label>
                <input type="text" id="reference" class="form-control" name="reference" value="<?= $data[0]['reference'] ? $data[0]['reference'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="importer">ผู้นำเข้า</label>
                <input type="text" id="importer" class="form-control" name="importer" value="<?= $data[0]['importer'] ? $data[0]['importer'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="employees_id">รหัสพนักงาน</label>
                <input type="number" id="employees_id" class="form-control" name="employees_id" value="<?= $data[0]['employees_id'] ? $data[0]['employees_id'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="department">แผนก/ฝ่าย</label>
                <input type="text" id="department" class="form-control" name="department" value="<?= $data[0]['department'] ? $data[0]['department'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="document">ไฟล์แนบ(ถ้ามี) <?php if ($data[0]['document'] != null) { ?><a href="<?php echo base_url('files/receive_supplies_files') . '/' . $data[0]['document']; ?>">ไฟล์</a> <?php } ?></label> <span style="color: #25BCF5;text-decoration: underline;cursor: pointer;" id="del_document" title="กดเพื่อลบไฟล์" ><i class="fas fa-minus-circle" ></i></span>
                <input type='file' class="form-control" id="document" name="document" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="warehouse_id">นำเข้าคลัง</label>
                <select class="form-control" name="warehouse_id" id="warehouse_id" required>
                    <option selected value="">เลือกคลังสินค้า</option>
                    <?php foreach ($warehouse as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?php $data[0]['warehouse_id'] == $row['id'] ? print 'selected' : ''; ?>><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="status">สถานะ</label>
                <select class="form-control" name="status" id="status" required>
                    <option selected value="">เลือกสถานะ</option>
                    <option value="1" <?php $data[0]['status'] == 1 ? print 'selected' : ''; ?>>รับเรียบร้อย</option>
                    <option value="2" <?php $data[0]['status'] == 2 ? print 'selected' : ''; ?>>ระหว่างดำเนินการ</option>
                    <option value="3" <?php $data[0]['status'] == 3 ? print 'selected' : ''; ?>>ยังไม่ได้รับ</option>
                    <option value="4" <?php $data[0]['status'] == 4 ? print 'selected' : ''; ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <!-- <div class="row" style="margin-bottom: 1%;margin-top: 3%;">
            <div class="col-md-12">
                <input type="text" name="autocomplete" class="form-control" id="autocomplete" placeholder="โปรดเลือกสินค้าในรายการ" />
            </div>
        </div> -->
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">อื่นๆ</label>
                <textarea class="form-control" rows="1" name="note" id="note"><?= $data[0]['note'] ?? $data[0]['note']  ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        // $('#autocomplete').autocomplete({
        //     serviceUrl: '<?= base_url('supplies/getProduct'); ?>',
        //     onSelect: function(suggestion) {
        //         alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        //     }
        // });

        $("#del_document").click(function() {
            $('#document').val("");
        });
        var countries = [{
                value: 'Andorra',
                data: 'AD'
            },
            {
                value: 'Zimbabwe',
                data: 'ZZ'
            }
        ];
        $('#autocomplete').autocomplete({
            lookup: countries,
            onSelect: function(suggestion) {
                alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });
    });
</script>