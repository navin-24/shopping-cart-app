<section class="dvAccount">
    <div class="container">
        <div class="row">
            <div class="dvProfile col-lg-12 text-center">
                <img src="<?= ASSET_URL ?>imgs/user-icon.jpg" class="img-fluid rounded" alt="">
                <h4>Amey Sawant</h4>
                <p>mailforamey@gmail.com</p>
            </div>
        </div>        
        <div id="dvTab" class="row bg">
            <!-- <div class="col-sm-12 text-center">
                <h4>Dashboard</h4>
            </div> -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="tabs d-flex flex-nowrap flex-lg-wrap justify-content-between justify-content-sm-center">
                            <li id="defaultOpen" class="tablinks" onclick="myTabs(event, 'dashboard')">Dashboard</li>
                            <li class="tablinks" onclick="myTabs(event, 'personalInfo')"><span class="d-none d-lg-inline-block">Personal</span> Info</li>
                            <li class="tablinks" onclick="myTabs(event, 'savedAddress')"><span class="d-none d-lg-inline-block">Saved</span> Address</li>
                            <li class="tablinks" onclick="myTabs(event, 'yourOrders')"><span class="d-none d-lg-inline-block">Your</span> Orders</li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div id="dashboard" class="tabcontent">
                            <div class="row mt15">
                                <!-- <div class="col-sm-12 text-center">
                                    <h4>Your Dashboard</h4>
                                    <p>Feel free to edit any of your details below so your account is totally up to date.</p>
                                </div> -->
                                <div class="col-lg-4">
                                    <div class="bg-grey">
                                        <button class="btnEdit">Edit</button>
                                        <h4>Personal Info</h4>
                                        <p>Amey Sawant</p>
                                        <p>mailforamey@gmail.com</p>
                                        <p>9136397429</p>
                                        <!-- <p>Change Password</p> -->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="bg-grey">
                                        <button class="btnEdit">Edit</button>
                                        <h4>Billing Address</h4>
                                        <p>Wife House</p>
                                        <p>206, ShivShakti Society, Golibar Road, Santacruz East, Mumbai - 400006. India.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="bg-grey">
                                        <button class="btnEdit">Edit</button>
                                        <h4>Change Password</h4>
                                        <p>************</p>
                                        <p>Click on edit button to edit your password.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb10 mt15 text-center">
                                    <h4>Recent Orders</h4>
                                </div>
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table>
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
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button class="btn btnSecondary">View All Orders</button>
                                </div>
                            </div>
                        </div>

                        <div id="personalInfo" class="tabcontent">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                    <div class="col-sm-12 text-center mb10 mt15">
                                    <h4>Edit Personal Info</h4>
                                    <p>Feel free to edit any of your details below.</p>
                                </div>
                                <div class="col-sm-12">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="Full Name" value="Amey Sawant">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="Email Id" value="mailforamey@gmail.com">
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button class="btn btnSecondary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                    </div>
                                </div>                                
                                <div class="col-lg-6">
                                    <div class="row">
                                    <div class="col-sm-12 text-center mb10 mt15">
                                    <h4>Change Password</h4>
                                    <p>Change your password with these easy steps below.</p>
                                </div>
                                <div class="col-sm-12">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <input type="password" class="form-control" placeholder="Current Password">
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <input type="password" class="form-control" placeholder="New Password">
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <input type="password" class="form-control" placeholder="Confirm Password">
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button class="btn btnSecondary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div id="savedAddress" class="tabcontent">
                            <div class="row">   
                                <div class="default col-sm-12">
                                    <div class="row">
                                        <!-- <div class="col-sm-12 text-center mb15">
                                            <h4>Saved Address</h4>
                                        </div> -->
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="bg-grey d-flex flex-column justify-content-between">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <h5>Default</h5>
                                                    <div class="dot dot-default"></div>
                                                </div>
                                                <p class="title">
                                                        Home
                                                    </p>
                                                <p>
                                                    <span>Ankit Madan,</span>
                                                    <br>
                                                    <span>Mansion Bldg, Jankalyan Nagar, Malad West, Mumbai - 400066.</span>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <span class="edit"><i class="fas fa-edit"></i> Edit</span>
                                                    <span class="delete"><i class="far fa-trash-alt"></i> Delete</span>
                                                </div>
                                                <!-- <div class="deliverHere">
                                                    <button class="btn btnSecondary">Deliver Here</button>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="bg-grey d-flex flex-column justify-content-between">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <button class="btn btnDefault"><h5>Set as Default</h5></button>
                                                    <!-- <div class="dot"></div> -->
                                                </div>
                                                <p class="title">
                                                        Work
                                                    </p>
                                                <p>
                                                    <span>Ankit Madan,</span>
                                                    <br>
                                                    <span>Mansion Bldg, Jankalyan Nagar, Malad West, Mumbai - 400066.</span>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <span class="edit"><i class="fas fa-edit"></i> Edit</span>
                                                    <span class="delete"><i class="far fa-trash-alt"></i> Delete</span>
                                                </div>
                                                <!-- <div class="deliverHere">
                                                    <button class="btn btnSecondary">Deliver Here</button>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="bg-grey d-flex flex-column justify-content-between">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <button class="btn btnDefault"><h5>Set as Default</h5></button>
                                                    <!-- <div class="dot"></div> -->
                                                </div>
                                                <p class="title">
                                                        Office
                                                    </p>
                                                <p>
                                                    <span>Ankit Madan,</span>
                                                    <br>
                                                    <span>Mansion Bldg, Jankalyan Nagar, Malad West, Mumbai - 400066.</span>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <span class="edit"><i class="fas fa-edit"></i> Edit</span>
                                                    <span class="delete"><i class="far fa-trash-alt"></i> Delete</span>
                                                </div>
                                                <!-- <div class="deliverHere">
                                                    <button class="btn btnSecondary">Deliver Here</button>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="bg-grey d-flex flex-column justify-content-between">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <button class="btn btnDefault"><h5>Set as Default</h5></button>
                                                    <!-- <div class="dot"></div> -->
                                                </div>
                                                <p class="title">
                                                        Wife House
                                                    </p>
                                                <p>
                                                    <span>Ankit Madan,</span>
                                                    <br>
                                                    <span>Mansion Bldg, Jankalyan Nagar, Malad West, Mumbai - 400066.</span>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <span class="edit"><i class="fas fa-edit"></i> Edit</span>
                                                    <span class="delete"><i class="far fa-trash-alt"></i> Delete</span>
                                                </div>
                                                <!-- <div class="deliverHere">
                                                    <button class="btn btnSecondary">Deliver Here</button>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center mt15 mb15">
                                    <!-- <button class="btn btnSecondary">Add New Address</button> -->
                                    <h4>Add New Address</h4>
                                </div>
                                <div class="col-sm-12">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <input type="text" class="form-control" placeholder="Enter Location">
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <input type="text" class="form-control" placeholder="Flat No, Building Name">
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <input type="text" class="form-control" placeholder="Locality, City, Landmark">
                                            </div>
                                            <div class="radios col-sm-12 text-center">
                                                <label><input type="radio" name="radio" checked="checked"> Home</label>
                                                <label><input type="radio" name="radio"> Work</label>
                                                <label><input type="radio" name="radio"> Other</label>
                                            </div>
                                            <div class="col-md-4 offset-md-4">
                                                <input type="text" class="form-control" placeholder="e.g Wife House">
                                            </div>
                                            <div class="col-sm-12 mt10 text-center">
                                                <button class="btn btnSecondary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="yourOrders" class="tabcontent">
                            <div class="row order-table">
                                <!-- <div class="col-sm-12 text-center mt15 mb15">
                                    <h4>Your Past Orders</h4>
                                </div> -->
                                <div class="col-sm-12 mt15 mb15">
                                    <div class="table-responsive">
                                        <table>
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
                                        </table>
                                    </div>
                                </div>
                                <div class="pagination col-sm-12">
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
                                </div>
                            </div>
                            <!-- <div class="dvOrderDetail row d-none"> -->
                            <div class="dvOrderDetail row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <!-- <div class="col-sm-12 mb15">
                                            <button class="btn"><i class="fas fa-angle-left"></i> Back</button>
                                        </div> -->
                                        <div class="col-lg-6">
                                            <h5>Order No: #100024170 - <span class="text-red">Cancelled</span></h5>
                                            <p><b>Order Date:</b> <span>18 March 2020</span></p>
                                        </div>
                                        <div class="col-lg-6 text-lg-right">
                                            <button class="btn btnSecondary btnEdit">Reorder</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-sm-12 mt15 text-lg-center d-none d-lg-block">
                                            <h4>Shipping Details</h4>
                                        </div> -->
                                        <div class="col-sm-6 mt15">
                                            <div class="bg-grey">
                                                <h5 class="mb10">Shipping Address</h5>
                                                <h6>Home</h6>
                                                <p>
                                                    206, Shiv Shakti Society, Golibar Road, Santacruz East, Mumbai - 400054. India. Near Aman Building.
                                                    <br><span>Phone: 8989898898</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt15">
                                            <div class="bg-grey">
                                                <h5 class="mb10">Billing Address</h5>
                                                <h6>Lower Parel Office</h6>
                                                <p>
                                                    206, Shiv Shakti Society, Golibar Road, Santacruz East, Mumbai - 400054. India. Near Aman Building.
                                                    <br><span>Phone: 8989898898</span>
                                                </p>
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
                                        <div class="col-sm-12">
                                            <div class="row border">
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
                                                            <!-- <p class="size">250 ml</p> -->
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
                                                            <!-- <p class="size">400 ml</p> -->
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
                                            </div>
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
                                                    <p><i class="fas fa-rupee-sign"></i>50,000.00</p>
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
                                                    <p><i class="fas fa-rupee-sign"></i>500.00</p>
                                                </div>
                                            </div>
                                            <div class="row bg">
                                                <div class="col-6">
                                                    <p><b>Grand Total</b></p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p><b><i class="fas fa-rupee-sign"></i>5,280.00</b></p>
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

<script>
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
document.getElementById("defaultOpen").click();
</script>