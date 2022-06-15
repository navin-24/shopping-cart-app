<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<link rel="stylesheet" href="<?= ASSET_URL ?>css/jquery-ui-min.css">
<section class="dvBulkOrderForm" id='campaignFormInfo' data-isRegSuccess='<?php echo $isRegSuccess;?>' data-showRegPopup='<?php echo $showRegPopup;?>' >
    <div class="container">
        <form id="campaignform" name="campaignform">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <h3><?php echo RAWTALK_HEADER;?></h3>
                    <h4>Register here to participate.</h4>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">Name</label>
                    <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter your Full Name">
                    <div class="text-red error err_customer_name"></div>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">Contact Number</label>
                    <input type="text" class="form-control" name="customer_contact_number" id="customer_contact_number" placeholder="Enter your Contact Number" maxlength="10">
                    <div class="text-red error err_customer_contact_number"></div>       
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">Email Address</label>
                    <input type="text" class="form-control" name="customer_email" id="customer_email" placeholder="Enter your Email Address">
                    <div class="text-red error err_customer_email"></div>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left">
                    <label class="bold">City</label>
                    <input type="text" class="form-control" name="customer_city" id="customer_city" placeholder="Enter your City">
                    <div class="text-red error err_customer_city"></div>
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-4 text-center text-md-left text-xl-center">
                    <button id="sendCampaignRegistrationData" class="btn btnSecondary">CLICK TO PAY & REGISTER</button>
                    <p style='margin-left:20px;'>(Registration fee for the session is Rs <?php echo RAWTALK_AMOUNT;?>/-)</p>
                </div>
                <div class="col-md-6 col-xl-12 text-center text-md-left text-xl-center">
                    <p id='infomsg' class='error err_somethingwrong'></p>
                </div>
            </div>
            <input type="hidden" name='csrf_test_name' value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name='submit_data' id='submit_data' value="yes">
        </form>
    </div>
</section>

<button id="sendButton" class="btn" style="display:none;">send</button>

<div class="dvModal">
    <div id="contactModal" class="modal">
        <div class="modal-content text-center modal-sm modal-center">          
            <i class="fas fa-times-circle btn close"></i>            
            <i class="fas fa-check-circle text-green"></i>
            <h5>Thank you. <br>We will get back to you soon.</h5>
        </div>
    </div>
</div>

<div id="rawTalkForm" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" id="closepop">&times;</span>
        <p class="text-green" style="font-size:15px;" id="serverSuccessMsg"></p>
        <p class="text-red" style="font-size:15px;" id="serverErrMsg"></p>
        <p class="text-red" style="font-size:15px;" id="placesErrMsg"></p>
    </div>
</div>

<script>
// Modal
// Get the modal
var modal = document.getElementById("rawTalkForm");
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


var showRegPop = "<?php echo $showRegPopup;?>";
var isRegSuccess = "<?php echo $isRegSuccess;?>";
if(showRegPop == 'yes' && isRegSuccess == 'yes'){
    modal.style.display = "block";
    $("#rawTalkForm").find("#serverSuccessMsg").html("Thank you for registering. You'll receive your login details for the webinar shortly over mail");
} else if(showRegPop == 'yes' && isRegSuccess == 'no'){
    modal.style.display = "block";
    $("#rawTalkForm").find("#serverErrMsg").html("Your payment has failed. Please try again.");
}

$(document).on('click','#closepop',function(e){
    location.reload(true);   
})

$(document).on('click','#sendCampaignRegistrationData',function(e){
    e.preventDefault();
    var redUrl = "<?= BASE_URL('campaign/redirect'); ?>";
    $.ajax({
        url: "<?= BASE_URL('campaign/rawtalk'); ?>",
        type: "POST",
        data: $('form#campaignform').serialize(),
        success: function (data, textStatus, jqXHR) {
            var fetchResponse = $.parseJSON(data);
            if (fetchResponse.status == "success") {
                $.each(fetchResponse.error, function (i,v){
                    $('.'+'err_'+i).html(v);
                });
                $("#campaignform")[0].reset();
                $(".error").html("");
                window.location.href = redUrl;
            } else if (fetchResponse.status == "already registered") {
                $.each(fetchResponse.error, function (i,v){
                    $('.'+'err_'+i).html(v);
                });
                modal.style.display = "block";
                $("#rawTalkForm").find("#serverErrMsg").html("Dear User, You are already registered with us.");
            } else {
                $.each(fetchResponse.error, function (i,v){
                    $('.'+'err_'+i).html(v);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown){

        }
    });
    return false;
});

// Contact Modal
var contactModal = document.getElementById("contactModal");
var contactspan2 = contactModal.getElementsByClassName("close")[0];

contactspan2.onclick = function () {
    contactModal.style.display = "none";
}
<?php if ($querymsg) { ?>
    contactModal.style.display = "block";
<?php } ?>
</script>
