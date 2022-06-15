<?php
$sectionBanners[1] = $this->config->item('firstSectionBanners');
$sectionBanners[2] = $this->config->item('secondSectionBanners');
$sectionBanners[3] = $this->config->item('thirdSectionBanners');
$sectionBanners[4] = $this->config->item('fourthSectionBanners');
for ($i=1; $i <= count($sectionBanners); $i++) { 
    if(!$sectionBanners[$i][0]){
        $banners[$i][0] = $sectionBanners[$i]; 
    }else{
        $banners[$i] = $sectionBanners[$i]; 
    }
    $banners[$i] = json_encode($banners[$i]);
}
?>
<div id="wrapper">
    <div id="box-1" class="scrollblocks" loaded="true">
        <section class="dvMainSlider">
            <div class="owl-carousel">
                <?php 
                $cnt = 0; 
                foreach (json_decode($banners[1],1) as $row) { 
                    if($cnt == 0) { ?>
                        <a href='<?= $row['btn_url']; ?>'>
                            <div class="item" style="background:url('<?= IMG_BASE_PATH . '' . $row['desktop_image_url']; ?>') no-repeat top left; background-size:cover;">
                                <img src="<?= IMG_BASE_PATH . '' . $row['mobile_image_url']; ?>" class="img-fluid d-md-none" alt="<?php echo $row['sub_title']; ?>">
                            </div>    
                        </a>
                    <?php } else {
                    ?>
                        <div class="item" style="background:url('<?= IMG_BASE_PATH . '' . $row['desktop_image_url']; ?>') no-repeat top left; background-size:cover;">
                        <!-- <div class="item owl-lazy" data-src="<?= IMG_BASE_PATH . '' . $row['desktop_image_url']; ?>"> -->
                            <div class="container relative">
                                <div class="owl-text">
                                    <div>
                                        <h2><?= $row['title']; ?></h1>
                                        <h2><?= $row['title1']; ?></h1>
                                        <h5><?= $row['sub_title']; ?></h5>
                                        <a href="<?= $row['btn_url']; ?>" class="btn btnSecondary"><?= $row['btn_txt']; ?></a>
                                    </div>
                                </div>
                            </div>
                            <img src="<?= IMG_BASE_PATH . '' . $row['mobile_image_url']; ?>" class="img-fluid d-md-none" alt="<?php echo $row['sub_title']; ?>">
                        </div>
                    <?php 
                    }
                    $cnt++; 
                } ?>
            </div>
        </section>
    </div>
    <div id="box-2"  class="" data-loader='<?= $banners[2];?>'></div>
    <div id="box-3"  class="" data-loader='<?= $banners[3];?>'></div>
</div>
