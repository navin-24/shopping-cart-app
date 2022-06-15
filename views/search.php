<html>
    <head>
    </head>
    <body>
        <div class="search-input">
            <p>You can search for your favourite products here.</p>
            <div class="prod-srch-box">
                <form id="search_mini_form" action="" method="get">
                    <div class="search-field">
                        <input type="text"  id="searchTxt" name="q" value="" placeholder="Search here..."  class="input-text" autocomplete="off"> 
                    </div>
                    <div class="submit-field">
                        <input type="submit" class="submit-srch"  name="search" value="Search"> 
                    </div>
                </form>
            </div>
        </div>
        <div id="ajaxResult" >
        </div>
    </body>

<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
    <script>
        $(function () {
            $('#search_mini_form #searchTxt').bind("keyup paste", function (e) {
                var searchText = $.trim($(this).val().toLowerCase());
                setTimeout(function () {
                    var code = (e.keyCode || e.which);
                    console.log(code);
                    if (code != 38) {
                        searchAjaxProducts(searchText);
                    }
                }, 1000);
            });


            $('form#search_mini_form').submit(function (e) {
                e.preventDefault();
                var searchText = $.trim($('#searchTxt').val().toLowerCase());
                //if(searchText!=""){
                searchAjaxProducts(searchText);
                //}
                return false;
            });


        });

        function searchAjaxProducts(searchText) {
            var ajaxUrl = '<?php echo base_url('product/getSearchResult'); ?>';
            var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
            if (searchText == $.trim($('#search_mini_form #searchTxt').val().toLowerCase())) {
                //&& searchText!=''
                $('div#search-loader').show();
                $.ajax({
                    url: ajaxUrl,
                    type: "GET",
                    data: {q: searchText, 'csrf_test_name': csrf_value},
                    dataType: "html",
                    cache: "false",
                    success: function (data) {
                        /*$('.loading').hide();
                        $('div#ajaxResult').html(data);
                        if ($(window).width() < parseInt(767)) {
                            loadSlider();
                        }*/
                    }
                });
            }
        }
    </script>
</html>
