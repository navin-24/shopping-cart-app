<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Order_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getOrderDetails($orderId) {
        return $this->db->where('orders.order_id', $orderId)
                        ->from('orders')
                        ->select("order_id, coupon_code,discount_amount, tax_amount, sub_total, grand_total, customer_id, shipping_address_id, billing_address_id, concat(customer_firstname,' ',customer_lastname) fullname, customer_email, delivery_date, customer_comment, payment_method, cart_id")
                        ->get()->row_array();
    }

    public function getOrderItemDetails($orderId) {
        return $this->db->where('order_item.order_id', $orderId)
                        ->from('order_item')
                        ->select("product_id, product_name, qty_ordered, price_incl_tax as item_price")
                        ->get()->result_array();
    }
    
    public function getOrderItemDetails2($orderId) {
       $data =  $this->db->where('ot.order_id', $orderId)
                        ->from('order_item ot')
                        ->select("ot.product_id, ot.product_name, ot.qty_ordered, ot.price as item_price, p.thumb_image_url, p.varient")
                        ->join('product p', 'ot.product_id=p.product_id','left')
                        ->get()->result_array();
        return $data;
        //echo $this->db->last_query();
    }

    public function getOrderAddress($order_id, $customer_id = '', $customer_address_id = '') {
        $this->db->where('order_id', $order_id);
        if ($customer_id) {
            $this->db->where('customer_id', $customer_id);
        }
        if ($customer_address_id) {
            $this->db->where('customer_address_id', $customer_address_id);
        }

        $this->db->from('order_address');
        //->select("concat(firstname,' ',lastname, ' ', street, ' ', city,' ', pincode,' ',state,' ', country) as shipping_address")->get()->row_array();
        $result = $this->db->select("firstname, lastname, address, city, pincode, state, country, mobile_number")->get()->row_array();

        return $result;
    }

    public function updateOrderStatus($orderId, $updatedData) {
        if ($orderId !== 0 & $orderId !== '') {
            $this->db->update('orders', $updatedData, array('order_id' => $orderId));
            //echo $this->db->last_query();die;
            return true;
        } else {
            return false;
        }
    }

    public function markCartInactive($orderId) {
        $orderDetails = $this->getOrderDetails($orderId);
        $current_cart_id = $orderDetails['cart_id'];
        if ($current_cart_id) {
            $updatedData['is_active'] = 0;
            $this->db->update('cart', $updatedData, array('cart_id' => $current_cart_id));
            return true;
        } else {
            return false;
        }
    }

    public function getOrderItemDetailsCategory($orderId) {
       $data =  $this->db->where('ot.order_id', $orderId)
                        ->from('order_item ot')
                        ->select("ot.product_id,pc.category_id,c.category_name, ot.product_name, ot.qty_ordered, ot.price as item_price, p.thumb_image_url, p.varient")
                        ->join('product p', 'ot.product_id=p.product_id','left')
                        ->join('product_category pc', 'p.product_id=pc.product_id','inner')
                        ->join('category c', 'pc.category_id=c.category_id','inner')
                        ->get()->result_array();
        return $data;
        //echo $this->db->last_query();
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

    function getOrderList($from,$to){
        $end_date = $to." 23:59:59";
        $start_date = $from." 00:00:00";
        $data =  $this->db->where(['o.created_at <=' => $end_date,'o.created_at >=' => $start_date])
                        ->where_in('status', array('Payment Successful','processing'))
                        ->from('orders o')
                        ->select("o.order_id,status,customer_firstname,customer_lastname, customer_email,coupon_code,discount_amount,grand_total,delivery_date,o.created_at,city, pincode, oa.state,o.channel as order_channel, o.campaign as order_campaign, cust.channel as customer_channel, cust.campaign as customer_campaign")
                        ->join('order_address oa', 'oa.order_id = o.order_id','INNER')
                        ->join('customer cust', 'cust.customer_id = o.customer_id','INNER')
                        ->get()->result_array();
        return $data;
    }

    function getOrderItemList($from,$to){
        $end_date = $to." 23:59:59";
        $start_date = $from." 00:00:00";
        $data =  $this->db->where(['o.created_at <=' => $end_date,'o.created_at >=' => $start_date])
                        ->where_in('status', array('Payment Successful','processing'))
                        ->from('orders o')
                        ->select("ot.order_id,ot.product_name,ot.qty_ordered, ot.price,ot.created_at")
                        ->join('order_item ot', 'o.order_id = ot.order_id','INNER')
                        ->get()->result_array();
        return $data;
    }

    function getAbandonedCartData($from,$to){
        $end_date = $to." 23:59:59";
        $start_date = $from." 00:00:00";

        $this->db->select('cart.cart_id, cart.items_qty, cart.items_count, cart.ip_address, cart.grand_total, cart.coupon_code, cart.created_at, cart.updated_at, customer.email, customer.first_name, customer.customer_id');
        $this->db->join('customer','customer.customer_id = cart.customer_id','inner');
        $this->db->where('cart.is_active',1);
        $this->db->where('cart.customer_id IS NOT NULL');
        $this->db->where('cart.items_qty > 0');
        $this->db->where('date(cart.created_at) BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
        $this->db->or_where('date(cart.updated_at) BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
        $this->db->order_by('cart.cart_id','DESC');
        $query = $this->db->get('cart');
        $fetch_result = $query->result_array();
        $data = array();
        $counter = 0;
        if(count($fetch_result) > 0) {
            $cust_ids = array();
            foreach ($fetch_result as $key => $value){
                $cust_ids[] = $value['customer_id'];    
            }
            $address = $this->getAddressCustomer(implode(',', $cust_ids));
            foreach ($fetch_result as $key => $value){
                $data[$counter]['first_name'] = $value['first_name'];
                $data[$counter]['email'] = $value['email'];
                $data[$counter]['items_count'] = $value['items_count'];
                $data[$counter]['items_qty'] = $value['items_qty'];
                $data[$counter]['grand_total'] = $value['grand_total'];
                $data[$counter]['coupon_code'] = $value['coupon_code'];
                $data[$counter]['address'] =  (array_key_exists($value['customer_id'], $address))?$address[$value['customer_id']]:'';
                $data[$counter]['created_at'] = $value['created_at'];
                $data[$counter]['updated_at'] = $value['updated_at'];
                $counter++;
            }
        }
        return $data;
    }
    function getAddressCustomer($cust_ids){
        $this->db->select("customer_address.customer_id, customer_address.address_id, CONCAT(address.address,' ' ,address.state,' ' ,address.city,' ' ,address.pincode) as full_address, customer_address.is_default_billing, customer_address.is_default_shipping");
        $this->db->join("address", "address.address_id = customer_address.address_id","LEFT");
        $this->db->join("order_address", "customer_address.address_id = order_address.customer_address_id","LEFT");
        $this->db->where("customer_address.customer_id IN (".$cust_ids.")");
        $this->db->where("address.is_active = 1");
        $this->db->order_by("customer_address.customer_id","ASC");
        $this->db->order_by("order_address.order_id","DESC");
        $this->db->order_by("customer_address.updated_at","DESC");
        $query = $this->db->get("customer_address");
        $address_list = $query->result_array();
        $address_arr= array();
        $temp_val='';
        foreach ($address_list as $value) {
            if($value['customer_id'] != $temp_val){
                $address_arr[$value['customer_id']] = $value['full_address'];
                $temp_val = $value['customer_id'];
            }
        }
        return $address_arr;
    }

    function getPincodeData(){
        $this->db->select("state, city, pincode, (CASE WHEN is_active = 1 THEN 'Active' ELSE 'In Active' END) as is_active");
        $this->db->order_by("city","ASC");
        $query = $this->db->get("pincode");
        $fetch_result = $query->result_array();
        return $fetch_result;
    }
}
