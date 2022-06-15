<div class="dvModal">
    <div id="searchModal" class="modal" style="display:none;">
        <div class="modal-content modal-md modal-lg modal-xl d-none d-md-block">
            <div class="search">
                <i class="fas fa-times-circle btn close"></i>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h5>Search Products</h5>
                        <p class="content">You can search for your favourite products here.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-sm-3 col-sm-6 text-center">
                        <form id="search_mini_form">
                            <input type="text" id="searchTxt" name="q" class="form-control" placeholder="Search here...">
                            <button class="btn btnSearch" type="submit"><i class="fas fa-search hand"></i></button>
                        </form>
                    </div>
                </div>
                               
                <div class="noRecordFound">
                     <div class="loader" id="search-loader" style="margin: 20px auto;"></div>
                     <p id="no-search">sorry no products found. try again.</p>
                </div>                

                <div class="products row" id="ajaxResult">
<!--                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="http://192.168.10.162/rawpressery/assets/imgs//product_images/thumb/almondmilks/mango-1litre.png" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-8">
                                <h6>almond milk mango</h6>
                                <p>1 Litre</p>
                                <div>
                                    <span class="deleted">
                                        <span class="strike"></span>
                                        <span class="strikePrice">
                                            <sup><i class="fas fa-rupee-sign"></i></sup>
                                            <span>240</span>
                                        </span>
                                    </span>
                                    <span class="price">
                                        <sup><i class="fas fa-rupee-sign"></i></sup>
                                        <span>360</span>
                                    </span>
                                </div>
                                <div>
                                    <span class="showPrice">
                                        <sup><i class="fas fa-rupee-sign"></i></sup>
                                        <span>360</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>