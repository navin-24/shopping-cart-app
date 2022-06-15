
<style>
    
    
    a.close,a.btn-close{width:24px;height:24px;text-align:center;position:absolute;right:-12px;top:-12px;line-height:60px;overflow:hidden;background:url(https://www.rawpressery.com/skin/frontend/rawpressery/default/images/close-btn.svg) no-repeat;background-size:100%;background-position:center;text-decoration:none;color:transparent !important;opacity:1 !important;}

a.btn-close:hover{color:transparent; opacity:1;} 
    /*------------------------------------------------*/
/*------------------------------------------------*/
div.popup, div.video-popup{display:inline-block;width:520px;padding:30px;position:relative;/*position:absolute;left:50%;transform:translateX(-50%);*/z-index:9999;background:#fff;border:0px; text-align:center;}
div.video-popup{ width:100%; height:100%; padding:0;}
div.video-popup a.btn-close{ width:32px; height:32px; border-radius:100%; border:1px solid #fff; right:10px; top:90px;}
div.video-popup iframe{ width:100%; height:100%;}
div.popup.review{ padding:30px 50px;}
div.popup p{font-size:14px;color:#404041;font-weight:normal;line-height:24px;}
div.popup h4{ display:inline-block; width:100%; font-family: 'WorkSansSemiBold'; color:#000; letter-spacing:1px; font-size:18px; line-height:22px; text-transform:uppercase; margin-bottom:30px;}
div.popup h5{ display:inline-block; width:100%; font-family: 'WorkSansSemiBold'; color:#000; letter-spacing:1px; font-size:14px; line-height:20px; text-transform:uppercase; margin-bottom:15px;}
div.popup h6{ display:inline-block; width:100%; font-family: 'WorkSansSemiBold'; color:#000; letter-spacing:1px; font-size:14px; line-height:20px; text-transform:uppercase; margin-bottom:15px;}
div.popup p{ display:inline-block; width:100%; color:#555555; letter-spacing:1px; font-size:15px; line-height:21px; margin-bottom:20px;}
div.popup .Search{ display:inline-block; width:100%; padding:15px; color:#555555;  border:1px solid #000;}
div.popup textarea{ display:inline-block; width:100%; height:80px; padding:10px;color:#000; border:1px solid #d9d9d9; resize:none; font-size:14px;}
div.popup div.stores{ display:flex; flex-flow:row wrap; justify-content:space-evenly; align-items:center; margin-top:30px; padding-top:30px; border-top:1px solid #dcdcdc;}
div.popup div.ratings{ float:left; width:100%; padding:0; margin:-10px 0px 15px;}
div.popup div.file-box{ display:flex; justify-content:space-between; align-items:center; float:left; width:100%; margin:20px 0 0; padding:0;} 
div.popup div.file-box span{ float:left; color:#000; width:70%; text-align:left; font-size:14px; text-transform:uppercase;}
div.popup div.file-box span label{ font-size:14px; text-transform:uppercase; font-weight:normal; font-family: 'WorkSansSemiBold';}
div.popup div.file-box span label small{ font-size:100%; font-weight:normal; font-family: 'WorkSansRegular'; text-transform:none;}
div.popup div.file-box span span{ color:#555; text-transform:none;} 
div.popup div.file-box .upload{ float:right; position:relative; cursor:pointer;}
div.popup div.file-box .prop-pic{ width:110px; opacity:0; cursor:pointer; height:45px; line-height:40px;}
div.popup div.file-box .upload:after{content: "UPLOAD"; position: absolute; right: 0px; top: 0px; width: 110px;height: 45px;line-height: 45px; display: block;text-transform: capitalize;font-weight: bold; letter-spacing:1px; color: #000;text-align: center; pointer-events: none;font-size: 12px; border:1px solid #000;}
div.popup div.form-field{ float:left; width:100%; padding:0; margin:0; position:relative}
div.popup div.form-field .text{ width:100%; padding:10px 30px 10px 60px; background:#f6f6f6; border:0;}
div.popup .country-code{ position:absolute; top:15px; left:15px; color:#000;}
div.popup div.form-field.location{  margin:0 0 20px 0;}
div.popup div.form-field.location input{ background-image:url(https://www.rawpressery.com/skin/frontend/rawpressery/default/images/ico-location.png);background-repeat:no-repeat; background-position:15px center;background-size:25px;}
div.popup div.form-field.location:after{ content:""; position:absolute; top:12px; right:10px; height:23px; width:23px; background-image:url(https://www.rawpressery.com/skin/frontend/rawpressery/default/images/ico-gps.png); background-repeat:no-repeat; background-size:100%; }
div.popup div.tag-location{ float:left; width:100%; padding:0; margin:0px 0px 15px 0px; text-align:left;}
div.popup div.tag-location h4{ font-size:14px; line-height:20px; margin-bottom:15px; }
div.popup div.tag-location .text{ background:none; border:0; border-bottom:1px solid #d9d9d9; padding:10px 10px 10px 0; margin-bottom:10px;}
/* div.popup div.tag-location .button{ display:inline-block; width:auto; border:1px solid #999; color:#999; background:#fff;} */
/* div.popup div.tag-location .button.active{ font-weight:600; color:#000; border:1px solid #000;} */
div.tag-location .button.active{ border:1px solid #000; background:#000; color:#fff;}

div.popup div.view-cart-sbcrptn{ width:950px;}
div.popup div.view-cart-sbcrptn ul{ display:flex; align-items:flex-start; justify-content:center; flex-flow:row wrap; width:100%; padding:0; margin:0;}
div.popup div.view-cart-sbcrptn ul li{ float:left; width:33.3333%; padding:0 15px;}
div.popup div.view-cart-sbcrptn ul li h3{ display:inline-block; width:100%;  font-weight:600; color:#555555; font-size:14px; text-transform:uppercase; margin:10px 0; }
div.popup div.view-cart-sbcrptn ul li p{ line-height:24px;}

div.popup div.prod-filter-popup{ width:950px;}
div.popup div.prod-filter-popup ul{ float:left; width:100%; padding:0; margin:10px 0 15px;}
div.popup div.prod-filter-popup ul li{ display:inline-block; padding-right:25px;}
div.popup div.prod-filter-popup ul li.full{ width:100%; padding:0 0 0 30px;}
div.popup div.prod-filter-popup ul li p{ float:left; width:100%; text-align:left; color:#000;  font-weight:600; font-size:14px; line-height:18px; letter-spacing:0;}
div.popup div.prod-filter-popup ul li:focus{ color:#000; font-weight:bold;}

div.popup div.filter-inside{ float:left; width:100%; padding:0 0 15px; margin:0 0 30px; border-bottom:1px solid #ccc;}
div.popup div.filter-inside.last{ border:0; padding:0; margin:0;}

div.popup .label {display: block;position: relative;padding-right: 40px;margin-bottom: 12px;cursor: pointer;font-size: 14px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none; color:#555555;  text-align:left;}
div.popup .label small{ color:#555555; font-size:14px;}
div.popup .label input {position: absolute; opacity: 0;cursor: pointer;height: 0;width: 0;}
div.popup .checkmark {position: absolute;top: -3px;right: 0;height: 25px;width: 25px;background-color: transparent; border:1px solid #ccc;}
div.popup .label:hover input ~ .checkmark { background-color: #ccc;}
div.popup .label input:checked ~ .checkmark {background-color: #000;}
div.popup .checkmark:after { content: "";position: absolute;display: none;}
div.popup .label input:checked ~ .checkmark:after {display: block;}
div.popup .label input:checked ~ small{ color:#000; font-weight:bold;}
div.popup .label .checkmark:after {left: 7px;top: 1px;width: 10px;height: 16px;border: solid white;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);  -ms-transform: rotate(45deg); transform: rotate(45deg);}
div.popup div.cta{ float:left; width:100%; margin:20px 0 0; display:flex; justify-content:center;}
div.popup .button{ width:auto; display:inline-block; padding: 12px 25px; background:transparent; color:#000; border:1px solid #000; border-radius:0; -webkit-border-radius:0 ;font-size:13px; font-family:'WorkSansRegular'; text-transform:uppercase; text-align:center; outline:none; letter-spacing:0.9px; background:#fff; margin:0;}
div.popup .button:hover{ background:#000; color:#fff;}

div.popup.review .button{margin-right:10px;}
div.popup.cart-remove-item-confirm .button{ margin-right:10px;}
div.popup img{ width:100%;}

#messages {position: fixed;width: 100%;max-width: 420px;background: #FFF;padding: 25px;text-align: center;z-index: 999;height: auto;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);-webkit-box-shadow: 0px 0px 23px 5px rgba(0, 0, 0, 0.25);box-shadow: 0px 0px 23px 5px rgba(0, 0, 0, 0.25);font-family: 'WorkSansRegular'; color:#666; font-size:16px; line-height:22px;}
.msgclose {width:24px;height:24px;text-align:center;position:absolute;right:-12px;top:-12px;line-height:32px;background:url(https://www.rawpressery.com/skin/frontend/rawpressery/default/images/close-btn.svg) no-repeat;background-size:100%;background-position:center;text-decoration:none;color:transparent !important;}
#messages span{ font-size:14px; line-height:18px;}
.error-msg, .success-msg, .note-msg, .notice-msg {padding: 50px;}

div.popup.cart-remove-item-confirm{max-width:400px;}
div.popup.cart-remove-item-confirm p{ margin-bottom:25px;}
.confirm-yes, .confirm-no{ min-width:100px;}
 /*HOME VIDEO BANNER ------------------------------------------------*/
section.video-box .inner-bannercontent-centerleft{ width:600px; left:50%; top:50%; transform:translate(-50%,-50%); -webkit-transform:translate(-50%,-50%); text-align:center; position:absolute; justify-content:center;}
/* section.video-box .inner-bannercontent-centerleft div.data{ width:100%; max-width:100%;} */
.inner-bannercontent-centerleft div.data span.offer-top{color:#fff;padding:0 35px;position:relative;margin-bottom:20px;}
.inner-bannercontent-centerleft div.data span.offer-top:before, .inner-bannercontent-centerleft div.data span.offer-top:after{content:""; width:20px; height:2px; position:absolute; top:50%; margin-top:-1px; background:#fff;}
.inner-bannercontent-centerleft div.data span.offer-top:before{ left:0;}
.inner-bannercontent-centerleft div.data span.offer-top:after{ right:0;}

section.video-box div.overlay{background:rgba(0,0,0,0.6)}
section.video-box {height:100vh; background-image:url(https://www.rawpressery.com/skin/images/video/video-banner.jpg); background-repeat:no-repeat; background-position:center; background-size:cover;}
section.video-box .desk-img{ display:none !important;}
section .play-btn{ display:inline-block; width:60px; height:60px; border-radius:100%; -webkit-border-radius:100%; background-color:#949597; background-image:url(https://www.rawpressery.com/skin/images/video/video-play-btn.png); background-size:10px; background-position:center; background-repeat:no-repeat;    margin-top: 40px;}

</style>



<section class="video-box banner home-sec">
    <div class="overlay">&nbsp;</div>
    <div id="home-video" class=" video-popup" title="Video Box" style="display:none;background:transparent;">
        <a href="javascript:void(0);" class="btn-close">x</a>
        <iframe width="700" height="500" data-src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
<img alt="" data-src="https://www.rawpressery.com/skin/images/video/leave-the-squeezing.jpg" class="lazyload desk-img">
    <div class="inner-bannercontent-centerleft">
        <div class="data">
            <h2 style="color: #fff;"><span>LEAVE THE SQUEEZING TO US.</span></h2>
            <p style="color: #fff;">We work with farmers directly to get the best quality fruits, vegetables and nuts from across the world, pack the goodness in a bottle and deliver it with with love!</p>
            <a href="javascript:void(0);" class="play-btn" rel="https://www.youtube.com/embed/EYmsNq5Ymgs?autoplay=1"></a>
        </div>
    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(function () {

        $("a.play-btn").on("click", function () {
            var videoUrl = $(this).attr('rel');
            //setTimeout(function(){ 
            $('div#home-video').show();
            $('div#home-video iframe').attr('src', videoUrl);
            //}, 1000);
        });
        $('#home-video .btn-close').click(function (event) {
            $('div#home-video').hide();
            $('div#home-video iframe').attr('src', ' ');
            $('#verifyOtpPop .btn-close').trigger('click');

        });
       


    });
</script>