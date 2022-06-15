<!DOCTYPE html>
<html>
<head>
	<title>Login with password</title>
	<style>
		#showOtpBox, #errMsg, #msg{
			display:none
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
	
	<h3>Login Form</h3>
	<!-- <form id="webLoginForm"> -->
		<input type="text" name="mobile_or_email" placeholder="mobile or email" value="" required><br>
		<div id="showOtpBox"><input type="text" name="password" placeholder="Password" value=""><br><br></div>
		<div id="errMsg" style="color:red;"></div>
		<div id="msg" style="color:blue;"></div>
		<input type="submit" value="Submit" id="submitLoginDetails">
	<!-- </form> -->

	<script>
		$(document).ready(function(){
			var forUrlTrick=0;
			// var is_new_user = false;
			$("#submitLoginDetails").on('click', function(){
				
				mobile_or_email = $("input[name=mobile_or_email]").val();
				password = $("input[name=password]").val();

				url = (forUrlTrick==0) ? 'loginWithPassword' : 'verifyLoginWithPassword';

				if($("input[name=mobile_or_email]").val()=='' || $("input[name=mobile_or_email]").val()==null){
					$("#errMsg").html("<p>Please enter email or mobile number</p>").show();
					return false;
				}else{
					$("#errMsg").html("");
				}

				if(isNaN($("input[name=mobile_or_email]").val())){
					email = $("input[name=mobile_or_email]").val();
					atpos = email.indexOf("@");
					dotpos = email.lastIndexOf(".");
					if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length){
						$("#errMsg").html("<p>Email is not valid</p>").show();
						return false;
					}
				}else{
					if($("input[name=mobile_or_email]").val().length<10 || $("input[name=mobile_or_email]").val().length>10){
						$("#errMsg").html("<p>Mobile number is not valid</p>").show();
						return false;
					}
				}
				
				$.ajax({
					url: url,
					type:'POST',
					data: {mobile_or_email:mobile_or_email, password:password},
					dataType: "JSON",
					success:function(response){
						if(response.status=='failed'){
							$("#errMsg").html("<p>"+response.message+"</p>").show();
							return false;
						}
						
						/*if(response.status=='success' && response.data.new_user==true){
							$("#showOtpBox").show();
							forUrlTrick=1; // trick for url
							is_new_user=true;
						}

						if(response.status=='success' && response.data.new_user==false){
							$("#showOtpBox").show();
							forUrlTrick=1; // trick for url
						}*/

						if(response.status=='success' && response.message=='user created'){
							$("#showOtpBox").show();
							forUrlTrick=1; // trick for url
						}

						if(response.status=='success' && response.message=="Welcome"){
							$(location).attr('href', 'about-us');
						}
					}
				});
			});
		});
	</script>
</body>
</html>