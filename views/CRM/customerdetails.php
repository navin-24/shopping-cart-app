<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_meta['meta_title']; ?></title>
        <link rel="shortcut icon" href="<?= ASSET_URL ?>imgs/favicon.png" />
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/grid.css">
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/main.css">
        <title>Raw Pressery</title>
    </head>
    <style>
        /*dvDashboard*/
        body{background: #fff;}
        .dvDashboard{padding-top:0px; padding-bottom:15px; background: #fff;}
        .dvDashboard h4{margin:0 0 15px 0;}
        .dvDashboard h5{background: #555; color:#fff; padding:10px; font-size:14px; font-weight: 500;}
        .dvDashboard .btn{padding:0px 6px; font-size:12px; color:#fff;}
        .dvDashboard .form-control{padding:0;}
        .dvDashboard a{color:blue;}
        .dvDashboard b{font-weight: 500;}
        .dvDashboard .input{width:70px;}
        .dvDashboard i{font-size:10px;}
        .dvDashboard .mr5{margin-right:5px;}
        .dvDashboard .mb15{margin-bottom:15px;}
        .dvDashboard .mb5{margin-bottom:5px;}
        .dvDashboard .mb10{margin-bottom:10px;}
        .dvDashboard .mr15{margin-right:15px;}
        .dvDashboard .mr10{margin-right:10px;}
        .dvDashboard .ml15{margin-left:15px;}
        .dvDashboard .ml10{margin-left:10px;}
        .dvDashboard .mt10{margin-top:10px;}
        .dvDashboard .select{width:100px;}
        .dvDashboard .bg-grey{background: #eee; padding:5px 0;}
        .dvDashboard .bg-dark{background: #eee; padding:2px 0;}
        .dvDashboard .bg-white{background: white; padding:2px 0;}
        .dvDashboard table th, .dvDashboard table td{padding:4px 6px; border-color:#ddd;}
        .dvDashboard table th{background: #ddd;}
        .dvDashboard table td{font-size:12px;}
        .dvDashboard table tr:nth-child(even){background: #f9f9f9;}
        /*dvMainDashboard*/
        .dvMainDashboard .bg-dark{padding:10px;}
        .dvMainDashboard .w-100{width:100%; padding:6px 12px; border-bottom: 1px solid #555;}
        /*dvCustomerDashboard*/
        .dvCustomerDashboard h4{margin:15px 0 15px 0;}
        .dvCustomerDashboard .bg-dark{padding:10px; min-height: 170px;}
        .dvDashboard.dvCustomerDashboard .btn{width:100%; padding:6px;}
        .dvDashboard.dvCustomerDashboard .tabcontent b{font-weight: 600;}

        .dvDashboard ul.menu{list-style-type: none; padding: 0;}
            .dvDashboard ul.menu li{display: inline-block;}
            .dvDashboard ul.menu li a{display: inline-block; background: #000; color:#fff; text-decoration: none; padding:5px 15px;}
    </style>
    <body>
        <section class="dvDashboard dvCustomerDashboard">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="<?= base_url('AdminDashboard/customers'); ?>">&#8592; Return Back</a>
                    </div>
                    <div class="col-sm-12">
                        <ul class="menu">
                            <li><a href="<?= base_url('AdminDashboard/orders');?>">Orders</a></li>
                            <li><a href="<?= base_url('AbandonedCart');?>">Abandoned Cart</a></li>

                        </ul>
                    </div>
                    <div class="col-lg-12 mt15">
                        <h4>Customer Information</h4>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <button onclick="openCity(event, 'tab1')" id="defaultOpen" class="btn d-block w-100 mb10">Information</button>
                                <button onclick="openCity(event, 'tab2')" class="btn d-block w-100">Shopping Cart</button>
                                <!-- <button onclick="openCity(event, 'tab3')" class="btn d-block w-100">Credit Memos</button>
                                <button onclick="openCity(event, 'tab4')" class="btn d-block w-100">Shipments</button>
                                <button onclick="openCity(event, 'tab5')" class="btn d-block w-100">Comments History</button>
                                <button onclick="openCity(event, 'tab6')" class="btn d-block w-100">Transactions</button>-->
                            </div>
                            <div id="tab1" class="col-lg-10 tabcontent">
                                <div class="row">
                                    <div class="col-lg-12 mb15">
                                        <h5>Personal Information</h5>
                                        <div class="row">
                                            <div class="col-sm-6 pr0">
                                                <div class="bg-dark">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p><b>Customer Name</b></p>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <p><?= $customerDetails['first_name'] . ' ' . $customerDetails['last_name']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p><b>Contact Number</b></p>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <p><?= $customerDetails['mobile_number']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p><b>Email</b></p>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <p><?= $customerDetails['email']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p><b>Account Created On</b></p>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <p><?= date('d M Y H:i:s', strtotime($customerDetails['created_at'])); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pl0">
                                                <div class="bg-dark">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p><b>Default Billing Address</b></p>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <p>The Customer does not have default billing address.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach ($customerAddress as $addRow) { ?>
                                        <div class="col-lg-6 mb15">
                                            <h5><?= $addRow['address_type']; ?></h5>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="bg-dark">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p><b>Customer Name</b></p>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <p><?= $addRow['first_name'] . ' ' . $addRow['last_name']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p><b>Home Address</b></p>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <p><?= $addRow['address'] . ' ' . $addRow['city'] . ' ' . $addRow['state'] . ' ' . $addRow['pincode'] . ' ' . $addRow['country']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p><b>Tel</b></p>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <p><?= $addRow['mobile_number']; ?></p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $billingChecked = ($addRow['is_default_billing']) ? 'checked' : '';
                                                        $shippingChecked = ($addRow['is_default_billing']) ? 'checked' : '';
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p><b>Default Address</b></p>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <span class="mr15"><label><input type="radio" name="bradio" <?= $billingChecked; ?>> Billing</label></span>
                                                                <span><label><input type="radio" name="sradio" <?= $shippingChecked; ?>> Shipping</label></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            
                            <div id="tab2" class="col-lg-10 tabcontent"> 
                                <?php if ($cartData) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Sku</th>
                                                        <th>Subtotal</th>
                                                        <th>Row Total</th>
                                                    </tr>
                                                    <?php foreach ($cartData as $row) { ?>

                                                        <tr>
                                                            <td>
                                                                <p><?php echo $row['product_name']; ?></p>
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-rupee-sign"></i> <?php echo $row['qty']; ?>
                                                            </td>
                                                            <td>
                                                                <div><?php echo $row['sku']; ?></div>
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-rupee-sign"></i><?php echo $row['price_incl_tax']; ?>
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-rupee-sign"></i><?php echo $row['qty'] * $row['price_incl_tax']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else {

                                    echo 'No Data in cart';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
        <script>
            function openCity(evt, tabNumber) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabNumber).style.display = "block";
                evt.currentTarget.className += " active";
            }
            document.getElementById("defaultOpen").click();
        </script>
    </body>
</html>