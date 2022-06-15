<?php /* <?= form_open('cart/updateCart'); ?>

  <table cellpadding="6" cellspacing="1" style="width:100%" border="1" >

  <tr style="text-align:left">
  <th>Item Description</th>
  <th>QTY</th>
  <th style="text-align:right">Item Price</th>
  <th style="text-align:right">Sub-Total</th>
  </tr>

  <?php
  $i = 1;
  foreach ($cartItems as $items):
  echo form_hidden($i . '[rowid]', $items['rowid']);
  ?>

  <tr style="text-align:left">
  <td>
  <?= $items['name']; ?>

  <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

  <p>
  <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

  <strong><?= $option_name; ?>:</strong> <?= $option_value; ?><br />

  <?php endforeach; ?>
  </p>

  <?php endif; ?>

  </td>
  <td><?= form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>

  <td><?= $this->cart->format_number($items['price']); ?></td>
  <td>$<?= $this->cart->format_number($items['subtotal']); ?></td>
  </tr>

  <?php
  $i++;
  endforeach;
  ?>

  <tr style="text-align:left">
  <td> <strong>Total</strong></td>
  <td> <strong><?= $this->cart->total_items(); ?></strong></td>
  <td class="right"></td>
  <td class="right">$<?= $this->cart->format_number($this->cart->total()); ?></td>
  </tr>

  </table>

  <p><?= form_submit('', 'Update your Cart'); ?></p>
  <a href="<?= base_url('checkout'); ?>">Proceed to checkout</a>

 */ ?>

<section class="dvCart">
    <div class="container">
        <div class="row">
            <div class="leftColumn col-lg-9">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Your Cart</h1>
                    </div>

                    <?php
                    $i = 1;
                    foreach ($cartItems as $items) {
                        //print_r($items);
                        echo form_hidden($i . '[rowid]', $items['rowid']);
                        ?>
                        <div class="col-sm-12 mb15" id="<?= $items['id']; ?>">
                            <div class="bg-grey">
                                <a class="hand closeBtn removeCart" rowid = <?= $items['rowid']; ?> productid="<?= $items['options']['product_id']; ?>"><i class="fas fa-times"></i></a>
                                <div class="row">
                                    <div class="col-3 p0 text-center">
                                        <img src="<?= PRODUCT_THUMB_PATH ?>/<?= $items['thumb_image_url']; ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-9">
                                        <h2><?= $items['category_name'] . ' - ' . $items['name']; ?></h2>
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
                                                                    <button class="btn btnPM">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <span class="minus"><i class="fas fa-minus"></i></span>
                                                                            <span class="qty"><input type="text" class="form-control" value="0"></span>
                                                                            <span class="plus"><i class="fas fa-plus"></i></span>
                                                                        </div>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($this->cart->has_options($items['rowid']) == TRUE) { ?>
                                                        <div class="col-6 mb15">
                                                            <div class="row no-gutters">
                                                                <div class="col-sm-6">
                                                                    <label>Duration</label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <select name="" id="" class="form-control">
                                                                        <option value="">4 Weeks</option>
                                                                        <option value="">8 Weeks</option>
                                                                        <option value="">12 Weeks</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 mb15">
                                                            <div class="row no-gutters">
                                                                <div class="col-sm-6">
                                                                    <label>St. Date</label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                    <input type="text" id="datepicker" size="30" placeholder="dd-mm-yyyy" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="price col-sm-12 text-right">
                                                <div><sup><i class="fas fa-rupee-sign"></i></sup> <span class="amt"><?= $this->cart->format_number($items['subtotal']); ?></span></div>
                                            </div>
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
                        <input type="text" name="coupon">
                    </div>
                    <div class="col col-sm-6 text-right">
                        <input type="button" class="applyCoupon" value="apply coupon">
                    </div>
                </div>
                <?php
                if ($coupon_details) {
                    $discount_type_text = ($coupon_details['discount_type'] == 'percentage') ? '%' : 'Flat';
                    ?>
                    <div class="subTotal row">
                        <div class="col col-sm-12">
                            <span><?= $coupon_details['code'] . '-' . $coupon_details['discount_amount'] . ' ' . $discount_type_text . '' . $total_discount_amount; ?></span>
                            <span class="removeCoupon" couponcode="<?= $coupon_details['code']; ?>">X</span>

                        </div>
                    </div>
                <?php } ?>
                <div class="subTotal row">
                    <div class="col col-sm-6">
                        <span>SubTotal</span>
                    </div>
                    <div class="col col-sm-6 text-right">
                        <sup><i class="fas fa-rupee-sign"></i></sup> <span class="amt subtotal"><?= $this->cart->format_number($sub_total); ?></span>
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
                        <sup><i class="fas fa-rupee-sign"></i></sup> <span class="amt grandtotal"><?= $this->cart->format_number($grand_total); ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btnContinue">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loginToProceed col-12 d-lg-none">
        <div class="container">
            <div class="row">
                <div class="amt col d-flex align-items-center justify-content-start">
                    <sup><i class="fas fa-rupee-sign"></i></sup> 4,250.00
                </div>
                <div class="col d-flex align-items-center justify-content-end">
                    <button class="btn btnLoginToProceed">Login to Proceed</button>
                </div>
            </div>
        </div>
    </div>
</section>
