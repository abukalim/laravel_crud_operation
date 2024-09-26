<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit="no">
    <title>IIM Calcutta | Innovation park </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://sampark.iimcip.com/public/front_end/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://sampark.iimcip.com/public/assets/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{URL::asset('/css/style.css')}}" />
    <link rel="stylesheet" href="https://sampark.iimcip.com/public/front_end/css/responsive.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        body {
            position: static;
            background: url('images/bg-img.png') no-repeat bottom right, #e5eef5;
        }
        .roy-vali-error { color: red; }
        #signup_step2, #signup_step3, #signup_step4 {
            display: none;
        }
        .select2-container--default .select2-selection--multiple {
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            -webkit-border-radius: 2px;
            border-radius: 2px;
            cursor: text;
            height: 42px;
        }
        .select2-container--default .select2-search--inline .select2-search__field{
            width:initial !important;
        }
    </style>
    </head>


   <main>
    @yield('content')
   </main>



    <footer>
        <script src="https://sampark.iimcip.com/public/front_end/js/jquery.min.js"></script>
        <script src="https://sampark.iimcip.com/public/front_end/js/popper.min.js"></script>
        <script src="https://sampark.iimcip.com/public/front_end/js/bootstrap.min.js"></script>
        <script src="https://sampark.iimcip.com/public/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
        <script src="https://sampark.iimcip.com/public/front_end/js/custom.js"></script>
        <script>
        $(document).ready(function () {
            $('#indusCatIds').select2({
                //placeholder: "Choose Industries...",
            });
            $("body").on('keypress', '.onlyNumber', function(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            });
        });
        </script>
        <script type="text/javascript" src="https://sampark.iimcip.com/public/assets/jquery_validator/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://sampark.iimcip.com/public/assets/jquery_validator/additional-methods.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.signupLink').focus(function() {
            $('.signupRight').css({
                'display': 'block'
            })
            $('.loginRight').css({
                'display': 'none'
            })
        });
        $('.loginLink').focus(function() {
            $('.loginRight').css({
                'display': 'block'
            })
            $('.signupRight').css({
                'display': 'none'
            })
        });
    });

    $('#loginForm').validate({
        errorElement: 'span',
        errorClass : 'roy-vali-error',
        rules: {
            email_id: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email_id: {
                required: 'Please enter registered email-id',
                email: 'Please enter valid email-id'
            },
            password: {
                required: 'Please enter password',
            }
        }
    });


    $(document).ready(function(){

        $(".nextBtn").click(function() {
            var form = $("#signupForm");
            form.validate({
                errorElement: 'span',
                errorClass: 'roy-vali-error',
                rules: {
                    member_company: {
                        required: true
                    },
                    contact_name: {
                        required: true
                    },
                    "industry_category_id[]": {
                        required: true
                    },
                    stage_id: {
                        required: true
                    },
                    password : {
                        required: true,
                    },
                    confirm_password : {
                        required: true,
                        equalTo: '#password'
                    },
                    email_id:{
                        required: true,
                        email: true
                    },
                    contact_no:{
                        required: true
                    },
                    country:{
                        required: true
                    },
                    city:{
                        required: true
                    }
                },
                messages: {
                    member_company: {
                        required: 'Please enter your startup name'
                    },
                    contact_name: {
                        required: 'Please enter contact name'
                    },
                    "industry_category_id[]": {
                        required: 'Please select industry verticals'
                    },
                    stage_id: {
                        required: 'Please select startup stage'
                    },
                    password : {
                        required: 'Please enter password',
                    },
                    confirm_password : {
                        required: 'Please enter confirm password',
                        equalTo: 'Confirm password not match'
                    },
                    email_id:{
                        required: 'Please enter email-id',
                        email: 'Please enter valid email-id'
                    },
                    contact_no:{
                        required: 'Please enter contact number'
                    },
                    country:{
                        required: 'Please enter country'
                    },
                    city:{
                        required: 'Please enter city'
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('indusCatIds')) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            if (form.valid() === true) {
                if ($('#signup_step1').is(":visible")) {
                    current_fs = $('#signup_step1');
                    next_fs = $('#signup_step2');
                    indicator = "signup_step2";
                } else if ($('#signup_step2').is(":visible")) {
                    current_fs = $('#signup_step2');
                    next_fs = $('#signup_step3');
                    indicator = "signup_step3";
                } else if ($('#signup_step3').is(":visible")) {
                    current_fs = $('#signup_step3');
                    next_fs = $('#signup_step4');
                    indicator = "signup_step4";
                }
                next_fs.show();
                current_fs.hide();
                $('#' + indicator + '_indicator').addClass('active').siblings().removeClass('active');
            }
        });

        $('.prevBtn').click(function() {
            if ($('#signup_step4').is(":visible")) {
                current_fs = $('#signup_step4');
                next_fs = $('#signup_step3');
                indicator = "signup_step3";
            } else if ($('#signup_step3').is(":visible")) {
                current_fs = $('#signup_step3');
                next_fs = $('#signup_step2');
                indicator = "signup_step2";
            } else if ($('#signup_step2').is(":visible")) {
                current_fs = $('#signup_step2');
                next_fs = $('#signup_step1');
                indicator = "signup_step1";
            }
            next_fs.show();
            current_fs.hide();
            $('#' + indicator + '_indicator').addClass('active').siblings().removeClass('active');
        });

    });
    </script>
    </footer>
