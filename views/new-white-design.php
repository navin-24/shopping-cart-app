<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>raw white</title>
    <link rel="stylesheet" href="css/allfontawesome.min.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="dvHead">

        <div class="dvMobileMenu d-md-none">
            <div class="d-flex justify-content-between align-items-center bg-white">
                <div class="openNav flex-1" onclick="openNav()"><i class="fas fa-bars"></i></div>
                <div class="logo flex-1 text-center">
                    <a href="https://www.rawpressery.com/">
                        <img src="<?= ASSET_URL ?>imgs/newdesign/logo.png" class="img-fluid" width="40" alt="">
                    </a>
                </div>
                <div class="d-flex login flex-1 justify-content-end">
                    <div class="userIcon">
                        <ul>
                            <li>
                                <a>
                                    <div class="icon">
                                        <span><i class="fas fa-user"></i></span>
                                        <span class="identifier"></span>
                                    </div>
                                </a>
                                <ul class="dropdown">
                                    <li><a href="https://www.rawpressery.com/login">Login / Sign Up</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- <a>
                            <div class="dropdown">
                                <a href="https://www.rawpressery.com/login">Login / Sign Up</a>
                            </div>
                        </a> -->
                    </div>
                    <div class="cartIcon">
                        <a href="https://www.rawpressery.com/shop/cart">
                            <div class="icon">
                                <span><i class="fas fa-shopping-cart"></i></span>
                                <span class="count">0</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="dvSideNav" class="dvSideNav">
                <div class="deliveryLocation text-left">
                    <p>
                        <span class="deliverto"><i class="fas fa-map-marker-alt"></i> Delivering to: <br></span>
                        <span class="city">Mumbai, Maharashtra ... </span>
                        <span class="hand">Change</span>
                    </p>
                </div>
                <ul class="menu">
                    <li><a href="javascript:void(0)" class="closebtn closeNav" onclick="closeNav()"><i
                                class="fas fa-times"></i></a></li>
                    <li><a href="#">Home</a></li>
                    <li class="clickmenu d-flex justify-content-between align-items-center">
                        <a href="#">Shop</a>
                        <i class="fas fa-plus"></i>
                    </li>
                    <div class="openmenu">
                        <ul>
                            <li><a href="">Subscriptions</a></li>
                            <li><a href="">Cleanses</a></li>
                            <li><a href="">Value Packs</a></li>
                            <li><a href="">Juices</a></li>
                            <li><a href="">Almond Milks</a></li>
                            <li><a href="">Protein Milkshake</a></li>
                            <li><a href="">Bulk Order</a></li>
                            <li><a href="">View All</a></li>
                        </ul>
                    </div>
                    <li class="clickmenu d-flex justify-content-between align-items-center">
                        <a href="#">Learn</a>
                        <i class="fas fa-plus"></i>
                    </li>
                    <div class="openmenu">
                        <ul>
                            <li><a href="">Process</a></li>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">News</a></li>
                            <li><a href="">Beyond The Bottle</a></li>
                        </ul>
                    </div>
                    <li><a href="#">My Account</a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=918657303303" target="_blank"><i
                                class="fab fa-whatsapp"></i> Place order on Whatsapp
                        </a></li>
                    <li>
                        <a href="tel:8657303303"><i class="fas fa-phone-square-alt"></i> +91 8657-303-303</a>
                    </li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <div class="dvDesktopMenu d-none d-md-block">
            <div class="border-bottom">
                <div class="container d-flex justify-content-between align-items-center">
                    <div class="deliveryLocation flex-1">
                        <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="deliveryto">Delivering to:</span>
                        <span class="city">Mumbai Maharashtra...</span>
                        <span class="hand">Change</span>
                    </div>
                    <div class="logo flex-1 text-center">
                        <a href="https://www.rawpressery.com/"><img src="<?= ASSET_URL ?>imgs/newdesign/logo.png" class="img-fluid" width="50"
                                alt=""></a>
                    </div>
                    <div class="menus d-md-flex justify-content-md-end align-items-md-center flex-1">
                        <div class="login">
                            <!-- <span>My Account</span> -->
                            <!-- <span class="arrow"><i class="fas fa-angle-down"></i></span> -->
                            <ul>
                                <li>
                                    <a>My Account <span class="arrow"><i class="fas fa-angle-down"></i></span></a>
                                    <ul class="dropdown">
                                        <li><a href="">Login</a></li>
                                        <li><a href="">My Cart</a></li>
                                        <li><a href="">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="cart">
                            <span class="count">0</span>
                            <span><i class="fas fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-md-end align-items-md-center">
                    <div class="nav">
                        <ul class="menu">
                            <li class="active"><a href="">Home</a></li>
                            <li><a>Shop <i class="fas fa-angle-down"></i></a>
                                <ul class="dropdown">
                                    <div class="d-flex">
                                        <li>
                                            <ul>
                                                <li class="heads">Packages</li>
                                                <li><a href="">Subscriptions</a></li>
                                                <li><a href="">Cleanses</a></li>
                                                <li><a href="">Value Packs</a></li>
                                                <li><a href="">Subscriptions</a></li>
                                                <li><a href="">Bulk Order</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li class="heads">Juices</li>
                                                <li><a href="">Juices</a></li>
                                                <li><a href="">Almond Milk</a></li>
                                                <li><a href="">Protein Milkshake</a></li>
                                                <li><a href="">View All</a></li>
                                            </ul>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                            <li><a>Learn <i class="fas fa-angle-down"></i></a>
                                <ul class="dropdown w2">
                                    <li>
                                        <ul>
                                            <li><a href="">Process</a></li>
                                            <li><a href="">About Us</a></li>
                                            <li><a href="">Blog</a></li>
                                            <li><a href="">News</a></li>
                                            <li><a href="">Beyond The Bottle</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="">Place Order on Whatsapp</a></li>
                            <li><a href="">Our Team</a></li>
                            <li><a href="">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="search">
                        <button class="btn btnSearch"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- <header class="dvHeader">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <span>Delivering to: Mumbai Maharashtra</span>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div>My Account</div>
                    <div class="cartIcon">
                        <a href="">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="count total_cart_item"></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 d-flex justify-content-end">
                    <div>
                        <ul>
                            <li>
                                <a href="">Home</a>
                                <a href="">Shop</a>
                                <a href="">Learn</a>
                                <a href="">Place Order On Whatsapp</a>
                                <a href="">Our Team</a>
                                <a href="">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </header> -->

    <div class="dvMainSlider">
        <!-- <div class="container-fluid"> -->
        <div class="owl-carousel">
            <div class="bg d-flex">
                <div class="item m-auto">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbd1.jpg" class="d-none d-md-inline-block img-fluid" alt="">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbm1.jpg" class="d-md-none mbile" alt="">
                </div>
            </div>
            <div class="bg d-flex">
                <div class="item m-auto">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbd2.jpg" class="d-none d-md-inline-block img-fluid" alt="">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbm2.jpg" class="d-md-none mbile" alt="">
                </div>
            </div>
            <div class="bg d-flex">
                <div class="item m-auto">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbd3.jpg" class="d-none d-md-inline-block img-fluid" alt="">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbm3.jpg" class="d-md-none mbile" alt="">
                </div>
            </div>
            <div class="bg d-flex">
                <div class="item m-auto">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbd4.jpg" class="d-none d-md-inline-block img-fluid" alt="">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/fbm4.jpg" class="d-md-none mbile" alt="">
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>





    <section class="cSlider">
        <div class="owl-carousel">

            <div class="item" style="background:url('images/sbd1.jpg') no-repeat top left; background-size:cover;">
                <img src="<?= ASSET_URL ?>imgs/newdesign/sbm1.jpg" class="img-fluid d-md-none" alt="Juices">
                <div class="container relative">
                    <div class="owl-text d-md-flex justify-content-md-end text-md-left">
                        <div>
                            <h1>Dairy-Free <br>Almond Milk</h1>
                            <!-- <h4>COLD-PRESSED | NO ADDED SUGAR | NO PRESERVATIVES</h4> -->
                            <h5>Here's a new way to have your daily dose of almonds.</h5>
                            <a href="https://www.rawpressery.com/shop/juices.html" class="btn btnSecondary"
                                title="Juices">Explore Our Range</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item" style="background:url('images/sbd2.jpg') no-repeat top left; background-size:cover;">
                <img src="<?= ASSET_URL ?>imgs/newdesign/sbm2.jpg" class="img-fluid d-md-none" alt="Juices">
                <div class="container relative">
                    <div class="owl-text d-md-flex justify-content-md-end text-md-left">
                        <div>
                            <h1>100% Natural <br>Cold-Pressed Juices</h1>
                            <!-- <h4>COLD-PRESSED | NO ADDED SUGAR | NO PRESERVATIVES</h4> -->
                            <h5>Add some zest in your life with the citrus and fibre loaded Valencia Orange juice bundle
                                that is as nutritious as your breakfast, packed in a bottle!</h5>
                            <a href="https://www.rawpressery.com/shop/juices.html" class="btn btnSecondary"
                                title="Juices">Explore Our Range</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item" style="background:url('images/sbd3.jpg') no-repeat top left; background-size:cover;">
                <img src="<?= ASSET_URL ?>imgs/newdesign/sbm3.jpg" class="img-fluid d-md-none" alt="Juices">
                <div class="container relative">
                    <div class="owl-text d-md-flex justify-content-md-end text-md-left">
                        <div>
                            <h1>Protein Milkshake <br>18G Protein</h1>
                            <!-- <h4>COLD-PRESSED | NO ADDED SUGAR | NO PRESERVATIVES</h4> -->
                            <h5>Wouldn't you love a chocolate milkshake that's also 3x better than regular milk? Say
                                hello to 18g chocolate protein milkshake. Your everyday protein fix, just got delicious
                                and lactose-free!</h5>
                            <a href="https://www.rawpressery.com/shop/juices.html" class="btn btnSecondary"
                                title="Juices">Explore Our Range</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item" style="background:url('images/sbd4.jpg') no-repeat top left; background-size:cover;">
                <img src="<?= ASSET_URL ?>imgs/newdesign/sbm4.jpg" class="img-fluid d-md-none" alt="Juices">
                <div class="container relative">
                    <div class="owl-text d-md-flex justify-content-md-end text-md-left">
                        <div>
                            <h1>100% <br>Coconut Water</h1>
                            <!-- <h4>COLD-PRESSED | NO ADDED SUGAR | NO PRESERVATIVES</h4> -->
                            <h5>Every athlete's go to natural energy drink; Coconut Water is a complete win-win for your
                                everyday rehydration needs. <br><b>#iaminlovewiththecoco!</b></h5>
                            <a href="https://www.rawpressery.com/shop/juices.html" class="btn btnSecondary"
                                title="Juices">Explore Our Range</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="item" style="background:url('images/c2.jpg') no-repeat top left; background-size:cover;">
                <div class="container relative">
                    <div class="owl-text">
                        <div>
                            <h1>Almond Milk</h1>
                            <h4>LACTOSE FREE | PLANT PROTEIN | VEGAN</h4>
                            <h5>Introducing dairy-free almond milk. Low in calories, high in calcium and vitamins, this
                                one’s great for your bones &amp; skin and boosts brain power!</h5>
                            <a href="https://www.rawpressery.com/shop/almond-milks.html" class="btn btnSecondary"
                                title="Almond Milk">BUY NOW</a>
                        </div>
                    </div>
                </div>

                <img src="https://www.rawpressery.com/assets/imgs/banners/c2.mob.jpg" class="img-fluid d-md-none"
                    alt="Almond Milk">
            </div>
            <div class="item"
                style="background:url('https://www.rawpressery.com/assets/imgs/banners/c4.jpg') no-repeat top left; background-size:cover;">
                <div class="container relative">
                    <div class="owl-text">
                        <div>
                            <h1>Value Packs</h1>
                            <h4>BEST SELLERS | CURATED BUNDLES | OFFERS</h4>
                            <h5>Our hand-picked curation of everything raw. Choose from a wide range of pre-made bundles
                                and save more on every purchase.</h5>
                            <a href="https://www.rawpressery.com/shop/value-packs.html" class="btn btnSecondary"
                                title="Value Packs">BUY NOW</a>
                        </div>
                    </div>
                </div>

                <img src="https://www.rawpressery.com/assets/imgs/banners/c4mob.jpg" class="img-fluid d-md-none"
                    alt="Value Packs">
            </div> -->
        </div>
    </section>



    <div class="dvBottles">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/bottle-dekstop.jpg" class="img-fluid d-none d-md-block" alt="">
                </div>
            </div>
        </div>
        <div class="d-md-none">
            <div class="bottle">
                <button class="btn btn1">1</button>
                <button class="btn btn2">2</button>
                <button class="btn btn3">3</button>
                <button class="btn btn4">4</button>
                <img src="<?= ASSET_URL ?>imgs/newdesign/bottle-mobile.jpg" class="img-fluid" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="text col-12 text-center">
                        <h4>All Fresh. No Preservatives.</h4>
                        <p>
                            Caps<br> Juice Inside<br> Sedimentation<br> Plastic BPA
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dvModal">
        <div id="dvBottlesModal" class="modal" style="display:none;">
            <div class="modal-content modal-center text-center">
                <i class="fas fa-times-circle btn close"></i>
                <div class="text">
                    <!-- <h4>Juice Inside</h4>
                    <p class="text"></p> -->
                </div>
            </div>
        </div>
    </div>




    <section class="dvVids">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/abc.png" class="img-fluid" alt="">
                </div>
                <div class="col-md-6 text-center text-md-left order-md-0 m-md-auto">
                    <h4>Abc Of Juicing</h4>
                    <p>Be it fresh, 100% juices or our other beverages we make it available straight at your doorstep.
                        From manufacturing to delivery, we are observing top safety measures to deliver our products,
                        while meeting all hygiene &amp; safety standards. Just drop us a line on whatsapp or click onto
                        our website, tell us what you need and we'll get it to your doorstep, hassle free.</p>
                    <a href="" class="btn btnSecondary">Know More</a>
                </div>
            </div>
        </div>
    </section>



    <section class="dvSlidess">
        <div class="container">
            <div class="owl-carousel">
                <div>
                    <div class="row">
                        <div class="col-md-6 order-md-1">
                            <img src="<?= ASSET_URL ?>imgs/newdesign/slides1.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6 text-center text-md-left order-md-0 m-md-auto">
                            <h4>All Treasure. No Trash.</h4>
                            <p>Be it fresh, 100% juices or our other beverages we make it available straight at your
                                doorstep.
                                From manufacturing to delivery, we are observing top safety measures to deliver our
                                products,
                                while meeting all hygiene &amp; safety standards. Just drop us a line on whatsapp or
                                click onto
                                our website, tell us what you need and we'll get it to your doorstep, hassle free.</p>
                            <a href="" class="btn btnSecondary">Know More</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-6 order-md-1">
                            <img src="<?= ASSET_URL ?>imgs/newdesign/slides2.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6 text-center text-md-left order-md-0 m-md-auto">
                            <h4>All Sweet. No Added Sugar.</h4>
                            <p>Be it fresh, 100% juices or our other beverages we make it available straight at your
                                doorstep.
                                From manufacturing to delivery, we are observing top safety measures to deliver our
                                products,
                                while meeting all hygiene &amp; safety standards. Just drop us a line on whatsapp or
                                click onto
                                our website, tell us what you need and we'll get it to your doorstep, hassle free.</p>
                            <a href="" class="btn btnSecondary">Know More</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-6 order-md-1">
                            <img src="<?= ASSET_URL ?>imgs/newdesign/slides3.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6 text-center text-md-left order-md-0 m-md-auto">
                            <h4>All Farm. No Lab.</h4>
                            <p>Be it fresh, 100% juices or our other beverages we make it available straight at your
                                doorstep.
                                From manufacturing to delivery, we are observing top safety measures to deliver our
                                products,
                                while meeting all hygiene &amp; safety standards. Just drop us a line on whatsapp or
                                click onto
                                our website, tell us what you need and we'll get it to your doorstep, hassle free.</p>
                            <a href="" class="btn btnSecondary">Know More</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-6 order-md-1">
                            <img src="<?= ASSET_URL ?>imgs/newdesign/slides4.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6 text-center text-md-left order-md-0 m-md-auto">
                            <h4>All Good. No Bad.</h4>
                            <p>Be it fresh, 100% juices or our other beverages we make it available straight at your
                                doorstep.
                                From manufacturing to delivery, we are observing top safety measures to deliver our
                                products,
                                while meeting all hygiene &amp; safety standards. Just drop us a line on whatsapp or
                                click onto
                                our website, tell us what you need and we'll get it to your doorstep, hassle free.</p>
                            <a href="" class="btn btnSecondary">Know More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="dvRecycled">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 text-center text-lg-left order-md-0 my-lg-auto">
                    <div class="ticker">
                        <h6>Bottles recycled since 2017</h6>
                        <p>1,47,80,459 <sup><i class="fas fa-angle-up"></i></sup> </p>
                    </div>
                    <img src="<?= ASSET_URL ?>imgs/newdesign/recycled.png" class="img-fluid d-md-none" alt="">
                    <h4>Rawcycled.</h4>
                    <p>
                        We are starting a wave of change by taking action to be part of the solution. Primary problem of
                        plastic is bad disposal and waste management. We are giving plastic purpose and redirecting it
                        from the landfills to becoming apparel. RAWcycled our recycled initiative is transforming trash
                        to trendy wear, 7 plastic bottles at a time.
                    </p>
                    <div class="col">
                        <img src="<?= ASSET_URL ?>imgs/newdesign/rawcycled-tshirt.png" class="img-fluid tshirt" width="300" alt="">
                    </div>
                    <a href="" class="btn btnSecondary">Know More</a>
                </div>
                <div class="col-md-6 order-md-1">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/recycled.png" class="img-fluid d-none d-md-block" alt="">
                </div>
            </div>
        </div>
    </section>



    <section class="dvInstagram">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-4 img">
                            <a href=""><img src="<?= ASSET_URL ?>imgs/newdesign/ins1.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 img">
                            <a href=""><img src="<?= ASSET_URL ?>imgs/newdesign/ins2.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 img">
                            <a href=""><img src="<?= ASSET_URL ?>imgs/newdesign/ins3.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 img">
                            <a href=""><img src="<?= ASSET_URL ?>imgs/newdesign/ins4.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 img">
                            <a href=""><img src="<?= ASSET_URL ?>imgs/newdesign/ins5.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col-4 img">
                            <a href=""><img src="<?= ASSET_URL ?>imgs/newdesign/ins6.jpg" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="dvWhatWeDo">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>Why We Do What We Do.</h4>
                    <p class="small">Customer Stories</p>
                </div>
                <div class="col-12">
                    <div class="owl-carousel">
                        <div class="box d-flex flex-column h-100">
                            <div class="roundimg">
                                <img src="<?= ASSET_URL ?>imgs/newdesign/team1.png" class="img-fluid" alt="">
                            </div>
                            <div class="bg-white">
                                <h6>Jackie</h6>
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident.
                                </p>
                            </div>
                        </div>
                        <div class="box d-flex flex-column h-100">
                            <div class="roundimg">
                                <img src="<?= ASSET_URL ?>imgs/newdesign/team1.png" class="img-fluid" alt="">
                            </div>
                            <div class="bg-white">
                                <h6>Jackie2</h6>
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                        </div>
                        <div class="box d-flex flex-column h-100">
                            <div class="roundimg">
                                <img src="<?= ASSET_URL ?>imgs/newdesign/team1.png" class="img-fluid" alt="">
                            </div>
                            <div class="bg-white">
                                <h6>Jackie3</h6>
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident.
                                </p>
                            </div>
                        </div>
                        <div class="box d-flex flex-column h-100">
                            <div class="roundimg">
                                <img src="<?= ASSET_URL ?>imgs/newdesign/team1.png" class="img-fluid" alt="">
                            </div>
                            <div class="bg-white">
                                <h6>Jackie3</h6>
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident.
                                </p>
                            </div>
                        </div>
                        <div class="box d-flex flex-column h-100">
                            <div class="roundimg">
                                <img src="<?= ASSET_URL ?>imgs/newdesign/team1.png" class="img-fluid" alt="">
                            </div>
                            <div class="bg-white">
                                <h6>Jackie3</h6>
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident. Itaque quia minus
                                    error repellendus repudiandae eos voluptates ad provident.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="dvLogoSlide">
        <div class="container">
            <div class="owl-carousel">
                <div class="text-center img">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/logo1.png" class="img-fluid" alt="">
                    <p>"The untold story RAW Pressery" <br>CNBC Disruptors</p>
                </div>
                <div class="text-center img">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/logo2.png" class="img-fluid" alt="">
                    <p>"We don't think like others FMCG companies" <br>Anuj Rakyan</p>
                </div>
                <div class="text-center img">
                    <img src="<?= ASSET_URL ?>imgs/newdesign/logo3.png" class="img-fluid" alt="">
                    <p>"From Recycling to Reusing: <br>Turning plastic into wearble fabric"</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="dvFooters">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list">
                                <li>Shop</li>
                                <li><a href="">Subscription</a></li>
                                <li><a href="">Value Packs</a></li>
                                <li><a href="">Juices</a></li>
                                <li><a href="">Almond Milks</a></li>
                                <li><a href="">Protein Milkshake</a></li>
                                <li><a href="">Cleanses</a></li>
                                <li><a href="">Bulk Order</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-lg-5 border-right">
                            <ul class="list">
                                <li>Learn</li>
                                <li><a href="">Process</a></li>
                                <li><a href="">About Us</a></li>
                                <li><a href="">Blog</a></li>
                                <li><a href="">News</a></li>
                                <li><a href="">Beyond The Bottle</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dvSignups col-sm-6">
                    <div class="row">
                        <div class="col-12">
                            <h6>Sign-up to get closer</h6>
                        </div>
                        <div class="form col-12">
                            <input type="text" class="form-control" placeholder="Enter Email Id">
                            <button class="btn">Subscribe</button>
                        </div>
                        <div class="links col-12">
                            <div class="d-flex">
                                <a href="">Shop</a>
                                <a href="">Learn</a>
                                <a href="">Cleanse Guide</a>
                                <a href="">Contact</a>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6>All Good. No Bad.</h6>
                        </div>
                        <div class="col-12">
                            <p>Raw Pressery makes fresh cold pressed juices and almond milks, delivered straight to your
                                doorstep.</p>
                            <p>
                                &copy; 2019 RAKYAN BEVERAGES
                            </p>
                            <p class="terms">
                                <a href="">Terms</a>
                                <a href="">Privacy Policy</a>
                                <a href="">Return &amp; Refund Policy</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>




    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="js/jquery.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        let btn1 = document.querySelector('.btn1');
        let getButtons = document.querySelectorAll('.dvBottles .bottle .btn');
        let modal = document.querySelector('#dvBottlesModal');
        let closeBtn = document.querySelector('#dvBottlesModal.modal .close');
        let body = document.querySelector('body');
        let modalContent = document.querySelector('#dvBottlesModal .modal-content');
        let text = document.querySelector('#dvBottlesModal .modal-content .text');
        let txtObj = {
            text1: `<h4>Caps</h4>
            <p>All safe. No Leaks. Little leaks in caps can cause oxidation &amp; spoilage. Our new airtight caps protect the liquid inside from oxidation, leakag-es and contact with other external elements like air, water or dust.</p>`,
            text2: `
            <h4>Juice Inside</h4>
            <p>All Fresh. No Preservatives. We use cutting-edge High-Pressure Sterilization Processes to keep our
                    juices preservatives free. This advanced scientific process enables us to naturally preserve the
                    juices without adding any preservative or through any secret formula.</p>`,
            text3: `<h4>Sedimentation</h4>
            <p>All Natural. No artificial. pulp being heavier, settles down naturally. Don't worry, no artificial emulsifiers here. Just Shake &amp; Take.</p>`,
            text4: `<h4>Plastic BPA</h4>
            <p>All Protection. No fear. Did you know that UV rays from the sun are a strong catalyst in the oxidation of fruits and are a major reason behind them getting spoiled? Our new bottles come with invisible barrier lining that blocks UV light from entering the bottle and thereby protecting the juice &amp; keeping the nutrients intact.</p>`,
            text5: 'not found'
        }
        Array.from(getButtons).forEach(function (buttons) {
            buttons.addEventListener('click', function () {
                modal.style.display = 'block';
                modalContent.style.backgroundColor = 'black';
                body.style.overflow = 'hidden';
                let getAttr = buttons.getAttribute('class');
                if (getAttr == 'btn btn1') {
                    text.innerHTML = txtObj.text1;
                }
                else if (getAttr == 'btn btn2') {
                    text.innerHTML = txtObj.text2;
                }
                else if (getAttr == 'btn btn3') {
                    text.innerHTML = txtObj.text3;
                }
                else if (getAttr == 'btn btn4') {
                    text.innerHTML = txtObj.text4;
                }
                else {
                    text.innerHTML = txtObj.text5;
                }
            });
        });
        closeBtn.onclick = function () {
            modal.style.display = 'none';
            body.style.overflow = 'unset';
        }
    </script>

</body>

</html>