<style>
  header,footer{display:none !important;}
  #ordersTable .width50px{width:50px;}
  #ordersTable tr th {max-width:100px;}
  #ordersTable table tr td {max-width:80px;}
</style>
<section class="dvDashboard">
  <div class="container-fluid">

    <div class="row mb15 mt10">
      <div class="col-6">
        <h4>Orders</h4>
      </div>
      <!-- <div class="col-6 text-right">
        <button class="btn"><i class="fas fa-plus"></i> Create New Order</button>
      </div> -->
    </div>

    <div class="records row mb15">
      <div class="col-sm-6">
        <div class="row">
          <div class="d-flex mr15 ml15 mb10">
            <span class="mr5">Page</span>
            <span class="d-flex input mr5">
              <button class="btn" onclick="getOrders('prev')" id="prevPaginationBtn"><i class="fas fa-angle-left"></i></button>
                <!-- <input type="text" class="form-control text-center" onkeypress="return getOrdersFromPaginationValue(event)" id="currentPaginationValue" value="1"> -->
                <input type="text" class="form-control text-center" id="currentPaginationValue" value="1">
              <button class="btn" onclick="getOrders('next')" id="NxtPaginationBtn"><i class="fas fa-angle-right"></i></button>
              
            </span>
            <span>of <span id="total_pages"></span> <!-- <?php echo $total_pages; ?> --> pages</span>
          </div>
          <!-- <div class="d-flex mr15 mb10">
            <span class="mr5">View</span>
            <select name="" id="" class="form-control select mr5">
              <option value="">20</option>
              <option value="30">30</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="200">200</option>
            </select>
            <span>per page</span>
          </div> 
          <div class="d-flex mr15 mb10">
            <span class="mr5">Total</span>
            <span class="mr5"><span id="total_records"></span></span>
            <span class="mr5">records found</span>
          </div> -->
          <!-- <div class="d-flex mb10">
            <a href="">New Order RSS</a>
          </div> -->
        </div>
      </div> 

      <div class="col-sm-6">
        <div class="row justify-content-end">
          <div class="d-flex mr15 mb10">
            <span class="mr5">Export to</span>
              <select name="getCSVFile" id="getCSVFile" class="form-control select mr5">
                <option value="CSV">CSV</option>
              </select>
              <button class="btn" id="exportCSV">Export</button>
          </div>
          <div class="d-flex mr15 mb10">
              <button class="btn mr5" id="resetFilter">Reset Filter</button>
              <button class="btn" id="searchData">Search</button>
          </div> 
        </div>
      </div>
    </div>

    <!-- <div class="actions row bg-grey ptb10">
      <div class="col-sm-6">
        <div class="row">
          <div class="d-flex mr15 ml15">
            <a href="" class="mr5">Select Visible | </a>
            <a href="" class="mr5">Unselect Visible | </a>
            0 items selected
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="row justify-content-end">
          <div class="d-flex mr15">
            <span class="mr5">Actions</span>
            <select name="" id="" class="form-control select mr5">
              <option value=""></option>
            </select>
            <button class="btn">Submit</button>
          </div>
        </div> 
      </div>
    </div> -->

    <!-- <input type="button" value="showModal" id="showModal"> -->
    <div class="dvModal" id="dvModal">
        <div id="modalBox" class="modal alertModal">
            <div class="modal-content modal-sm d-lg-block">
                <div class="alert">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="content" id="msgInModalBox">
                              
                              <div id="loader">
                                <img src='<?php echo ASSET_URL . 'imgs/icons/process.gif'; ?>' width='100px' height='100px'>
                              </div>

                            </p>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btnBlackBorder" id="ok_reload">OK</button>
                            <button class="btn btnBlackBorder" id="deleteOk" style="display:none;">OK</button>
                            <button class="btn btnBlackBorder" id="cancel_reload" style="display:none;">Cancel</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-sm-12" style="padding:0;">
        <div class="table-responsive">
          <table width="100%" cellpadding="0" cellspacing="0" id="ordersTable">
            <tr>
              <!-- <th></th> -->
              <th>Order#</th>
              <!-- <th>Purchased from (store)</th> -->
              <th>Purchased On</th>
              <th>Updated On</th>
              <th>Bill to Name</th>
              <th>Ship to Name</th>
              <th>G.T.(Base)</th>
              <th>G.T. (Purchased)</th>
              <th>Status</th>
              <th>Action</th>            
            </tr>
            <tr>
              <!-- <th>
                <select name="" id="" class="form-control mr5">
                  <option value="">Any</option>
                </select> 
              </th> -->
              <th>
                <input type="text" class="form-control" id="getOrdersFromId" name="getOrdersFromId" value="" style="width:50px">
              </th>
              <!-- <th>
                <select name="" id="" class="form-control mr5">
                  <option value=""></option>
                </select> 
              </th> -->
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="date" class="form-control input" id="purchased_from" name="purchased_from" value="" placeholder="dd/mm/yy">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span><br>
                  <input type="date" class="form-control input" id="purchased_to" name="purchased_to" value="" placeholder="dd/mm/yy">
                </div>
              </th>
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="date" class="form-control input" id="updated_from" name="updated_from" value="" placeholder="dd/mm/yy">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span>
                  <input type="date" class="form-control input" id="updated_to" name="updated_to" value="" placeholder="dd/mm/yy">
                </div>
              </th>
              <th>
                <input type="text" class="form-control" id="bill_to_name" name="bill_to_name" value="">
              </th>
              <th>
                <input type="text" class="form-control" id="ship_to_name" name="ship_to_name" value="">
              </th>
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="text" class="form-control input" id="gt_base_from" name="gt_base_from" value="">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span>
                  <input type="text" class="form-control input" id="gt_base_to" name="gt_base_to" value="">
                </div>
              </th>
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="text" class="form-control input" id="gt_purchased_from" name="gt_purchased_from" value="">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span>
                  <input type="text" class="form-control input" id="gt_purchased_to" name="gt_purchased_to" value="">
                </div>
              </th>
              <th>
                <select name="filter_order_status" id="filter_order_status" class="form-control mr5">
                  <option value=""></option>
                  <option value="Canceled">Canceled</option>
                  <option value="Processing">Processing</option>
                  <option value="Pending">Pending</option>
                </select> 
              </th>
              <th>
                
              </th>
            </tr>
            
            <tr>
              <td colspan="9">
                <table id="allOrders" width="100%" cellpadding="0" cellspacing="0">  
                </table>
              </td>
            </tr>

          </table>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
  var csrf_value = "<?php echo $this->security->get_csrf_hash(); ?>";
  var page_number = 1;

  $("#showModal").on('click', function(){
    $("#modalBox").show();
  });

  function getOrders(record_type){
    errFound = false;
    getRecords=0;
    totalPages = $("#total_pages").html();
    currentPaginationValue = $("#currentPaginationValue").val();
    
    if(record_type=='prev'){
      getRecords = (parseInt(currentPaginationValue)-1);
    }
    if(record_type=='next'){
      getRecords = (parseInt(currentPaginationValue)+1);
    }
    if(getRecords<1){
      errFound=true;
    }
    if(getRecords>totalPages){
      errFound=true;
    }

    if(errFound==false){
      getOrdersAjax(getRecords);
    }
  }

  $("#currentPaginationValue").unbind("#prevPaginationBtn,#NxtPaginationBtn").on('keypress', function(e){
    if(e.keyCode==13){
      getPaginationRecords();
    }
  });

  function getPaginationRecords(){
    errFound = false;
    totalPages = $("#total_pages").html();
    getRecords = $("#currentPaginationValue").val();
    
    if(getRecords<1){
      alert("Number should be in between 1 to " + totalPages);
      diabledNxtPrevBTN();
      errFound=true;
    }
    if(getRecords>totalPages){
      alert("Number should be in between 1 to " + totalPages);
      diabledNxtPrevBTN();
      errFound=true;
    }

    if(errFound==false){
      getOrdersAjax(getRecords);
    }
  }

  // $("#searchData").unbind('click,keypress').on("click", function(){
  $("#searchData").on("click", function(){
      inputFielsForSearch();
  });

  function inputFielsForSearch(){
    noPagination = true;
    // alert($("#getOrdersFromId").val());
    if($("#getOrdersFromId").val()!=''){
      getOrdersFromId2();
      noPagination=false;
    }
    if($("#purchased_from").val()!='' || $("#purchased_to").val()!=''){
      purchasedFromTo();
      noPagination=false;
    }
    if($("#updated_from").val()!='' || $("#updated_from").val()!=''){
      updatedFromTo();
      noPagination=false; 
    }
    if($("#bill_to_name").val()!='' || $("#ship_to_name").val()!=''){
      billOrShipToName();
      noPagination=false;  
    }
    if($("#gt_base_from").val()!='' || $("#gt_base_to").val()!=''){
      gtBaseFromTo();
      noPagination=false;
    }
    if($("#gt_purchased_from").val()!='' || $("#gt_purchased_to").val()!=''){
      gtPurchasedFromTo();
      noPagination=false;
    }
    if($("#filter_order_status").val()!=''){
      filterOrderStatus();
      noPagination=false;
    }
    if($("#currentPaginationValue").val()!='' && noPagination==true){
      getPaginationRecords();
    }
  }


  $("#getOrdersFromId").on('keypress', function(e){
    if(e.keyCode==13){
      getOrdersFromId2();  
    }
  });

  function getOrdersFromId2(){
    // errFound=false;
    getOrdersFromId = $("#getOrdersFromId").val();
    /*if(getOrdersFromId==null || getOrdersFromId==''){
      alert('Please provide order ID');
      errFound=true;
    }
    if(isNaN(getOrdersFromId)){
      alert('Invalid number');
      errFound=true;
    }
    if(errFound==false){*/
      data = {order_id:getOrdersFromId,'csrf_test_name':csrf_value};
      url = "CRM/getOrdersById";
      getOrdersBySearch(data,url);
    // }
  }

  function diabledNxtPrevBTN(){
    $("#prevPaginationBtn").attr('disabled',true);
    $("#NxtPaginationBtn").attr('disabled',true);
  }
  function prevPaginationBtnActive(){
    $("#prevPaginationBtn").attr('disabled',false);
    $("#NxtPaginationBtn").attr('disabled',true);
  }
  function nxtPaginationBtnActive(){
    $("#prevPaginationBtn").attr('disabled',true);
    $("#NxtPaginationBtn").attr('disabled',false);
  }

  $("#resetFilter").on('click',function(){
    $("#getOrdersFromId,#purchased_from,#purchased_to,#updated_from,#updated_to,#bill_to_name,#ship_to_name,#gt_base_from,#gt_base_to,#gt_purchased_from,#gt_purchased_to,#filter_order_status").val("");
    getOrdersAjax(page_number);
  });

  $("#purchased_from,#purchased_to").on('keypress', function(e){
    if(e.keyCode==13){
      purchased_from = $("#purchased_from").val();
      purchased_to = $("#purchased_to").val();
      if(purchased_from=='' && purchased_to==''){
        inputFielsForSearch();
      }else{
        purchasedFromTo();  
      }
    }
  });

  function purchasedFromTo(){
    purchased_from = $("#purchased_from").val();
    purchased_to = $("#purchased_to").val();
    data = {purchased_from:purchased_from,purchased_to:purchased_to,'csrf_test_name':csrf_value};
    url="CRM/getOrdersByPurchasedOn";
    getOrdersBySearch(data,url);
  }

  $("#updated_from,#updated_to").on('keypress', function(e){
    if(e.keyCode==13){
      updated_from = $("#updated_from").val();
      updated_to = $("#updated_to").val();
      if(updated_from=='' && updated_to==''){
        inputFielsForSearch();
      }else{
        updatedFromTo();
      }
    }
  });

  function updatedFromTo(){ // Call this function in the above Search button
      updated_from = $("#updated_from").val();
      updated_to = $("#updated_to").val();
      data = {updated_from:updated_from,updated_to:updated_to,'csrf_test_name':csrf_value};
      url = "CRM/getOrdersByUpdatedOn";
      getOrdersBySearch(data,url);
  }

  $("#bill_to_name,#ship_to_name").on('keypress', function(e){
    if(e.keyCode==13){
      customer_name = inputFieldsForBillAndShip();
      if(customer_name==''){
        inputFielsForSearch();
      }else{
        billOrShipToName();
      }
    }
  });

  function billOrShipToName(){
    customer_name = inputFieldsForBillAndShip();
    data = {customer_name:customer_name,'csrf_test_name':csrf_value};
    url = "CRM/getOrdersByBillOrShipToName"; 
    getOrdersBySearch(data,url);
  }

  function inputFieldsForBillAndShip(){
    customer_name = '';
    if($("#bill_to_name").val()!=''){
      customer_name = $("#bill_to_name").val();  
    }
    if($("#ship_to_name").val()!=''){
      customer_name = $("#ship_to_name").val();  
    }
    return customer_name;
  }

  $("#gt_base_from,#gt_base_to").on('keypress', function(e){
    if(e.keyCode==13){
      gt_base_from = $("#gt_base_from").val();
      gt_base_to = $("#gt_base_to").val();
      if(gt_base_from=='' && gt_base_to==''){
        inputFielsForSearch();
      }else{
        gtBaseFromTo();  
      }
    }
  });

  function gtBaseFromTo(){
    gt_base_from = $("#gt_base_from").val();
    gt_base_to = $("#gt_base_to").val();
    data = {gt_base_from:gt_base_from,gt_base_to:gt_base_to,'csrf_test_name':csrf_value};
    url = "CRM/getOrdersGT_Base";
    getOrdersBySearch(data,url);
  }

  $("#gt_purchased_from,#gt_purchased_to").on('keypress', function(e){
    if(e.keyCode==13){
      gt_purchased_from = $("#gt_purchased_from").val();
      gt_purchased_to = $("#gt_purchased_to").val();
      if(gt_purchased_from=='' && gt_purchased_to==''){
        inputFielsForSearch();
      }else{
        gtPurchasedFromTo();  
      }
    }
  });

  function gtPurchasedFromTo(){
    gt_purchased_from = $("#gt_purchased_from").val();
    gt_purchased_to = $("#gt_purchased_to").val();
    data = {gt_purchased_from:gt_purchased_from,gt_purchased_to:gt_purchased_to,'csrf_test_name':csrf_value};
    url = "CRM/getOrdersGT_Purchased";
    getOrdersBySearch(data,url);
  }

  /*$("#filter_order_status").on('change', function(){
      filterOrderStatus();
  });*/

  function filterOrderStatus(){
    order_status = $("#filter_order_status").val();
    // if(order_status!=null){
      data = {order_status:order_status,'csrf_test_name':csrf_value};
      url = "CRM/getOrdersThroughStatus";
      getOrdersBySearch(data,url);
    // }
  }
    
  function getOrdersBySearch(sendData,url){
    $.ajax({
      url:"<?php echo site_url(); ?>"+url,
      type:"POST",
      data:sendData,
      /*beforeSend:function(){
          setTimeout($("#modalBox").show(), 3000);
      },*/
      dataType:"JSON",
      timeout:3000,
      success:function(res){
        // $("#modalBox").hide();
        if (res.status=='failed') {
          // alert(res.message);
          orderList = '<tr>';
          orderList +=   '<td colspan="9">';
          orderList +=     '<p style="color:red;text-align:center !important;padding:10px 0;">Sorry no records found</p>';  
          orderList +=   '</td>';
          orderList += '</tr>';
          $("#allOrders").html(orderList);
        } else if (res.status=='success') {
          orders = res.data.orders;
          allOrderList(orders);
        } else {
          // alert('Something went wrong');
        }
        $("#prevPaginationBtn,#NxtPaginationBtn,#currentPaginationValue").attr('disabled',true);
      }/*,
      complete:function(data){
        // Hide image container
        setTimeout($("#modalBox").hide(), 5000);
      }*/
    });
  }

  function getOrdersAjax(page_number){
    sendData = '&page_number='+page_number+'&csrf_test_name='+csrf_value;
    $.ajax({
      url: "<?php echo site_url(); ?>"+'CRM/getOrders?t='+Math.random()+sendData,
      type:"GET",
      dataType:"JSON",
      success: function(res){

        if(res.status=='failed'){
          orderList = '<tr>';
          orderList +=   '<td colspan="9">';
          orderList +=     '<p style="color:red;text-align:center; padding:10px 0;">Sorry no records found</p>';  
          orderList +=   '</td>';
          orderList += '</tr>';
          // alert(res.message);
          $("#allOrders").html(orderList)
        } 

        // alert(orderList)
        $("#prevPaginationBtn,#NxtPaginationBtn,#currentPaginationValue").attr('disabled',false);
        $("#currentPaginationValue").prop("value", res.data.currentPaginationValue);
        $("#total_pages").html(res.data.total_pages);
        $("#total_records").html(res.data.total_records);
        
        orders = res.data.orders;
        allOrderList(orders);

        if($("#currentPaginationValue").val()==1){
          nxtPaginationBtnActive();
        }
        if($("#currentPaginationValue").val()==res.data.total_pages){
          prevPaginationBtnActive();
        }

      }
    });
  }

  getOrdersAjax(page_number);

  function allOrderList(data){

    orderList = '';
    for(x in data){

      d = new Date(data[x]['created_at']);
      dayDate = d.getDate();
      months = ["Jan", "Feb", "Mar", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
      month = months[d.getMonth()];
      fullYear = d.getFullYear();
      hour=d.getHours();
      minute=d.getMinutes();
      sec=d.getSeconds();

      d2 = new Date(data[x]['updated_at']);
      dayDate2 = d2.getDate();
      months2 = ["Jan", "Feb", "Mar", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
      month2 = months[d2.getMonth()];
      fullYear2 = d2.getFullYear();
      hour2=d2.getHours();
      minute2=d2.getMinutes();
      sec2=d2.getSeconds(); 

      customerName=(data[x]['firstname']==null)?'':data[x]['firstname']+' '+ data[x]['lastname'];

      subTotal = currencyFormat(data[x]['sub_total']);
      grandTotal = currencyFormat(data[x]['grand_total']);

      orderList += '<tr class="bg-white">';
      /*orderList +=  '<td class="text-center">';
      orderList +=  '    <input type="checkbox">';
      orderList +=  '  </td>';*/
      orderList +=  '  <td style="width:50px;">';
      orderList +=  '    <span>'+data[x]['order_id']+'</span>';
      orderList +=  '  </td>';
      /*orderList +=  '  <td>';
      orderList +=  '    <span>Main Website Store</span>';
      orderList +=  '  </td>';*/
      orderList +=  '  <td style="width:100px;">';
      orderList +=  '    <span>'+dayDate+' '+month+' '+fullYear+'</span>';
      orderList +=  '    <br>';
      orderList +=  '    <span>'+hour+':'+minute+':'+sec+'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td style="width:100px;">';
      orderList +=  '    <span>'+dayDate2+' '+month2+' '+fullYear2+'</span>';
      orderList +=  '    <br>';
      orderList +=  '    <span>'+hour2+':'+minute2+':'+sec2+'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td style="width:100px;">';
      orderList +=  '    <span>'+customerName+'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td style="width:100px;">';
      orderList +=  '    <span>'+customerName+'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td style="width:100px;">';
      // orderList +=  '    <span><i class="fas fa-rupee-sign"></i>'+data[x]['sub_total']+'</span>';
      orderList +=  '    <span><i class="fas fa-rupee-sign"></i>'+subTotal+'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td style="width:100px;">';
      // orderList +=  '    <span><i class="fas fa-rupee-sign"></i>'+data[x]['grand_total']+'</span>';
      orderList +=  '    <span><i class="fas fa-rupee-sign"></i>'+grandTotal+'</span>';
      orderList +=  '</td>';
      orderList +=  '<td style="width:100px;">';
      orderList +=    data[x]['status'];
      orderList +=  '</td>';
      orderList +=  '<td style="width:50px;">';
      orderList +=    '<a href="<?php echo site_url(); ?>crm/order-details?order_id='+data[x]['order_id']+'">View</a>';
      orderList +=  '</td>';
      orderList +=  '</tr>';
    }
    $("#allOrders").html(orderList);
  }

  function currencyFormat(num) {
    return parseFloat(num).toFixed(2);
  }

  $("#exportCSV").on('click', function(){
    getCSVFile = $("#getCSVFile").val();
    if(getCSVFile=='CSV'){
      // getCSVAjax();
      window.location = "<?php echo site_url(); ?>" + 'CRM/getDataInCSV';
    }
  });

  /*function getCSVAjax(){*/
    /*var url = "<?php echo site_url(); ?>" + 'CRM/getDataInCSV';
    $.ajax({
      url: url,
      type:"GET",
      dataType:"JSON",
      success:function(){
        window.open(url,'_blank');
      } 
    });*/
    /*window.location = "<?php echo site_url(); ?>" + 'CRM/getDataInCSV';
  }*/

</script>