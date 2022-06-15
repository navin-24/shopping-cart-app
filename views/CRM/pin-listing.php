<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?= ASSET_URL ?>imgs/favicon.png" />
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

        <title>CRM Dashboard - PinCode</title>
        <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>css/datatables.min.css"/>
        <!-- <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>css/main.css"/> -->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"></script>
        <script type="text/javascript" src="<?= ASSET_URL ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?= ASSET_URL ?>js/pdfmake.min.js"></script>
        <script type="text/javascript" src="<?= ASSET_URL ?>js//vfs_fonts.js"></script>
        <script type="text/javascript" src="<?= ASSET_URL ?>js/datatables.min.js"></script>     
        <script type="text/javascript" language="javascript" class="init">

            $(document).ready(function () {
                var msg = '<?= $msg ?>';
                var no_of_records = '<?= $inserted_records ?>';
                if(msg != ''){
                    alert(msg);
                }else if(no_of_records != ''){
                    alert("No. Of Pincodes Inserted:- "+no_of_records);
                }
                var table = $('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [[ 2, "asc" ]],
                    "pageLength": 15,
                    ajax: {
                        url: "<?= BASE_URL('AdminDashboard/getPincode'); ?>",
                        type: "POST",
                    },
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ],
                    paging: true,
                    fixedColumns: true,
                    columns: [
                        {data: "action"},
                        {data: "pincode"},
                        {data: "state"},
                        {data: "city"},
                        {data: "is_active"},
                    ],
                    "columnDefs": [
                        {
                        width: "5%",
                        targets: 0,
                        'searchable':false,
                        'orderable':false,
                        render: function (data, type, full, meta){
                            /*data = $('<div/>').text(data).html();
                            status = 1;
                            if(edited_arr!=''){
                              if (edited_arr.indexOf(data)!=-1) {
                                return '<input type="checkbox" name="id[]" value="' 
                                + $('<div/>').text(data).html() + '">';
                              }else{
                                return '<input type="checkbox" name="id[]" checked value="' 
                                + $('<div/>').text(data).html() + '">';
                              }
                            }*/
                                return '<input type="checkbox" name="id[]" value="' 
                                + $('<div/>').text(data).html() + '">';
                            }
                        },
                        {width: "10%", targets: 1},
                        {width: "10%", targets: 2},
                        {width: "10%", targets: 3},
                        {width: "10%", targets: 4},
                    ],
                });

                // Handle click on "Select all" control
               $('#example-select-all').on('click', function(){
                  // Check/uncheck all checkboxes in the table
                  var rows = table.rows({ 'search': 'applied' }).nodes();
                  $('input[type="checkbox"]', rows).prop('checked', this.checked);
               });

               // Handle click on checkbox to set state of "Select all" control
               $('#example tbody').on('change', 'input[type="checkbox"]', function(){
                  // If checkbox is not checked
                  if(!this.checked){
                     var el = $('#example-select-all').get(0);
                     // If "Select all" control is checked and has 'indeterminate' property
                     if(el && el.checked && ('indeterminate' in el)){
                        // Set visual state of "Select all" control 
                        // as 'indeterminate'
                        el.indeterminate = true;
                     }
                  }
               });
                
               $('#frm-example').on('submit', function(e){
                    var action = $("#action").val();
                    var form = this;
                    var cnt=0;
                    table.$('input[type="checkbox"]').each(function(){ 
                        if(this.checked){
                            cnt+=1;
                        } 
                    });
                    if(cnt==0){
                        alert("Please select atleast one pincode");
                        return false;
                    }else if(action=='') {
                        alert("Please Select Status: Active/InActive");
                        return false;
                    }
                });

                $('#example tfoot th').each(function () {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Search ' + title + '" / style="width:100%">');
                });

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

                $("#addPinCode").click(function(){
                    location.replace("<?= BASE_URL('AdminDashboard/addPinCode');?>");
                });
            });

        </script>

        <style>
            /*dvDashboard*/
            .dvDashboard{padding-top:0px; padding-bottom:15px; background: #fff; font-family:'Ubuntu', sans-serif;}
            .dvDashboard h4{margin:0 0 15px 0;font-weight: 200; line-height: 1; color: #000; letter-spacing: 1px; font-size: 24px;}
            /*data-tables*/
            .dvDashboard table.dataTable thead th, .dvDashboard table.dataTable thead td{padding:8px 15px; font-size:14px;border-bottom: none;}
            .dvDashboard table.dataTable tfoot th, .dvDashboard table.dataTable tfoot td { padding: 8px 15px; border-top: 1px solid #111; font-size: 14px;    border-top:none;}
            .dvDashboard .dataTables_wrapper .dataTables_info {font-size: 14px;}
            .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, 
            .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, 
            .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{background:#eee; color:#aaa !important;}
            .dvDashboard .dataTables_wrapper .dataTables_paginate .paginate_button{background:#222; color:#fff !important;}
            .dvDashboard .dataTables_wrapper .dataTables_paginate{margin-top:5px;}
            .dvDashboard button.dt-button, .dvDashboard div.dt-button, .dvDashboard a.dt-button{background:#222; color:#fff;}
            .dvDashboard .dataTables_wrapper .dataTables_filter input{padding:6px 15px;}
            .dvDashboard button.dt-button:hover:not(.disabled), 
            .dvDashboard  div.dt-button:hover:not(.disabled), 
            .dvDashboard a.dt-button:hover:not(.disabled){background:#222; color:#fff;}
            .dvDashboard button.dt-button:focus:not(.disabled), 
            .dvDashboard div.dt-button:focus:not(.disabled), 
            .dvDashboard a.dt-button:focus:not(.disabled){background:#222 !important; color:#fff !important; border: 0; text-shadow: none;}
            /*data-tables*/
            .dvDashboard h5{background: #555; color:#fff; padding:10px; font-size:14px; font-weight: 500;}
            .dvDashboard .btn{padding:0px 6px; font-size:12px; color:#fff;}
            .dvDashboard .form-control{padding:0;}
            .dvDashboard a{color:blue;}
            .dvDashboard b{font-weight: 500;}
            .dvDashboard .input{width:70px;}
            .dvDashboard i{font-size:10px;}
            .dvDashboard .mr5{margin-right:5px;}
            .dvDashboard .mb15{margin-bottom:15px;}
            .dvDashboard .mb5{margin-bottom:5px;}
            .dvDashboard .mb10{margin-bottom:10px;}
            .dvDashboard .mr15{margin-right:15px;}
            .dvDashboard .mr10{margin-right:10px;}
            .dvDashboard .ml15{margin-left:15px;}
            .dvDashboard .ml10{margin-left:10px;}
            .dvDashboard .mt10{margin-top:10px;}
            /* .dvDashboard .ptb10{padding:10px 0;} */
            .dvDashboard .select{width:100px;}
            .dvDashboard .bg-grey{background: #eee; padding:5px 0;}
            .dvDashboard .bg-dark{background: #eee; padding:2px 0;}
            .dvDashboard .bg-white{background: white; padding:2px 0;}
            /* .dvDashboard table th, .dvDashboard table td{padding:4px 6px !important; border-color:#ddd;} */
            .dvDashboard table th{background: #ddd;text-align: inherit}
            .dvDashboard table td{font-size:12px;}
            .dvDashboard table tr:nth-child(even){background: #f9f9f9;}

            /*dvMainDashboard*/
            .dvMainDashboard .bg-dark{padding:10px;}
            .dvMainDashboard .w-100{width:100%; padding:6px 12px; border-bottom: 1px solid #555;}

            .dvDashboard ul.menu{list-style-type: none; padding: 0;}
            .dvDashboard ul.menu li{display: inline-block;}
            .dvDashboard ul.menu li a{display: inline-block; background: #000; color:#fff; text-decoration: none; padding:5px 15px;}
        </style>
    </head>
    <body>

        <section class="dvDashboard">
            <div class="container-fluid">

                <div class="row mb15 mt10">
                    <div class="col-sm-12">
                        <ul class="menu">
                            <li><a href="<?= base_url('AdminDashboard/customers');?>">Customers</a></li>
                            <li><a href="<?= base_url('AbandonedCart');?>">Abandoned Cart</a></li>
                            <li><a href="<?= base_url('AdminDashboard/orders');?>">Orders</a></li>
                            <li><a href="<?= base_url('AdminDashboard/productCity');?>">Product City Mapping</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h4>Pin Code</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="padding:0;">
                        <div class="table-responsive">
                            <form id="frm-example" action="<?= BASE_URL('AdminDashboard/updatePinStatus');?>" method="POST">
                                <hr>
                                <div class="row" style="display: flex;align-items: center;">
                                    <label>Select Status:-&nbsp;&nbsp;</label><br>
                                    <select id="action" name="action">
                                        <option value=""> -Select- </option>
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>&nbsp;&nbsp;
                                    <p align="right"><button>Submit</button></p>&nbsp;&nbsp;
                                    <input type="button" id="addPinCode" value="Add New Pincode"> 
                                </div>
                                <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="select_all" value="1" id="example-select-all" /></th>
                                            <th>Pincode</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Pincode</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>