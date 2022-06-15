<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Cart extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('product_model');
        $this->load->model('cart_model');
        //$this->logged_in();
    }

    private function logged_in() {
        if (!$this->session->userdata('authenticated')) {
            redirect('user/login');
        }
    }

    public function cleanseGuide() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('cleanse-guide');
        $this->load->view('footer', $viewArr);
    }

    public function cartPage() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('cart');
        $this->load->view('footer', $viewArr);
    }

    public function dashboardCustomer() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        // $this->load->view('header', $viewArr);
        $this->load->view('dashboardpage-customer');
        // $this->load->view('footer', $viewArr);
    }

    public function loginPage() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('loginNew');
        $this->load->view('footer', $viewArr);
    }

    public function checkoutPage() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('checkout-page');
        $this->load->view('footer', $viewArr);
    }

    public function addressPage() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('address-page');
        $this->load->view('footer', $viewArr);
    }

    public function accountPage() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('account-page');
        $this->load->view('footer', $viewArr);
    }

    public function shelf() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('shelf');
        $this->load->view('footer', $viewArr);
    }

    public function promo() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('promo');
        $this->load->view('footer', $viewArr);
    }

    public function bulkorder() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('bulkorder');
        $this->load->view('footer', $viewArr);
    }

    public function bulkorderform() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('bulkorderform');
        $this->load->view('footer', $viewArr);
    }

    public function thankYou() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('thankYou');
        $this->load->view('footer', $viewArr);
    }

    public function news() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('news');
        $this->load->view('footer', $viewArr);
    }

    public function contactpage() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('contactpage');
        $this->load->view('footer', $viewArr);
    }

    public function dashboardpage1() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('dashboardpage1');
        $this->load->view('footer', $viewArr);
    }

    public function dashboardpage() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('dashboardpage');
        $this->load->view('footer', $viewArr);
    }

    public function abandonedcart() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('abandonedcart');
        $this->load->view('footer', $viewArr);
    }

    public function pagenotfound() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        // $this->load->view('login');
        $this->load->view('pagenotfound');
        $this->load->view('footer', $viewArr);
    }

    function index() {

        $data = array();
        /* if (isset($_COOKIE["usercid"])) {
          $usercid = trim($_COOKIE["usercid"]);
          $data = $this->cart_model->getGuestCartDetails($usercid);
          } */

        $customer_id = $this->session->userdata['logged_in']['customer_id'];
        if ($customer_id) {
            $this->getUserCartContents($customer_id);
        }

        // Retrieve cart data from the session
        $viewArr['city_id'] = getPincodeCity($this->cookiePincode);
        $viewArr['cartItems'] = $this->cart->contents();
        if ($viewArr['cartItems']) {
            foreach ($viewArr['cartItems'] as $key => $cartItem) {
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
                $viewArr['cartItems'][$key]['category_url'] = $productDetails['category_url'];
                $viewArr['cartItems'][$key]['is_in_stock'] = $productDetails['is_in_stock'];
                $viewArr['cartItems'][$key]['is_active'] = $is_active = $productDetails['is_active'];
                $viewArr['cartItems'][$key]['product_url'] = $productDetails['product_url'];
                $viewArr['cartItems'][$key]['cityIdArr'] = $cityIdArr;
                $actual_price = ($productDetails['special_price']) ? (float) $productDetails['special_price'] : (float) $productDetails['base_price'];

                if ($actual_price > 0 && $actual_price !== $cartItem['price']) {
                    $viewArr['cartItems'][$key]['subtotal'] = $actual_price * $cartItem['qty'];

                    $cartdata = array(
                        'rowid' => $cartItem['rowid'],
                        'qty' => $cartItem['qty'],
                        'price' => $actual_price
                    );
                    $this->cart->update($cartdata);
                    if ($this->session->userdata['cart_id']) {
                        $cart_id = $this->session->userdata('cart_id');
                        $update = "UPDATE " . TABLE_CART_ITEM . " SET price_incl_tax = '" . $actual_price . "',updated_at='".date('Y-m-d H:i:s')."' WHERE cart_id = '" . $cart_id . "' AND sku = " . $cartItem['id'];
                        $this->db->query($update);
                    }
                }


                if ($is_active == 0) {
                    $this->cart->remove($cartItem['rowid']);
                    unset($viewArr['cartItems'][$key]);
                    //removeFromCartTable();
                }
            }
            $viewArr['sub_total'] = $grand_total = $this->cart->total();
            $viewArr['grand_total'] = $grand_total;
            if ($this->session->userdata('cart_id')) {
                $cart_id = $this->session->userdata('cart_id');
                $updateQry = "UPDATE " . TABLE_CART . " SET grand_total = $grand_total,updated_at='".date('Y-m-d H:i:s')."' WHERE cart_id = $cart_id";
                $this->db->query($updateQry);
            }
        }
        //print_r($viewArr);die;
        //print_r($usercid);
        // Load the cart view


        /* if ($_SESSION['cart_coupon']) {
          $coupon_code = trim($_SESSION['cart_coupon']);
          $coupon_details = $this->cart_model->getCouponCodeDetails($coupon_code);
          $viewArr['coupon_details'] = $coupon_details;
          $discount_amount = $coupon_details['discount_amount'];
          //$cart_total = $this->cart->total();
          $cart_total = $this->cart->total();
          if ($coupon_details['discount_type'] == 'percentage') {
          $total_discount_amount = ($discount_amount / 100) * $cart_total;
          if ($total_discount_amount > 0) {
          $viewArr['total_discount_amount'] = $total_discount_amount;
          $grand_total = ($cart_total - $total_discount_amount);
          }
          }
          } */


        $viewArr['view'] = 'cart/index';
        $this->load->view('common', $viewArr);
    }

    public function addToCart() {

        $optionArr['product_id'] = $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : "";
        $optionArr['option_type_id'] = $option_type_id = isset($_POST['option_value']) ? $_POST['option_value'] : "";
        $optionArr['option_name'] = isset($_POST['option_name']) ? $_POST['option_name'] : "";


        if ($product_id) {
            $quantity = (isset($_POST['quantity']) && $_POST['quantity'] > 0) ? $_POST['quantity'] : 1;
            $productDetails = $this->product_model->getProductDetailsById($product_id);
            $city_id = getPincodeCity($this->cookiePincode);
            $product_data[0] = $productDetails;
            $city_wise_price_data = getCityWisePrice($product_data,$city_id,$option_type_id);
            $productDetails = $city_wise_price_data[0];
            $product_price = ($productDetails['special_price']) ? $productDetails['special_price'] : $productDetails['base_price'];

            $optionArr['size'] = $productDetails['varient'];

            $cart_item = array(
                'id' => $productDetails['sku'],
                'qty' => $quantity,
                'price' => $product_price, // for subscription it should be special price
                'name' => $productDetails['product_name'],
                'options' => $optionArr,
            );
            //print_r($cart_item);

            /* if ($option_type_id) {
              $cart_item['options'] = array('option_type_id' => $option_type_id);
              } */

            $row_id = $this->cart->insert($cart_item);
            $data = $this->cart_model->addToCart($cart_item);
            //var_dump($s);

            $flag = 'add';

            /* if (isset($_COOKIE["usercid"])) { //guest user seond time onwards
              $flag = 'update';
              $usercid = get_cookie('usercid', TRUE);
              } else { //first time guest user
              $usercid = uniqid();
              $cookie = array(
              'name' => 'usercid',
              'value' => $usercid,
              'expire' => time() + 86500,
              'path' => '/',
              );

              set_cookie($cookie);
              } */


            //echo $flag;die;
            //$data = $this->cart_model->addToCart($cart_item, $usercid);
            //$returnArr['status'] = ($data) ? 'success' : 'failed';

            $productDetails['category'] = $this->cart_model->getProductCategory($product_id);
            $returnArr['cart_item'] = $cart_item;
            $returnArr['productDetails'] = $productDetails;
            $returnArr['status'] = 'success';
            $returnArr['quantity'] = $quantity;
            $returnArr['total_cart_item'] = $this->cart->all_item_count();
            $returnArr['row_id'] = $row_id;
            echo json_encode($returnArr);
        }
    }

    function getCookie() {
        if (isset($_COOKIE["usercid"])) { //guest user seond time onwards
            echo $usercid = get_cookie('usercid', TRUE);
            //$flag = 'update';
        } else {
            echo 'no cookie';
        }
    }

    function displayCart() {
        $this->load->view('cart/index');
    }

    function updateCart() {
        $row_id = $this->input->post('row_id');
        $quantity = $this->input->post('quantity');
        $sku = $this->input->post('sku');
        $cart_info = $this->cart->contents($row_id);
        $product_id = $cart_info[$row_id]['options']['product_id'];
        $productDetails = $this->product_model->getProductDetailsById($product_id);
        /*$city_id = getPincodeCity($this->cookiePincode);
        if (isset($city_id) && $city_id!='') {
            $product_data[0] = $productDetails;
            $city_wise_price_data = getCityWisePrice($product_data,$city_id);
            $productDetails = $city_wise_price_data[0];
        }*/
        $productDetails['category'] = $this->cart_model->getProductCategory($product_id);
        $productDetails['product_id'] = $product_id;
        $productDetails['quantity'] = $cart_info[$row_id]['qty'];

        if ($quantity > 0) {
            $data = array(
                'rowid' => $row_id,
                'qty' => $quantity
            );

            $result = $this->cart->update($data);
        } else {
            $result = $this->cart->remove($row_id);
        }

        $cart_product_info = $this->cart->contents($row_id);

        $returnArr['productDetails'] = $productDetails;
        $returnArr['line_item_price'] = number_format($cart_product_info[$row_id]['qty'] * $cart_product_info[$row_id]['price'], 2);
        $returnArr['status'] = ($result) ? 'success' : 'failed';
        $returnArr['quantity'] = $this->input->post('quantity');
        $returnArr['total_cart_item'] = $this->cart->all_item_count();
        $returnArr['cart_total'] = number_format($this->cart->total(), 2);

        $updateData['rowid'] = $row_id;
        $updateData['sku'] = $this->input->post('sku');
        $updateData['qty'] = $this->input->post('quantity');
        $this->cart_model->updateCart($updateData);

        echo json_encode($returnArr);
    }

    function applyCouponCode() {
        $coupon_code = trim(strip_tags($this->input->post('coupon_code')));
        $coupon_code = preg_replace('/[^A-Za-z0-9\-]/', '', $coupon_code);

        if ($coupon_code) {
            $coupon_details = $this->cart_model->getCouponCodeDetails($coupon_code);

            if ($coupon_details) {
                $coupon_usage_details = $this->checkCouponUsage($coupon_details);
                if ($coupon_usage_details['status'] == 'success') {
                    //echo $coupon_usage_details;
                    $conditions = $coupon_details['conditions'];
                    $this->cart_model->getCartItems($conditions);

                    $discount_amount = $coupon_details['discount_amount'];
                    $returnArr['cart_total'] = $cart_total = $this->cart->total();
                    $total_discount_amount = ($coupon_details['discount_type'] == 'percentage') ? ($discount_amount / 100) * $cart_total : $discount_amount;
                    $cart_total_after_discount = ($cart_total - $total_discount_amount);

                    if ($cart_total_after_discount < $cart_total && $cart_total_after_discount !== 0) {
                        //$_SESSION['cart_contents']['cart_total'] = $cart_total_after_discount;
                        $_SESSION['cart_coupon'] = $coupon_code;
                        $returnArr['cart_total'] = $cart_total_after_discount;
                        $returnArr['status'] = 'success';
                        $returnArr['msg'] = 'Coupon code was applied';
                        //$times_used = $coupon_usage_details['times_used'] + 1;
                        /* if($coupon_usage_details['times_used'] > 0)
                          {
                          $this->cart_model->updateCouponUsage($coupon_details['coupon_id'], 1, $times_used);
                          } */

                        //$s = $this->cart_model->insertCouponUsage($coupon_details['coupon_id'], 1, $times_used);
                    }
                } else {
                    $returnArr['status'] = 'failed';
                    $returnArr['msg'] = 'Coupon code limit exceeded.';
                }
            } else {
                $returnArr['status'] = 'failed';
                $returnArr['msg'] = 'Coupon code is not valid.';
            }
            echo json_encode($returnArr);
        }
    }

    function getCartItems() {
        $customer_id = $this->session->userdata('customer_id');
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

        $returnArr['status'] = $status;
        $returnArr['times_used'] = $times_used;
        return $returnArr;
    }

    function removeCouponCode() {
        $coupon_code = trim(strtoupper($this->input->post('coupon_code')));
        if ($coupon_code) {
            $returnArr['status'] = 'success';
            $returnArr['cart_total'] = $this->cart->total();
            $this->session->unset_userdata('cart_coupon');
        } else {
            $returnArr['status'] = 'failed';
        }

        echo json_encode($returnArr);
    }

    public function getCartRowId() {
        /* $cart_rowid = [];
          foreach($this->cart->contents() as $val){
          $cart_rowid[] = $val['rowid'];
          }
          print_r($cart_rowid); */

        $cart_rowid;
        foreach ($this->cart->contents() as $val) {
            $cart_rowid = $val['rowid'];
        }
        return $cart_rowid;
    }

    function getUserCartContents($usrid = '') {
        if ($usrid) {
            $sql = "SELECT cart_id FROM " . TABLE_CART . " WHERE customer_id=" . $usrid . " AND is_active = 1 ORDER BY 1 DESC LIMIT 1";
            $cartDbResult = $this->db->query($sql)->row_array();
            if ($cartDbResult) {
                $cart_id = $cartDbResult['cart_id'];
                //echo 'ssssssss';
                $current_cart_id = $this->session->userdata['cart_id'];

                //if ($cart_id !== $current_cart_id) {
                $this->session->set_userdata('cart_id', $cartDbResult['cart_id']);

                $sql = "SELECT cart_item_id, cart_item.sku, cart_item.qty, cart_item.price_incl_tax, cart_item.product_name, cart_item.options, cart_item.cart_id FROM " . TABLE_CART_ITEM . " WHERE cart_id=" . $cart_id;
                $cartItemResult = $this->db->query($sql)->result();
                $this->insertUpdateCart($cartItemResult, $cart_id, $current_cart_id);
                //if ($cart_id != $current_cart_id) {
                //echo 'ddddd';die;
                $returnData = $this->cart_model->updateCartTablesAfterLogin($current_cart_id, $cart_id);
                //}

                return $returnData;
                //}
            } else {
                $cart_id = $this->session->userdata('cart_id');
                if ($cart_id != null && $cart_id != '' && $cart_id != 0) {

                    $this->cart_model->updateCustomerIdInCart($cart_id);
                    /* $resultOrder = $this->cart_model->checkCartIdInOrder($cart_id);
                      if ($resultOrder !== NULL) {
                      $this->cart->destory();
                      redirect(base_url('shop/cart'));
                      } */
                }
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    function insertUpdateCart($cartItemResult, $cart_id, $current_cart_id) {

        if ($cart_id == $current_cart_id) {
            //$this->cart->destory();
        }
        $total = $this->cart->total_items();

        foreach ($cartItemResult as $key => $val) {
            $options = json_decode($val->options, true);
            //$data = array('id' => $val->sku, 'qty' => $val->qty, 'price' => $val->price_incl_tax, 'name' => $val->product_name, 'options' => $options);
            //$this->cart->insert($data);
            $skuArr[$key] = $val->sku;
            $qtyArr[$val->sku] = $val->qty;
        }

        if ($total > 0) {
            foreach ($this->cart->contents() as $cart_item) {
                if (in_array($cart_item['id'], $skuArr) !== FALSE) {
                    if ($cart_item['qty'] != $qtyArr[$cart_item['id']]) {
                        $cartdata = array(
                            'rowid' => $cart_item['rowid'],
                            'qty' => $cart_item['qty'],
                        );
                        $this->cart->update($cartdata);
                        $this->db->where('cart_id', $cart_id);
                        $this->db->where('sku', $cart_item['id']);
                        $updateArr['qty'] = $cart_item['qty'];
                        $this->db->update(TABLE_CART_ITEM, $updateArr);
                    }


                    //echo $this->db->last_query();
                } else {
                    $cartArr['cart_id'] = $cart_id;
                    $cartArr['qty'] = $cart_item['qty'];
                    $cartArr['product_id'] = $cart_item['options']['product_id'];
                    $cartArr['product_name'] = $cart_item['name'];
                    $cartArr['sku'] = $cart_item['id'];
                    $cartArr['price_incl_tax'] = $cart_item['price'];
                    $cartArr['options'] = json_encode($cart_item['options']);
                    $cartArr['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('cart_item', $cartArr);
                    //echo $this->db->last_query();
                }
            }
        }
    }

}
