<style>
.dvChooseAdd{cursor: pointer;}
.dvChooseAdd .mb15{margin-bottom:15px;}
.dvChooseAdd .border{border:1px solid #ccc; padding:15px; margin-right:10px; margin-bottom: 15px; text-align:left;}
.dvChooseAdd .bg{background: #eee;}
.dvChooseAdd h6{font-size:14px; font-weight:bold; margin-bottom:6px; line-height: 18px;}
.dvChooseAdd h5{font-family: var(--primary-heading);}
.dvChooseAdd p{color:#777; overflow-wrap: break-word;}
.dvChooseAdd .default{font-weight:bold; color:#555; display:block; margin-top:5px; font-size:12px;}
.dvEnterPincode{display:none;}
.dvPincodeBtn .fa-map-marker-alt{position: relative; top:0; left:0;}
.dvEnterPincode input{margin:0;}
.dvEnterPincode .btn{margin:10px 0;}
.dvEnterPincode .mtb15{margin:10px 0 5px 0;}
.dvPincodeBtn{margin-top:15px;}
.dvPincodeBtn .btn{width:100%;}
.pincodeModal .backBtn{position: absolute;left: 0;top: 0;z-index: 1;background: none;border: 0;padding: 10px;}
</style>

<script type="text/javascript">
function isNumberKey(txt, evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode == 46) {
    if (txt.value.indexOf('.') === -1) {
      return true;
    } else {
      return false;
    }
  } else {
    if (charCode > 31 &&
      (charCode < 48 || charCode > 57))
      return false;
  }
  return true;
}
$(function(){
  $(".allAddress").on("click",function(){
    var name = $(this).attr("data-first_name");
    var city = $(this).attr("data-city");
    var pincode = $(this).attr("data-pincode");
    var address_id = $(this).attr("data-address_id");
    var selected_address = name +" - "+ city +" - "+ pincode;
    var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
      url:"<?= base_url('home/addressCheck'); ?>",
      type:"POST",
      dataType:"json",
      data:{pincode:pincode,selected_address:selected_address,city:city,address_id:address_id,csrf_test_name:csrf_value},
      success: function(res){
        if (res.status == "success") {
          $("#usrPincode").html(selected_address);
          $("#musrPincode").html(selected_address);
          $("#myModal").hide(); 
          location.reload();  
        } else{
          $("#address_err").html(res.msg).css({"color": "red"});
        }
      }
    });
  });
});
$(document).on('click', '.dvPincodeBtn', function(e){
    e.preventDefault();
    $('#pincodeModal').show();
    $('.dvChooseAdd').hide();
    return false;
});
$(document).on('click', '.backBtn', function(e){
    e.preventDefault();
    $("#autocomplete").val('');
    $("#geoinfo").html('');
    $("#address_err").html()
    $('.dvChooseAdd').show();
    $('#pincodeModal').hide();
    return false;
});
</script>
<div class="dvModal">
    <div id="myModal" class="modal" style="display:none;">
        <div class="modal-content modal-center text-center"> 
          <?php
          $this->load->helper('common_helper');
          $allAddress = getAllActiveAdresses($this->session->userdata('logged_in')['customer_id']);
         // echo $allAddress;die;
          if($allAddress!='' && count($allAddress)>0){ ?>
            <div class="dvChooseAdd">
              <div class="d-flex flex-column">
                <div class="mb15">
                  <i class="fas fa-times-circle btn close"></i>
                  <h5>CHOOSE YOUR LOCATION</h5>
                  <p>Select a delivery location to see product availability and delivery options.</p>
                </div>
                <div class="d-flex flex-no-wrap" style="overflow:auto">
                  <?php foreach ($allAddress as $key => $value) { ?>
                    <div class="allAddress col-6 border <?php echo ($this->session->userdata('address_id') == $value['address_id'])?'bg':'';?>" data-address_id="<?php echo $value['address_id'];?>" data-first_name="<?php echo $value['first_name'];?>" data-city="<?php echo $value['city'];?>" data-pincode="<?php echo $value['pincode'];?>">
                      <h6><?php echo $value['first_name']; ?></h6>
                      <p>
                        <?php echo $value['address'].", ".$value['city'].", ".$value['pincode'];?>
                        <?php if($value['is_default_shipping'] == 1) { ?>
                          <span class="default">Default Address</span>
                        <?php } ?>
                      </p>                           
                    </div>
                  <?php } ?>
                </div>
                <p id="address_err"></p>
              </div>
              <div class="dvPincodeBtn">
                <button class="btn">
                  <span><i class="fas fa-map-marker-alt"></i> </span>
                  <span>Enter a Pincode</span>
                </button>
              </div>
            </div>
          <?php } ?>

          <div id="pincodeModal" class="pincodeModal" style="<?php echo ($allAddress!='' && count($allAddress)>0)?'display:none;':'display:block;' ?>">
            <?php if($allAddress!='' && count($allAddress)>0){ ?> 
              <button class="btn backBtn"><i class="fas fa-angle-left"></i> Back</button>
            <?php } ?>  
            <i class="fas fa-times-circle btn pinClose close"></i>
            <h5>FREE DELIVERY, ALWAYS.</h5>
            <p class="content">Please enter your pin code to check if we deliver at your location.</p>
            <form action="">
              <div>
              <input id="autocomplete" type="text" onkeypress="return isNumberKey(this, event);" class="form-control" placeholder="Enter your pincode">
              <!-- <i class="fas fa-map-marker-alt"></i> -->
              <!-- <img class="fa-map-marker-alt hand" src="<?= ASSET_URL ?>imgs/fa-map-marker-alt.png" alt="" onclick="geolocate()"> -->
              <img class="fa-map-marker-alt hand" src="<?= ASSET_URL ?>imgs/fa-map-marker-alt.png" alt="">
              <input type="hidden" name="street_number" id="street_number" value="" /> <!-- Street address -->
              <input type="hidden" name="route" id="route" value="" /> <!-- Street address -->
              <input type="hidden" name="locality" id="locality" value="" /> <!-- City -->
              <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" value="" /> <!-- State -->
              <input type="hidden" name="postal_code" id="postal_code" value="<?= $cookiePincode ?>" /> <!-- Zip code -->
              <input type="hidden" name="country" id="country" value="" /> <!-- Country -->
              <input type="hidden" name="latitude" id="latitude" value="" />
              <input type="hidden" name="longitude" id="longitude" value="" />
              <input type="hidden" name='productid' id='productid' />
              </div>
            </form> 
            <div class="validationCss">
                <div class="loader" id="locationLoader"></div>
                <p id="geoinfo"></p>
              </div>
          </div> 

          <?php 
          $pincode_cookie = $this->input->cookie('pincode_cookie', TRUE);
          
          if ($pincode_cookie == '') { ?>
            <div class="promoCodeModal" id='promoCodeModal'>
                <h5>LET’S BE FRIENDS.</h5>
                <p class="content">Good friends share, everything. So here’s a little secret promo-code, just
                    for you.</p>
                <form action="">
                    <input id="promoEmail" type="text" class="form-control" placeholder="Enter valid email id">
                    <i class="fas fa-envelope"></i>
                </form>
                <div class="validationCss">
                    <div class="loader"></div>
                    <p class="text-red" id="promoEmailTxt"></p>
                </div>
                <button class="btn btnPrimary" id="promoCode">Get Promo Code</button>
            </div>
          <?php } ?>
        </div>
    </div>
</div>
