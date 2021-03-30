<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'all')" id="all_tab"><?= $title ?></button>
</div>

<div id="all" class="tabcontent" style="padding-top: 0; display:block;">
    <div class="row search_tab" style="margin-bottom: 0;">
    </div>
    <form method="post" action="<?= base_url('account/edit_cost_estimate') . "/" . $data[0]['id'] ?>" enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="operator">ผู้ดำเนินการ</label>
                <input type="text" id="operator" class="form-control" name="operator" value="<?= $data[0]['operator'] ? $data[0]['operator'] : '' ?>" required />
            </div>
            <div class="col-md-6">
                <label for="department"> แผนก / ฝ่าย</label>
                <select class="form-control select2" name="department" id="department" required>
                    <option selected value="">เลือกแผนก / ฝ่าย</option>
                    <option value="1" <?php $data[0]['department'] == '1' ? print 'selected' : ''; ?>>บัญชีและการเงิน</option>
                    <option value="2" <?php $data[0]['department'] == '2' ? print 'selected' : ''; ?>>พัสดุ</option>
                    <option value="3" <?php $data[0]['department'] == '3' ? print 'selected' : ''; ?>>ไอที</option>
                    <option value="4" <?php $data[0]['department'] == '4' ? print 'selected' : ''; ?>>บุคคล</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="implementation_date">วันที่ดำเนินการ</label>
                <input type="text" id="implementation_date" class="datetimepicker2 form-control" name="implementation_date" value="<?= $data[0]['implementation_date'] ? $data[0]['implementation_date'] : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label for="main_item">โครงการหลัก</label>
                <input type="text" id="main_item" class="form-control" name="main_item" value="<?= $data[0]['main_item'] ? $data[0]['main_item'] : '' ?>" required />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-6">
                <label for="sub_item">โครงการย่อย</label>
                <input type="text" id="sub_item" class="form-control" name="sub_item" value="<?= $data[0]['sub_item'] ? $data[0]['sub_item'] : '' ?>" required />
            </div>
            <div class="col-md-3">
                <label for="allocate_year"> จัดสรรปีงบประมาณ</label>
                <?php
                echo '<select class="form-control select2" name="allocate_year" id="allocate_year" required>';
                $var_y = date("Y") + 543;
                $ys = $var_y - 30;
                $ys_go = $var_y + 20;

                for ($i = $ys; $i <= $ys_go; $i++) {
                    if ($i == $data[0]['allocate_year']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='{$i}' $selected>{$i}</option>";
                }
                echo '</select>';
                ?>
            </div>
            <div class="col-md-3">
                <label for="allocate_year_amount">จำนวนเงิน</label>
                <input type="text" id="allocate_year_amount" class="form-control money" name="allocate_year_amount" value="<?= $data[0]['allocate_year_amount'] ? $data[0]['allocate_year_amount'] : 0 ?>" />
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-2">
                <label for="request_year">คำขอตั้งแต่ปีงบประมาณ</label>
                <?php
                echo '<select class="form-control select2" name="request_year" id="request_year" required>';
                $var_y = date("Y") + 543;
                $ys = $var_y - 30;
                $ys_go = $var_y + 20;

                for ($i = $ys; $i <= $ys_go; $i++) {
                    if ($i == $data[0]['request_year']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='{$i}' $selected>{$i}</option>";
                }
                echo '</select>';
                ?>
            </div>
            <div class="col-md-2">
                <label for="request_year_amount">จำนวนเงิน</label>
                <input type="text" id="request_year_amount" class="form-control money" name="request_year_amount" value="<?= $data[0]['request_year_amount'] ? $data[0]['request_year_amount'] : 0 ?>" />
            </div>
            <div class="col-md-8">
                <label for="estimate_year">ประมาณการค่าใช้จ่ายล่วงหน้า</label>
                <div class="row">
                    <div class="col-md-2">
                        <?php
                        echo '<select class="form-control select2 " name="estimate_year1" id="estimate_year1" required>';
                        $var_y = date("Y") + 543;
                        $ys = $var_y - 30;
                        $ys_go = $var_y + 20;

                        for ($i = $ys; $i <= $ys_go; $i++) {
                            if ($i == $data[0]['estimate_year1']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value='{$i}' $selected>{$i}</option>";
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="estimate_year1_amount" class="form-control money" name="estimate_year1_amount" value="<?= $data[0]['estimate_year1_amount'] ? $data[0]['estimate_year1_amount'] : 0 ?>" />
                    </div>
                    <div class="col-md-2">
                        <?php
                        echo '<select class="form-control select2" name="estimate_year2" id="estimate_year2" required>';
                        $var_y = date("Y") + 543;
                        $ys = $var_y - 30;
                        $ys_go = $var_y + 20;

                        for ($i = $ys; $i <= $ys_go; $i++) {
                            if ($i == $data[0]['estimate_year2']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value='{$i}' $selected>{$i}</option>";
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="estimate_year2_amount" class="form-control money" name="estimate_year2_amount" value="<?= $data[0]['estimate_year2_amount'] ? $data[0]['estimate_year2_amount'] : 0 ?>" />
                    </div>
                    <div class="col-md-2">
                        <?php
                        echo '<select class="form-control select2" name="estimate_year3" id="estimate_year3" required>';
                        $var_y = date("Y") + 543;
                        $ys = $var_y - 30;
                        $ys_go = $var_y + 20;

                        for ($i = $ys; $i <= $ys_go; $i++) {
                            if ($i == $data[0]['estimate_year3']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value='{$i}' $selected>{$i}</option>";
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="estimate_year3_amount" class="form-control money" name="estimate_year3_amount" value="<?= $data[0]['estimate_year3_amount'] ? $data[0]['estimate_year3_amount'] : 0 ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1%;">
            <div class="col-md-12">
                <label for="note">ระบุคำชี้แจงและเหตุผลความจำเป็น</label>
                <textarea class="form-control" rows="1" name="note" id="note"><?= $data[0]['note'] ? $data[0]['note'] : '' ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="document">แนบเอกสาร <?php if ($data[0]['document'] != null) { ?><a href="<?php echo base_url('files/cost_estimate_files') . '/' . $data[0]['document']; ?>">ไฟล์</a> <?php } ?></label>
                <input type='file' class="form-control" id="document" name="document" />
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