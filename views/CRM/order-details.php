<style>
    header,footer{display:none !important;}
    /*dvDashboard*/
    .dvDashboard{padding-top:83px; padding-bottom:15px; background: #fff; font-family:'Ubuntu', sans-serif;}
    .dvDashboard h4{margin:0 0 15px 0;font-weight: 200; line-height: 1; color: #000; letter-spacing: 1px; font-size: 24px;}
    /*data-tables*/
    .dvDashboard table.dataTable thead th, .dvDashboard table.dataTable thead td{padding:8px 15px; font-size:14px;border-bottom: none;}
    .dvDashboard table.dataTable tfoot th, .dvDashboard table.dataTable tfoot td { padding: 8px 15px; border-top: 1px solid #111; font-size: 14px;    border-top:none;}
    .dvDashboard .dataTables_wrapper .dataTables_info {font-size: 14px;}
    .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, 
    .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, 
    .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{background:#eee; color:#aaa !important;}
    .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button{background:#222; color:#fff !important;}
    .dvDashboard .dataTables_wrapper .dataTables_paginate{margin-top:5px;}
    .dvDashboard button.dt-button, .dvDashboard div.dt-button, .dvDashboard a.dt-button{background:#222; color:#fff;}
    .dvDashboard .dataTables_wrapper .dataTables_filter input{padding:6px 15px;}
    .dvDashboard button.dt-button:hover:not(.disabled), 
    .dvDashboard  div.dt-button:hover:not(.disabled), 
    .dvDashboard a.dt-button:hover:not(.disabled){background:#222; color:#fff;}
    .dvDashboard button.dt-button:focus:not(.disabled), 
    .dvDashboard div.dt-button:focus:not(.disabled), 
    .dvDashboard a.dt-button:focus:not(.disabled){background:#222 !important; color:#fff !important; border: 0; text-shadow: none;}
    /*data-tables*/
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
    /* .dvDashboard .ptb10{padding:10px 0;} */
    .dvDashboard .select{width:100px;}
    .dvDashboard .bg-grey{background: #eee; padding:5px 0;}
    .dvDashboard .bg-dark{background: #eee; padding:2px 0;}
    .dvDashboard .bg-white{background: white; padding:2px 0;}
    /* .dvDashboard table th, .dvDashboard table td{padding:4px 6px !important; border-color:#ddd;} */
    .dvDashboard table th{background: #ddd;}
    .dvDashboard table td{font-size:12px;}
    .dvDashboard table tr:nth-child(even){background: #f9f9f9;}

    /*dvMainDashboard*/
    .dvMainDashboard .bg-dark{padding:10px;}
    .dvMainDashboard .w-100{width:100%; padding:6px 12px; border-bottom: 1px solid #555;}
</style>
<section class="dvDashboard dvMainDashboard">
    <div class="container-fluid">
        <div class="row mb15 mt10">

            <div class="col-lg-12">
                <h4>Dashboard</h4>
            </div>
            <div class="col-lg-2">
                <button onclick="openCity(event, 'tab1')" id="defaultOpen" class="btn d-block w-100">Information</button>
                <!-- <button onclick="openCity(event, 'tab2')" class="btn d-block w-100">Shoping</button>
               <button onclick="openCity(event, 'tab3')" class="btn d-block w-100">Credit Memos</button>
                <button onclick="openCity(event, 'tab4')" class="btn d-block w-100">Shipments</button>
                <button onclick="openCity(event, 'tab5')" class="btn d-block w-100">Comments History</button>
                <button onclick="openCity(event, 'tab6')" class="btn d-block w-100">Transactions</button>-->
            </div>

            <div class="col-lg-10">
                <div class="row mb10">
                    <div class="col-lg-6">
                        <p><b>Order #<?php echo $data['order_id']; ?></b> | <?php echo date('d M Y H:i:s', strtotime($data['created_at'])); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div id="tab1" class="tabcontent col-lg-12">
                        <div class="row">

                            <div class="col-lg-6 mb15">                
                                <h5>Order #<?php echo $data['order_id']; ?> (the order confirmation email was sent)</h5>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="bg-dark" style="min-height:170px;">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p><b>Order Date</b></p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <p><?php echo date('d M Y H:i:s', strtotime($data['created_at'])); ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p><b>Order Status</b></p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <p><?php echo $data['status']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p><b>Placed from IP</b></p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <p> <?php echo $data['remote_id']; ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb15">
                                <h5>Account Information</h5>               
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="bg-dark" style="min-height:170px;">
                                            <div class="row">                    
                                                <div class="col-lg-4">
                                                    <p><b>Customer Name</b></p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <a href=""><?php echo $data['customer_firstname'] . ' ' . $data['customer_lastname']; ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p><b>Email</b></p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <a href=""><?php echo $data['customer_email']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 mb15">
                                        <h5>Billing Address</h5>
                                        <div class="bg-dark">                      
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p><b><?php echo $data['firstname'] . ' ' . $data['lastname']; ?></b></p>
                                                    <p><?php echo $data['address'] . ', ' . $data['city'] . ', ' . $data['state'] . ' ' . $data['country'] . ' ' . $data['pincode']; ?></p>
                                                    <p>Tel: <?php echo $data['mobile_number']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                

                                    <div class="col-lg-6 mb15">
                                        <h5>Shipping Address</h5>
                                        <div class="bg-dark">                      
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p><b><?php echo $data['firstname'] . ' ' . $data['lastname']; ?></b></p>
                                                    <p><?php echo $data['address'] . ', ' . $data['city'] . ', ' . $data['state'] . ' ' . $data['country'] . ' ' . $data['pincode']; ?></p>
                                                    <p>Tel: <?php echo $data['mobile_number']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                
                            </div>

                            <div class="col-lg-6 mb15">
                                <h5>Customer Comment</h5>
                                <div class="bg-dark">
                                    <div class="row">
                                        <div class="col-lg-12">                    
                                            <p><?php echo $data['customer_comment']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb15">
                                <h5>Delivery Date</h5>
                                <div class="bg-dark">
                                    <div class="row">
                                        <div class="col-lg-12">                    
                                            <p><?php
                                                $delivery_date = ($data['delivery_date'] != null) ? date('l, d F Y', strtotime($data['delivery_date'])) : '';
                                                echo $delivery_date;
                                                ?> <!-- Monday, 13 April 2020 -->  
                                            </p>                  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb15">
                                <h5>Payment Information</h5>
                                <div class="bg-dark" style="min-height:60px;">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p><b>Pay Online</b></p>
                                            <p>Order was placed using INR.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb15">
                                <h5>Shipping &amp; Handling Information</h5>
                                <div class="bg-dark" style="min-height:60px;">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p><b>Free Shipping</b> - Free <i class="fas fa-rupee-sign"></i> 0.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mb15">
                                <h5>Items Ordered</h5>
                                <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Item Status</th>
                                            <th>Original Price</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                      <!--                      <th>Tax Amount</th>
                                            <th>Tax Percent</th>
                                            <th>Dicsount Amount</th>
                                            <th>Row Total</th>-->
                                        </tr>
                                        <?php
                                        $coupon = $data['coupon_code'];
                                        $coupon_discount = number_format($data['discount_amount'], 2);

                                        foreach ($itemsOrdered as $row) {
                                            $totalAfterDiscount = 0;
                                            $subtotal = ($row['qty_ordered'] * $row['price']);
                                            $discount_amount = 0;
                                            $rowTotal = $subtotal;

                                            if ($coupon != null && $coupon_discount != null) {
                                                $totalAfterDiscount = $subtotal - ($subtotal * ($coupon_discount / 100));
                                                $discount_amount = ($subtotal - $totalAfterDiscount);
                                                $rowTotal = $totalAfterDiscount;
                                            }
                                            ?>  
                                            <tr>
                                                <td>
                                                    <p><?= $row['category_name'] ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo $row['product_name']; ?></p>
                                                    <p>SKU:- <?php echo $row['sku']; ?></p>
                                                    <?php if($row['varient']!=''){ 
                                                        $qty = ($row['quantity']>0)?" X ".$row['quantity']:"";
                                                        ?>
                                                        <p>Size:- <?= $row['varient'].$qty;?></p>
                                                    <?php } ?>
                                                </td>
                                                <td>Invoiced</td>
                                                <td>
                                                    <i class="fas fa-rupee-sign"></i> <?php echo $row['price']; ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-rupee-sign"></i> <?php echo $row['price']; ?>
                                                </td>
                                                <td>
                                                    <div><span>Ordered:</span><span><?php echo $row['qty_ordered']; ?></span></div>
                                                </td>
                                                <td>
                                                    <i class="fas fa-rupee-sign"></i><?php echo $subtotal; ?>
                                                </td>
                          <!--                      <td>
                                                  <i class="fas fa-rupee-sign"></i>0.00
                                                </td>
                                                <td>
                                                  0%
                                                </td>
                                                <td>
                                                  <i class="fas fa-rupee-sign"></i><?php echo number_format($discount_amount, 2); ?>
                                                </td>
                                                <td>
                                                  <i class="fas fa-rupee-sign"></i> <?php echo number_format($rowTotal, 2); ?>
                                                </td>-->
                                            </tr>
                                            <?php
                                            // unset($discount_amount,$subtotal,$amountWithoutDiscount);
                                        }
                                        ?>

                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <h5>Order Totals</h5>
                                <div class="bg-dark">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row mb5">
                                                <div class="col-6">
                                                    <p>Subtotal</p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p><i class="fas fa-rupee-sign"></i><?php echo number_format($data['sub_total'], 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="row mb5">
                                                <div class="col-6">
                                                    <p>Shipping &amp; Handling</p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p><i class="fas fa-rupee-sign"></i>0.00</p>
                                                </div>
                                            </div>


                                            <div class="row mb5">
                                                <div class="col-6">
                                                    <p>Discount 
                                                        <?php
                                                        if ($data['coupon_code']) {
                                                            echo '(' . strtoupper($data['coupon_code']) . ')';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p><i class="fas fa-rupee-sign"></i><?= number_format($data['discount_amount'], 2); ?></p>
                                                </div>
                                            </div>
                                            <?php if ($data['tax_amount']) { ?>
                                                <div class="row mb5">
                                                    <div class="col-6">
                                                        <p><b>Tax Amount</b></p>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <p><i class="fas fa-rupee-sign"></i><?php echo number_format($data['tax_amount'], 2); ?></p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row mb5">
                                                <div class="col-6">
                                                    <p><b>Grand Total</b></p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p><i class="fas fa-rupee-sign"></i><?php echo number_format($data['grand_total'], 2); ?></p>
                                                </div>
                                            </div>
                                            <!-- <div class="row mb5">
                                              <div class="col-6">
                                                <p><b>Total Paid</b></p>
                                              </div>
                                              <div class="col-6 text-right">
                                                <p><i class="fas fa-rupee-sign"></i>0.00</p>
                                              </div>
                                            </div>
                                            <div class="row mb5">
                                              <div class="col-6">
                                                <p><b>Total Refunded</b></p>
                                              </div>
                                              <div class="col-6 text-right">
                                                <p><i class="fas fa-rupee-sign"></i>0.00</p>
                                              </div>
                                            </div>
                                            <div class="row mb5">
                                              <div class="col-6">
                                                <p><b>Total Due</b></p>
                                              </div>
                                              <div class="col-6 text-right">
                                                <p><i class="fas fa-rupee-sign"></i>0.00</p>
                                              </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>                
                            </div>

                        </div>

                    </div>
                </div>

                <div id="tab2" class="tabcontent col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            tab 2
                        </div>
                    </div>
                </div>

                <div id="tab3" class="tabcontent col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            tab 3
                        </div>
                    </div>
                </div>

                <div id="tab4" class="tabcontent col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            tab 4
                        </div>
                    </div>
                </div>

                <div id="tab5" class="tabcontent col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            tab 5
                        </div>
                    </div>
                </div>

                <div id="tab6" class="tabcontent col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            tab 6
                        </div>
                    </div>
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