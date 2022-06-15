<!DOCTYPE html>
<html>
<head>
	<title>Add PinCode</title>
	<script type="text/javascript" src="<?= ASSET_URL ?>js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#ReturnToPinCodeList").click(function(){
				location.replace("<?= BASE_URL('AdminDashboard/pincode');?>");
			});
			$('#frm_addPin').on('submit', function(e){
	            if($("#pin_file_upload").val()=='') {
	                alert("Please Upload file and then submit");
	                return false;
	            }else{
	            	var allowed_extensions = ["csv"];
				    var file_extension = $("#pin_file_upload").val().split('.').pop().toLowerCase();
				    if(allowed_extensions.indexOf(file_extension) == -1){
				    	alert("Please Upload CSV files");
				    	return false;
				    }
	            }
	        });
		});
	</script>
</head>
<body>
	<input type="button" id="ReturnToPinCodeList" value="<< Back To Pincode List">
	<h2 align="center"> --Upload PinCode File-- </h2>
	<form id="frm_addPin"align="center" enctype="multipart/form-data" action="<?= BASE_URL('AdminDashboard/insertPinCode'); ?>" method="POST">
		<input type="file" id="pin_file_upload" name="pin_file_upload">
		<button type="submit">Add</button>
	</form>
</body>
</html>