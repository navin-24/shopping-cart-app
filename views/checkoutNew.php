<?php
$customer_id = $this->session->userdata('logged_in')['customer_id'];
?>
<section class="dvCheckout">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 order-1 order-lg-2 cartItems">
                <div class="row">
                <div class="col-sm-12 d-lg-none">
                    <a href="<?php echo base_url() . 'shop/cart'; ?>" class="returnCart"><i class="fas fa-angle-left"></i> Return to Cart</a>
                </div>
                <hr>
                    <div class="clickPanel col-sm-12 d-flex justify-content-between align-items-center d-lg-none">
                        <button class="btn"><span>Show Order Summary</span> <i class="fas fa-angle-down"></i></button>
                        <span class="grandTotalInMobile"><!-- <i class="fas fa-rupee-sign"></i>1,700.00 --></span>
                    </div>
                    <div class="openPanel col-sm-12">
                        <div class="bg-white">
                            <div class="row">
                                <div class="col-sm-12 d-none d-lg-block">
                                    <h4>Order Summary</h4>
                                </div>
                                    <!-- <div class="row"> -->
                                        <div class="scrollbar col-sm-12" id="showOrderSummary">
                                            
                                        </div>
                                    <!-- </div> -->
                                
                                <div class="applyCoupon col-sm-12">
                                    <div class="d-flex justify-content-between">
                                        <input type="text" name="inputCoupon" id="inputCoupon" class="form-control" placeholder="Enter Coupon Code">
                                        <button class="btn btnSecondary" id="getCouponDetails">Apply</button>
                                    </div>
                                    <div class="text-center">
                                        <div id="removeCouponDiv" style="display:none !important;">
                                            <div class="coupon d-flex justify-content-between align-items-center" id="removeCouponBox" style="display:none !important;">
                                                <span class="name" id="appliedCouponCode"></span>
                                                <span id="removeCoupon"><i class="fas fa-times-circle"></i></span>
                                            </div>
                                            <p class="text-green">Coupon code applied successfully.</p>
                                        </div>
                                        <p class="text-red" id="couponRedMsg" style="display:none;"></p>
                                        <p class="text-green" id="couponGreenMsg" style="display:none;"></p>
                                    </div>
                                </div>
                                <div class="grandTotal col-sm-12">
                                    <div class="d-flex justify-content-between">
                                        <span>Subtotal</span>
                                        <span id="subtotalValue"></span>
                                    </div>
                                    <div class="c-discount d-flex justify-content-between discountDiv" id="colorGreenOrBlack" style="display:none;">
                                        <span id="discountTxt"></span>
                                        <span id="discountValue"></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Delivery</span>
                                        <span class="deliveryValue"></span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span><b>Grand Total</b></span>
                                        <span id="grand_total"></span>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btnSecondary d-none d-lg-block" id="placeOrder">Place Order</button>
                                    </div>
                                    <!-- Below <P> tag for showing success/error messages -->
                                    <p class="text-red" id="placeOrderMsg" style="text-align:center;margin:10px 0;display:none;"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                </div>
            </div>
            <div class="col-lg-7 order-2 order-lg-1">
                <div class="row">
                    <div class="dvOtp col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 d-none d-lg-block">
                                <a href="" class="returnCart"><i class="fas fa-angle-left"></i> Return to Cart</a>
                            </div>
                            <?php
                            if($customer_id==null && $customer_id==''){ // Login hide/show
                            ?>
                            <div class="col-sm-12 loginOtp">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Login via OTP</h4>
                                    <span class="login">Have an account? <span>Login</span></span>
                                </div>
                                <div class="getOTP" style="margin-bottom:10px;">
                                    <div class="d-flex justify-content-between align-items-stretch">
                                        <input type="text" class="form-control" name="mobile_or_email" id="mobile_or_email" placeholder="Enter Email/Mobile number">
                                        <button class="btn btnSecondary" id="getOTP">GET OTP</button>
                                    </div>
                                   <!--  <p class="text-red">Invalid Email</p>
                                    <p class="text-red">Invalid Phone Number</p>
                                    <p class="text-green">Success</p> -->
                                </div>
                                <div class="submitOTP" id="showOtpBox" style="display:none;">
                                    <div class="d-flex justify-content-between align-items-stretch">
                                        <input type="text" name="otp" class="form-control" placeholder="Enter 6 digit OTP" maxlength="6" value="" onkeypress="return onlyNumberKey(event)">
                                        <button class="btn btnSecondary" id="submitLoginDetails">SUBMIT</button>
                                    </div>
                                    <!-- <p class="resend">Didn't receive the OTP? <span>Resend OTP</span></p>
                                    <p class="text-green">OTP sent successfully. <span id="some_div"></span></p>
                                    <p class="text-red">Invalid OTP</p> -->                                    
                                </div>
                                <p class="text-red" id="errMsg"></p>
                                <p class="text-green" id="msg"></p>
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($customer_id!=null && $customer_id!=''){
                            ?>
                            <div class="col-sm-12 enterEmail">
                                <?php
                                    $textForMobileEmail=null;
                                    if($customer['email']==null && $customer['email']==''){
                                       $textForMobileEmail='Email'; 
                                    }
                                    if($customer['mobile_number']==null && $customer['mobile_number']==''){
                                        $textForMobileEmail='Mobile';
                                    }
                                    if($customer['mobile_number']==null && $customer['mobile_number']=='' || $customer['email']==null && $customer['email']==''){
                                ?>
                                <h4>Enter <?php echo $textForMobileEmail; ?></h4>
                                <div class="d-flex justify-content-between align-items-stretch">
                                    <input type="text" class="form-control" name="email_or_mobile" id="email_or_mobile" placeholder="Enter Your <?php echo $textForMobileEmail; ?>" value="">
                                    <!-- <button class="btn btnSecondary">SUBMIT</button> -->
                                </div>
                                <p class="text-red" id="emailMobileErr" style="display:none"></p>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="dvShippingAddress col-sm-12">
                        <h4>Shipping Address</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="First Name*">
                                <p class="text-red">Atleast 6 characters</p>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="Last Name*">
                                <p class="text-red">Atleast 6 characters</p>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" placeholder="Flat No, Building, Street, Area*">
                                <p class="text-red">Address required</p>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" placeholder="City*">
                                <p class="text-red">City required</p>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" placeholder="Mobile*">
                                <p class="text-red">Only Numbers please</p>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" placeholder="Pincode*">
                                <p class="text-red">Pincode required</p>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btnSecondary">Save</button>
                                <label><input type="checkbox"> Mark this address as Default.</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="dvSavedAddress col-sm-12">
                        <div class="row">
                            <?php
                            if($default_address['address']!=null){
                            ?>
                            <div class="col-sm-12 d-flex justify-content-between align-items-center">
                                <h4>Deliver Here</h4>
                                <button class="btn editA" style="display:none;"><i class="fas fa-plus"></i> Add Address</button>
                            </div>
                            <div class="col-12 d-flex">
                                <div class="bg-grey d-flex flex-column justify-content-between">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5><!-- Default --> Address</h5> 
                                        <!-- <div class="dot dot-default"></div> -->
                                    </div>
                                    <p>
                                        <span><?php echo $default_address['first_name'] . ' ' . $default_address['last_name']; ?>,</span>
                                        <br>
                                        <span><?php echo $default_address['address'] . ' ' . $default_address['city'] . ' ' . $default_address['pincode']; ?></span>
                                    </p>
                                    <!-- <div class="d-flex justify-content-between">
                                        <span class="edit"><i class="fas fa-edit"></i> Edit</span>
                                        <span class="delete"><i class="far fa-trash-alt"></i> Delete</span>
                                    </div> -->
                                </div>
                            </div>

                            <!-- below hidden field for validation purpose while doing place order -->
                            <input type="hidden" name="customerAddressId" id="customerAddressId" value="<?php echo $default_address['address_id']; ?>">
                            <?php
                            }
                            ?>
                            <div class="changeAdd col-sm-12" style="margin:20px 0;">
                                <?php $addressBtnTxt = ($default_address['address']!=null)?'Change/Add Address':'Add Address';?>
                                <button class="btn btnSecondary" id="goToAddressPage">
                                    <?php echo $addressBtnTxt; ?>
                                </button>
                            </div>
                            <!-- <div class="col-sm-12 text-center">
                                <button class="btn showMore">Show More Addresses <span class="d-block"><i class="fas fa-angle-down"></i></span></button>
                            </div> -->
                        </div>
                    </div>
                    <div class="dvDeliveryInstruction col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-between align-items-center">
                                <h4>Delivery Instructions</h4>
                            </div>
                            <div class="col-sm-12 d-flex">
                                <div class="row">
                                    <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Hand Delivered"> Hand Delivered.</label></div>
                                    <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Hand it over to the security"> Hand it over to the security.</label></div>
                                    <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Do not ring the Bell, leave the juice outside"> Do not ring the Bell, leave the juice outside.</label></div>
                                    <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Ring the Bell and leave the juice outside"> Ring the Bell and leave the juice outside.</label></div>
                                    <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Anything else"> Anything else.</label></div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <?php
                    } // (if condition) end for $customer_id
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br> -->
    <div class="loginToProceed col-12 d-lg-none">
            <div class="container">
                <div class="row">
                    <div class="amt grandtotal col d-flex align-items-center justify-content-start">
                        <!-- <sup><i class="fas fa-rupee-sign"></i></sup> --> <span id="grandTotalInMobile"></span>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end">
                        <button class="btn btnPrimary" id="mobileBtnForPlaceOrder">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- <input type="button" value="showModal" id="showModal"> -->
<div class="dvModal" id="dvModal">
    <div id="modalBox" class="modal alertModal">
        <div class="modal-content modal-sm d-lg-block">
            <div class="alert">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="content" id="msgInModalBox"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btnBlackBorder" id="ok_reload">OK</button>
                        <button class="btn btnBlackBorder" id="cancel_reload" style="display:none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
var url = "<?php echo site_url(''); ?>";
var customer_id = "<?php echo $customer_id; ?>";
var appliedCouponCode = coupon_code = null;
var applyCouponBtn = removeCouponCode = false;

$("#getOTP").on('click', function(){
    $("input[name=otp]").val(""); // OTP box should be blank 
    var mobile_or_email = $("input[name=mobile_or_email]").val();
    var data = {mobile_or_email:mobile_or_email, 'csrf_test_name': csrf_value};

    if(validationForEmailOrNumber(mobile_or_email)==true){
        ajaxFunction(url + 'user/sendOtpToEmailOrMobile2', data);
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
        ajaxFunction(url + 'user/checkOtpWithMobileOrEmail', data);
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

$("#getCouponDetails").on('click', function(){
    applyCouponBtn = true;
    coupon_code = $("#inputCoupon").val();

    if(coupon_code=='' || coupon_code==null){
        $("#couponRedMsg").html('Please enter coupon code').show();
        return false;
    }

    getCartItems2(coupon_code);

});

$("#removeCoupon").on('click', function(){
    removeCouponCode = true;
    getAppliedCouponCode = appliedCouponCode;

    // alert(getAppliedCouponCode);

    if(getAppliedCouponCode=='' || getAppliedCouponCode==null){
        $("#couponRedMsg").html('There is no applied coupon we found.').show();
        return false;
    }

    getCartItems2(getAppliedCouponCode);

});

function ajaxFunction(url, data){
    $.ajax({
        url: url,
        type:'POST',
        data: data,
        dataType: "JSON",
        success:function(response){
            if(response.status=='failed'){
                if (response.message=='OTP expired, please request new OTP') {
                    /*$("#successMsg,#newUserMsg,#emailNumberForPass,#OTPsentMsg").hide();
                    $("#changeEmailOrMobile").show();*/
                    // $("#getOTP").addClass("btnSecondary").prop("disabled", false);

                    $("#getOTP").prop("disabled", false);
                    $("#errMsg").html("<p class='resend'>"+response.message+" <span id='resendOTP' style='display:inline-block !important; cursor:pointer !important; text-decoration:underline !important;'> Resend OTP</span></p>").show();
                    $("#resendOTP").on("click",function(){ // For resend OTP
                        getOtp();
                    });

                    // inOTPstep = true;
                }else{
                    /*$("#errMsg").html("<p>"+response.message+"</p>").show();
                    return false;*/
                    $("#msg").hide();
                    $("#errMsg").html("<p>"+response.message+"</p>").show();   
                }
            }else if (response.status=='success') {
                if(response.message=="OTP sent"){
                    $("#showOtpBox,#submitLoginDetails").show();
                    // $("#getOTP").css({"background-color":"lightgray","border":"1px thin lightgray","color":"gray"});
                    $("#getOTP").prop("disabled", true);
                    // $("#msg").html("<p>"+response.message+"</p>").fadeIn().fadeOut(12000);
                    $("#msg").html("<p>OTP "+response.otp+" sent</p>").show();
                }
                if(response.message=="Welcome"){
                    location.reload(true);
                }
            } else {
                /*alert('Something went wrong, sorry please try again!');
                return false;*/
            }
            
        }
    });
}

$("#email_or_mobile").keyup(function(){

    inputText = '<?php echo $textForMobileEmail ?>';
    mobile_or_email = $("#email_or_mobile").val();
    
    if(mobile_or_email=='' || mobile_or_email==null){
        $("#emailMobileErr").html("<p>Invalid "+inputText+" </p>").show();
        return false;
    }else{
        $("#emailMobileErr").html("");
    }

    if(isNaN(mobile_or_email)){
        atpos = mobile_or_email.indexOf("@");
        dotpos = mobile_or_email.lastIndexOf(".");
        if(atpos<1 || dotpos<atpos+2 || dotpos+2>=mobile_or_email.length){
            $("#emailMobileErr").html("<p>Email is not valid</p>").show();
            return false;
        }
    }else{
        if(mobile_or_email.length<10 || mobile_or_email.length>10){
            $("#emailMobileErr").html("<p>Mobile number is not valid</p>").show();
            return false;
        }
    }

});

$("#goToAddressPage").on('click', function(){
    window.location.href='<?php echo site_url(); ?>'+"customer/address";
});

function getCartItems2(coupon_code){

    if(removeCouponCode==true){
        sendData = {removeCouponCode:coupon_code,'csrf_test_name': csrf_value}
    }else{
        sendData = {coupon_code:coupon_code,'csrf_test_name': csrf_value};
    }

    $.ajax({
        url:url+'checkout/orderSummary2',
        type:'POST',
        data: sendData,
        dataType:'JSON',
        success:function(res){
            objData1 = '';
            cart_items = res.data.cart_items;
            subtotalValue = (cart_items=='' || cart_items==null) ? 0 :  res.data.subtotal; // res.subtotal
            discountValue = (cart_items=='' || cart_items==null) ? 0 :  res.data.discount;
            deliveryValue = res.data.delivery;
            grandTotal = (cart_items=='' || cart_items==null) ? 0 :  res.data.grand_total;
            colorGreenOrBlack = (res.appliedCouponCode!=null && res.appliedCouponCode!='') ? 'green' : 'black';
            appliedCouponCode = res.appliedCouponCode;

            // alert(res.data.discount);

            appliedCouponDivBox = $("#removeCouponDiv,#removeCouponBox").css('display');

            if(res.status=='success'){
                if(res.message=='Coupon code applied successfully'){
                    showCouponDiscountTxt(discountValue);
                    showCouponBox(res.message, res.appliedCouponCode);
                }
                if(res.message=='Coupon code has been removed'){
                    removeCouponDiscountTxt();
                    removeCouponBox(res.message);
                    removeCouponCode=false; // for adding 'coupon code' second time without page reload
                }
            } else if (res.status=='failed') {
                if(res.message=='Coupon code not removed'){
                    showRedMsgBox(res.message);
                }
                if(res.message=='Request not matching for removing coupon'){
                    showRedMsgBox(res.message);
                }
                if(res.message=='Coupon code is invalid'){
                    showRedMsgBox(res.message);
                }
            } else {
                // alert('Sorry, something went wrong, please try again after sometime');
            }

            if(applyCouponBtn==true && res.status==null && res.message==null && cart_items==''){
                $("#couponGreenMsg").hide();
                $("#couponRedMsg").html('Shopping cart is empty, <a href="<?php echo site_url() . 'shop/juices' ?>">continue shopping</a>').show();
            }

            if(res.appliedCouponCode!=null && res.appliedCouponCode!='' && appliedCouponDivBox=='none'){ // If page reload then 'applied coupon box' will appear
                showCouponBox(null, res.appliedCouponCode);
            }

            for(x in cart_items){

                item_id = cart_items[x]['item_id'];
                item_name = cart_items[x]['item_name'];
                item_qty = cart_items[x]['item_qty'];
                item_subtotal = cart_items[x]['item_subtotal'];
                item_varient = cart_items[x]['item_varient'];
                item_image = cart_items[x]['item_image'];

                objData1 += '<div class="row justify-content-between align-items-center">';
                objData1 +=     '<div class="img col-3 col-lg-3"><img src="'+item_image+'" alt="'+item_name+'" class="img-fluid"></div>';
                objData1 +=     '<div class="details col-9 col-lg-9">';
                objData1 +=         '<div class="row">';
                objData1 +=             '<div class="col-sm-12">';
                objData1 +=                 '<h5>'+item_name+'</h5>';
                objData1 +=             '</div>';
                objData1 +=             '<div class="col-sm-12 d-flex justify-content-between">';
                objData1 +=                 '<div>';
                objData1 +=                     '<span class="litre">'+item_varient+'</span>';
                objData1 +=                     '<span class="qty">Qty: <span>'+item_qty+'</span></span>';
                objData1 +=                 '</div>';
                objData1 +=                 '<div>';                                                            
                objData1 +=                     '<span class="amt"><i class="fas fa-rupee-sign"></i><span>'+item_subtotal+'</span></span>';
                objData1 +=                 '</div>';
                objData1 +=             '</div>';
                objData1 +=         '</div>';
                objData1 +=     '</div>';
                objData1 += '</div>';

            }
            $("#showOrderSummary").html(objData1);

            // Grand total, subtotal, delivery discounts
            $("#subtotalValue").html('<i class="fas fa-rupee-sign"></i>' + subtotalValue);
            
            if(discountValue!=0 && discountValue!=null && discountValue!=''){
                showCouponDiscountTxt(discountValue);        
            }else{
                removeCouponDiscountTxt();
            }

            $("#colorGreenOrBlack").css({"color":colorGreenOrBlack}); // After applying coupon make color green
            if(cart_items!='' && cart_items!=null){
                if(isNaN(deliveryValue)){
                    $(".deliveryValue").html(deliveryValue);
                }else{
                    $(".deliveryValue").html('<i class="fas fa-rupee-sign"></i>' + deliveryValue);
                }
            }
            $("#grand_total, #grandTotalInMobile, .grandTotalInMobile").html('<i class="fas fa-rupee-sign"></i><b>' + grandTotal + '</b>');
            $(".grandTotalInMobile").html('<i class="fas fa-rupee-sign"></i>' + grandTotal);
            
        } 
    });

}

getCartItems2(coupon_code);
// setInterval(getCartItems2, 2000); // for refreshing order summary

function showCouponBox(msg, appliedCouponCode){
    $("#removeCouponDiv,#removeCouponBox").show();
    $("#appliedCouponCode").html(appliedCouponCode);
    // $("#couponGreenMsg").html(msg).fadeIn().fadeOut(6000); // static message already holded under the <div>
    $("#couponRedMsg").hide();
    $("#inputCoupon, #getCouponDetails").prop("disabled",true);
    $("#inputCoupon").val("");
}
function removeCouponBox(msg){
    // $('#removeCouponDiv,#removeCouponBox').remove(); // Hide
    $('#removeCouponDiv,#removeCouponBox').hide();
    $("#appliedCouponCode").html("");
    $("#couponGreenMsg").html(msg).fadeIn().fadeOut(6000);
    $("#inputCoupon, #getCouponDetails").prop("disabled",false);
}
function showCouponDiscountTxt(discountValue){
    $(".discountDiv, #discountTxt, #discountValue").show();
    $("#discountTxt").html("Coupon Discount");
    $("#discountValue").html('<i class="fas fa-rupee-sign"></i>' + discountValue);
}
function removeCouponDiscountTxt(){
    $(".discountDiv, #discountTxt, #discountValue").hide();
    $("#discountTxt, #discountValue").html("");
}
function showRedMsgBox(msg){
    $("#couponGreenMsg").hide();
    $("#couponRedMsg").html(msg).show();     
}
$("#placeOrder").on('click', function(){
    customerAddressId = $("#customerAddressId").val();
    inputText = '<?php echo $textForMobileEmail ?>';
    // email_or_mobile = $("#email_or_mobile").val();
    email_or_mobile = $("#email_or_mobile").val();

    delivery_instructions = $("input[name=delivery_instructions]").val();

    if(customer_id==null || customer_id==''){
        $("#placeOrderMsg").html("Please login, before placing the order").show();
        return false;
    }

    if(customerAddressId==null || customerAddressId==''){
        $("#placeOrderMsg").html("Please provide delivery address").show();
        return false;
    }
    
    if(email_or_mobile=='' || email_or_mobile==null){
        $("#emailMobileErr").html("<p>Invalid "+inputText+" </p>").show();
        $("#placeOrderMsg").html("<p>Please enter "+inputText+", before placing the order. </p>").show();
        return false;
    }else{
        $("#emailMobileErr").html("");
    }

    if(isNaN(email_or_mobile)){
        atpos = email_or_mobile.indexOf("@");
        dotpos = email_or_mobile.lastIndexOf(".");
        if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email_or_mobile.length){
            // $("#emailMobileErr").html("<p>Email is not valid</p>").show();
            $("#placeOrderMsg").html("<p>Invalid "+inputText+" </p>").show();
            return false;
        }
    }else{
        if(email_or_mobile.length<10 || email_or_mobile.length>10){
            // $("#emailMobileErr").html("<p>Mobile number is not valid</p>").show();
            $("#placeOrderMsg").html("<p>Invalid "+inputText+" </p>").show();
            return false;
        }
    }


    data = {email_or_mobile:email_or_mobile,delivery_instructions:delivery_instructions,customerAddressId:customerAddressId,'csrf_test_name':csrf_value};

    $.ajax({
        url: url + 'checkout/placeOrder',
        type:'POST',
        data:data,
        dataType:'JSON',
        success:function(res){
            if(res.status=='failed'){

                if(res.message=='Cart empty'){
                    $("#placeOrderMsg").html('Shopping cart is empty, <a href="<?php echo site_url() . 'shop/juices' ?>">continue shopping</a>').show();
                    return false;   
                }
                if(res.message=='Delivery address not provided'){
                    $("#placeOrderMsg").html('Please provide delivery address').show();
                    return false;
                }

            } else if (res.status=='success') {
                
                if(res.message=='Thanks, your order placed successfully'){
                    $("#placeOrderMsg").html('<span style="display:inline-block; color:green;">' + res.message +'</span>').show();
                    // return false;
                }
                
            } else{
                // alert('Sorry, something went wrong, please try again after sometime');
            }
            
        }
    });
});

$("#mobileBtnForPlaceOrder").on('click', function(){
    customerAddressId = $("#customerAddressId").val();
    inputText = '<?php echo $textForMobileEmail ?>';
    email_or_mobile = $("#email_or_mobile").val();
    delivery_instructions = $("input[name=delivery_instructions]").val();

    if(customer_id==null || customer_id==''){
        $("#modalBox").show();
        $("#msgInModalBox").html("Please enter login details");
        return false;
    }

    if(email_or_mobile==null || email_or_mobile==''){
        $("#modalBox").show();
        $("#msgInModalBox").html("Please enter "+inputText+", before placing the order.");
        return false;        
    }
    
    if(isNaN(email_or_mobile)){
        atpos = email_or_mobile.indexOf("@");
        dotpos = email_or_mobile.lastIndexOf(".");
        if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email_or_mobile.length){
            $("#modalBox").show();
            $("#msgInModalBox").html("Invalid "+inputText);
            return false;
        }
    }else{
        if(email_or_mobile.length<10 || email_or_mobile.length>10){
            $("#modalBox").show();
            $("#msgInModalBox").html("Invalid "+inputText);
            return false;
        }
    }

    // Write next step as per your choice

    data = {email_or_mobile:email_or_mobile,delivery_instructions:delivery_instructions,customerAddressId:customerAddressId,'csrf_test_name':csrf_value};

    $.ajax({
        url: url + 'checkout/placeOrder',
        type:'POST',
        data:data,
        dataType:'JSON',
        success:function(res){
            if(res.status=='failed'){
                if(res.message=='Cart empty'){
                    $("#modalBox").show();
                    $("#msgInModalBox").html('Shopping cart is empty, <a href="<?php echo site_url() . 'shop/juices' ?>">continue shopping</a>');
                    return false;   
                }
                if(res.message=='Delivery address not provided'){
                    $("#modalBox").show();
                    $("#msgInModalBox").html('Please provide delivery address');
                    return false;
                }
            } else if (res.status=='success') {
                if(res.message=='Thanks, your order placed successfully'){
                    $("#modalBox").show();
                    $("#msgInModalBox").html(res.message);
                }
            } else{
                // alert('Sorry, something went wrong, please try again after sometime');
            }
            
        }
    });

});

$("#ok_reload").on('click', function(){
    // location.reload(true);
    setTimeout(function(){
      window.location.reload(true);
    });
});

function timerForOTPExpire(msg){        
    var timeLeft = 30;
    var parentElem = document.getElementById('OTPsentMsg');
    parentElem.style.display="block";
    var elem = document.getElementById('some_div');
    var timerId = setInterval(countdown, 500);

    function countdown() {
        if (timeLeft == -1) {
            clearTimeout(timerId);
            doSomething();
        } else {
            parentElem.innerHTML = "<p class='text-green'><span id='some_div'>"+msg+". "+ timeLeft + " seconds left</span></p>";
            timeLeft--;
        }
    }
}

function getOtp(){
    var mobile_or_email = $("#mobile_or_email").val();
    var data = {mobile_or_email:mobile_or_email, 'csrf_test_name': csrf_value};
    if(validationForEmailOrNumber(mobile_or_email)==true){
        ajaxFunction(url + 'user/sendOtpToEmailOrMobile2', data);
    }
}

function onlyNumberKey(evt) {
    // Only ASCII charactar in that range allowed 
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
        return false; 
    return true; 
}
</script>