function readURLI(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function readURLFI(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview_image2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
// ----------------------------------------------------------------------------------------------------------
$(document).ready(function() {

    $('.select2').select2();
    // ----------------------------------------------------------------------------------------------------------

    $('.money').autoNumeric('init');

    // ----------------------------------------------------------------------------------------------------------
    // $('.summernote').summernote();
    // $('#address').summernote();
    $('textarea').summernote({ height: 120, });

    // ----------------------------------------------------------------------------------------------------------
    // คิดค่าเสื่อม
    // $(".test").change(function() {
    //     var total = 0;

    //     $('.value').each(function() {
    //         var inputval = $(this).val();
    //         if ($.isNumeric(inputval)) {
    //             total += parseFloat(inputval);
    //         }
    //     });
    //     $('#total').val(total.toFixed(2));
    // });
    // ----------------------------------------------------------------------------------------------------------

    $('.type_id').change(function() {
        if ($('.type_id:checked').val() !== '4') {
            $("#type_detail").prop('required', false);
            $('#type_detail').prop('disabled', true);

        } else {
            $('#type_detail').prop('disabled', false);
            $("#type_detail").prop('required', true);
        }
    });
    // ----------------------------------------------------------------------------------------------------------


    $("#image").change(function() {
        readURLI(this);
    });
    $("#image2").change(function() {
        readURLFI(this);
    });
    // ----------------------------------------------------------------------------------------------------------
    // $(".value").val().trigger('change');
    // $(".vat").val().trigger('change');
    $(".findage").change(function() {
        var test = $(this).val().split('/');
        var test1 = test[1] + '/' + test[0] + '/' + test[2];

        var date = new Date(test1);
        var today = new Date();

        var year = today.getFullYear() + 543;
        var month = today.getMonth();
        var day = today.getDate();

        var today = new Date(year, month, day);
        var age = Math.floor((today - date) / (365.25 * 24 * 60 * 60 * 1000));
        $("#age").text(age);
        // console.log(date);
        // console.log(test1);
        // console.log(today);
    });
    $(".findage2").change(function() {
        var test = $(this).val().split('/');
        var test1 = test[1] + '/' + test[0] + '/' + test[2];

        var date = new Date(test1);
        var today = new Date();

        var year = today.getFullYear() + 543;
        var month = today.getMonth();
        var day = today.getDate();

        var today = new Date(year, month, day);
        var age = Math.floor((today - date) / (365.25 * 24 * 60 * 60 * 1000));
        $("#age2").text(age);
    });
    $(".findage3").change(function() {
        var test = $(this).val().split('/');
        var test1 = test[1] + '/' + test[0] + '/' + test[2];

        var date = new Date(test1);
        var today = new Date();

        var year = today.getFullYear() + 543;
        var month = today.getMonth();
        var day = today.getDate();

        var today = new Date(year, month, day);
        var age = Math.floor((today - date) / (365.25 * 24 * 60 * 60 * 1000));
        $("#age3").text(age);
    });
    // ----------------------------------------------------------------------------------------------------------

    // V2
    // $('.datetimepicker2').datepicker({
    //   format: 'yyyy-mm-dd',
    //   todayBtn: true,
    //   language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    //   thaiyear: true              //Set เป็นปี พ.ศ.
    // }).datepicker();  //กำหนดเป็นวันปัจุบัน


    // V1
    $.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.

    // กรณีใช้แบบ input
    $(".datetimepicker2").datetimepicker({
        timepicker: false,
        format: 'd/m/Y', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        onSelectDate: function(dp, $input) {
            var yearT = new Date(dp).getFullYear() - 0;
            var yearTH = yearT + 543;
            var fulldate = $input.val();
            var fulldateTH = fulldate.replace(yearT, yearTH);
            $input.val(fulldateTH);
        },
    });
    // กรณีใช้กับ input ต้องกำหนดส่วนนี้ด้วยเสมอ เพื่อปรับปีให้เป็น ค.ศ. ก่อนแสดงปฏิทิน
    $(".datetimepicker2").on("mouseenter mouseleave", function(e) {
        var dateValue = $(this).val();
        if (dateValue != "") {
            var arr_date = dateValue.split("/"); // ถ้าใช้ตัวแบ่งรูปแบบอื่น ให้เปลี่ยนเป็นตามรูปแบบนั้น
            // ในที่นี้อยู่ในรูปแบบ 00-00-0000 เป็น m-d-Y  แบ่งด่วย - ดังนั้น ตัวแปรที่เป็นปี จะอยู่ใน array
            //  ตัวที่สอง arr_date[2] โดยเริ่มนับจาก 0 
            if (e.type == "mouseenter") {
                var yearT = arr_date[2] - 543;
            }
            if (e.type == "mouseleave") {
                var yearT = parseInt(arr_date[2]) + 543;
            }
            dateValue = dateValue.replace(arr_date[2], yearT);
            $(this).val(dateValue);
            // console.log(dateValue);
        }
    });
    // ----------------------------------------------------------------------------------------------------------
    $(".value").change(function() {
        var total = 0;

        $('.value').each(function() {
            var inputval = $(this).val();
            if ($.isNumeric(inputval)) {
                total += parseFloat(inputval);
            }
        });
        $('#total').val(total.toFixed(2));
    });
    $(".vat").change(function() {
        var total = 0;
        var amount = parseFloat($(".vat").autoNumeric('get'));
        var vat = (amount * 0.07).toFixed(2);
        total = (parseFloat(amount) + parseFloat(vat)).toFixed(2);

        $('#vat').val(vat);
        $('#total').val(total);
    });

    $(".cal").change(function() {
        var amount = parseFloat($("#amount").autoNumeric('get'));
        var fee = parseFloat($("#fee").autoNumeric('get'));
        var vat = parseFloat($("#vat").autoNumeric('get'));
        var tax = parseFloat($("#tax").autoNumeric('get'));

        var total = (parseFloat(amount) - parseFloat(fee) - parseFloat(vat) - parseFloat(tax)).toFixed(2);
        $('.caltotal').val(total);
        $('.money').trigger('keyup');
    });
    $(".deposit_withdraw").change(function() {
        var amount = parseFloat($("#amount").autoNumeric('get'));
        var service_charge = parseFloat($("#service_charge").autoNumeric('get'));
        console.log($(".deposit_withdraw").autoNumeric('get'));
        var total = (parseFloat(amount) + parseFloat(service_charge)).toFixed(2);
        // $('#total').val(total);
        $('#total').autoNumeric('set', total);

    });
    // ----------------------------------------------------------------------------------------------------------
    $("#delete").on("click", function() {
        $("#supervisory_account").prop('required', false);
    });
    // ----------------------------------------------------------------------------------------------------------

    $("#tree").fancytree({
        checkbox: true,
        selectMode: 1,
        source: {
            url: base_url + "/account/getfancytree/" + 0
        },

        // activate: function (event, data) {
        //   $("#statusLine").text(event.type + ": " + data.node);
        // },
        select: function(event, data) {
            $("#statusLine").text(event.type + ": " + data.node.isSelected() + " " + data.node);

            $("#account_number").val(data.node.ab_account_number);
            $("#th_name").val(data.node.ab_th_name);
            $("#en_name").val(data.node.ab_en_name);
            $("#account_category").val(data.node.ab_account_category);
            $("#account_category").trigger('change');

            // $("#supervisory_account").val(data.node.ab_supervisory_account);




            if (data.node.ab_separate_department == 1) {
                if (data.node.isSelected()) {
                    $("#supervisory_account").prop('required', false);
                    $('#separate_department').prop('checked', true);
                } else
                    $("#supervisory_account").prop('required', true);

            } else if (data.node.ab_separate_department == 0)
                $('#separate_department').prop('checked', false);


            if (data.node.ab_type == 't')
                $("#type").val("true");
            else if (data.node.ab_type == 'f')
                $("#type").val("false");

            if (data.node.isSelected()) {
                $('form').attr('action', base_url + '/account/account_book/' + data.node.key);
                $("#delete").prop('hidden', false);
            } else {
                $('form').attr('action', base_url + '/account/account_book');
                $("#delete").prop('hidden', true);
            }

        }
    });
    // ----------------------------------------------------------------------------------------------------------


    $('#account_category').change(function() {
        var account_category = $(this).val();
        var options = '<option value="">เลือกบัญชีคุม</option>';
        $.ajax({
            type: "POST",
            url: base_url + "/account/getsupervisoryaccount/" + account_category,
            success: function(data) {
                $('#supervisory_account').html('');
                for (var i = 0; i < data.length; i++) { // Loop through the data & construct the options
                    options += '<option value="' + data[i].id + '">' + data[i].account_number + ' ' + data[i].th_name + '</option>';
                }
                // Append to the html
                $('#supervisory_account').append(options);
            }
        });
    });

    // ----------------------------------------------------------------------------------------------------------


    $('#category_main_id').change(function() {
        var category_main_id = $(this).val();
        var options = '<option value="">เลือกหมวดหมู่ย่อย</option>';

        $.ajax({
            type: "POST",
            url: base_url + "/supplies/getcategorysub/" + category_main_id,
            success: function(data) {
                $('#category_minor_id').html('');
                for (var i = 0; i < data.length; i++) { // Loop through the data & construct the options
                    options += '<option value="' + data[i].id + '">' + data[i].category_name + '</option>';
                }
                // Append to the html
                $('#category_minor_id').append(options);
            }
        });
    });

    // ----------------------------------------------------------------------------------------------------------

    $("input[type=checkbox]").on("click", function() {
        console.log($(this).val());
    });
    // ----------------------------------------------------------------------------------------------------------
    $('body').on('click', '#excel', function(e) {
        e.preventDefault();
        $('#form_action').val($(this).attr('data-action'));
        $('#action-form-submit').trigger('click');
    });
    var table = $('#datatable').DataTable({
        columnDefs: [{
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': checkbox
        }],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],

        ],
        order: [
            [1, "asc"]
        ],
        responsive: true

    });
    // $("#search").on('keyup click', function() {
    //     table.columns(2).search($(this).val()).draw();
    // });
    $('#search').on('keyup change', function() {
        // console.log(this.value);
        if (table.search() !== this.value) {
            table
                .search(this.value)
                .draw();
        }
    });
    // $('#datepicker_from').keyup(function() { table.draw(); });
    // $('#datepicker_to').keyup(function() { table.draw(); });

    $('#select-all').on('click', function() {
        var rows = table.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
        if (!this.checked) {
            var el = $('#select-all').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });

});

function checkbox(x) {
    return '<div class="text-center"><input class="checkbox" type="checkbox" name="val[]" value="' + x + '" /></div>';
}