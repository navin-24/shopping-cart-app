<?php
$firstSectionBanners = $this->config->item('firstSectionBanners');
$secondSectionBanners = $this->config->item('secondSectionBanners');
$thirdSectionBanners = $this->config->item('thirdSectionBanners');
$fourthSectionBanners = $this->config->item('fourthSectionBanners');
?>
<div id="wrapper">
    
    <section class="dvMainSlider">
        <div class="owl-carousel">
            <?php foreach ($firstSectionBanners as $row) { ?>
                <div class="item">
                    <div class="container relative" style="background-image: <?= ASSET_URL . 'imgs/' . $row['desktop_image_url']; ?>">
                        <div class="owl-text">
                            <div>
                                <h1><?= $row['title']; ?></h1>
                                <h5><?= $row['sub_title']; ?></h5>
                                <a href="<?= $row['btn_url']; ?>" class="btn btnTransparent"><?= $row['btn_txt']; ?></a>
                            </div>
                        </div>
                    </div>
                    <img src="<?= ASSET_URL . 'imgs/' . $row['desktop_image_url']; ?>" class="img-fluid d-none d-md-block" alt="">
                    <img src="<?= ASSET_URL . 'imgs/' . $row['mobile_image_url']; ?>" class="img-fluid d-md-none" alt="">
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="dvVideo text-center relative">
        <div class="container">
            <div class="videoText">
                <h1><?= $secondSectionBanners['title']; ?></h1>
                <p>
                    <?= $secondSectionBanners['content']; ?>
                </p>
                <a class="playBtn" href="<?= $secondSectionBanners['youtube_url']; ?>"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <img src="<?= ASSET_URL . 'imgs/youtube-bg-mobile.jpg' ?>" class="img-fluid d-md-none" alt="">
        <img src="<?= ASSET_URL . 'imgs/youtube-bg.jpg' ?>" class="img-fluid d-none d-md-block" alt="">
    </section>

    <section class="cSlider">
        <div class="owl-carousel">
            <?php foreach ($thirdSectionBanners as $row) { ?>
                <div class="item">
                    <div class="container relative">
                        <div class="owl-text">
                            <div>
                                <h1><?= $row['title']; ?></h1>
                                <h4><?= $row['sub_tags']; ?></h4>
                                <h5><?= $row['sub_title']; ?></h5>
                                <a href="<?= $row['btn_url']; ?>" class="btn btnTransparent"><?= $row['btn_txt']; ?></a>
                            </div>
                        </div>
                    </div>
                    <img src="<?= ASSET_URL . 'imgs/' . $row['desktop_image_url']; ?>" class="img-fluid d-none d-md-block" alt="">
                    <img src="<?= ASSET_URL . 'imgs/' . $row['mobile_image_url']; ?>" class="img-fluid d-md-none" alt="">
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="dvSubscriptions text-center relative">
        <div class="container">
            <div class="videoText">
                <h1><?= $fourthSectionBanners[0]['title']; ?></h1>
                <h5><?= $fourthSectionBanners[0]['sub_tags']; ?></h5>
                <p><?= $fourthSectionBanners[0]['sub_title']; ?></p>
                <a href="" class="btn btnTransparent"><?= $fourthSectionBanners[0]['btn_txt']; ?></a>
            </div>
        </div>
        <img src="<?= ASSET_URL . 'imgs/simple-subscriptions-mobile.jpg' ?>" class="img-fluid d-md-none" alt="">
        <img src="<?= ASSET_URL . 'imgs/simple-subscriptions.jpg' ?>" class="img-fluid d-none d-md-block" alt="">
    </section>
    
</div>