Redirecting..
<form id="redirectForm" method="post" action="<?php echo $redirectUrl;?>">
<?php foreach ($postData as $key => $value) { ?>
   <input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>"/>
  <?php } ?>
</form>
<script type="text/javascript">
 document.getElementById("redirectForm").submit();
</script>