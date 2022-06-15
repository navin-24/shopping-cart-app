<?php
foreach ($order_item_details as $item) {
    $product_id = $item['product_id'];
    $productNameStr.=$item['product_name'] . ",";
    $productIdStr.=$product_id . ",";
    $categoryNameStr.=$item['category_name'] . ",";
    $categoryIdStr.=$item['category_id'] . ",";
    $qtyStr.=$item['qty_ordered'] . ",";
    $priceStr.= str_replace(",", "", $this->cart->format_number($item['item_price'])) . ",";
}

$postData=array();
$base_data['id'] = $order_details['order_id'];
$base_data['affiliation'] = 'Online Website';
$base_data['revenue'] = strval(round($order_details['grand_total'],2));
$base_data['tax'] = strval(round($order_details['tax_amount'],2));
$base_data['shipping'] = '0';
$base_data['coupon'] = ($order_details['coupon_code'])?$order_details['coupon_code']:'';

$i=0;
foreach ($order_item_details as $item) {
    $line_data['name'] = $item['product_name'];
    $line_data['id'] = $item['product_id'];
    $line_data['price'] = strval(round($item['item_price'],2));
    $line_data['brand'] = 'Raw Pressery';
    $line_data['category'] = $item['category_name'];
    $line_data['variant'] = $item['varient'];
    $line_data['quantity'] = $item['qty_ordered'];
    $data['line_data'][$i] = $line_data;
    $i++;
}
$postData['purchase']['actionField'] = $base_data;
$postData['purchase']['products'] = $data['line_data'];
?>
<section class="dvThankYou">
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <?php if(strtolower($payment_status) == 'success'){ ?>
                <img width="50" src="<?= ASSET_URL . 'imgs/check.png' ?>" alt="">
            <?php } ?>
            <h3>Your Payment is <span><?= trim($payment_status);?></span>.</h3></br>
            <?php if(strtolower($payment_status) == 'success'){ ?>
                <h3>Thank you for your order <span><?= trim($order_details['fullname']);?></span>.</h3>
                <p class="orderno">Your Order number is <span><?= $order_details['order_id'];?></span></p>
                <p class="delivery">Your Order will be delivered on <span><b><?= date('jS F, Y',strtotime($order_details['delivery_date']));?></b></span>.</p>
            <?php }else{ ?>
                <h3>Please Check Your Email for further Update in Order Status.</h3>
            <?php }?>
            <p class="text">In case of any issues, you can call/whatsapp us on <a href="tel:91 8657-303-303">8657303303</a> or email <a href="mailto:getmore@rawpressery.com" target="_blank">getmore@rawpressery.com</a></p>
            <!--<p>OR</p>-->
            <a href="<?= base_url('shop/juices'); ?>" class="btn btnSecondary">Shop Again</a>
        </div>
    </div>
</div>
</section>
<script>
    fbq('track', 'Purchase', {
        value: <?= $order_details['grand_total']; ?>,
        currency: 'INR'
    });

    webengage.track("Order Placed", {
        "Product Id": "<?php echo rtrim($productIdStr, ","); ?>",
        "Product Name": "<?php echo rtrim($productNameStr, ","); ?>",
        "Price": "<?php echo rtrim($priceStr, ","); ?>",
        "Category Id": "<?php echo rtrim($categoryIdStr, ","); ?>",
        "Category Name": "<?php echo rtrim($categoryNameStr, ","); ?>",
        "Quantity": "<?php echo rtrim($qtyStr, ","); ?>",
        "Estimated Delivery Day": "<?php echo $order_details['delivery_date']; ?>",
        "Amount": <?= $order_details['grand_total']; ?>,
        "Payment Method": "<?= $order_details['payment_method']; ?>",
        "Status": "Success",
    });
    var ecommerce = <?php echo json_encode($postData); ?>;
    dataLayer.push({ecommerce});
</script>