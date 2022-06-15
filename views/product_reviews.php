<style>
    section.raw-love{ padding:0px 0 70px;}
section.raw-love .center-hold{ max-width:700px;}
ul.raw-lv-sldr{float:left; width:100%; margin:0px; padding:0px 40px; position:relative;}
ul.raw-lv-sldr li{float:left; width:100%; margin:0px; padding:0px; text-align:center;}
ul.raw-lv-sldr li div.item{ display:flex; justify-content:center; align-items:center; flex-flow:column wrap; min-height:442px; /* max-width:600px; */ width:100%; margin:0px; padding:0px; text-align:center;	}
ul.raw-lv-sldr li div.item div{ float:left; width:100%; margin:0px; padding:0px;}
ul.raw-lv-sldr li div div.img-box{ float:none; width:210px; height:150px; background-color:#f5f5f5; display:inline-block; margin:0px 0px 15px 0px; border:0;}
ul.raw-lv-sldr li div.img-box img{ max-width:100%; width:100%; height:100%;}
ul.raw-lv-sldr li div div.stars{ float:left; width:100%; margin:0px 0px 15px 0px; text-align:center;}
ul.raw-lv-sldr div.stars a{ font-size:12px; color:#000; display:inline-block; margin:0px 1px;}
ul.raw-lv-sldr div.stars a.active{ color:#e1c63c;}
ul.raw-lv-sldr div.stars span{ display:inline-block; font-size:12px; margin-left:15px; color:#000;}
ul.raw-lv-sldr h4{float:left; width:100%; margin:0px 0px 15px 0px; padding:0px; font-size:16px; text-transform:uppercase;}
ul.raw-lv-sldr p{float:left; width:100%; margin:0px 0px 15px 0px; font-size:14px; line-height:20px; color:#555555;}
ul.raw-lv-sldr li div.item div.review-cta{ margin-top:20px;}
ul.raw-lv-sldr .review-cta span{ display:inline-block; width:100%;  text-transform:uppercase; color:#000; margin:0px 0px 15px 0px;}
ul.raw-lv-sldr .slick-prev:before, ul.raw-lv-sldr .slick-next:before{ display:none; content:"";}
    </style>
<section class="raw-love" id="reviews">
    <h2 class="bundle-title">Reviews</h2>
    <div class="center-hold">
        <ul class="raw-lv-sldr">
            <?php
            foreach ($reviews as $review) {
                $activeStar = "";
                $inactiveStar = "";
                for ($i = 1; $i <= 5; $i++) {
                    if ($i > $review['review_rating']) {
                        $inactiveStar.='<a ><i class="fa fa-star"></i></a>';
                    } else {
                        $activeStar.='<a  class="active"><i class="fa fa-star"></i></a>';
                    }
                }
                ?>
                <li>
                    <div class="item">
                        <?php if ($review['review_image'] != "") { ?>
                            <div class="img-box"><img src="https://www.rawpressery.com/images/productreview/xallrounder_mom.jpg.pagespeed.ic.vWe61v4cSE.webp" /></div><?php } ?>
                        <div class="data">
                            <div class="stars">
                                <?php echo $activeStar . $inactiveStar; ?>
                            </div>
                        </div>
                        <div class="user-name"><h4><?php echo $review['user_name']; ?></h4></div>
                        <div class="descp">
                            <p><?php echo $review['review_comment']; ?></p>
                        </div>
                        <div class="review-cta">
                            <span>Love it? rate it!</span>
                            <a href="javascript:void(0);" rel="<?= $review['product_id']; ?>" class="write_a_review button wht" data-text="Write a Review"><span>Write a Review</span></a>
                        </div>
                    </div>
                </li>
            <?php } ?>

        </ul>
    </div>
</section>