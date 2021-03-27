<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ฌกส. สำนักงานฌาปนกิจสงเคราะห์ กระทรวงสาธารณสุข</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400&family=Lato&family=Montserrat&family=Open+Sans&family=Raleway&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-HN1ED2NF27&amp;l=dataLayer&amp;cx=c"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="icon" href="https://www.egov.go.th/upload/eservice-thumbnail/img_13eac2c4ffa20f97f65115e49d55ff5b.png" type="image/png" sizes="16x16">
    <!-- GetButton.io widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                facebook: "114047450144768", // Facebook page ID
                line: "//line.me/R/ti/p/%40oft9767b#~", // Line QR code URL
                //call: "+66-2589-9105", // Call phone number
                //email: "contact@chapanakij.or.th", // Email
                call_to_action: "ส่งข้อความถึงเรา", // Call to action
                button_color: "#A8CE50", // Color of button
                position: "right", // Position may be 'right' or 'left'
                order: "facebook,email", // Order of buttons
            };
            var proto = document.location.protocol,
                host = "getbutton.io",
                url = proto + "//static." + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>
    <!-- /GetButton.io widget -->


</head>

<body>
    <form method="post" action="<?= base_url('login/validlogin') ?>">

        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">

            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card1 pb-5">
                            <br>

                            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                                <a href="https://chapanakij.or.th/">
                                    <img src="<?= base_url('logo.png'); ?>" class="image" title="สำนักงานฌาปนกิจสงเคราะห์ กระทรวงสาธารณสุข">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card2 card border-0 px-4 py-5">
                            <label class="mb-1">
                                <h2>เข้าสู่ระบบก่อนใช้งาน</h2>
                                <hr>
                                <div class="row px-3">
                                    <label class="mb-1">
                                        <h6 class="mb-0 text-sm ">ชื่อผู้ใช้งาน</h6>
                                    </label>
                                    <input class="mb-4" type="text" name="username" placeholder="Enter Username">
                                </div>
                                <div class="row px-3"> <label class="mb-1">
                                        <h6 class="mb-0 text-sm">รหัสผ่าน</h6>
                                    </label>
                                    <input type="password" name="password" placeholder="Enter Password">
                                </div>
                                <div class="row px-3 mb-4">
                                    <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input">
                                        <label for="chk1" class="custom-control-label text-sm">จำชื่อฉันไว้ในระบบ</label>
                                    </div>

                                    <a href="mailto:contact@chapanakij.or.th" class="ml-auto mb-0 text-sm">ช่วยเหลือ ?</a>

                                </div>
                                <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">เข้าสู่ระบบ</button>

                                    &nbsp;&nbsp;<button type="reset" class="btn btn-gray text-center">เคลียร์</button>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="bg-blue py-4">
                    <div class="row px-3">
                        <small class="ml-4 ml-sm-5 mb-2">
                            <center>Copyright &copy; 2021. All rights reserved. สำนักงานฌาปนกิจสงเคราะห์ กระทรวงสาธารณสุข</center>
                        </small>

                    </div>
                </div>
            </div>
        </div>
    </form>
</body>


<style>
    /* @font-face {
            font-family: "Kanit";
            src: url('myfont.woff2') format('woff2'),
                url('myfont.woff') format('woff');
        } */

    body {
        color: #000;
        overflow-x: hidden;

        width: 99%;
        /* background-color: #B0BEC5; */
        background-image: url("http://chapanakit.airtimes.co/assets/img/bg-login.jpg");
        background-repeat: no-repeat;
    }

    html,
    body {
        font-family: "Kanit" !important;

    }

    /* .newfont {
        font-family: "Kanit";

    } */

    .card0 {
        box-shadow: 0px 4px 8px 0px #757575;
        border-radius: 0px
    }

    .card2 {
        margin: 0px 40px
    }

    .logo {
        width: 100px;
        /* height: 100px; */
        margin-top: 20px;
        margin-left: 35px
    }

    .image {
        width: 360px;
        /* height: 280px */
    }

    .border-line {
        border-right: 1px solid #EEEEEE
    }


    .or {
        width: 10%;
        font-weight: bold
    }

    .text-sm {
        font-size: 14px !important
    }

    ::placeholder {
        color: #BDBDBD;
        opacity: 1;
        font-weight: 300
    }

    :-ms-input-placeholder {
        color: #BDBDBD;
        font-weight: 300
    }

    ::-ms-input-placeholder {
        color: #BDBDBD;
        font-weight: 300
    }

    input,
    textarea {
        padding: 10px 12px 10px 12px;
        border: 1px solid lightgrey;
        border-radius: 2px;
        margin-bottom: 5px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        color: #2C3E50;
        font-size: 14px;
        letter-spacing: 1px
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #304FFE;
        outline-width: 0
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

    a {
        color: inherit;
        cursor: pointer
    }

    .btn-blue {
        background-color: #087bdd;
        width: 150px;
        color: #FFF;
        border-radius: 2px
    }

    .btn-gray {
        background-color: #adadad;
        width: 150px;
        color: #000;
        border-radius: 2px
    }


    .bg-blue {
        color: #fff;
        background-color: #006835
    }

    @media screen and (max-width: 991px) {
        .logo {
            margin-left: 0px
        }

        .image {
            width: 300px;
            height: 220px
        }

        .border-line {
            border-right: none
        }

        .card2 {
            border-top: 1px solid #EEEEEE !important;
            margin: 0px 15px
        }
    }
</style>

</html>