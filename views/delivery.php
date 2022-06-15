<link rel="stylesheet" href="<?= ASSET_URL ?>css/jquery-ui-min.css">
<div class="dvLS dvBulkOrderForm" id='deliveryBoyFormInfo'>
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="col-sm-12">
                    <div class="text-green text-center" id="otpsent" style="display:none;">
                        <span style="margin:10px 0px;"></span>
                        <a id="changeMobileNumber" style="text-decoration:underline; font-size:12px; padding:0; color:blue; cursor:pointer;">Change</a>
                    </div>
                    <div class="deliveryboymobile col-sm-12">
                        <label class="bold">Your Mobile Number</label>
                        <input type="text" class="form-control mobile" name="db_mobileNumber" id="db_mobileNumber" placeholder="Enter your Mobile Number">
                    </div>
                    <div class="otp col-sm-12">
                        <input id="otp" type="text" class="form-control" placeholder="Enter OTP" maxlength="6" value="" style='display:none;'>
                    </div>
                </div>
                <div class="otp col-sm-12">
                    <p class='resend' id='resend' style='display:none;' ><span style='color:red;'>OTP expired</span>, please request new OTP <span id='resendOTP'> Resend OTP</span></p>
                </div>
                <div class="col-sm-12">
                    <p id="errMsg" class='text-red text-center'></p>
                    <p id="msg" class='text-green'></p>
                </div>
                <div class="note_txt col-sm-12 text-center">
                    <p style="margin-top:10px; font-size:11px;">
                        <b style="font-weight: 600;">Note:</b> OTP will be sent to your mobile number. If your number is on the DND list then you will not receive OTP.
                    </p>
                </div>
                <div class="submit col-sm-12 text-center">
                    <button class="btn btnSecondary" id="deliveryboy_continue">SEND OTP</button>
                    <button class="btn btnSecondary" id="verifyOTP" style="display:none;">Verify</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dvLS dvBulkOrderForm" id='customerInfoForm' style="display: none;">
    <div class="container">
        <div class="row">
            <input type="hidden" name="delivery_boy_mobile" id="delivery_boy_mobile">
            <input type="hidden" name="delivery_lat" id="delivery_lat" >
            <input type="hidden" name="delivery_long" id="delivery_long" >
            <input type="hidden" name="delivery_address" id="delivery_address" >
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="customermobile col-sm-12">
                    <label class="bold">Customer Mobile Number</label>
                    <input type="text" class="form-control mobile" name="cust_mobileNumber" id="cust_mobileNumber" placeholder="Enter Customer mobilele Number">
                </div>
                <div class="col-sm-12">
                    <p id="cust_errMsg" class='text-red text-center'></p>
                </div>
                <div class="col-sm-12">
                    <label class="bold">Comments</label>
                    <textarea id="comment" rows="4" cols="50" class="form-control" placeholder="Enter Comments here"  value=""></textarea>
                </div>
                <div class="note_txt col-sm-12 text-center">
                    <p style="margin-top:10px; font-size:11px;">
                        <b style="font-weight: 600;">Note:</b> please enable geolocation from browser.
                    </p>
                </div>
                <div class="submit col-sm-12 text-center">
                    <button class="btn btnSecondary" id="cust_continue">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dvLS dvBulkOrderForm" id='customerNotified' style="display: none;">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="col-sm-12 text-center">
                    <p style="margin-top:10px; font-size:11px;">
                        <b style="font-weight: 600;font-size: 20px;color: green;">Order delivery is successfully Notified to Customer.</b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
