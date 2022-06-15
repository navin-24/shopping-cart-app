<link rel="stylesheet" href="<?= ASSET_URL ?>css/jquery-ui-min.css">
<section class="dvBulkOrderForm">
    <div class="bg-black d-flex flex-1">
        <div class="d-flex flex-1">
            <div class="flex-1 d-flex">
                <div><a href="tel:8657303303"><i class="fas fa-phone-alt"></i></a></div>
                <div>
                    <a href="tel:8657303303"><span class="d-block">Call us Maybe?</span></a>
                    <a href="tel:8657303303" class="d-block">+91 8657 303 303</a>
                </div>
            </div>
            <div class="flex-1 d-flex flex-sm-row-reverse">
                <div><a href="mailto:getmore@rawpressery.com?"><i class="fas fa-envelope"></i></a></div>
                <div class="text-sm-right">
                    <a href="mailto:getmore@rawpressery.com?"><span class="d-block">Start a trail mail</span></a>
                    <a class="d-block " href="mailto:getmore@rawpressery.com?">
                        getmore@rawpressery.com
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form id="bulkorder" name="bulkorder">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <h3>A Little information, to start a conversation</h3>
                    <h4>Big Order, Big Savings!</h4>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">Select Delivery Location</label>
                    <img src="<?= ASSET_URL . 'imgs/fa-map-marker-alt.png' ?>" class="fa-map-marker-alt hand" alt="">
                    <input id="autocomplete" type="text" class="form-control pd" placeholder="Select Delivery Location" name="delivery_location">
                    <input type="hidden" name="locality" id="locality" value="" /> <!-- City -->
                    <input type="hidden" name="postal_code" id="postal_code" value="" /> <!-- Zip code -->
                    <p class="error postal_code_error"></p>
                    <input type="hidden" name="country" id="country" value="" /> <!-- Country -->
                    <div id="deliveryErrMsg" class="error" style="display:none"></div>
                    <p class="error delivery_location_error"></p>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="d-block bold">My Bulk Order is For?</label>
                    <div class="row">
                        <div class="col-6 text-left">
                            <label>
                                <input type="radio" name="order_for" value='wedding' checked="checked">
                                Wedding
                            </label>
                        </div>
                        <div class="col-6 text-left">
                            <label>
                                <input type="radio" name="order_for" value="corporateEventsGifting"> Celebrations
                            </label>
                        </div>
                        <div class="col-12 text-left">
                            <label>
                                <input type="radio" name="order_for" value="celebrations"> Corporate Events & Gifting
                            </label>
                        </div>
                        <p class="error order_for_error"></p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="d-block bold">Approximate Number of bottles I need?</label>
                    <div class="row">
                        <div class="col-6 text-left">
                            <label>
                                <input type="radio" name="no_of_bottles" value=0-50 checked="checked"> 50
                                Bottles
                            </label>
                        </div>
                        <div class="col-6 text-left">
                            <label>
                                <input type="radio" name="no_of_bottles" value="50-100"> 50-100 Bottles
                            </label>
                        </div>
                        <div class="col-6 text-left">
                            <label>
                                <input type="radio" name="no_of_bottles" value="100-200"> 100-200 Bottles
                            </label>
                        </div>
                        <div class="col-6 text-left">
                            <label>
                                <input type="radio" name="no_of_bottles" value="200+"> 200+ Bottles
                            </label>
                        </div>
                        <p class="error no_of_bottles_error"></p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">I need the delivery on</label>
                    <input autocomplete="off" type="text" name="delivery_on" class="datepicker form-control" placeholder="yyyy/mm/dd" readonly="readonly">
                    <p class="error delivery_on_error"></p>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">Full Name</label>
                    <input type="text" class="form-control" name="full_name" placeholder="Enter your Full Name">
                    <p class="error full_name_error"></p>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">Mobile Number</label>
                    <input type="text" maxlength="10" class="form-control" name="mobile_number"
                           placeholder="Enter your Mobile Number">
                    <p class="error mobile_number_error"></p>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter your Email Address">
                    <p class="error email_error"></p>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left text-xl-center">
                    <button id="sendData" class="btn btnSecondary">Send</button>

                </div>
                <div class="col-md-6 col-xl-12 text-center text-md-left text-xl-center">
                    <p id='infomsg'></p>
                </div>
            </div>
            <input type="hidden" name='csrf_test_name' value="<?php echo $this->security->get_csrf_hash(); ?>">

        </form>
    </div>
</section>


<button id="sendButton" class="btn" style="display:none;">send</button>

<div id="bulkOrderForm" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="text-green" id="serverSuccessMsg"></p>
        <p class="text-red" id="serverErrMsg"></p>
        <p class="text-red" id="placesErrMsg"></p>
        <div>
            <a href="<?= BASE_URL('/shop/subscriptions'); ?>" id="hideContinueShoppintBtn" class="btn btnEnquire">Continue Shopping</a>
            <a href="<?= BASE_URL();?>" id="hideHomeBtn" class="btn btnEnquire">Go back to Homepage</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script>
    $(function () {
        $("form[name='bulkorder']").validate({
            rules: {
                full_name: "required",
                delivery_location: "required",
                delivery_on: "required",
                email: {
                    required: true,
                    email: true
                },
                mobile_number: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 15,
                }
            },
            messages: {
                delivery_location: 'Please select "delivery location" from dropdown menu',
                full_name: "Please enter your full name",
                mobile_number: {
                    required: "Please provide a mobile number",
                    number: "Please provide a valid mobile number",
                    minlength: "Please provide a valid mobile number",
                    maxlength: "Please provide a valid mobile number",
                },
                email: "Please enter a valid email address"
            },
            submitHandler: function () {

                $.ajax({
                    type: "POST",
                    url: "<?= BASE_URL('bulkorder/saveBulkOrder'); ?>",
                    data: $('form#bulkorder').serialize(),
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status == "success") {
                            modal.style.display = "block";
                            $("#bulkOrderForm").find("#serverSuccessMsg").html(data.msg);
                        } else {
                            $.each(data.error, function (i, v){
                                $('.'+i+'_error').html(v);
                            });
                            if(data.msg!=''){
                                modal.style.display = "block";
                                $("#bulkOrderForm").find("#serverErrMsg").html(data.msg);    
                            }                            
                        }
                    }
                });
            }
        });
    });


    // Modal
    // Get the modal
    var modal = document.getElementById("bulkOrderForm");
    var btn = document.getElementById("sendButton");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function () {
        modal.style.display = "block";
    }
    span.onclick = function () {
        modal.style.display = "none";
        location.reload(true);
    }
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script src="<?= ASSET_URL ?>js/jquery-ui-min.js"></script>
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          minDate:'today',
          dateFormat: 'yy-mm-dd'
        });
    });
</script>