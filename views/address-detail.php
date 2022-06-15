<?php
$customer_id = $this->session->userdata('logged_in')['customer_id'];
if($customer_id=='' || $customer_id==null) redirect(site_url());
?>
<div class="dvAddress">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href="<?php echo base_url('checkout'); ?>" class="returnCart"><i class="fas fa-angle-left"></i> Return to Checkout</a>
            </div>
            <?php
            if($address_list!=null && $address_list!=''){
            ?>    
            <input type="hidden" name="post_status" id="post_status" value="">
            <div class="addNew col-sm-12 col-lg-6 offset-lg-3">
                <button class="btn btnSecondary" onclick="showAddressForm();">Add New Address</button>
            </div>

            <div class="or col-sm-12 text-center">
                <p>OR</p>
            </div>
            <?php
            }
            ?>

            <?php $checkAddressAvailable = ($address_list==null || $address_list=='') ? 'block' : 'none'; ?>

            <div class="dvForm col-sm-12 col-lg-6 offset-lg-3">
                    <div class="row" id="addressForm" style="display:<?php echo $checkAddressAvailable; ?>;">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="First Name*" name="first_name" id="first_name" value="">
                            <p class="text-red" id="first_nameErr" style="display:none;">Please enter first name.</p>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="">
                            <p class="text-red" id="last_nameErr" style="display:none;">Please enter last name.</p>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Flat No, Building, Street, Area*" name="address" id="address" value="">
                            <p class="text-red" id="addressErr" style="display:none;">Address required</p>
                        </div>
                        <div class="col-sm-12">
                            <select class="form-control" id="city" name="city" placeholder="City*">
                                <option value="">--Select City--</option>
                                <?php foreach ($city_list as $key => $value) {?>
                                    <option value="<?= $value['city_name']; ?>"><?= $value['city_name']; ?></option>
                                <?php } ?>
                            </select>
                            <p class="text-red" id="cityErr" style="display:none;">City required</p>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Mobile*" name="mobile_number" id="mobile_number" maxlength="10" value="" onkeypress="return onlyNumberKey(event)">
                            <!-- <p class="text-red" id="mobile_numberErr" style="display:none;">Only Numbers please</p> -->
                            <p class="text-red" id="mobile_numberErr" style="display:none;">Invalid mobile number</p>
                        </div>
                        <div class="col-sm-12">
                            <!-- <input type="text" class="form-control" placeholder="Pincode*" name="pincode_data" id="pincode_data" maxlength="7" value="" onkeypress="return onlyNumberKey(event)">
                            <p class="text-red" id="pincodeErr" style="display:none;">Pincode required</p> -->
                            <input type="text" class="form-control" placeholder="Pincode*" name="pincode_data" id="pincode_data" value="" autocomplete="off">
                            <p class="text-red" id="pincodeErr" style="display:none;">Pincode required</p>
                            <p class="text-red" id="postalCodeErr" style="display:none;">Proper pincode required</p>
                            <p class="text-red" id="pincodeErrForNotDelivery" style="display:none;"></p>
                        </div>
                        <div class="radios col-sm-12 text-center">
                            <label><input type="radio" name="address_type" checked="checked" value="Home" class="hideaddressTypeOther"> Home</label>
                            <label><input type="radio" name="address_type" value="Work" class="hideaddressTypeOther"> Work</label>
                            <label><input type="radio" name="address_type" id="addressTypeOther"> Other</label>
                        </div>
                        <!-- <div class="col-sm-12">
                            <input type="hidden" id="address_id" value="">
                            <button class="btn btnSecondary" id="submitShippingAddress">Save</button>
                            <label><input type="checkbox" id="markAddressDefault"> Mark this address as Default.</label>
                        </div> -->
                        <div class="col-md-12" id="showAddressTypeOtherDiv">
                            <input type="text" name="address_type" class="form-control" id="showAddressTypeOther" placeholder="e.g Wife House" maxlength="17" style="display:none;" value="">
                            <p class="text-red" id="addressTypeErr" style="display:none;">Please enter data</p>
                        </div>
                        <div class="col-sm-12 text-center">
                            <input type="hidden" id="address_id" value=""> <!-- for update/insert in DB -->
                            <button class="btn btnSecondary" id="submitShippingAddress">Save</button>
                        </div>
                        <input type="hidden" name="locality" id="locality" value="" /> <!-- City -->
                        <input type="hidden" name="postal_code" id="postal_code" value="" /> <!-- Zip code -->
                        <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" value="" /> <!-- State -->
                        <input type="hidden" name="country" id="country" value="" /> <!-- Country -->
                        <input type="hidden" name="Addrlongitude" id="longitude" value="" /> <!-- longitude -->
                        <input type="hidden" name="Addrlatitude" id="latitude" value="" /> <!-- latitude -->    
                    </div>
                    <br>
                    <p class="text-red" id="msg" style="display:none"></p>
                    <br>
            </div>
                 
            <div class="default col-sm-12" id="addressBox">
                <div class="row">
                    <?php
                    if($address_list!=null){
                        // $countIncr = 1;
                        foreach($address_list as $data){
                        // $dot_default = ($data['is_default_shipping']==1) ? "dot-default" : null;
                    ?>
                    <div class="col-6 col-sm-4 col-lg-3 d-flex">
                        <div class="bg-grey d-flex flex-column justify-content-between">
                                <?php
                                // if($dot_default!=null){
                                    // $countIncr = 0;
                                if($data['is_default_shipping']==1){
                                ?>
                            <div class="d-flex justify-content-between align-items-center">        
                                <h5>Default</h5>
                                <div class="dot dot-default"></div>
                            </div>
                            <div>
                                <p class="title">
                                    <?php echo $data['address_type']; ?>
                                </p>
                                <p>
                                    <span><?php echo $data['first_name'] . ' ' . $data['last_name']; ?>,</span>
                                    <br>
                                    <span><?php echo $data['address'] . ' ' . $data['city'] . ' ' . $data['pincode'];?></span>
                                </p>
                            </div>     
                                <?php
                                }else{
                                ?>
                                <!-- <h5>Address <?php // echo ($countIncr); ?></h5> -->
                                <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btnDefault" onclick="makeAddressDefault('<?php echo $data['address_id']; ?>')"><h5>Set as Default</h5></button>
                                <div class="dot"></div>
                                </div>
                                <p class="title">
                                    <?php echo $data['address_type']; ?>
                                </p>
                                <p>
                                    <span><?php echo $data['first_name'] . ' ' . $data['last_name']; ?>,</span>
                                    <br>
                                    <span><?php echo $data['address'] . ' ' . $data['city'] . ' ' . $data['pincode'];?></span>
                                </p>
                                <?php
                                }
                                ?>
                                <!-- <div class="dot <?php // echo $dot_default; ?>"></div> -->
                            <div class="d-flex justify-content-between">
                                <span class="edit" onclick="editAddress('<?php echo $data['address_id']; ?>')" style="cursor:pointer;"><i class="fas fa-edit"></i> Edit</span>
                                <span class="delete" onclick="deleteAddress('<?php echo $data['address_id']; ?>')" style="cursor:pointer;"><i class="far fa-trash-alt"></i> Delete</span>
                            </div>
                            <div class="deliverHere">
                                <?php if($data['is_active']=='1'){ ?>
                                <button class="btn btnSecondary" onclick="deliverHere('<?php echo $data['address_id']; ?>')">Deliver Here</button>
                                <?php }else{ ?>
                                    <p style="color: red;">We are currently not delivering at this Address</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>  
                    <?php
                        // $countIncr++;
                        }
                    }
                    ?>    

                </div>
            </div>
        </div>
    </div>
</div>

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
                        <button class="btn btnBlackBorder" id="deleteOk" style="display:none;">OK</button>
                        <button class="btn btnBlackBorder" id="cancel_reload" style="display:none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';

        function deliverablePincode() {
            $("#postalCodeErr").html("");
            pincode = $("#postal_code").val();
            entered_address = $("#pincode_data").val();
            latitude = $("input[name=Addrlatitude]").val();
            longitude = $("input[name=Addrlongitude]").val(); 
            city = $("#locality").val();
            console.log(city,pincode,latitude,longitude,entered_address);
            if(latitude!='' && longitude!='' && entered_address!=''){ 
                dataSend = {pincode:pincode,entered_address:entered_address,latitude:latitude,longitude:longitude,city:city,'csrf_test_name':csrf_value};
                checkPincodeAjax(dataSend);
            }
        };

        function checkPincodeAjax(dataSend){
            $.ajax({
                url: "<?php echo site_url(); ?>"+'address/pincodeCheck',
                type:"POST",
                data:dataSend,
                dataType:"JSON",
                success:function(res){
                    // alert(JSON.stringify(res));
                    if(res.status=='failed'){
                        $("#pincodeErrForNotDelivery").html("We are not delivering at this pincode. Please change the pincode and Save").show();
                        return false;
                    } else if (res.status=='success') {
                        console.log('ss');
                        $("#pincodeErrForNotDelivery").html("").hide();
                        $("#pincodeErrForNotDelivery,#pincodeErr,#postalCodeErr").hide();
                    } else{
                        // alert('Someting went wrong, please try again after sometime');
                    }
                }
            })
        }

        $("#submitShippingAddress").on('click', function(){
            foundErr = false;
            first_name = $("#first_name").val();
            last_name = $("#last_name").val();
            mobile_number = $("#mobile_number").val();
            address = $("#address").val();
            city = $("#city").val();
            pincode = $("input[name=pincode_data]").val().trim(); // $("#pincode_data").val();
            postal_code = $("#postal_code").val(); // hidden pincode
            /*locality = $("#locality").val(); // hidden city*/
            administrative_area_level_1 = $("#administrative_area_level_1").val(); // hidden state
            country = $("#country").val(); // hidden state
            address_id = $("#address_id").val();
            address_type = $("input[name=address_type]:checked").val();
            // markAddressDefault = ($("#markAddressDefault").is(':checked'))?1:'';
            
            cssAddressType = $("#showAddressTypeOther").css('display');
            addressTypeOther = $("#showAddressTypeOther").val();

            if(first_name!=''){
                $("#first_nameErr").hide();
            }
            
            /*if(last_name!=''){
                $("#last_nameErr").hide();
            }*/
            if(address!=''){
                $("#addressErr").hide();
            }
            if(city!=''){
                $("#cityErr").hide();
            }
            if(mobile_number!=''){
                $("#mobile_numberErr").hide();
            }
            if(pincode!=''){
                $("#pincodeErr").hide();
            }
            if(postal_code!=''){
                $("#postalCodeErr").hide();
            }

            if(first_name==null || first_name=='' || (first_name.length<2)){
                $("#first_nameErr").show();
                foundErr = true;
            }

            if(address==null || address==''){
                $("#addressErr").show();
                foundErr = true;
            }
            if(city==null || city==''){
                $("#cityErr").show();
                foundErr = true;
            }
            if(mobile_number==null || mobile_number=='' || isNaN(mobile_number)){
                $("#mobile_numberErr").show();
                foundErr = true;
            }
            // if(pincode==null || pincode=='' || isNaN(pincode)){
            if(pincode==null || pincode==''){
                $("#pincodeErr").show();
                $("#pincodeErrForNotDelivery,#postalCodeErr").hide();
                foundErr = true;
            }
            if(postal_code==null || postal_code==''){
                // alert('Proper Pincode needed');
                $("#postalCodeErr").show();
                $("#pincodeErrForNotDelivery,#pincodeErr").hide();
                foundErr = true;
            }

            if(cssAddressType=='block'){
                if(addressTypeOther!=''){
                    $("#addressTypeErr").hide();
                }
                if(addressTypeOther==null || addressTypeOther==''){
                    $("#addressTypeErr").show();
                    foundErr = true; 
                }
                address_type = addressTypeOther;
            }

            if ($("#pincodeErrForNotDelivery").html()!='') {
                foundErr = true;
            }
            
            if(foundErr==false){
                // data = {first_name:first_name, last_name:last_name, mobile_number:mobile_number, address:address, city:city, pincode:pincode, address_type:address_type, address_id:address_id, 'csrf_test_name': csrf_value};
                data = {first_name:first_name, last_name:last_name, mobile_number:mobile_number, address:address, city:city, pincode:postal_code, address_type:address_type, state:administrative_area_level_1,country:country,address_id:address_id, 'csrf_test_name': csrf_value};

                if(address_id!=null && address_id!='' && address_id!=0){
                    url = '<?php echo site_url(); ?>' + 'address/updateAddress';
                }else{
                    url = '<?php echo site_url(); ?>' + 'address/setShippingAddress';
                }
                postAjax(url, data);
            }
        });

        function showAddressForm(){
            $("#addressForm").toggle();
            // $("#first_name,#last_name,#address,#city,#mobile_number,#pincode_data,#address_id").attr("value", "");
            $("#first_name,#last_name,#address,#city,#mobile_number,input[name=pincode_data],#address_id").attr("value", "");
            $("#markAddressDefault").prop("checked", false);
        }

        $("#addressTypeOther").on('click', function(){
            if($("#addressTypeOther").is(':checked')){
                // $("#showAddressTypeOther").val("");
                $("#showAddressTypeOther").show();
                // alert('Test');
            }
        });

        $(".hideaddressTypeOther").on('click', function(){
            // $("#showAddressTypeOther").val("");
            $("#showAddressTypeOther,#addressTypeErr").hide();
            // alert('hide address');
        });

        function makeAddressDefault(address_id){
            url = '<?php echo site_url(); ?>' + 'address/setAddressDefault';
            data = {address_id:address_id, 'csrf_test_name':csrf_value};
            // alert('Make address default: ' + address_id);
            postAjax(url, data);
        }

        function editAddress(address_id){
            data = {address_id:address_id, 'csrf_test_name':csrf_value};
            url = '<?php echo site_url(); ?>' + 'address/addressEdit';
            getAjax(url, data); // Will show form with values
        }
        
        function deleteAddress(address_id){
            var data = {address_id:address_id, 'csrf_test_name':csrf_value};
            var url = '<?php echo site_url(); ?>' + 'address/addressDelete';

            $("#ok_reload").hide();
            $("#modalBox,#cancel_reload,#deleteOk").show();
            $("#msgInModalBox").html("Are you sure you want to remove this address?");

            $("#deleteOk").unbind('click').click(function(){ // unbind previously set click event 
                $("#modalBox,#deleteOk").hide();
                postAjax(url,data);
            });

        }

        $("#cancel_reload").on('click', function(){
            location.reload(true);
        });        

        function deliverHere(address_id){
            data = {address_id:address_id, 'csrf_test_name':csrf_value};
            url = '<?php echo base_url(); ?>' + 'address/setAddressDeliverHere';
            postAjax(url,data);
        }

        function postAjax(url, data){
            $.ajax({
                url: url,
                type:'POST',
                data: data,
                dataType: "JSON",
                success:function(response){
                    if(response.status=='failed'){
                        $("#post_status").val(response.status);
                        showModalBox(response.message);
                    } else if(response.status=='success') {
                        $("#post_status").val(response.status);
                        if (response.message=='Delivery address updated successfully') {
                            window.location.href= "<?php echo base_url('checkout'); ?>";
                        } else if (response.message=='Address deleted successfully') {
                            showModalBox(response.message);
                        } else if (response.message=='Address updated successfully') {
                            showModalBox(response.message);
                        } else if (response.message=='Address created successfully') {
                            
                            if(response.totalAddress==1){ // If first time address created
                                window.location.href='<?php echo base_url('checkout'); ?>';
                            }else{
                                showModalBox(response.message);    
                            }
                            
                        } else if (response.message=='Address has been made default') {
                            showModalBox(response.message);
                        } else {
                            alert('Success condition not matching with any requirement');
                            return false;
                        }
                    } else {
                        /*alert('Something went wrong, sorry please try again!');
                        return false;*/
                    }
                    
                }
            });
        }

        function showModalBox(msg){
            $("#modalBox, #ok_reload").show();
            $("#cancel_reload, #deleteOk").hide();
            $("#msgInModalBox").html(msg).show();
        }

        $("#ok_reload").on('click', function(){
            if($("#post_status").val() == "failed"){
                $("#modalBox").hide();    
            }else{
                window.location.reload(true);    
            }
        });

        function getAjax(url, data){

            $.ajax({
                url: url,
                type:'GET',
                data: data,
                dataType: "JSON",
                success:function(response){

                    if(response.status=='failed'){
                        showModalBox(response.message);
                    } else if (response.status=='success') {
                        var res = response.data;
                        // var is_default_shipping = (res['is_default_shipping']==1)?true:false;

                        $("#addressForm").css({"display":"block"}); // Open address form

                        $("#first_name").attr("value", res['first_name']);
                        $("#last_name").attr("value", res['last_name']);
                        $("#address").attr("value", res['address']);
                        $("#city option[value="+res['city']+"]").attr("selected", "selected");
                        $("#administrative_area_level_1").prop("value", res['state']);
                        $("#mobile_number").attr("value", res['mobile_number']);
                        // $("#pincode_data").attr("value", res['pincode']);
                        $("input[name=pincode_data]").attr("value", res['pincode']);
                        $("#postal_code").prop("value", res['pincode']); // hidden field 'same as pincode'
                        $("#country").prop("value", res['country']); // hidden field
                        
                        if(res['address_type']!='Home' || res['address_type']!='Work'){
                            $("#addressTypeOther").prop("checked", true);
                            $("#showAddressTypeOther").show();
                            $("#showAddressTypeOther").val(res['address_type']);
                        }

                        if(res['address_type']=='Home'){
                            removeAttrValueForAddressTypeOther();
                            $("input:radio[value=Home]").prop("checked",true);
                        }

                        if(res['address_type']=='Work'){
                            removeAttrValueForAddressTypeOther();
                            $("input:radio[value=Work]").prop("checked",true);
                        }

                        $("#address_id").attr("value", res['address_id']);

                        // $("#markAddressDefault").prop("checked", is_default_shipping);
                    }
                }
            });
        }

        function removeAttrValueForAddressTypeOther(){
            $("#addressTypeOther").attr("checked", false);
            $("#showAddressTypeOther").hide();
            $("#showAddressTypeOther").val("");
        }

        function onlyNumberKey(evt) {
            // Only ASCII charactar in that range allowed 
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
                return false; 
            return true;
        }

        /** For Google pincode go to assets/js/footer.js **/

    // })
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0HOEKILngJVQlwBEEFNwVGAwY4EHE27I&libraries=places&callback=initAutocomplete" async defer></script> -->
