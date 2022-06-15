<?php
foreach ($this->cart->contents() as $row) {
    $cartArr[$row['id']] = $row['rowid'];
}
foreach ($products as $product_row) {
    $thumb_image = PRODUCT_THUMB_PATH . $product_row['thumb_image_url'];
    $product_id = $product_row['product_id'];
    $sku = $product_row['sku'];
    $cartData = $this->cart->in_cart($sku);
    $row_id = $cart_count = 0;
    if ($cartData) {
        $row_id = $cartData['rowid'];
        $cart_count = $cartData['qty'];
    }
    $product_price = ($product_row['special_price'] > 0) ? $product_row['special_price'] : $product_row['base_price'];

    if (isset($product_row['option_txt']) && $product_row['option_txt'] != '') {
        $option_txt_arr = json_decode($product_row['option_txt'], true);
        $cartOptionData = $this->cart->get_item($row_id);
        $option_type_id = $cartOptionData['options']['option_type_id'];
        foreach ($option_txt_arr as $key => $row) {
            if ($row['option_type_id'] == $option_type_id) {
                $product_row['base_price_per_bottle'] = $row['base_price'];
                $product_row['special_price_per_bottle'] = $row['special_price'];
            }
        }
    }
    ?>

    <div class="col-md-6 mb15 col-xl-12" id= 'prod_data_<?= $product_id; ?>' product_id = '<?= $product_id; ?>' product_name='<?= $product_row['product_name']; ?>' product_price = '<?= $product_price ?>' category_id = '<?= $categoryArr['category_id'] ?>' category_name = '<?= $categoryArr['category_name'] ?>'>
        <div class="bg-white height100">
            <a href="<?= site_url('shop/' . $category . '/' . $product_row['product_url']) ?>" title="<?php echo $product_row['product_name']; ?>">
                <div class="image">
                    <img src="<?= $thumb_image; ?>" class="image img-fluid" alt="<?php echo $product_row['product_name']; ?>">
                </div>
                <h4><?= $product_row['product_name'] ?></h4>
            </a>
            <div class="d-flex justify-content-center">
                <div class="deleted">
                    <div class="strikePrice base_price <?php if($option_type_id && $product_row['special_price_per_bottle'] >0){ ?> strike <?php } ?>"><i class="fas fa-rupee-sign"></i><span class="cmr"><?= number_format($product_row['base_price_per_bottle'], 2); ?></span></div>
                </div>
                <div class="price special_price">
                    <i class="fas"></i><span><?php if ($product_row['special_price_per_bottle'] >0) { ?><?= '&nbsp;&nbsp;<i class="fas fa-rupee-sign"></i>'. number_format($product_row['special_price_per_bottle'], 2); ?> <?php } ?></span>
                </div>
            </div>
            <div class="weight"><?= $product_row['varient'] ?></div>
            <?php
            if (isset($product_row['option_txt']) && $product_row['option_txt'] != '') {
                $checked_cls = 'checked';
                ?>
                <div class="selectOptions d-flex flex-wrap justify-content-center">
                    <?php
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
                        $base_price = number_format(intval($row['base_price']), 2);
                        $special_price = number_format(intval($row['special_price']), 2);
                        $value = $product_id . $key;
                        ?>
                        <div class="opt">
                            <input type="radio" data-cleanses="yes" id="control_<?= $value; ?>" name="<?= $product_id; ?>" value="<?= $row['option_type_id'];?>" <?= $checked_cls; ?> data-base_price="<?= $base_price; ?>" data-special_price="<?= $special_price; ?>" <?= $radioChecked; ?> <?= $disabled; ?> option_name ="<?= $row['option_name']; ?>">
                            <label for="control_<?= $value; ?>">
                                <h2><?= $row['option_name'] ?></h2>
                                <p><span><?= "₹".$row['sub_text'] ?></span></p>
                                <p><?= $row['ideal_txt']; ?></p>
                            </label>
                        </div>
                        <?php
                        $checked_cls = '';
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
                        <div>
                            <span class="minus increment" productid="<?= $product_id; ?>" sku= "<?= $sku; ?>" row_id = "<?= $row_id; ?>"><i class="fas fa-minus"></i></span>
                            <span class="qty"><input type="text" class="form-control qty-text" value="<?= $cart_count; ?>"></span>
                            <span class="plus increment" productid="<?= $product_id; ?>" sku= "<?= $sku; ?>" row_id = "<?= $row_id; ?>"><i class="fas fa-plus"></i></span>
                        </div>
                    </button>
                </div>
                <?php
            } else {
                echo '<p class="outofstock">Out of Stock</p>';
            }
            ?>
        </div>
    </div>
<?php } ?>