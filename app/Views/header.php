<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?= $title ?></title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400&family=Lato&family=Montserrat&family=Open+Sans&family=Raleway&family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="<?= base_url('js/core.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/jquery.autocomplete.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/thaibath.js'); ?>" crossorigin="anonymous"></script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <!-- Fancytree -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.27.0/skin-win8/ui.fancytree.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.27.0/jquery.fancytree-all-deps.js" crossorigin="anonymous"></script> -->
    <script src="<?= base_url('js/jquery.mask.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/jquery.fancytree-all-deps.js'); ?>" crossorigin="anonymous"></script>
    <link href="<?= base_url('css/core.css'); ?>" rel="stylesheet" />

    <link rel="icon" href="https://www.egov.go.th/upload/eservice-thumbnail/img_13eac2c4ffa20f97f65115e49d55ff5b.png" type="image/png" sizes="16x16">


    <!-- date time thai -->
    <link href="<?= base_url('css/jquery.datetimepicker.css'); ?>" rel="stylesheet" />
    <script src="<?= base_url('js/jquery.datetimepicker.full.js'); ?>" crossorigin="anonymous"></script>


    <link href="<?= base_url('dist/css/bootstrap-datepicker.css'); ?>" rel="stylesheet" />
    <script src="<?= base_url('dist/js/bootstrap-datepicker-custom.js'); ?>"></script>
    <script src="<?= base_url('dist/locales/bootstrap-datepicker.th.min.js'); ?>" charset="UTF-8"></script>

    <!-- <script src="https://cdn.datatables.net/plug-ins/1.10.22/filtering/row-based/range_dates.js" crossorigin="anonymous"></script> -->

    <!-- select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- autoNumeric-autoNumeric-c426664 -->
    <script src="<?= base_url('js/autoNumeric.js'); ?>"></script>

    <!-- cookie -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

    <!-- html editor -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <style>
        /* body {
            font-family: Arial, Helvetica, sans-serif;
        } */
        /* .notification {
            background-color: #5BE781;
            color: white;
            text-decoration: none;
            padding: 3px 10px;
            position: relative;
            display: inline-block;
            border-radius: 30px;
        } */
        #noti_Button {
            background-color: #46b501;
            margin-left: 10px;
            margin-right: 10px;
            color: white;
            text-decoration: none;
            padding: 5px 11px;
            position: relative;
            display: inline-block;
            border-radius: 30px;
            box-shadow: 0px 1px 2px #717171;
            transition: 0.3s;
        }

        #noti_Button:hover {
            background: #0f7d41;
            color: #fff;
            text-decoration: none;
        }

        #noti_Button .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }

        .delete_noti {
            color: #464646;
            transition: 0.3s;
        }

        .delete_noti:hover {
            color: #0c0c0c;
        }
    </style>

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background-color: #C6C4C4;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #767575;
        }
    </style>

    <script>
        $(document).ready(function() {
            localStorage.setItem("token_test", "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJPbmxpbmUgSldUIEJ1aWxkZXIiLCJpYXQiOjE2MTU4OTIxMDMsImV4cCI6MTY0NzQyODEwMywiYXVkIjoid3d3LmV4YW1wbGUuY29tIiwic3ViIjoianJvY2tldEBleGFtcGxlLmNvbSIsIkdpdmVuTmFtZSI6IkxvcmVtIElwc3VtIiwiU3VybmFtZSI6Iklwc3VtIiwiRW1haWwiOiJhZG1pbkBleGFtcGxlLmNvbSIsIlJvbGUiOlsiTWFuYWdlciIsIkFkbWluaXN0cmF0b3IiXX0.Hq1MiOkbNFXYTlO5UddqByTi1TNbgVLKBcsSQbGYF6I");
            // localStorage.setItem("token_test", "-");
            var token_test = localStorage.getItem("token_test");
            $.ajax({
                url: "/notifications/lorem_token_check",
                type: "POST",
                dataType: "json",
                data: {
                    "token_test": token_test
                },
                success: function(data) {
                    console.log(data);
                    if (data.GivenName) {
                        $('#fullname').text(data.GivenName);
                    }
                },
                error: function(request, status, error) {
                    if (request.status == 503) {
                        // alert('I have the dreaded 503 error!');
                    } else if (request.status == 500) {
                        location.href = "https://chapanakij.kar-pool.co/admin/login";
                    }
                }
            });

            // var enable = 1;
            // var per_check = 1;
            // if(per_check != enable){
            //     $("#fn_1").css("display", "none");
            // }
        });
    </script>
</head>


