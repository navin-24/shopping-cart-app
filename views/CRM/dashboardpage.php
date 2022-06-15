<section class="dvDashboard">
  <div class="container-fluid">

    <div class="row mb15 mt10">
      <div class="col-6">
        <h4>Orders</h4>
      </div>
      <div class="col-6 text-right">
        <button class="btn"><i class="fas fa-plus"></i> Create New Order</button>
      </div>
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
          <div class="d-flex mr15 mb10">
            <span class="mr5">View</span>
            <select name="" id="" class="form-control select mr5">
              <option value="">20</option>
            </select>
            <span>per page</span>
          </div> 
          <div class="d-flex mr15 mb10">
            <span class="mr5">Total</span>
            <span class="mr5"><span id="total_records"></span><!-- <?php echo $total_records; ?> --></span>
            <span class="mr5">records found</span>
          </div>
          <div class="d-flex mb10">
            <a href="">New Order RSS</a>
          </div>
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
              <button class="btn mr5">Reset Filter</button>
              <button class="btn">Search</button>
          </div> 
        </div>
      </div>
    </div>

    <div class="actions row bg-grey ptb10">
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
    </div>

    <div class="row">
      <div class="col-sm-12" style="padding:0;">
        <div class="table-responsive">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <th></th>
              <th>Order#</th>
              <th>Purchased from (store)</th>
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
              <th>
                <select name="" id="" class="form-control mr5">
                  <option value="">Any</option>
                </select> 
              </th>
              <th>
                <input type="text" class="form-control" id="getOrdersFromId" name="getOrdersFromId" value="">
              </th>
              <th>
                <select name="" id="" class="form-control mr5">
                  <option value=""></option>
                </select> 
              </th>
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="text" class="form-control input">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span>
                  <input type="text" class="form-control input">
                </div>
              </th>
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="text" class="form-control input">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span>
                  <input type="text" class="form-control input">
                </div>
              </th>
              <th>
                <input type="text" class="form-control">
              </th>
              <th>
                <input type="text" class="form-control">
              </th>
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="text" class="form-control input">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span>
                  <input type="text" class="form-control input">
                </div>
              </th>
              <th>
                <div class="d-flex justify-content-between">
                  <span>From</span>
                  <input type="text" class="form-control input">
                </div>
                <div class="d-flex justify-content-between">
                  <span>To</span>
                  <input type="text" class="form-control input">
                </div>
              </th>
              <th>
                <select name="" id="" class="form-control mr5">
                  <option value="">Any</option>
                </select> 
              </th>
              <th>
                
              </th>
            </tr>
            
          <!-- <table width="100%" cellpadding="0" cellspacing="0"> -->
            <!-- <tr class="bg-white"> -->
              <!-- <td colspan="11"> -->
                <table id="allOrders" cellpadding="0" cellspacing="0">
                  <tr>
                    <th></th>
                    <th>Order#</th>
                    <th>Purchased from (store)</th>
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
                    <th>
                      <select name="" id="" class="form-control mr5">
                        <option value="">Any</option>
                      </select> 
                    </th>
                    <th>
                      <input type="text" class="form-control">
                    </th>
                    <th>
                      <select name="" id="" class="form-control mr5">
                        <option value=""></option>
                      </select> 
                    </th>
                    <th>
                      <div class="d-flex justify-content-between">
                        <span>From</span>
                        <input type="text" class="form-control input">
                      </div>
                      <div class="d-flex justify-content-between">
                        <span>To</span>
                        <input type="text" class="form-control input">
                      </div>
                    </th>
                    <th>
                      <div class="d-flex justify-content-between">
                        <span>From</span>
                        <input type="text" class="form-control input">
                      </div>
                      <div class="d-flex justify-content-between">
                        <span>To</span>
                        <input type="text" class="form-control input">
                      </div>
                    </th>
                    <th>
                      <input type="text" class="form-control">
                    </th>
                    <th>
                      <input type="text" class="form-control">
                    </th>
                    <th>
                      <div class="d-flex justify-content-between">
                        <span>From</span>
                        <input type="text" class="form-control input">
                      </div>
                      <div class="d-flex justify-content-between">
                        <span>To</span>
                        <input type="text" class="form-control input">
                      </div>
                    </th>
                    <th>
                      <div class="d-flex justify-content-between">
                        <span>From</span>
                        <input type="text" class="form-control input">
                      </div>
                      <div class="d-flex justify-content-between">
                        <span>To</span>
                        <input type="text" class="form-control input">
                      </div>
                    </th>
                    <th>
                      <select name="" id="" class="form-control mr5">
                        <option value="">Any</option>
                      </select> 
                    </th>
                    <th>
                      
                    </th>
                  </tr>
                  
                  <tr>
                  <?php
                      if($orders!=null){
                      foreach($orders as $row){
                    ?>
                    <td class="text-center">
                      <input type="checkbox">
                    </td>
                    <td>
                      <span><?php echo $row['order_id']; ?></span>
                    </td>
                    <td>
                      <span>Main Website Store</span>
                    </td>
                    <td>
                      <span><?php echo date('d M Y', strtotime($row['created_at'])); ?></span>
                      <br>
                      <span><?php echo date('h:i:s a', strtotime($row['created_at'])); ?></span>
                    </td>
                    <td>
                      <span><?php echo date('d M Y', strtotime($row['updated_at'])); ?></span>
                      <br>
                      <span><?php echo date('h:i:s a', strtotime($row['updated_at'])); ?></span>
                    </td>
                    <td>
                      <span><?php echo $row['firstname'] .' '. $row['lastname']; ?></span>
                    </td>
                    <td>
                      <span><?php echo $row['firstname'] .' '. $row['lastname']; ?></span>
                    </td>
                    <td>
                      <span><i class="fas fa-rupee-sign"></i><?php echo number_format($row['sub_total'],2); ?></span>
                    </td>
                    <td>
                      <span><i class="fas fa-rupee-sign"></i><?php echo number_format($row['grand_total'],2); ?></span>
                    </td>
                    <td>
                      <?php echo $row['status']; ?>
                    </td>
                    <td>
                      <a href="<?php echo BASE_URL . '/CRM/order-details?order_id='.$row['order_id']; ?>">View</a>
                    </td>
                  </tr>
                      <?php
                        }
                      }else{
                      ?>
                      <tr>
                        <td colspan="11" align="center">
                          <p style="color:red;text-align:center; padding:10px 0;">Sorry no records found</p>  
                        </td>
                      </tr>  
                      <?php  
                      } 
                    ?>
                </table>
              <!-- </td> -->
            <!-- </tr> -->
            
            <tr class="bg-white"><td colspan="11"><table id="allOrders" width="100%" cellpadding="0" cellspacing="0"></table></td></tr>

            <!-- <tr class="bg-white"><td colspan="11" id="allOrders"></td></tr> -->

          </table>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
  var csrf_value = "<?php echo $this->security->get_csrf_hash(); ?>";
  var page_number = 1;
  /*var currentPaginationValue = $("#currentPaginationValue").val();;
  var totalPages = $("#total_pages").html();*/

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
      // $("#currentPaginationValue").val(1);
      // alert("Number should be in between 1 to " + totalPages);
      /*$("#prevPaginationBtn").attr('disabled',true);
      $("#NxtPaginationBtn").attr('disabled',false);*/
      errFound=true;
    }
    if(getRecords>totalPages){
      // $("#currentPaginationValue").val(totalPages);
      // alert("Number should be in between 1 to " + totalPages);
      /*$("#prevPaginationBtn").attr('disabled',false);
      $("#NxtPaginationBtn").attr('disabled',true);*/
      errFound=true;
    }

    /*alert(getRecords);*/
    
    if(errFound==false){
      getOrdersAjax(getRecords);
    }
  }

  $("#currentPaginationValue").unbind("#prevPaginationBtn,#NxtPaginationBtn").on('keypress', function(e){
    if(e.keyCode==13){
      
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
  });

  $("#getOrdersFromId").on('keypress', function(e){
    if(e.keyCode==13){
      errFound=false;
      getOrdersFromId = $("#getOrdersFromId").val();
      
      if(getOrdersFromId==null || getOrdersFromId==''){
        alert('Please provide order ID');
        errFound=true;
      }
      if(isNaN(getOrdersFromId)){
        alert('Invalid number');
        errFound=true;
      }

      if(errFound==false){
        getOrdersByIdAjax(getOrdersFromId);
      }

    }
  });

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

  function getOrdersByIdAjax(orderId){
    sendData = '&order_id='+orderId+'&csrf_test_name='+csrf_value;

    $.ajax({
      url:"<?php echo site_url(); ?>"+"CRM/getOrdersById?t="+Math.random()+sendData,
      type:"GET",
      dataType:"JSON",
      success:function(res){

        if (res.status=='failed') {
          // alert(res.message);
          orderList = '<tr>';
          orderList +=   '<td colspan="11">';
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

      }

    });
  }

  function getOrdersAjax(getRecords){
    sendData = '&page_number='+getRecords+'&csrf_test_name='+csrf_value;

    $.ajax({
      url: "<?php echo site_url(); ?>"+'CRM/getOrders?t='+Math.random()+sendData,
      type:"GET",
      dataType:"JSON",
      success: function(res){

        
        if(res.status=='failed'){
          orderList = '<tr>';
          orderList +=   '<td>';
          orderList +=     '<p style="color:red;text-align:center; padding:10px 0;">Sorry no records found</p>';  
          orderList +=   '</td>';
          orderList += '</tr>';
          // alert(res.message);
          $("#allOrders").html(orderList)
        }  

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
      month2 = months[d.getMonth()];
      fullYear2 = d2.getFullYear();
      hour2=d2.getHours();
      minute2=d2.getMinutes();
      sec2=d2.getSeconds(); 

      customerName=(data[x]['firstname']==null)?'':data[x]['firstname']+' '+ data[x]['lastname'];

      orderList += '<tr>';
      orderList +=  '<td>';
      orderList +=  '    <input type="checkbox">';
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span>#00110000'+data[x]['order_id']+/*<?php echo $row['order_id']; ?>*/'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span>Main Website Store</span>'; /*<!-- static value -->*/
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span>'+dayDate+' '+month+' '+fullYear+/*<?php echo date('d M Y', strtotime($row['created_at'])); ?>*/'</span>';
      orderList +=  '    <br>';
      orderList +=  '    <span>'+hour+':'+minute+':'+sec+/*<?php echo date('h:i:s a', strtotime($row['created_at'])); ?>*/'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span>'+dayDate2+' '+month2+' '+fullYear2+/*<?php echo date('d M Y', strtotime($row['updated_at'])); ?>*/'</span>';
      orderList +=  '    <br>';
      orderList +=  '    <span>'+hour2+':'+minute2+':'+sec2+/*<?php echo date('h:i:s a', strtotime($row['updated_at'])); ?>*/'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span>'+customerName+/*<?php echo $row['firstname'] .' '. $row['lastname']; ?>*/'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span>'+customerName+/*<?php echo $row['firstname'] .' '. $row['lastname']; ?>*/'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span><i class="fas fa-rupee-sign"></i>'+data[x]['sub_total']+/*<?php echo number_format($row['sub_total'],2); ?>*/'</span>';
      orderList +=  '  </td>';
      orderList +=  '  <td>';
      orderList +=  '    <span><i class="fas fa-rupee-sign"></i>'+data[x]['grand_total']+/*<?php echo number_format($row['grand_total'],2); ?>*/'</span>';
      orderList +=  '</td>';
      orderList +=  '<td>';
      orderList +=    data[x]['status']/*<?php echo $row['status']; ?>*/;
      orderList +=  '</td>';
      orderList +=  '<td>';
      orderList +=    '<a href="/CRM/order-details?order_id='+data[x]['status']+'">View</a>';
                      /*<a href="<?php echo BASE_URL . '/CRM/order-details?order_id='.$row['order_id']; ?>">View</a>*/
      orderList +=  '</td>';
      orderList +=  '</tr>';
    }
    $("#allOrders").html(orderList);
  }

  $("#exportCSV").on('click', function(){
    getCSVFile = $("#getCSVFile").val();
    
    if(getCSVFile=='CSV'){
      getCSVAjax();
    }

  });

  function getCSVAjax(){
    /*var url = "<?php echo site_url(); ?>" + 'CRM/getDataInCSV';
    $.ajax({
      url: url,
      type:"GET",
      dataType:"JSON",
      success:function(){
        window.open(url,'_blank');
      } 
    });*/
    window.location = "<?php echo site_url(); ?>" + 'CRM/getDataInCSV';
  }

</script>