<div id="dvDidYouKnow">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Did You Know</h3>
            </div>
            <div class="col-sm-12">
                <div class="owl-carousel owl-theme owl-loaded">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            <?php
                            if ($product_detail['did_you_know']) {
                                $did_you_know_section = json_decode($product_detail['did_you_know'], true);
                                foreach ($did_you_know_section as $row) {
                                    ?>
                                    <div class="owl-item text-center">
                                        <img width="50" class="img-fluid mb15" src="<?= ASSET_URL ?>imgs/didyouknow/<?= $row['img']; ?>" alt="">
                                        <h5 class="mb15"><?= $row['heading']; ?></h5>
                                        <p class="content-grey">
                                            <?= $row['description']; ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>