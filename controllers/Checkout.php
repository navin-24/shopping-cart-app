<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('cart_model');
        $this->load->model('address_model');
        $this->load->model('product_model');
        $this->load->model('user_model');
    }

    public function index() {
        $this->load->library('facebook'); // Will load 'login_url' from Facebook
            $this->load->library('google'); // Will load 'login_url' from Google
        
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        if ($customer_id) {
            $address_id = $this->session->userdata('address_id');
            $viewArr['customer'] = $this->user_model->getEmailEmptyOrMobile($customer_id);
            if ($address_id == null && $address_id == '') {
                $default_address = ($this->address_model->getDefultAddress() != null) ? $this->address_model->getDefultAddress() : $this->address_model->getLastAddress();
            } else {
                $default_address = ($this->address_model->getAddressDeliverHere($address_id) != null) ? $this->address_model->getAddressDeliverHere($address_id) : $this->address_model->getLastAddress();
            }
            $viewArr['city_id'] = getPincodeCity($default_address['pincode']);
             $this->session->set_userdata('address_id', $default_address['address_id']); 
             $this->getUserCartContents($customer_id);
            set_cookie('pincode_cookie', $default_address['pincode'],'2131231' /*time() + (10 * 365 * 24 * 60 * 60)*/, $_SERVER['SERVER_NAME']);
            set_cookie('entered_address', $default_address['first_name']." - ".$default_address['city']." - ".$default_address['pincode'],'2131232' /*time() + (10 * 365 * 24 * 60 * 60)*/, $_SERVER['SERVER_NAME']);
            $viewArr['set_delivery_pincode'] = $default_address['first_name']." - ".$default_address['city']." - ".$default_address['pincode'];
        }else{
            $viewArr['set_delivery_pincode'] = $_COOKIE['entered_address'];
        }
        
       

        $viewArr['default_address'] = $default_address;
        $viewArr['delivery_span'] = $this->address_model->getDeliverySpan($default_address['pincode']);
        $viewArr['delivery_window'] = $this->address_model->getDeliveryWindow($default_address['pincode']);
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        
        
        $viewArr['cartItems'] = $this->cart->contents();
/*        echo "<pre>";
        print_r($viewArr['cartItems']);
        echo "</pre>";*/
        $viewArr['discount_code'] = $this->session->userdata("cart_coupon");
        foreach ($viewArr['cartItems'] as $key => $cartItem) {
            //echo $key;
            $product_id = $cartItem['options']['product_id'];
            $option_type_id = $cartItem['options']['option_type_id'];
            $productDetails = $this->product_model->getProductDetailsById($product_id);
            $product_data[0] = $productDetails;
            $city_wise_price_data = getCityWisePrice($product_data,$viewArr['city_id'],$option_type_id);
            $productDetails = $city_wise_price_data[0];
            
            $cityIdArr = array();
                $cityResult = $this->product_model->getProductCityById($product_id);
                if ($cityResult) {
                    $cityIdArr = explode(',', $cityResult['city_ids']);
                }
            
            $viewArr['cartItems'][$key]['thumb_image_url'] = $productDetails['thumb_image_url'];
            $viewArr['cartItems'][$key]['category_name'] = $productDetails['category_name'];
            $viewArr['cartItems'][$key]['is_in_stock'] = $productDetails['is_in_stock'];
            $viewArr['cartItems'][$key]['is_active'] = $is_active = $productDetails['is_active'];
            $viewArr['cartItems'][$key]['product_url'] = $productDetails['product_url'];
            $viewArr['cartItems'][$key]['cityIdArr'] = $cityIdArr;
            $actual_price = ($productDetails['special_price']) ? (float)$productDetails['special_price'] : (float)$productDetails['base_price'];
           
            if ($actual_price> 0 && $actual_price !== $cartItem['price']) {
                $viewArr['cartItems'][$key]['subtotal'] = $actual_price * $cartItem['qty'];

                $data = array(
                    'rowid' => $cartItem['rowid'],
                    'qty' => $cartItem['qty'],
                    'price' => $actual_price
                );
                $this->cart->update($data);
            if ($this->session->userdata['cart_id']) {
                $cart_id= $this->session->userdata('cart_id');
                    $update = "UPDATE " . TABLE_CART_ITEM . " SET price_incl_tax = '" . $actual_price . "',updated_at='".date('Y-m-d H:i:s')."' WHERE cart_id = '" . $cart_id . "' AND sku = " . $cartItem['id'];
                    $this->db->query($update);
                }
            }


            if ($is_active == 0) {
                $this->cart->remove($cartItem['rowid']);
                unset($viewArr['cartItems'][$key]);
            }
        }
        $viewArr['grand_total'] = $this->cart->total();
        //print_r($viewArr);
         $viewArr['view'] = 'checkout';
        //$this->load->view('header', $viewArr);
        //$this->load->view('checkout', $data);
        $this->load->view('common', $viewArr);
    }

    function applyCoupon() {
        $coupon_code = trim(strip_tags($this->input->post('coupon_code')));

        if ($coupon_code) {
            $coupon_details = $this->cart_model->getCouponCodeDetails($coupon_code);

            if ($coupon_details) {
                $coupon_usage_details = $this->checkCouponUsage($coupon_details);
                if ($coupon_usage_details['status'] == 'success') {
                    $cart_total = $this->cart->total();
                    $discount_amount = $coupon_details['discount_amount'];
                    $total_discount_amount = ($coupon_details['discount_type'] == 'percentage') ? ($discount_amount / 100) * $cart_total : $discount_amount;
                    $cart_total_after_discount = ($cart_total - $total_discount_amount);

                    if ($cart_total_after_discount < $cart_total && $cart_total_after_discount !== 0) {
                        $cart_id = $this->session->userdata('cart_id');

                        $updateArr['grand_total'] = $updateArr['subtotal_with_discount'] = $cart_total_after_discount;
                        $updateArr['subtotal'] = $cart_total;
                        $updateArr['coupon_code'] = $coupon_code;
                        $updateArr['discount_amount'] = $total_discount_amount;
                        //print_r($updateArr);
                        $this->db->where('cart_id', $cart_id);
                        $this->db->update('cart', $updateArr);
                        

                        $_SESSION['cart_coupon'] = $data['coupon_code'] = $coupon_code;
                        $data['cart_total'] = (string)  number_format($cart_total_after_discount,2);
                        $data['discount'] = (string) number_format($total_discount_amount, 2);
                        //print_r($data);
                        echo json_encode(array('status' => 'success', 'message' => 'Coupon code applied successfully.', 'data' => $data));
                        return;
                    }
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Coupon code limit exceeded.'));
                    return;
                }
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Coupon code is not valid.'));
                return;
            }
        }
    }

    function checkCouponUsage($coupon_details) {
        $customer_id = $this->session->userdata['logged_in']['customer_id'];
        //$customer_id = 1;
        $coupon_id = $coupon_details['coupon_id'];
        $usage_per_customer = $coupon_details['usage_per_customer'];
        $coupon_usage_details = $this->cart_model->getCouponUsage($coupon_id, $customer_id);
        $times_used = 0;
        $status = 'success';
        if ($coupon_usage_details !== FALSE) {
            $times_used = $coupon_usage_details['times_used'];
            if ($times_used >= $usage_per_customer) {
                $status = 'failed';
            }
        }
        $status = (!$usage_per_customer)?'success':$status;
        $returnArr['status'] = $status;
        $returnArr['times_used'] = $times_used;
        return $returnArr;
    }

    function removeCoupon() {
        $coupon_code = trim(strip_tags($this->input->post('coupon_code')));
        $cart_id = $this->session->userdata('cart_id');
        if ($coupon_code) {
            $data['cart_total']  = $this->cart->total();
            $updateArr['grand_total'] = $updateArr['subtotal_with_discount'] = $this->cart->total();
            $updateArr['subtotal'] = $this->cart->total();
            $updateArr['coupon_code'] = '';
            $updateArr['discount_amount'] = '';
            $this->db->where('cart_id', $cart_id);
            $this->db->update('cart', $updateArr);

            echo json_encode(array('status' => 'success', 'message' => 'Coupon code has been removed.', 'data' => $data));
            $this->session->unset_userdata('cart_coupon');
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Unable to process the request. Please try after sometime.'));
        }
    }

    public function orderSummary2() {
        /* echo $this->session->userdata('discount_coupon') . "<br>";
          echo $this->session->userdata('amountAfterDiscount') . "<br>";
          exit; */

        $this->load->model('product_model');
        $discount = 0; // 5; // $this->input->get_post('discount'); // change as per your need
        $coupon_code = $this->input->get_post('coupon_code');
        $removeCouponCode = $this->input->get_post('removeCouponCode');

        $subtotalArray = array();
        $minimumDiscountPrice = 300; // change as per your need
        $cartData = [];
        $cart_items = $this->cart->contents();

        /* print_r($cart_items);
          exit; */

        foreach ($cart_items as $item) {
            $cartInnerData['item_id'] = $item['options']['product_id']; // $item['id'];
            $cartInnerData['item_name'] = $item['name'];
            $cartInnerData['item_qty'] = $item['qty'];
            $cartInnerData['item_subtotal'] = number_format($item['subtotal'], 2);
            $cartInnerData['item_varient'] = $this->product_model->getProductVarient($item['options']['product_id']);
            $cartInnerData['item_image'] = ASSET_URL . 'imgs/product_images/thumb/' . $this->product_model->getProductThumbImage($item['options']['product_id']);

            $cartData[] = $cartInnerData;
            $subtotalArray[] = $item['subtotal'];
        }

        $total = array_sum($subtotalArray);

        $data['cart_items'] = $cartData; // $cart_itmes;
        if ($total != null && $total != '') {

            $sessionSubTotal = $this->session->userdata('subtotal');
            $data['subtotal'] = number_format($total, 2);

            /* if($sessionSubTotal==null || $sessionSubTotal=='' || $sessionSubTotal==0){
              $this->session->set_userdata('subtotal', $data['subtotal']);
              } */

            $this->session->set_userdata('subtotal', $data['subtotal']);

            // $afterDiscount = ($coupon_code!=null && $coupon_code!='') ? $this->applyCouponCode($coupon_code) : $total; // $total - ($total * ($discount/100));

            if ($coupon_code != null && $coupon_code != '') {
                if ($this->applyCouponCode($coupon_code) == false) {
                    $afterDiscount = $total - ($total * ($discount / 100));
                    $msg = 'Coupon code is invalid';
                    $status = 'failed';
                } else {
                    $afterDiscount = $this->applyCouponCode($coupon_code);
                    $msg = 'Coupon code applied successfully';
                    $status = 'success';
                }
            } else {
                $afterDiscount = $total - ($total * ($discount / 100));
                $msg = 'Without coupon code';
                $status = 'success';
            }

            if ($removeCouponCode != null && $removeCouponCode != '') {
                if ($this->removeCouponCode($removeCouponCode) == true) {
                    $afterDiscount = $total - ($total * ($discount / 100));
                    $msg = 'Coupon code has been removed';
                    $status = 'success';
                } elseif ($this->removeCouponCode($removeCouponCode) == false) {
                    $afterDiscount = $this->applyCouponCode($coupon_code);
                    $msg = 'Coupon code not removed';
                    $status = 'failed';
                } else {
                    $afterDiscount = $this->applyCouponCode($coupon_code);
                    $msg = 'Request not matching for removing coupon';
                    $status = 'failed';
                }
            }

            $sessionCoupon = $this->session->userdata('discount_coupon');
            $sessionAfterDiscount = $this->session->userdata('amountAfterDiscount'); // after applying coupon

            if ($sessionCoupon != null && $sessionCoupon != '' && $total > $sessionAfterDiscount || $total < $sessionAfterDiscount) {
                $afterDiscount = $this->updateGrandTotal($total);
            }
            if ($sessionCoupon == null && $sessionAfterDiscount == null) {
                $afterDiscount = $afterDiscount;
            }

            // $afterDiscount = ($sessionAfterDiscount!=0 && $sessionAfterDiscount!=null && $sessionAfterDiscount!='') ? $sessionAfterDiscount : $afterDiscount;

            $data['discount'] = number_format(($total - $afterDiscount), 2);
            $data['delivery'] = 'Free'; // ($afterDiscount>$minimumDiscountPrice) ? 'Free' : 40;

            if (is_numeric($data['delivery'])) {
                $data['grand_total'] = ($afterDiscount + $data['delivery']);
            } else {
                $data['grand_total'] = number_format($afterDiscount, 2);
            }

            /* $sessionGrandTotal = $this->session->userdata('grand_total');

              if($sessionGrandTotal==null || $sessionGrandTotal=='' || $sessionGrandTotal==0){
              $this->session->set_userdata('grand_total', $data['grand_total']);
              } */

            $this->session->set_userdata('grand_total', $afterDiscount);
        }
        // echo json_encode($data);
        echo json_encode(array('status' => $status, 'message' => $msg, 'appliedCouponCode' => $sessionCoupon, 'data' => $data));
    }

    public function applyCouponCode($coupon_code) {
        // public function applyCouponCode(){
        $this->load->model('coupon_model');
        $subtotalArray = [];
        $code = $coupon_code; // $this->input->get_post('coupon_code');
        // $total[] = 300;

        $coupon = $this->coupon_model->couponInfo($code);
        $discount_type = $coupon['discount_type'];
        $discount = $coupon['discount_amount'];

        $cart_items = $this->cart->contents();

        foreach ($cart_items as $item) {
            $subtotalArray[] = $item['subtotal'];
        }

        $total = array_sum($subtotalArray); // array_sum($total);

        /*
          if($cart_items=='' || $cart_items==null){
          echo json_encode(array('status'=>'failed' 'message'=>'Cart empty, so coupon not apply'));
          return false;
          }
          if($coupon=='' || $coupon==null){
          echo json_encode(array('status'=>'failed', 'message'=>'Coupon code is invalid'));
          return false;
          }
         */

        if ($discount_type == 'percentage' || $discount_type == 'by_percent') {
            $afterDiscount = $total - ($total * ($discount / 100));
        }
        if ($afterDiscount >= 0 && $afterDiscount != null && $afterDiscount != '') {
            $this->session->set_userdata('discount_coupon', $coupon_code);
            $this->session->set_userdata('amountAfterDiscount', $afterDiscount);
            return $afterDiscount;
        }

        // return $afterDiscount;
        return false;
    }

    public function updateGrandTotal($cartTotal) {
        $this->load->model('coupon_model');
        $sessionCouponCode = $this->session->userdata('discount_coupon');
        $sessionAfterDiscount = $this->session->unset_userdata('amountAfterDiscount'); // UNSET Grand Total

        $coupon = $this->coupon_model->couponInfo($sessionCouponCode);
        $discount_type = $coupon['discount_type'];
        $discount = $coupon['discount_amount'];

        // if($cartTotal>$sessionAfterDiscount && $cartTotal>0 && $cartTotal!=null && $cartTotal!=''){
        if ($discount_type == 'percentage' || $discount_type == 'by_percent') {
            $afterDiscount = $cartTotal - ($cartTotal * ($discount / 100));
        }
        if ($afterDiscount >= 0 && $afterDiscount != null && $afterDiscount != '') {
            $this->session->set_userdata('amountAfterDiscount', $afterDiscount); // SET Grand Total
            return $afterDiscount;
        }
        // }
        return false;
    }

    public function removeCouponCode($coupon_code) {
        $sessionCouponCode = $this->session->userdata('discount_coupon');
        $sessionAfterDiscount = $this->session->userdata('amountAfterDiscount');

        if ($coupon_code == $sessionCouponCode) {
            $this->session->unset_userdata('discount_coupon');
            $this->session->unset_userdata('amountAfterDiscount');
            // echo json_encode(array('status'=>'success', 'message'=>'Coupon code has been removed'));
            return true;
        } else {
            // echo json_encode(array('status'=>'failed', 'message'=>'Sorry, something went wrong, please try again after sometime'));
            return false;
        }
    }

    public function placeOrder() {
        $this->load->model('common_model');
        log_message('error', print_r($_REQUEST, true));
        $dataForOrderItem = array();
        // $customer = $this->common_model->getNameEmail();

        $customerEmail = $this->session->userdata('logged_in')['email'];
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        $needEmailOrMobile = $this->common_model->needEmailOrMobile($customer_id); // What need Email or Mobile from customer
        $email_or_mobile = $this->input->get_post("email_or_mobile");
        $delivery_date = $this->input->get_post("delivery_date");
        if($delivery_date == '' || $delivery_date == null)
        {
            $delivery_date = DELIVERY_DATE;
        }
        
        $delivery_date =  date('Y-m-d H:i:s', strtotime($delivery_date));
        $delivery_instructions = $this->input->get_post("delivery_instructions");
        $customerAddressId = $this->input->get_post("customerAddressId");
        $customerAddress = $this->common_model->getCustomerAddress($customerAddressId);
        //$grandTotal = $this->session->userdata('grand_total');
        $discount_coupon = $this->session->userdata('discount_coupon');

        // $minAmountForPlaceOrder = 299; // 300;
        // $delivery_date = date('Y-m-d', strtotime("+2 days"));
        $cart_items = $this->cart->contents();
        $cartData = $this->cart_model->getCartDetails();
        $cart_id = $this->session->userdata['cart_id'];  
        $cartItemData = $this->cart_model->getCartItemDetails();
        $total_price = $qty = 0;
        $match_id = $insert_rec = $dup_sku = $updateCrtArr = array();
        foreach ($cartItemData as $cart_itm) {
            if(!in_array($cart_itm['cart_id']."-".$cart_itm['sku'], $match_id)){
                $insert_rec[] = $cart_itm;
            }
            if(array_key_exists($cart_itm['sku'],$dup_sku)){
                $dup_sku[$cart_itm['sku']]+= $cart_itm['qty'];
            }else{
                $dup_sku[$cart_itm['sku']]  = $cart_itm['qty'];
            }
            $match_id[] = $cart_itm['cart_id']."-".$cart_itm['sku'];

            $total_price += $cart_itm["qty"]*$cart_itm["price_incl_tax"];
            $qty += $cart_itm["qty"];
        }
        if($qty > $cartData['items_qty']){
            $temp_inst = $insert_rec;
            foreach ($insert_rec as $k=>$v) {
                $temp_inst[$k]['qty'] = $dup_sku[$v['sku']];
            }

            $updateCrtArr['grand_total'] = $total_price;
            if($cartData['coupon_code']!=null && $cartData['coupon_code']!=''){
                $coupon_details = $this->cart_model->getCouponCodeDetails($cartData['coupon_code']);
                $discount_amount = ($coupon_details['discount_type'] == 'percentage') ? ($coupon_details['discount_amount'] / 100) * $total_price : $coupon_details['discount_amount'];
                $updateCrtArr['discount_amount'] = $discount_amount;
                $updateCrtArr['grand_total'] = $total_price - $discount_amount;
            }
            
            $updateCrtArr['subtotal'] = $total_price;
            $updateCrtArr['items_qty'] = $qty;
            $updateCrtArr['items_count'] = count($insert_rec);
            $updateCrtArr['updated_at'] = date('Y-m-d H:i:s');
            if ($customer_id) {
                $this->db->where('customer_id', $customer_id);
            }
            $this->db->where('cart_id', $cart_id);
            $this->db->update('cart', $updateCrtArr);
            //print_r($dup_sku);die;
            $this->db->where('cart_id', $cart_id);
            $this->db->delete('cart_item');

            $this->cart_model->restoreInCartItem($temp_inst);
        }
        $cartData = $this->cart_model->getCartDetails();
        $grandTotal = $cartData['grand_total'];
        $subtotal = $cartData['subtotal'];
        
        if ($grandTotal <= MIN_AMOUNT_FOR_PLACE_ORDER) {
            echo json_encode(array('status' => 'failed', 'message' => 'Minimum cart value to check out is Rs 300, Please add more products'));
            return false;
        }

        if ($cart_items == null || $cart_items == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'cart_empty'));
            return false;
        }

        if ($needEmailOrMobile == 'Email') {
            if ($email_or_mobile == null || $email_or_mobile == '' || filter_var($email_or_mobile, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Invalid email'));
                return false;
            }
            $userExists = $this->common_model->checkEmailOrMobileAlreadyPresent($email_or_mobile); // Email exists or not
            if (strtolower($userExists) == strtolower($email_or_mobile)) {
                echo json_encode(array('status' => 'failed', 'message' => 'already_used'));
                return false;
            }

            $this->common_model->updateCustomerEmail($email_or_mobile, $customer_id);

            /* $data = array('email'=>$email_or_mobile);
              $this->updateMobileOrEmailInSession($data); // Will use this wherever possible */

            $this->updateEmailInSession($email_or_mobile);
        }

        if ($needEmailOrMobile == 'Mobile') {
            if ($email_or_mobile == null || $email_or_mobile == '' || $this->mobileValidation($email_or_mobile) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Invalid mobile'));
                return false;
            }

            $userExists = $this->common_model->checkEmailOrMobileAlreadyPresent($email_or_mobile); // Mobile exists or not
            if ($userExists == $email_or_mobile) {
                echo json_encode(array('status' => 'failed', 'message' => 'This ' . $email_or_mobile . ' is already used'));
                return false;
            }
            $this->common_model->updateCustomerMobile($email_or_mobile, $customer_id);

            /* $data = array('mobile_number'=>$email_or_mobile);
              $this->updateMobileOrEmailInSession($data); // Will use this wherever possible */

            $this->updateMobileInSession($email_or_mobile);
        }

        if ($customerAddressId == null || $customerAddressId == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Please provide delivery address'));
            return false;
        }
        else{
             $row = $this->common_model->pincodeCheck($customerAddress['pincode']);
             if($row=== FALSE)
             {
                 echo json_encode(array('status' => 'failed', 'message' => 'Uh Oh! We’re currently not able to deliver at this location'));
                 return false;
             }
        }
        
        

        if ($customerEmail == null || $customerEmail == '') {
            $customerEmail = $this->common_model->getEmail();
        }

        $session_firstname= $this->session->userdata('logged_in')['first_name'];
        $session_lastname= $this->session->userdata('logged_in')['last_name'];
        $final_firstname = ($session_firstname!='')?$session_firstname:$customerAddress['first_name'];
        $final_lastname = ($session_lastname!='')?$session_lastname:$customerAddress['last_name'];
        if($session_firstname==''){
            $this->db->where('customer_id',$customer_id);
            $this->db->update('customer', array("first_name"=>$final_firstname,"last_name"=>$final_lastname));
        }
        /* store data in order */
        $dataForOrders = array(
            'state' => 'Pending',
            'status' => 'Payment Pending',
            'customer_id' => $customer_id,
            'customer_firstname' => $final_firstname, // $customer['first_name'],
            'customer_lastname' => $final_lastname, // $customer['last_name'],
            'customer_email' => $customerEmail, // $this->session->userdata('logged_in')['email'], // $customer['email'],
            'shipping_address_id' => $customerAddressId,
            'billing_address_id' => $customerAddressId,
            'coupon_code' => $cartData['coupon_code'],
            'discount_amount' => $cartData['discount_amount'],
            'sub_total' => $subtotal,
            'grand_total' => $grandTotal,
            'remote_id' => $_SERVER['REMOTE_ADDR'],
            'delivery_date' => $delivery_date,
            'customer_comment' => $delivery_instructions,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'cart_id' => $this->session->userdata['cart_id'],
            'channel'=>$this->session->userdata('rp_channel'),
            'campaign'=>$this->session->userdata('rp_campaign')
        );

        $order_id = $this->common_model->storeInOrders($dataForOrders); // Will store in DB table orders

        //echo $this->db->last_query();die;
        if ($order_id == 0 || $order_id == null && $order_id == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, order not placed'));
            return false;
        }

        /* store data in order_address */
        $dataForOrderAddress = array(
            'order_id' => $order_id,
            'customer_address_id' => $customerAddressId,
            'customer_id' => $customer_id,
            'address' => $customerAddress['address'],
            'state' => $customerAddress['state'],
            'pincode' => $customerAddress['pincode'],
            'lastname' => $customerAddress['last_name'],
            'city' => $customerAddress['city'],
            'email' => $customerEmail, // $this->session->userdata('logged_in')['email'], // $customer['email'],
            'mobile_number' => $customerAddress['mobile_number'],
            'country' => $customerAddress['country'],
            'firstname' => $customerAddress['first_name'],
            'address_type' => $customerAddress['address_type']
        );

        $this->common_model->storeInOrderAddress($dataForOrderAddress);

        /* store data in order_item */
        foreach ($cart_items as $item) {
            $product_options = (json_encode($item['options']) == null || json_encode($item['options']) == '') ? null : json_encode($item['options']);
            $cartInnerData['order_id'] = $order_id; // $item['id'];
            $cartInnerData['product_options'] = $product_options;
            $cartInnerData['product_id'] = $item['options']['product_id']; // $item['id'];
            $cartInnerData['product_name'] = $item['name'];
            $cartInnerData['qty_ordered'] = $item['qty'];
            $cartInnerData['price'] = $item['price'];
            $cartInnerData['delivery_date'] = DELIVERY_DATE; // $delivery_date;
            $cartInnerData['created_at'] = date('Y-m-d h:i:sa');
            $cartInnerData['updated_at'] = date('Y-m-d H:i:s');
            $dataForOrderItem[] = $cartInnerData;
        }
        $orderItemUpdated = $this->common_model->storeInOrderItem($dataForOrderItem); // Will store in DB table order_item

        if ($orderItemUpdated == false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, try again after sometime'));
            return false;
        }

        //$this->cart->destroy();
        //$unsetData = array('discount_coupon', 'amountAfterDiscount', 'grand_total', 'subtotal', 'cart_id');
        //$this->session->unset_userdata($unsetData);

        $this->session->set_userdata('order_id', $order_id);
        $this->session->set_userdata('customer_address_id', $customerAddressId);

        //redirect('payment/redirect');
        echo json_encode(array('status' => 'success', 'message' => 'Thanks, your order placed successfully'));
    }

    public function mobileValidation($mobile) {
        if ((strlen($mobile) < 10) || (strlen($mobile) > 10) || (substr_count($mobile, 0) == 10)) {
            return false;
        }
        return true;
    }

    public function updateEmailInSession($email){
        if($email!=null && $email!=''){
            $sessionData = $this->session->userdata('logged_in');
            $sessionData['email'] = $email;
            $this->session->set_userdata('logged_in', $sessionData);
        }
    }

    public function updateMobileInSession($mobile_number){
        if($mobile_number!=null && $mobile_number!=''){
            $sessionData = $this->session->userdata('logged_in');
            $sessionData['mobile_number'] = $mobile_number;
            $this->session->set_userdata('logged_in', $sessionData);
        }
    }

    /*public function updateMobileInSession($mobile) {
        if ($mobile != null && $mobile != '') {
            $sessionData = $this->session->userdata('logged_in');
            $getAllData = array();
            foreach ($sessionData as $key => $val) {
                if ($key == 'mobile_number') {
                    $val = $mobile;
                }
                $getAllData[$key] = $val;
            }
            $this->session->set_userdata('logged_in', $getAllData);
        }
    }


    public function updateEmailInSession($email) {
        if ($email != null && $email != '') {
            $sessionData = $this->session->userdata('logged_in');
            $getAllData = array();
            foreach ($sessionData as $key => $val) {
                if ($key == 'email') {
                    $val = $email;
                }
                $getAllData[$key] = $val;
            }
            $this->session->set_userdata('logged_in', $getAllData);
        }
    }*/
    
    public function getStartDate() {
                $date = date('Y-m-d');
                $days = explode(',', array(1,7));
                if (!empty($days)) {
                    while(in_array(($date->toString('w', 'php')+1), $days)){
                        $date->setDay(intval($date->toString('d', 'php'))+1);
                    }
                }
    }
    
    function getUserCartContents($usrid = '') {
        if ($usrid) {
            $sql = "SELECT cart_id FROM " . TABLE_CART . " WHERE customer_id=" . $usrid . " AND is_active = 1 ORDER BY 1 DESC LIMIT 1";
            $cartDbResult = $this->db->query($sql)->row_array();
            if ($cartDbResult) {
                $cart_id = $cartDbResult['cart_id'];
                $current_cart_id = $this->session->userdata['cart_id'];
                $this->session->set_userdata('cart_id', $cartDbResult['cart_id']);

                $sql = "SELECT cart_item_id, cart_item.sku, cart_item.qty, cart_item.price_incl_tax, cart_item.product_name, cart_item.options, cart_item.cart_id FROM " . TABLE_CART_ITEM . " WHERE cart_id=" . $cart_id;
                $cartItemResult = $this->db->query($sql)->result();
                $this->insertUpdateCart($cartItemResult, $cart_id, $current_cart_id);
                if ($cart_id !== $current_cart_id) {
                    $returnData = $this->cart_model->updateCartTablesAfterLogin($current_cart_id, $cart_id);
                }
                //return $returnData;

                //}
            } else {
                $cart_id = $this->session->userdata('cart_id');
                if ($cart_id != null && $cart_id != '' && $cart_id != 0) {
                    $this->cart_model->updateCustomerIdInCart($cart_id);
                }
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    function insertUpdateCart($cartItemResult, $cart_id, $current_cart_id) {
        $skuArr=array();
        if ($cart_id == $current_cart_id) {
            $this->cart->destory();
        }
        $total = $this->cart->total_items();
        foreach ($cartItemResult as $key => $val) {
            $options = json_decode($val->options, true);
            $data = array('id' => $val->sku, 'qty' => $val->qty, 'price' => $val->price_incl_tax, 'name' => $val->product_name, 'options' => $options);
            $this->cart->insert($data);
            $skuArr[$key] = $val->sku;
        }


        if ($total > 0) {
            foreach ($this->cart->contents() as $cart_item) {
                if (in_array($cart_item['id'], $skuArr) !== FALSE) {
                    $this->db->where('cart_id', $cart_id);
                    $this->db->where('sku', $cart_item['id']);
                    $updateArr['qty'] = $updateQty = $cart_item['qty'];
                    $updateArr['updated_at'] = date('Y-m-d H:i:s');
                    $this->db->update(TABLE_CART_ITEM, $updateArr);
                } else {
                    $cartArr['cart_id'] = $cart_id;
                    $cartArr['qty'] = $cart_item['qty'];
                    $cartArr['product_id'] = $cart_item['options']['product_id'];
                    $cartArr['product_name'] = $cart_item['name'];
                    $cartArr['sku'] = $cart_item['id'];
                    $cartArr['price_incl_tax'] = $cart_item['price'];
                    $cartArr['options'] = json_encode($cart_item['options']);
                    $cartArr['created_at'] = date('Y-m-d H:i:s');
                    $cartArr['updated_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('cart_item', $cartArr);
                }
            }
            $updateCartArr['grand_total'] = $this->cart->total();
            $updateCartArr['subtotal'] = $this->cart->total();
            $updateCartArr['items_count'] = count($this->cart->contents());
            $updateCartArr['items_qty'] = $this->cart->all_item_count();
            $updateCartArr['updated_at'] = date('Y-m-d H:i:s');
            $customer_id = $this->session->userdata['logged_in']['customer_id'];

            $this->db->where('customer_id', $customer_id);

            $this->db->where('cart_id', $cart_id);
            $this->db->update('cart', $updateCartArr);
        }
    }

}

?>