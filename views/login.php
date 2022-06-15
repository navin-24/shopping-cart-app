<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>Login / Signup</h2>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-green text-center" id="otpsent" style="display:none;">
                            <span style="margin:10px 0px;"></span>
                            <a id="changeUserName" style="text-decoration:underline; font-size:12px; padding:0; color:blue; cursor:pointer;">Change</a>
                        </div>
                        <div>
                            <input id="userName" name ='userName' type="text" class="form-control" placeholder="Enter Email or Mobile Number to get OTP">
                        </div>
                        <div class="otp col-sm-12">
                            <input id="otp" type="text" class="form-control" placeholder="Enter OTP" maxlength="6" value="" style="display:none">
                        </div>
                    </div>
                    <div class="otp col-sm-12">
                        <p class='resend' id='resend' style='display:none;' ><span style='color:red;'>OTP expired</span>, please request new OTP <span id='resendOTP'> Resend OTP</span></p>
                    </div>
                    <div class="col-sm-12">
                        <p id="errMsg" class='text-red text-center'></p>
                        <p id="msg" class='text-green'></p>
                    </div>
                    <div class="col-sm-12 text-center">
                        <p style="margin-top:10px; font-size:12px; color:#555;">
                            <b style="font-weight: 600;">Note:</b> OTP will be sent to your mobile number. If your number is on the DND list then you will not receive OTP, kindly enter your email id to receive the OTP.
                        </p>
                    </div>
                    <div class="submit col-6 offset-3 text-center" style="margin-bottom:4px;">
                        <button class="btn btnSecondary" id="continue">Request OTP</button>
                        <button class="btn btnSecondary" id="verifyOTP" style="display:none;">Verify</button>
                    </div>
                    <div class="or col-sm-12 text-center">
                        <p>OR</p>
                    </div>
                    <div class="col-sm-12 text-center" style="margin-top:10px; margin-bottom: 5px;">
                        <a style="width:100%;" href="<?= base_url('loginPassword'); ?>" class="btn btnSecondary">Login with Email</a>
                    </div>
                    
                    <!-- <div class="col-sm-12 text-center or d-flex justify-content-center align-items-center">
                        <h6>Login/Signup with your social account.</h6>
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
    <div class="container d-none">
        <div class="row">
            <div class="dvLoginSignupTab col-sm-12">
                <div id="dvTab" class="row">
                    <div class="col-sm-12 text-center">
                        <h4>Login / Signup</h4>
                    </div>
                    <div class="col-sm-12 col-lg-4 offset-lg-4">
                        <div class="bg">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="tabs d-flex justify-content-center">
                                        <li id="defaultOpen" class="tablinks active" onclick="myTabs(event, 'login')">Login</li>
                                        <li class="tablinks" onclick="myTabs(event, 'signup')"><span class=" d-lg-inline-block">Sign Up</li>
                                    </ul>
                                </div>
                                <div class="col-lg-12">
                                    <div id="login" class="tabcontent">
                                        <div class="row">
                                            <div class="col-sm-12 mt10">
                                                <input type="text" class="form-control" placeholder="Email Id">
                                            </div>
                                            <div class="col-12">
                                                <p class="text-red">This field is required.</p>
                                            </div>
                                            <div class="col-sm-12 mt10">
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="col-12">
                                                <p class="text-red">This field is required.</p>
                                            </div>
                                            <div class="col-sm-12 text-lg-center mt10">
                                                <button class="btn btnSecondary">Login</button>
                                                <span class="fp d-lg-block">Forgot your password?</span>
                                            </div>
                                            <div class="col-sm-12 text-center or or2 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <h6>Or</h6>
                                            </div>
                                            <div class="col-sm-12 text-center or d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <h6>Signup with your social account.</h6>
                                            </div>
                                            <div class="col-6 col-lg-12 mt10">
                                                <button class="btn btnFacebook" id="facebook_login">
                                                <i class="fab fa-facebook-f"></i> Facebook</button>
                                            </div>
                                            <div class="col-6 col-lg-12 mt10">
                                                <button class="btn btnGmail" id="google_login">
                                                <img width="20" src="http://localhost/rawpressery/assets/imgs/gmail.png"> Gmail</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="signup" class="tabcontent">
                                        <div class="row">
                                            <div class="col-sm-12 mt10">
                                                <input type="text" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="col-12">
                                                <p class="text-red">This field is required.</p>
                                            </div>
                                            <div class="col-sm-12 mt10">
                                                <input type="text" class="form-control" placeholder="Email Id">
                                            </div>
                                            <div class="col-12">
                                                <p class="text-red">This field is required.</p>
                                            </div>
                                            <div class="col-sm-12 mt10">
                                                <input type="text" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="col-12">
                                                <p class="text-red">This field is required.</p>
                                            </div>
                                            <div class="col-sm-12 mt10">
                                                <input type="text" class="form-control" placeholder="Confirm Password">
                                            </div>
                                            <div class="col-12">
                                                <p class="text-red">This field is required.</p>
                                            </div>
                                            <div class="col-sm-12 text-lg-center mt10">
                                                <button class="btn btnSecondary">Sign Up</button>
                                            </div>
                                            <div class="col-sm-12 text-center or or2 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <h6>Or</h6>
                                            </div>
                                            <div class="col-sm-12 text-center or d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <h6>Signup with your social account.</h6>
                                            </div>
                                            <div class="col-6 col-lg-12 mt10">
                                                <button class="btn btnFacebook" id="facebook_login">
                                                <i class="fab fa-facebook-f"></i> Facebook</button>
                                            </div>
                                            <div class="col-6 col-lg-12 mt10">
                                                <button class="btn btnGmail" id="google_login">
                                                <img width="20" src="http://localhost/rawpressery/assets/imgs/gmail.png"> Gmail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
$("p#errMsg").html('Please enter valid email/Mobile Number');
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
<script>
function myTabs(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>