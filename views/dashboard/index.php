<?php
$GoogleMapsAPIKey = "AIzaSyD0HOEKILngJVQlwBEEFNwVGAwY4EHE27I";
$GoogleMapsUrl = "https://maps.googleapis.com/maps/api/js?key=" . $GoogleMapsAPIKey . "&libraries=places&callback=initAutocomplete";
?>
<div id="main">
    <div id="login">
        <?php
        if ($this->session->userdata('authenticated')) {
            ?>
            <h1><?php echo $title ?></h1>
            <h3>Welcome to dashboard</h3>
            <a href="<?php echo base_url('user/logout'); ?>"> Log Out </a>
        <?php } ?>
    </div>
    <input id="autocomplete" placeholder="Enter location" onFocus="geolocate()" type="text"/>

    <input type="hidden" name='pincode' id="pincode" placeholder="Enter Pincode">

</div>

<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    //   function initAutocomplete() {
    //   	//alert();
    //     // Create the autocomplete object, restricting the search to geographical
    //     // location types.
    //     autocomplete = new google.maps.places.Autocomplete(
    //     	/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
    //     	{types: ['geocode']});

    //     // When the user selects an address from the dropdown, populate the address
    //     // fields in the form.
    //     autocomplete.addListener('place_changed', fillInAddress);
    // }

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')), {componentRestrictions: {country: 'in'}},
                {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }

        var entered_address = document.getElementById('autocomplete').value;
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
        var latitude = document.getElementById('latitude').value;
        var longitude = document.getElementById('longitude').value;
        var pincode = document.getElementById('postal_code').value;
        var productid = document.getElementById('productid').value;
        var city = document.getElementById('locality').value;

        var url = window.location.pathname;
        storefinder(entered_address, latitude, longitude, pincode, productid, city, url);

    }

    function geolocate() {
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
            });
        }
    }



    function storefinder(entered_address, latitude, longitude, pincode, productid, city, pagename) {

        $('#pincode').css("border-color", '');
        $('.pincheck_msg').html('');
        $('#popuppincode_loader').show();

        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/User/checkPincode',
            data: "&pincode=" + pincode + "&product_id=" + productid + "&entered_address=" + entered_address + "&latitude=" + latitude + "&longitude=" + longitude + "&pagename=" + pagename + "&city=" + city,
            dataType: "json",
            success: function (response) {

                if (response['valid'] === 'yes') {

                    shortAddr = entered_address;
                    if (entered_address.length > 20) {
                        shortAddr = entered_address.substring(0, 20) + '....';
                    }

                    var text = shortAddr + '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="(function(){ jQuery(&quot;.pho-popup-body&quot;).show();return false;})();">Change</a>';

                    $('div.pincode-location span.usr-pincode').html(text);

                    $('#popuppincode_loader').hide();
                    $('.pho-popup-body').hide();

                } else {
                    $('.recent-addr').hide();

                    if (response['externalweburl'] != 'default') {
                        $('#bigBasketUrl').attr('href', data['externalweburl']);
                    }

                    $('#popuppincode_loader').hide();
                    $('#pincode').css("border-color", "#df280a");
                    $('.pincheck_msg').html("We are sorry, We do not deliver to this location currently.");
                    $('.stores').show();
                    $('.btn-cart').hide();
                    $('.buynowbutton').show();

                }
                $('body').removeClass('noscroll');
            }
        });

    }

</script>
<script src="<?php echo $GoogleMapsUrl; ?>" async defer></script>

<script id="_webengage_script_tag" type="text/javascript">
var webengage; !function(w,e,b,n,g){function o(e,t){e[t[t.length-1]]=function(){r.__queue.push([t.join("."),
arguments])}}var i,s,r=w[b],z=" ",l="init options track screen onReady".split(z),a="feedback survey notification".split(z),c="options render clear abort".split(z),p="Open Close Submit Complete View Click".split(z),u="identify login logout setAttribute".split(z);if(!r||!r.__v){for(w[b]=r={__queue:[],__v:"6.0",user:{}},i=0;i<l.length;i++)o(r,[l[i]]);for(i=0;i<a.length;i++){for(r[a[i]]={},s=0;s<c.length;s++)o(r[a[i]],[a[i],c[s]]);for(s=0;s<p.length;s++)o(r[a[i]],[a[i],"on"+p[s]])}for(i=0;i<u.length;i++)o(r.user,["user",u[i]]);setTimeout(function(){var f=e.createElement("script"),d=e.getElementById("_webengage_script_tag");f.type="text/javascript",f.async=!0,f.src=("https:"==e.location.protocol?"https://ssl.widgets.in.webengage.com":"http://cdn.widgets.in.webengage.com")+"/js/webengage-min-v-6.0.js",d.parentNode.insertBefore(f,d)})}}(window,document,"webengage");

    webengage.init('aa132641');
</script>
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5c3ef44851410568a106db59/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>