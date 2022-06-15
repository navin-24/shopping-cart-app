<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <section class="dvProductDetail">
        <div class="container-fluid">
            <div class="row">
                <div class="img col-md-6 d-flex justify-content-center align-items-center">
                    <img src="<?= ASSET_URL ?>imgs/deep-cleanse-mob.jpg" class="img-fluid d-md-none" alt="">
                    <img src="<?= ASSET_URL ?>imgs/deep-cleanse-desktop.jpg" class="img-fluid d-none d-md-block" alt="">
                </div>
                <div class="col-md-6">
                    <div class="row about">
                        <div class="col-md-12">
                            <div class="d-md-flex justify-content-md-start align-items-md-center">
                                <h2 class="d-md-inline-block">Deep Cleanse</h2>
                                <span class="ratings">
                                    <a href=""><i class="fas fa-star"></i></a>
                                    <a href=""><i class="fas fa-star"></i></a>
                                    <a href=""><i class="fas fa-star"></i></a>
                                    <a href=""><i class="fas fa-star"></i></a>
                                    <a href=""><i class="fas fa-star"></i></a>
                                </span>
                            </div>
                            <div class="list">
                                <span>Trim</span>
                                <span>Love</span>
                                <span>Flush</span>
                                <span>Shield</span>
                                <span>Glow</span>
                                <span>Lean</span>
                            </div>
                            <p>
                                Also known as the Expert Cleanse, the carefully crafted Deep Cleanse contains 6
                                healthy
                                juices
                                that are loaded with plant protein and fibre to boost your metabolism. Pick this one
                                to
                                get the
                                perfect start for a detox diet and flush out all the bad in a natural way.
                            </p>
                        </div>
                    </div>
                    <div class="row details">
                        <div class="col-4 col-md-3">
                            <img class="img-fluid" src="http://beta.rawpressery.com/images/icons/sourced-from.svg" alt="">
                            <p>
                                Sourced carefully &amp; responsibly.
                            </p>
                        </div>
                        <div class="col-4 col-md-3">
                            <img class="img-fluid" src="http://beta.rawpressery.com/images/icons/valencia-orange_Better-Bowel-Movement.svg" alt="">
                            <p>
                                Detoxify your body.
                            </p>
                        </div>
                        <div class="col-4 col-md-3">
                            <img class="img-fluid" src="http://beta.rawpressery.com/images/icons/trim_Aids-Weight-Loss.svg" alt="">
                            <p>
                                Healthy &amp; glowing skin.
                            </p>
                        </div>
                    </div>
                    <div class="row size">
                        <div class="col-sm-12">
                            <p>Size: <span>250ML</span></p>
                        </div>
                    </div>
                    <!-- <div class="row noofdays">
                        <div class="col-lg-3 col-xl-3">
                            <p>No. of Days:</p>
                        </div>
                        <div class="col-lg-9 col-xl-9">
                            <label class="radios">
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark">4 Days</span>
                            </label>
                            <label class="radios">
                                <input type="radio" name="radio">
                                <span class="checkmark">3 Days</span>
                            </label>
                            <label class="radios">
                                <input type="radio" name="radio">
                                <span class="checkmark">2 Days</span>
                            </label>
                            <label class="radios">
                                <input type="radio" name="radio">
                                <span class="checkmark">1 Day</span>
                            </label>
                        </div>
                    </div> -->
                    <div class="row noofweeks">
                        <div class="col-lg-2 col-xl-2">
                            <p>No. of Weeks:</p>
                        </div>
                        <div class="weeks col-lg-9 col-xl-10">
                            <div class="selectOptions d-flex flex-wrap justify-content-center justify-content-md-start">
                                <div class="opt">
                                    <input type="radio" id="control_4" name="selects" value="4" checked="">
                                    <label for="control_4">
                                        <p><span>4 Weeks</span></p>
                                    </label>
                                </div>
                                <div class="opt">
                                    <input type="radio" id="control_5" name="selects" value="5">
                                    <label for="control_5">
                                        <p><span>8 Weeks</span></p>
                                    </label>
                                </div>
                                <div class="opt">
                                    <input type="radio" id="control_6" name="selects" value="6">
                                    <label for="control_6">
                                        <p><span>12 Weeks</span></p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-10 d-none">
                            <div class="selectOptions d-flex flex-wrap justify-content-center justify-content-md-start">
                                <div class="opt">
                                    <input type="radio" id="control_0" name="select" value="0" checked="" data-base_price="1500" data-special_price="0">
                                    <label for="control_0">
                                        <h2>buy 1</h2>
                                        <p><span>₹1500/cleanse</span></p>
                                        <p>(Ideal For 1 Day)</p>
                                    </label>
                                </div>
                                <div class="opt">
                                    <input type="radio" id="control_1" name="select" value="1" data-base_price="4500" data-special_price="6000">
                                    <label for="control_1">
                                        <h2>buy 4</h2>
                                        <p><span>₹1125/cleanse</span></p>
                                        <p>(Ideal for 1 months)</p>
                                    </label>
                                </div>
                                <div class="opt">
                                    <input type="radio" id="control_2" name="select" value="2" data-base_price="7490" data-special_price="10500">
                                    <label for="control_2">
                                        <h2>buy 7</h2>
                                        <p><span>₹1070/cleanse</span></p>
                                        <p>(Ideal for 2 months)</p>
                                    </label>
                                </div>
                                <div class="opt">
                                    <input type="radio" id="control_3" name="select" value="3" data-base_price="9990" data-special_price="15000">
                                    <label for="control_3">
                                        <h2>buy 10</h2>
                                        <p><span>₹999/cleanse</span></p>
                                        <p>(Ideal for 3 months)</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row prices">
                        <!-- <div class="col-xl-6">
                            <p>
                                <span class="heading">Price:</span>
                                <del><i class="fas fa-rupee-sign"></i> 5,500.00</del>
                                <span class="amount"><i class="fas fa-rupee-sign"></i> 4,500.00</span>                                
                            </p>
                        </div> -->
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <div class="deleted">
                                <div class="strikePrice base_price strike"><i class="fas fa-rupee-sign"></i><span>1500.00</span></div>
                            </div>
                            <div class="price special_price">
                                <i class="fas fa-rupee-sign"></i><span>2000.00</span>
                            </div>
                        </div>
                        <div class="buttons">
                            <button class="btn btnAdd">Add to Cart</button>
                            <button class="btn btnPM">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="minus"><i class="fas fa-minus"></i></span>
                                    <span class="qty"><input type="text" class="form-control" value="0"></span>
                                    <span class="plus"><i class="fas fa-plus"></i></span>
                                </div>
                            </button>
                        </div>
                        <!-- <div class="btnHolder">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <button class="btn btnAdd">Add to Cart</button>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row justify-content-center align-items-center">
                                        <span class="minus"><i class="fas fa-minus"></i></span>
                                        <span class="qty"><input type="text" value="1" class="form-control"></span>
                                        <span class="plus"><i class="fas fa-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
                            <nav class="">
                                <ul class="d-flex justify-content-between flex-nowrap">
                                    <li class="active">
                                        <a class="scroll" href="#dvDidYouKnow">Did You Know?</a>
                                    </li>
                                    <li>
                                        <a class="scroll" href="#dvTab">Product Details</a>
                                    </li>
                                    <li>
                                        <a class="scroll" href="#dvCleansesGuide">Cleanses Guide</a>
                                    </li>
                                    <li>
                                        <a class="scroll" href="#dvFaqs">Faq's</a>
                                    </li>
                                    <li>
                                        <a class="scroll" href="#dvReviews">Reviews</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dvDidYouKnow" class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Did You Know</h3>
                        </div>
                        <div class="col-sm-12">
                            <div class="owl-carousel owl-theme owl-loaded">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage">
                                        <div class="owl-item text-center">
                                            <img width="50" class="img-fluid mb15" src="<?= ASSET_URL ?>imgs/didyouknow/s1.svg" alt="">
                                            <h5 class="mb15">High Vitamin C</h5>
                                            <p class="content-grey">
                                                Kale has more than twice the vitamin C of an orange!
                                            </p>
                                        </div>
                                        <div class="owl-item text-center">
                                            <img width="50" class="img-fluid mb15" src="<?= ASSET_URL ?>imgs/didyouknow/s2.svg" alt="">
                                            <h5 class="mb15">High in Anti-Oxidants</h5>
                                            <p class="content-grey">
                                                Pomegranate consists of three times as many antioxidants than
                                                green
                                                tea.
                                            </p>
                                        </div>
                                        <div class="owl-item text-center">
                                            <img width="50" class="img-fluid mb15" src="<?= ASSET_URL ?>imgs/didyouknow/s3.svg" alt="">
                                            <h5 class="mb15">Hangover-friendly</h5>
                                            <p class="content-grey">
                                                Beetroot detoxifies your liver and could be the key to beat your
                                                hangover.
                                            </p>
                                        </div>
                                        <div class="owl-item text-center">
                                            <img width="50" class="img-fluid mb15" src="<?= ASSET_URL ?>imgs/didyouknow/s4.svg" alt="">
                                            <h5 class="mb15">High Fiber</h5>
                                            <p class="content-grey">
                                                Oranges contain more fiber than most fruits and vegetables.
                                                Average
                                                fiber in
                                                1 medium orange = 7 cups of cornflakes!
                                            </p>
                                        </div>
                                        <div class="owl-item text-center">
                                            <img width="50" class="img-fluid mb15" src="<?= ASSET_URL ?>imgs/didyouknow/s5.svg" alt="">
                                            <h5 class="mb15">High protein</h5>
                                            <p class="content-grey">
                                                Spirulina has 70% protein, highest of any natural food. One of
                                                the
                                                many
                                                reasons we call it a superfood.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dvTable" class="row">
                <div class="col-sm-12">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Nutrition Facts</h3>
                                    <p>1 Serving per container.</p>
                                </div>
                                <div class="col-md-12 responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th width="50%">Serving Size</th>
                                                <th width="25%"></th>
                                                <th width="25%">1 Glass (250ml)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Amount per serving</td>
                                                <td></td>
                                                <td>0000</td>
                                            </tr>
                                            <tr class="border">
                                                <td><b>Calories</b></td>
                                                <td></td>
                                                <td><b>63.3 Keal</b></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><b>250ml</b></td>
                                                <td><b>1.50%</b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Total Fat</b></td>
                                                <td>0.30g</td>
                                                <td>1.50%</td>
                                            </tr>
                                            <tr>
                                                <td>Sodium</td>
                                                <td>32.50mg</td>
                                                <td>1.55%</td>
                                            </tr>
                                            <tr>
                                                <td>Total Carbs</td>
                                                <td>13.75g</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Dietary Fiber</td>
                                                <td>3.00g</td>
                                                <td><b>10.00%</b></td>
                                            </tr>
                                            <tr>
                                                <td>Sugar</td>
                                                <td>9.00g</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Added Sugar</td>
                                                <td>0g</td>
                                                <td></td>
                                            </tr>
                                            <tr class="border-b">
                                                <td><b>Protein</b></td>
                                                <td>1.40g</td>
                                                <td><b>2.33%</b></td>
                                            </tr>
                                            <tr>
                                                <td>Vitamin A</td>
                                                <td>30 IU</td>
                                                <td>0.38%</td>
                                            </tr>
                                            <tr>
                                                <td>Vitamin C</td>
                                                <td>3.50mg</td>
                                                <td>8.75%</td>
                                            </tr>
                                            <tr>
                                                <td>Calcium</td>
                                                <td>4.25mg</td>
                                                <td>7.38%</td>
                                            </tr>
                                            <tr>
                                                <td>Iron</td>
                                                <td>0.000mg</td>
                                                <td>0.00%</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td><b>Potassium</b></td>
                                                <td>405.8mg</td>
                                                <td>10.82%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="smallImages col-md-6 text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Ingrediants</h3>
                                    <p>Some text for ingrediants.</p>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <img src="<?= ASSET_URL ?>imgs/tab/trim4.webp" class="icon img-fluid" alt="">
                                    <h6>Kale</h6>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <img src="<?= ASSET_URL ?>imgs/tab/trim4.webp" class="icon img-fluid" alt="">
                                    <h6>Kale</h6>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <img src="<?= ASSET_URL ?>imgs/tab/trim4.webp" class="icon img-fluid" alt="">
                                    <h6>Kale</h6>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <img src="<?= ASSET_URL ?>imgs/tab/trim4.webp" class="icon img-fluid" alt="">
                                    <h6>Kale</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div id="dvTab" class="row">
                <div class="col-sm-12">
                    <h3>Product Detail</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="tabs d-flex flex-nowrap flex-lg-wrap justify-content-between">
                                <li id="defaultOpen" class="tablinks" onclick="myTabs(event, 'trim')">Trim</li>
                                <li class="tablinks" onclick="myTabs(event, 'love')">Love</li>
                                <li class="tablinks" onclick="myTabs(event, 'flush')">Flush</li>
                                <li class="tablinks" onclick="myTabs(event, 'shield')">Shield</li>
                                <li class="tablinks" onclick="myTabs(event, 'glow')">Glow</li>
                                <li class="tablinks" onclick="myTabs(event, 'lean')">Lean</li>
                            </ul>

                            <div id="trim" class="tabcontent">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>9.00 am</h4>
                                    </div>
                                    <div class="col-md-4 order-0 order-md-1">
                                        <img class="img img-fluid" src="<?= ASSET_URL ?>imgs/tab/trim1.webp" alt="">
                                    </div>
                                    <div class="col-md-4 order-1 order-md-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid" src="<?= ASSET_URL ?>imgs/tab/trim2.svg" alt="">
                                                <h5>Weight Management</h5>
                                                <p>Shed those extra kilos with this
                                                    zero calorie
                                                    multi-veggie drink
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid" src="<?= ASSET_URL ?>imgs/tab/trim3.svg" alt="">
                                                <h5>Boosts your Digestion</h5>
                                                <p>Loaded with fiber & mineral rich
                                                    veggies, this juice kick
                                                    starts
                                                    your
                                                    metabolism</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="" class="btn btnPrimary">Nutritional
                                                    Values</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 order-2 order-md-2">
                                        <div class="smallImages row">
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim4.webp" class="icon img-fluid" alt="">
                                                <h6>Kale</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim5.webp" class="icon img-fluid" alt="">
                                                <h6>Coconut Water</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim6.webp" class="icon img-fluid" alt="">
                                                <h6>Spinach</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim7.webp" class="icon img-fluid" alt="">
                                                <h6>Doodhi</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim8.webp" class="icon img-fluid" alt="">
                                                <h6>Celery</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim9.webp" class="icon img-fluid" alt="">
                                                <h6>Green Apple</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim10.webp" class="icon img-fluid" alt="">
                                                <h6>Lemon &amp; Ginger</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <img width="100" src="<?= ASSET_URL ?>imgs/tab/trim11.webp" class="icon img-fluid" alt="">
                                                <h6>Amla</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="love" class="tabcontent">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="bebas">11.30 am</h4>
                                    </div>
                                    <div class="col-md-4 order-0 order-md-1">
                                        <img class="img img-fluid" src="<?= ASSET_URL ?>imgs/tab/love1.webp" alt="">
                                    </div>
                                    <div class="col-md-4 order-1 order-md-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid" src="<?= ASSET_URL ?>imgs/tab/love2.svg" alt="">
                                                <h5>Good for your heart</h5>
                                                <p class="content-grey">Love and protect your heart with
                                                    this anti-oxidant rich minty juice
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid" src="<?= ASSET_URL ?>imgs/tab/love3.svg" alt="">
                                                <h5>Burns more fat</h5>
                                                <p class="content-grey">Rich in fiber and healthy fats,
                                                    this
                                                    juice burns more fat with love</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="" class="btn btnPrimary">Nutritional
                                                    Values</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 order-2 order-md-2">
                                        <div class="smallImages row">
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/love4.webp" class="img-fluid" alt="">
                                                <h6>Kale</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/love5.webp" class="img-fluid" alt="">
                                                <h6>Coconut Water</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/love6.webp" class="img-fluid" alt="">
                                                <h6>Spinach</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/love7.webp" class="img-fluid" alt="">
                                                <h6>Doodhi</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="flush" class="tabcontent">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="bebas">2.00 pm</h4>
                                    </div>
                                    <div class="col-md-4 order-0 order-md-1">
                                        <img class="img img-fluid" src="<?= ASSET_URL ?>imgs/tab/flush1.webp" alt="">
                                    </div>
                                    <div class="col-md-4 order-1 order-md-0 mb30 mt30 mt-md-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/flush2.svg" alt="">
                                                <h5>Bye-Bye Hangover</h5>
                                                <p class="content-grey">Flushes out all the toxins and
                                                    give
                                                    your liver a much needed breather
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/flush3.svg" alt="">
                                                <h5>Enriched with fiber</h5>
                                                <p class="content-grey">With a blend of carrots, apple
                                                    and
                                                    beet, this fiber-rich juice keeps hunger at bay</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="" class="btn btnPrimary">Nutritional
                                                    Values</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 order-2 order-md-2">
                                        <div class="smallImages row">
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/flush4.webp" class="img-fluid" alt="">
                                                <h6>Kale</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/flush5.webp" class="img-fluid" alt="">
                                                <h6>Coconut Water</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/flush6.webp" class="img-fluid" alt="">
                                                <h6>Spinach</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/flush7.webp" class="img-fluid" alt="">
                                                <h6>Doodhi</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/flush8.webp" class="img-fluid" alt="">
                                                <h6>Celery</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="shield" class="tabcontent">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="bebas">4.30 pm</h4>
                                    </div>
                                    <div class="col-md-4 order-0 order-md-1">
                                        <img class="img img-fluid" src="<?= ASSET_URL ?>imgs/tab/shield1.webp" alt="">
                                    </div>
                                    <div class="col-md-4 order-1 order-md-0 mb30 mt30 mt-md-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/shield2.webp" alt="">
                                                <h5>Boosts your immunity</h5>
                                                <p class="content-grey">Loaded with carrrots &
                                                    tangerines,
                                                    this juice strengthens body's defence shiled
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/shield3.webp" alt="">
                                                <h5>Perfect for the cold</h5>
                                                <p class="content-grey">With a fine touch of ginger,
                                                    this
                                                    juice acts as your shiled agianst cold</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="" class="btn btnPrimary">Nutritional
                                                    Values</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 order-2 order-md-2">
                                        <div class="smallImages row">
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/shield4.webp" class="img-fluid" alt="">
                                                <h6>Kale</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/shield5.webp" class="img-fluid" alt="">
                                                <h6>Coconut Water</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/shield6.webp" class="img-fluid" alt="">
                                                <h6>Spinach</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="glow" class="tabcontent">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="bebas">7.00 pm</h4>
                                    </div>
                                    <div class="col-md-4 order-0 order-md-1">
                                        <img class="img img-fluid" src="<?= ASSET_URL ?>imgs/tab/glow1.webp" alt="">
                                    </div>
                                    <div class="col-md-4 order-1 order-md-0 mb30 mt30 mt-md-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/glow2.svg" alt="">
                                                <h5>Hydrates your body</h5>
                                                <p class="content-grey">Get cool with a soothing blend
                                                    of
                                                    cucumber, coconut and aloe
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/glow3.svg" alt="">
                                                <h5>Problem free skin</h5>
                                                <p class="content-grey">Loaded with skin-friendly
                                                    vitamins
                                                    and hydration, Glow gives you a glowing skin</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="" class="btn btnPrimary">Nutritional
                                                    Values</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 order-2 order-md-2">
                                        <div class="smallImages row">
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/glow4.webp" class="img-fluid" alt="">
                                                <h6>Kale</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/glow5.webp" class="img-fluid" alt="">
                                                <h6>Coconut Water</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/glow6.webp" class="img-fluid" alt="">
                                                <h6>Spinach</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/glow7.webp" class="img-fluid" alt="">
                                                <h6>Doodhi</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/glow8.webp" class="img-fluid" alt="">
                                                <h6>Celery</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/glow9.webp" class="img-fluid" alt="">
                                                <h6>Green Apple</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="lean" class="tabcontent">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="bebas">9.30 pm</h4>
                                    </div>
                                    <div class="col-md-4 order-0 order-md-1">
                                        <img class="img img-fluid" src="<?= ASSET_URL ?>imgs/tab/lean1.webp" alt="">
                                    </div>
                                    <div class="col-md-4 order-1 order-md-0 mb30 mt30 mt-md-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/lean2.svg" alt="">
                                                <h5>High in iron</h5>
                                                <p class="content-grey">With the goodness of apple and
                                                    kiwi,
                                                    this juice boosts your iron levels
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <img width="50" class="icon img-fluid mb15" src="<?= ASSET_URL ?>imgs/tab/lean3.svg" alt="">
                                                <h5>Fights Cancer</h5>
                                                <p class="content-grey">Spirulina boosts your immunity
                                                    and
                                                    defence protiens to protect you against even cancer
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="" class="btn btnPrimary">Nutritional
                                                    Values</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 order-2 order-md-2">
                                        <div class="smallImages row">
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/lean4.webp" class="img-fluid" alt="">
                                                <h6>Kale</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/lean5.webp" class="img-fluid" alt="">
                                                <h6>Coconut Water</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/lean6.webp" class="img-fluid" alt="">
                                                <h6>Spinach</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/lean7.webp" class="img-fluid" alt="">
                                                <h6>Doodhi</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/lean8.webp" class="img-fluid" alt="">
                                                <h6>Celery</h6>
                                            </div>
                                            <div class="col-6 col-lg-4 mb15">
                                                <img width="100" class="icon img-fluid mb5" src="<?= ASSET_URL ?>imgs/tab/lean9.webp" class="img-fluid" alt="">
                                                <h6>Green Apple</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dvCleansesGuide" class="row">
                <div class="container-fluid">
                    <div class="row opacity">
                        <div class="col-sm-12">
                            <h3>Cleanse guide</h3>
                            <p>Want to learn more about how the cleanse benefits you?</p>
                            <a href="" class="btn btnPrimary">Download</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dvFaqs" class="row">
                <div class="col-sm-12">
                    <h3>Faqs</h3>
                </div>
                <div class="container">
                    <div class="dvAccordion row">
                        <div id="multiple" data-accordion-group class="col-lg-4">
                            <div data-accordion>
                                <h5 data-control>About The Juice </h5>
                                <div data-content>
                                    <div data-accordion>
                                        <button data-control>
                                            Isn't it true that our bodies are capable of
                                            cleansing
                                            naturally? If so, why should I partake in the
                                            cleansing
                                            trend?
                                        </button>
                                        <div data-content>
                                            <p>
                                                It is definitely true to say that our bodies cleanse
                                                naturally and constantly but with the stress of
                                                modern
                                                life,
                                                processed food, pollution and other environmental
                                                factors,
                                                we need a little extra help. We like to think of our
                                                cleanse
                                                program as a way to reset healthy eating habits and
                                                give
                                                our
                                                digestive system a break. Cleansing is a great way
                                                to
                                                bring
                                                balance into your life.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            What precautionary measures should I take
                                            before/after
                                            the
                                            cleanse?
                                        </button>
                                        <div data-content>
                                            <p>
                                                <b><u>2-3 days prior to the cleanse:</u></b><br><br>
                                                <b>Dos:</b><br>
                                                <b>H2O:</b> Drink plenty of water to hydrate your
                                                system.<br>
                                                <b>Eat Light:</b> Incorporate plenty of raw fruits
                                                and
                                                salads.<br><br>
                                                <b>Don’ts:</b><br>
                                                No Red Meat, Dairy and Gluten<br>
                                                No Alcohol and Nicotine<br>
                                                No Caffeine<br><br>
                                                <b>Post-Cleanse:</b><br>
                                                <b>Day 1:</b> Add in raw fruits, salads, nuts &amp;
                                                seeds
                                                and
                                                light veggie soups.<br>
                                                <b>Day 2:</b> Add in gluten-free grains (e.g. brown
                                                rice)
                                                and
                                                lentils.<br>
                                                <b>Day 3:</b> Add small servings of animal products
                                                and
                                                eggs
                                                if
                                                you wish.<br><br>
                                                Don’t jump into anything too strenuous straight
                                                after
                                                your juice cleanse. It is best to see how you feel
                                                and
                                                take things at your own pace.<br><br>
                                                Please refer our Cleanse Guide to know more details.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Will I lose weight on a cleanse?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Our cleanses help with weight management and reduce
                                                water
                                                retention. While they are primarily designed for
                                                cleansing
                                                your system, you may find that the scales shift and
                                                that
                                                you
                                                lose weight as your body flushes out excess water
                                                and
                                                toxins. Cleansing on a regular basis will help to
                                                restore
                                                natural balance and enhance your shape.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            How is it different from Value Pack?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Value packs consist of juices which can be consumed
                                                anytime
                                                of the day. Whereas a cleanse is a set of 6 juices
                                                to be
                                                consumed at an interval of 2.5 hrs starting 9:00 am.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            How often should I do the cleanse?
                                        </button>
                                        <div data-content>
                                            <p>
                                                We recommend doing a 1-day cleanse once a week to
                                                help
                                                you
                                                maintain your new healthier lifestyle.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            When can I expect to see results?
                                        </button>
                                        <div data-content>
                                            <p>
                                                To reap the benefits of your cleanse, we advise you
                                                to
                                                lead
                                                a holistic and healthy lifestyle and get plenty of
                                                rest.
                                                The
                                                cleanse will help you to build immunity, boost your
                                                metabolism, reduce cravings, reduce water retention
                                                and
                                                get
                                                that radiant glow.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Do I need to refrigerate the juices?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Yes. Keep them cool. Store them in the coldest part
                                                of
                                                your
                                                refrigerator, between 0 and 4 degrees if possible.
                                                Just
                                                like
                                                milk. Kindly adjust your refrigerator temperature as
                                                per
                                                the
                                                weather as and when needed.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I get my Cleanse Pack home delivered?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Yes. Currently we Home-Deliver in Mumbai, Pune,
                                                Delhi &
                                                Bangalore.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            What time will my order get delivered?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Most of our deliveries happen between 6-9am to
                                                ensure
                                                you
                                                can start your day on a healthy note. However, at
                                                times
                                                we
                                                do delivery between 9am-6pm based on the order
                                                volume.
                                                We
                                                are happy to schedule you order as per you need,
                                                simply
                                                give
                                                us a call on +918657303303
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I buy a Cleanse from a retail store?
                                        </button>
                                        <div data-content>
                                            <p>
                                                No. However you can pick up the cleanse juices from
                                                your
                                                nearest retail store and start your detox journey.
                                                Please
                                                check our Store Locater section to find a store near
                                                you.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="multiple" data-accordion-group class="col-lg-4">
                            <div data-accordion>
                                <h5 data-control>Health Precautions </h5>
                                <div data-content>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I do the cleanse if I am nursing/pregnant/diabetic/taking medication?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Please consult your physician for advice.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Why am I running to the bathroom?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Relax. It's your body's natural response to flushing
                                                out
                                                toxins and excess water.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I have my protein shake, snacks etc while on the cleanse?
                                        </button>
                                        <div data-content>
                                            <p>
                                                We recommend you stick to a liquid diet. If you
                                                really
                                                feel the need to eat you may add some dry fruits,
                                                raw
                                                salad (no dressings!) and herbal tea.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I do a Raw cleanse if I am lactose or gluten
                                            intolerant or follow a vegan lifestyle?
                                        </button>
                                        <div data-content>
                                            <p>
                                                YES! Our juices are 100% gluten and dairy-free and
                                                completely vegetarian.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="multiple" data-accordion-group class="col-lg-4">
                            <div data-accordion>
                                <h5 data-control>How to Drink?</h5>
                                <div data-content>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I switch the order of the juices?
                                        </button>
                                        <div data-content>
                                            <p>
                                                To get the most out of your cleanse and see the best
                                                results, we recommend you follow the advice and
                                                timings
                                                provided by our experts.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            What if I am unable to finish any juice during the
                                            given
                                            time?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Try finishing each serving in the given time span of
                                                2.5
                                                hrs however do not force yourself to gulp down the
                                                juice. Breathe. Take one sip at a time.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I exercise while on a cleanse?
                                        </button>
                                        <div data-content>
                                            <p>
                                                We highly recommend Yoga as it helps to relax the
                                                mind
                                                and focus on your health goals. Avoid heavy weight
                                                lifting or going for long runs.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Who should do a 1-day cleanse?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Anyone who wants to kick-start a healthier
                                                lifestyle.
                                                Sometimes big things have small beginnings.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Who should do a 2-day or a 3-day cleanse?
                                        </button>
                                        <div data-content>
                                            <p>
                                                Someone who is already dedicated to living a healthy
                                                lifestyle and has the capacity to juice for a longer
                                                time. It’s good to challenge your body once in a
                                                while.
                                            </p>
                                        </div>
                                    </div>
                                    <div data-accordion>
                                        <button data-control>
                                            Can I buy a Cleanse from a retail store?
                                        </button>
                                        <div data-content>
                                            <p>
                                                No. However you can pick up the cleanse juices from
                                                your
                                                nearest retail store and start your detox journey.
                                                Please
                                                check our Store Locater section to find a store near
                                                you.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dvReviews" class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Reviews</h3>
                        </div>
                        <div class="col-sm-12">
                            <div class="owl-carousel">
                                <!-- <div class="owl-stage-outer"> -->
                                <!-- <div class="owl-stage"> -->
                                <div class="item">
                                    <img width="50" class="img-fluid" src="https://www.rawpressery.com/images/productreview/xallrounder_mom.jpg.pagespeed.ic.vWe61v4cSE.webp" alt="">
                                    <div class="ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <h5>AllRounder Mom</h5>
                                    <p>
                                        100% Natural Cold Pressed Juice
                                        No Added Sugar
                                        Pomegranate helps in lowering blood pressure & is stress
                                        busting.
                                        It tastes just like your eating a whole fruit so pure
                                    </p>
                                    <!-- <p class="content-black">
                                                        <b>Love it? Rate it?</b>
                                                    </p> -->
                                    <!-- <button class="btn btnPrimary">Write a Review</button> -->
                                </div>
                                <div class="item">
                                    <img width="50" class="img-fluid" src="https://www.rawpressery.com/images/productreview/xallrounder_mom.jpg.pagespeed.ic.vWe61v4cSE.webp" alt="">
                                    <div class="ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <h5>AllRounder Mom</h5>
                                    <p>
                                        100% Natural Cold Pressed Juice
                                        No Added Sugar
                                        Pomegranate helps in lowering blood pressure & is stress
                                        busting.
                                        It tastes just like your eating a whole fruit so pure
                                    </p>
                                    <!-- <p class="content-black">
                                                        <b>Love it? Rate it?</b>
                                                    </p> -->
                                    <!-- <button class="btn btnPrimary">Write a Review</button> -->
                                </div>
                                <div class="item">
                                    <img width="50" class="img-fluid" src="https://www.rawpressery.com/images/productreview/x_street_fooders_.jpg.pagespeed.ic.Vu8pRcHYyG.webp" alt="">
                                    <div class="ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <h5>AllRounder Mom</h5>
                                    <p>
                                        100% Natural Cold Pressed Juice
                                        No Added Sugar
                                        Pomegranate helps in lowering blood pressure & is stress
                                        busting.
                                        It tastes just like your eating a whole fruit so pure
                                    </p>
                                    <!-- <p class="content-black">
                                                        <b>Love it? Rate it?</b>
                                                    </p> -->
                                    <!-- <button class="btn btnPrimary">Write a Review</button> -->
                                </div>
                                <div class="item">
                                    <img width="50" class="img-fluid" src="https://www.rawpressery.com/images/productreview/x_street_fooders_.jpg.pagespeed.ic.Vu8pRcHYyG.webp" alt="">
                                    <div class="ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <h5>AllRounder Mom</h5>
                                    <p>
                                        100% Natural Cold Pressed Juice
                                        No Added Sugar
                                        Pomegranate helps in lowering blood pressure & is stress
                                        busting.
                                        It tastes just like your eating a whole fruit so pure
                                    </p>
                                    <!-- <p class="content-black">
                                                        <b>Love it? Rate it?</b>
                                                    </p> -->
                                    <!-- <button class="btn btnPrimary">Write a Review</button> -->
                                </div>
                                <div class="item">
                                    <img width="50" class="img-fluid" src="https://www.rawpressery.com/images/productreview/xallrounder_mom.jpg.pagespeed.ic.vWe61v4cSE.webp" alt="">
                                    <div class="ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <h5>AllRounder Mom</h5>
                                    <p>
                                        100% Natural Cold Pressed Juice
                                        No Added Sugar
                                        Pomegranate helps in lowering blood pressure & is stress
                                        busting.
                                        It tastes just like your eating a whole fruit so pure
                                    </p>
                                    <!-- <p class="content-black">
                                                        <b>Love it? Rate it?</b>
                                                    </p> -->
                                    <!-- <button class="btn btnPrimary">Write a Review</button> -->
                                </div>
                                <!-- </div> -->
                                <!-- </div> -->
                                <!-- <div class="owl-nav">
                            <div class="owl-prev pr5"></div>
                            <div class="owl-next pl5"></div>
                        </div>
                        <div class="owl-dots">
                            <div class="owl-dot active"><span></span></div>
                            <div class="owl-dot"><span></span></div>
                            <div class="owl-dot"><span></span></div>
                        </div> -->
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p>
                                <b>Love it? Rate it?</b>
                            </p>
                            <button class="btn btnPrimary">Write a Review</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dvBlog" class="row text-center text-lg-left">                
                <div class="col-12">
                    <h3>FROM OUR BLOG</h3>
                </div>
                <div class="col-lg-6 image">
                    <img src="<?= ASSET_URL ?>imgs/product-detail/blogImage.webp" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="text">
                        <h4>Jacqueline Fernandez hosts a morning yoga party with RAW Pressery in Dubai</h4>
                        <p>
                            This October, on a sunny morning, Dubai woke up to a riveting Yoga session with Jacqueline Fernandez and RAW Pressery.
                        </p>
                        <a href="" class="btn btnPrimary">Read More</a>
                    </div>
                </div>
                </div>
            </div>            
        </div>
    </section>
</body>

</html>