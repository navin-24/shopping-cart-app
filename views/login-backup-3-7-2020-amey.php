<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Login / Signup</h2>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-green" id="otpsent" style="display:none;">
                            <span style="margin:10px 0px;"></span>
                            <a id="changeUserName" style="text-decoration:underline; font-size:12px; padding:0; color:blue; cursor:pointer;">Change</a>
                        </div>
                        <div class="col-sm-12">
                            <input id="userName" name ='userName' type="text" class="form-control" placeholder="Enter Email/Mobile number">
                        </div>
                        <div class="otp col-sm-12">
                            <input id="otp" type="text" class="form-control" placeholder="Enter OTP" maxlength="6" value="" style="display:none">
                        </div>
                    </div>
                    <div class="otp col-sm-12">
                        <p class='resend' id='resend' style='display:none;' ><span style='color:red;'>OTP expired</span>, please request new OTP <span id='resendOTP'> Resend OTP</span></p>
                    </div>
                    <div class="col-sm-12">
                        <p id="errMsg" class='text-red'></p>
                        <p id="msg" class='text-green'></p>
                    </div>
                    <div class="col-sm-12">
                        <p style="margin-top:10px; font-size:11px;">
                            <b style="font-weight: 600;">Note:</b> OTP will be sent to your mobile number. If your number is on the DND list then you will not receive OTP, kindly enter your email id to receive the OTP.
                        </p>
                    </div>
                    <div class="submit col-sm-12">
                        <button class="btn btnSecondary" id="continue">Continue</button>
                        <button class="btn btnSecondary" id="verifyOTP" style="display:none;">Verify</button>
                    </div>
                    <div class="col-sm-12" style="margin-top:10px;">
                        <a href="<?= base_url('loginPassword'); ?>" class="d-block">Login with Password</a>
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

        $("#continue").on('click', function () {
            $("p#errMsg").html('');
            $("p#msg").html('');
            var userName = $('input[name="userName"]').val();
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

            var url = 'user/sendOTP';
            var dataJson = {userName: userName, 'csrf_test_name': csrf_value};

            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'success')
                    {
                        $('input[name="userName"]').hide();
                        $('#continue').hide();
                        $("#otpsent span").html(response.message);
                        $("#otpsent").show();
                        $("#otp").show();
                        $("#verifyOTP").show();
                    } else {
                        $("p#errMsg").html(response.message);
                    }
                }

            });

        });


        $("#changeUserName").on('click', function () {
            var userName = $('input[name="userName"]').val();
            $('#continue').show();
            $("#verifyOTP").hide();
            $('input[name="userName"]').val(userName).show();
            $("#otp").hide();
            $("#otpsent").hide();
        });


        $("#verifyOTP").on('click', function () {
            var userName = $('input[name="userName"]').val();
            var otpValue = $("#otp").val();

            if (otpValue == '') {
                $("p#errMsg").html('Please enter the OTP');
                return false;
            }

            if (otpValue.length < 6)
            {
                $("p#errMsg").html('OTP is invalid');
                return false;
            }

            var dataJson = {'userName': userName, otp: otpValue, 'csrf_test_name': csrf_value};
            var url = 'user/verifyOTP';

            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'failed') {
                        if (response.message == 'expired') {
                            $("#otpsent").hide();
                            $("#resend").show();
                        } else {
                            $("p#errMsg").html(response.message);
                        }
                    }
                    if (response.status == "success") {
                        window.location.replace("<?= BASE_URL; ?>");
                        return;
                    }
                }
            })
        });


        $("#resendOTP").on("click", function () { // For resend OTP
            $("#otp").val("");
            $("#resend").hide();
            var userName = $('input[name="userName"]').val();
            var url = 'user/sendOTP';
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


        $('#otp').keypress(function (event) {

            if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                event.preventDefault(); //stop character from entering input
            }

        });

        $('input').keypress(function (e) {
            if (e.which === 32)
                return false;
        });

    });
</script>