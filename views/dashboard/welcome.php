<?php
/* $fullname = $this->session->userdata('logged_in')['first_name'] . ' ' . $this->session->userdata('logged_in')['last_name'];
  $email = $this->session->userdata('logged_in')['email'];
  $mobile = $this->session->userdata('logged_in')['mobile_number']; */
?>
<section class="dvAccount">
    <div class="container">
        <div class="row">
            <div class="dvProfile col-lg-12 text-center">
                <img src="<?= ASSET_URL ?>imgs/user-icon.jpg" class="img-fluid rounded" alt="">
                <h4 id="fullName" class="showCustomerFullName"><?php // echo $fullname;   ?></h4>
                <p id="email" class="showCustomerEmail"><?php // echo $email;   ?></p>
            </div>
        </div>        
        <div id="dvTab" class="row bg">
            <input type="hidden" name="post_status" id="post_status" value="">
            <!-- <div class="col-sm-12 text-center">
                <h4>Dashboard</h4>
            </div> -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="tabs d-flex flex-nowrap flex-lg-wrap justify-content-between justify-content-sm-center">
                            <!-- <li id="defaultOpen" class="tablinks" id="tabDashboard" onclick="myTabs(event, 'dashboard')">Dashboard</li> -->
                            <li id="defaultOpen" class="tablinks" onclick="myTabs(event, 'dashboard')">Dashboard</li>
                            <li class="tablinks" id="tabPersonalInfo" onclick="myTabs(event, 'personalInfo')"><span class="d-none d-lg-inline-block">Personal</span> Info</li>
                            <li class="tablinks" id="tabSavedAddress" onclick="myTabs(event, 'savedAddress')"><span class="d-none d-lg-inline-block">Saved</span> Address</li>
                            <li class="tablinks" id="tabYourOrders" onclick="myTabs(event, 'yourOrders')"><span class="d-none d-lg-inline-block">Your</span> Orders</li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div id="dashboard" class="tabcontent">
                            <div class="row mt15">
                                <!-- <div class="col-sm-12 text-center">
                                    <h4>Your Dashboard</h4>
                                    <p>Feel free to edit any of your details below so your account is totally up to date.</p>
                                </div> -->
                                <div class="col-lg-4 mb15">
                                    <div class="bg-grey">
                                        <button class="btnEdit editPersonalInfoInDashboard" onclick="myTabs(event, 'personalInfo')">Edit</button>
                                        <h4>Personal Info</h4>
                                        <p class="showCustomerFullName"><?php // echo $fullname;   ?></p>
                                        <p class="showCustomerEmail"><?php // echo $email;   ?></p>
                                        <p class="showCustomerMobile"><?php // echo $mobile;   ?></p>
                                        <!-- <p>Change Password</p> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 mb15">
                                    <div class="bg-grey">
                                        <button class="btnEdit" id="editAddressInDashboard" style="display:none;">Edit</button>
                                        <button class="btnEdit" id="addAddressInDashboard" style="display:none;">Add</button>
                                        <h4>Billing Address</h4>
                                        <p id="addressTypeInDashboard"></p>
                                        <p id="billingAddressInDashboard"></p>
                                        <p id="billingAddressMsg"></p>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb15">
                                    <div class="bg-grey">
                                        <button class="btnEdit editPersonalInfoInDashboard" onclick="myTabs(event, 'personalInfo')">Edit</button>
                                        <h4>Change Password</h4>
                                        <p>************</p>
                                        <p>Click on edit button to edit your password.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb10 mt15 text-center recentOrdersInDashboard" style="display:none;">
                                    <h4>Recent Orders</h4>
                                </div>
                                <div class="col-sm-12 recentOrdersInDashboard" style="display:none;">
                                    <div class="table-responsive" id="recent_orders">
                                        <!-- <table>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Ship to</th>
                                                <th>Total</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">View Order</th>
                                                <th class="text-center">Reorder</th>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>12/07/2020</td>
                                                <td>Lower Parel Office</td>
                                                <td>1240.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>12/01/2020</td>
                                                <td>Borivali House</td>
                                                <td>1540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>12/05/2020</td>
                                                <td>Pune Bunglow</td>
                                                <td>1,25,540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>1/01/2020</td>
                                                <td>Wife House</td>
                                                <td>12540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>2/01/2020</td>
                                                <td>Santacruz House</td>
                                                <td>540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                        </table> -->
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12 text-center viewAllOrdersInDashboard" style="display:none;"> -->
                                <div class="col-sm-12 text-center viewAllOrders" onclick="viewAllOrders('dashboard')" style="display:none;">
                                    <!--<button class="btn btnSecondary">View All Orders</button>-->
                                </div>
                            </div>
                        </div>

                        <div id="personalInfo" class="tabcontent">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-12 text-center mb10 mt15">
                                            <h4>Edit Personal Info</h4>
                                            <p>Feel free to edit any of your details below.</p>
                                        </div>
                                        <div class="col-sm-12">
                                            <!-- <form action=""> -->
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4 offset-lg-2">
                                                    <input type="text" id="fullnameInPersonalInfo" name="fullnameInPersonalInfo" class="form-control" placeholder="Full Name" value="">
                                                    <p class="text-red" id="fullnameErrInPersonalInfo" style="display:none;text-align:center;"><!-- Atleast 3 characters --> Full Name required</p>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <input type="text" id="emailInPersonalInfo" name="emailInPersonalInfo" class="form-control" placeholder="Email Id" value="">
                                                    <p class="text-red" id="emailErrInPersonalInfo" style="display:none;text-align:center;">Invalid email</p>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button class="btn btnSecondary" id="submitNameEmailInPersonalInfo">Save</button>
                                                </div>
                                            </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-lg-12">
                                    <!-- /this is the button onclick show the below change password div and button gets hide -->
                                    <div class="row">
                                        <div class="col-sm-12 text-center" style="margin-top:15px;">
                                            <!-- <button class="btn btnSecondary" id="changepwdbtn">Change Password</button> -->
                                            <label class="btn btnPrimary checkBtn"><input type="checkbox" name="changepwd">Change Password</label>
                                        </div>
                                    </div>
                                    <!-- /added display none here to hide this div -->
                                    <div class="row" style="display:none;" id="changepwd">
                                        <div class="col-sm-12 text-center mb10 mt15">
                                            <h4>Change Password</h4>
                                            <p>Change your password with these easy steps below.</p>
                                        </div>
                                        <div class="col-sm-12">
                                            <!-- <form action=""> -->
                                            <div class="row">
                                                <div class="col-md-4 col-lg-4" id="currentPasswordDiv" style="display:none;">
                                                    <input type="password" style="display:none;" id="currentPassword" name="currentPassword" class="form-control" placeholder="Current Password" value="" onkeydown="return notAllowSpaces();">
                                                    <p class="text-red" id="currentPwdErr" style="display:none;text-align:center;">Current password required</p>
                                                </div>
                                                <div class="col-md-4 col-lg-4" id="newPasswordDiv">
                                                    <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="New Password" value="" onkeydown="return notAllowSpaces();">
                                                    <p class="text-red" id="newPwdErr" style="display:none;text-align:center;">New password required</p>
                                                </div>
                                                <div class="col-md-4 col-lg-4" id="confirmPasswordDiv">
                                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" value="" onkeydown="return notAllowSpaces();">
                                                    <p class="text-red" id="confirmPwdErr" style="display:none;text-align:center;">Confirm password required</p>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <p class="text-red" id="confirmPasswordErr" style="display:none;text-align:center;">Please make sure your passwords match</p>
                                                    <button class="btn btnSecondary" id="submitPwdInPersonalInfo">Save</button>
                                                </div>
                                            </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="savedAddress" class="tabcontent">
                            <div class="row">   
                                <div class="default col-sm-12">
                                    <div class="row" id="addressBox" style="display:none;">
                                    </div>
                                </div>
                                <div class="col-sm-12 mt15 text-center">
                                    <button id="addBtn" class="btn btnSecondary">Add New Address</button>
                                </div>

                            </div>
                        </div>

                        <div id="yourOrders" class="tabcontent">
                            <!-- <div class="row order-table" id="orderedList" style="display:none;"> -->
                            <div class="row order-table">
                                <!-- <div class="col-sm-12 text-center mt15 mb15">
                                    <h4>Your Past Orders</h4>
                                </div> -->
                                <div class="col-sm-12 mt15 mb15">
                                    <div class="table-responsive" id="orderedList" style="display:none;">
                                        <!-- <table>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Ship to</th>
                                                <th>Total</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">View Order</th>
                                                <th class="text-center">Reorder</th>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>12/07/2020</td>
                                                <td>Lower Parel Office</td>
                                                <td>1240.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>12/01/2020</td>
                                                <td>Borivali House</td>
                                                <td>1540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>12/05/2020</td>
                                                <td>Pune Bunglow</td>
                                                <td>1,25,540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>1/01/2020</td>
                                                <td>Wife House</td>
                                                <td>12540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                            <tr>
                                                <td>100024170</td>
                                                <td>2/01/2020</td>
                                                <td>Santacruz House</td>
                                                <td>540.00</td>
                                                <td class="text-center"><span class="text-red">Cancelled</span></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">View</a></td>
                                                <td class="text-center"><a href="" class="btn btnGreen">Reorder</a></td>
                                            </tr>
                                        </table> -->
                                    </div>
                                </div>
                                <div class="pagination col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6 text-center text-sm-left">
                                            <ul id="paginationOrderList" style="display:none;">
                                                <!-- <li><a href="" class="disabled"><i class="fas fa-angle-left"></i></a></li>
                                                <li><a href="" class="active">1</a></li>
                                                <li><a href="">2</a></li>
                                                <li><a href="">3</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i></a></li> -->
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 text-center text-sm-right mt10">
                                            <p id="showingPaginationContent" style="display:none">Showing <span id="totalItemsFrom"></span> - <span id="totalItemsTo"></span> of <span id="totalItems">10</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="pagination col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6 text-center text-sm-left">
                                        <ul>
                                            <li><a href="" class="disabled"><i class="fas fa-angle-left"></i></a></li>
                                            <li><a href="" class="active">1</a></li>
                                            <li><a href="">2</a></li>
                                            <li><a href="">3</a></li>
                                            <li><a href=""><i class="fas fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 text-center text-sm-right mt10">
                                        <p>Showing 1 of 10</p>
                                    </div>
                                </div>
                            </div> -->
                            <br>
                            <!-- <div class="row">
                                <div class="col-sm-12 text-center viewAllOrders" onclick="viewAllOrders('yourOrders')" style="display:none;">
                                    <button class="btn btnSecondary">View All Orders</button>
                                </div>
                            </div> -->

                            <!-- <div class="dvOrderDetail row d-none"> -->
                            <div class="dvOrderDetail row" id="dvOrderDetail" style="display:none;">
                                <div class="col-sm-12">
                                    <a href="javascript:void(0);" id="goBackToDashboard" class="returnCart" onclick="myTabs(event, 'dashboard')" style="display:none;"><i class="fas fa-angle-left"></i> Go To Back</a>
                                    <a href="javascript:void(0);" id="goBackToYourOrders" class="returnCart" onclick="myTabs(event, 'yourOrders')" style="display:none;"><i class="fas fa-angle-left"></i> Go To Back</a><br><br>
                                    <div class="row">
                                        <!-- <div class="col-sm-12 mb15">
                                            <button class="btn"><i class="fas fa-angle-left"></i> Back</button>
                                        </div> -->
                                        <div class="col-lg-6">
                                            <h5>Order No: <span id="itemOrderId"></span> - <span class="text-red" id="itemOrderStatus"></span></h5>
                                            <p><b>Order Date:</b> <span id="itemOrderDate"></span></p>
                                        </div>
                                        <div class="col-lg-6 text-lg-right">
                                            <!--<button class="btn btnSecondary btnEdit" id="reorderThisItem">Reorder</button>-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-sm-12 mt15 text-lg-center d-none d-lg-block">
                                            <h4>Shipping Details</h4>
                                        </div> -->
                                        <div class="col-sm-6 mt15">
                                            <div class="bg-grey">
                                                <h5 class="mb10">Shipping Address</h5>
                                                <p class="customerForItemOrder"></p>
                                                <!--<h6 class="addressTypeForItemOrder"></h6>-->
                                                <p class="addressForItemOrder">
                                                    <!-- <br><span class="phoneForItemOrder" style="display:inline-block;"></span> -->
                                                </p>
                                                <span class="phoneForItemOrder"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt15">
                                            <div class="bg-grey">
                                                <h5 class="mb10">Billing Address</h5>
                                                <p class="customerForItemOrder"></p>
                                                <!--<h6 class="addressTypeForItemOrder"></h6>-->
                                                <p class="addressForItemOrder">
                                                    <!-- <br><span class="phoneForItemOrder"></span> -->
                                                </p>
                                                <span class="phoneForItemOrder"></span>
                                            </div>
                                        </div>
                                        <div class="col-6 mt15">
                                            <div class="bg-grey-" style="min-height:auto;">
                                                <h5 class="mb5">Shipping Method</h5>
                                                <!-- <h6>Wife House</h6> -->
                                                <p>
                                                    Free Shipping
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 mt15">
                                            <div class="bg-grey-" style="min-height:auto;">
                                                <h5 class="mb5">Payment Method</h5>
                                                <!-- <h6>Wife House</h6> -->
                                                <p>
                                                    Online Payment
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row itemOrdered">
                                        <div class="col-sm-12" id="listOfItemsOrdered">
                                            <!-- <div class="row border">
                                                <div class="col-sm-12 text-sm-center sep">
                                                <h5>Items Ordered</h5>
                                                </div>
                                                <div class="col-md-5 col-lg-6 mb15">
                                                    <div class="row">
                                                        <div class="col-3 img">
                                                            <img src="<?= ASSET_URL ?>imgs/products/juices/28.png" class="img-fluid rounded" alt="">
                                                        </div>
                                                        <div class="col-9">
                                                            <p><b>Product Name</b></p>
                                                            <p class="name">Valencia Orange <span class="size">- 250 ml</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-lg-6 text-lg-center">
                                                    <div class="row">
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Duration</b></p>
                                                            <p>4 Weeks</p>
                                                        </div>
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Per Bottle</b></p>
                                                            <p><i class="fas fa-rupee-sign"></i>80.00</p>
                                                        </div>
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Quantity</b></p>
                                                            <p>16</p>
                                                        </div>
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Total Price</b></p>
                                                            <p><i class="fas fa-rupee-sign"></i>1,280.00</p>
                                                        </div>                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row border mt15">
                                                <div class="col-md-5 col-lg-6 mb15">
                                                    <div class="row">
                                                        <div class="col-3 img">
                                                            <img src="<?= ASSET_URL ?>imgs/products/juices/28.png" class="img-fluid rounded" alt="">
                                                        </div>
                                                        <div class="col-9">
                                                            <p><b>Product Name</b></p>
                                                            <p class="name">Cleanse <span class="size">- 400 ml</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-7 col-lg-6 text-lg-center">
                                                    <div class="row">
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Pack</b></p>
                                                            <p>Buy 4 Pack</p>
                                                        </div>
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Per Bottle</b></p>
                                                            <p><i class="fas fa-rupee-sign"></i>1,125.00</p>
                                                        </div>
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Quantity</b></p>
                                                            <p>05</p>
                                                        </div>
                                                        <div class="col-6 col-sm-3 mb10">
                                                            <p><b>Total Price</b></p>
                                                            <p><i class="fas fa-rupee-sign"></i>4,500.00</p>
                                                        </div>                                                
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <!-- <div class="col-6 col-sm-3 col-md-2">
                                            <p><b>Ordered</b></p>
                                            <p>05</p>
                                        </div>
                                        <div class="col-6 col-sm-3 col-md-2">
                                            <p><b>Cancelled</b></p>
                                            <p>02</p>
                                        </div> -->
                                    </div>
                                    <div class="grandTotal row mt15">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>Subtotal</p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p id="subtotalForItemOrder"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>Shipping</p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p><i class="fas fa-rupee-sign"></i>0.00</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>Coupon Discount</p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p id="couponForItemOrder"></p>
                                                </div>
                                            </div>
                                            <div class="row bg">
                                                <div class="col-6">
                                                    <p><b>Grand Total</b></p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p id="grandTotalForItemOrder"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <button class="btn btnPrimary" data-ok="yes" id="ok_reload">OK</button>
                        <button class="btn btnPrimary" id="deleteOk" style="display:none;">OK</button>
                        <button class="btn btnPrimary" id="cancel_reload" style="display:none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal2" class="dvModal">
    <div id="addNewAddressModal" class="modal" style="display:none;">
        <div class="modal-content modal-md modal-lg modal-xl d-md-block">
            <i class="fas fa-times-circle btn close"></i>
            <div class="row">
                <div class="col-sm-12 text-center mt15 mb15">
                    <h4>Add New Address</h4>
                </div>
                <div class="col-sm-12">
                    <!-- <form id="addressForm"> -->
                    <div class="row" id="addressForm">
                        <div class="col-sm-12 col-md-4" style="margin:10px 0;">
                            <input type="text" class="form-control" placeholder="First Name*" name="first_name" id="first_name">
                            <p class="text-red text-center" id="first_nameErr" style="display:none;">Atleast 3 characters</p>
                        </div>
                        <div class="col-sm-12 col-md-4" style="margin:10px 0;">
                            <input type="text" class="form-control" placeholder="Last Name*" name="last_name" id="last_name" value="">
                            <p class="text-red text-center" id="last_nameErr" style="display:none;">Atleast 3 characters</p>
                        </div>
                        <div class="col-sm-12 col-md-4" style="margin:10px 0;">
                            <input type="text" class="form-control" placeholder="Flat No, Building, Street, Area*" name="address" id="address" value="">
                            <p class="text-red text-center" id="addressErr" style="display:none;">Address required</p>
                        </div>
                        <div class="col-sm-12 col-md-4" style="margin:10px 0;">
                            <select class="form-control" id="city" name="city" placeholder="City*">
                                <option value="">--Select City--</option>
                                <?php foreach ($city_list as $key => $value) {?>
                                    <option value="<?= $value['city_name']; ?>"><?= $value['city_name']; ?></option>
                                <?php } ?>
                            </select>
                            <p class="text-red text-center" id="cityErr" style="display:none;">City required</p>
                        </div>
                        <!-- <div class="col-sm-12 col-md-4" style="margin:10px 0;">
                            <input type="text" class="form-control" placeholder="City*" name="city" id="city" value="">
                            <p class="text-red text-center" id="cityErr" style="display:none;">City required</p>
                        </div> -->
                        <div class="col-sm-12 col-md-4" style="margin:10px 0;">
                            <input type="text" class="form-control" placeholder="Mobile*" name="mobile_number" id="mobile_number" maxlength="10" value="" onkeypress="return onlyNumberKey(event)">
                            <!-- <p class="text-red text-center" id="mobile_numberErr" style="display:none;">Only Numbers please</p> -->
                            <p class="text-red text-center" id="mobile_numberErr" style="display:none;">Invalid mobile number</p>
                        </div>
                        <div class="col-sm-12 col-md-4" style="margin:10px 0;">
                            <!-- <input type="text" class="form-control" placeholder="Pincode*" name="pincode_data" id="pincode_data" maxlength="7" value="" onkeypress="return onlyNumberKey(event)">
                            <p class="text-red text-center" id="pincodeErr" style="display:none;">Pincode required</p> -->
                            <input type="text" class="form-control" placeholder="Pincode*" name="pincode_data" id="pincode_data" value="" autocomplete="off">
                            <p class="text-red text-center" id="pincodeErr" style="display:none;">Pincode required</p>
                            <p class="text-red text-center" id="postalCodeErr" style="display:none;">Proper pincode required</p>
                            <p class="text-red text-center" id="pincodeErrForNotDelivery" style="display:none;"></p>
                        </div>
                        <div class="radios col-sm-12 text-center" style="margin:10px 0;">
                            <label><input type="radio" name="address_type" checked="checked" value="Home" class="hideaddressTypeOther"> Home</label>
                            <label><input type="radio" name="address_type" value="Work" class="hideaddressTypeOther"> Work</label>
                            <label><input type="radio" name="address_type" id="addressTypeOther"> Other</label>
                        </div>
                        <div class="col-md-4 offset-md-4 mb15" id="showAddressTypeOtherDiv">
                            <input type="text" name="address_type" class="form-control" id="showAddressTypeOther" placeholder="e.g brother's  House" maxlength="17" style="display:none;" value="">
                            <p class="text-red text-center" id="addressTypeErr" style="display:none;">Please enter data</p>
                        </div>
                        <div class="col-sm-12 mt10 text-center">
                            <input type="hidden" id="address_id" value=""> <!-- for update/insert in DB -->

                            <p class="text-green" id="successMsgInAddress" style="display:none; padding:10px 0;"></p>
                            <p class="text-red text-center" id="failedMsgInAddress" style="display:none; padding:10px 0;"></p>

                            <button class="btn btnSecondary" id="submitShippingAddress">Save</button>
                        </div>
                        <input type="hidden" name="locality" id="locality" value="" /> <!-- City -->
                        <input type="hidden" name="postal_code" id="postal_code" value="" /> <!-- Zip code -->
                        <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" value="" /> <!-- State -->
                        <input type="hidden" name="country" id="country" value="" /> <!-- Country -->
                        <input type="hidden" name="Addrlongitude" id="longitude" value="" /> <!-- longitude -->
                        <input type="hidden" name="Addrlatitude" id="latitude" value="" /> <!-- latitude -->
                        <!-- <input type="hidden" name="entered_address" id="entered_address" value="" /> -->
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script>
// var modal2 = document.getElementById("myModal2");
    var addNewAddressModal = document.getElementById("addNewAddressModal");
    var addBtn = document.getElementById("addBtn");
    var span3 = addNewAddressModal.getElementsByClassName("close")[0];
    addBtn.onclick = function () {
        addNewAddressModal.style.display = "block";
    }
    span3.onclick = function () {
        addNewAddressModal.style.display = "none";
    }
    // window.onclick = function (event) {
    //     if (event.target == modal2) {
    //         modal2.style.display = "none";
    //     }
    //     if (event.target == addNewAddressModal) {
    //         addNewAddressModal.style.display = "none";
    //     }
    // }

    /*$(document).ready(function(){*/
    var csrf_value = "<?php echo $this->security->get_csrf_hash(); ?>";
    var url = "<?php echo BASE_URL . '/'; ?>";
    var hideOrderedList = viewOrderRequestFromDashabord = false;

    function myTabs(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";

        if (tabName == 'dashboard') {
            viewOrderRequestFromDashabord = true;
            $("#defaultOpen").attr("class", "tablinks active");
            getDashboardAjax();
        } else {
            $("#defaultOpen").attr("class", "tablinks");
        }

        if (tabName == 'personalInfo') {
            $("#tabPersonalInfo").attr("class", "tablinks active");
            getPersonalInfoAjax();
        } else {
            $("#tabPersonalInfo").attr("class", "tablinks");
        }

        if (tabName == 'savedAddress') {
            $("#tabSavedAddress").attr("class", "tablinks active");
            getAllAddressAjax();
        } else {
            $("#tabSavedAddress").attr("class", "tablinks");
        }

        if (tabName == 'yourOrders') {
            $("#tabYourOrders").attr("class", "tablinks active");
            // alert(hideOrderedList);
            if (hideOrderedList == false) {
                showYourOrders();
                viewOrderRequestFromDashabord = false;
            }
            hideOrderedList = false;
        } else {
            $("#tabYourOrders").attr("class", "tablinks");
        }
    }
    document.getElementById("defaultOpen").click();


    /************************* Tab Dashboard **************************/
    function getDashboardAjax() {
        $.ajax({
            url: '<?php echo site_url(); ?>' + 'dashboard/dashboardForCustomer' + "?t=" + Math.random(),
            type: "GET",
            dataType: "JSON",
            success: function (res) {
                if (res.status == 'success') {
                    data = res.data;
                    address_id = data.billing_address['address_id'];
                    address_type = data.billing_address['address_type'];
                    address = data.billing_address['address'];
                    city = data.billing_address['city'];
                    pincode = data.billing_address['pincode'];

                    $(".showCustomerFullName").html(data['fullname']);
                    $(".showCustomerEmail").html(data['email']);
                    $(".showCustomerMobile").html(data['mobile_number']);

                    if (address_id != null && address_id != '') {
                        $("#billingAddressMsg").html("");
                        $("#addAddressInDashboard").removeAttr("onclick").hide();
                        $("#editAddressInDashboard").attr("onclick", "callSaveAddress(" + address_id + ")").show();
                        $("#addressTypeInDashboard").html(address_type);
                        $("#billingAddressInDashboard").html(address + ' ' + city + ' ' + pincode);
                    } else {
                        $("#editAddressInDashboard").removeAttr("onclick").hide();
                        $("#addAddressInDashboard").attr("onclick", "myTabs(event, 'savedAddress')").show();
                        $("#addressTypeInDashboard").html("");
                        $("#billingAddressInDashboard").html("");
                        $("#billingAddressMsg").html("You have not set a default billing address.");
                    }

                    recent_orders = data.recent_orders;
                    total_items = data.total_items;

                    if (recent_orders.length > 0) {
                        orderListPrint(recent_orders, recent_orders.length, total_items, showInDiv = '#recent_orders');
                    }

                }
            }
        });
    }

    // function recentOrdersInDashboard(recent_orders, currentOrderList, total_items, showInDiv){
    function orderListPrint(recent_orders, currentOrderList, total_items, showInDiv) {
        recentOrderData = '<table>';
        recentOrderData += '<tr>';
        recentOrderData += '<th>Order</th>';
        recentOrderData += '<th>Date</th>';
        recentOrderData += '<th>Ship to</th>';
        recentOrderData += '<th>Total</th>';
        recentOrderData += '<th class="text-center">Status</th>';
        recentOrderData += '<th class="text-center">View Order</th>';
        //recentOrderData += '<th class="text-center">Reorder</th>';
        recentOrderData += '</tr>';
        for (order in recent_orders) {
            // date = new Date();
            recentOrderData += '<tr>'
            recentOrderData += '<td>' + recent_orders[order]['order_id'] + '</td>';
            recentOrderData += '<td>' + recent_orders[order]['order_date'] + '</td>';
            recentOrderData += '<td>' + recent_orders[order]['ship_to'] + '</td>';
            recentOrderData += '<td>' + recent_orders[order]['total'] + '</td>';
            recentOrderData += '<td class="text-center"><span>' + recent_orders[order]['status'] + '</span></td>';
            recentOrderData += '<td class="text-center"><a href="javascript:void(0);" class="btn btnGreen" onclick="showItemsOrdered(' + recent_orders[order]['order_id'] + ')">View</a></td>';
            //recentOrderData += '<td class="text-center"><a href="javascript:void(0);" class="btn btnGreen" onclick="reorderItems(' + recent_orders[order]['order_id'] + ')">Reorder</a></td>';
            recentOrderData += '</tr>';
        }
        recentOrderData += '</table>';
        $(".recentOrdersInDashboard").show();
        // $("#recent_orders").html(recentOrderData).show();
        $(showInDiv).html(recentOrderData).show();

        // if(total_items>2){
        if (total_items > 10) {
            // $(".viewAllOrdersInDashboard").show();
            $(".viewAllOrders,#paginationOrderList").show();
        }

        if (currentOrderList == total_items) {
            // $(".viewAllOrdersInDashboard").hide();
            $(".viewAllOrders").hide();
        }
    }

    // $(".viewAllOrdersInDashboard").on('click', function(){
    /*$(".viewAllOrders").on('click', function(){
     $.ajax({
     url:'<?php echo site_url(); ?>' + 'dashboard/getRecentOrders?viewAll=viewAll',
     type:"GET",
     dataType:"JSON",
     success:function(res){
     if(res.status=='success'){
     recent_orders = res.data.recent_orders;
     total_items = res.data.total_items;
     if(recent_orders.length>0){
     orderListPrint(recent_orders, recent_orders.length, total_items, showInDiv='#recent_orders');
     }
     }
     }
     });
     });*/


    function viewAllOrders(viewAllBtn) {
        if (viewAllBtn == 'dashboard') {
            showInDiv = '#recent_orders';
        } else {
            showInDiv = '#orderedList';
        }
        $.ajax({
            url: '<?php echo site_url(); ?>' + 'dashboard/getRecentOrders?viewAll=viewAll',
            type: "GET",
            dataType: "JSON",
            success: function (res) {
                if (res.status == 'success') {
                    recent_orders = res.data.recent_orders;
                    total_items = res.data.total_items;
                    if (recent_orders.length > 0) {
                        orderListPrint(recent_orders, recent_orders.length, total_items, showInDiv);
                    }
                }
            }
        });
    }


    getDashboardAjax();

    function callSaveAddress(address_id) {
        myTabs(event, 'savedAddress'); // open tab Saved Address
        editAddress(address_id);
    }

    function showItemsOrdered(order_id) {
        hideOrderedList = true;
        if (order_id == null || order_id == '') {
            return false;
        }
        data = {order_id: order_id, 'csrf_test_name': csrf_value};
        getOrderDetailsAjax(data);
        // myTabs(event, 'yourOrders');
    }

    function showYourOrders() {
        // alert('amzad');
        yourOrdersAjax();
        // myTabs(event, 'yourOrders');
    }

    function yourOrdersAjax() {
        // $("#orderedList").show();
        $("#dvOrderDetail").hide();
        // $("#showingPaginationContent").show();

        $.ajax({
            url: '<?php echo site_url(); ?>' + 'dashboard/yourOrders' + "?t=" + Math.random(),
            type: "GET",
            dataType: "JSON",
            success: function (res) {
                if (res.status == 'success') {
                    total_items = res.data.total_items;
                    totalPage = Math.ceil(total_items / 10);
                    // alert(total_items);
                    if (totalPage >= 2) {
                        // showPagination(totalPage); // Pagination
                        showPagination(totalPage, total_items); // Pagination
                        $("#showingPaginationContent").show();
                    }
                    recent_orders = res.data.recent_orders;
                    if (recent_orders.length > 0) {
                        orderListPrint(recent_orders, recent_orders.length, total_items, showInDiv = '#orderedList');
                    } else {
                        $("#orderedList").html("<div class='col-md-12' style='text-align:center; padding:10px 0;'>YOUR PAST ORDER <br><br> You have placed no orders.</div>").show();
                    }

                }
            }
        });
    }


    function getOrderDetailsAjax(data) {

        $.ajax({
            url: '<?php echo site_url(); ?>' + 'dashboard/getCustomerOrderDetails',
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function (res) {
                if (res.status == 'success') {
                    /*myTabs(event, 'yourOrders'); // Items ordered 'div' available in this tab
                     $("#orderedList").hide();
                     $("#dvOrderDetail").show();*/

                    myTabs(event, 'yourOrders'); // Items ordered 'div' available in this tab
                    // $("#orderedList,#recent_orders,.viewAllOrders").hide();
                    $("#orderedList,#recent_orders,#paginationOrderList,.viewAllOrders,#showingPaginationContent").hide();
                    $("#dvOrderDetail").show();

                    if (viewOrderRequestFromDashabord == true) {
                        $("#goBackToDashboard").show();
                        $("#goBackToYourOrders").hide();
                    } else {
                        $("#goBackToDashboard").hide();
                        $("#goBackToYourOrders").show();
                    }

                    fullname = res.data.order_detail.firstname + ' ' + res.data.order_detail.lastname;
                    address = res.data.order_detail.address + ', ' + res.data.order_detail.city + ', ' + res.data.order_detail.pincode;

                    sub_total = res.data.order_detail.sub_total.replace(",", "");
                    grand_total = res.data.order_detail.grand_total.replace(",", "");
                    coupon_code = res.data.order_detail.coupon_code;
                    coupon_discount = 0;

                    if (coupon_code != null || coupon_code != '') {
                        coupon_discount = (sub_total - grand_total);
                    }

                    $("#itemOrderId").html(res.data.order_id);
                    $("#itemOrderStatus").html(res.data.order_detail.status);
                    $("#itemOrderDate").html(res.data.order_created_date);
                    $(".customerForItemOrder").html(fullname);
//                    $(".addressTypeForItemOrder").html(res.data.order_detail.address_type);
                    $(".addressForItemOrder").html(address);
                    $(".phoneForItemOrder").html("Phone: " + res.data.order_detail.mobile_number);

                    itemsData = res.data.items_ordered;

                    // if(itemsData.length>0){
                    itemsOrdered = '<div class="col-sm-12 text-sm-center sep">'
                    itemsOrdered += '<h5>Items Ordered</h5>'
                    itemsOrdered += '</div>'

                    for (item in itemsData) {

                        totalPrice = (itemsData[item]['price'] * itemsData[item]['qty_ordered']);

                        itemsOrdered += '<div class="row border">'
                        itemsOrdered += '<div class="col-md-5 col-lg-6">'
                        itemsOrdered += '<div class="row">'
                        itemsOrdered += '<div class="col-3 img">'
                        itemsOrdered += '<img src="<?= ASSET_URL ?>imgs/product_images/thumb/' + itemsData[item]['thumb_image_url'] + '" class="img-fluid rounded" alt="">'
                        itemsOrdered += '</div>'
                        itemsOrdered += '<div class="col-9">'
                        itemsOrdered += '<p><b>Product Name</b></p>'
                        itemsOrdered += '<p class="name">' + itemsData[item]['product_name'] + ' <span class="size">- ' + itemsData[item]['varient'] + '</span></p>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '<div class="col-md-7 col-lg-6 text-lg-center">'
                        itemsOrdered += '<div class="row">'
                        itemsOrdered += '<div class="col-6 col-sm-3 mb10">'
                        /*itemsOrdered +=                     '<p><b>Duration</b></p>'
                         itemsOrdered +=                     '<p>4 Weeks</p>'*/
                        itemsOrdered += '</div>'
                        itemsOrdered += '<div class="col-6 col-sm-3 mb10">'
                        itemsOrdered += /*'<p><b>Per Bottle</b></p>'*/ '<p><b>Price</b></p>'
                        itemsOrdered += '<p><i class="fas fa-rupee-sign"></i>' + itemsData[item]['price'] + '</p>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '<div class="col-6 col-sm-3 mb10">'
                        itemsOrdered += '<p><b>Quantity</b></p>'
                        itemsOrdered += '<p>' + itemsData[item]['qty_ordered'] + '</p>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '<div class="col-6 col-sm-3 mb10">'
                        itemsOrdered += '<p><b>Total Price</b></p>'
                        itemsOrdered += '<p><i class="fas fa-rupee-sign"></i>' + totalPrice + '</p>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '</div>'
                        itemsOrdered += '</div>';
                    }

                    $("#listOfItemsOrdered").html(itemsOrdered);
                    // }

                    $("#subtotalForItemOrder").html("<i class='fas fa-rupee-sign'></i>" + parseFloat(sub_total).toFixed(2));

                    if (coupon_discount > 0) {
                        $("#couponForItemOrder").html("<i class='fas fa-rupee-sign'></i>" + parseFloat(coupon_discount).toFixed(2));
                    } else {
                        $("#couponForItemOrder").html("<i class='fas fa-rupee-sign'></i>" + "0.00");
                    }

                    $("#grandTotalForItemOrder").html("<b><i class='fas fa-rupee-sign'></i>" + parseFloat(grand_total).toFixed(2) + "</b>");

                }
            }

        });
    }

    /************************* Personal Info **************************/
    function getPersonalInfoAjax() {
        $.ajax({
            url: '<?php echo site_url(); ?>' + 'dashboard/personalInfo' + "?t=" + Math.random(),
            type: "GET",
            // data:data,
            dataType: "JSON",
            success: function (res) {
                if (res.status == 'success') {
                    if (res.password == 'available') {
                        $("#currentPasswordDiv,#currentPassword").show();
                    }
                    if (res.password == 'empty') {
                        // $("#currentPassword").hide();
                        $("#newPasswordDiv,#confirmPasswordDiv").removeClass("col-lg-4").addClass("col-lg-6");
                    }
                    if (res.data['first_name'] != null && res.data['first_name'] != '') {
                        $("#fullnameInPersonalInfo").val(res.data['first_name'] + ' ' + res.data['last_name'])
                    }
                    if (res.data['email'] != null && res.data['email'] != '') {
                        $("#emailInPersonalInfo").val(res.data['email']);
                    }
                }
            }
        });
    }

    $("#submitNameEmailInPersonalInfo").on('click', function () {
        foundErr = false;
        fullname = $("#fullnameInPersonalInfo").val().trim();
        email = $("#emailInPersonalInfo").val().trim();

        if (email != '') {
            $("#emailErrInPersonalInfo").hide();
        }
        if (fullname != '') {
            $("#fullnameErrInPersonalInfo").hide();
        }
        if (fullname == '') {
            $("#fullnameErrInPersonalInfo").show();
            foundErr = true;
        }
        if (checkValidEmail(email) == false) {
            $("#emailErrInPersonalInfo").show();
            foundErr = true;
        }

        if (foundErr == false) {
            data = {fullname: fullname, email: email, 'csrf_test_name': csrf_value};
            url = '<?php echo site_url(); ?>' + 'dashboard/updateNameAndEmail';
            postPersonalInfoAjax(url, data);
        }

    });

    $("#submitPwdInPersonalInfo").on('click', function () {
        foundErr = false;
        currentPwd = ($("#currentPassword").css("display") == 'block') ? true : false;
        currentPassword = $("#currentPassword").val(); // .trim();
        newPassword = $("#newPassword").val(); // .trim();
        confirmPassword = $("#confirmPassword").val(); //.trim(); 
        // alert(currentPwdCSS);

        if (currentPwd == true && currentPassword != '') {
            $("#currentPwdErr").hide();
        }
        if (newPassword != '') {
            $("#newPwdErr").hide();
        }
        if (confirmPassword != '') {
            $("#confirmPwdErr").hide();
        }
        if (currentPwd == true && currentPassword == '') {
            $("#currentPwdErr").show();
            $("#confirmPasswordErr").hide();
            foundErr = true;
        }
        if (newPassword == '') {
            $("#newPwdErr").show();
            $("#confirmPasswordErr").hide();
            foundErr = true;
        }
        if (confirmPassword == '') {
            $("#confirmPwdErr").show();
            $("#confirmPasswordErr").hide();
            foundErr = true;
        }
        if (newPassword != confirmPassword) {
            $("#currentPwdErr,#newPwdErr,#confirmPwdErr").hide();
            $("#confirmPasswordErr").show();
            foundErr = true;
        }

        if (foundErr == false) {
            data = {currentPassword: currentPassword, newPassword: newPassword, confirmPassword: confirmPassword, 'csrf_test_name': csrf_value};
            url = '<?php echo site_url(); ?>' + 'dashboard/updatePassword';
            postPersonalInfoAjax(url, data);
        }

    });

    function postPersonalInfoAjax(url, data) {
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function (res) {
                if (res.status == 'failed') {
                    // please write function for submitNameEmailInPersonalInfo & submitPwdInPersonalInfo

                    // if(res.message=='Full Name, atleast 3 characters'){
                    if (res.message == 'Full Name required') {
                        modalBoxForPersonalInfo(res.message);
                    }
                    if (res.message == 'Invalid email') {
                        modalBoxForPersonalInfo(res.message);
                    }
                    if (res.message == 'This email already used') {
                        modalBoxForPersonalInfo(res.message);
                    }
                    if (res.message == 'Invalid password') {
                        $("#confirmPasswordErr").hide();
                        modalBoxForPersonalInfo(res.message);
                    }
                    if (res.message == 'Invalid current password') {
                        $("#confirmPasswordErr").hide();
                        modalBoxForPersonalInfo(res.message);
                    }
                    if (res.message == 'Please make sure your passwords match') {
                        modalBoxForPersonalInfo(res.message);
                    }

                } else if (res.status == 'success') {
                    /*if(res.message=='Record updated successfully'){
                     modalBoxForPersonalInfo(res.message);
                     }*/
                    // if(res.message=='Password updated successfully'){
                    if (res.message == 'The account information has been saved') {

                        if (res.password != 'available' && res.password != 'empty') { // Response for name & email update
                            data = res.data;

                            $("#customerNameInMenuLink").html('Welcome ' + data['first_name'] + ' ' + data['last_name']); // header dropdown menu link will update for CustomerName

                            $(".showCustomerFullName").html(data['first_name'] + ' ' + data['last_name']);
                            $(".showCustomerEmail").html(data['email']);
                        }

                        modalBoxForPersonalInfo(res.message);

                        if (res.password == 'available') {
                            $("#currentPasswordDiv,#currentPassword").show();
                            $("#currentPasswordDiv,#newPasswordDiv,#confirmPasswordDiv").removeClass("col-lg-6").addClass("col-lg-4");
                            hideAndBlankPersonalInfoFields();
                        } else if (res.password == 'empty') {
                            $("#currentPasswordDiv,#currentPassword").hide();
                            $("#newPasswordDiv,#confirmPasswordDiv").removeClass("col-lg-4").addClass("col-lg-6");
                            hideAndBlankPersonalInfoFields();
                        } else {
                            hideShowActivityInPersonalInfo(res.data['first_name'], res.data['last_name']);
                        }

                    }
                } else {
                    /*alert('Something went wrong, please try again after sometime');
                     return false;*/
                }
            }
        });
    }

    function hideAndBlankPersonalInfoFields() {
        $("#currentPassword,#newPassword,#confirmPassword").val("");
        $("#fullnameErrInPersonalInfo,#emailErrInPersonalInfo,#currentPwdErr,#newPwdErr,#confirmPwdErr,#confirmPasswordErr").hide();
    }
    function hideShowActivityInPersonalInfo(firstname, lastname) {
        if (lastname == '' || lastname == null) {
            $("#fullnameInPersonalInfo").val(firstname);
        } else {
            $("#fullnameInPersonalInfo").val(firstname + ' ' + lastname);
        }
        hideAndBlankPersonalInfoFields();
    }

    function modalBoxForPersonalInfo(msg) {

        $("#modalBox, #ok_reload").show();
        $("#cancel_reload, #deleteOk").hide();
        $("#msgInModalBox").html(msg).show();

        $("#ok_reload").on('click', function () {
            $("#modalBox").hide();
        });
    }

    /************************* Address **************************/

    function deliverablePincode() {
        $("#postalCodeErr").html("");
        pincode = $("#postal_code").val();
        entered_address = $("#pincode_data").val();
        latitude = $("input[name=Addrlatitude]").val();
        longitude = $("input[name=Addrlongitude]").val();
        city = $("#locality").val();
        if (latitude != '' && longitude != '' && entered_address != '') {
            dataSend = {pincode: pincode, entered_address: entered_address, latitude: latitude, longitude: longitude, city: city, 'csrf_test_name': csrf_value};
            checkPincodeAjax(dataSend);
        }
    }

    function checkPincodeAjax(dataSend) {
        $.ajax({
            url: "<?php echo site_url(); ?>" + 'dashboard/pincodeCheck',
            type: "POST",
            data: dataSend,
            dataType: "JSON",
            success: function (res) {
                // alert(JSON.stringify(res));
                if (res.status == 'failed') {
                    $("#pincodeErrForNotDelivery").html("We are not delivering at this pincode. Please change the pincode and Save").show();
                } else if (res.status == 'success') {
                    $("#pincodeErrForNotDelivery").html("").hide();
                } else {
                    // alert('Someting went wrong, please try again after sometime');
                }
            }
        })
    }

    $("#submitShippingAddress").on('click', function () { // updateOrCreate address
        foundErr = false;

        first_name = $("#first_name").val().trim();
        last_name = $("#last_name").val().trim();
        mobile_number = $("#mobile_number").val().trim();
        address = $("#address").val().trim();
        city = $("#city").val();
        pincode = $("input[name=pincode_data]").val().trim(); // $("#pincode_data").val().trim();
        postal_code = $("#postal_code").val(); // hidden pincode
        /*locality = $("#locality").val(); // hidden city*/
        administrative_area_level_1 = $("#administrative_area_level_1").val(); // hidden state
        country = $("#country").val(); // hidden state
        address_id = $("#address_id").val().trim();
        address_type = $("input[name=address_type]:checked").val().trim();
        // markAddressDefault = ($("#markAddressDefault").is(':checked'))?1:'';

        cssAddressType = $("#showAddressTypeOther").css('display');
        addressTypeOther = $("#showAddressTypeOther").val().trim();

        if (first_name != '') {
            $("#first_nameErr").hide();
        }
        if (last_name != '') {
            $("#last_nameErr").hide();
        }
        if (address != '') {
            $("#addressErr").hide();
        }
        if (city != '') {
            $("#cityErr").hide();
        }
        if (mobile_number != '') {
            $("#mobile_numberErr").hide();
        }
        if (pincode != '') {
            $("#pincodeErr").hide();
        }
        if (postal_code != '') {
            $("#postalCodeErr").hide();
        }

        if (first_name == null || first_name == '' || (first_name.length < 3)) {
            $("#first_nameErr").show();
            foundErr = true;
        }
        if (last_name == null || last_name == '' || (last_name.length < 3)) {
            $("#last_nameErr").show();
            foundErr = true;
        }
        if (address == null || address == '') {
            $("#addressErr").show();
            foundErr = true;
        }
        if (city == '') {
            $("#cityErr").show();
            foundErr = true;
        }
        // if(pincode==null || pincode=='' || isNaN(pincode)){
        if (postal_code == null || postal_code == '') {
            // alert('Proper Pincode needed');
            $("#postalCodeErr").show();
            $("#pincodeErrForNotDelivery,#pincodeErr").hide();
            foundErr = true;
        }
        if (pincode == null || pincode == '') {
            //$("#pincodeErr").show();
            //$("#pincodeErrForNotDelivery,#postalCodeErr").hide();
            //foundErr = true;
        }
        if (mobile_number == null || mobile_number == '' || isNaN(mobile_number)) {
            $("#mobile_numberErr").show();
            foundErr = true;
        }

        if (cssAddressType == 'block') {
            if (addressTypeOther != '') {
                $("#addressTypeErr").hide();
            }
            if (addressTypeOther == null || addressTypeOther == '') {
                $("#addressTypeErr").show();
                foundErr = true;
            }
            address_type = addressTypeOther;
        }

        if ($("#pincodeErrForNotDelivery").html()!='') {
            foundErr = true;
        }

        if (foundErr == false) {
            data = {first_name: first_name, last_name: last_name, mobile_number: mobile_number, address: address, city: city, pincode: postal_code, address_type: address_type, state: administrative_area_level_1, country: country, address_id: address_id, 'csrf_test_name': csrf_value};

            if (address_id != null && address_id != '' && address_id != 0) {
                url = '<?php echo site_url(); ?>' + 'dashboard/updateAddress';
            } else {
                url = '<?php echo site_url(); ?>' + 'dashboard/setShippingAddress';
            }
            postAddressAjax(url, data);
        }

    });

    function postAddressAjax(url, data) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'failed') {
                    $("#post_status").val(response.status);
                    $("#ok_reload").attr("data-ok","no");
                    $("#addNewAddressModal").hide();
                    generalModalBox(response.message);
                } else if (response.status == 'success') {
                    $("#post_status").val(response.status);
                    $("#addNewAddressModal").hide();
                    if (response.message !== '') {
                        showModalBox(response.message, response.address_list);
                    }
                } else {
                    /*alert('Something went wrong, sorry please try again!');
                     return false;*/
                }

            }
        });

    } /* end for postAddressAjax() */

    // function getAllAddressAjax(url,data){
    function getAllAddressAjax() {

        makeAddressInputEmpty();
        
        $.ajax({
            url: "<?php echo site_url(); ?>" + 'dashboard/saveAddress' + "?t=" + Math.random(),
            type: "GET",
            // data:data,
            dataType: "JSON",
            success: function (res) {
                if (res.status == 'success') {
                    if (res.message = 'Address available') {
                        showAllAddress(res.address_list);
                    }

                } else if (res.status == 'failed') {

                    if (res.message = 'Address not available') {
                        $("#addressBox").hide();
                    }

                }
            }
        });
    }

    function showAllAddress(allAddress) {
        // address_list = res.address_list;
        address_list = allAddress;
        addressInfo = '';
        for (x in address_list) {
            addressInfo += '<div class="col-6 col-md-4 col-lg-3 mb15">';
            addressInfo += '<div class="bg-grey d-flex flex-column justify-content-between">';
            addressInfo += '<div class="d-flex justify-content-between align-items-center">';

            if (address_list[x]['is_default_shipping'] == 1) {
                addressInfo += '<h5>Default</h5>';
                addressInfo += '<div class="dot dot-default"></div>';
            } else {
                addressInfo += '<button class="btn btnDefault" onclick="makeAddressDefault(' + address_list[x]['address_id'] + ')"><h5>Set as Default</h5></button>';
                /*addressInfo +=             '<div class="dot"></div>';*/
            }

            addressInfo += '</div>';
            addressInfo += '<p class="title">';
            addressInfo += address_list[x]['address_type']
            addressInfo += '</p>';
            addressInfo += '<p>';
            addressInfo += '<span>' + address_list[x]['first_name'] + ' ' + address_list[x]['last_name'] + ',</span>';
            addressInfo += '<br>';
            addressInfo += '<span>' + address_list[x]['address'] + ', ' + address_list[x]['city'] + ', ' + address_list[x]['pincode'] + '</span>';
            addressInfo += '</p>';
            addressInfo += '<div class="d-flex justify-content-between">';
            addressInfo += '<span class="edit" onclick="editAddress(' + address_list[x]['address_id'] + ')" style="cursor:pointer;"><i class="fas fa-edit"></i> Edit</span>';
            addressInfo += '<span class="delete" onclick="deleteAddress(' + address_list[x]['address_id'] + ')" style="cursor:pointer;"><i class="far fa-trash-alt"></i> Delete</span>';
            addressInfo += '</div>';
            /*addressInfo +=        '<div class="deliverHere">';
             addressInfo +=            '<button class="btn btnSecondary" onclick="deliverHere('+address_list[x]['address_id']+')">Deliver Here</button>';*/
            addressInfo += '</div>';
            addressInfo += '</div>';
            addressInfo += '</div>';
            // addressInfo += address_list[x]['first_name'];
        }

        $("#addressBox").html(addressInfo).show();
    }

    $("#addressTypeOther").on('click', function () {
        if ($("#addressTypeOther").is(':checked')) {
            // $("#showAddressTypeOther").val("");
            $("#showAddressTypeOther").show();
            // alert('Test');
        }
    });

    $(".hideaddressTypeOther").on('click', function () {
        // $("#showAddressTypeOther").val("");
        $("#showAddressTypeOther,#addressTypeErr").hide();
        // alert('hide address');
    });

    function makeAddressDefault(address_id) {
        url = '<?php echo site_url(); ?>' + 'dashboard/setAddressDefault';
        data = {address_id: address_id, 'csrf_test_name': csrf_value};
        // alert('Make address default: ' + address_id);
        postAddressAjax(url, data);
    }

    function editAddress(address_id) {
        data = {address_id: address_id, 'csrf_test_name': csrf_value};
        url = '<?php echo site_url() ?>' + 'dashboard/addressEdit';
        // alert('editAddress: ' + address_id);
        editAddressAjax(url, data); // Will show form with values
    }
    function editAddressAjax(url, data) {

        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            dataType: "JSON",
            success: function (response) {

                if (response.status == 'failed') {
                    // showModalBox(response.message);
                    // alert(response.message);
                    generalModalBox(response.message);
                } else if (response.status == 'success') {
                    $("#addNewAddressModal").show();
                    var res = response.data;
                    // alert(res['address_type']);
                    $("#first_name").prop("value", res['first_name']);
                    $("#last_name").prop("value", res['last_name']);
                    $("#address").prop("value", res['address']);
                    $("#city").prop("value", res['city']);
                    $("#administrative_area_level_1").prop("value", res['state']);
                    $("#mobile_number").prop("value", res['mobile_number']);
                    // $("#pincode_data").prop("value", res['pincode']);
                    $("input[name=pincode_data]").prop("value", res['pincode']);
                    $("#postal_code").prop("value", res['pincode']); // hidden field 'same as pincode'
                    $("#country").prop("value", res['country']); // hidden field

                    if (res['address_type'] != 'Home' || res['address_type'] != 'Work') {
                        $("#addressTypeOther").prop("checked", true);
                        $("#showAddressTypeOther").show();
                        $("#showAddressTypeOther").val(res['address_type']);
                    }

                    if (res['address_type'] == 'Home') {
                        removeAttrValueForAddressTypeOther();
                        $("input:radio[value=Home]").prop("checked", true);
                    }

                    if (res['address_type'] == 'Work') {
                        removeAttrValueForAddressTypeOther();
                        $("input:radio[value=Work]").prop("checked", true);
                    }

                    $("#address_id").prop("value", res['address_id']);
                }
            }
        });
    }

    function removeAttrValueForAddressTypeOther() {
        $("#addressTypeOther").attr("checked", false);
        $("#showAddressTypeOther").hide();
        $("#showAddressTypeOther").val("");
    }

    function deleteAddress(address_id) {
        data = {address_id: address_id, 'csrf_test_name': csrf_value};
        url = '<?php echo site_url() ?>' + 'dashboard/addressDelete';
        // alert(address_id);
        $("#ok_reload").hide();
        $("#modalBox,#cancel_reload,#deleteOk").show();
        $("#msgInModalBox").html("Are you sure you want to remove this address?");

        $("#deleteOk").unbind('click').click(function () { // unbind previously set click event 
            // alert(address_id);
            $("#modalBox,#deleteOk").hide();
            postAddressAjax(url, data);
        });

    }

    function showModalBox(msg, allAddress) {
        $("#modalBox, #ok_reload").show();
        $("#cancel_reload, #deleteOk").hide();
        $("#msgInModalBox").html(msg).show();

        $("#ok_reload").on('click', function () {
            $("#modalBox").hide();
            if($("#ok_reload").attr("data-ok")!='no'){
                makeAddressInputEmpty();
            }
            showAllAddress(allAddress);
        });
    }

    function generalModalBox(msg) {
        $("#modalBox, #ok_reload").show();
        $("#cancel_reload, #deleteOk").hide();
        $("#msgInModalBox").html(msg).show();

        $("#ok_reload").on('click', function () {
            $("#modalBox").hide();
            if($("#post_status").val() == "failed"){
                $("#addNewAddressModal").show();
            }
            //$("#modalBox").hide();
            /*makeAddressInputEmpty();
             showAllAddress(allAddress);*/
        });
    }

    function makeAddressInputEmpty() {
        // $("#first_name,#last_name,#address,#city,#mobile_number,#pincode_data,#address_id,#showAddressTypeOther").val("");
        $("#first_name,#last_name,#address,#city,#mobile_number,input[name=pincode_data],#address_id,#showAddressTypeOther").val("");
        $("#addressTypeErr,#showAddressTypeOther").hide();
        $("input[name=address_type]:first").prop('checked', true);
    }

    $("#cancel_reload").on('click', function () {
        $("#modalBox").hide();
    });

    // function showPagination(totalPage){
    function showPagination(totalPage, total_items) {
        totalPage = totalPage; // (8/2);
        lastPage = 0; // store last page value
        page_number = 1;
        // paginationConcept(totalPage,lastPage,page_number);
        paginationConcept(totalPage, lastPage, page_number, total_items);
    }

    // function paginationConcept(totalPage,lastPage,page_number){
    function paginationConcept(totalPage, lastPage, page_number, total_items) {
        paginationCode = '';
        startFrom = 1;
        nextTwo = 2; // show first two pagination value

        if (lastPage > 2) {
            paginationCode += '<li><a href="javascript:void(0);" onclick="showCurrentPageNumber(' + (lastPage - 1) + ',' + (page_number - 1) + ')"><i class="fas fa-angle-left"></i></a></li>';
            startFrom = (lastPage - 1);
            nextTwo = lastPage;
        } else {
            paginationCode += '<li><a href="javascript:void(0);" class="disabled"><i class="fas fa-angle-left"></i></a></li>';
        }
        for (i = startFrom; i <= nextTwo; i++) {
            if (i == page_number) {
                paginationCode += '<li><a href="javascript:void(0);" class="active" onclick="showCurrentPageNumber(' + (i) + ',' + i + ')">' + i + '</a></li>';
            } else {
                paginationCode += '<li><a href="javascript:void(0);" onclick="showCurrentPageNumber(' + (i) + ',' + i + ')">' + i + '</a></li>';
            }
            lastPage = i;
        }
        if (lastPage == totalPage) {
            paginationCode += '<li><a href="javascript:void(0);" class="disabled"><i class="fas fa-angle-right"></i></a></li>';
        } else {
            if (totalPage > 2) {
                paginationCode += '<li><a href="javascript:void(0);" onclick="showCurrentPageNumber(' + (lastPage + 1) + ',' + lastPage + ')"><i class="fas fa-angle-right"></i></a></li>';
            } else {
                paginationCode += '<li><a href="javascript:void(0);" class="disabled"><i class="fas fa-angle-right"></i></a></li>';
            }
        }

        $("#paginationOrderList").html(paginationCode).show();

        totalItems = total_items;
        commonRecords = ((page_number - 1) * 10);
        totalItemsFrom = (commonRecords + 1)
        forToRecords = (commonRecords + 10); // alert(forToRecords);
        totalItemsTo = (forToRecords > totalItems) ? (parseInt(totalItems)) : forToRecords;
        $("#totalItems").html(totalItems).show();
        $("#totalItemsFrom").html(totalItemsFrom).show();
        $("#totalItemsTo").html(totalItemsTo).show();

    }

    // showPagination(totalPage);

    function showCurrentPageNumber(lastPage, page_number) {
        // alert(lastPage);
        sendData = {lastPage: lastPage, page_number: page_number, 'csrf_test_name': csrf_value};
        $.ajax({
            url: "<?php echo site_url(); ?>" + 'dashboard/getPaginationRecord',
            data: sendData,
            type: "POST",
            dataType: "JSON",
            success: function (res) {
                // alert(JSON.stringify(res));
                totalPage = res.data.totalPage
                lastPage = res.data.lastPage;
                page_number = res.data.page_number;
                total_items = res.data.total_items;
                // paginationConcept(totalPage,lastPage,page_number);
                paginationConcept(totalPage, lastPage, page_number, total_items);

                recent_orders = res.data.recent_orders;
                total_items = 0;//res.data.total_items;

                if (recent_orders.length > 0) {
                    orderListPrint(recent_orders, recent_orders.length, total_items, showInDiv = '#orderedList');
                } else {
                    $("#orderedList").html("<div class='col-md-12' style='text-align:center; padding:10px 0;'>YOUR PAST ORDER <br><br> You have placed no orders.</div>").show();
                }

            }
        })
    }

    function deliverHere(address_id) {
        data = {address_id: address_id, 'csrf_test_name': csrf_value};
        url = '<?php echo site_url() ?>' + 'dashboard/setAddressDeliverHere';
        // alert('deliver here: ' + address_id);
        postAddressAjax(url, data);
    }

    $("#reorderThisItem").on("click", function () {
        orderId = $("#itemOrderId").html();
        if (orderId != '') {
            reorderItems(orderId);
        }
    });



    $('input:checkbox[name="changepwd"]').on("click", function () {
        console.log('safda');
                if ($(this).is(':checked')) {
                    $("#changepwd").show();
                } else
                {
                    $("#changepwd").hide();
                }
            });




    function reorderItems(orderId) {
        // alert(orderId);
        if (orderId != '') {
            data = {order_id: orderId, 'csrf_test_name': csrf_value};
            reorderItemsAjax(data);
        }
    }

    function reorderItemsAjax(data) {
        $.ajax({
            url: "<?php echo site_url(); ?>" + "reorder/updateCartData",
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function (res) {
                // alert(JSON.stringify(res));
                if (res.status == 'failed') {
                    generalModalBox(res.message);
                    // alert(res.message);
                } else if (res.status == 'success') {
                    // alert(res.message);
                    window.location.href = "<?php echo site_url(); ?>" + 'shop/cart';
                } else {
                    // alert();
                }

            }
        });
    }

    function checkValidEmail(myEmail) {
        atpos = myEmail.indexOf("@");
        dotpos = myEmail.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= myEmail.length) {
            return false;
        }
        return true;
    }

    function notAllowSpaces() {
        if (event.keyCode == 32) {
            return false;
        }
    }

    function onlyNumberKey(evt) {
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    /** For Google pincode go to assets/js/footer.js **/

    /*});*/
</script>