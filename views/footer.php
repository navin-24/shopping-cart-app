</div>
<footer class="dvFooter">
    <div class="container">
        <div class="row others">
            <div class="col-lg-4 text-center">
                <!-- <h4>All Good. No Bad.</h4>
                <p class="content">
                    Raw Pressery makes fresh cold pressed juices and almond milks, delivered straight at your
                    doorstep.
                </p> -->
            </div>
            <div class="col-lg-4">
                <ul class="nav d-flex justify-content-center align-items-lg-center h-100">
                    <!-- <li>
                        <a href="<?= base_url('shop/juices'); ?>">Shop</a>
                    </li>
                    <li>
                        <a href="<?= base_url('process'); ?>">Learn (Process)</a>
                    </li> -->
                    <!-- <li>
                        <a href="<?= ASSET_URL . 'cleanse-guide/cleanse-guide.pdf' ?>" target="_blank">Cleanse Guide</a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('contact-us'); ?>">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 text-center signupt">
                <h4>Sign-up to get Closer</h4>
                <form method="post" id="newsletter-validate-detail">
                    <input type="text" class="form-control br0" placeholder="Enter Real Email Id" id="newsletter_email">
                    <button type="submit" class="btn btnSubscribe">Subscribe</button>
                </form>
                <div class="validationCss">
                    <div class="loader" id='newsletter_loader'></div>
                    <p id="info"></p>
                </div>
            </div>
        </div>
        <div class="row copyRight">
            <div class="col-sm-12 text-center">
                <p>&copy; <?= date('Y'); ?> Rakyan Beverages</p>
                <p>
                    <a href="<?= base_url('terms-and-condition'); ?>">Terms</a>
                    <a href="<?= base_url('privacy-policy'); ?>">Privacy Policy</a>
                    <a href="<?= base_url('returns-and-refunds'); ?>">Return &amp; Refund Policy</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<?php $this->load->view('location_popup'); ?>
<?php $this->load->view('search_popup'); ?>


<script src="<?= ASSET_URL ?>js/owl.carousel.min.js"></script>
<script src="<?= ASSET_URL ?>js/main.js"></script>

