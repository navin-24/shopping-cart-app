<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Forgot Password</h2>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-green" id="otpsent" style="display:none;">
                            <span style="margin:10px 0px;"></span>
                            <a id="changeUserName" style="text-decoration:underline; font-size:12px; padding:0; color:blue; cursor:pointer;">Change</a>
                        </div>
                        <div class="col-sm-12">
                            <input id="userName" name="userName" type="text" class="form-control" placeholder="Enter Email/Mobile number" value="">
                        </div>
                        <div class="otp col-sm-12">
                            <input id="otp" type="text" class="form-control" placeholder="Enter OTP" maxlength="6" value="" style="display:none" onkeypress="return onlyNumberKey(event)">
                            <p class="text-red" id="otpErr" style="display:none">OTP required</p>
                        </div>
                        <div class="col-sm-12">
                            <input id="newPassword" type="password" class="form-control" placeholder="Enter new password" value="" maxlength="10" style="display:none">
                            <p class="text-red" id="newPasswordErr" style="display:none">New password required</p>
                        </div>
                        <div class="otp col-sm-12">
                            <input id="confirmPassword" type="password" class="form-control" placeholder="Enter confirm password" maxlength="10" value="" style="display:none">
                            <p class="text-red" id="confirmPasswordErr" style="display:none">Confirm password required</p>
                        </div>
                        <div class="otp col-sm-12">
                            <p class='resend' id='resend' style='display:none;' ><span style='color:red;'>OTP expired</span>, please request new OTP <span id='resendOTP'> Resend OTP</span></p>
                        </div>
                        <p id="errMsg" class='text-red'></p>
                        <p id="msg" class='text-green'></p>
                    </div>
                    <div class="submit col-sm-12">
                        <button class="btn btnSecondary" id="forgotPassword">Submit</button>
                        <button class="btn btnSecondary" id="changepassword" style="display:none;">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    $(document).ready(function () {

        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';

        $("#forgotPassword").on('click', function () { // For Login with password
            $("p#msg").html('');
            $("p#errMsg").html('');

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
                    $("p#errMsg").html('Please enter valid email');
                    return false;
                }
            }

            var dataJson = {userName: userName, 'csrf_test_name': csrf_value};
            var url = '<?= base_url('user/sendOTP') ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'success') {
                        $("p#msg").html(response.message).show();
                        $("#userName, #forgotPassword ").hide();
                        $("#otp, #newPassword, #confirmPassword, #changepassword").show();
                    } else {
                        $("p#errMsg").html(response.message).show();
                    }
                }
            });

        });


        $("#resendOTP").on("click", function () { // For resend OTP
            $("#otp").val("");
            $("#resend").hide();
            var userName = $('input[name="userName"]').val();
            var url = '<?= base_url('user/sendOTP') ?>';
            var dataJson = {'userName': userName, 'resend': '1', 'csrf_test_name': csrf_value};

            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'success')
                    {
                        $("p#msg").html(response.message).fadeOut(5000);
                    } else {
                        $("p#errMsg").html(response.message);
                    }
                }

            });
        });

        $("#changepassword").on('click', function () {
            $("p#msg").html('');
            $("p#errMsg").html('');
            errFound = false;
            
            var userName = $('input[name="userName"]').val();
            var otp = $("#otp").val();
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();

            if (otp == '') {
                $("#otpErr").show();
                errFound = true;
            } else {
                $("#otpErr").hide();
            }

            if (newPassword == '') {
                $("#newPasswordErr").show();
                errFound = true;
            } else {
                $("#newPasswordErr").hide();
            }

            if (confirmPassword == '') {
                $("#confirmPasswordErr").show();
                errFound = true;
            } else {
                $("#confirmPasswordErr").hide();
            }

            if (confirmPassword !== '' && newPassword !== '' && newPassword != confirmPassword) {
                $("#otpErr, #newPasswordErr, #confirmPasswordErr").hide();
                $("p#errMsg").html("Password & confirm Password are not matching").show();
                errFound = true;
            }

            if (errFound)
            {
                return;
            } else {
                data = {userName: userName, otp: otp, password: newPassword, confirmPassword: confirmPassword, 'csrf_test_name': csrf_value};

                $.ajax({
                    url: '<?= base_url('user/passwordUpdate') ?>',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.status == 'failed') {
                            if (response.message == 'expired') {
                                $("#otpsent").hide();
                                $("#resend").show();
                            } else {
                                $("p#errMsg").html(response.message);
                            }
                        } else {

                            if (response.message == 'Password has been updated successfully') {
                                $("p#msg").html(response.message + ". Click <a href='<?php echo site_url("loginPassword"); ?>'>here</a> for login.").show();
                            } else {
                                $("p#msg").html(response.message);
                            }
                        }
                    }
                });
            }

        });

    });

    $('#otp').keypress(function (event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault(); //stop character from entering input
        }
    });
    
     $('input').keypress(function (e) {
            if (e.which === 32)
                return false;
        });

</script>