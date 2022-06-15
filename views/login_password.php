<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-green text-center" id="otpsent" style="display:none;">
                            <span style="margin:10px 0px;"></span>
                            <a id="changeUserName" style="text-decoration:underline; font-size:12px; padding:0; color:blue; cursor:pointer;">Change</a>
                        </div>
                        <div>
                            <input id="userName" name="userName" type="text" class="form-control" placeholder="Enter Email/Mobile number" value="">
                        </div>
                        <div>
                            <input id="password" type="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <p id="errMsg" class='text-red text-center'></p>
                        <p id="msg" class='text-green'></p>
                        <!-- <div id="OTPsentMsg" style="display:none; margin:10px 0;"></div> -->
                    </div>
                    <div class="submit col-sm-12 text-center">
                        <button class="btn btnSecondary" id="login">Submit</button>
                        <button class="btn btnSecondary" id="verifyOTP" style="display:none;">Verify</button>
                        <!-- Request OTP for Forgot Password -->
                        <button class="btn btnSecondary" id="requestOTPForForgotPassword" style="display:none;"></button>
                        <!-- Submit OTP for Forgot Password -->
                        <button class="btn btnSecondary" id="submitOTPForForgotPassword" style="display:none;"></button>
                        <br>
                        <a style="font-size: 14px; color: #555; padding: 0; margin-bottom: 10px;" href="<?= base_url('forgotPassword'); ?>" id="forgotPassword" class="btn">Forgot password?</a>
                    </div>
                    <div class="or col-sm-12 text-center">
                        <p>OR</p>
                    </div>
                    <div class="col-sm-12 text-center" style="margin-top:10px; margin-bottom: 5px;">
                        <a style="width:100%;" href="<?= base_url('login'); ?>" class="btn btnSecondary">Login via otp</a>
                    </div>
                    <!-- <div class="col-sm-12 text-center or d-flex justify-content-center align-items-center" style="margin-bottom:5px;">
                        <h6 style="font-size:12px; color:#555;">Login with your social account.</h6>
                    </div> -->

                    <div class="col-6 mt10">
                        <a href="<?php echo $this->facebook->loginUrl(); ?>"><button class="btn btnFacebook" id="facebook_login">
                        <i class="fab fa-facebook-f"></i> Facebook</button></a>
                    </div>
                    <div class="col-6 mt10">
                        <a href="<?php echo $this->google->loginUrl(); ?>"><button class="btn btnGmail" id="google_login">
                        <img width="20" src="<?= ASSET_URL ?>imgs/gmail.png"> Gmail</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    $(document).ready(function () {

        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';

        $("#login").on('click', function () { // For Login with password
            var password = $("#password").val();
            var userName = $('input[name="userName"]').val();

            if (userName == '') {
                $("p#errMsg").html('Please enter email/mobile number');
                return false;
            }

            var intRegex = /[0-9 -()+]+$/;
            var emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            if (intRegex.test(userName))
            {
                if ((userName.length < 10) || (!intRegex.test(userName)))
                {
                    $("p#errMsg").html('Please enter valid mobile number');
                    return false;
                }
            } else {

                if (!emailReg.test(userName) || userName === '')
                {
                    $("p#errMsg").html('Please enter valid email/Mobile Number');
                    return false;
                }
            }

            var dataJson = {userName: userName, password: password, 'csrf_test_name': csrf_value};
            var url = 'user/loginWithPassword2';
            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'failed') {
                        $("p#errMsg").html(response.message).show();
                    } else if (response.message == "Welcome") {
                        window.location.href = "<?= BASE_URL; ?>";
                        return;
                    }
                }
            });

        });


        $("#resendOTP").on("click", function () { // For resend OTP
            $("#emailNumberWithOTP").val("");
            $("#resend").hide();
            $("#msg").html("<p style='color:green !important;'>OTP sent successfully</p>").fadeIn().fadeOut(5000);
            sendOTP();
        });


        $("#verifyOTP").on('click', function () {
            var userName = $("#emailNumberForPass").val();
            var otpValue = $("#emailNumberWithOTP").val();
            var dataJson = {userName: userName, otp: otpValue, 'csrf_test_name': csrf_value};

            var url = 'user/checkOtpWithMobileOrEmail';

            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'failed') {
                        if (response.message == 'expired') {
                            $("#successMsg, #emailNumberForPass").hide();
                            $("#changeEmailOrMobile,#OTPsentMsg").show();
                            $("#resend").show();
                        } else
                        {
                            $("#errMsg").html("<p class='text-red'>" + response.message + "</p>").show();
                        }

                    } else {
                        if (response.message == "Welcome") {
                            window.location.href = "<?= BASE_URL; ?>";
                            return;
                        }
                        $("#emailNumberForPass").hide();
                        $("#OTPsentMsg").html(response.message).show();
                        $("#changeEmailOrMobile").show();
                        $("#emailNumberWithOTP").show();
                        $("#errMsg").html('');

                        $("#checkEmailOrNumberExistsOrNot").hide();
                        $("#verifyOTP").show();


                    }
                }
            })
        });


        window.onbeforeunload = function () { // Storing in session for button 'change mobile/email'
            sessionStorage.setItem("emailNumberForPass", $('#emailNumberForPass').val());
        }

        window.onload = function () { // After clicking on button 'change mobile/email'
            var emailNumberForPass = sessionStorage.getItem("emailNumberForPass");
            if (emailNumberForPass !== null)
                $('#emailNumberForPass').val(emailNumberForPass);
        }

        $("#changeEmailOrMobile").on('click', function () {
            location.reload(true);
        });

        $(".openSocialBox").on('click', function () { // For Social Login

            url_for_open = '';
            if ($(this).attr('id') == 'facebook_login') {
                url_for_open = "<?php echo $this->facebook->loginUrl(); ?>";
            } else if ($(this).attr('id') == 'google_login') {
                url_for_open = "<?php echo $this->google->loginUrl(); ?>";
            } else {
                url_for_open = "Sorry, something went wrong, please try again";
            }

            window.open(url_for_open, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=350,width=700,height=500");
        });


        $('input').keypress(function (e) {
            if (e.which === 32)
                return false;
        });

    });



</script>