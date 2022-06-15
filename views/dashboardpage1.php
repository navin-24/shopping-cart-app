<section class="dvDashboard dvMainDashboard">
  <div class="container-fluid">
    <div class="row mb15 mt10">

      <div class="col-lg-12">
        <h4>Dashboard</h4>
      </div>

      <div class="col-lg-2">
        <button onclick="openCity(event, 'tab1')" id="defaultOpen" class="btn d-block w-100">Information</button>
        <button onclick="openCity(event, 'tab2')" class="btn d-block w-100">Invoices</button>
        <button onclick="openCity(event, 'tab3')" class="btn d-block w-100">Credit Memos</button>
        <button onclick="openCity(event, 'tab4')" class="btn d-block w-100">Shipments</button>
        <button onclick="openCity(event, 'tab5')" class="btn d-block w-100">Comments History</button>
        <button onclick="openCity(event, 'tab6')" class="btn d-block w-100">Transactions</button>
      </div>

      <div class="col-lg-10">
        <div class="row mb10">
          <div class="col-lg-6">
            <p><b>Order #100004564</b> | 20 April 2020 11:18:12</p>
          </div>
          <div class="col-lg-6 text-right">
            <button class="btn"><i class="fa fa-angle-left"></i> Back</button>
            <button class="btn">Edit</button>
            <button class="btn">Send Email</button>
            <button class="btn">Credit Memo</button>
            <button class="btn">Hold</button>
            <button class="btn">Ship</button>
            <button class="btn">Reorder</button>
          </div>
        </div>
        <div class="row">
          <div id="tab1" class="tabcontent col-lg-12">
            <div class="row">

              <div class="col-lg-6 mb15">                
                  <h5>Order #102121654 (the order confirmation email was sent)</h5>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="bg-dark" style="min-height:170px;">
                        <div class="row">
                          <div class="col-lg-4">
                            <p><b>Order Date</b></p>
                          </div>
                          <div class="col-lg-8">
                            <p>20 Apr 2020 11:18:24</p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <p><b>Order Status</b></p>
                          </div>
                          <div class="col-lg-8">
                            <p>Processing</p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <p><b>Purchased From</b></p>
                          </div>
                          <div class="col-lg-8">
                            <p>
                                Main Website<br>
                                Main Website store<br>
                                Main Website
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <p><b>Placed from IP</b></p>
                          </div>
                          <div class="col-lg-8">
                            <p>162.158.124.14(162.158.124.14)</p>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mb15">
                <h5>Account Information</h5>               
                  <div class="row">
                    <div class="col-sm-12">
                     <div class="bg-dark" style="min-height:170px;">
                        <div class="row">                    
                          <div class="col-lg-4">
                            <p><b>Customer Name</b></p>
                          </div>
                          <div class="col-lg-8">
                            <a href="">Kausthub Prethe</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <p><b>Email</b></p>
                          </div>
                          <div class="col-lg-8">
                            <a href="">Kausthuhbwer@gail.com</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <p><b>Customer Group</b></p>
                          </div>
                          <div class="col-lg-8">
                            <p>
                                Friendship Day
                            </p>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="row">
                  <div class="col-lg-6 mb15">
                    <h5>Billing Address</h5>
                    <div class="bg-dark">                      
                      <div class="row">
                        <div class="col-lg-12">
                          <p><b>Kaustubh Pethe</b></p>
                          <p>Flat No.3, Ground Floor, Sri Lalita Co-op Housing Society, Gokhale Road, Vile Parle East. Near Hotel Shivsagar. Mumbai, Maharashtra, India, 400057.</p>
                          <p>Tel: 959595595</p>
                        </div>
                      </div>
                    </div>
                  </div>                

                  <div class="col-lg-6 mb15">
                    <h5>Shipping Address</h5>
                    <div class="bg-dark">                      
                      <div class="row">
                        <div class="col-lg-12">
                          <p><b>Kaustubh Pethe</b></p>
                          <p>Flat No.3, Ground Floor, Sri Lalita Co-op Housing Society, Gokhale Road, Vile Parle East. Near Hotel Shivsagar. Mumbai, Maharashtra, India, 400057.</p>
                          <p>Tel: 959595595</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                
              </div>

              <div class="col-lg-6 mb15">
                <h5>Customer Comment</h5>
                <div class="bg-dark">
                  <div class="row">
                    <div class="col-lg-12">                    
                        <p>Hand Delivered</p>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="col-lg-6 mb15">
                <h5>Delivery Date</h5>
                <div class="bg-dark">
                  <div class="row">
                    <div class="col-lg-12">                    
                        <p>Monday, 13 April 2020</p>                    
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mb15">
                <h5>Payment Information</h5>
                <div class="bg-dark" style="min-height:60px;">
                  <div class="row">
                    <div class="col-lg-12">
                      <p><b>Pay Online</b></p>
                      <p>Order was placed using INR.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mb15">
                <h5>Shipping &amp; Handling Information</h5>
                <div class="bg-dark" style="min-height:60px;">
                  <div class="row">
                    <div class="col-lg-12">
                      <p><b>Free Shipping</b> - Free <i class="fas fa-rupee-sign"></i> 0.00</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 mb15">
                <h5>Items Ordered</h5>
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <th>Product</th>
                      <th>Item Status</th>
                      <th>Original Price</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                      <th>Tax Amount</th>
                      <th>Tax Percent</th>
                      <th>Dicsount Amount</th>
                      <th>Row Total</th>
                    </tr>
                    <tr>
                      <td>
                        <p>Almond Milks</p>
                        <p>SKU: 102121-105123</p>
                        <p>Size: 200 ml</p>
                      </td>
                      <td>Invoiced</td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <div><span>Ordered:</span><span>4</span></div>
                        <div><span>Invoiced:</span><span>4</span></div>
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        0%
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p>Almond Milks</p>
                        <p>SKU: 102121-105123</p>
                        <p>Size: 200 ml</p>
                      </td>
                      <td>Invoiced</td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <div><span>Ordered:</span><span>4</span></div>
                        <div><span>Invoiced:</span><span>4</span></div>
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        0%
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p>Almond Milks</p>
                        <p>SKU: 102121-105123</p>
                        <p>Size: 200 ml</p>
                      </td>
                      <td>Invoiced</td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <div><span>Ordered:</span><span>4</span></div>
                        <div><span>Invoiced:</span><span>4</span></div>
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        0%
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p>Almond Milks</p>
                        <p>SKU: 102121-105123</p>
                        <p>Size: 200 ml</p>
                      </td>
                      <td>Invoiced</td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>80.00
                      </td>
                      <td>
                        <div><span>Ordered:</span><span>4</span></div>
                        <div><span>Invoiced:</span><span>4</span></div>
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        0%
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>0.00
                      </td>
                      <td>
                        <i class="fas fa-rupee-sign"></i>320.00
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="col-lg-6">
                <h5>Comments History</h5>
                <div class="bg-dark">
                  <div class="row">                      
                    <div class="col-lg-12 mb10">
                      <button class="btn">Add Order Comments</button>
                    </div>
                    <div class="col-lg-12 mb5">
                      <div class="d-flex">
                        <span class="mr5">Status</span>
                        <select name="" id="" class="form-control select mr5">
                          <option value="">Processing</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12 mb5">
                      <p>Comment</p>
                      <textarea name="" id="" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="col-lg-6 mb10">
                      <div class="d-flex flex-column">
                        <label class="d-block"><input type="checkbox">Notify Customer by Email</label>
                        <label class="d-block"><input type="checkbox">Visible on Frontend</label>
                      </div>
                    </div>
                    <div class="col-lg-6 mb10 text-right">
                      <button class="btn"><!-- <i class="fas fa-check-circle"></i> --> Submit Comment</button>
                    </div>
                    <div class="col-lg-12 mb10">
                      <p><i class="fas fa-file"></i> 20 April 2020 11:36:45 |</p>
                      <p>Customer <a href="">Notification not Applicable</a></p>
                    </div>
                    <div class="col-lg-12 mb10">
                      <p><i class="fas fa-file"></i> 20 April 2020 11:36:45 | <b>Pending Payment</b></p>
                      <p>Customer <a href="">Notification not Applicable</a></p>
                    </div>
                    <div class="col-lg-12 mb10">
                      <p><i class="fas fa-file"></i> 20 April 2020 11:36:45 | <b>Pending</b></p>
                      <p>Customer <a href="">Notification not Applicable</a></p>
                    </div>
                    <div class="col-lg-12 mb10">
                      <p><i class="fas fa-file"></i> 20 April 2020 11:36:45 |</p>
                      <p>Customer <a href="">Notified</a> <i class="fas fa-check"></i></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <h5>Order Totals</h5>
                <div class="bg-dark">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row mb5">
                        <div class="col-6">
                          <p>Subtotal</p>
                        </div>
                        <div class="col-6 text-right">
                          <p><i class="fas fa-rupee-sign"></i>996.00</p>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-6">
                          <p>Shipping &amp; Handling</p>
                        </div>
                        <div class="col-6 text-right">
                          <p><i class="fas fa-rupee-sign"></i>0.00</p>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-6">
                          <p><b>Grand Total</b></p>
                        </div>
                        <div class="col-6 text-right">
                          <p><i class="fas fa-rupee-sign"></i>996.00</p>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-6">
                          <p><b>Total Paid</b></p>
                        </div>
                        <div class="col-6 text-right">
                          <p><i class="fas fa-rupee-sign"></i>996.00</p>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-6">
                          <p><b>Total Refunded</b></p>
                        </div>
                        <div class="col-6 text-right">
                          <p><i class="fas fa-rupee-sign"></i>0.00</p>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-6">
                          <p><b>Total Due</b></p>
                        </div>
                        <div class="col-6 text-right">
                          <p><i class="fas fa-rupee-sign"></i>0.00</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                
              </div>

              </div>

            </div>
          </div>

          <div id="tab2" class="tabcontent col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                tab 2
              </div>
            </div>
          </div>

          <div id="tab3" class="tabcontent col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                tab 3
              </div>
            </div>
          </div>

          <div id="tab4" class="tabcontent col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                tab 4
              </div>
            </div>
          </div>

          <div id="tab5" class="tabcontent col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                tab 5
              </div>
            </div>
          </div>

          <div id="tab6" class="tabcontent col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                tab 6
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>







<script>
function openCity(evt, tabNumber) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabNumber).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>