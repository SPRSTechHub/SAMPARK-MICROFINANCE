<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DestiniGo </title>
    <link rel="stylesheet" href="http://control.destinigo.co.in/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="http://control.destinigo.co.in/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="http://control.destinigo.co.in/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="http://control.destinigo.co.in/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet"
        href="http://control.destinigo.co.in/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="http://control.destinigo.co.in/assets/vendors/css/vendor.bundle.base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://control.destinigo.co.in/assets/css/vertical-layout-dark/style.css">
    <link rel="shortcut icon" href="http://control.destinigo.co.in/assets/images/favicon.png" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <meta name="propeller" content="51eecea6a9f19288db44ecb9e3bb7615">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper auth">

                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_s29fmaiw.json"
                    background="transparent" speed="1" style="width: auto; height: 300px;" loop autoplay>
                </lottie-player>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">SHARE CONTENT</h4>
                        <p class="card-description">Add Mobile No <code>xxxxx</code></p>
                        <div class="template-demo text-center">
                            <input type="hidden" class="form-control" value="" id="link_text">
                            <button type="button" class="btn btn-primary btn-lg btn-block" data-bs-toggle="modal"
                                data-bs-target="#getnomodal">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16C12.84 16.27 13.3 16.42 13.66 16.53C14.25 16.72 14.79 16.69 15.22 16.63C15.7 16.56 16.68 16.03 16.89 15.45C17.1 14.87 17.1 14.38 17.04 14.27C16.97 14.17 16.81 14.11 16.56 14C16.31 13.86 15.09 13.26 14.87 13.18C14.64 13.1 14.5 13.06 14.31 13.3C14.15 13.55 13.67 14.11 13.53 14.27C13.38 14.44 13.24 14.46 13 14.34C12.74 14.21 11.94 13.95 11 13.11C10.26 12.45 9.77 11.64 9.62 11.39C9.5 11.15 9.61 11 9.73 10.89C9.84 10.78 10 10.6 10.1 10.45C10.23 10.31 10.27 10.2 10.35 10.04C10.43 9.87 10.39 9.73 10.33 9.61C10.27 9.5 9.77 8.26 9.56 7.77C9.36 7.29 9.16 7.35 9 7.34C8.86 7.34 8.7 7.33 8.53 7.33Z" />
                                </svg>
                                Whats App
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- Modal -->
    <div class="modal fade" id="getnomodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-mobile"></i></span>
                                </div>
                                <input type="text" class="form-control" id="mobileno" placeholder="Mobile No"
                                    aria-label="Mobile No">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="form-group row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary" id="gen_btn">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Alert Modal -->
    <div class="modal fade" id="other_modal" tabindex="-1" role="dialog" aria-labelledby="other_modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
            <div class="modal-content  bg-danger">
                <div class="modal-header">
                    <h5 class="modal-title" id="other_modalTitle">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="message_alert"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Alert Modal -->

    <script>
    $(document).ready(function() {
        $('#gen_btn').on("click", function(e) {
            var mobileno = $('#mobileno').val();
            if (mobileno == '') {
                $('#other_modal').modal('show');
                $('#message_alert').html('Please enter Mobile number');
            } else {
                $.ajax({
                    url: "<?php echo site_url('play/generate_link/') ?>",
                    type: "post",
                    "data": {
                        'mobileno': mobileno
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.err = '100') {
                            $('#link_text').val('https://play.liveipl.online/?uri=' + data
                                .uri);
                            kchek();
                        } else {
                            $('#other_modal').modal('show');
                            $('#message_alert').html('Link generate failed!');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            }
        });
    });

    function kchek() {
        var textlink = $('#link_text').val();
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                .userAgent)) {
            var article = 'Please click to visit our review'; //$(this).attr("data-text");
            var weburl = textlink; //$(this).attr("data-link");
            var whats_app_message = encodeURIComponent(textlink);
            var whatsapp_url = "whatsapp://send?text=" + whats_app_message;
            window.location.href = whatsapp_url;
        } else {
            alert('You Are Not On A Mobile Device. Please Use This Button To Share On Mobile');
        }
    }
    </script>

    <script>
    document.addEventListener("keyup", function(e) {
        var keyCode = e.keyCode ? e.keyCode : e.which;
        if (keyCode == 44) {
            stopPrntScr();
        }
    });

    function stopPrntScr() {
        var inpFld = document.createElement("input");
        inpFld.setAttribute("value", ".");
        inpFld.setAttribute("width", "0");
        inpFld.style.height = "0px";
        inpFld.style.width = "0px";
        inpFld.style.border = "0px";
        document.body.appendChild(inpFld);
        inpFld.select();
        document.execCommand("copy");
        inpFld.remove(inpFld);
    }

    function AccessClipboardData() {
        try {
            window.clipboardData.setData("text", "Access   Restricted");
        } catch (err) {}
    }
    setInterval("AccessClipboardData()", 300);
    </script>
    <script>
    $(document).ready(function() {
        $('#check_btn').click(function(e) {
            e.preventDefault();
            var emp_id = $("#emp_id").val();
            var emp_pass = $("#emp_pass").val();
            var datastring = {
                emp_id: emp_id,
                emp_pass: emp_pass
            };
            if (emp_id == '') {
                $("#other_modal").modal('show');
                $('#message_alert').html('Id is empty ...!');
            } else if (emp_pass == '') {

                $("#other_modal").modal('show');
                $('#message_alert').html('password empty ...!');
            } else {
                $.ajax({
                    url: "<?=base_url();?>play/checking_tbl/",
                    dataType: 'json',
                    method: "POST",
                    data: datastring,
                    catch: false,
                    success: function(data) {
                        if (data.error == '2') {
                            $("#other_modal").modal('show');
                            $('#message_alert').html(data.status);
                        } else if (data.error == '1') {
                            $("#other_modal").modal('show');
                            $('#message_alert').html(data.status);
                        } else if (data.error == '0') {
                            location.replace(
                                '<?=base_url();?>home/index/');
                        } else {
                            $("#other_modal").modal('show');
                            $('#message_alert').html(data.status);
                        }
                    }
                });
            }
        });
    });
    </script>
    <script src="http://control.destinigo.co.in/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="http://control.destinigo.co.in/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js">
    </script>
    <script src="http://control.destinigo.co.in/assets/js/off-canvas.js"></script>
    <script src="http://control.destinigo.co.in/assets/js/hoverable-collapse.js"></script>
    <script src="http://control.destinigo.co.in/assets/js/template.js"></script>
    <script src="http://control.destinigo.co.in/assets/js/settings.js"></script>
    <script src="http://control.destinigo.co.in/assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>
