<section class="dvCart">
    <div class="container">
        <?php if ($cartItems) {
            ?>
            <div class="row">
                <div class="leftColumn col-lg-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>Your Cart</h1>
                        </div>
                        <?php
                        $i = 1;
                        $checkout = TRUE;
                        foreach ($cartItems as $items) {
                            if ($_GET['dbg'] == 1) {
                                echo '<pre>';
                                print_r($items);
                            }

                            $thumb_image_url = PRODUCT_THUMB_PATH . $items['thumb_image_url'];
                            $product_id = $items['options']['product_id'];
                            $CI = & get_instance();
                            $catResult = $CI->cart_model->getProductCategory($product_id);
                            //print_r($result);die;

                            $productStr.= '{"Product Id" : ' . $product_id . ',"Product Name" : "' . $items['name'] . '","Price" : ' . $this->cart->format_number($items['subtotal']) . ',"Quantity" : ' . $items['qty'] . ',"Product Image" : "' . $thumb_image_url . '"},';
                            $productNameStr.=$items['name'] . ",";
                            $productIdStr.=$product_id . ",";
                            $categoryNameStr.=$catResult['category_name'] . ",";
                            $categoryIdStr.=$catResult['category_id'] . ",";
                            $qtyStr.=$items['qty'] . ",";
                            $priceStr.= str_replace(",", "", $this->cart->format_number($items['subtotal'])) . ",";

                            if (!$items['is_in_stock'] && $checkout == TRUE) {
                                $checkout = FALSE;
                            }
                            ?>
                            <div class="col-sm-12 mb15" id="cart_item_<?= $items['rowid']; ?>">
                                <div class="bg-grey">
                                    <a class="hand closeBtn removeCart" cart_item_id = <?= $items['rowid']; ?> sku="<?= $items['id']; ?>" productid="<?= $product_id; ?>"><i class="fas fa-times"></i></a>
                                    <div class="row">
                                        <div class="col-3 col-sm-2 p0 text-center">
                                            <a href="<?= site_url(strtolower('shop/' . str_replace(' ', '-', $items['category_url']) . '/' . $items['product_url'])); ?>"><img src="<?= $thumb_image_url; ?>" class="img-fluid" alt=""></a>
                                        </div>
                                        <div class="col-9 col-sm-10">
                                            
                                            <h2><a href="<?= site_url(strtolower('shop/' . str_replace(' ', '-', $items['category_url']) . '/' . $items['product_url'])); ?>"><?=
                                                    $items['category_name'] . ' - ' . $items['name'];
                                                    if ($items->options->option_name != '') {
                                                        echo ' (' . $items->options->option_name . ')';
                                                    }
                                                    ?>
                                                </a>
                                            </h2>
                                            <div class="row">
                                                <div class="col-sm-12 col-xl-10">
                                                    <div class="row">
                                                        <div class="col-6 mb15">
                                                            <div class="row no-gutters">
                                                                <div class="col-sm-6">
                                                                    <label>Qty</label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="cartButtons">
                                                                        <div class="btn btnPM">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <?php if ($items['qty'] == 1) { ?>
                                                                                    <button class="minus btn disabled" disabled="disabled" row_id = "<?= $items['rowid']; ?>" sku="<?= $items['id']; ?>"><i class="fas fa-minus"></i></button>
                                                                                <?php } else { ?>
                                                                                    <button class="minus btn" row_id = "<?= $items['rowid']; ?>" sku="<?= $items['id']; ?>"><i class="fas fa-minus"></i></button>
                                                                                <?php } ?>
                                                                                <span class="qty"><input type="text" class="form-control" value="<?= $items['qty']; ?>"></span>
                                                                                <button class="plus btn" row_id = "<?= $items['rowid']; ?>" sku="<?= $items['id']; ?>" sku="<?= $items['id']; ?>"><i class="fas fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if ($items['options']['option_name'] !== '') {
                                                            ?>
                                                            <div class="col-6 mb15">
                                                                <div class="row no-gutters">
                                                                    <div class="col-sm-6">
                                                                        <label>Duration</label>
                                                                    </div>
                                                                    <div class="col-sm-6">

                                                                        <span class="disabled-text"><?= $items['options']['option_name']; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        if ($items->options->start_date !== NULL) {
                                                            ?>
                                                            <div class="col-6 mb15">
                                                                <div class="row no-gutters">
                                                                    <div class="col-sm-6">
                                                                        <label>St. Date</label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- <i class="far fa-calendar-alt"></i> -->
                                                                        <input id="today1" type="date" placeholder="dd-mm-yyyy" class="form-control faCalendar">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="price col-sm-12 text-right">
                                                    <div class="row">
                                                        <div class="col-6 text-left">
                                                            <span class="sizeLabel">Size:</span>
                                                            <span class="ml"><?= $items['options']['size']; ?></span>
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <i class="fas fa-rupee-sign"></i>
                                                            <span class="amt" id='amt_<?= $items['rowid']; ?>'><?= $this->cart->format_number($items['subtotal']); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if (!$items['is_in_stock']) { ?>
                                                    <p class="outofstock">* This product is currently out of stock. </p>
                                                    <?php
                                                } else if (!in_array($city_id, $items['cityIdArr'])) {
                                                        $checkout = FALSE;
                                                    ?>
                                                    <p class="outofstock">Currently not available</p>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="rightColumn col-lg-3 d-none d-lg-block">
                    <div class="subTotal row">
                        <div class="col col-sm-6">
                            <span>SubTotal</span>
                        </div>
                        <div class="col col-sm-6 text-right">
                            <i class="fas fa-rupee-sign"></i> <span class="amt subtotal"><?= $this->cart->format_number($sub_total); ?></span>
                        </div>
                    </div>
                    <div class="delivery row">
                        <div class="col col-sm-6"><span>Delivery</span></div>
                        <div class="col col-sm-6 text-right"><span>FREE</span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border-bottom"></div>
                        </div>
                    </div>
                    <div class="grandTotal row">
                        <div class="col col-sm-6"><span>Grand Total</span></div>
                        <div class="col col-sm-6 text-right">
                            <i class="fas fa-rupee-sign"></i> <span class="amt grandtotal"><?= $this->cart->format_number($grand_total); ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- <button class="btn btnContinue">Continue</button> -->
                            <?php if ($checkout) { ?>
                                <a href="<?php echo base_url('checkout'); ?>" class="btn btnSecondary" style="width:100%;">Continue</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row dvEmptyCart">
                <div class="col-sm-12">
                    <img src="<?= ASSET_URL ?>imgs/empty-cart.png" alt="" class="img-fluid">
                    <h4>Shopping Cart is Empty</h4>
                    <!-- <p>
                        You have no items in your shopping cart.
                    </p> -->
                    <a href="<?= base_url('shop/juices'); ?>" class="btn btnSecondary">Continue shopping</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if ($cartItems) { ?>
        <div class="loginToProceed col-12 d-lg-none">
            <div class="container">
                <div class="row align-items-center justify-content-end">
                    <div class="amt d-flex align-items-center justify-content-start">
                        <i class="fas fa-rupee-sign"></i> <span class="grandtotal"> <?= $this->cart->format_number($grand_total); ?></span>
                    </div>
                    <div class="">
                        <?php
                        if ($checkout) {
                            $customer_id = $this->session->userdata('logged_in')['customer_id'];
                            if ($customer_id != null && $customer_id != '') {
                                ?>
                                <a href="<?php echo base_url('checkout'); ?>" class="btn btnPrimary" style="margin-left:10px; font-size:12px !important;">Continue</a>
                                <!-- <button class="btn btnLoginToProceed">Login to Proceed</button> -->
                                <?php
                            } else {
                                ?>
                                <a href="<?php echo base_url('checkout'); ?>" class="btn btnLoginToProceed btnPrimary" style="margin-left:10px; font-size:12px !important;">Login to Proceed</a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
<div class="dvModal">
    <div id="confirm_remove_cart_item" class="modal alertModal">
        <div class="modal-content modal-sm d-lg-block">
            <div class="alert">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h5>Are your Sure?</h5>
                        <p class="content">Are you sure you want to remove this item from the cart?</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btnPrimary" id="cancel_remove_item">No</button>
                        <button class="btn btnPrimary" id="proceed_remove_item">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    webengage.track("Cart Viewed", {
        "Product Id": "<?php echo rtrim($productIdStr, ","); ?>",
        "Product Name": "<?php echo rtrim($productNameStr, ","); ?>",
        "Category Id": "<?php echo rtrim($categoryIdStr, ","); ?>",
        "Category Name": "<?php echo rtrim($categoryNameStr, ","); ?>",
        "Quantity": "<?php echo rtrim($qtyStr, ","); ?>",
        "Price": "<?php echo rtrim($priceStr, ","); ?>",
        "No. Of Products": <?php echo $this->cart->all_item_count(); ?>,
        "Total Value": <?= str_replace(",", "", number_format($grand_total)); ?>,
        'Product Details': [<?php echo $productStr; ?>]
    });
</script>



<div class="dvModal">
    <div id="failModal" class="failModal modal">
        <div class="modal-content modal-center text-center">
            <h5><?= $this->session->flashdata('payment_error'); ?></h5>
            <button class="btn btnPrimary" id="paymentok">Ok</button>
        </div>
    </div>
</div>
<?php if ($this->session->flashdata('payment_error')) { ?>
    <script>
        failModal.style.display = "block";
    </script>
<?php } ?>
