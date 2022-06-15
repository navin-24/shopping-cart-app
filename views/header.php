<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title><?php echo $page_meta['meta_title']; ?></title>
        <?php if ($pageName == 'home') { ?>
        <meta name="google-site-verification" content="9KV2tHj6Dy4UoHFtxfT4fWKKOXjCe5dJbjjNeOcK7ck" />
        <?php } ?>
        <link rel="shortcut icon" href="<?= ASSET_URL ?>imgs/favicon.png" />
        <meta name="description" content="<?php echo $page_meta['meta_desc']; ?>">
        <meta name="keywords" content="<?php echo $page_meta['meta_keywords']; ?>">
        <meta property="og:locale" content="<?php echo $page_meta['meta_og_locale'];?>" />
        <meta property="og:type" content="<?php echo $page_meta['meta_og_type']; ?>" />
        <meta property="og:title" content="<?php echo $page_meta['meta_og_title']; ?>" />
        <meta property="og:description" content="<?php echo $page_meta['meta_og_description']; ?>" />
        <meta property="og:url" content="<?php echo $page_meta['meta_og_url']; ?>" />
        <meta property="og:site_name" content="<?php echo $page_meta['meta_og_site_name']; ?>" />
        <meta property="og:image" content="<?php echo $page_meta['meta_og_image']; ?>" />
        <meta name="twitter:card" content="<?php echo $page_meta['meta_twitter_card']; ?>" />
        <meta name="twitter:title" content="<?php echo $page_meta['meta_twitter_title']; ?>" />
        <meta name="twitter:description" content="<?php echo $page_meta['meta_twitter_description']; ?>" />
        <meta name="twitter:image" content="<?php echo $page_meta['meta_twitter_image']; ?>" />
        <link rel="canonical" href="<?php echo $page_meta['canonical_url']; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet"> -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"> -->
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/allfontawesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

        <link rel="stylesheet" href="<?= ASSET_URL ?>css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/grid.css">
        <link rel="stylesheet" href="<?= ASSET_URL ?>css/main.css">
        <script src="<?= ASSET_URL ?>js/jquery.min.js"></script>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TH447NG');</script>
        <!-- End Google Tag Manager -->

        <script id='_webengage_script_tag' type='text/javascript'>
        var webengage; !function(w, e, b, n, g){function o(e, t){e[t[t.length - 1]] = function(){r.__queue.push([t.join("."),
        arguments])}}var i, s, r = w[b], z = " ", l = "init options track screen onReady".split(z), a = "feedback survey notification".split(z), c = "options render clear abort".split(z), p = "Open Close Submit Complete View Click".split(z), u = "identify login logout setAttribute".split(z); if (!r || !r.__v){for (w[b] = r = {__queue:[], __v:"6.0", user:{}}, i = 0; i < l.length; i++)o(r, [l[i]]); for (i = 0; i < a.length; i++){for (r[a[i]] = {}, s = 0; s < c.length; s++)o(r[a[i]], [a[i], c[s]]); for (s = 0; s < p.length; s++)o(r[a[i]], [a[i], "on" + p[s]])}for (i = 0; i < u.length; i++)o(r.user, ["user", u[i]]); setTimeout(function(){var f = e.createElement("script"), d = e.getElementById("_webengage_script_tag"); f.type = "text/javascript", f.async = !0, f.src = ("https:" == e.location.protocol?"https://ssl.widgets.webengage.com":"http://cdn.widgets.webengage.com") + "/js/webengage-min-v-6.0.js", d.parentNode.insertBefore(f, d)})}}(window, document, "webengage"); webengage.init("aa132641");
        </script>
        
        <!-- Facebook Pixel Code -->
        <script>

            !function (f, b, e, v, n, t, s)

            {
                if (f.fbq)
                    return;
                n = f.fbq = function () {
                    n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };

                if (!f._fbq)
                    f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '629870263832009');
            fbq('track', 'PageView');

        </script>

    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=629870263832009&ev=PageView&noscript=1"/></noscript>

    <!-- End Facebook Pixel Code -->
    <title>Raw Pressery</title>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TH447NG"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
 
    <header class="dvHeader fixed-top">
        <div class="dvDesktopNav d-none d-md-block">
            <div class="container">
                <div class="topbar d-flex justify-content-between">
                    <!-- <div class="location d-lg-none">
                        <p>
                            <small>Delivering to:</small> Mumbai, Maharashtra
                            400066. India
                            <small id="pincode" class="hand">Change</small>
                        </p>
                    </div> -->
                    <div class="location">
                        <p>
                            <small>Delivering to:</small>
                            <span id="usrPincode" data-pincode="<?php echo $cookieAddress; ?>">
                                <?php echo $cookieAddress; ?>
                            </span>
                            <?php $btnTxt = ($cookieAddress) ? 'Change' : 'Add Location'; ?>
                            <small id="pincode2" class="hand"><?= $btnTxt; ?></small>
                        </p>
                    </div>
                    <div class="d-flex">
                        <!-- <div class="whatsapp">
                            <a href="https://api.whatsapp.com/send?phone=919920453453" target="_blank">
                                <i class="fab fa-whatsapp"></i> Place order on Whatsapp
                            </a>
                        </div>
                        <div class="telephone">
                            <a href="tel:9920453453">
                                <i class="fas fa-phone-square-alt"></i> +91 9920-453-453
                            </a>
                        </div> -->
                        <div class="telephone">
                            <a href="https://api.whatsapp.com/send?phone=918657303303" target="_blank">
                                <i class="fab fa-whatsapp"></i> 
                            </a>
                            <a href="tel:8657303303">
                                <i class="fas fa-phone-square-alt"></i> +91 8657-303-303
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                $customer_id = $this->session->userdata('logged_in')['customer_id'];
                $icon_class = ($customer_id) ? 'green-dot' : '';
                ?>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="navigation flex-1">
                        <ul>
                            <li>
                                <a>Shop</a>
                                <div class="drop">
                                    <div class="row">
                                        <div class="col-sm-6 border-right">
                                            <h4>Packages</h4>
                                            <a href="<?= site_url('shop/subscriptions'); ?>">Subscriptions</a>
                                            <a href="<?= site_url('shop/cleanses'); ?>">Cleanses</a>
                                            <a href="<?= site_url('shop/value-packs'); ?>">Value Packs</a>
                                            <a href="<?= base_url('bulk-order'); ?>">Bulk Order</a>
                                            <a href="<?= base_url('DeliveryNew'); ?>">Delivery Boy</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>Juices</h4>
                                            <a href="<?= site_url('shop/juices'); ?>">Juices</a>
                                            <a href="<?= site_url('shop/almond-milks'); ?>">Almond Milk</a>
                                            <a href="<?= site_url('shop/protein-milkshake'); ?>">Protein Milkshake</a>
                                            <a href="<?= base_url('shop'); ?>">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a>Learn</a>
                                <div class="drop p5">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- <a href="<?= base_url('process'); ?>">Process</a> -->
                                            <a href="<?= base_url('about-us'); ?>">About Us</a>
                                            <a href="<?= BLOG_URL; ?>" target="_blank">Blog</a>
                                            <a href="<?= base_url('news'); ?>">News</a>
                                            <!-- <a href="<?= base_url('shelf-life'); ?>">Beyond The Bottle</a> -->

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="logo flex-1 text-center">
                        <a href="<?= BASE_URL; ?>"><img width="60" src="<?= ASSET_URL ?>imgs/white-logo-new.png" class="img-fluid" alt=""></a>
                    </div>
                    <div class="loginDekstop flex-1 d-flex justify-content-end">
                        <div class="search">
                            <a class="hand" id="search">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>
                        <div class="userIcon">

                            <a>
                                <i class="fas fa-user"></i> <span class="identifier <?= $icon_class; ?>"></span>
                            </a>
                            <div class="drop">
                                <?php
                                //print_r($this->session->userdata());

                                $userName = $this->session->userdata('logged_in')['first_name'] . ' ' . $this->session->userdata('logged_in')['last_name'];
                                if ($customer_id != null && $customer_id != '') {
                                    ?>
                                    <a> Welcome <?php echo $userName; ?></a>
                                    <a href="<?= base_url('/dashboard/welcome'); ?>">My Account</a>
                                    <a href="<?= base_url('/shop/cart'); ?>">My Cart (<?= $this->cart->all_item_count(); ?> items)</a>
                                    <a href="<?= base_url('logout'); ?>">Log Out</a>
                                    <?php
                                } else {
                                    ?>   
                                    <a href="<?= base_url('login'); ?>">Login / Sign Up</a>
                                    <!-- <a href="<?= base_url('signup'); ?>">Sign Up</a> -->
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="cartIcon">
                            <a href="<?= base_url('shop/cart'); ?>">
                                <i class="fas fa-shopping-cart"></i> <span class="count total_cart_item"><?= $this->cart->all_item_count(); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="dvMobileNav d-md-none">
            <div id="menuToggle" class="d-flex justify-content-between align-items-center">
                <div class="menuIcon flex-1">
                    <input type="checkbox" />
                    <span></span>
                    <span></span>
                    <span></span>
                    <ul id="menu">
                        <div>
                            <div class="location d-lg-none">
                                <p>
                                    <small>Delivering to:</small> 
                                    <small id="musrPincode" style="color:#fff">
                                        <?php echo ($cookieAddress) ? substr($cookieAddress, 0, 20) . '... ' : ''; ?>
                                    </small>
                                    <?php $btnTxt = ($cookieAddress) ? 'Change' : 'Add Location'; ?>
                                    <small id="pincode" class="hand"><?= $btnTxt; ?></small>
                                </p>
                            </div>
                            <!-- <div class="location d-lg-none">
                                <div>
                                    <span>Delivering to:</span>
                                    <span id="usrPincode">
                                        Mumbai, Maharashtra ...
                                    </span>
                                    <span id="pincode2" class="hand">Change</span>
                                </div>
                            </div> -->
                            <div>
                                <div class="clickPanel d-flex justify-content-between align-items-center">
                                    <h4>SHOP</h4>
                                    <div>
                                        <i class="fas fa-plus"></i>
                                        <!-- <i class="fas fa-minus"></i> -->
                                    </div>
                                </div>
                                <div class="openPanel" style="display:none;">
                                    <ul>
                                        <li><a href="<?= site_url('shop/subscriptions'); ?>">Subscriptions</a>
                                        </li>
                                        <li><a href="<?= site_url('shop/cleanses'); ?>">Cleanses</a></li>
                                        <li><a href="<?= site_url('shop/value-packs'); ?>">Value Packs</a>
                                        </li>
                                        <li><a href="<?= site_url('shop/juices'); ?>">Juices</a></li>
                                        <li><a href="<?= site_url('shop/almond-milks'); ?>">Almond Milks</a></li>
                                        <li><a href="<?= site_url('shop/protein-milkshake'); ?>">Protein Milkshake</a></li>
                                        <li><a href="<?= base_url('bulk-order'); ?>">Bulk Order</a>
                                        <li><a href="<?= base_url('shop'); ?>">View All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="clickPanel">
                                    <div class="d-flex justify-content-between">
                                        <h4>LEARN</h4>
                                        <div>
                                            <i class="fas fa-plus"></i>
                                            <!-- <i class="fas fa-minus"></i> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="openPanel" style="display:none;">
                                    <ul>
                                        <!-- <li><a href="<?= base_url('process'); ?>">Process</a></li> -->
                                        <li><a href="<?= base_url('about-us'); ?>">About Us</a></li>
                                        <li><a href="<?= BLOG_URL; ?>">Blog</a></li>
                                        <li><a href="<?= base_url('news'); ?>">News</a></li>
                                        <!-- <li><a href="<?= base_url('shelf-life'); ?>">Beyond The Bottle</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="myaccount">
                                <div class="d-flex flex-column">
                                    <a href="<?php echo BASE_URL . '/dashboard/welcome'; ?>">MY
                                        ACCOUNT</a>
                                </div>
                            </div>
                            <!-- <div class="whatsapp">
                                <a href="https://api.whatsapp.com/send?phone=919920453453" target="_blank"><i class="fab fa-whatsapp"></i> Place order on Whatsapp
                                </a>
                            </div>
                            <div class="telephone">
                                <a href="tel:9920453453">
                                    <i class="fas fa-phone-square-alt"></i> +91 9920-453-453
                                </a>
                            </div> -->
                            <div class="telephone">
                                <a href="https://api.whatsapp.com/send?phone=918657303303" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="tel:8657303303">
                                    <i class="fas fa-phone-square-alt"></i> +91 8657-303-303
                                </a>
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="logo text-center flex-1">
                    <a href="<?= BASE_URL; ?>">
                        <img width="45" src="<?= ASSET_URL ?>imgs/white-logo-new.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="login d-flex flex-1 justify-content-end">
                    <div class="userIcon">
                        <a>
                            <i class="fas fa-user"></i> <span class="identifier <?= $icon_class; ?>"></span>
                        </a>
                        <!-- <div class="drop">
                            <a href="<?= base_url('login'); ?>">Login</a>
                            <a href="">Sign Up</a>
                        </div> -->

                        <div class="drop">
                            <?php
                            if ($customer_id != null && $customer_id != '') {
                                ?>
                                <!-- Plz do not remove 'customerNameInMenuLink', because we are updating in customer account page -->
                                <a href="<?= base_url('#'); ?>" id="customerNameInMenuLink">Welcome <?php echo $userName; ?></a>
                                <a href="<?= base_url('/dashboard/welcome'); ?>">My Account</a>
                                <a href="<?= base_url('/shop/cart'); ?>">My Cart (<?= $this->cart->all_item_count(); ?> items)</a>
                                <a href="<?= base_url('logout'); ?>">Log Out</a>
                                <?php
                            } else {
                                ?>   
                                <a href="<?= base_url('login'); ?>">Login / Sign Up</a>
                                <!-- <a href="<?= base_url('signup'); ?>">Sign Up</a> -->
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="cartIcon">
                        <a href="<?= base_url('shop/cart'); ?>">
                            <i class="fas fa-shopping-cart"></i> <span class="count total_cart_item"><?= $this->cart->all_item_count(); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div id="wrapper" class='mainHeaderClass'>