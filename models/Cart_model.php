<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Cart_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addToCart($cart_item, $user_cookie_id = '') {

        $customer_id = $this->session->userdata['logged_in']['customer_id'];
        if($customer_id) {
        $inputArr['session_id'] = ($this->session->userdata('session_id') !== NULL) ? $this->session->userdata('session_id') : '';
        $inputArr['grand_total'] = $this->cart->total();
        $inputArr['subtotal'] = $this->cart->total();
        $inputArr['items_count'] = count($this->cart->contents());

        $inputArr['customer_id'] = ($customer_id) ? $customer_id : 0;
        $inputArr['items_qty'] = $this->cart->all_item_count();
        $inputArr['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $inputArr['created_at'] = date('Y-m-d H:i:s');
        $inputArr['updated_at'] = date('Y-m-d H:i:s');

        $cart_id = $this->getCartId();
        if ($cart_id) {
            if ($customer_id) {
                $this->db->where('customer_id', $customer_id);
            } /*else {
                $this->db->where('cookie_id', $user_cookie_id);
            }*/
            $this->db->where('cart_id', $cart_id);
            $this->db->update('cart', $inputArr);
        } else {
            //$inputArr['cookie_id'] = $user_cookie_id;
            $this->db->insert('cart', $inputArr);
            $cart_id = $this->db->insert_id();
        }

        $this->session->set_userdata('cart_id', $cart_id); // Through this will update customer_id in DB table cart

        if ($this->db->affected_rows() > 0) {

            $cartArr['cart_id'] = $cart_id;
            $cartArr['qty'] = $cart_item['qty'];
            $cartArr['product_id'] = $cart_item['options']['product_id'];
            $cartArr['product_name'] = $cart_item['name'];
            $cartArr['sku'] = $cart_item['id'];
            $cartArr['price_incl_tax'] = $cart_item['price'];
            $cartArr['options'] = json_encode($cart_item['options']);
            $cartArr['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('cart_item', $cartArr);
            //echo $this->db->last_query();die;
            return true;
        } else {
            return false;
        }
        }
    }

    function updateCart($data) {
        $cart_id = $this->session->userdata['cart_id'];
        $customer_id = $this->session->userdata['logged_in']['customer_id'];

        /* $productCartData = $this->cart->get_item($data['rowid']);
          print_r($productCartData);die; */
        $sku = $data['sku'];

        if ($data['qty'] > 0) {
            $cartItemArr['qty'] = $data['qty'];
            $cartItemArr['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('cart_id', $cart_id);
            $this->db->where('sku', $sku);
            $this->db->update(TABLE_CART_ITEM, $cartItemArr);

            unset($cartItemArr);
        } else {
            $this->db->where('cart_id', $cart_id);
            $this->db->where('sku', $sku);
            $this->db->delete(TABLE_CART_ITEM);
        }

        //echo $this->db->last_query();die;


        $updateArr['grand_total'] = $this->cart->total();
        $updateArr['subtotal'] = $this->cart->total();
        $updateArr['items_count'] = count($this->cart->contents());
        $updateArr['items_qty'] = $this->cart->all_item_count();
        $updateArr['updated_at'] = date('Y-m-d H:i:s');

        if ($customer_id) {
            $this->db->where('customer_id', $customer_id);
        }

        $this->db->where('cart_id', $cart_id);
        $this->db->update('cart', $updateArr);
        unset($updateArr);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function updateCartTablesAfterLogin($current_cart_id, $cart_id) {

        $customer_id = $this->session->userdata['logged_in']['customer_id'];
        $updateArr = array();
        $cartContents = $this->cart->contents();
        if ($cartContents) {
            $this->db->trans_start();

            $updateArr['grand_total'] = $this->cart->total();
            $updateArr['subtotal'] = $this->cart->total();
            $updateArr['items_count'] = count($this->cart->contents());
            $updateArr['items_qty'] = $this->cart->all_item_count();
            $updateArr['updated_at'] = date('Y-m-d H:i:s');

            if ($customer_id) {
                $this->db->where('customer_id', $customer_id);
            }

            $this->db->where('cart_id', $cart_id);
            $this->db->update('cart', $updateArr);
            // $this->db->last_query();
            unset($updateArr);

            /*$this->db->where('cart_id', $current_cart_id);
            $this->db->delete(TABLE_CART);
            //echo $this->db->last_query();
            $this->db->where('cart_id', $current_cart_id);
            $this->db->delete(TABLE_CART_ITEM);*/
            //echo $this->db->last_query();die;
            $this->db->trans_complete();
        }

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // public function updateCustomerIdInCart($cookie_id){
    public function updateCustomerIdInCart($cart_id) {
        $loggedInCustomerId = $this->session->userdata('logged_in')['customer_id'];
        $whereCondition = array('cart_id' => $cart_id);
        $data = array('customer_id' => $loggedInCustomerId,'updated_at' => date('Y-m-d H:i:s'));

        if ($cart_id != null && $cart_id != '' && $cart_id != 0) {
            $checkCustomerId = $this->checkCustomerIdEmptyOrNot($cart_id);
            if ($checkCustomerId == null || $checkCustomerId == '' || $checkCustomerId == 0) {
                $this->db->where($whereCondition)
                        ->update('cart', $data);
            }
        }
    }

    // public function checkCustomerIdEmptyOrNot($cookie_id){
    public function checkCustomerIdEmptyOrNot($cart_id) {
        // $cart_id = $this->session->userdata('cart_id');
        // return $this->db->where(['cookie_id'=>$cookie_id])
        return $this->db->where(['cart_id' => $cart_id])
                        ->select('customer_id')
                        ->get('cart')
                        ->row()->customer_id;
    }

    public function getDBCartItems() {
        $customer_id = $this->session->userdata('logged_in')['customer_id']; // 13322;
        $cart_id = $this->session->userdata('cart_id'); // 122;

        return $this->db->where(['crt.cart_id' => $cart_id, 'crt.is_active' => 1, 'crt.customer_id' => $customer_id])
                        ->from('cart crt')
                        ->join('cart_item crti', 'crti.cart_id = crt.cart_id', 'left')
                        ->select('crti.product_id, crti.qty')
                        ->get()
                        ->result_array();
        // echo $this->db->last_query();
    }

    /* public function setCustomerIdInCart(){
      // $this->load->model('cart_model');
      if (isset($_COOKIE["usercid"])) { //guest user seond time onwards
      $cookie_id = get_cookie('usercid', TRUE);
      $this->cart_model->updateCustomerIdInCart($cookie_id);
      }
      } */

    function getCartId($user_cookie_id='') {
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        if ($customer_id) {
            $this->db->where('customer_id', $customer_id);
        } /*else {
            $this->db->where('cookie_id', $user_cookie_id);
        }*/

        $this->db->where('is_active', 1);

        $this->db->select('cart_id');
        $this->db->from('cart');
        $this->db->order_by('cart_id', 'DESC');
        $this->db->limit(1);
        $row = $this->db->get()->row();
        if (isset($row)) {
            return $row->cart_id;
        } else {
            return FALSE;
        }
    }

    function getGuestCartDetails($cookie_id) {

        if ($cookie_id) {

            $this->db->from('cart');
            $this->db->join('cart_item', 'cart.cart_id = cart_item.cart_item_id');
            $this->db->join('product', 'product.product_id = cart_item.product_id');
            $this->db->where('cart.cookie_id', $cookie_id);
            $this->db->where('product.is_active', 1);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return 0;
            }
        }
    }

    function getCouponCodeDetails($coupon_code) {
        $date = date('Y-m-d');

        $this->db->select('coupon_id, code, discount_type, discount_amount, conditions, usage_limit, usage_per_customer');
        $this->db->from('coupon');
        $this->db->where('code', $coupon_code);
        $this->db->where('is_active', 1);
        $this->db->where('from_date <=', $date);
        $this->db->where('to_date >=', $date);

        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return 0;
        }
    }

    function getCouponUsage($coupon_id, $customer_id) {

        if ($coupon_id && $customer_id) {
            $this->db->from('coupon_usage');
            $this->db->where('customer_id', $customer_id);
            $this->db->where('coupon_id', $coupon_id);

            $query = $this->db->get();
            //echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return FALSE;
            }
        }
    }

    function insertCouponUsage($coupon_id, $customer_id, $times_used) {
        $inputArr['coupon_id'] = $coupon_id;
        $inputArr['customer_id'] = $customer_id;
        $inputArr['times_used'] = $times_used;
        if ($this->db->insert('coupon_usage', $inputArr)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateCouponUsage($coupon_id, $customer_id, $times_used) {
        $update_data['times_used'] = $times_used;
        if ($this->db->update('coupon_usage', $update_data, array('coupon_id' => $coupon_id, 'customer_id' => $customer_id))) {
            return true;
        } else {
            return false;
        }
    }

    function getCartItems($conditions) {
        $customer_id = $this->session->userdata('customer_id');
        $customer_id = 1;

        $this->db->from('cart');
        $this->db->join('cart_item', 'cart.cart_id = cart_item.cart_item_id');
        $this->db->join('product', 'product.product_id = cart_item.product_id');

        $conditions = json_decode($conditions, true);
        //print_r($conditions);
        foreach ($conditions as $row) {
            $attribute = $row['attribute'];
            $operator = $row['operator'];
            $value = $row['value'];
            if ($operator == '()') {
                $where .= 'product.' . $attribute . ' IN (' . $value . ')';
            }
        }

        $this->db->where($where);
        $this->db->where('cart.customer_id', $customer_id);
        //$this->db->where('cart.session_id', $this->session->session_id);
        $this->db->where('product.is_active', 1);
        $query = $this->db->get();
        //echo $this->db->last_query();
    }

    function getProductCategory($product_id) {
        $this->db->select('category.category_id, category_name');
        $this->db->from('category');
        $this->db->join('product_category', 'product_category.category_id = category.category_id');
        $this->db->where('product_category.product_id', $product_id);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function orderIdBelongsToUser($orderId) {
        $customer_id = $this->session->userdata('logged_in')['customer_id'];

        $query = $this->db->where(['order_id' => $orderId, 'customer_id' => $customer_id])
                ->limit(1)
                ->get('orders');

        if ($query->num_rows() == 1) {
            return true;
        }
        return false;
    }

    public function getOrderItem($orderId) {
        // $orderId = 21; // $this->input->post('order_id');
        if ($orderId != null) {
            return $this->db->where(['order_item.order_id' => $orderId])
                            ->select('order_item.product_id, order_item.qty_ordered, order_item.product_options, product.product_name, product.special_price')
                            ->from('order_item')
                            ->join('product', 'order_item.product_id = product.product_id', 'left')
                            ->get()
                            ->result_array();
        }
    }

    public function updateDBcart($cart_id) {
        // $cart_id = $this->session->userdata('cart_id');
        if ($cart_id != null) {
            $grand_total = $this->cart->total();
            $items_count = count($this->cart->contents());
            $items_qty = $this->cart->all_item_count();
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $cookie_id = $this->getCookieId();
            $session_id = ($this->session->userdata('session_id') != NULL) ? $this->session->userdata('session_id') : '';
            $customer_id = $this->session->userdata('logged_in')['customer_id'];
            $updated_at = date('Y-m-d H:i:s');

            $data = array(
                'updated_at' => $updated_at,
                'items_count' => $items_count,
                'items_qty' => $items_qty,
                'cookie_id' => $cookie_id,
                'session_id' => $session_id,
                'customer_id' => $customer_id,
                'ip_address' => $ip_address,
                'updated_at' => date('Y-m-d H:i:s'),
                'grand_total' => $this->cart->total()
                    // 'subtotal'=>
            );

            /* print_r($data);
              exit; */

            $this->db->where(['cart_id' => $cart_id, 'customer_id' => $customer_id])
                    ->update('cart', $data);
            // return ($this->db->affected_rows()!=1) ? false:true;
        }
    }

    public function updateDBcartItem($cartContents, $cartId) { // Please check with database
        if ($cartId != null) {
            $currentDate = date('Y-m-d H:i:s');

            foreach ($cartContents as $row) {
                $data['cart_id'] = $cartId;
                $data['created_at'] = $currentDate;
                $data['product_id'] = $row['id']; // this will be options product_id OR just id, please confirm
                $data['product_name'] = $row['name'];
                $data['sku'] = $row['id']; // $row['options']['product_id']
                $data['qty'] = $row['qty'];
                $data['price'] = $row['price']; // $row['special_price'];
                $data['options'] = json_encode($row['options']);

                $dataForUpdate = array('qty' => $data['qty'], 'updated_at' => $currentDate);
                $cartItemExistsInDB = $this->checkCartItemAvailable($cartId, $data['product_id']);

                if ($cartItemExistsInDB > 0) {
                    $this->db->where(['cart_id' => $cartId, 'product_id' => $data['product_id']])->update('cart_item', $dataForUpdate);
                } else {
                    // if($cartItemExistsInDB==0){
                    $this->db->insert('cart_item', $data);
                }
            }
        }
    }

    public function checkCartItemAvailable($cartId, $productId) {
        return $this->db->where(['cart_id' => $cartId, 'product_id' => $productId])
                        ->get('cart_item')
                        ->num_rows();
    }

    public function insertInCart() {
        $items_count = count($this->cart->contents());
        if ($items_count != null && $items_count > 0) {
            $grand_total = $this->cart->total();
            $items_qty = $this->cart->all_item_count();
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $cookie_id = $this->getCookieId();
            $session_id = ($this->session->userdata('session_id') != NULL) ? $this->session->userdata('session_id') : '';
            $customer_id = $this->session->userdata('logged_in')['customer_id'];
            $created_at = date('Y-m-d H:i:s');

            $data = array(
                'created_at' => $created_at,
                'items_count' => $items_count,
                'items_qty' => $items_qty,
                'cookie_id' => $cookie_id,
                'session_id' => $session_id,
                'customer_id' => $customer_id,
                'ip_address' => $ip_address,
                'grand_total' => $this->cart->total()
                    // 'subtotal'=>
            );

            $this->db->insert('cart', $data);
            return $this->db->insert_id();
        }
    }

    public function insertInCartItem($data) {
        if ($data != null) {
            $this->db->insert_batch('cart_item', $data);
        }
    }

    public function cartIdMatchingWithUser($cart_id) {
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        return $this->db->where(['cart_id' => $cart_id, 'customer_id' => $customer_id])
                        ->select('cart_id')
                        ->order_by('cart_id', 'DESC')
                        ->limit(1)
                        ->get('cart')
                        ->row()
                ->cart_id;
    }

    public function getLastCartId() {
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        return $this->db->where(['customer_id' => $customer_id])
                        ->select('cart_id')
                        ->order_by('cart_id', 'DESC')
                        ->limit(1)
                        ->get('cart')
                        ->row()
                ->cart_id;
    }

    public function getCookieId() {
        $this->load->helper('cookie');

        if (isset($_COOKIE["usercid"])) {
            get_cookie('usercid', TRUE);
        } else {
            $cookie = array(
                'name' => 'usercid',
                'value' => uniqid(),
                'expire' => "86500", // time() + 86500,
                'path' => '/',
            );
            set_cookie($cookie);
        }
        return $_COOKIE["usercid"];
    }

    public function getCartDetails() {
        $cart_id = $this->session->userdata('cart_id'); // 122;
        return $this->db->where(['cart_id' => $cart_id])
                        ->select('*')
                        ->limit(1)
                        ->get('cart')
                        ->row_array();
    }

    public function getCartItemDetails() {
        $cart_id = $this->session->userdata('cart_id');
        return $this->db->where(['cart_id' => $cart_id])
                        ->from('cart_item')
                        ->select('*')
                        ->get()
                        ->result_array();
    }

    public function restoreInCartItem($data) {
        if ($data != null && $data != '') {
            if ($this->db->insert_batch('cart_item', $data)) {
                return true;
            }
            return false;
        }
    }

    public function checkCartIdInOrder($cart_id) {
        //echo $cart_id;
        return $this->db->where(['cart_id' => $cart_id])
                        ->select('order_id')
                        ->limit(1)
                        ->get('orders')
                        ->row_array();
    }

    function insertDataInCart($usrid) {
        if ($usrid) {
            $inputArr['session_id'] = ($this->session->userdata('session_id') !== NULL) ? $this->session->userdata('session_id') : '';
            $inputArr['grand_total'] = $this->cart->total();
            $inputArr['subtotal'] = $this->cart->total();
            $inputArr['items_count'] = count($this->cart->contents());
            $inputArr['customer_id'] = $usrid;

            $inputArr['items_qty'] = $this->cart->all_item_count();
            $inputArr['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $inputArr['created_at'] = date('Y-m-d H:i:s');
            $inputArr['updated_at'] = date('Y-m-d H:i:s');

            $this->db->insert('cart', $inputArr);
            $cart_id = $this->db->insert_id();

            $this->session->set_userdata('cart_id', $cart_id); // Through this will update customer_id in DB table cart

            if ($this->db->affected_rows() > 0) {
                $cartItems = $this->cart->contents();
                foreach ($cartItems as $cart_item) {
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
                //echo $this->db->last_query();die;
                return true;
            } else {
                return false;
            }
        }
    }

}
