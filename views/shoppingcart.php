<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

        <title>CRM Dashboard - Orders</title>
        <script type="text/javascript" src="<?= ASSET_URL ?>js/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>css/datatables.min.css"/>
        <script type="text/javascript" src="<?= ASSET_URL ?>js/pdfmake.min.js"></script>
        <script type="text/javascript" src="<?= ASSET_URL ?>js//vfs_fonts.js"></script>
        <script type="text/javascript" src="<?= ASSET_URL ?>js/datatables.min.js"></script>     
        <script type="text/javascript" language="javascript" class="init">

            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                        url: "<?= BASE_URL.'/AbandonedCart/getCartItems'?>",
                        type: "POST",
                        data:{cart_id:<?= $cart_id;?>}
                    },
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true,
                    /*columnDefs: [
                     {width: 200, targets: 0}
                     ],*/

                    columns: [
                        {data: "product_id"},
                        {data: "product_name"},
                        {data: "sku"},
                        {data: "qty"},
                        {data: "price_incl_tax"},
                    ],
                    fixedColumns: true,
                    /*"columnDefs": [
                     {width: "10%", targets: 0},
                     {width: "10%", targets: 1},
                     {width: "10%", targets: 2},
                     {width: "10%", targets: 3},
                     {width: "10%", targets: 4},
                     {width: "10%", targets: 5},
                     {width: "10%", targets: 6},
                     {width: "10%", targets: 7},
                     {width: "10%", targets: 8},
                     ]*/
                });
                
                $('#example tfoot th').each(function () {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                });
                //var table = $('#example').DataTable();
                // Apply the search
                table.columns().every(function () {
                    var that = this;
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that
                                    .search(this.value)
                                    .draw();
                        }
                    });
                });
                table.buttons().container()
                        .appendTo('#example_wrapper .small-6.columns:eq(0)');
            });

        </script>
    </head>
    <body>


        <section class="dvDashboard">
            <div class="container-fluid">

                <div class="row mb15 mt10">
                    <div class="col-sm-6">
                        <h4>Abandoned Carts</h4>
                    </div>
                    <!-- <div class="col-sm-6 text-right">
                      <button class="btn"><i class="fas fa-plus"></i> Create New Order</button>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-sm-12" style="padding:0;">
                        <div class="table-responsive">
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>