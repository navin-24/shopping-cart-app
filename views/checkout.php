<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<?php
$customer_id = $this->session->userdata('logged_in')['customer_id'];
if ($cartItems == null || $cartItems == '')
    redirect('shop/cart'); // check cart empty or not
?>
<section class="dvCheckout">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-lg-none">
                <a href="<?php echo base_url() . 'shop/cart'; ?>" class="returnCart"><i class="fas fa-angle-left"></i> Return to Cart</a>
            </div>
            <input type="hidden" id="set_delivery_pincode" value="<?= $set_delivery_pincode ?>">
            <div class="col-sm-12 d-lg-none">
                <hr>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 d-none d-lg-block">
                        <a href="<?php echo base_url() . 'shop/cart'; ?>" class="returnCart"><i class="fas fa-angle-left"></i> Return to Cart</a>
                    </div>
                    <div class="col-sm-12 d-none d-lg-block">
                        <hr>
                    </div>
                    <div class="col-lg-5 order-1 order-lg-2 cartItems">
                        <div class="row">
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
                                        <div class="col-sm-12" id="showOrderSummary">
                                            <div class="scrollbar">
                                                <?php
                                                //$cartItems = $this->cart->contents();
                                                //print_r($cartItems);
                                                $place_order = TRUE;
                                                foreach ($cartItems as $item) {
                                                    $thumb_image_url = PRODUCT_THUMB_PATH . $item['thumb_image_url'];
                                                    $product_id = $item['options']['product_id'];
                                                    $CI = & get_instance();
                                                    $catResult = $CI->cart_model->getProductCategory($product_id);
                                                    //print_r($result);die;
                                                    $productStr.= '{"Product Id" : ' . $product_id . ',"Product Name" : "' . $item['name'] . '","Price" : "' . str_replace(",", "", $this->cart->format_number($item['subtotal'])) . '","Quantity" : ' . $item['qty'] . ',"Product Image" : "' . $thumb_image_url . '"},';
                                                    $productNameStr.=$item['name'] . ",";
                                                    $productIdStr.=$product_id . ",";
                                                    $categoryNameStr.=$catResult['category_name'] . ",";
                                                    $categoryIdStr.=$catResult['category_id'] . ",";
                                                    $qtyStr.=$item['qty'] . ",";
                                                    $priceStr.= str_replace(",", "", $this->cart->format_number($item['subtotal'])) . ",";
                                                    ?>
                                                    <div class="row justify-content-between align-items-center bb">
                                                        <div class="img col-3 col-lg-3"><img src="<?= $thumb_image_url ?>"  alt="" class="img-fluid"></div>
                                                        <div class="details col-9 col-lg-9">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h5><?= $item['name']; ?></h5>
                                                                </div>
                                                                <div class="col-sm-12 d-flex justify-content-between">
                                                                    <div>
                                                                        <span class="litre"><?= $item['options']['size']; ?></span>
                                                                        <span class="qty">Qty: <span><?= $item['qty']; ?></span></span>
                                                                        <?php
                                                                        if ($default_address['address'] != null && $customer_id && !in_array($city_id, $item['cityIdArr'])) {
                                                                            echo '<p class="btn btnOutofstock">Currently not available</p>';
                                                                            $place_order = FALSE;
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div>
                                                                        <span class="amt"><i class="fas fa-rupee-sign"></i><span><?= number_format($item['subtotal'], 2); ?></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                        <?php
                                        if ($customer_id != null) {
                                            ?>
                                            <div class="applyCoupon col-sm-12">
                                                <div class="d-flex justify-content-between">
                                                    <input type="text" name="inputCoupon" id="inputCoupon" class="form-control" placeholder="Enter Coupon Code">
                                                    <button class="btn btnSecondary" id="applyCoupon">Apply</button>
                                                </div>
                                                <div class="text-center">
                                                    <div id="removeCouponDiv" style="display:none !important;">
                                                        <div class="coupon d-flex justify-content-between align-items-center" id="removeCouponBox">
                                                            <span class="name" id="appliedCouponCode"></span>
                                                            <span id="removeCoupon"><i class="fas fa-times-circle"></i></span>
                                                        </div>
                                                    </div>
                                                    <p class="text-red" id="couponRedMsg" style="display:none;"></p>
                                                    <p class="text-green" id="couponGreenMsg" style="display:none;"></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="grandTotal col-sm-12">
                                            <div class="d-flex justify-content-between mb10">
                                                <span>Subtotal</span>
                                                <div>
                                                    <i class="fas fa-rupee-sign"></i>
                                                    <span id="subtotalValue"><?= number_format($this->cart->total()); ?> </span>
                                                </div>
                                            </div>
                                            <div class="c-discount d-flex justify-content-between discountDiv mb10 dnone" id="colorGreenOrBlack">
                                                <span>Coupon Discount</span>
                                                <div>
                                                    <i class="fas fa-rupee-sign"></i>
                                                    <span id="discountValue"></span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Delivery</span>
                                                <span class="deliveryValue">Free</span>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <span><b>Grand Total</b></span>
                                                <div>
                                                    <i class="fas fa-rupee-sign"></i>
                                                    <span id="grand_total"><?= number_format($grand_total); ?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <?php if ($place_order) { ?>
                                                    <button class="btn btnSecondary d-none d-lg-block" id="placeOrder">Place Order</button>
                                                <?php } else {
                                                    ?>
                                                    <div class="text text-center d-none d-lg-block">
                                                        <p>Few product(s) from your cart cannot be delivered to the address provided.
                                                            Please <a href="<?= base_url('shop/cart'); ?>">edit your cart</a> or Change the Address to see updated delivery details.</p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <!-- Below <P> tag for showing success/error messages -->
                                            <p class="text-red text-center" id="placeOrderMsg" style="display:none;"></p>
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
                                    <?php
                                    if ($customer_id == null && $customer_id == '') { // Login hide/show
                                        ?>
                                                                                <div class="col-sm-12 loginOtp">
                                            <div class="d-flex justify-content-between align-items-center mt15">
                                                <h4>Login via OTP</h4>
                                                <span class="login">Have an account? <a href="<?= base_url('login'); ?>">Login</a></span>
                                            </div>
                                            <div class="text-green" id="otpsent" style="display:none;">
                                                <span style="margin:10px 0px;"></span>
                                                <a id="changeUserName" style="text-decoration:underline; font-size:12px; padding:0; color:blue; cursor:pointer;">Change</a>
                                            </div>
                                            <div class="getOTP">
                                                <div class="d-flex justify-content-between align-items-stretch">
                                                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Enter Email/Mobile number">
                                                    <button class="btn btnSecondary" id="getOTP">GET OTP</button>
                                                </div>
                                            </div>
                                            <div class="submitOTP" id="showOtpBox" style="display:none;">
                                                <div class="d-flex justify-content-between align-items-stretch">
                                                    <input type="text" name="otp" class="form-control" placeholder="Enter 6 digit OTP" maxlength="6" value="" onkeypress="return onlyNumberKey(event)">
                                                    <button class="btn btnSecondary" id="submitLoginDetails">SUBMIT</button>
                                                </div>
                                            </div>
                                            <div class="otp col-sm-12">
                                            </div>
                                            <p class='text-red' id='resend' style='display:none;'>
                                                <span>OTP Expired</span>,
                                                <span>Please request new OTP</span>
                                                <span class="text-blue" id='resendOTP'> Resend OTP</span>
                                            </p>
                                            <p class="text-red" id="errMsg"></p>
                                            <p class="text-green" id="msg"></p>
                                            <p style="margin-top:10px; font-size:12px;">
                                                <b style="font-weight: 600;">Note:</b> OTP will be sent to your mobile number. If your number is on the DND list then you will not receive OTP, kindly enter your email id to receive the OTP.
                                            </p>
                                        </div>
                                        <!-- <div class="dvLoginSignupTab col-sm-12">
                                            <div id="dvTab" class="row bg">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <ul class="tabs d-flex">
                                                                <li id="defaultOpen" class="tablinks active" onclick="myTabs(event, 'login')">Login</li>
                                                                <li class="tablinks" onclick="myTabs(event, 'signup')"><span class=" d-lg-inline-block">Sign Up</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div id="login" class="tabcontent">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-lg-6 mt10">
                                                                        <input type="text" name="email" class="form-control" placeholder="Email Id">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-6 mt10">
                                                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <p id="errMsg" class='text-red'></p>
                                                                    </div>
                                                                    <div class="col-sm-12 mt10">
                                                                        <button class="btn btnSecondary" id="loginUser">Login</button>
                                                                        <span class="fp"><a href="<?= base_url('forgotPassword'); ?>" id="forgotPassword">Forgot your password?</a></span>
                                                                    </div>
                                                                    <div class="col-sm-12 text-center or d-lg-flex justify-content-lg-center align-items-lg-center">
                                                                        <h6>Or Login with your social account.</h6>
                                                                    </div>
                                                                    <div class="col-6 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                                        <a class="btn btnFacebook" href="<?php echo $this->facebook->loginUrl(); ?>">
                                                                            <span id="facebook_login">
                                                                                <i class="fab fa-facebook-f"></i> Facebook
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                                        <a class="btn btnGmail" href="<?php echo $this->google->loginUrl(); ?>">
                                                                            <span id="google_login">
                                                                                <img width="20" src="<?= ASSET_URL ?>imgs/gmail.png"> Gmail
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="signup" class="tabcontent">
                                                                <form id="signupform" action="" method="post">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 col-lg-6 mt10">
                                                                            <input type="text" class="form-control" name="name" placeholder="Name">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 mt10">
                                                                            <input type="text" class="form-control" name="email" placeholder="Email Id">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 mt10">
                                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 mt10">
                                                                            <input type="hidden" name='csrf_test_name' value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p id="signerrMsg" class='text-red'></p>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-3 mt10">
                                                                            <button class="btn btnSecondary">Sign Up</button>
                                                                        </div>
                                                                        <div class="col-sm-12 text-center or d-lg-flex justify-content-lg-center align-items-lg-center">
                                                                            <h6>Or Signup with your social account.</h6>
                                                                        </div>
                                                                        <div class="col-6 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                                            <button class="btn btnFacebook" id="facebook_login">
                                                                                <i class="fab fa-facebook-f"></i> Facebook</button>
                                                                        </div>
                                                                        <div class="col-6 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                                            <button class="btn btnGmail" id="google_login">
                                                                                <img width="20" src="http://localhost/rawpressery/assets/imgs/gmail.png"> Gmail</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($customer_id != null && $customer_id != '') {
                                        ?>
                                        <div class="col-sm-12 enterEmail">
                                            <?php
                                            $textForMobileEmail = null;
                                            if ($customer['email'] == null && $customer['email'] == '') {
                                                $textForMobileEmail = 'Email';
                                            }
                                            if ($customer['mobile_number'] == null && $customer['mobile_number'] == '') {
                                                $textForMobileEmail = 'Mobile';
                                            }
                                            if ($customer['mobile_number'] == null && $customer['mobile_number'] == '' || $customer['email'] == null && $customer['email'] == '') {
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
                                        if ($default_address['address'] != null) {
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
                                        <div class="changeAdd col-sm-12">
                                            <?php $addressBtnTxt = ($default_address['address'] != null) ? 'Change/Add Address' : 'Add Address'; ?>
                                            <!-- <button class="btn btnSecondary"> -->
                                            <a class="btn btnSecondary" href="<?= base_url('customer/address'); ?>"> <?= $addressBtnTxt; ?> </a>
                                            <!-- </button> -->
                                            <p style="color: red">Price may change based on the delivery city</p>
                                        </div>
                                        <!-- <div class="col-sm-12 text-center">
                                            <button class="btn showMore">Show More Addresses <span class="d-block"><i class="fas fa-angle-down"></i></span></button>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="dvDeliveryInstruction col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12 d-flex justify-content-between align-items-center mt15">
                                            <h4>Delivery Instructions</h4>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Hand Delivered" checked> Hand Delivered.</label></div>
                                                <!--                                                <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Hand it over to the security"> Hand it over to the security.</label></div>
                                                <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Do not ring the Bell, leave the juice outside"> Do not ring the Bell, leave the juice outside.</label></div>
                                                <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="Ring the Bell and leave the juice outside"> Ring the Bell and leave the juice outside.</label></div>
                                                <div class="col-sm-6"><label><input type="radio" name="delivery_instructions" value="anything_else"> Anything else.</label></div>
                                                <div class="col-sm-12" id="anything_else_box" style="display:none;">
                                                    <textarea class="form-control" name="" id="anything_else" rows="4" placeholder="Enter your message"></textarea>
                                                </div>-->
                                                <div class="col-sm-12 note">
                                                    <b>Please Note, All Orders will be delivered at the security. Thank you for your understanding.</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="dvDeliveryDate col-sm-12">
                                    <div class="d-flex flex-column flex-lg-row justify-lg-content-start align-items-lg-center">
                                        <div>
                                            <h4>Delivery Date</h4>
                                        </div>
                                        <div>
                                            <!-- <input type="date" class="form-control"> -->
                                            <input autocomplete="off" type="text" id="datepicker" class="form-control" placeholder="dd/mm/yyyy" readonly="readonly">
                                        </div>
                                    </div>
                                    <?php
                                } // (if condition) end for $customer_id
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br> -->
    <div class="loginToProceed col-12 d-lg-none">
        <div class="container">

            <?php if ($place_order) { ?>
                <div class="row align-items-center justify-content-end">
                    <div class="amt grandtotal d-flex align-items-center justify-content-start">
                        <div><i class="fas fa-rupee-sign"></i><span id="grandTotalInMobile"><?= number_format($grand_total); ?></span></div>
                    </div>
                    <div class="">
                        <button class="btn btnPrimary" id="mobileBtnForPlaceOrder" style="margin-left:10px; font-size:12px !important;">Place Order</button>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="text col-12">
                        <p>Few product(s) from your cart cannot be delivered to the address provided. Please <a href="<?= base_url('shop/cart'); ?>">edit your cart</a> or Change the Address to see updated delivery details.</p>
                    </div>
                </div>
            <?php } ?>
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
                        <button class="btn btnPrimary" id="ok_reload">OK</button>
                        <button class="btn btnPrimary" id="cancel_reload" style="display:none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
                                                                    var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
                                                                    var url = '<?= base_url() ?>';
                                                                    $(document).ready(function () {
                                                                        $("#inputCoupon").val('<?= $discount_code; ?>');
                                                                        setTimeout(function(){
                                                                            if ($("#inputCoupon").val()!='') {
                                                                                $("#applyCoupon").click();
                                                                            }
                                                                        },100);
                                                                        $("#signupform").validate({
                                                                            rules: {
                                                                                name: {
                                                                                    required: true,
                                                                                    minlength: 3
                                                                                },
                                                                                email: {
                                                                                    required: true,
                                                                                    email: true
                                                                                },
                                                                                password: {
                                                                                    minlength: 5
                                                                                },
                                                                                confirm_password: {
                                                                                    minlength: 5,
                                                                                    equalTo: "#password"
                                                                                }
                                                                            },
                                                                            messages: {
                                                                                name: {
                                                                                    minlength: "Name should be at least 3 characters"
                                                                                },
                                                                                confirm_password: {
                                                                                    equalTo: "Enter Confirm Password Same as Password"
                                                                                }
                                                                            },
                                                                            submitHandler: function (form) {
                                                                                $.ajax({
                                                                                    url: url + 'user/registerUser',
                                                                                    type: 'POST',
                                                                                    dataType: "JSON",
                                                                                    data: $(form).serialize(),
                                                                                    success: function (response) {
                                                                                        //console.log(response.message);
                                                                                        //$("p#signerrMsg").text(response.message).show();
                                                                                        if (response.status == 'failed') {
                                                                                            $("p#signerrMsg").html(response.message).show();
                                                                                        } else if (response.message == "Welcome") {
                                                                                            location.reload();
                                                                                            return;
                                                                                        }
                                                                                    }
                                                                                });
                                                                            }
                                                                        });


                                                                        $("#loginUser").on('click', function () { // For Login with password
                                                                            var email = $('input[name="email"]').val();
                                                                            var password = $('input[name="password"]').val();
                                                                            if (email == '') {
                                                                                $("p#errMsg").html('Please enter email address');
                                                                                return false;
                                                                            }
                                                                            if (password == '') {
                                                                                $("p#errMsg").html('Please enter password');
                                                                                return false;
                                                                            }
                                                                            var emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                                                                            if (!emailReg.test(email) || email === '')
                                                                            {
                                                                                $("p#errMsg").html('Please enter valid email');
                                                                                return false;
                                                                            }
                                                                            var dataJson = {email: email, password: password, 'csrf_test_name': csrf_value};
                                                                            $.ajax({
                                                                                url: url + 'user/loginUser',
                                                                                type: 'POST',
                                                                                data: dataJson,
                                                                                dataType: "JSON",
                                                                                success: function (response) {
                                                                                    if (response.status == 'failed') {
                                                                                        $("p#errMsg").html(response.message).show();
                                                                                    } else if (response.message == "Welcome") {
                                                                                        location.reload();
                                                                                        return;
                                                                                    }
                                                                                }
                                                                            });
                                                                        });
                                                                        $("#getOTP").on('click', function () {
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
                                                                            var dataJson = {userName: userName, 'csrf_test_name': csrf_value};
                                                                            $.ajax({
                                                                                url: url + 'user/sendOTP',
                                                                                type: 'POST',
                                                                                data: dataJson,
                                                                                dataType: "JSON",
                                                                                success: function (response) {
                                                                                    if (response.status == 'success')
                                                                                    {
                                                                                        $("#showOtpBox").show();
                                                                                        $("#getOTP").prop("disabled", true);
                                                                                        $("p#msg").text(response.message.replace(/(<([^>]+)>)/ig, ""));
                                                                                    } else {
                                                                                        $("p#errMsg").text(response.message);
                                                                                    }
                                                                                }
                                                                            });
                                                                        });
                                                                        $("#resendOTP").on("click", function () { // For resend OTP
                                                                            $("#otp").val("");
                                                                            $("#resend").hide();
                                                                            var userName = $('input[name="userName"]').val();
                                                                            var dataJson = {'userName': userName, 'resend': '1', 'csrf_test_name': csrf_value};
                                                                            $.ajax({
                                                                                url: url + 'user/sendOTP',
                                                                                type: 'POST',
                                                                                data: dataJson,
                                                                                dataType: "JSON",
                                                                                success: function (response) {
                                                                                    if (response.status == 'success')
                                                                                    {
                                                                                        $("p#msg").html(response.message).show().fadeOut(5000);
                                                                                    } else {
                                                                                        $("p#errMsg").html(response.message);
                                                                                    }
                                                                                }
                                                                            });
                                                                        });
                                                                        $("#submitLoginDetails").on('click', function () {
                                                                            $("p#errMsg").text('');
                                                                            $("p#msg").text('');
                                                                            var userName = $("input[name=userName]").val();
                                                                            var otp = $("input[name=otp]").val();
                                                                            var dataJson = {'userName': userName, 'otp': otp, 'csrf_test_name': csrf_value};
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
                                                                            if (otp == null || otp == '') {
                                                                                $("p#errMsg").text("OTP field cannot be blank").show();
                                                                                return false;
                                                                            }
                                                                            $.ajax({
                                                                                url: url + 'user/verifyOTP',
                                                                                type: 'POST',
                                                                                data: dataJson,
                                                                                dataType: "JSON",
                                                                                success: function (response) {
                                                                                    if (response.status == 'success')
                                                                                    {
                                                                                        if (response.message == "Welcome") {
                                                                                            location.reload(true);
                                                                                            return;
                                                                                        }
                                                                                        $("#showOtpBox").show();
                                                                                        $("#getOTP").prop("disabled", true);
                                                                                        $("p#msg").text(response.message.replace(/(<([^>]+)>)/ig, ""));
//$("#otpsent").show();
                                                                                    } else {
                                                                                        if (response.message == 'expired') {
                                                                                            $("#resend").show();
                                                                                        } else {
                                                                                            $("p#errMsg").html(response.message);
                                                                                        }
                                                                                    }
                                                                                }
                                                                            });
                                                                            /*if (validationForEmailOrNumber(mobile_or_email) == true) {
                                                                             ajaxFunction(url + 'user/checkOtpWithMobileOrEmail', data);
                                                                             }*/
                                                                        });
                                                                        $("input[type='radio'][name='delivery_instructions']").change(function () {
                                                                            if ($(this).val() == "anything_else")
                                                                            {
                                                                                $("#anything_else_box").show();
                                                                            } else
                                                                            {
                                                                                $("#anything_else_box").hide();
                                                                            }
                                                                        });
                                                                        $("#applyCoupon").on('click', function () {
//applyCouponBtn = true;
                                                                            $("#couponRedMsg").html('');
                                                                            $("#couponGreenMsg").html('');
                                                                            var coupon_code = $("#inputCoupon").val();
                                                                            if (coupon_code == '' || coupon_code == null) {
                                                                                $("#couponRedMsg").html('Please enter coupon code').show();
                                                                                return false;
                                                                            }
                                                                            var jsonData = {coupon_code: coupon_code, 'csrf_test_name': csrf_value};
                                                                            $.ajax({
                                                                                url: url + 'checkout/applyCoupon',
                                                                                type: 'POST',
                                                                                data: jsonData,
                                                                                dataType: 'JSON',
                                                                                success: function (res) {
                                                                                    if (res.status == 'failed') {
                                                                                        $("#couponRedMsg").html(res.message).show();
                                                                                    } else {
                                                                                        $("#couponGreenMsg").html(res.message).show();
                                                                                        $("#grand_total").text(res.data.cart_total);
                                                                                        $("#grandTotalInMobile").text(res.data.cart_total);
                                                                                        $("#removeCouponDiv").show();
                                                                                        $("#appliedCouponCode").text(res.data.coupon_code);
                                                                                        $("#inputCoupon").val("");
                                                                                        $("#inputCoupon, #applyCoupon").prop("disabled", true);
                                                                                        $("#discountValue").text(res.data.discount);
                                                                                        $(".discountDiv").removeClass('dnone');
                                                                                        webengage.track("Coupon Code Applied", {
                                                                                            "Cart Value Before Discount": <?= str_replace(",", "", number_format($grand_total)); ?>,
                                                                                            "Cart Value After Discount": parseFloat(res.data.cart_total.replace(',', '')),
                                                                                            "Coupon Code": res.data.coupon_code,
                                                                                            "Status": "success",
                                                                                            "Discount Value": parseFloat(res.data.discount)
                                                                                        });
                                                                                    }
                                                                                }
                                                                            })
                                                                        });
                                                                        $("#removeCoupon").on('click', function () {
                                                                            var coupon_code = $('#appliedCouponCode').text();
                                                                            $("#couponGreenMsg").html('');
                                                                            var jsonData = {coupon_code: coupon_code, 'csrf_test_name': csrf_value};
                                                                            $.ajax({
                                                                                url: url + 'checkout/removeCoupon',
                                                                                type: 'POST',
                                                                                data: jsonData,
                                                                                dataType: 'JSON',
                                                                                success: function (res) {
                                                                                    if (res.status == 'failed') {
                                                                                        $("#couponRedMsg").text(res.message);
                                                                                    } else {
                                                                                        $("#couponGreenMsg").text(res.message).fadeOut(5000);
                                                                                        $("#grand_total").text(res.data.cart_total);
                                                                                        $("#grandTotalInMobile").text(res.data.cart_total);
                                                                                        $(".discountDiv").addClass('dnone');
                                                                                        $("#removeCouponDiv").hide();
                                                                                        $("#inputCoupon, #applyCoupon").prop("disabled", false);
                                                                                    }
                                                                                }
                                                                            })
                                                                        });
                                                                        $("#email_or_mobile").keyup(function () {
                                                                            inputText = '<?php echo $textForMobileEmail ?>';
                                                                            mobile_or_email = $("#email_or_mobile").val();
                                                                            if (mobile_or_email == '' || mobile_or_email == null) {
                                                                                $("#emailMobileErr").html("<p>Please enter " + inputText + " </p>").show();
                                                                                return false;
                                                                            } else {
                                                                                $("#emailMobileErr").html("");
                                                                            }
                                                                            if (inputText == 'Mobile') {
                                                                                if (mobile_or_email.length < 10 || mobile_or_email.length > 10) {
                                                                                    $("#emailMobileErr").html("<p>Mobile number is not valid</p>").show();
                                                                                    return false;
                                                                                }
                                                                            }
                                                                            if (inputText == 'Email') {
                                                                                atpos = mobile_or_email.indexOf("@");
                                                                                dotpos = mobile_or_email.lastIndexOf(".");
                                                                                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= mobile_or_email.length) {
                                                                                    $("#emailMobileErr").html("<p>Email is not valid</p>").show();
                                                                                    return false;
                                                                                }
                                                                            }
                                                                        });
                                                                        $("#placeOrder").on('click', function () {
                                                                            var customerAddressId = $("#customerAddressId").val();
                                                                            var inputText = '<?php echo $textForMobileEmail ?>';
                                                                            var customer_id = "<?php echo $customer_id; ?>";
                                                                            var email_or_mobile = $("#email_or_mobile").val();
                                                                            var delivery_date = $("#datepicker").val();
                                                                            delivery_instructions = $("input[name=delivery_instructions]:checked").val();
                                                                            if (delivery_instructions == 'anything_else')
                                                                            {
                                                                                delivery_instructions = $('textarea#anything_else').val();
                                                                            }
                                                                            if (customer_id == null || customer_id == '') {
                                                                                $("#placeOrderMsg").text("Please login, before placing the order").show();
                                                                                return false;
                                                                            }
                                                                            if (customerAddressId == null || customerAddressId == '') {
                                                                                $("#placeOrderMsg").text("Please provide delivery address").show();
                                                                                return false;
                                                                            }
                                                                            if (inputText != null && inputText != '') {
                                                                                if (email_or_mobile == '' || email_or_mobile == null) {
                                                                                    $("#emailMobileErr").html("<p>Invalid " + inputText + " </p>").show();
                                                                                    $("#placeOrderMsg").html("<p>Please enter " + inputText + ", before placing the order. </p>").show();
                                                                                    return false;
                                                                                } else {
                                                                                    $("#emailMobileErr").html("");
                                                                                }
                                                                                if (isNaN(email_or_mobile)) {
                                                                                    atpos = email_or_mobile.indexOf("@");
                                                                                    dotpos = email_or_mobile.lastIndexOf(".");
                                                                                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email_or_mobile.length) {
                                                                                        // $("#emailMobileErr").html("<p>Email is not valid</p>").show();
                                                                                        $("#placeOrderMsg").html("<p>Invalid " + inputText + " </p>").show();
                                                                                        return false;
                                                                                    }
                                                                                } else {
                                                                                    if (email_or_mobile.length < 10 || email_or_mobile.length > 10) {
                                                                                        // $("#emailMobileErr").html("<p>Mobile number is not valid</p>").show();
                                                                                        $("#placeOrderMsg").html("<p>Invalid " + inputText + " </p>").show();
                                                                                        return false;
                                                                                    }
                                                                                }
                                                                                data = {email_or_mobile: email_or_mobile, delivery_instructions: delivery_instructions, delivery_date: delivery_date, customerAddressId: customerAddressId, 'csrf_test_name': csrf_value};
                                                                            } else {
                                                                                data = {delivery_instructions: delivery_instructions, customerAddressId: customerAddressId, delivery_date: delivery_date, 'csrf_test_name': csrf_value};
                                                                            }
                                                                            $.ajax({
                                                                                url: '<?= base_url('checkout/placeOrder'); ?>',
                                                                                type: 'POST',
                                                                                data: data,
                                                                                dataType: 'JSON',
                                                                                success: function (res) {
                                                                                    if (res.status == 'failed') {
                                                                                        if (res.message == 'already_used') {
                                                                                            $("#placeOrderMsg").html('This ' + $("#email_or_mobile").val() + ' is already used').show();
                                                                                            return false;
                                                                                        }
                                                                                        if (res.message == 'cart_empty') {
                                                                                            $("#placeOrderMsg").html('Shopping cart is empty, <a href="<?= base_url('shop/juices'); ?>">continue shopping</a>').show();
                                                                                            return false;
                                                                                        }
                                                                                        $("#placeOrderMsg").text(res.message).show();
                                                                                    } else if (res.status == 'success') {
                                                                                        webengage.track("Checkout Completed", {
                                                                                            "Product Id": "<?php echo rtrim($productIdStr, ","); ?>",
                                                                                            "Product Name": "<?php echo rtrim($productNameStr, ","); ?>",
                                                                                            "Price": "<?php echo rtrim($priceStr, ","); ?>",
                                                                                            "Category Id": "<?php echo rtrim($categoryIdStr, ","); ?>",
                                                                                            "Category Name": "<?php echo rtrim($categoryNameStr, ","); ?>",
                                                                                            "Quantity": "<?php echo rtrim($qtyStr, ","); ?>",
                                                                                            "Estimated Delivery Day": $("#datepicker").val(),
                                                                                            "Amount": <?= str_replace(",", "", number_format($grand_total)); ?>
                                                                                        });
                                                                                        window.location.href = '<?= BASE_URL('payment/redirect'); ?>';
                                                                                    }
                                                                                }
                                                                            });
                                                                        });
                                                                        $("#mobileBtnForPlaceOrder").on('click', function () {
                                                                            customerAddressId = $("#customerAddressId").val();
                                                                            var inputText = '<?php echo $textForMobileEmail ?>';
                                                                            var email_or_mobile = $("#email_or_mobile").val();
                                                                            var customer_id = "<?php echo $customer_id; ?>";
                                                                            var delivery_date = $("#datepicker").val();
                                                                            delivery_instructions = $("input[name=delivery_instructions]:checked").val();
                                                                            if (delivery_instructions == 'anything_else')
                                                                            {
                                                                                delivery_instructions = $('textarea#anything_else').val();
                                                                            }
                                                                            if (customer_id == null || customer_id == '') {
                                                                                $("#modalBox").show();
                                                                                $("#msgInModalBox").html("Please enter login details");
                                                                                return false;
                                                                            }
                                                                            if (customerAddressId == null || customerAddressId == '') {
                                                                                $("#modalBox").show();
                                                                                $("#msgInModalBox").html("Please provide delivery address");
                                                                                return false;
                                                                            }
                                                                            if (inputText != null && inputText != '') {
                                                                                if (email_or_mobile == '' || email_or_mobile == null) {
                                                                                    $("#modalBox").show();
                                                                                    $("#msgInModalBox").html("Please enter " + inputText + ", before placing the order.");
                                                                                    return false;
                                                                                }
                                                                                if (isNaN(email_or_mobile)) {
                                                                                    atpos = email_or_mobile.indexOf("@");
                                                                                    dotpos = email_or_mobile.lastIndexOf(".");
                                                                                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email_or_mobile.length) {
                                                                                        $("#modalBox").show();
                                                                                        $("#msgInModalBox").html("Invalid " + inputText);
                                                                                        return false;
                                                                                    }
                                                                                } else {
                                                                                    if (email_or_mobile.length < 10 || email_or_mobile.length > 10) {
                                                                                        $("#modalBox").show();
                                                                                        $("#msgInModalBox").html("Invalid " + inputText);
                                                                                        return false;
                                                                                    }
                                                                                }
                                                                                data = {email_or_mobile: email_or_mobile, delivery_instructions: delivery_instructions, delivery_date: delivery_date, customerAddressId: customerAddressId, 'csrf_test_name': csrf_value};
                                                                            } else {
                                                                                data = {delivery_instructions: delivery_instructions, customerAddressId: customerAddressId, delivery_date: delivery_date, 'csrf_test_name': csrf_value};
                                                                            }
                                                                            $.ajax({
                                                                                url: url + 'checkout/placeOrder',
                                                                                type: 'POST',
                                                                                data: data,
                                                                                dataType: 'JSON',
                                                                                success: function (res) {
                                                                                    if (res.status == 'failed') {
                                                                                        if (res.message == 'Cart empty') {
                                                                                            $("#modalBox").show();
                                                                                            $("#msgInModalBox").html('Shopping cart is empty, <a href="<?php echo site_url() . 'shop/juices' ?>">continue shopping</a>');
                                                                                            return false;
                                                                                        }
                                                                                        if (res.message == 'This ' + $("#email_or_mobile").val() + ' is already used') {
                                                                                            $("#modalBox").show();
                                                                                            $("#msgInModalBox").html('This ' + $("#email_or_mobile").val() + ' is already used');
                                                                                            return false;
                                                                                        }
                                                                                        $("#modalBox").show();
                                                                                        $("#msgInModalBox").text(res.message);
                                                                                        return false;
                                                                                    } else if (res.status == 'success') {
                                                                                        window.location.href = '<?= BASE_URL('payment/redirect'); ?>';
                                                                                    }
                                                                                }
                                                                            });
                                                                        });
                                                                        $("#ok_reload").on('click', function () {
                                                                            window.location.reload(true);
                                                                        });
                                                                    });
                                                                    function getCartItems2(coupon_code) {
                                                                        if (removeCouponCode == true) {
                                                                            sendData = {removeCouponCode: coupon_code, 'csrf_test_name': csrf_value}
                                                                        } else {
                                                                            sendData = {coupon_code: coupon_code, 'csrf_test_name': csrf_value};
                                                                        }
                                                                        $.ajax({
                                                                            url: url + 'checkout/orderSummary2',
                                                                            type: 'POST',
                                                                            data: sendData,
                                                                            dataType: 'JSON',
                                                                            success: function (res) {
                                                                                objData1 = '';
                                                                                cart_items = res.data.cart_items;
                                                                                subtotalValue = (cart_items == '' || cart_items == null) ? 0 : res.data.subtotal; // res.subtotal
                                                                                discountValue = (cart_items == '' || cart_items == null) ? 0 : res.data.discount;
                                                                                deliveryValue = res.data.delivery;
                                                                                grandTotal = (cart_items == '' || cart_items == null) ? 0 : res.data.grand_total;
                                                                                colorGreenOrBlack = (res.appliedCouponCode != null && res.appliedCouponCode != '') ? 'green' : 'black';
                                                                                appliedCouponCode = res.appliedCouponCode;
// alert(res.data.discount);
                                                                                appliedCouponDivBox = $("#removeCouponDiv,#removeCouponBox").css('display');
                                                                                if (res.status == 'success') {
                                                                                    if (res.message == 'Coupon code applied successfully') {
                                                                                        showCouponDiscountTxt(discountValue);
                                                                                        showCouponBox(res.message, res.appliedCouponCode);
                                                                                    }
                                                                                    if (res.message == 'Coupon code has been removed') {
                                                                                        removeCouponDiscountTxt();
                                                                                        removeCouponBox(res.message);
                                                                                        removeCouponCode = false; // for adding 'coupon code' second time without page reload
                                                                                    }
                                                                                } else if (res.status == 'failed') {
                                                                                    if (res.message == 'Coupon code not removed') {
                                                                                        showRedMsgBox(res.message);
                                                                                    }
                                                                                    if (res.message == 'Request not matching for removing coupon') {
                                                                                        showRedMsgBox(res.message);
                                                                                    }
                                                                                    if (res.message == 'Coupon code is invalid') {
                                                                                        showRedMsgBox(res.message);
                                                                                    }
                                                                                } else {
                                                                                    // alert('Sorry, something went wrong, please try again after sometime');
                                                                                }
                                                                                if (applyCouponBtn == true && res.status == null && res.message == null && cart_items == '') {
                                                                                    $("#couponGreenMsg").hide();
                                                                                    $("#couponRedMsg").html('Shopping cart is empty, <a href="<?php echo site_url() . 'shop/juices' ?>">continue shopping</a>').show();
                                                                                }
                                                                                if (res.appliedCouponCode != null && res.appliedCouponCode != '' && appliedCouponDivBox == 'none') { // If page reload then 'applied coupon box' will appear
                                                                                    showCouponBox(null, res.appliedCouponCode);
                                                                                }
                                                                                for (x in cart_items) {
                                                                                    item_id = cart_items[x]['item_id'];
                                                                                    item_name = cart_items[x]['item_name'];
                                                                                    item_qty = cart_items[x]['item_qty'];
                                                                                    item_subtotal = cart_items[x]['item_subtotal'];
                                                                                    item_varient = (cart_items[x]['item_varient'] == null) ? '' : cart_items[x]['item_varient'];
                                                                                    item_image = cart_items[x]['item_image'];
                                                                                    objData1 += '<div class="row justify-content-between align-items-center">';
                                                                                    objData1 += '<div class="img col-3 col-lg-3"><img src="' + item_image + '" alt="' + item_name + '" class="img-fluid"></div>';
                                                                                    objData1 += '<div class="details col-9 col-lg-9">';
                                                                                    objData1 += '<div class="row">';
                                                                                    objData1 += '<div class="col-sm-12">';
                                                                                    objData1 += '<h5>' + item_name + '</h5>';
                                                                                    objData1 += '</div>';
                                                                                    objData1 += '<div class="col-sm-12 d-flex justify-content-between">';
                                                                                    objData1 += '<div>';
                                                                                    objData1 += '<span class="litre">' + item_varient + '</span>';
                                                                                    objData1 += '<span class="qty">Qty: <span>' + item_qty + '</span></span>';
                                                                                    objData1 += '</div>';
                                                                                    objData1 += '<div>';
                                                                                    objData1 += '<span class="amt"><i class="fas fa-rupee-sign"></i> <span>' + item_subtotal + '</span></span>';
                                                                                    objData1 += '</div>';
                                                                                    objData1 += '</div>';
                                                                                    objData1 += '</div>';
                                                                                    objData1 += '</div>';
                                                                                    objData1 += '</div>';
                                                                                }
                                                                                $("#showOrderSummary").html(objData1);
                                                                                // Grand total, subtotal, delivery discounts
                                                                                $("#subtotalValue").html('<i class="fas fa-rupee-sign"></i> ' + subtotalValue);
                                                                                if (discountValue != 0 && discountValue != null && discountValue != '') {
                                                                                    showCouponDiscountTxt(discountValue);
                                                                                } else {
                                                                                    removeCouponDiscountTxt();
                                                                                }
                                                                                $("#colorGreenOrBlack").css({"color": colorGreenOrBlack}); // After applying coupon make color green
                                                                                if (cart_items != '' && cart_items != null) {
                                                                                    if (isNaN(deliveryValue)) {
                                                                                        $(".deliveryValue").html(deliveryValue);
                                                                                    } else {
                                                                                        $(".deliveryValue").html('<i class="fas fa-rupee-sign"></i> ' + deliveryValue);
                                                                                    }
                                                                                }
                                                                                $("#grand_total, #grandTotalInMobile, .grandTotalInMobile").html('<i class="fas fa-rupee-sign"></i> <b>' + grandTotal + '</b>');
                                                                                $(".grandTotalInMobile").html('<i class="fas fa-rupee-sign"></i> ' + grandTotal);
                                                                                // alert(appliedCouponCode);
                                                                                if (appliedCouponCode != null && appliedCouponCode != '') {
                                                                                    webengage.track("Coupon Code Applied", {
                                                                                        "Cart Value Before Discount": subtotalValue,
                                                                                        "Cart Value After Discount": grandTotal,
                                                                                        "Coupon Code": appliedCouponCode,
                                                                                        "Status": "success",
                                                                                        "Discount Value": discountValue
                                                                                    });
                                                                                }
                                                                            }
                                                                        });
                                                                    }
                                                                    //getCartItems2(coupon_code);
                                                                    // setInterval(getCartItems2, 2000); // for refreshing order summary
                                                                    function showCouponBox(msg, appliedCouponCode) {
                                                                        $("#removeCouponDiv,#removeCouponBox").show();
                                                                        $("#appliedCouponCode").html(appliedCouponCode);
                                                                        // $("#couponGreenMsg").html(msg).fadeIn().fadeOut(6000); // static message already holded under the <div>
                                                                        $("#couponRedMsg").hide();
                                                                        $("#inputCoupon, #applyCoupon").prop("disabled", true);
                                                                        $("#inputCoupon").val("");
                                                                    }
                                                                    function removeCouponBox(msg) {
                                                                        // $('#removeCouponDiv,#removeCouponBox').remove(); // Hide
                                                                        $('#removeCouponDiv,#removeCouponBox').hide();
                                                                        $("#appliedCouponCode").html("");
                                                                        $("#couponGreenMsg").html(msg).fadeIn().fadeOut(6000);
                                                                        $("#inputCoupon, #applyCoupon").prop("disabled", false);
                                                                    }
                                                                    function showCouponDiscountTxt(discountValue) {
                                                                        $(".discountDiv, #discountTxt, #discountValue").show();
                                                                        $("#discountTxt").html("Coupon Discount");
                                                                        $("#discountValue").html('<i class="fas fa-rupee-sign"></i>' + discountValue);
                                                                    }
                                                                    function removeCouponDiscountTxt() {
                                                                        $(".discountDiv, #discountTxt, #discountValue").hide();
                                                                        $("#discountTxt, #discountValue").html("");
                                                                    }
                                                                    function showRedMsgBox(msg) {
                                                                        $("#couponGreenMsg").hide();
                                                                        $("#couponRedMsg").html(msg).show();
                                                                    }
                                                                    function onlyNumberKey(evt) {
                                                                        // Only ASCII charactar in that range allowed
                                                                        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                                                                        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                                                                            return false;
                                                                        return true;
                                                                    }
</script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="<?= ASSET_URL ?>js/jquery-ui-min.js"></script>
<script>
$(function () {
    var noOfDaysToAdd = "<?= $delivery_span;?>";
    var noOfDaysToEnd = "<?= $delivery_window;?>";
    if(noOfDaysToAdd==0 || noOfDaysToAdd==''){
        noOfDaysToAdd=6;
    }
    if(noOfDaysToEnd==0 || noOfDaysToEnd==''){
        noOfDaysToEnd=7;
    }
    var startDate = new Date();
    var currentDate = new Date();
    var disabledDates = ["2021-01-26","2021-03-29"];

    count = 1;
    while (count <= noOfDaysToAdd) {
        startDate.setDate(startDate.getDate() + 1);
        count++;
    }
    if(noOfDaysToAdd <5 && startDate.getDay() == 0) { 
        startDate.setDate(startDate.getDate() + 1);
        //code to manage date if holiday comes
        var sDate = new Date(startDate);
        var dateString = new Date(sDate.getTime() - (sDate.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        if(disabledDates.indexOf(dateString) != -1){
            startDate.setDate(startDate.getDate() + 1);
        }
    } else if(noOfDaysToAdd >= 5 && startDate.getDay() == 0) {
        startDate.setDate(startDate.getDate() - 1);
        //code to manage date if holiday comes
        var sDate = new Date(startDate);
        var dateString = new Date(sDate.getTime() - (sDate.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        if(disabledDates.indexOf(dateString) != -1){
            startDate.setDate(startDate.getDate() - 1);
        }
    } else {
        //code to manage date if holiday comes
        var sDate = new Date(startDate);
        var dateString = new Date(sDate.getTime() - (sDate.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        if(noOfDaysToAdd < 5 && disabledDates.indexOf(dateString) != -1){
            startDate.setDate(startDate.getDate() + 1);
        } else if(noOfDaysToAdd >= 2 && disabledDates.indexOf(dateString) == -1){

        } else if(noOfDaysToAdd >= 5 && disabledDates.indexOf(dateString) != -1){
            startDate.setDate(startDate.getDate() - 1);
        } else {
            var date1 = new Date(currentDate);
            var date2 = new Date(startDate);
            var diffTime = Math.abs(date2 - date1);
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
            if(diffDays < 3) {
                startDate.setDate(startDate.getDate() - 1);
            } else if(diffDays > 3) {
                startDate.setDate(startDate.getDate() + 1);
            }
        }
    }
    var endDate = new Date(startDate);
    endDate.setDate(startDate.getDate() + parseInt(noOfDaysToEnd)-1);
    var eDate = new Date(endDate);
    var enddateString = new Date(eDate.getTime() - (eDate.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
    if (endDate.getDay() == 0 || disabledDates.indexOf(enddateString) != -1) {
        endDate.setDate(endDate.getDate() + 1);
    }
    $("#datepicker").datepicker({
        changeMonth: true,
        dateFormat: 'd MM yy',
        minDate: startDate,
        maxDate: endDate,
        beforeShowDay: function (date) {
            var day = date.getDay();
            var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
            //return [day != 0];
            return [disabledDates.indexOf(dateString) == -1 && (day != 0)];
        }
    }).datepicker("setDate", startDate);
});
</script>
<script>
    $(document).ready(function(){
        /*$(".dvPincodeBtn").hide();*/
        $("#pincode2").hide();
        if($("#set_delivery_pincode").val()!=' -  - ' || $("#set_delivery_pincode").val()!=''){   
            $("#usrPincode").text($("#set_delivery_pincode").val());
        }
    });
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
    webengage.track("Checkout Started", {
        "Product Id": "<?php echo rtrim($productIdStr, ","); ?>",
        "Product Name": "<?php echo rtrim($productNameStr, ","); ?>",
        "Category Id": "<?php echo rtrim($categoryIdStr, ","); ?>",
        "Category Name": "<?php echo rtrim($categoryNameStr, ","); ?>",
        "Quantity": "<?php echo rtrim($qtyStr, ","); ?>",
        "Price": "<?php echo rtrim($priceStr, ","); ?>",
        "No. Of Products": <?php echo $this->cart->all_item_count(); ?>,
        "Total Value": <?= str_replace(",", "", number_format($grand_total)); ?>,
        'Product Details': [<?php echo $productStr; ?>]
    });
    document.getElementById("defaultOpen").click();
</script>
