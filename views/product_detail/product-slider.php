<div id="dvTab" class="row">
    <div class="col-sm-12">
        <h3>Product Details</h3>
    </div>
    <?php
    if ($product_items) {
        $cls = (strtolower($product_detail['category_name']) == 'cleanses') ? 'w15' : '';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="tabs d-flex flex-wrap justify-content-center">
                        <?php
                        foreach ($product_items as $product_key => $product_val) {
                            $product_key = ($product_key == 0) ? 'defaultOpen' : 'tablinks';
                            ?>
                            <li id="<?= $product_key; ?>" class="tablinks <?=$cls;?>" onclick="myTabs(event, '<?= trim(strtoupper($product_val["product_name"])); ?>')">
                            <?= $product_val['product_name']; ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                    foreach ($product_items as $product_data) {
                        $did_you_know = json_decode($product_data['did_you_know'], true);
                        //$ingredients = json_decode($product_data['ingredient'], true);
                        $ingredients = implode(', ', array_keys(json_decode($product_data['ingredient'],true)));
                        $product_id = $product_data['product_id'];
                        ?>
                        <div id="<?= trim(strtoupper($product_data['product_name'])); ?>" class="tabcontent">
                            <div class="row padd">
                                <div class="col-md-4 col-lg-2 order-0 order-md-1">
                                    <img class="img img-fluid" src="<?= PRODUCT_PACKSHOT_PATH . $product_data['pack_shot_img']; ?>" alt="">
                                </div>
                                <div class="col-md-4 col-lg-5 order-1 order-md-0 d-flex">
                                    <div class="m-xl-auto">
                                        <div class="row">
                                            <?php
                                            foreach ($did_you_know as $xinfo_key => $xinfo) {
                                            ?>
                                                <div class="col-6 col-md-12 col-lg-6">
                                                    <img width="50" class="icon img-fluid" src="<?= ASSET_URL ?>imgs/didyouknow/<?= $xinfo['img']; ?>" alt="<?php echo $xinfo['heading']; ?>"><!-- put img-->
                                                    <h5><?= $xinfo['heading']; ?></h5>
                                                    <p><?= $xinfo['description']; ?></p>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button class="btn btnPrimary nutrition" data-modal="<?= 'nutritionModal_' . $product_id; ?>" >Nutrition Values</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-5 order-2 order-md-2">
                                    <div class="smallImages d-flex align-items-center flex-wrap justify-content-center justify-content-xl-start h-100">
                                        <?php
                                        /*foreach ($ingredients as $ing_name => $ing_thumb) {
                                            ?>
                                            <div class="col-4 col-md-6 col-xl-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/ingredients/<?= $ing_thumb; ?>" class="icon img-fluid" alt="<?php echo $ing_name; ?>">
                                                <h6><?= $ing_name; ?> </h6>
                                            </div>
                                            <?php
                                        }*/
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Ingredients</h3>
                                            </div>
                                            <div class="col-md-12 responsive">
                                                <table style="margin-top: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th width="50%" class="text-left" style="background:var(--primary-color);">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left">
                                                                <p>
                                                                    <?php echo ($ingredients)?$ingredients:'Content coming soon'; ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="<?= 'nutritionModal_' . $product_id; ?>" class="dvModal modal nutritionModal">
                            <div class="modal-content modal-sm">
                                <div class="search">
                                    <div class="close">X</div>
                                    <!-- <i class="fas fa-times-circle btn close"></i> -->
                                    <?php
                                    $viewData['nutrition_facts'] = $product_data['nutrition_facts'];
                                    $this->load->view('product_detail/nutirition_chart', $viewData);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
<?php } ?>
</div>
<script src="<?php echo ASSET_URL . 'js/product-detail.js'; ?>"></script>