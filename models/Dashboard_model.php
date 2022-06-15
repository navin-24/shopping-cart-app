<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    private $customer_id = null;
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->customer_id = $this->session->userdata('logged_in')['customer_id']; // 1;
    }

    public function getCustomerInfo($customer_id = '') {
        if ($customer_id) {
            $this->db->where('customer_id', $customer_id);
            $this->db->where('is_active', 1);
            $query = $this->db->get('customer');

            //echo $this->db->last_query();die;
            if ($query->num_rows() == 1) {
                return $query->row();
            }

            return false;
        }
    }
    
     public function billingAddress($customer_id = '') {
        if ($customer_id) {
            
            $this->db->from('address as add');
            $this->db->join('customer_address as ca', 'ca.address_id = add.address_id');
            $this->db->where('ca.customer_id', $customer_id);
            //$this->db->where('is_active', 1);
            $query = $this->db->get('customer_address');

            //echo $this->db->last_query();die;
            if ($query->num_rows() == 1) {
                return $query->row();
            }

            return false;
        }
    }

    public function updateNameEmail($data){
        /*$first_name = ;
        $last_name = ;
        $email = ;*/
        if($data!=null && $data!=''){
            $updateStatus = $this->db->where(['customer_id'=>$this->customer_id])->update('customer', $data);
            // return ($this->db->affected_rows()!=1) ?false:true;
            if($updateStatus===false){
                return false;
            }
            return true;
        }
    }

    public function checkEmailExists($email){
        return $this->db->where(['email'=>$email])
        ->get('customer')
        ->row()
        ->email;
    }

    public function getCustomerDetails(){
       // $customer_id = $this->session->userdata('logged_in')['customer_id'];
       return $this->db->where(['customer_id'=>$this->customer_id])->select('first_name, last_name, email, password')->get('customer')->row_array();         
    }

    public function getCustomerPassword(){
       // $customer_id = $this->session->userdata('logged_in')['customer_id'];
       return $this->db->where(['customer_id'=>$this->customer_id])->get('customer')->row()->password; 
    }

    public function updateCustomerPassword($pwd){
        // $customer_id = $this->session->userdata('logged_in')['customer_id'];
        $data = array('password'=>$pwd);
        $updateQuery = $this->db->where(['is_active'=>1, 'customer_id'=>$this->customer_id])->update('customer',$data);
        // return ($this->db->affected_rows()!=1) ? false : true;
        return ($updateQuery===false) ? false : true;
    }

    public function getDBemail(){
        // $customer_id = $this->session->userdata('logged_in')['customer_id'];
        return $this->db->where(['customer_id'=>$this->customer_id])->get('customer')->row()->email;
    }
    public function getNameEmail(){
       // $customer_id = $this->session->userdata('logged_in')['customer_id'];
       return $this->db->where(['customer_id'=>$this->customer_id])->select('first_name, last_name, email')->get('customer')->row_array();
    }

    public function getLastAddress(){
        // $customer_id = $this->session->userdata('logged_in')['customer_id'];
        $query = $this->db->where(['customer_id'=>$this->customer_id,'is_active'=>1])
                    ->from('customer_address')
                    ->join('address', 'address.address_id=customer_address.address_id')
                    ->select('address.address_id, address_type, first_name, last_name, address, city, pincode')
                    ->order_by('customer_address.updated_at', 'DESC')
                    ->limit(1)
                    ->get()
                    ->row_array();

        // echo $this->db->last_query();
        return $query;            
    }

    public function getDefaultBillingAddress(){
       $query = $this->db->where(['customer_id'=>$this->customer_id, 'is_default_shipping'=>1, 'is_default_billing'=>1, 'is_active'=>1])
                    ->from('customer_address')
                    ->join('address', 'address.address_id=customer_address.address_id')
                    ->select('address.address_id, address_type, first_name, last_name, address, city, pincode')
                    ->order_by('customer_address.updated_at', 'DESC')
                    ->limit(1)
                    ->get()
                    ->row_array();

        // echo $this->db->last_query();            
        return $query;            
    }

    public function getAllOrderItems(){

        $this->db->where(['orders.customer_id'=>$this->customer_id]);
        $this->db->select('orders.order_id, DATE_FORMAT(orders.created_at,"%d/%m/%Y") as order_date, address.address_type as ship_to, format(orders.grand_total, 2) as total, orders.status');
        $this->db->from('orders');
        $this->db->join('address', 'address.address_id = orders.shipping_address_id AND address.address_id = orders.billing_address_id', 'left');
        
        if($this->input->get_post('viewAll')==null){    
            $query = $this->db->order_by("orders.order_id", 'DESC')->limit(10)->get()->result_array();
        }else{
            $query = $this->db->order_by("orders.order_id", 'DESC')->get()->result_array();
        }

        return $query;

    }

    public function totalAllOrderItems(){
        return $this->db->where(['customer_id'=>$this->customer_id])
                    ->get('orders')
                    ->num_rows();
    }

    public function getOrderDetails($order_id){
        /*if($order_id==null || $order_id=='' || $order_id==0){
            return false;
        }*/
        return $this->db->where(['orders.customer_id'=>$this->customer_id, 'orders.order_id'=>$order_id])
            ->select('*')
            ->from('orders')
            ->join('order_address','order_address.order_id=orders.order_id','left')
            ->limit(1)
            ->get()
            ->row_array();
    }

    public function getOrderCreateDate($order_id){
        $this->db->select('created_at');
        $this->db->where('order_id',$order_id);
        $result = $this->db->get('orders')->row_array();
        return $result['created_at'];
    }

    public function getItemsOrdered($order_id){
        return $this->db->where(['order_id'=>$order_id])
                ->select('product.thumb_image_url,order_item.product_name,varient,qty_ordered,price')
                ->from('order_item')
                ->join('product','product.product_id=order_item.product_id','left')
                ->get()
                ->result_array();
    }

    public function orderBelongsToUser($order_id){
        return $this->db->where(['orders.customer_id'=>$this->customer_id,'order_id'=>$order_id])
        ->get('orders')
        ->num_rows();
    }

    public function getEmail($customerId){
        if($customerId!=null){
            return $this->db->where(['customer_id'=>$customerId])
                    ->select('email')
                    ->get('customer')
                    ->row()->email;
        }
    }

    public function getMobile($customerId){
        if($customerId!=null){
            return $this->db->where(['customer_id'=>$customerId])
                    ->select('mobile_number')
                    ->get('customer')
                    ->row()->mobile_number;
        }
    }

    public function gerOrderList($page_number){
        // $records = ($page_number!=null)?((($page_number-1)*2). ',' . 2):2;
        $records = ($page_number!=null)?((($page_number-1)*10). ',' . 10):10;
        /*$this->db->where(['orders.customer_id'=>$this->customer_id]);
        $this->db->select('orders.order_id, DATE_FORMAT(orders.created_at,"%d/%m/%Y") as order_date, address.address_type as ship_to, format(orders.grand_total, 2) as total, orders.status');
        $this->db->from('orders');
        $this->db->join('address', 'address.address_id = orders.shipping_address_id AND address.address_id = orders.billing_address_id', 'left');
        $this->db->order_by("orders.order_id", 'DESC')->limit($records)->get()->result_array();*/
        // $query = $this->db->order_by("orders.order_id", 'DESC')->limit($records)->get()->result_array();
        
        return $this->db->query('SELECT `orders`.`order_id`, DATE_FORMAT(orders.created_at, "%d/%m/%Y") as order_date, `address`.`address_type` as `ship_to`, format(orders.grand_total, 2) as total, `orders`.`status` FROM `orders` LEFT JOIN `address` ON `address`.`address_id` = `orders`.`shipping_address_id` AND `address`.`address_id` = `orders`.`billing_address_id` WHERE `orders`.`customer_id`='.$this->customer_id.' ORDER BY `orders`.`order_id` DESC LIMIT '.$records)->result_array();

        // echo $this->db->last_query();
        // return $query;
    }
    public function getCityList(){
        return $this->db->where(['is_active' => 1])
                            ->from('city_master')
                            ->select('city_id,city_name')
                            ->get()
                            ->result_array();   
    }
}