$("#deliveryboy_continue").on('click', function () {
    $("p#errMsg").html('');
    $("p#msg").html('');
    var db_mobileNumber = $('input[name="db_mobileNumber"]').val();
    var intRegex = /[0-9 -()+]+$/;
    var emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
    if (intRegex.test(db_mobileNumber)){
        if ((db_mobileNumber.length < 10) || (!intRegex.test(db_mobileNumber))){
            $("p#errMsg").html('Please enter valid mobile number');
            return false;
        }
    }
    var url = 'delivery/sendOTP';
    var dataJson = {db_mobileNumber: db_mobileNumber, 'csrf_test_name': csrf_value};
    $.ajax({
        url: url,
        type: 'POST',
        data: dataJson,
        dataType: "JSON",
        success: function (response) {
            if (response.status == 'success'){
                $('.deliveryboymobile').hide();
                $('#deliveryboy_continue').hide();
                $('.note_txt').hide();
                $("#otpsent span").html(response.message);
                $("#otpsent").show();
                $("#otp").show();
                $("#verifyOTP").show();
            } else {
                $("p#errMsg").html(response.message);
            }
        }
    });
});
$("#changeMobileNumber").on('click', function () {
    var db_mobileNumber = $('input[name="db_mobileNumber"]').val();
    $('#deliveryboy_continue').show();
    $("#verifyOTP").hide();
    $('input[name="db_mobileNumber"]').val(db_mobileNumber);
    $('.deliveryboymobile').show();
    $('.note_txt').show();
    $("#otp").hide();
    $("#otpsent").hide();
});
$("#verifyOTP").on('click', function () {
    var db_mobileNumber = $('input[name="db_mobileNumber"]').val();
    var otpValue = $("#otp").val();
    if (otpValue == '') {
        $("p#errMsg").html('Please enter the OTP');
        return false;
    }
    if (otpValue.length < 6){
        $("p#errMsg").html('OTP is invalid');
        return false;
    }
    var dataJson = {db_mobileNumber: db_mobileNumber, otp: otpValue, 'csrf_test_name': csrf_value};
    var url = 'delivery/verifyOTP';
    $.ajax({
        url: url,
        type: 'POST',
        data: dataJson,
        dataType: "JSON",
        success: function (response) {
            if (response.status == 'failed') {
                if (response.message == 'expired') {
                    $("#otpsent").hide();
                    $("#resend").show();
                } else {
                    $("p#errMsg").html(response.message);
                }
            }
            if (response.status == "success") {
                $("#deliveryBoyFormInfo").hide();
                $("#delivery_boy_mobile").val(response.db_mobileNumber);
                $("#customerInfoForm").show();
                /*window.location.replace("<?php echo base_url('delivery/customerInfo'); ?>");
                return;*/
            }
        }
    })
});
$("#resendOTP").on("click", function () { // For resend OTP
    $("#otp").val("");
    $("#resend").hide();
    var db_mobileNumber = $('input[name="db_mobileNumber"]').val();
    var url = 'delivery/sendOTP';
    var dataJson = {'db_mobileNumber': db_mobileNumber, 'resend': '1', 'csrf_test_name': csrf_value};
    $.ajax({
        url: url,
        type: 'POST',
        data: dataJson,
        dataType: "JSON",
        success: function (response) {
            if (response.status == 'success'){
                $("p#msg").html(response.message).fadeOut(5000);
            } else {
                $("p#errMsg").html(response.message);
            }
        }
    });
});
$('#otp').keypress(function (event) {
    if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
        event.preventDefault(); //stop character from entering input
    }
});
$('input .mobile').keypress(function (e) {
    if (e.which === 32)
        return false;
});

$("#cust_continue").on('click', function () {
    $("p#cust_errMsg").html('');
    var cust_mobileNumber = $('input[name="cust_mobileNumber"]').val();
    var delivery_boy_mobile = $("#delivery_boy_mobile").val();
    var intRegex = /[0-9 -()+]+$/;
    var emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
    if(!delivery_boy_mobile){
        window.location.replace("<?php echo base_url('delivery'); ?>");
    } else if (!cust_mobileNumber) {
        $("p#cust_errMsg").html('Please enter valid mobile number');
        return false;
    } else if (intRegex.test(cust_mobileNumber)){
        if ((cust_mobileNumber.length < 10) || (!intRegex.test(cust_mobileNumber))){
            $("p#cust_errMsg").html('Please enter valid mobile number');
            return false;
        }
        delivery_geolocate();
        setTimeout(function(){
            var delivery_address = $("#delivery_address").val();
            var delivery_lat = $("#delivery_lat").val();
            var delivery_long = $("#delivery_long").val();
            var comment = $("#comment").val();
            var url = 'delivery/deliveryDetails';
            var dataJson = {cust_mobileNumber: cust_mobileNumber,delivery_lat:delivery_lat,delivery_long:delivery_long,delivery_address:delivery_address,delivery_boy_mobile:delivery_boy_mobile,comment:comment, 'csrf_test_name': csrf_value};
            $.ajax({
                url: url,
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'success'){
                        $("#customerInfoForm").hide();
                        $("#customerNotified").show();
                    } else {
                        $("p#cust_errMsg").html(response.message);
                    }
                }
            });

        },1000);
        
    }
});

});

function delivery_geolocate() {
    var options = {
        enableHighAccuracy: true,
        timeout: 100,
        maximumAge: 0
    };
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            circle.getBounds();
            autocomplete.setBounds(circle.getBounds());
            //getLocation();
            navigator.geolocation.getCurrentPosition(showPosition,showError,options);
/*            console.log(geolocation);*/
            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(geolocation.lat, geolocation.lng);
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                 if (status == google.maps.GeocoderStatus.OK) {
                      if (results[0]) {
                        var add = results[0].formatted_address ;
                      }
                 }
                 $("#delivery_lat").val(geolocation.lat);
                 $("#delivery_long").val(geolocation.lng);
                 $("#delivery_address").val(add);
                 //return false;
            });
            
        });
    }

    function showError(err) {
      console.warn(`ERROR(${err.code}): ${err.message}`);
    }
}
</script>