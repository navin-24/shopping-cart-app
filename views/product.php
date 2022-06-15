<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Product list for Ecommerce Website</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            body {
                font-family: "Open Sans", sans-serif;
            }
            h2 {
                color: #000;
                font-size: 26px;
                font-weight: 300;
                text-align: center;
                text-transform: uppercase;
                position: relative;
                margin: 30px 0 80px;
            }
            h2 b {
                color: #ffc000;
            }
            h2::after {
                content: "";
                width: 100px;
                position: absolute;
                margin: 0 auto;
                height: 4px;
                background: rgba(0, 0, 0, 0.2);
                left: 0;
                right: 0;
                bottom: -20px;
            }
            .carousel {
                margin: 50px auto;
                padding: 0 70px;
            }
            .carousel .item {
                min-height: 330px;
                text-align: center;
                overflow: hidden;
            }
            .carousel .item .img-box {
                height: 160px;
                width: 100%;
                position: relative;
            }
            .carousel .item img {
                max-width: 100%;
                max-height: 100%;
                display: inline-block;
                position: absolute;
                bottom: 0;
                margin: 0 auto;
                left: 0;
                right: 0;
            }
            .carousel .item h4 {
                font-size: 18px;
                margin: 10px 0;
            }
            .carousel .item .btn {
                color: #333;
                border-radius: 0;
                font-size: 11px;
                text-transform: uppercase;
                font-weight: bold;
                background: none;
                border: 1px solid #ccc;
                padding: 5px 10px;
                margin-top: 5px;
                line-height: 16px;
            }
            .carousel .item .btn:hover, .carousel .item .btn:focus {
                color: #fff;
                background: #000;
                border-color: #000;
                box-shadow: none;
            }
            .carousel .item .btn i {
                font-size: 14px;
                font-weight: bold;
                margin-left: 5px;
            }
            .carousel .thumb-wrapper {
                text-align: center;
            }
            .carousel .thumb-content {
                padding: 15px;
            }
            .carousel .carousel-control {
                height: 100px;
                width: 40px;
                background: none;
                margin: auto 0;
                background: rgba(0, 0, 0, 0.2);
            }
            .carousel .carousel-control i {
                font-size: 30px;
                position: absolute;
                top: 50%;
                display: inline-block;
                margin: -16px 0 0 0;
                z-index: 5;
                left: 0;
                right: 0;
                color: rgba(0, 0, 0, 0.8);
                text-shadow: none;
                font-weight: bold;
            }
            .carousel .item-price {
                font-size: 13px;
                padding: 2px 0;
            }
            .carousel .item-price strike {
                color: #999;
                margin-right: 5px;
            }
            .carousel .item-price span {
                color: #86bd57;
                font-size: 110%;
            }
            .carousel .carousel-control.left i {
                margin-left: -3px;
            }
            .carousel .carousel-control.left i {
                margin-right: -3px;
            }
            .carousel .carousel-indicators {
                bottom: -50px;
            }
            .carousel-indicators li, .carousel-indicators li.active {
                width: 10px;
                height: 10px;
                margin: 4px;
                border-radius: 50%;
                border-color: transparent;
            }
            .carousel-indicators li {
                background: rgba(0, 0, 0, 0.2);
            }
            .carousel-indicators li.active {
                background: rgba(0, 0, 0, 0.6);
            }
            .star-rating li {
                padding: 0;
            }
            .star-rating i {
                font-size: 14px;
                color: #ffc000;
            }

            .inr-sign::before{
                content:"\20B9";
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Trending <b>Products</b></h2>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="item carousel-item active">
                                <div class="row">
                                    <?php $this->load->view($viewName); ?>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>



    </body>
</html>
<script>
    $(function () {
        
        $('input[type=radio][name=custom_price1]').change(function() {
       console.log('dsdd');
       //the changed/clicked radio
       /*let that = $(this);

           let total = that.val();
           console.log(total);
           $( '#base_price' ).text( total );*/


   });
   
    $( 'input[name="custom_price"]' ).on('click change', function () {
       //the changed/clicked radio
       let that = $(this);

           let total = that.val();
           console.log(total);
           //Set the text of the span
           $( '#base_price' ).text( total );
           $( '#special_price' ).text($(this).data("special_price"));


   } );
        $('.add_to_cart').click(function () {
            var product_id = $(this).attr("id");
            if (product_id > 0)
            {

                $.ajax({
                    url: '<?= base_url() ?>/Cart/addToCart',
                    type: 'POST',
                    data: {product_id: product_id},
                    success: function (response) {
                    }

                });
            } else
            {
                alert("lease Enter Number of Quantity");
            }
        });
    });
</script>
