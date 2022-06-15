<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 
     * @param int $pincode
     * @return boolean
     */
    function pincodeCheck($pincode, $city = '') {
        if ($pincode !== '') {
            $this->db->where(['pincode'=>$pincode,'is_active'=>'1']);
        } else {
            $this->db->where(['city'=>$city,'is_active'=>'1']);
        }
        $this->db->limit(1);
        $query = $this->db->get('pincode');

        //echo $this->db->last_query();die;
        if ($query->num_rows() == 1) {
            return true;
        }

        return false;
    }

    function insertNoServicePincode($inputArr) {
        $this->db->insert('no_delivery_zone', $inputArr);
    }

    public function checkEmailOrMobileAlreadyPresent($emailOrMobile) {
        if (is_numeric($emailOrMobile)) { // return email
            return $this->db->where(['mobile_number' => $emailOrMobile])
                            ->get('customer')
                            ->row()->mobile_number;
        } else { // return mobile
            return $this->db->where(['email' => $emailOrMobile])
                            ->get('customer')
                            ->row()->email;
        }
    }

    public function needEmailOrMobile($customer_id) {
        $row = $this->db->where(['customer_id' => $customer_id])->select('email,mobile_number')->get('customer')->row_array();

        if ($row['email'] == null && $row['email'] == '') {
            return 'Email';
        }
        if ($row['mobile_number'] == null && $row['mobile_number'] == '') {
            return 'Mobile';
        }
    }

    public function updateCustomerEmail($email, $customer_id) {
        $data = array('email' => $email,'updated_at' => date('Y-m-d H:i:s'));
        $this->db->where(['customer_id' => $customer_id])
                ->update('customer', $data);
    }

    public function updateCustomerMobile($mobile, $customer_id) {
        $data = array('mobile_number' => $mobile,'updated_at' => date('Y-m-d H:i:s'));
        $this->db->where(['customer_id' => $customer_id])
                ->update('customer', $data);
    }

    public function storeInOrders($data) {
        if ($data != null && $data != '') {
            $this->db->insert('orders', $data);
            return $this->db->insert_id();
        }
    }

    public function storeInOrderItem($data) {
        if ($data != null && $data != '') {
            if ($this->db->insert_batch('order_item', $data)) {
                return true;
            }
            return false;
        }
    }

    public function getNameEmail() {
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        return $this->db->where(['customer_id' => $customer_id])->select('first_name, last_name, email')->get('customer')->row_array();
    }

    public function getEmail() {
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        return $this->db->where(['customer_id' => $customer_id])->select('email')->get('customer')->row()->email;
    }

    public function getCustomerAddress($address_id) {
        return $this->db->where(['address_id' => $address_id, 'is_active' => 1])
                        ->select('mobile_number,state,pincode,last_name,address,city,country,first_name,address_type')
                        ->limit(1)
                        ->get('address')
                        ->row_array();
    }

    public function storeInOrderAddress($data) {
        if ($data != null && $data != '') {
            $this->db->insert('order_address', $data);
        }
    }

    public function saveBulkOrder($data) {
        if ($data != null && $data != '') {
            return ($this->db->insert('bulk_order', $data)) ? $this->db->insert_id() : false;
            $s = ($this->db->insert('bulk_order', $data)) ? $this->db->insert_id() : false;
            echo $this->db->last_query();
            die;
        }
    }

    public function getPageMeta($page_name) {
        return $this->db->where(['page_name' => $page_name])
                        ->select('meta_title,meta_keywords,meta_desc,meta_og_locale,meta_og_type,meta_og_title,meta_og_description,meta_og_url,meta_og_site_name,meta_og_image,meta_twitter_card,meta_twitter_title,meta_twitter_description,meta_twitter_image,canonical_url')
                        ->limit(1)
                        ->get('pages')
                        ->row_array();
    }

    function checkPincode($pincode, $city = '') {
        if ($pincode !== '') {
            $this->db->where(['pincode'=>$pincode,'is_active'=>'1']);
        } else {
            $this->db->where(['city'=>$city,'is_active'=>'1']);
        }
        $query = $this->db->get('pincode');
        /* echo $this->db->last_query();
          return $query->num_rows(); */
        if ($query->num_rows() >= 1) {
            return true;
        }
        return false;
    }

    function insertPromoEmail($insertArr) {
        $this->db->insert('user_email_popup', $insertArr);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getCustomerAllAddress($customer_id = '') {
        if ($customer_id) {

            $this->db->from('address as add');
            $this->db->join('customer_address as ca', 'ca.address_id = add.address_id');
            $this->db->where('ca.customer_id', $customer_id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    function getCustomerDetails($customer_id = '') {
        if ($customer_id) {
            $this->db->select('`customer_id`, `first_name`, `last_name`, `mobile_number`, `email`, `is_active`, `created_at`');
            $this->db->from('customer');
            $this->db->where('customer_id', $customer_id);
            $query = $this->db->get();

            //echo $this->db->last_query();die;
            if ($query->num_rows() == 1) {
                return $query->row_array();
            }

            return false;
        }
    }

    public function getCustomerActiveCart($customer_id) {
        $this->db->select('p.product_id, p.product_name, p.sku, qty, price_incl_tax');
        $this->db->from('cart');
        $this->db->join('cart_item', 'cart.cart_id = cart_item.cart_id');
        $this->db->join('product p', 'p.product_id = cart_item.product_id');
        $this->db->where('cart.customer_id', $customer_id);
        $this->db->where('cart.is_active', 1);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

}
