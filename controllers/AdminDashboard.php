<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends CI_Controller {

    private $CI;

    public function __construct() {
        parent::__construct();
       
        $this->load->library('SSP');
        $this->load->model('common_model');
        $this->load->model('product_model');
        $this->CI = & get_instance();
        $this->CI->load->database();
       
    }

    function addPinCode(){
        $this->load->view('CRM/add-pin');
    }

    function insertPinCode(){
        $cities_data = $this->product_model->getActiveCities();
        foreach ($cities_data as $value) {
            $city_detail[strtolower($value['city_name'])] = $value['city_id'];
        }
        $file_read = file_get_contents($_FILES['pin_file_upload']['tmp_name']);
        $data_arr = explode("\n", $file_read);
        $data=array();
        foreach ($data_arr as $key=>$value) {
            if ($key==0){
                continue;
            };
            if(isset($value) && $value !=''){
               $arr = explode(',', $value);
               $pincode[] = $arr['0'];
               $data[$arr['0']]['pincode'] = $arr['0'];
               $data[$arr['0']]['state'] = $arr['1'];
               $data[$arr['0']]['city'] = $arr['2'];
               $data[$arr['0']]['city_id'] = $city_detail[trim(strtolower($arr['2']))];
            }
        }
        $exist_pin_arr = $this->db->where_in('pincode',$pincode)
                        ->select('pincode')
                        ->get('pincode')
                        ->result_array();
        if (is_array($exist_pin_arr)) {
            foreach ($exist_pin_arr as $value) {
                $exist_pins[] = $value['pincode'];
            }
        }
        $cnt=0;
        foreach ($data as $key => $value) {
            if(is_array($exist_pins)){
                if(in_array($key, $exist_pins)){
                    continue;
                }    
            }
            $cnt++;
            $this->db->insert('pincode',$value);
        }
        $this->load->view('CRM/pin-listing',array("inserted_records"=>$cnt));
    }

    function pincode() {
        $this->load->view('CRM/pin-listing');
    }

    function getPincode() {
        $table = 'pincode';
        $primaryKey = 'pincode_id';

        $columns = array(
            array('db' => 'pincode_id', 'dt' => 'pincode_id', 'field' => 'pincode_id'),
            array('db' => 'state', 'dt' => 'state', 'field' => 'state'),
            array('db' => 'city', 'dt' => 'city', 'field' => 'city'),
            array('db' => 'pincode', 'dt' => 'pincode', 'field' => 'pincode'),
            array('db' => 'is_active', 'dt' => 'is_active', 'field' => 'is_active'),
            array(
                'db' => 'is_active',
                'dt' => 'is_active',
                'formatter' => function( $d, $row ) {
                    $status = $row['is_active']?'Active':'In Active';
                    return $status;
                }
            ),
            array('db' => 'pincode_id', 'dt' => 'action', 'field' => 'pincode_id',
                'formatter' => function($d, $row ) {
                    return $row['pincode_id'];
                }
            ),
        );

        $sql_details = array(
            'user' => $this->CI->db->username,
            'pass' => $this->CI->db->password,
            'db' => $this->CI->db->database,
            'host' => $this->CI->db->hostname,
        );
        echo json_encode(
                //SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
                SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
        );
    }

    function updatePinStatus(){
        $post_data = $this->input->post('id');
        $action = $this->input->post('action');
        $this->db->where_in('pincode_id',$post_data)->update('pincode', array('is_active'=>$action));
        $this->load->view('CRM/pin-listing',array('msg'=>'Update Status Success'));
    }

    function productCity() {
        $this->load->view('CRM/product-city');
    }

    function getProducts() {
        $table = 'product';
        $primaryKey = 'product_id';

        $columns = array(
            array('db' => 'p.product_id', 'dt' => 'product_id', 'field' => 'product_id'),
            array('db' => 'p.product_name', 'dt' => 'product_name', 'field' => 'product_name'),
            array('db' => 'c.category_name', 'dt' => 'category_name', 'field' => 'category_name','formatter' => function( $d, $row ) {
                    return ($row['category_name'])?$row['category_name']:'-';
                }),
            array('db' => 'p.sku', 'dt' => 'sku', 'field' => 'sku'),
            array(
                'db' => 'p.base_price',
                'dt' => 'base_price',
                'formatter' => function( $d, $row ) {
                    return "Rs. ".$row['base_price']."/-";
                }
            ),
            array('db' => 'pcity.city_id', 'dt' => 'city_id', 'field' => 'city_id',
                    'formatter' => function($d, $row ) {
                        $mapping = $this->product_model->getProductCityMapping($row['product_id']);
                        $mapped_cities=array();
                        foreach ($mapping as $value) {
                            $mapped_cities[] =  $value['city_id'];
                        }
                        $city_names='';
                        if(count($mapped_cities)>0){
                            $city_names = $this->product_model->getActiveCityName($mapped_cities);
                            return $city_names;    
                        }else{
                            return "No Mapping available.";
                        }
                        
                    }),
            array('db' => 'p.product_id', 'dt' => 'action', 'field' => 'product_id',
                'formatter' => function($d, $row ) {
                    $s = base_url('CRM/productCityView/' . $row['product_id']);
                    return "<a href='$s' id='" . $row['product_id'] . "'>View</a>";
                }
            ),
        );
        $extraWhere = " p.is_active = '1' AND p.base_price > 0";
        $groupBy = " pcity.product_id ";
        $sql_details = array(
            'user' => $this->CI->db->username,
            'pass' => $this->CI->db->password,
            'db' => $this->CI->db->database,
            'host' => $this->CI->db->hostname,
        );

        $joinQuery = "FROM product as p INNER JOIN product_category as pc ON p.product_id = pc.product_id INNER JOIN category as c ON pc.category_id=c.category_id INNER JOIN product_city AS pcity ON p.product_id=pcity.product_id";

        echo json_encode(
                //SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
                SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns,$joinQuery,$extraWhere,$groupBy)
        );
    }

    function updateProductCityMapping(){
        $product_id = $this->input->post('product_id');
        $cities = $this->input->post('city');

        if ($product_id) {
            $this->db->where('product_id',$product_id)
                    ->where_in('city_id',$cities)
                    ->update('product_city',array('is_active'=>'1'));
            $this->db->where('product_id',$product_id)
                    ->where_not_in('city_id',$cities)
                    ->update('product_city',array('is_active'=>'0'));
        }
        $this->load->view('CRM/product-city');
    }

    function customers() {
        //$viewArr['pageName'] = $this->pageName;
        //$viewArr['cookieAddress'] = $this->cookieAddress;
        //$viewArr['cookiePincode'] = $this->cookiePincode;
        //$this->load->view('header', $viewArr);
        $this->load->view('customers');
        //$this->load->view('footer', $viewArr);
    }

    function getCustomers() {
        $table = 'customer';
        $primaryKey = 'customer_id';

        $columns = array(
            array('db' => 'customer_id', 'dt' => 'customer_id', 'field' => 'customer_id'),
            //array('db' => 'first_name', 'dt' => 'first_name', 'field' => 'first_name'),
            array('db' => 'last_name', 'field' => 'last_name'),
            array('db' => 'mobile_number', 'dt' => 'mobile_number', 'field' => 'mobile_number'),
            array('db' => 'email', 'dt' => 'email', 'field' => 'email'),
            array('db' => 'created_at', 'dt' => 'created_at', 'field' => 'created_at'),
            array(
                'db' => 'first_name',
                'dt' => 'first_name',
                'formatter' => function( $d, $row ) {
                    return $row['first_name'] . ' ' . $row['last_name'] . '';
                }
            ),
            array('db' => 'customer_id', 'dt' => 'action', 'field' => 'customer_id',
                'formatter' => function($d, $row ) {
                    return "<a href='customerDetails/" . $row['customer_id'] . "' id='" . $row['customer_id'] . "'>View</a>";
                }
            ),
        );

        $sql_details = array(
            'user' => $this->CI->db->username,
            'pass' => $this->CI->db->password,
            'db' => $this->CI->db->database,
            'host' => $this->CI->db->hostname,
        );


        //$joinQuery = "FROM cart INNER JOIN customer ON customer_id = cart.customer_id";
        //$extraWhere = "cart.is_active=0 and cart.customer_id IS NOT NULL";

        echo json_encode(
                //SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
                SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
        );
    }
    
    
    function orders() {
        //$viewArr['pageName'] = $this->pageName;
        //$viewArr['cookieAddress'] = $this->cookieAddress;
        //$viewArr['cookiePincode'] = $this->cookiePincode;
        //$this->load->view('header', $viewArr);
        $this->load->view('CRM/orders_listing');
        //$this->load->view('footer', $viewArr);
    }
    
    function getOrders() {
        
        //SELECT `order_id`, `state`, `status`, `customer_id`, `customer_firstname`, `customer_lastname`, `customer_email`, `subscription_id`, `shipping_address_id`, `billing_address_id`, `session_id`, `campaign_id`, `coupon_code`, `order_type`, `payment_method`, `shipping_amount`, `tax_amount`, `discount_amount`, `sub_total`, `grand_total`, `total_paid`, `payment_status`, `cart_id`, `remote_id`, `device`, `total_qty_ordered`, `order_cancellation_time`, `order_cancellation_reason`, `error_message`, `extra`, `customer_comment`, `delivery_date`, `magento_order_id`, `created_at`, `updated_at`
        $table = 'orders';
        $primaryKey = 'order_id';

        $columns = array(
            array('db' => 'order_id', 'dt' => 'order_id', 'field' => 'order_id'),
            //array('db' => 'first_name', 'dt' => 'first_name', 'field' => 'first_name'),
            array('db' => 'customer_lastname', 'field' => 'customer_lastname'),
            array('db' => 'customer_email', 'dt' => 'customer_email', 'field' => 'customer_email'),
            array('db' => 'grand_total', 'dt' => 'grand_total', 'field' => 'grand_total'),
            array('db' => 'created_at', 'dt' => 'created_at', 'field' => 'created_at'),
            array('db' => 'updated_at', 'dt' => 'updated_at', 'field' => 'updated_at'),
            array('db' => 'status', 'dt' => 'status', 'field' => 'status'),
            array(
                'db' => 'customer_firstname',
                'dt' => 'customer_firstname',
                'formatter' => function( $d, $row ) {
                    return $row['customer_firstname'] . ' ' . $row['customer_lastname'] . '';
                }
            ),
            array('db' => 'order_id', 'dt' => 'action', 'field' => 'order_id',
                'formatter' => function($d, $row ) {
                    $s = base_url('CRM/orderDetailsView/' . $row['order_id']);
                    return "<a href='$s' id='" . $row['order_id'] . "'>View</a>";
                }
            ),
        );

        $sql_details = array(
            'user' => $this->CI->db->username,
            'pass' => $this->CI->db->password,
            'db' => $this->CI->db->database,
            'host' => $this->CI->db->hostname,
        );


        $joinQuery = "Order by order_id desc";
        //$extraWhere = "cart.is_active=0 and cart.customer_id IS NOT NULL";

        echo json_encode(
                //SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
                SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
        );
    }
    
    
    
    function customerDetails($customer_id = '') {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        
        $inputArr['customerDetails'] = $this->common_model->getCustomerDetails($customer_id);
        $inputArr['customerAddress'] = $this->common_model->getCustomerAllAddress($customer_id);
        $inputArr['cartData'] = $this->common_model->getCustomerActiveCart($customer_id);
        
        //print_r($inputArr);
        $inputArr['customer_id'] = $customer_id;
        //$this->load->view('header', $viewArr);
        $this->load->view('CRM/customerdetails', $inputArr);
        //$this->load->view('footer', $viewArr);
    }


}
