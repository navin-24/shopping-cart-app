<style>
    .dvHeader{background:#000;}
</style>
<?php
$product_image = $product_detail['thumb_image_url'];
$product_id = $product_detail['product_id'];
$sku = $product_detail['sku'];

$option_txt = json_decode($product_option['option_txt'], true);
$product_quantity = ($product_detail['quantity'] != 0) ? $product_detail['quantity'] . 'x' : '';

/* code to get cart products */
$cartData = $this->cart->in_cart($sku);
if ($cartData) {
    $row_id = $cartData['rowid'];
    $cart_count = $cartData['qty'];
}


$category_name = strtolower($product_detail['category_name']);
$category_name = (str_word_count($category_name) >= 2) ? (preg_replace("/\s+/", "-", $category_name)) : $category_name;

$product_price = ($product_detail['special_price'] > 0) ? $product_detail['special_price'] : $product_detail['base_price'];
?>
<section class="dvProductDetail">
    <div class="container d-none d-lg-block">
        <div class="row">
            <div class="col-sm-12 detailbreadcrumb" style="padding:0;">
                <div style="position: absolute; z-index: 1; top: 84px;">
                    <?= generateBreadcrumb($product_detail['product_name']); ?>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid" itemtype="http://schema.org/Product" itemscope>
        <div class="row">

            <div class="col-md-6 col-xl-6 d-md-none" style="padding:0;line-height:0;display:none;">
                <img src="<?= PRODUCT_BASE_PATH . $category_name . '/m/' . $product_detail['mobile_image_url']; ?>" class="img-fluid">
                <!-- <img itemprop="image" src="<?= PRODUCT_BASE_PATH . $product_detail['mobile_image_url']; ?>" class="img-fluid d-md-none" alt="<?php echo $page_meta['alt_attr']; ?>">
                <img itemprop="image" src="<?= PRODUCT_BASE_PATH . $product_detail['desktop_image_url']; ?>" class="img-fluid d-none d-md-block" alt="<?php echo $page_meta['alt_attr']; ?>"> -->
            </div>

            <!-- this below code is for is 6 b 6 column -->
            <!-- <div class="img col-md-6 col-xl-6 d-flex"> -->
                <!-- <img src="<?= ASSET_URL . 'imgs/product-detail/desktop-4.png' ?>" class="img-fluid m-auto" alt=""> -->
                <!-- <img itemprop="image" src="<?= PRODUCT_BASE_PATH . $product_detail['mobile_image_url']; ?>" class="img-fluid d-md-none" alt="<?php echo $page_meta['alt_attr']; ?>">-->
                <!-- <img itemprop="image" src="<?= PRODUCT_BASE_PATH . $product_detail['desktop_image_url']; ?>" class="img-fluid d-none d-md-block" alt="<?php echo $page_meta['alt_attr']; ?>">  -->
            <!-- </div> -->

            <!-- copy this below code if you want 6 by 6 column -->
            <!--<div class="description col-md-6 col-xl-6">  -->
            <div class="col-md-12" style---="background: url('<?= PRODUCT_BASE_PATH . $category_name . '/d/' . $product_detail['desktop_image_url']; ?>') no-repeat center left; background-size:cover;">
                <div class="description row">
                    <div class="img col-lg-6 d-flex" style="background: url('<?= PRODUCT_BASE_PATH . $category_name . '/d/' . $product_detail['desktop_image_url']; ?>') no-repeat center center; background-size:cover;">

<!-- <img src="<?= ASSET_URL . 'imgs/product-detail/desktop-4.png' ?>" class="img-fluid d-lg-none" alt=""> -->
<!--   <img src="<?= ASSET_URL . 'imgs/product-detail/desktop-4.png' ?>" class="img-fluid d-none d-lg-block m-lg-auto" alt="">  -->
 <!-- <img itemprop="image" src="<?= PRODUCT_BASE_PATH . $product_detail['mobile_image_url']; ?>" class="img-fluid d-md-none" alt="<?php echo $page_meta['alt_attr']; ?>">
<img itemprop="image" src="<?= PRODUCT_BASE_PATH . $product_detail['desktop_image_url']; ?>" class="img-fluid d-none d-md-block" alt="<?php echo $page_meta['alt_attr']; ?>">  -->
                    </div>
                    <div class="col-lg-6 padd">
                        <div class="row about">
                            <div class="col-md-12">
                                <div>
                                    <h1 itemprop="name"><?= $product_detail['product_name']; ?></h1>
                                    <span class="ratings d-block">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            $cls = ($i <= $product_detail['average_rating']) ? 'fas' : 'far';
                                            echo ' <a href=""><i class="' . $cls . ' fa-star"></i></a>';
                                        }
                                        ?>
                                    </span>
                                </div>

                                <?php if ($product_items) { ?>
                                    <div class="list">
                                        <?php foreach ($product_items as $product_key => $product_val) { ?>
                                            <span><?= trim($product_val['product_name']); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <p itemprop="description"><?= $product_detail['product_short_desc']; ?></p>
                            </div>
                        </div>

                        <div class="row details text-center">
                            <div class="col-sm-12">
                                <div class="row icons justify-content-center justify-content-lg-start">
                                    <?php
                                    if ($product_detail['product_detail_desc'] !== NULL && $product_detail['product_detail_desc'] !== '') {


                                        $product_attribute = json_decode($product_detail['product_detail_desc'], true);
                                        $product_attribute_sliced = array_slice($product_attribute, 0, 3);
                                        foreach ($product_attribute_sliced as $pro_attr) {
                                            ?>
                                            <div class="col-3 col-xl-2">
                                                <img class="img-fluid" src="<?= ASSET_URL . 'imgs/icons/' . $pro_attr['img']; ?>" alt="">
                                                <p><?= strtolower($pro_attr['heading']); ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (strtolower($product_detail['category_name']) !== PRODUCT_CATEGORY_SUBSCRIPTIONS) {
                            if ($product_detail['varient'] != null) {
                                ?>
                                <div class="row size">
                                    <div class="col-sm-12">
                                        <p>Size: <span>
                                                <?php
                                                if ($product_detail['quantity'] > 0) {
                                                    echo $product_detail['varient'] . ' x ' . $product_detail['quantity'];
                                                } else {
                                                    echo $product_detail['varient'];
                                                }
                                                ?>
                                            </span></p>
                                    </div>
                                </div>
                                <?php
                            }
                        }

                        if ($product_option['option_txt'] != null) {
                            $cartData = $this->cart->get_item($row_id);
                            $option_type_id = $cartData['options']['option_type_id'];
                            if (strtolower($product_detail['category_name']) == PRODUCT_CATEGORY_CLEANSES) {
                                ?><div class="row selectOptions">
                                    <div class="col-lg-12">
                                        <div class="optionBox d-flex flex-wrap justify-content-center justify-content-md-start">
                                            <?php
                                            foreach (json_decode($product_option['option_txt'], true) as $k => $v) {
                                                $checked = '';
                                                $disabled = ($cart_count) ? 'disabled' : '';
                                                if ($option_type_id == NULL && $k == 0) {
                                                    $checked = 'checked';
                                                }
                                                //print_r($v);
                                                if ($v['option_type_id'] == $option_type_id) {
                                                    $checked = 'checked';
                                                    $special_price = $v['special_price'];
                                                    $base_price = $v['base_price'];
                                                    $disabled = '';
                                                }
                                                $value = $product_id . $k;
                                                ?>
                                                <div class="opt" id="buy_option">
                                                    <input type="radio" data-cleanses="yes" id="control_<?= $value; ?>" name="<?= $product_id; ?>" value="<?= $v['option_type_id']; ?>" option_value="<?= $v['option_type_id']; ?>" data-base_price="<?= number_format($v['base_price'], 2); ?>" data-special_price="<?= number_format($v['special_price'], 2); ?>" <?= $checked; ?> <?= $disabled; ?> option_name ="<?= $v['option_name']; ?>">
                                                    <label for="control_<?= $value; ?>">
                                                        <h2><?= strtoupper($v['option_name']); ?></h2>
                                                        <p><span><?= "₹".$v['sub_text']; ?></span></p>
                                                        <p><?= $v['ideal_txt']; ?></p>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div> <?php
                            } elseif (strtolower($product_detail['category_name']) == PRODUCT_CATEGORY_SUBSCRIPTIONS) {
                                //$this->load->view('product_detail/subscription', $optionViewData);
                                ?>
                                <div class="row noofdays">
                                    <div class="days col-lg-9 col-xl-10">
                                        <div class="selectOptions d-flex flex-wrap justify-content-center justify-content-lg-start" >
                                            <?php
                                            foreach (json_decode($product_option['option_txt'], true) as $k => $v) {
                                                $checked = '';
                                                $disabled = ($cart_count) ? 'disabled' : '';
                                                if ($option_type_id == NULL && $k == 0) {
                                                    $checked = 'checked';
                                                }

                                                if ($v['option_type_id'] == $option_type_id) {
                                                    $checked = 'checked';
                                                    $special_price = $v['special_price'];
                                                    $base_price = $v['base_price'];
                                                    $disabled = '';
                                                }
                                                $value = $product_id . $k;
                                                ?>
                                                <div class="opt">
                                                    <input type="radio" data-cleanses="no" id="control_<?= $value; ?>" name="<?= $product_id; ?>" value="<?= $v['option_type_id']; ?>" data-base_price="<?= number_format($v['base_price'], 2); ?>" data-special_price="<?= number_format($v['special_price'], 2); ?>" <?= $checked; ?> <?= $disabled; ?> option_name = '<?= $v['option_name'] ?>'>
                                                    <label for="control_<?= $value; ?>">
                                                        <p><span><?= $v['option_name']; ?></span></p>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        if ($base_price == 0 || $base_price == NULL) {
                            $base_price = $product_detail['base_price'];
                        }

                        if ($special_price == 0 || $special_price == NULL) {
                            $special_price = (intval($product_detail['special_price']) > 0) ? intval($product_detail['special_price']) : 0;
                        }

                        $strikeCls = ($special_price && $special_price !== NULL) ? 'strike' : '';

                        $btndisplay = ($cart_count > 0) ? 'block' : 'none';
                        $addtocartdisplay = ($cart_count > 0) ? 'none' : 'block';
                        ?>

                        <?php
                        if ($product_detail['is_in_stock']) {

                            $cityIdArr = array();
                            if ($cityResult) {
                                $cityIdArr = explode(',', $cityResult['city_ids']);
                            }
                            if ($city_id && !in_array($city_id, $cityIdArr)) {
                                ?>
                                <div class="row">
                                    <div class="col-sm-12 text-center text-lg-left">
                                        <p class="outofstock">Currently not deliverable</p>
                                    </div>
                                </div>
                            <?php
                            } else {
                                ?>
                                <div class="row prices" itemprop="availability" content="https://schema.org/InStock">
                                    <div class="d-flex justify-content-center justify-content-lg-start" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <div class="deleted">
                                            <div class="strikePrice base_price <?= $strikeCls; ?>"><i class="fas fa-rupee-sign"></i><span><?= number_format($base_price, 2); ?></span></div>
                                        </div>
                                        <div class="price special_price" itemprop="price">

                                            <span><?php
                                                if ($special_price > 0) {
                                                    echo '<i class="fas fa-rupee-sign"></i>';
                                                    echo number_format(trim($special_price), 2);
                                                }
                                                ?></span>
                                        </div>
                                    </div>
                                    <div class="buttons" id="product_add_cart_<?= $product_id; ?>">
                                        <button class="btn btnAdd add_to_cart_btn" style="display:<?= $addtocartdisplay; ?>" id="<?= $product_id; ?>">Add to Cart</button>
                                        <button class="btn btnPlusMinus" style="display:<?= $btndisplay; ?>">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <span class="minus increment" productid="<?= $product_id; ?>" sku= "<?= $sku; ?>" row_id = "<?= $row_id; ?>"><i class="fas fa-minus"></i></span>
                                                <span class="qty"><input type="text" class="form-control qty-text" value="<?= $cart_count; ?>" readonly="readonly"></span>
                                                <span class="plus increment" productid="<?= $product_id; ?>" sku= "<?= $sku; ?>" row_id = "<?= $row_id; ?>"><i class="fas fa-plus"></i></span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-sm-12 text-center text-lg-left">
                                    <p class="outofstock">Out of Stock</p>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dvScrollspy">
    <div class="container-fluid">
        <div id="dvNav" class="row sticky">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <nav>
                            <ul class="d-flex justify-content-between justify-content-lg-center flex-nowrap">
                                <li class="active"><a class="scroll" href="#dvDidYouKnow" title="Did You Know?">Did You Know?</a></li>
                                <?php if ($product_detail['nutrition_facts'] !== null) { ?>
                                    <li><a class="scroll" href="#dvTable" title="ingredients">Ingredients</a></li>
                                <?php } else {
                                    ?>
                                    <li><a class="scroll" href="#dvTab" title="Product Details">Product Details</a></li>

                                <?php } ?>
                                <?php
                                if (strtolower($product_detail['category_name']) == PRODUCT_CATEGORY_CLEANSES) {
                                    ?>
                                    <li>
                                        <a class="scroll" href="#dvCleansesGuide" title="Cleanses Guide">Cleanses Guide</a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li><a class="scroll" href="#dvFaqs" title="FAQ'S">Faq's <span class="d-sm-none"><br><br></span></a></li>
                                <li><a class="scroll" href="#dvReviews" title="Reviews">Reviews<span class="d-sm-none"><br><br></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $this->load->view('product_detail/did_you_know');

        $viewname = ($product_detail['nutrition_facts'] == null) ? 'product-slider.php' : 'nutrition-detail.php';
        $this->load->view('product_detail/' . $viewname);

        if (strtolower($product_detail['category_name']) == PRODUCT_CATEGORY_CLEANSES) {
            $this->load->view('product_detail/cleanse_guide');
        }

        $this->load->view('product_detail/faq');
        $this->load->view('product_detail/review');
        $this->load->view('product_detail/blog');
        ?>
    </div>
</section>

<script>
    webengage.track("Product Viewed", {
        "Product Id": "<?php echo $product_detail['product_id']; ?>",
        "Product Name": "<?php echo $product_detail['product_name']; ?>",
        "Category Name": "<?php echo $product_detail['category_name']; ?>",
        "Category Id": "<?php echo $product_detail['category_id']; ?>",
        "Price": <?= str_replace(",", "", number_format($product_price)); ?>,
        "Currency":'INR',
        "Product Image": "<?php echo $product_image; ?>"
    });

    fbq('track', 'ViewContent', {
        content_type: 'product',
        content_ids: ['<?= $product_detail['product_id']; ?>'],
        content_name: '<?= $product_detail['product_name']; ?>',
        content_category: '<?= $product_detail['category_name']; ?>',
        value: <?= $product_price; ?>,
        currency: 'INR'
    });
</script>
