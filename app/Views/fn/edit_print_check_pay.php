<style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<?php
$bk_name = [
    null => 'ข้อมูลผิดพลาด',
    '1' => 'ธนาคารกรุงไทย',
    '2' => 'ธนาคารไทยพาณิชย์',
];
$bk = [
    '1' => 'kt.png',
    '2' => 'scb.jpg'
];
// var_dump($bk_name[$data[0]['bank']]);
?>
<div class="tab">
    <button class="tablinks active" onclick="openCity(event,'edit')">พิมพ์เช็ค <?php echo $bk_name[$data[0]['bank']]; ?></button>
</div>

<div id="edit" class="tabcontent" style="display: block;padding-top: 1%;">
    <form method="post" action="<?= base_url('finance/edit_print_check_pay').'/'.$data[0]['id'] ?>">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-8">
                <?php if ($data[0]['bank'] != null) { ?>
                    <img src="<?= base_url($bk[$data[0]['bank']]) ?>" alt="image" style="width: 100px;">
                <?php } else { ?>
                    <img src="<?= base_url('files') . '/noimages.png' ?>" alt="image" style="width: 100px;">

                <?php } ?>
            </div>
            <input type="hidden" class="form-control" name="bank" value="1" required>

            <div class="col-md-1">
                <label for="no">เลขที่เช็ค</label>
            </div>
            <div class="col-md-3">
                <input type="number" id="no" class="form-control" name="no" value="<?= $data[0]['no'] ? $data[0]['no'] : '' ?>" required>
            </div>
        </div>

        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="date">วันที่เขียนเช็ค</label>
            </div>
            <div class="col-md-5">
                <input type="text" id="date" class="datetimepicker2 form-control" name="date" value="<?= $data[0]['date'] ? $data[0]['date'] : '' ?>" required>
            </div>
            <div class="col-md-1">
                <label for="out_date">วันที่เช็คครบกำหนด</label>
            </div>
            <div class="col-md-5">
                <input type="text" id="out_date" class="datetimepicker2 form-control" name="out_date" value="<?= $data[0]['out_date'] ? $data[0]['out_date'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="recipient_name">ชื่อผู้รับ</label>
            </div>
            <div class="col-md-11">
                <input type="text" id="recipient_name" class="form-control" name="recipient_name" value="<?= $data[0]['recipient_name'] ? $data[0]['recipient_name'] : '' ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-1">
                <label for="amount_int">จำนวนเงิน</label>
            </div>
            <div class="col-md-9">
                <input type="text" id="amount_th" class="form-control" name="amount_th" value="<?= $data[0]['amount_th'] ? $data[0]['amount_th'] : '' ?>" readonly>
            </div>
            <div class="col-md-2">
                <input type="text" id="amount_int" class="form-control money" name="amount_int" value="<?= $data[0]['amount_int'] ? $data[0]['amount_int'] : 0 ?>" required>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">

            <div class="col-md-1">
                <label for="note">หมายเหตุการจ่าย</label>
            </div>
            <div class="col-md-11">
                <textarea class="form-control" rows="1" name="note" id="note"><?= $data[0]['note'] ? $data[0]['note'] : '' ?></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12" style="margin-top: 1%;text-align: right;">
                <input type="submit" class="btn btn-success " name="save" value="บันทึกข้อมูล" style="margin-right: 2%;" />
                <input type="button" class="btn btn-primary " onclick="history.go(-1);" value="ย้อนกลับ" style="margin-right: 2%;" />
                <input type="reset" class="btn btn-secondary " value="เคลียร์" />
            </div>
        </div>
    </form>
</div>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    $(document).ready(function() {
        $('#amount_int').change(function() {
            var thaibath = ArabicNumberToText(this.value);
            $('#amount_th').val(thaibath);

        });
        $("#amount_int").trigger('change');
    });
</script>