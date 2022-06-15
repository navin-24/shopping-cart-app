<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Login / Signup</h2>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <!-- <a class="btn" id="changeEmailOrMobile" style="display:none; text-decoration:underline;">Change</a> -->
                            <div class="text-green">
                                <span id="OTPsentMsg" style="display:none; margin:10px 0;"></span>
                                <span id="emailNumberTxt" style="display:none; margin:10px 0;"></span>
                                <a id="changeEmailOrMobile" style="text-decoration:underline; font-size:12px; padding:0; color:blue; display:none; cursor:pointer;">Change</a>

                            </div>
                            <input id="emailNumberForPass" type="text" class="form-control" placeholder="Enter Mobile number" value="">
                        </div>
                        <div class="col-sm-12">
                            <input id="emailNumberWithPass" type="password" class="form-control" placeholder="Enter Password" value="" style="display:none" onkeydown="return notAllowSpaces();">
                        </div>
                        <div class="otp col-sm-12">
                            <input id="emailNumberWithOTP" type="text" class="form-control" placeholder="Enter OTP" maxlength="6" value="" style="display:none" onkeypress="return onlyNumberKey(event)">
                            <p class="text-red" id="otpErr" style="display:none">OTP required</p>
                        </div>

                        <div class="col-sm-12">
                            <input id="newPassword" type="password" class="form-control" placeholder="Enter new password" value="" maxlength="10" style="display:none" onkeydown="return notAllowSpaces();">
                            <p class="text-red" id="newPasswordErr" style="display:none">New password required</p>
                        </div>
                        <div class="otp col-sm-12">
                            <input id="confirmPassword" type="password" class="form-control" placeholder="Enter confirm password" maxlength="10" value="" style="display:none" onkeydown="return notAllowSpaces();">
                            <p class="text-red" id="confirmPasswordErr" style="display:none">Confirm password required</p>
                        </div>
                        <div class="otp col-sm-12">
                            <p class='resend' id='resend' style='display:none;' ><span style='color:red;'>OTP expired</span>, please request new OTP <span id='resendOTP'> Resend OTP</span></p>
                        </div>
                        <div id="newUserMsg" style="display:none;"></div>
                        <div id="errMsg" style="display:none-;"></div>
                        <div id="msg" style="display:none;"></div>
                        <!-- <div id="OTPsentMsg" style="display:none; margin:10px 0;"></div> -->
                    </div>
                    <div class="submit col-sm-12">
                        <button class="btn btnSecondary" id="checkEmailOrNumberExistsOrNot">Submit</button>
                        <button class="btn btnSecondary" id="verifyOTP" style="display:none;">Verify</button>
                        <!-- Request OTP for Forgot Password -->
                        <button class="btn btnSecondary" id="requestOTPForForgotPassword" style="display:none;"></button>
                        <!-- Submit OTP for Forgot Password -->
                        <button class="btn btnSecondary" id="submitOTPForForgotPassword" style="display:none;"></button>
                        <br>
                        <a href="javascript:void(0);" id="forgotPassword" class="btn" style="display:none">Forgot password</a>
                    </div>
                    <div class="col-sm-12" style="margin-top:10px;">
                        <a href="<?= base_url('login_password'); ?>" class="d-block">Login with Password</a>
                    </div>
                    <div class="or col-sm-12">
                        <p>OR</p>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button class="btn btnFacebook openSocialBox" id="facebook_login"><i class="fab fa-facebook-f"></i> FACEBOOK</button>
                        <button class="btn btnGmail openSocialBox" id="google_login"><img width="20" src="<?= ASSET_URL ?>imgs/gmail.png"> GMAIL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    $(document).ready(function () {

        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        var mobile_or_email = $("#emailNumberForPass").val();
        var userExists = false;
        var inOTPstep = false;

        $("#resendOTP").on("click", function () { // For resend OTP
            $("#emailNumberWithOTP").val("");
            $("#resend").hide();
            $("#msg").html("<p style='color:green !important;'>OTP sent successfully</p>").fadeIn().fadeOut(5000);
            sendOTP();
        });

        $("#checkEmailOrNumberExistsOrNot").on('click', function () { // For Login with password
            var userName = $("#emailNumberForPass").val();
            var dataJson = {userName: userName, 'csrf_test_name': csrf_value};

            var url = 'user/sendOTP';

            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'failed') {
                        $("#errMsg").html("<p class='text-red'>" + response.message + "</p>").show();
                    } else {
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


        $("#verifyOTP").on('click', function () {
            var userName = $("#emailNumberForPass").val();
            var otpValue = $("#emailNumberWithOTP").val();
            var dataJson = {mobile_or_email: userName, otp: otpValue, 'csrf_test_name': csrf_value};

            var url = 'user/checkOtpWithMobileOrEmail';

            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'failed') {
                        if (response.message == 'expired') {
                            $("#successMsg,#newUserMsg,#emailNumberForPass").hide();
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

        $("#checkEmailOrNumberExistsOrNot1").on('click', function () { // For Login with password
            var mobile_or_email = $("#emailNumberForPass").val();
            var password = $("#emailNumberWithPass").val();
            var otp_field = $("#emailNumberWithOTP").val();
            var userExist = userExists;
            var data = {mobile_or_email: mobile_or_email, password: password, otp: otp_field, 'csrf_test_name': csrf_value};
            var url = 'checkEmailOrMobileExistsOrNot';

            if (otp_field != '') {
                url = 'checkOtpWithMobileOrEmail';
            }
            if (userExists === true) {
                url = 'verifyLoginWithPassword';
            }
            if (url == 'verifyLoginWithPassword' && password == '' || password == null) {
                $("#errMsg").html("<p class='text-red'>Password field cannot be blank</p>").show();
                return false;
            }
            if (inOTPstep === true && otp_field == '' || otp_field == null) {
                // $("#newUserMsg,#OTPsentMsg").hide();
                $("#newUserMsg").hide();
                $("#OTPsentMsg").show();
                $("#errMsg").html("<p class='text-red'>OTP field cannot be blank</p>").show();
                return false;
            }
            if (validationForEmailOrNumber(mobile_or_email) == true) {
                ajaxFunction('user/' + url, data);
            }

        });

        $('#forgotPassword').on('click', function () {
            $("#errMsg,#forgotPassword,#emailNumberWithPass,#checkEmailOrNumberExistsOrNot").hide();
            $("#requestOTPForForgotPassword").html("Send OTP").show();
        });

        $("#requestOTPForForgotPassword").on('click', function () {
            var mobile_or_email = $("#emailNumberForPass").val();
            // var data = {mobile_or_email:mobile_or_email, 'csrf_test_name': csrf_value};
            otp_type = 'password';
            var data = {mobile_or_email: mobile_or_email, otp_type: otp_type, 'csrf_test_name': csrf_value};
            if (validationForEmailOrNumber(mobile_or_email) == true) {
                ajaxForForgotPassword('user/sendOtpToEmailOrMobile2', data)
            }
        });

        $("#submitOTPForForgotPassword").on('click', function () {
            errFound = false;
            mobile_or_email = $("#emailNumberForPass").val();
            otp_field = $("#emailNumberWithOTP").val();
            newPassword = $("#newPassword").val();
            confirmPassword = $("#confirmPassword").val();

            /*if(otp_field=='' && newPassword=='' && confirmPassword==''){
             $("#OTPsentMsg").hide();
             $("#otpErr,#newPasswordErr,#confirmPasswordErr").show();
             return false;
             }

             if(newPassword!=confirmPassword){
             $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
             $("#errMsg").html("<p class='text-red'>Password not matching</p>").show();
             return false;
             }*/

            if (otp_field == '') {
                $("#OTPsentMsg, #otpErr").show();
                errFound = true;
            }
            if (newPassword == '') {
                $("#OTPsentMsg, #newPasswordErr").show();
                errFound = true;
            }
            if (confirmPassword == '') {
                $("#OTPsentMsg, #confirmPasswordErr").show();
                errFound = true;
            }
            if (newPassword != confirmPassword) {
                $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                $("#errMsg").html("<p class='text-red'>Password not matching</p>").show();
                errFound = true;
            }
            if (otp_field != '') {
                $("#otpErr").hide();
            }
            if (newPassword != '') {
                $("#newPasswordErr").hide();
            }
            if (confirmPassword != '') {
                $("#newPasswordErr").hide();
            }

            if (errFound == false) {
                data = {mobile_or_email: mobile_or_email, otp: otp_field, password: newPassword, confirmPassword: confirmPassword, 'csrf_test_name': csrf_value};
                if (validationForEmailOrNumber(mobile_or_email) == true) {
                    ajaxForForgotPassword('user/passwordUpdate', data)
                }
            }

        });

        function ajaxForForgotPassword(url, data) {

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success: function (res) {

                    if (res.status == 'failed') {
                        if (res.message == 'OTP expired, please request new OTP') {
                            // $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
                            $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                            $("#OTPsentMsg").show();
                            // $("#errMsg").html("<p class='text-red'>"+res.message+"</p>").show();
                            $("#errMsg").html("<p class='resend'><span style='display:inline-block; color:red;'>OTP expired</span>, please request new OTP <span id='resendOTPInForgotPassword'> Resend OTP</span></p>").show();
                            $("#resendOTPInForgotPassword").on("click", function () { // For resend OTP
                                $("#emailNumberWithOTP").val("");
                                $("#msg").html("<p style='color:green !important;'>OTP sent successfully</p>").fadeIn().fadeOut(5000);
                                sendOTP();
                            });
                            return false;
                        } else if (res.message == 'Invalid OTP') {
                            // $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
                            $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                            $("#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + res.message + "</p>").show();
                            return false;
                        } else if (res.message == 'Wrong OTP') {
                            // $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
                            $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                            $("#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + res.message + "</p>").show();
                            return false;
                        } else if (res.message == 'Mobile number is not valid') {
                            // $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
                            $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                            $("#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + res.message + "</p>").show();
                            return false;
                        } else if (res.message == 'Password has been not set') {
                            // $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
                            $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                            $("#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + res.message + ", please try after sometime.</p>").show();
                            return false;
                        } else if (res.message == 'Not a valid email') {
                            // $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
                            $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                            $("#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + res.message + "</p>").show();
                            return false;
                        } else if (res.message == 'Invalid password') {
                            // $("#otpErr, #newPasswordErr, #confirmPasswordErr, #OTPsentMsg").hide();
                            $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                            $("#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + res.message + "</p>").show();
                            return false;
                        } else {
                            // alert(Failed condition not matching with any requirement);
                        }
                    } else if (res.status == 'success') {
                        if (res.message == 'OTP sent') {
                            $("#requestOTPForForgotPassword, #emailNumberForPass").hide();
                            $("#emailNumberWithOTP, #newPassword, #confirmPassword, #submitOTPForForgotPassword").show();
                            $("#submitOTPForForgotPassword").html("Submit");
                            $("#OTPsentMsg").html("Please enter the OTP " + res.otp + " sent to<br>" + $("#emailNumberForPass").val()).show();
                        } else if (res.message == 'Password has been updated successfully') {
                            $("#emailNumberWithOTP,#newPassword,#confirmPassword").val("");
                            $("#requestOTPForForgotPassword,#OTPsentMsg,#submitOTPForForgotPassword,#emailNumberWithOTP,#newPassword,#confirmPassword,#otpErr,#newPasswordErr,#confirmPasswordErr,#emailNumberTxt,#changeEmailOrMobile").hide();
                            $("#msg").html("<p class='text-green'>" + res.message + ". Click <a href='<?php echo site_url("login"); ?>'>here</a> for login.</p>").show();
                        } else {
                            // alert('Success condition not matching with any requirement');
                        }
                    } else {
                        // alert('Success condition not matching with any requirement');
                    }

                }

            });

        }

        function validationForEmailOrNumber(mobile_or_email) {

            if (mobile_or_email == '' || mobile_or_email == null) {
                $("#errMsg").html("<p class='text-red'>Please enter email or mobile number</p>").show();
                return false;
            } else {
                $("#errMsg").html("");
            }

            if (isNaN(mobile_or_email)) {
                atpos = mobile_or_email.indexOf("@");
                dotpos = mobile_or_email.lastIndexOf(".");
                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= mobile_or_email.length) {
                    $("#errMsg").html("<p class='text-red'>Email is not valid</p>").show();
                    return false;
                }
            } else {
                if (mobile_or_email.length < 10 || mobile_or_email.length > 10) {
                    $("#errMsg").html("<p class='text-red'>Mobile number is not valid</p>").show();
                    return false;
                }
            }

            return true;
        }

        function sendOTP() {
            var mobile_or_email = $("#emailNumberForPass").val();
            var data = {mobile_or_email: mobile_or_email, 'csrf_test_name': csrf_value};
            if (validationForEmailOrNumber(mobile_or_email) == true) {
                ajaxFunction('user/sendOtpToEmailOrMobile2', data);
            }
        }

        function ajaxFunction(url, data) {

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                dataType: "JSON",
                success: function (response) {

                    if (response.status == 'failed') {
                        if (response.message == 'User not available') {

                            if (response.otp_msg == 'success') {
                                $("#emailNumberWithPass,#emailNumberForPass").hide();
                                $("#changeEmailOrMobile, #emailNumberWithOTP").show();
                                $("#OTPsentMsg").html("Please enter the OTP " + response.otp + " sent to<br>").show();
                                $("#emailNumberTxt").html($("#emailNumberForPass").val()).show();
                                $("#checkEmailOrNumberExistsOrNot").html('Login with OTP');
                                inOTPstep = true;
                            } else {
                                $("#errMsg").html("<p class='text-red'>" + response.message + "</p>").show();
                            }

                        } else if (response.message == 'Inactive user') {
                            $("#errMsg").html("<p class='text-red'>" + response.message + "</p>").show();
                        } else if (response.message == 'Invalid password') {
                            $("#errMsg").html("<p class='text-red'>" + response.message + "</p>").show();
                        } else if (response.message == 'Blank password') { // please check this condition for existing user with blank password in email
                            $("#emailNumberWithPass").hide();
                            // $("#emailNumberWithOTP").show();
                            sendOTP();
                            $("#checkEmailOrNumberExistsOrNot").html('Login with OTP');
                            inOTPstep = true;
                        } else if (response.message == 'OTP not sent') {
                            $("#changeEmailOrMobile").show();
                            // $("#msg,#successMsg,#newUserMsg").hide();
                            $("#msg,#successMsg,#newUserMsg,#OTPsentMsg").hide();
                            $("#errMsg").html("<p class='text-red'>" + response.message + ", please try again after sometime</p>").show();
                            inOTPstep = true;
                            // } else if (response.message=='OTP should be numeric and 6 digits') {
                        } else if (response.message == 'Invalid OTP') {
                            $("#changeEmailOrMobile").show();
                            // $("#msg,#successMsg,#newUserMsg").hide();
                            // $("#msg,#successMsg,#newUserMsg,#OTPsentMsg").hide();
                            $("#msg,#successMsg,#newUserMsg").hide();
                            $("#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + response.message + "</p>").show();
                            inOTPstep = true;
                        } else if (response.message == 'Wrong OTP') {
                            // $("#msg,#successMsg,#newUserMsg").hide();
                            // $("#msg,#successMsg,#newUserMsg,#OTPsentMsg").hide();
                            $("#msg,#successMsg,#newUserMsg").hide();
                            $("#changeEmailOrMobile,#OTPsentMsg").show();
                            $("#errMsg").html("<p class='text-red'>" + response.message + "</p>").show();
                            inOTPstep = true;
                        } else if (response.message == 'OTP expired, please request new OTP') {
                            // $("#successMsg,#newUserMsg,#emailNumberForPass,#OTPsentMsg").hide();
                            $("#successMsg,#newUserMsg,#emailNumberForPass").hide();
                            $("#changeEmailOrMobile,#OTPsentMsg").show();
                            $("#errMsg").html("<p class='resend'><span style='display:inline-block; color:red;'>OTP expired</span>, please request new OTP <span id='resendOTP'> Resend OTP</span></p>").show();
                            $("#resendOTP").on("click", function () { // For resend OTP
                                $("#emailNumberWithOTP").val("");
                                $("#msg").html("<p style='color:green !important;'>OTP sent successfully</p>").fadeIn().fadeOut(5000);
                                sendOTP();
                            });
                            inOTPstep = true;
                        } else {
                            alert('Failed condition not matching with any requirement');
                            return false;
                        }
                    } else if (response.status == 'success') {
                        if (response.message == "OTP sent") {
                            $("#changeEmailOrMobile, #emailNumberWithOTP").show();
                            $("#emailNumberWithPass,#emailNumberForPass").hide();
                            $("#OTPsentMsg").html("Please enter the OTP " + response.otp + " sent to<br>").show();
                            $("#emailNumberTxt").html($("#emailNumberForPass").val()).show();
                            // timerForOTPExpire(response.message);
                            inOTPstep = true;
                        } else if (response.message == "Welcome") {
                            $(location).attr('href', '<?php echo $this->login_history_lib->redirectAfterLogin(); ?>');
                        } else if (response.message == "Yes user exists") {
                            // $("#emailNumberWithPass").show();
                            $("#emailNumberWithPass,#forgotPassword").show();
                            $("#emailNumberForPass").prop('disabled', true);
                            userExists = true;
                        } else {
                            /*alert('Success condition not matching with any requirement');
                             return false;*/
                        }
                    } else {
                        alert('Something went wrong, sorry please try again!');
                        return false;
                    }

                }
            });
        }

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


        function timerForOTPExpire(msg) {

            var timeLeft = 300;
            var parentElem = document.getElementById('OTPsentMsg');
            parentElem.style.display = "block";
            var elem = document.getElementById('some_div');
            var timerId = setInterval(countdown, 500);

            function countdown() {
                if (timeLeft == -1) {
                    clearTimeout(timerId);
                    doSomething();
                } else {
                    // elem.innerHTML = 'OTP sent. ' + timeLeft + ' seconds left';
                    parentElem.innerHTML = "<p class='text-green'><span id='some_div'>" + msg + ". " + timeLeft + " seconds left</span></p>";
                    timeLeft--;
                }
            }

        }

        function notAllowSpaces() {
            if (event.keyCode == 32) {
                return false;
            }
        }

        function onlyNumberKey(evt) {
            // Only ASCII charactar in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }

    });

</script>