<body class="sb-nav-fixed">
    <?php
    $this->noti_model = model('noti_model');
    $notification = $this->noti_model->get_noti();
    $notification_all = $this->noti_model->get_noti($id = null,$close = false);
    ?>
    <script>
    var notificationVar = <?php echo json_encode($notification); ?>;
    console.log(notificationVar);
    // var notification_all = <?php echo json_encode($notification_all); ?>;
    // console.log(notification_all);
    </script>
    <nav class="sb-topnav navbar navbar-expand navbar-green bg-green">
        <a class="navbar-brand" href="<?= base_url('/'); ?>"><i class="fa fa-globe"></i> ฌาปนกิจสงเคราะห์</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->

        <!---<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <font color="yellow">
                    <i class="fa fa-key"></i> <b>ยินดีต้อนรับคุณ:</b>
                    <!--<u>ศิรินภา</u>-->
                    <u id="fullname"></u>
                </font>

                <a href="#" id="noti_Button">
                    <i class="fas fa-bell"></i>
                    <!-- <span>Inbox</span> -->
                    <span class="badge" id="noti_Counter"><?=count($notification) != 0 ? count($notification) : ""; ?></span>
                </a>

                <!-- <div class="noti_box" id="notifications" style="
                    background: snow;
                    box-shadow: 2px 2px 12px #e8e8e8;
                    width: 340px;
                    height: 200px;
                    position: absolute;
                    border-radius: 4px;
                    top: 31px;
                    right: 0;
                ">

                    <div style="height:200px;"></div>
                    <div class="seeAll"><a href="#">See All</a></div>
                </div> -->
                <div id="notifications">
                    <!-- <div style="display: flex;"> -->
                    <!-- <h3 class="not_h3" style="width:70%;">แจ้งเตือน</h3> -->
                    <h4 style="text-align:center;padding: 8px 0px;background: #e9ecef;color: #696969;box-shadow: 0px 0px 2px #4c4c4c;">แจ้งเตือน (Notifications)</h4>
                    <!-- <div class="seeAll not_h3" style="width:30%;">
                            <button type="button" class="btn btn-dark btn-sm"><i class="fas fa-brush"></i> ลบทั้งหมด</button>
                        </div> -->
                    <!-- </div> -->

                    <!-- <div style="height:300px;"> -->
                    <?php for ($i = 0; $i < count($notification_all); $i++) {
                        $read_style = "#ebeff3;";
                        if($notification_all[$i]["id_noti_fk_read"] != null){
                            $read_style = "#fff;";
                        }
                    ?>
                        <div class="not_data" data-id_borrow="<?= $notification_all[$i]["id"] ?>" data-type_noti="<?= $notification_all[$i]["type_noti"] ?>" style="background:<?=$read_style;?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- <img style="width: 40px;margin-left: 14px;margin-top: 7px;" src="//cdn.iconscout.com/icon/premium/png-512-thumb/notification-142-647836.png"> -->
                                    <img style="width: 40px;margin-left: 14px;margin-top: 7px;" src="//www.pinclipart.com/picdir/big/337-3377481_general-cargo-think-outside-the-box-icon-clipart.png">
                                </div>
                                <div class="col-md-8">
                                    <h3 class="not_h3_sub">พัสดุที่เลยกำหนดคืนของ <?= $notification_all[$i]["employees_id"] ?></h3>
                                    <!-- <h6 style="padding: 0px 8px;margin-bottom: 4px;">แจ้งเตือนที่ <?= $i ?></h6> -->
                                    <p class="not_h3_content">วันที่ที่ต้องคืน <?= $notification_all[$i]["date_return"] ?></p>
                                </div>
                                <div class="col-md-2" style="padding-top: 13px; padding-left: 20px;">
                                    <span data-data_del_noti='<?= $notification_all[$i]["id"] ?>' data-type_noti="<?= $notification_all[$i]["type_noti"] ?>" class="delete_noti">
                                    <i class="fas fa-trash-alt" style="text-align:center;"></i>
                                    <div class="tip_label" data-id_tip_label="<?= $notification_all[$i]["id"] ?>" style="
                                        position: absolute;
                                        left: -96px;
                                        background: #7b7b7b;
                                        color: white;
                                        padding: 2px 10px;
                                        border-radius: 3px;
                                        top: 12px;
                                        display:none;
                                    ">ลบแจ้งเตือนนี้</div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php if ($i >= 5) {
                            break;
                        }
                    }
                    if (count($notification_all) <= 0) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="text-align: center;">
                                    ไม่พบการแจ้งเตือน
                                </h5>
                            </div>
                        </div>
                    <?php }

                    if (count($notification_all) > 0) { ?>
                        <div class="seeAll" style="float:left;margin-left: 5px;">
                            <a href="<?= base_url('/notifications'); ?>">ดูทั้งหมด</a>
                        </div>
                        <div class="seeAll" style="float:right;margin-right: 5px;">
                            <a href="<?= base_url('/notifications/deleteall'); ?>">ลบทั้งหมด</a>
                        </div>
                    <?php }
                    ?>
                </div>


                <!-- <a href="<?php echo site_url('login/logout'); ?>" onclick="return confirm('ต้องการออกจากระบบหรือไม่ ?');">
                    <font color="#FFFFFF">&nbsp;&nbsp;&nbsp;<i class="material-icons">logout</i></font>
                </a> -->
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 2px 10px;">
                        <font color="#FFFFFF">&nbsp;&nbsp;&nbsp;<i class="material-icons">logout</i></font>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actions" style="left: -80px;">
                        <!-- <a class="dropdown-item" style=" display: inline-flex; " href="<?php echo base_url('/permissions'); ?>"><i class="material-icons" style=" padding: 0px 8px 0px 0px; ">privacy_tip</i>กำหนดสิทธิ์</a> -->
                        <a class="dropdown-item" style=" display: inline-flex; " href="<?php echo base_url('/permissions'); ?>"><i class="material-icons" style=" padding: 0px 8px 0px 0px; ">perm_identity</i>กำหนดสิทธิ์</a>
                        <!-- <a class="dropdown-item" style=" display: inline-flex; " href="#"><i class="material-icons" style=" padding: 0px 8px 0px 0px; ">perm_identity</i>แก้ไขข้อมูลส่วนตัว</a> -->
                        <a class="dropdown-item" style=" display: inline-flex; " href="<?php echo site_url('login/logout'); ?>" onclick="return confirm('ต้องการออกจากระบบหรือไม่ ?');"><i class="material-icons" style=" padding: 0px 8px 0px 0px; ">logout</i>ออกจากระบบ</a>
                    </div>
                </div>
                <!-- <a href="#" id="logout_button">
                    <font color="#FFFFFF">&nbsp;&nbsp;&nbsp;<i class="material-icons">logout</i></font>
                </a>
                <div id="logout_manu">
                    <div class="logout_sub_manu" id="logout">
                        <div class="row">
                            <div class="col-md-12" style="height: 50px;">
                                <h3 class="not_h3_sub">ออกจากระบบ</h3>
                            </div>
                        </div>
                    </div>
                </div> -->
                <style>
                    #notifications,
                    #logout_manu {
                        display: none;
                        width: 430px;
                        position: absolute;
                        top: 30px;
                        right: 0;
                        background: #FFF;
                        border: solid 1px rgba(100, 100, 100, .20);
                        -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .20);
                        z-index: 1;
                    }

                    .not_data,
                    .logout_sub_manu {
                        border-bottom: solid 1px rgba(100, 100, 100, .30);
                        transition: 0.3s;
                    }

                    .not_data:hover,
                    .logout_sub_manu {
                        background: #ffd400;
                        cursor: pointer;
                    }

                    .not_h3 {
                        display: block;
                        color: #333;
                        /* background: #FFF; */
                        font-weight: bold;
                        font-size: 13px;
                        padding: 8px;
                        margin: 0;
                        border-bottom: solid 1px rgba(100, 100, 100, .30);
                    }

                    .not_h3_sub {
                        display: block;
                        color: #333;
                        /* background: #FFF; */
                        font-weight: bold;
                        font-size: 15px;
                        padding: 8px 8px 0px 8px;
                        margin: 0;
                    }

                    .not_h3_content {
                        display: block;
                        color: #333;
                        /* background: #FFF; */
                        font-size: 14px;
                        padding: 0px 8px 7px 8px;
                        margin: 0;
                    }

                    .seeAll {
                        background: #F6F7F8;
                        padding: 10px;
                        /* font-size: 12px; */
                        font-weight: bold;
                        /* border-top: solid 1px rgba(100, 100, 100, .30); */
                        text-align: center;
                    }

                    .seeAll a {
                        color: #3b5998;
                    }

                    .seeAll a:hover {
                        background: #F6F7F8;
                        color: #3b5998;
                        text-decoration: underline;
                    }
                </style>
                <script>
                    $(document).ready(function() {
                        $('#logout_button').click(function() {
                            $("#logout_manu").slideToggle(400);
                            return false;
                        });
                        $('#logout').click(function() {
                            var confirm = confirm('ต้องการออกจากระบบหรือไม่ ?');
                            if (confirm) {
                                location.href = "<?php echo site_url('login/logout'); ?>";
                            }
                        });
                        $('#noti_Button').click(function() {
                            // var not_data = $(".not_data").data("id_borrow");
                            if(notificationVar){
                                var id_product_all = [];
                                var type_noti_all = [];
                                for(i = 0;i < notificationVar.length;i++){
                                    id_product_all.push(notificationVar[i]["id"]);
                                    type_noti_all.push(notificationVar[i]["type_noti"]);
                                }
                            }
                            var jsonString = JSON.stringify(id_product_all);
                            $.ajax({
                                url: "/notifications/delete",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    "id_noti": jsonString,
                                    "type": "1"
                                },
                                success: function(data) {
                                }
                            });

                            // console.log(notificationVar);
                            // $('#notifications').fadeToggle('fast', 'linear', function() {
                            // if ($('#notifications').is(':hidden')) {
                            //     $('#noti_Button').css('background-color', '#5BE781');
                            // }
                            // else $('#noti_Button').css('background-color', 'red');
                            // $("#notifications").slideDown('fast');
                            $("#notifications").slideToggle(400);
                            $('#noti_Counter').fadeOut('slow');
                            return false;
                        });
                        $('.not_data').click(function() {
                            var id_borrow = $(this).data("id_borrow");
                            var type_noti = $(this).data("type_noti");
                            $.ajax({
                                url: "/notifications/create_read",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    "id_noti": id_borrow,
                                    "type": type_noti
                                },
                                success: function(data) {
                                }
                            });
                            
                            location.href = `/supplies/view_borrow/${id_borrow}`;
                        });

                        $(".delete_noti").mouseenter(function(e){
                            e.preventDefault();
                            var id_noti = $(this).data("data_del_noti");
                            console.log(id_noti);
                            // var id_tip_label = $(".tip_label").find("[data-id_tip_label='" + id_noti + "']");
                            var id_tip_label = $("[data-id_tip_label='" + id_noti + "']");
                            id_tip_label.css("display", "block");
                            console.log(id_tip_label);
                        });
                        $(".delete_noti").mouseleave(function(e){
                            e.preventDefault();
                            var id_noti = $(this).data("data_del_noti");
                            var id_tip_label = $("[data-id_tip_label='" + id_noti + "']");
                            id_tip_label.css("display", "none");
                            console.log(id_tip_label);
                        });

                        $('.delete_noti').click(function(e) {
                            e.preventDefault();
                            var id_noti = $(this).data("data_del_noti");
                            var type_noti = $(this).data("type_noti");
                            $.ajax({
                                url: "/notifications/create_hide",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    "id_noti": id_noti,
                                    "type": type_noti
                                },
                                success: function(data) {
                                    // response(data);
                                }
                            });
                            location.reload();
                            return false;
                        });


                        if (false) {
                            $('#noti_Counter')
                                .css({
                                    opacity: 0
                                })
                                .text('7')
                                .css({
                                    top: '-10px'
                                })
                                .animate({
                                    top: '-2px',
                                    opacity: 1
                                }, 500);

                            $('#noti_Button').click(function() {

                                $('#notifications').fadeToggle('fast', 'linear', function() {
                                    if ($('#notifications').is(':hidden')) {
                                        $('#noti_Button').css('background-color', '#5BE781');
                                    } else $('#noti_Button').css('background-color', 'red');
                                });

                                $('#noti_Counter').fadeOut('slow');
                                return false;
                            });

                            $(document).click(function() {
                                $('#notifications').hide();

                                if ($('#noti_Counter').is(':hidden')) {
                                    $('#noti_Button').css('background-color', '#5BE781');
                                }
                            });

                            $('#notifications').click(function() {
                                return false;
                            });
                        }
                    });
                </script>
            </div>

        </form>

        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">

            <!--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">ตั้งค่าระบบ</a>
                    <a class="dropdown-item" href="#">ข้อมูลส่วนตัว</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">ออกจากระบบ</a>
                </div>
            </li>-->

        </ul>


    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-green" id="sidenavAccordion">
                <div class="sb-sidenav-menu ">
                    <div class="nav">
                        <a class="sb-sidenav-menu-heading collapsed " href="#" data-toggle="collapse" data-target="#money" aria-expanded="true" aria-controls="money">
                            <div class="sb-sidenav-collapse-arrow "><i class="fa fa-fw fa-home"></i> การเงิน <i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="money" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="http://chapanakit.airtimes.co"><i class="fa fa-fw fa-file"></i> บริหารจัดการ</a>
                                <a class="nav-link" href="<?= base_url('/finance/statement'); ?>" id="fn_1"><i class="fa fa-fw fa-file"></i>กระทบยอดการเงิน</a>
                                <a class="nav-link" href="<?= base_url('/finance/list_debtor'); ?>" id="fn_2"><i class="fa fa-fw fa-file"></i>ข้อมูลสมาชิก</a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#revenue" aria-expanded="true" aria-controls="revenue" id="ma_revenue">
                                    <i class="fa fa-fw fa-folder-open"></i> รายรับ
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="revenue" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/finance/list_subscription_fee'); ?>" id="fn_3"><i class="fa fa-fw fa-file"></i> ค่าสมัครสมาชิก</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_datepay'); ?>" id="fn_4"><i class="fa fa-fw fa-file"></i> บันทึกวันนัดชำระ</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_billing'); ?>" id="fn_5"> <i class="fa fa-fw fa-file"></i>รายการเรียกเก็บเงินสงเคราะห์สมาชิก</a>
                                        <a class="nav-link" href="<?= base_url('/finance/import_billing'); ?>" id="fn_6"> <i class="fa fa-fw fa-file"></i>รายการรับชำระเงินสงเคราะห์สมาชิก</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_receiving_money'); ?>" id="fn_7"><i class="fa fa-fw fa-file"></i> รายการรับเงินสด</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_check'); ?>" id="fn_8"><i class="fa fa-fw fa-file"></i> บันทึกเช็ครับ</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_acceptpayment_complete'); ?>" id="fn_9"><i class="fa fa-fw fa-file"></i> พิมพ์ใบเสร็จรับเงิน</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_deposit'); ?>" id="fn_10"><i class="fa fa-fw fa-file"></i> ฝากเงินสด</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#expenditure" aria-expanded="true" aria-controls="expenditure" id="ma_expenditure">
                                    <i class="fa fa-fw fa-folder-open"></i> รายจ่าย
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="expenditure" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/finance/list_overdue'); ?>" id="fn_11"><i class="fa fa-fw fa-file"></i> บันทึกเงินสงเคราะห์ค้างจ่ายทายาท</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_payoffdebt'); ?>" id="fn_12"><i class="fa fa-fw fa-file"></i> บันทึกจ่ายเงินสงเคราะห์ทายาท</a>
                                        <a class="nav-link" href="<?= base_url('/finance/print_check_pay'); ?>" id="fn_13"><i class="fa fa-fw fa-file"></i> พิมพ์เช็คจ่าย</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_checkpay'); ?>" id="fn_14"><i class="fa fa-fw fa-file"></i> บันทึกเช็คจ่าย</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_pettycash'); ?>" id="fn_15"><i class="fa fa-fw fa-file"></i> บันทึกเบิกเงินสดย่อย</a>
                                        <a class="nav-link" href="<?= base_url('/finance/list_withdraw'); ?>" id="fn_16"><i class="fa fa-fw fa-file"></i> ถอนเงินสด</a>
                                    </nav>
                                </div>
                                <a class="nav-link" href="<?= base_url('/finance/list_transfer'); ?>" id="fn_17"><i class="fa fa-fw fa-file"></i> โอนเงินระหว่างบัญชี</a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report" aria-expanded="true" aria-controls="report" id="ma_report">
                                    <i class="fa fa-fw fa-folder-open"></i> รายงาน
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="report" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/finance/list_acceptpayment'); ?>" id="fn_18"><i class="fa fa-fw fa-search"></i> รายงานการรับชำระเงิน</a>
                                        <a class="nav-link" href="<?= base_url('/finance/report_checkpay'); ?>" id="fn_19"><i class="fa fa-fw fa-search"></i> รายงานทะเบียนเช็คจ่ายตามรอบระยะการจ่าย</a>
                                        <a class="nav-link" href="<?= base_url('/finance/report_billing'); ?>" id="fn_20"><i class="fa fa-fw fa-search"></i> รายงานการค้างจ่ายของสมาชิกเป็นรายบุคคล</a>
                                        <a class="nav-link" href="<?= base_url('/finance/report_payoffdebt'); ?>" id="fn_21"><i class="fa fa-fw fa-search"></i> รายงานสรุปยอดการจ่ายเงินสงเคราะห์แบบรายเดือนและรายปี</a>
                                        <a class="nav-link" href="<?= base_url('/finance/report_overdue'); ?>" id="fn_22"><i class="fa fa-fw fa-search"></i> รายงานเรื่องค้างจ่ายเป็นรายบุคคล</a>
                                    </nav>
                                </div>
                                <a class="nav-link" href="<?= base_url('/finance/setting'); ?>" id="fn_23"><i class="fa fa-cog"></i>ตั้งค่าการเงิน</a>
                            </nav>
                        </div>

                        <a class="sb-sidenav-menu-heading collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="true" aria-controls="collapseLayouts">
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-fw fa-home"></i> บัญชี <i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?= base_url('/account/account_book'); ?>" id="ac_1"><i class="fa fa-fw fa-file"></i> ผังบัญชี</a>
                                <a class="nav-link" href="<?= base_url('/account/cost_estimate'); ?>" id="ac_2"><i class="fa fa-fw fa-file"></i> ประมาณการค่าใช้จ่าย</a>
                                <a class="nav-link" href="<?= base_url('/account/budget'); ?>" id="ac_3"><i class="fa fa-fw fa-file"></i> งบประมาณโครงการ</a>
                                <a class="nav-link" href="<?= base_url('/account/money_source'); ?>" id="ac_4"><i class="fa fa-fw fa-file"></i> ประเภทแหล่งเงิน</a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#daily" aria-expanded="true" aria-controls="daily" id="ma_daily">
                                    <i class="fa fa-fw fa-folder-open"></i> ลงประจำวัน
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="daily" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/account/list_generaljournal'); ?>" id="ac_5"><i class="fa fa-fw fa-file"></i> สมุดรายวันทั่วไป</a>
                                        <a class="nav-link" href="<?= base_url('/account/list_payjournal'); ?>" id="ac_6"><i class="fa fa-fw fa-file"></i> สมุดรายวันจ่าย</a>
                                        <a class="nav-link" href="<?= base_url('/account/list_receiptjournal'); ?>" id="ac_7"><i class="fa fa-fw fa-file"></i> สมุดรายวันรับ </a>
                                        <a class="nav-link" href="<?= base_url('/account/list_salesjournal'); ?>" id="ac_8"><i class="fa fa-fw fa-file"></i> สมุดรายวันขาย</a>
                                        <a class="nav-link" href="<?= base_url('/account/list_purchasejournal'); ?>" id="ac_9"><i class="fa fa-fw fa-file"></i> สมุดรายวันซื้อ</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#creditor" aria-expanded="false" aria-controls="creditor" id="ma_creditor">
                                    <i class="fa fa-fw fa-folder-open"></i> เจ้าหนี้
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="creditor" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/account/list_creditor'); ?>" id="ac_10"><i class="fa fa-fw fa-file"></i> บันทึกข้อมูลเจ้าหนี้ </a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report_ac" aria-expanded="false" aria-controls="report_ac" id="ma_report_ac">
                                    <i class="fa fa-fw fa-folder-open"></i> รายงาน
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="report_ac" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/account/report_budget_disbursement'); ?>" id="ac_11"><i class="fa fa-fw fa-search"></i> รายงานการเบิกจ่ายงบประมาณ</a>
                                        <a class="nav-link" href="<?= base_url('/account/report_cost_estimate'); ?>" id="ac_12"><i class="fa fa-fw fa-search"></i> รายงานประมาณการค่าใช้จ่าย</a>
                                        <!-- <a class="nav-link" href="<?= base_url('/account/report_cost_estimate'); ?>"><i class="fa fa-fw fa-search"></i> รายงานประมาณการค่าใช้จ่าย</a> -->
                                        <!-- <a class="nav-link" href="<?= base_url('/account/report_budget'); ?>"><i class="fa fa-fw fa-search"></i> รายงานงบประมาณ</a> -->
                                    </nav>
                                </div>
                                <!--<a class="nav-link" href="<?= base_url('/account/setting'); ?>"><i class="fa fa-fw fa-cog"></i> ตั้งค่าบัญชี</a>-->
                            </nav>
                        </div>

                        <a class="sb-sidenav-menu-heading collapsed" href="#" data-toggle="collapse" data-target="#supplies" aria-expanded="false" aria-controls="supplies">
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-fw fa-home"></i> งานพัสดุ <i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="supplies" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?= base_url('supplies'); ?>" id="sp_1"><i class="fa fa-fw fa-file"></i> ภาพรวมงานพัสดุ</a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage_sup" aria-expanded="true" aria-controls="manage_sup" id="ma_manage_sup">
                                    <i class="fa fa-fw fa-folder-open"></i> จัดการคลังพัสดุ/วัสดุ
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="manage_sup" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <a class="nav-link" href="<?= base_url('supplies/list_product'); ?>" id="sp_2"><i class="fa fa-fw fa-file"></i>จัดการคลังครุภัณฑ์/วัสดุภัณฑ์</a>
                                    <a class="nav-link" href="<?= base_url('supplies/product'); ?>" id="sp_3"><i class="fa fa-fw fa-file"></i> เพิ่มครุภัณฑ์/วัสดุภัณฑ์</a>
                                    <a class="nav-link" href="<?= base_url('supplies/list_supplies'); ?>" id="sp_4"><i class="fa fa-fw fa-file"></i> ออกเลขพัสดุ</a>
                                    <!-- <a class="nav-link" href="<?= base_url('supplies/barcode'); ?>"><i class="fa fa-fw fa-barcode"></i>พิมพ์ Barcode / label</a> -->
                                    <a class="nav-link" href="<?= base_url('supplies/print_barcodes'); ?>" id="sp_5"><i class="fa fa-fw fa-barcode"></i>พิมพ์ Barcode / label</a>
                                    <a class="nav-link" href="<?= base_url('supplies/receive_supplies'); ?>" id="sp_6"><i class="fa fa-fw fa-file"></i> รับพัสดุเข้าคลังครุภัณฑ์/วัสดุภัณฑ์</a>
                                    <a class="nav-link" href="<?= base_url('supplies/list_receive_supplies'); ?>" id="sp_7"><i class="fa fa-fw fa-file"></i> รายการรับพัสดุเข้าคลังครุภัณฑ์/วัสดุภัณฑ์</a>
                                    <a class="nav-link" href="<?= base_url('supplies/list_check_stock'); ?>" id="sp_8"><i class="fa fa-fw fa-file"></i> นับสต๊อก</a>
                                    <a class="nav-link" href="<?= base_url('supplies/requisition'); ?>" id="sp_9"><i class="fa fa-fw fa-file"></i> เบิกจ่ายพัสดุ</a>
                                    <a class="nav-link" href="<?= base_url('supplies/list_borrow'); ?>" id="sp_10"><i class="fa fa-fw fa-file"></i> ยืม - คืน พัสดุ</a>
                                    <a class="nav-link" href="<?= base_url('supplies/depreciation'); ?>" id="sp_11"><i class="fa fa-fw fa-file"></i> คิดค่าเสื่อม</a>
                                    <a class="nav-link" href="<?= base_url('supplies/list_transfer'); ?>" id="sp_12"><i class="fa fa-fw fa-file"></i> บันทึกโอนย้ายสินทรัพย์ </a>
                                    <a class="nav-link" href="<?= base_url('supplies/list_requisition'); ?>" id="sp_13"><i class="fa fa-fw fa-file"></i> ประวัติการเบิกจ่ายพัสดุ</a>
                                    <!-- <a class="nav-link" href="<?= base_url('supplies/cost_appraisal'); ?>"><i class="fa fa-fw fa-search"></i> ตรวจสอบราคากลางพัสดุ</a> -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dailyReport" aria-expanded="true" aria-controls="dailyReport" id="ma_dailyReport">
                                        <i class="fa fa-fw fa-folder-open"></i> รายงาน
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="dailyReport" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?= base_url('supplies/list_registration_responsible'); ?>" id="sp_14"><i class="fa fa-fw fa-search"></i> รายงานทะเบียนสินทรัพย์ แยกชื่อผู้รับผิดชอบ</a>
                                            <a class="nav-link" href="<?= base_url('supplies/list_registration_bring_forward'); ?>" id="sp_15"><i class="fa fa-fw fa-search"></i> รายงานทะเบียนสินทรัพย์ที่แสดงยอดยกมาต้นปี</a>
                                            <a class="nav-link" href="<?= base_url('supplies/list_registration_depreciation'); ?>" id="sp_16"><i class="fa fa-fw fa-search"></i> รายงานทะเบียนสินทรัพย์และค่าเสื่อมราคา</a>
                                            <a class="nav-link" href="<?= base_url('supplies/list_registration_transfer_repair'); ?>" id="sp_17"><i class="fa fa-fw fa-search"></i> รายงานทะเบียนสินทรัพย์/โอนย้ายสินทรัพย์/ประวัติการซ่อมแซม</a>
                                            <a class="nav-link" href="<?= base_url('supplies/list_depreciation'); ?>" id="sp_18"><i class="fa fa-fw fa-search"></i> รายงานคำนวนค่าเสื่อมราคาตามช่วงเวลา</a>
                                        </nav>
                                    </div>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="purchase" id="ma_purchase">
                                    <i class="fa fa-fw fa-folder-open"></i> งานจัดซื้อจัดจ้าง
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="purchase" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                                        <a class="nav-link" href="<?= base_url('/purchase/form_purchase'); ?>" id="sp_19"><i class="fa fa-fw fa-file"></i> สร้างแบบฟอร์มสั่งซื้อสั่งจ้าง (PO)</a>
                                        <a class="nav-link" href="<?= base_url('/purchase/list_form_purchase'); ?>" id="sp_20"><i class="fa fa-fw fa-file"></i> รายการสั่งซื้อสั่งจ้าง (PO List)</a>
                                        <a class="nav-link" href="<?= base_url('/purchase/list_buy_supplies'); ?>" id="sp_21"><i class="fa fa-fw fa-file"></i> ใบขอซื้อพัสดุทั้งหมด (PR)</a>
                                        <a class="nav-link" href="<?= base_url('/purchase/buy_supplies'); ?>" id="sp_22"><i class="fa fa-fw fa-file"></i> สร้างใบขอซื้อพัสดุ (PR List)</a>
                                        <!--  <a class="nav-link" href="<?= base_url('/purchase/list_purchase'); ?>"><i class="fa fa-fw fa-file"></i> รายการจัดซื้อจัดจ้างทั้งหมด (PO)</a>
                                        <a class="nav-link" href="<?= base_url('/purchase/purchase'); ?>"><i class="fa fa-fw fa-file"></i> สร้างการจัดซื้อจัดจ้าง</a> -->
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dailyB" aria-expanded="true" aria-controls="dailyB" id="ma_dailyB">
                                            <i class="fa fa-fw fa-folder-open"></i> รายงาน
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="dailyB" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="<?= base_url('/purchase/list_form_purchase'); ?>" id="sp_23"><i class="fa fa-fw fa-search"></i>รายงานขอซื้อขอจ้าง</a>
                                                <!-- <a class="nav-link" href="<?= base_url('/purchase/list_buy_supplies'); ?>"><i class="fa fa-fw fa-search"></i> รายงานขอซื้อ</a>
                                                <a class="nav-link" href="<?= base_url('/purchase/list_purchase'); ?>"><i class="fa fa-fw fa-search"></i> รายงานจัดซื้อจัดจ้าง</a> -->

                                            </nav>
                                        </div>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hire" aria-expanded="true" aria-controls="hire" id="ma_hire">
                                    <i class="fa fa-fw fa-folder-open"></i> งานจัดจ้าง จัดหา
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="hire" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <a class="nav-link" href="<?= base_url('/hire/list_hire'); ?>" id="sp_24"><i class="fa fa-fw fa-file"></i>งานจัดจ้าง</a>
                                    <a class="nav-link" href="<?= base_url('/hire/hire'); ?>" id="sp_25"><i class="fa fa-fw fa-file"></i> สร้างแบบฟอร์มจ้าง</a>
                                    <a class="nav-link" href="<?= base_url('/hire/list_supply'); ?>" id="sp_26"><i class="fa fa-fw fa-file"></i> งานจัดหา</a>
                                    <a class="nav-link" href="<?= base_url('/hire/supply'); ?>" id="sp_27"><i class="fa fa-fw fa-file"></i> สร้างแบบฟอร์มจัดหา</a>
                                    <a class="nav-link" href="<?= base_url('/hire/check'); ?>" id="sp_28"><i class="fa fa-fw fa-file"></i> งานตรวจรับ</a>
                                    <a class="nav-link" href="<?= base_url('/hire/list_repair'); ?>" id="sp_29"><i class="fa fa-fw fa-file"></i> รายการซ่อม</a>
                                    <a class="nav-link" href="<?= base_url('/hire/repair'); ?>" id="sp_30"><i class="fa fa-fw fa-file"></i> สร้างแบบฟอร์มซ่อม</a>
                                    <a class="nav-link" href="<?= base_url('/hire/list_lease'); ?>" id="sp_31"><i class="fa fa-fw fa-file"></i> รายการเช่า</a>
                                    <a class="nav-link" href="<?= base_url('/hire/lease'); ?>" id="sp_32"><i class="fa fa-fw fa-file"></i> สร้างรายการเช่า</a>
                                    <a class="nav-link" href="<?= base_url('/hire/list_reveal'); ?>" id="sp_33"><i class="fa fa-fw fa-file"></i>รายการเบิก อนุมัติ งวดงาน</a>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dailyC" aria-expanded="true" aria-controls="dailyC" id="ma_dailyC">
                                        <i class="fa fa-fw fa-folder-open"></i> รายงาน
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="dailyC" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?= base_url('/hire/report_repair'); ?>" id="sp_34"><i class="fa fa-fw fa-search"></i> รายงานซ่อม</a>
                                            <a class="nav-link" href="<?= base_url('/hire/report_lease'); ?>" id="sp_35"><i class="fa fa-fw fa-search"></i> รายงานเช่า</a>
                                            <a class="nav-link" href="<?= base_url('/hire/report_supply'); ?>" id="sp_36"><i class="fa fa-fw fa-search"></i>รายงานจัดหา</a>
                                            <a class="nav-link" href="<?= base_url('/hire/report_hire'); ?>" id="sp_37"><i class="fa fa-fw fa-search"></i>รายงานจัดจ้าง</a>
                                        </nav>
                                    </div>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setting" aria-expanded="true" aria-controls="setting" id="ma_setting">
                                    <i class="fa fa-fw fa-folder-open"></i> ตั้งค่างานพัสดุ
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="setting" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <a class="nav-link" href="<?= base_url('/setting'); ?>" id="sp_38"><i class="fa fa-fw fa-cog"></i> ตั้งค่าระบบพัสดุ</a>
                                    <a class="nav-link" href="<?= base_url('/setting/list_tax_rate'); ?>" id="sp_39"><i class="fa fa-fw fa-cog"></i> กำหนดอัตราภาษี</a>
                                    <a class="nav-link" href="<?= base_url('/setting/list_unit'); ?>" id="sp_40"><i class="fa fa-fw fa-cog"></i> กำหนดหน่วยนับ</a>
                                    <a class="nav-link" href="<?= base_url('/setting/list_category'); ?>" id="sp_41"><i class="fa fa-fw fa-cog"></i> กำหนดหมวดหมู่พัสดุ</a>
                                    <a class="nav-link" href="<?= base_url('/setting/list_type'); ?>" id="sp_42"><i class="fa fa-fw fa-cog"></i> กำหนดประเภท</a>
                                    <a class="nav-link" href="<?= base_url('/setting/list_warehouse'); ?>" id="sp_43"><i class="fa fa-fw fa-cog"></i> ตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์</a>
                                </div>
                            </nav>
                        </div>
                        <!-- <a class="sb-sidenav-menu-heading collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="false" aria-controls="purchase">
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-fw fa-home"></i> งานจัดซื้อจัดจ้าง <i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="purchase" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?= base_url('/purchase/list_buy_supplies'); ?>"><i class="fa fa-fw fa-file"></i> ใบขอซื้อพัสดุทั้งหมด (PR)</a>
                                <a class="nav-link" href="<?= base_url('/purchase/buy_supplies'); ?>"><i class="fa fa-fw fa-file"></i> สร้างใบขอซื้อพัสดุ</a>
                                <a class="nav-link" href="<?= base_url('/purchase/list_purchase'); ?>"><i class="fa fa-fw fa-file"></i> รายการจัดซื้อจัดจ้างทั้งหมด (PO)</a>
                                <a class="nav-link" href="<?= base_url('/purchase/purchase'); ?>"><i class="fa fa-fw fa-file"></i> สร้างการจัดซื้อจัดจ้าง</a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dailyB" aria-expanded="true" aria-controls="dailyB">
                                    <i class="fa fa-fw fa-folder-open"></i> รายงาน
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="dailyB" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/purchase/list_buy_supplies'); ?>"><i class="fa fa-fw fa-search"></i> รายงานขอซื้อ</a>
                                        <a class="nav-link" href="<?= base_url('/purchase/list_purchase'); ?>"><i class="fa fa-fw fa-search"></i> รายงานจัดซื้อจัดจ้าง</a>

                                    </nav>
                                </div>
                            </nav>
                        </div> -->
                        <!-- <a class="sb-sidenav-menu-heading collapsed" href="#" data-toggle="collapse" data-target="#hire" aria-expanded="false" aria-controls="hire">
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-fw fa-home"></i> งานจัดจ้าง จัดหา <i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="hire" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?= base_url('/hire/list_hire'); ?>"><i class="fa fa-fw fa-file"></i>งานจัดจ้าง</a>
                                <a class="nav-link" href="<?= base_url('/hire/hire'); ?>"><i class="fa fa-fw fa-file"></i> สร้างแบบฟอร์มจ้าง</a>
                                <a class="nav-link" href="<?= base_url('/hire/list_supply'); ?>"><i class="fa fa-fw fa-file"></i> งานจัดหา</a>
                                <a class="nav-link" href="<?= base_url('/hire/supply'); ?>"><i class="fa fa-fw fa-file"></i> สร้างแบบฟอร์มจัดหา</a>
                                <a class="nav-link" href="<?= base_url('/hire/check'); ?>"><i class="fa fa-fw fa-file"></i> งานตรวจรับ</a>
                                <a class="nav-link" href="<?= base_url('/hire/list_repair'); ?>"><i class="fa fa-fw fa-file"></i> รายการซ่อม</a>
                                <a class="nav-link" href="<?= base_url('/hire/repair'); ?>"><i class="fa fa-fw fa-file"></i> สร้างแบบฟอร์มซ่อม</a>
                                <a class="nav-link" href="<?= base_url('/hire/list_lease'); ?>"><i class="fa fa-fw fa-file"></i> รายการเช่า</a>
                                <a class="nav-link" href="<?= base_url('/hire/lease'); ?>"><i class="fa fa-fw fa-file"></i> สร้างรายการเช่า</a>
                                <a class="nav-link" href="<?= base_url('/hire/list_supply'); ?>"><i class="fa fa-fw fa-file"></i>รายการจัดหา</a>
                                <a class="nav-link" href="<?= base_url('/hire/list_hire'); ?>"><i class="fa fa-fw fa-file"></i>รายการจัดจ้าง</a>
                                <a class="nav-link" href="<?= base_url('/hire/list_reveal'); ?>"><i class="fa fa-fw fa-file"></i>รายการเบิก อนุมัติ งวดงาน</a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dailyC" aria-expanded="true" aria-controls="dailyC">
                                    <i class="fa fa-fw fa-folder-open"></i> รายงาน
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="dailyC" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url('/hire/list_repair'); ?>"><i class="fa fa-fw fa-search"></i> รายงานซ่อม</a>
                                        <a class="nav-link" href="<?= base_url('/hire/list_lease'); ?>"><i class="fa fa-fw fa-search"></i> รายงานเช่า</a>
                                    </nav>
                                </div>
                            </nav>
                        </div> -->
                        <!-- <a class="sb-sidenav-menu-heading collapsed" href="#" data-toggle="collapse" data-target="#setting" aria-expanded="false" aria-controls="setting">
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-fw fa-cog"></i> ตั้งค่างานพัสดุ <i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="setting" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?= base_url('/setting/index'); ?>"><i class="fa fa-fw fa-cog"></i> ตั้งค่าระบบพัสดุ</a>
                                <a class="nav-link" href="<?= base_url('/setting/list_tax_rate'); ?>"><i class="fa fa-fw fa-cog"></i> กำหนดอัตราภาษี</a>
                                <a class="nav-link" href="<?= base_url('/setting/list_unit'); ?>"><i class="fa fa-fw fa-cog"></i> กำหนดหน่วยนับ</a>
                                <a class="nav-link" href="<?= base_url('/setting/list_category'); ?>"><i class="fa fa-fw fa-cog"></i> กำหนดหมวดหมู่พัสดุ</a>
                                <a class="nav-link" href="<?= base_url('/setting/list_type'); ?>"><i class="fa fa-fw fa-cog"></i> กำหนดประเภท</a>
                            </nav>
                        </div> -->
                    </div>
                </div>

                <!--<div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>-->

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4" style="margin-right: 5%;"><?= $title ?></h1>

                    <ol class="breadcrumb mb-4">

                        <?php if (!empty($pages)) {
                            foreach ($pages as $page) {
                                if ($page['link'] != "#") { ?>
                                    <li class="breadcrumb-item active"><a href="<?= $page['link'] ?>"><?= $page['title'] ?></a></li>
                                <?php } else { ?>
                                    <li class="breadcrumb-item active"><?= $page['title'] ?></li>
                        <?php }
                            }
                        } ?>
                    </ol>