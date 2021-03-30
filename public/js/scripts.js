/*!
 * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    var controller = window.location.pathname;
    var controller = controller.substring(1, 5);
    // alert(path);

    if (controller == 'acco') {
        $('#collapseLayouts').addClass("show");
        if (path == "http://chapanakit.airtimes.co/account/report_budget_disbursement" || path == "http://chapanakit.airtimes.co/account/report_cost_estimate") {
            $("#ma_report_ac").removeClass();
            $('#ma_report_ac').addClass("nav-link");
            $('#report_ac').addClass("show");
        }
        if (path == "http://chapanakit.airtimes.co/account/list_creditor") {
            $("#ma_creditor").removeClass();
            $('#ma_creditor').addClass("nav-link");
            $('#creditor').addClass("show");
        }
        if (path == "http://chapanakit.airtimes.co/account/list_generaljournal" || path == "http://chapanakit.airtimes.co/account/list_payjournal" || path == "http://chapanakit.airtimes.co/account/list_receiptjournal" || path == "http://chapanakit.airtimes.co/account/list_salesjournal" || path == "http://chapanakit.airtimes.co/account/list_purchasejournal") {
            $("#ma_daily").removeClass();
            $('#ma_daily').addClass("nav-link");
            $('#daily').addClass("show");
        }
    } else if (controller == 'supp') {
        if (path == "http://chapanakit.airtimes.co/supplies") {
            $('#supplies').addClass("show");
        } else {
            $('#supplies').addClass("show");
            $("#ma_manage_sup").removeClass();
            $('#ma_manage_sup').addClass("nav-link");
            $('#manage_sup').addClass("show");
            if (path == "http://chapanakit.airtimes.co/supplies/list_depreciation" || path == "http://chapanakit.airtimes.co/supplies/list_registration_transfer_repair" || path == "http://chapanakit.airtimes.co/supplies/list_registration_depreciation" || path == "http://chapanakit.airtimes.co/supplies/list_registration_bring_forward" || path == "http://chapanakit.airtimes.co/supplies/list_registration_responsible") {
                $("#ma_dailyReport").removeClass();
                $('#ma_dailyReport').addClass("nav-link");
                $('#dailyReport').addClass("show");
            }
        }
    } else if (controller == 'purc') {
        $('#supplies').addClass("show");
        $("#ma_purchase").removeClass();
        $('#ma_purchase').addClass("nav-link");
        $('#purchase').addClass("show");
        if (path == "http://chapanakit.airtimes.co/purchase/list_form_purchase") {
            $("#ma_dailyB").removeClass();
            $('#ma_dailyB').addClass("nav-link");
            $('#dailyB').addClass("show");
        }
    } else if (controller == 'hire') {
        $('#supplies').addClass("show");
        $("#ma_hire").removeClass();
        $('#ma_hire').addClass("nav-link");
        $('#hire').addClass("show");
        if (path == "http://chapanakit.airtimes.co/hire/report_repair" || path == "http://chapanakit.airtimes.co/hire/report_supply" || path == "http://chapanakit.airtimes.co/hire/report_lease" || path == "http://chapanakit.airtimes.co/hire/report_hire") {
            $("#ma_dailyC").removeClass();
            $('#ma_dailyC').addClass("nav-link");
            $('#dailyC').addClass("show");
        }
    } else if (controller == 'sett') {
        $('#supplies').addClass("show");
        $("#ma_setting").removeClass();
        $('#ma_setting').addClass("nav-link");
        $('#setting').addClass("show");
    } else {
        $('#money').addClass("show");
        if (path == "http://chapanakit.airtimes.co/finance/list_subscription_fee" || path == "http://chapanakit.airtimes.co/finance/list_datepay" || path == "http://chapanakit.airtimes.co/finance/list_billing" ||
            path == "http://chapanakit.airtimes.co/finance/import_billing" || path == "http://chapanakit.airtimes.co/finance/list_receiving_money" || path == "http://chapanakit.airtimes.co/finance/list_check" ||
            path == "http://chapanakit.airtimes.co/finance/list_acceptpayment_complete" || path == "http://chapanakit.airtimes.co/finance/list_deposit") {
            $("#ma_revenue").removeClass();
            $('#ma_revenue').addClass("nav-link");
            $('#revenue').addClass("show");
        }
        if (path == "http://chapanakit.airtimes.co/finance/list_overdue" || path == "http://chapanakit.airtimes.co/finance/list_payoffdebt" || path == "http://chapanakit.airtimes.co/finance/print_check_pay" ||
            path == "http://chapanakit.airtimes.co/finance/list_checkpay" || path == "http://chapanakit.airtimes.co/finance/list_pettycash" || path == "http://chapanakit.airtimes.co/finance/list_withdraw") {
            $("#ma_expenditure").removeClass();
            $('#ma_expenditure').addClass("nav-link");
            $('#expenditure').addClass("show");
        }
        if (path == "http://chapanakit.airtimes.co/finance/list_acceptpayment" || path == "http://chapanakit.airtimes.co/finance/report_checkpay" || path == "http://chapanakit.airtimes.co/finance/report_billing" ||
            path == "http://chapanakit.airtimes.co/finance/report_payoffdebt" || path == "http://chapanakit.airtimes.co/finance/report_overdue") {
            $("#ma_report").removeClass();
            $('#ma_report').addClass("nav-link");
            $('#report').addClass("show");
        }
    }

    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);