<script src="<?= ASSET_URL ?>js/footer.js"></script>
<script src="https://static.elfsight.com/platform/platform.js" defer="defer"></script>
<script>


    $(function () {
        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';




<?php if ($pageName == 'home' && $cookieAddress == '') { ?>
            $("#myModal").show();
<?php } ?>

        $('form#newsletter-validate-detail').submit(function (e) {
            e.preventDefault();

            var email = $.trim($('#newsletter_email').val());
            if (email === '') {
                $("p#info").addClass('text-red');
                $('#info').text('Please enter a email address.').show().fadeOut(3000);
                return;
            }
            $('#newsletter_loader').show();

            $.post('<?= base_url('newsletter/subscribe') ?>', {email: email, 'csrf_test_name': csrf_value}, function (data) {
                $('#newsletter_loader').hide();
                if (data) {
                    $('#newsletter-validate-detail').trigger("reset");
                    var textcls = (data.result === "success") ? "text-green" : "text-red";
                    $('input#newsletter_email').val(' ');
                    $("p#info").addClass(textcls);
                    $('p#info').text(data.msg).show().fadeOut(5000);
                    webengage.track("Newsletter Subscribed",{
                        "Email":email,
                        "Status":"Success"
                    });
                } else {
                    $("p#info").addClass('text-red');
                    $('p#info').text('There was a problem. Please try later');
                }
            }, 'json');
        });

        $('#promoCode').click(function () {
            var emailaddress = $.trim($('#promoEmail').val());
            var entered_address = $.trim($('#autocomplete').val());
            var pincode = $('#postal_code').val();

            $('.promoEmailTxt').html('');

            if (emailaddress.length === 0) {
                $('#promoEmailTxt').text("Please enter the email");
                return false;
            } else if (!validateEmail(emailaddress)) {
                $('#promoEmailTxt').text("Please enter valid email id");
                return false;
            } else {
                //$('.spin-loader').show();

                $.post('<?= base_url('home/sendPromocode') ?>', {email: emailaddress, pincode: pincode, entered_address: entered_address, 'csrf_test_name': csrf_value}, function (response) {
                    var textcls = (response.status === "success") ? "text-green" : "text-red";
                    if (response.status == 'success') {
                        $("p#promoEmailTxt").addClass(textcls);
                        $('#promoEmailTxt').html('<i class="fa fa-check" aria-hidden="true"></i>&nbsp' + response.msg);
                        webengage.track("Get Promo Code",{
                            "Email":emailaddress,
                            "Status":"Success"
                        });
                    } else {
                        $("p#promoEmailTxt").addClass(textcls);
                        $('#promoEmailTxt').html(response.msg);
                    }

                    setTimeout(function () {
                        $('#promoCodeModal').hide();
                        $(".pincodeModal .close").trigger('click');
                    }, 3000);
                }, 'json');

                /*$.ajax({
                 url: "<?= base_url('home/sendPromocode'); ?>",
                 type: "POST",
                 data: "email=" + emailaddress + "&pincode=" + pincode + "&entered_address=" + entered_address,
                 dataType: "json",
                 success: function (response) {
                 var textcls = (response.status === "success") ? "text-green" : "text-red";
                 if (response.status == 'success') {
                 $("p#promoEmailTxt").addClass(textcls);
                 $('#promoEmailTxt').html('<i class="fa fa-check" aria-hidden="true"></i>&nbsp' + response.msg);
                 } else {
                 $("p#promoEmailTxt").addClass(textcls);
                 $('#promoEmailTxt').html(response.msg);
                 }
                 
                 setTimeout(function () {
                 $(".pho-close_btn").trigger('click');
                 }, 3000);
                 
                 }
                 });*/
            }

        });

        $("a.play-btn").on("click", function () {
            var videoUrl = $(this).attr('rel');
            //setTimeout(function(){
            $('div#home-video').show();
            $('div#home-video iframe').attr('src', videoUrl);
            //}, 1000);
        });

        $('#home-video .btn-close').click(function () {
            $('div#home-video').hide();
            $('div#home-video iframe').attr('src', ' ');
            $('#verifyOtpPop .btn-close').trigger('click');
        });


        $('#search_mini_form #searchTxt').bind("keyup paste", function (e) {
            var searchText = $.trim($(this).val().toLowerCase());
            console.log(searchText);
            setTimeout(function () {
                var code = (e.keyCode || e.which);
                if (code != 38) {
                    searchAjaxProducts(searchText);
                }
            }, 1000);
        });


        $('form#search_mini_form').submit(function (e) {
            e.preventDefault();
            var searchText = $.trim($('#searchTxt').val().toLowerCase());
            if (searchText != "") {
                searchAjaxProducts(searchText);
            }
            return false;
        });


        /*$.post( ajax_url, { data: 'value', 'csrf_test_name': csrf_value }, function( response ) {
         // response
         }, 'json' );*/

        $(document).delegate('.add_to_cart_btn','click',function () {

            jspincode_cookie = readCookie("pincode_cookie");
            if (jspincode_cookie === '' || jspincode_cookie == null) {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
                return;
            }

            var product_id = $(this).attr("id");
            var option_value = $("input[name='select']:checked").attr('option_value');
            var option_name = $("input[name='select']:checked").attr('option_name');

            if (typeof option_value === "undefined") {
                var option_value = $("input[type=radio][name='" + product_id + "']:checked").val();
            }
            if (typeof option_name === "undefined") {
                var option_name = $("input[type=radio][name='" + product_id + "']:checked").attr('option_name');
            }


            if (product_id > 0)
            {
                $('#product_add_cart_' + product_id + ' .add_to_cart_btn').html("Adding...");

                $.post('<?= base_url('cart/addToCart') ?>', {'product_id': product_id, 'option_value': option_value, 'option_name': option_name, 'csrf_test_name': csrf_value}, function (response) {
                    if (response.status == 'success') {
                        var name = product_id;
                        var getValueButton = $('.select3Options input:radio[name=" + name + "]:checked').attr('id')
                        var getValue = $(".selectOptions input:radio[name=" + name + "]:checked").attr('id')

                        $(".select3Options input:radio[name=" + name + "]").not('#' + getValueButton).prop('disabled', true);
                        $(".selectOptions input:radio[name=" + name + "]").not('#' + getValue).prop('disabled', true);

                        $('#product_add_cart_' + product_id + ' .add_to_cart_btn').html("Add to cart");
                        $('#product_add_cart_' + product_id + ' .add_to_cart_btn').hide();
                        $('#product_add_cart_' + product_id + ' .btnPlusMinus').show();
                        $('#product_add_cart_' + product_id + ' span.increment').attr("row_id", response.row_id);
                        $('#product_add_cart_' + product_id + ' input[type=text].qty-text').val(response.quantity);
                        $('.total_cart_item').text(response.total_cart_item);
                        webengage.track("Added To Cart", {
                            "Product Id": product_id,
                            "Product Name": response.productDetails.product_name,
                            "Category Name": response.productDetails.category_name,
                            "Price": parseFloat(response.cart_item.price.replace(',','')),
                            "Quantity": response.cart_item.qty,
                            "Currency": 'INR',
                            "Category Id": response.productDetails.category.category_id,
                            "Product Image": response.productDetails.thumb_image_url
                        });
                    }
                }, 'json');

            }
        });

        $('div.buttons span.increment').click(function () {
            var product_id = $(this).attr("productid");
            var sku = $(this).attr("sku");
            var quantity = $('#product_add_cart_' + product_id + ' input[type=text].qty-text').val();
            var row_id = $(this).attr("row_id");

            quantity = ($(this).hasClass('minus')) ? parseInt(quantity) - 1 : parseInt(quantity) + 1;
            web_action = ($(this).hasClass('minus')) ? 'Added To Cart' : 'Removed from Cart';



            $.post('<?= base_url('cart/updateCart') ?>', {'row_id': row_id, 'quantity': quantity, 'sku': sku, 'csrf_test_name': csrf_value}, function (response) {
                if (response.status == 'success') {
                    if (quantity == 0) {
                        $(".select3Options input:radio[name=" + product_id + "]").prop('disabled', false);
                        $(".selectOptions input:radio[name=" + product_id + "]").prop('disabled', false);
                        $('#product_add_cart_' + product_id + ' .add_to_cart_btn').show();
                        $('#product_add_cart_' + product_id + ' .btnPlusMinus').hide();
                    }
                    $('#product_add_cart_' + product_id + ' input[type=text].qty-text').val(quantity);
                    $('.total_cart_item').text(response.total_cart_item);

                    var product_name = $('div.prod_data_' + product_id).attr('product_name');
                    var product_price = $('div.prod_data_' + product_id).attr('product_price');
                    var category_id = $('div.prod_data_' + product_id).attr('category_id');
                    var category_name = $('div.prod_data_' + product_id).attr('category_name');
                    var product_image = $('div.prod_data_' + product_id).attr('product_image');


                    /*webengage.track(web_action, {
                     "Product Id": product_id,
                     "Product Name": product_name,
                     "Category Name": category_name,
                     "Price": product_price,
                     "Quantity": quantity,
                     "Currency": 'INR',
                     "Category Id": category_id,
                     "Product Image": product_image}
                     );*/


                }
            }, 'json');
        });

        $('div.cartButtons button.plus, button.minus').click(function () {
            let obj = $(this);
            var sku = obj.attr("sku");
            var inputs = $(this).parent().find('input');
            var quantity = parseInt(inputs.val());
            //var quantity = $(this).parent().find('input[type=text].qty-text').val();
            var row_id = $(this).attr("row_id");

            quantity = ($(this).hasClass('minus')) ? quantity - 1 : quantity + 1;

            $.post('<?= base_url('cart/updateCart') ?>', {'row_id': row_id, 'quantity': quantity, 'sku': sku, 'csrf_test_name': csrf_value}, function (response) {
                if (response.status == 'success') {
                    inputs.val(quantity);
                    $('.total_cart_item').text(response.total_cart_item);
                    $('.subtotal').text(response.cart_total);
                    $('.grandtotal').text(response.cart_total);
                    $('#amt_' + row_id).text(response.line_item_price);

                    if (quantity == 1)
                    {
                        //$('button.minus').attr('disabled', true).addClass('disabled');

                        $(obj).parent().find(".minus").attr('disabled', true).addClass('disabled');
                        //$(obj).parent().find(".plus").removeAttr('disabled').removeClass('disabled');
                        //$('button.minus').addClass("disabled");
                        //$("button.minus").attr("disabled", true);
                        //$('div#' + product_id).hide();
                    } else {
                        //$(obj).attr("disabled", false).removeClass("disabled");
                        $(obj).parent().find(".minus").removeAttr('disabled').removeClass('disabled');
                    }
                }
            }, 'json');

        });


        $('.removeCart').click(function () {
            var cart_item_id = $(this).attr("cart_item_id");
            var sku = $(this).attr("sku");

            $('#confirm_remove_cart_item').show();
            $("#proceed_remove_item").attr("data-cart-id", cart_item_id);
            $("#proceed_remove_item").attr("data-sku", sku);
            $('#cancel_remove_item').on('click', function (e) {
                $('#confirm_remove_cart_item').hide();
                return false;
            })
        });


        $('#proceed_remove_item').click(function () {
            var cart_item_id = $("#proceed_remove_item").attr("data-cart-id");
            var sku = $("#proceed_remove_item").attr("data-sku");
            if (cart_item_id)
            {

                $.post('<?= base_url('cart/updateCart') ?>', {'row_id': cart_item_id, quantity: 0, 'sku': sku, 'csrf_test_name': csrf_value}, function (response) {

                    if (response.status == 'success') {
                        webengage.track("Removed from Cart", {
                            "Product Id": response.productDetails.product_id,
                            "Product Name": response.productDetails.product_name,
                            "Category Name": response.productDetails.category_name,
                            "Price": parseFloat(response.productDetails.special_price.replace(',','')),
                            "Quantity": response.productDetails.quantity,
                            "Currency": 'INR',
                            "Category Id": response.productDetails.category.category_id,
                            "Product Image": response.productDetails.thumb_image_url
                        });
                        if (response.total_cart_item == 0)
                        {
                            location.reload();
                            return;
                        }
                        $('#cart_item_' + cart_item_id).hide();
                        $('.total_cart_item').text(response.total_cart_item);
                        $('.subtotal').text(response.cart_total);
                        $('.grandtotal').text(response.cart_total);
                        $('#confirm_remove_cart_item').hide();
                        location.reload();
                        return;
                    }

                }, 'json');

            }
        });


        /*$('.applyCoupon').click(function () {

            var coupon_code = $("input[name='coupon']").val();
            $.post('<?= base_url('cart/applyCouponCode') ?>', {coupon_code: coupon_code, 'csrf_test_name': csrf_value}, function (response) {
                if (response.status == 'success') {
                    //$('div#' + productid).hide();
                    //$('.total_cart_item').text(response.total_cart_item);
                    $('.grandtotal').text(response.cart_total);

                    webengage.track("Coupon Code Applied", {
                     "Cart Value Before Discount" : <?php echo $cartBaseTotal; ?>,
                     "Cart Value After Discount" : response.cart_total,
                     "Coupon Code"   : coupon_code",
                     "Status" : "success",
                     "Discount Value": <?php echo abs($totalCartDiscount); ?>
                     });
                }
            }, 'json');
        });*/

        $('.removeCoupon').click(function () {
            var coupon_code = $(this).attr("couponcode");
            $.post('<?= base_url('cart/removeCouponCode') ?>', {coupon_code: coupon_code, 'csrf_test_name': csrf_value}, function (response) {
                if (response.status == 'success') {
                    //$('div#' + productid).hide();
                    //$('.total_cart_item').text(response.total_cart_item);
                    $('.grandtotal').text(response.cart_total);
                    $('.subtotal').text(response.cart_total);
                }
            }, 'json');
        });
        $('#paymentok').click(function () {
            $("#failModal").hide();
        });
    });


    function searchAjaxProducts(searchText) {
        var ajaxUrl = '<?php echo base_url('product/getSearchResult'); ?>';
        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        if (searchText !== '' && searchText.length > 2) {
            $('div#search-loader').css("display", "block");
            $('p#no-search').css("display", "none");

            $.ajax({
                url: ajaxUrl,
                type: "GET",
                data: {q: searchText, 'csrf_test_name': csrf_value},
                dataType: "json",
                cache: "false",
                success: function (responseData) {

                    var output = '';
                    $('div#search-loader').css("display", "none");
                    if (responseData.status === 'success') {

                        $.each(responseData.data, function (key, val) {
                            console.log(val);
                            output += '<div class="col-lg-4"><div class="row">';
                            output += '<div class="col-lg-4"><a href="' + val.product_url + '"><img src="<?= PRODUCT_THUMB_PATH ?>' + val.thumb_image_url + '" class="img-fluid" alt=""></a></div>';
                            output += '<div class="col-lg-8"><h6>' + val.product_name + '</h6><p>' + val.varient + '</p>';

                            if (val.special_price > 0)
                            {
                                output += '<div><span class="deleted"><span class="strike"></span><span class="strikePrice"><sup><i class="fas fa-rupee-sign"></i></sup><span>' + val.base_price + '</span></span></span><span class="price"><sup><i class="fas fa-rupee-sign"></i></sup><span>' + val.special_price + '</span></div></div></div></div>';
                            } else {
                                output += '<div><span class="showPrice"><sup><i class="fas fa-rupee-sign"></i></sup><span>' + val.special_pricebase_price + '</span></div></div></div></div>';
                            }
                        });
                    } else {
                        console.log('middle');
                        $('p#no-search').css("display", "block");
                    }

                    $('div#ajaxResult').html(output);
                }
            });
            webengage.track("Product Searched", {
             "Search Keyword": searchText,
             "Sorted By": "entity_id"
             });
        } else {
            $('div#ajaxResult').html('');
            $('div#search-loader').css("display", "none");
            $('div#no-search').css("display", "none");
        }
    }

    function showPosition(position) {
        $("#locationLoader").show();
        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
            type: 'POST',
            url: "<?= base_url('home/getpincodeByLocation') ?>",
            data: {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude,
                'csrf_test_name': csrf_value
            },
            success: function (result) {
                $("#locationLoader").hide();
                if (result !== '') {
                    $("#usrPincode").html(result);
                    $("#musrPincode").html(result);
                    $('input#autocomplete').val(result);
                } else {
                    $("#usrPincode").html('');
                    $("#musrPincode").html('');
                }
            }
        });
    }

    function checkDeliverablePincode() {
        var entered_address = $('#autocomplete').val();
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var postal_code = $('#postal_code').val();
        var street_number = $('#street_number').val();
        var city = $('#locality').val();
        var webPageName = "<?= $pageName; ?>";
        if(street_number)
        {
            var pincode = street_number;
        }
        else{
            
            var pincode = postal_code;
        }
        
        var form_id = $('form').attr('id');
        var pagename = window.location.pathname;
        var storeAddr = localStorage.getItem("recent_addr");
        var shortAddr = city +" - "+ pincode;//(entered_address.length > 20) ? entered_address.substring(0, 20) + '....' : entered_address;
        var recentAddress = entered_address + '|' + storeAddr;
        localStorage.setItem("recent_addr", recentAddress);
        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';

        $('#geoinfo').html('');
        jspincode_cookie = readCookie("pincode_cookie");
        console.log('cookie_pincode'+jspincode_cookie);
        console.log('pincode'+pincode);

        $.post('<?= base_url('home/pincodeCheck') ?>', {pincode: pincode, entered_address: shortAddr, latitude: latitude, longitude: longitude, pagename: pagename, city: city, 'csrf_test_name': csrf_value}, function (response) {
            if (response.status === "success") {
                if (form_id!='bulkorder') {
                    $("#usrPincode").html(shortAddr);
                    $("#musrPincode").html(shortAddr);
                    $("#pincode2").text('Change');
                    $("#pincode").text('Change');
                    $('#promoCodeModal').show();
                    if (jspincode_cookie === '' || jspincode_cookie == null)
                    {
                        $('#promoCodeModal').show();
                        console.log(webPageName);
                        if(webPageName == 'product'){
                            segments = pagename.split('/');
                            category = segments[segments.length-1].split('.');
                            $.ajax({
                                url:'<?= base_url('product/product_refresh') ?>',
                                type:"POST",
                                dataType:"html",
                                data:{category:category[0],csrf_test_name:csrf_value},
                                success: function(res){
                                    $(".dvProducts").html(res);
                                }
                            });
                        }
                    } else {
                        $('#myModal').hide();
                        location.reload();
                    }
                }else{
                    $('#deliveryErrMsg').css({"display": "none"});
                }
            } else {
                $('#promoCodeModal').hide();
                $("p#geoinfo").addClass('text-red');
                $('#geoinfo').html(response.msg);
                if (form_id=='bulkorder') {
                    $('#deliveryErrMsg').css({"display": "block"}).html(response.msg);
                    $('#autocomplete').val('');    
                }
            }
        }, 'json');
    }


    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ')
                c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0)
                return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAP_APIKEY ?>&libraries=places&callback=initAutocomplete" async defer></script>
</body>
</html>
