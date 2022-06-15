<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>raw white</title>
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/allfontawesome.min.css">
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/grid.css">
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/main-white.css">
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