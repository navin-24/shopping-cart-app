<!DOCTYPE html>
<html>
<head>
	<title>My login form</title>
	<style>
		#showOtpBox, #errMsg, #msg, #submitLoginDetails{
			display:none
		}
		.cursor-pointer{
			cursor:pointer;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

	<br><br>
	<h3>Login Form</h3>
	<div style="width:100%">
	<input type="text" name="mobile_or_email" placeholder="mobile or email" value="<?php echo $this->input->get_post('mobile_or_email'); ?>" required>
	<input type="button" value="GetOTP" id="getOTP"> <span id="msg" style="display:inline-block; color:green; width:10%;"></span>
	</div>
	
	<br><br>

	<div id="showOtpBox"><input type="text" name="otp" placeholder="Otp" value=""> <input type="button" value="Submit" id="submitLoginDetails"><br><br></div>
	<div id="errMsg" style="color:red;"></div>
	

	<br><br>
	<br><br>
	<div>
		<!-- <a href="<?php // echo $this->facebook->loginUrl(); ?>" class="open">Facebook Login</a> | <a href="<?php // echo $this->google->loginUrl(); ?>">Google Login</a> -->

		<img class="cursor-pointer openSocialBox" src="assets/imgs/social-icons/google-login.png" width="40" height="40" id="google_login"> 
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<img class="cursor-pointer openSocialBox" src="assets/imgs/social-icons/facebook-login.png" width="40" height="40" id="facebook_login">

	</div>
		
	<script>
		
		$(document).ready(function(){
			var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
			$("#getOTP").on('click', function(){
				var mobile_or_email = $("input[name=mobile_or_email]").val();
				var data = {mobile_or_email:mobile_or_email, 'csrf_test_name': csrf_value};

				if(validationForEmailOrNumber(mobile_or_email)==true){
					ajaxFunction('user/sendOtpToEmailOrMobile2', data);
				}
				
			});

			$("#submitLoginDetails").on('click', function(){
				var mobile_or_email = $("input[name=mobile_or_email]").val();
				var otp_field = $("input[name=otp]").val();
				var data = {mobile_or_email:mobile_or_email, otp:otp_field, 'csrf_test_name': csrf_value};

				if(otp_field==null || otp_field==''){
					$("#errMsg").html("<p>OTP field cannot be blank</p>").show();
					return false;
				}

				if(validationForEmailOrNumber(mobile_or_email)==true){
					ajaxFunction('user/checkOtpWithMobileOrEmail', data);	
				}
				
			});
			
			function validationForEmailOrNumber(mobile_or_email){

				if(mobile_or_email=='' || mobile_or_email==null){
					$("#errMsg").html("<p>Please enter email or mobile number</p>").show();
					return false;
				}else{
					$("#errMsg").html("");
				}

				if(isNaN(mobile_or_email)){
					atpos = mobile_or_email.indexOf("@");
					dotpos = mobile_or_email.lastIndexOf(".");
					if(atpos<1 || dotpos<atpos+2 || dotpos+2>=mobile_or_email.length){
						$("#errMsg").html("<p>Email is not valid</p>").show();
						return false;
					}
				}else{
					if(mobile_or_email.length<10 || mobile_or_email.length>10){
						$("#errMsg").html("<p>Mobile number is not valid</p>").show();
						return false;
					}
				}

				return true;
			}

			function ajaxFunction(url, data){
				$.ajax({
					url: url,
					type:'POST',
					data: data,
					dataType: "JSON",
					success:function(response){
						if(response.status=='failed'){
							$("#errMsg").html("<p>"+response.message+"</p>").show();
							return false;
						}
						if(response.status=='success' && response.message=="OTP sent"){
							$("#showOtpBox").show();
							$("#submitLoginDetails").show();
							// $("#getOTP").prop('disabled',true);
							$("#getOTP").css({backgroundColor:"lightgray"});
							$("#msg").html("<p>"+response.message+"</p>").fadeIn().fadeOut(5000);
						}
						if(response.status=='success' && response.message=="Welcome"){
							$(location).attr('href', 'about-us');
						}
					}
				});
			}

			$(".openSocialBox").on('click', function(){

				url_for_open = '';
				if($(this).attr('id')=='facebook_login'){
					url_for_open = "<?php echo $this->facebook->loginUrl(); ?>";
				} else if ($(this).attr('id')=='google_login'){
					url_for_open = "<?php echo $this->google->loginUrl(); ?>";
				} else {
					url_for_open = "Sorry, something went wrong, please try again";
				}

				window.open(url_for_open,"_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=350,width=700,height=500");
			});

		});

	</script>
</body>
</html>