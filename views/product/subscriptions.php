<?php
if ($products) {

    foreach ($products as $product_row) {
        //print_r($product_row);
        $thumb_image = PRODUCT_THUMB_PATH . '/' . $product_row['thumb_image_url'];
        $product_price = ($product_row['special_price'] > 0) ? $product_row['special_price'] : $product_row['base_price'];
        $product_id = $product_row['product_id'];
        $sku = $product_row['sku'];
        $categoryArr = unserialize(CATEGORYARR);
        $category = $categoryArr[$product_row['category_id']];
        ?>

        <div class="col-md-6 mb15 col-xl-4" id= 'prod_data_<?= $product_id; ?>' product_id = '<?= $product_id; ?>' product_name='<?= $product_row['product_name']; ?>' product_price = '<?= $product_price ?>' category_id = '<?= $categoryArr['category_id'] ?>' category_name = '<?= $categoryArr['category_name'] ?>'>

            <div class="bg-white height100 d-flex flex-column justify-content-between">
                <div class="d-flex flex-column justify-content-between h-100">
                    <a href="<?= site_url('shop/' . $category . '/' . $product_row['product_url']) ?>" class="d-block" title="<?php echo $product_row['product_name']; ?>">
                        <div class="image">
                            <img src="<?= $thumb_image; ?>" class="image img-fluid" alt="<?php echo $product_row['product_name']; ?>">
                        </div>
                        <h4><?= $product_row['product_name'] ?></h4>
                    </a>

                <div style="height:65px;">
                    <?php
                    if ($category == 'subscriptions') {
                        $arr = explode('x', $product_row['product_name']);
                        $perweekbottle = preg_replace('/[^0-9]/', '', end($arr));
                        //$perweekbottle = $bottle4week / 4;

                        $bottleTxt = (stripos($product_row['product_name'], 'almond') !== FALSE) ? ' Pack' : ' Bottle';
                        echo '<p class="extra-text">' . $perweekbottle . ' Bottles / Week Home Delivered</p>';

                    }
                    ?>
                    <?php
                    if (!isset($product_row['option_txt']) && $product_row['option_txt'] == '') {
                        if ($product_row['special_price'] > 0) {
                            ?>
                            <div class="d-flex justify-content-center">
                                <div class="deleted">
                                    <div class="strikePrice strike"><i class="fas fa-rupee-sign"></i><span><?= number_format($product_row['base_price'], 2) ?></span></div>
                                </div>
                                <div class="price">
                                    <i class="fas fa-rupee-sign"></i><span><?php if ($product_row['special_price'] !== '0') { ?><?= number_format($product_row['special_price'], 2) ?> <?php } ?></span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div>
                                <span class="showPrice">
                                    <i class="fas fa-rupee-sign"></i>
                                    <span><?= number_format($product_row['base_price'], 2) ?></span>
                                </span>
                            </div>
                            <?php
                        }
                    } else {
                        if ($product_row['special_price_per_bottle'] > 0) {
                            ?>
                            <div class="d-flex justify-content-center">
                                <div class="deleted">
                                    <div class="strikePrice strike"><i class="fas fa-rupee-sign"></i><span><?= number_format($product_row['base_price_per_bottle'], 2) . '/ Bottle' ?></span></div>
                                </div>
                                <div class="price">
                                    <i class="fas fa-rupee-sign"></i><span><?php if ($product_row['special_price_per_bottle'] !== '0') { ?><?= number_format($product_row['special_price_per_bottle'], 2) . '/ Bottle' ?> <?php } ?></span>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                </div>
                <div>


                    <!--
                    <p class="off">Get 33% off</p>-->

                    <div class="weight"><?= $product_row['varient'] ?></div>

                    <?php
                    $cartData = $this->cart->in_cart($sku);
                    $row_id = $cart_count = 0;
                    if ($cartData) {
                        $row_id = $cartData['rowid'];
                        $cart_count = $cartData['qty'];
                    }


                    if (isset($product_row['option_txt']) && $product_row['option_txt'] != '') {
                        $option_txt_arr = json_decode($product_row['option_txt'], true);
                        $checked_cls = 'checked';
                        $cartOptionData = $this->cart->get_item($row_id);
                        $option_type_id = $cartOptionData['options']['option_type_id'];
                        ?>

                        <div class="select3Options d-flex flex-sm-wrap justify-content-center">
                            <?php
                            $i = 1;
                            foreach ($option_txt_arr as $key => $row) {
                                
                                $radioChecked = '';
                                $disabled = ($cart_count) ? 'disabled' : '';
                                if ($option_type_id == NULL && $key == 0) {
                                    $radioChecked = 'checked';
                                }
                                if ($row['option_type_id'] == $option_type_id) {
                                    $radioChecked = 'checked';
                                    $disabled = '';
                                }

                                $value = $product_id . $key;
                                ?>
                                <div class="opt">
                                    <input type="radio" id="control_<?= $value; ?>" name="<?= $product_id; ?>" value="<?= $row['option_type_id']; ?>" <?= $radioChecked; ?> option_name = '<?= $row['option_name'] ?>' <?= $disabled; ?>>
                                    <label for="control_<?= $value; ?>">
                                        <h2><?= $row['option_name'] ?></h2>
                                        <?php if ($product_row['sku'] == '1130161') {
                                            echo "<p>+$i Weeks Free</p>";
                                        } ?>
                                        <?php $product_price = ($row['special_price'] > 0) ? $row['special_price'] : $row['base_price']; ?>
                                        <p><i class="fas fa-rupee-sign"></i><span><?= number_format($product_price, 2); ?></span></p>
                                    </label>
                                </div>
                                <?php
                                $i++;
                                unset($product_price);
                            }
                            unset($option_type_id);
                            ?>
                        </div>
                        <?php
                    }

                    $btndisplay = ($cart_count > 0) ? 'block' : 'none';
                    $addtocartdisplay = ($cart_count > 0) ? 'none' : 'block';
                    if ($product_row['is_in_stock']) {
                        ?>
                        <div class="buttons" id="product_add_cart_<?= $product_id; ?>">
                            <button class="btn btnAdd add_to_cart_btn" style="display:<?= $addtocartdisplay; ?>" id="<?= $product_id; ?>">Add to Cart</button>
                            <button class="btn btnPlusMinus" style="display:<?= $btndisplay; ?>">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="minus increment" productid="<?= $product_id; ?>" sku= "<?= $sku; ?>" row_id = "<?= $row_id; ?>"><i class="fas fa-minus"></i></span>
                                    <span class="qty"><input type="text" class="form-control qty-text" value="<?= $cart_count; ?>" readonly="readonly"></span>
                                    <span class="plus increment" productid="<?= $product_id; ?>" sku="<?= $sku; ?>" row_id = "<?= $row_id; ?>"><i class="fas fa-plus"></i></span>
                                </div>
                            </button>
                        </div>
                        <?php
                    } else {
                        echo '<p class="btn btnOutofstock">Out of Stock</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
$webengageArr = array(
    "Category Name" => $categoryArr['category_name'],
    "Category Id" => $categoryArr['category_id'],
    "Item Count" => count($products),
);
?>

<script>
    webengage.track("Category Viewed", <?= json_encode($webengageArr); ?>);
</script>