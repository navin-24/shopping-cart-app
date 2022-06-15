<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AbandonedCart extends MY_Controller {

    private $CI;

    public function __construct() {
        parent::__construct();
        $this->load->library('SSP');
        $this->CI = & get_instance();
        $this->CI->load->database();
    }

    function index() {
        //$viewArr['pageName'] = $this->pageName;
        //$viewArr['cookieAddress'] = $this->cookieAddress;
        //$viewArr['cookiePincode'] = $this->cookiePincode;
        //$this->load->view('header', $viewArr);
        $this->load->view('crmdashboard');
        //$this->load->view('footer', $viewArr);
    }

    function orders() {
        $table = 'cart';
        $primaryKey = 'cart_id';
        
        $columns = array(
            array('db' => '`cart`.`cart_id`', 'dt' => 'cart_id', 'field' => 'cart_id'),
            array('db' => '`cart`.`items_qty`', 'dt' => 'items_qty', 'field' => 'items_qty'),
            array('db' => '`cart`.`items_count`', 'dt' => 'items_count', 'field' => 'items_count'),
            array('db' => '`cart`.`ip_address`', 'dt' => 'ip_address', 'field' => 'ip_address'),
            array('db' => '`cart`.`grand_total`', 'dt' => 'grand_total', 'field' => 'grand_total'),
            array('db' => '`cart`.`coupon_code`', 'dt' => 'coupon_code', 'field' => 'coupon_code'),
            array('db' => '`cart`.`created_at`', 'dt' => 'created_at', 'field' => 'created_at'),
            array('db' => '`cart`.`updated_at`', 'dt' => 'updated_at', 'field' => 'updated_at'),
            array('db' => '`customer`.`email`', 'dt' => 'email', 'field' => 'email'),
            array('db' => '`customer`.`first_name`', 'dt' => 'first_name', 'field' => 'first_name'),
            array('db' => '`customer`.`customer_id`', 'dt' => 'action', 'field' => 'customer_id',
                'formatter' => function($d, $row ) {
                    $s = base_url('AdminDashboard/customerDetails/' . $row['customer_id']);
                    return "<a href='$s' id='" . $row['customer_id'] . "'>view</a>";
                }
            ),
        );

        $sql_details = array(
            'user' => $this->CI->db->username,
            'pass' => $this->CI->db->password,
            'db' => $this->CI->db->database,
            'host' => $this->CI->db->hostname,
        );


        $joinQuery = "FROM `cart` INNER JOIN `customer` ON `customer`.customer_id = `cart`.customer_id";
        $extraWhere = "`cart`.is_active=1 and `cart`.customer_id IS NOT NULL and `cart`.`items_qty` > 0";

        echo json_encode(
                //SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
                SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
        );
    }

    function cartitems($cart_id = '') {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $inputArr['cart_id'] = $cart_id;
        //$this->load->view('header', $viewArr);
        $this->load->view('shoppingcart', $inputArr);
        //$this->load->view('footer', $viewArr);
    }

    function getCartItems() {
        $table = 'cart_item';

        $primaryKey = 'cart_item_id';

        $columns = array(
            array('db' => '`cart_item`.`product_id`', 'dt' => 'product_id', 'field' => 'product_id'),
            array('db' => '`cart_item`.`product_name`', 'dt' => 'product_name', 'field' => 'product_name'),
            array('db' => '`cart_item`.`sku`', 'dt' => 'sku', 'field' => 'sku'),
            array('db' => '`cart_item`.`price_incl_tax`', 'dt' => 'price_incl_tax', 'field' => 'price_incl_tax'),
            array('db' => '`cart_item`.`qty`', 'dt' => 'qty', 'field' => 'qty'),
                //array('db' => '`customer`.`mobile_number`', 'dt' => 9, 'field' => 'mobile_number'),
        );


        // DB connection information
        $sql_details = array(
            'user' => $this->CI->db->username,
            'pass' => $this->CI->db->password,
            'db' => $this->CI->db->database,
            'host' => $this->CI->db->hostname,
        );

        $joinQuery = "FROM `cart_item` INNER JOIN `cart` ON `cart_item`.cart_id = `cart`.cart_id";
        $extraWhere = "`cart_item`.cart_id=" . $_POST['cart_id'];

        echo json_encode(
                SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
        );
    }

}
