<!DOCTYPE html>
<html>
<head>
	<title>Product City Mapping</title>
	<script type="text/javascript" src="<?= ASSET_URL ?>js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#selectAll").click(function(){
			    $('input:checkbox').prop('checked', true);
			});
			$("#DeSelectAll").click(function(){
			    $('input:checkbox').prop('checked', false);
			});
			$("#ReturnToProduct").click(function(){
				location.replace("<?= BASE_URL('AdminDashboard/productCity');?>");
			});

			$('#frm-product-city').on('submit', function(e){
	            var product_id = $("#product_id").val();
	            if(product_id=='') {
	                alert("Product Id is missing");
	                return false;
	            }
	        });
		});
	</script>
</head>
<body>
	<input type="button" id="ReturnToProduct" value="<< Back To Product List">
	<h2 align="center"> --Product City Mapping-- </h2>
	<form id="frm-product-city" method="POST" align="center" action="<?= BASE_URL('AdminDashboard/updateProductCityMapping'); ?>">
		<input type="hidden" id="product_id" name="product_id" value="<?= $productId; ?>">
		Please Select the city to be mappped for the product:-(<b><?= $product_name ?></b>)<br><br>
		<?php foreach ($cities as $key => $value) { ?>
			<input type="checkbox" name="city[]" <?php if(in_array($key, $sel_cities)){ ?> checked <?php } ?> value="<?= $key ?>"> 
			<label for="city"><?= $value ?></label><br><br>
		<?php } ?>
		<input type="button" id="selectAll"  value="Select All">
		<input type="button" id="DeSelectAll" value="DeSelect All">
		<button type="submit">Submit</button>
	</form>
</body>
</html>