<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crm_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function gerOrderList($page_number){
		$records = ($page_number!=null)?((($page_number-1)*20). ',' . 20):20;
		$query =  $this->db->query("SELECT `ord`.`order_id`, `ord`.`created_at`, `ord`.`updated_at`, `ord_addr`.`firstname`, 
									`ord_addr`.`lastname`, ord.sub_total, `ord`.`grand_total`, `ord`.`status`
									FROM `orders` as `ord`
									LEFT JOIN `order_address` as `ord_addr` ON `ord`.`order_id`=`ord_addr`.`order_id`
									ORDER BY `ord`.`order_id` DESC
									LIMIT ".$records);
		return $query->result_array();
	}

	public function getOrdersThroughId($orderId){
		if($orderId!=''){ // Get recent 20 records
			return 	$this->db->where(['ord.order_id'=>$orderId])
					// ->where('MATCH (ord.order_id) AGAINST ("'. $orderId .'" IN BOOLEAN MODE)') // IN BOOLEAN MODE
					->select("ord.order_id,ord.created_at,ord.updated_at,ord_addr.firstname,ord_addr.lastname,ord.sub_total,ord.grand_total,ord.status, ord.status, ord.discount_amount")
					->from('orders as ord')
					->join('order_address as ord_addr', 'ord.order_id=ord_addr.order_id', 'left')
					->limit(1)
					->get()
					->result_array();
		}else{
			return $this->gerOrderList($page_number=null);
		}			
	}

	public function getAllOrders(){
		return 	$this->db->select("ord.order_id,ord.created_at,ord.updated_at,ord_addr.firstname,ord_addr.lastname,
								ord.sub_total,ord.grand_total,ord.status")
						->from('orders as ord')
						->join('order_address as ord_addr', 'ord.order_id=ord_addr.order_id', 'left')
						->order_by('ord.order_id')
						->get()
						->result_array();
	}

	public function getPurchasedOnOrders(){
		$purchased_from = $this->input->get_post('purchased_from');
		$purchased_to = $this->input->get_post('purchased_to');

		if(strtotime($purchased_from)==null || strtotime($purchased_from)==''){
			$purchased_from = '';	
		}else{
			$purchased_from = date('Y-m-d', strtotime($purchased_from));
		}

		if(strtotime($purchased_to)==null || strtotime($purchased_to)==''){
			$purchased_to = '';	
		}else{
			$purchased_to = date('Y-m-d', strtotime($purchased_to));
		}


		if($purchased_from=='' && $purchased_to==''){ // If both 'from and to' empty then show first twenty records
			return $this->gerOrderList($page_number=null);
		}
		if($purchased_from!='' && $purchased_to!=''){
			$this->db->where('DATE(created_at) >=', $purchased_from);
			$this->db->where('DATE(created_at) <=', $purchased_to);	
		}
		if($purchased_from){
			$this->db->where('DATE(created_at) >=', $purchased_from);
		}
		if($purchased_to){
			$this->db->where('DATE(created_at) <=', $purchased_to);
		}
 		
		$this->db->select("`ord`.`order_id`, `ord`.`created_at`, `ord`.`updated_at`, `ord_addr`.`firstname`, 
							`ord_addr`.`lastname`, ord.sub_total, `ord`.`grand_total`, `ord`.`status`");	
		$this->db->from('orders as ord');
		$this->db->join("order_address as ord_addr", "`ord`.`order_id`=`ord_addr`.`order_id`", 'left');
		$this->db->order_by("ord.order_id");
		return $this->db->get()->result_array();

	}

	public function getUpdatedOnOrders(){
		$updated_from = $this->input->get_post('updated_from');
		$updated_to = $this->input->get_post('updated_to');

		if(strtotime($updated_from)==null || strtotime($updated_from)==''){
			$updated_from = '';	
		}else{
			$updated_from = date('Y-m-d', strtotime($updated_from));
		}

		if(strtotime($updated_to)==null || strtotime($updated_to)==''){
			$updated_to = '';	
		}else{
			$updated_to = date('Y-m-d', strtotime($updated_to));
		}


		if($updated_from=='' && $updated_to==''){ // If both 'from and to' empty then show first twenty records
			return $this->gerOrderList($page_number=null);
		}
		if($updated_from!='' && $updated_to!=''){
			$this->db->where('DATE(updated_at) >=', $updated_from);
			$this->db->where('DATE(updated_at) <=', $updated_to);	
		}
		if($updated_from){
			$this->db->where('DATE(updated_at) >=', $updated_from);
		}
		if($updated_to){
			$this->db->where('DATE(updated_at) <=', $updated_to);
		}
 		
		$this->db->select("`ord`.`order_id`, `ord`.`created_at`, `ord`.`updated_at`, `ord_addr`.`firstname`, 
							`ord_addr`.`lastname`, ord.sub_total, `ord`.`grand_total`, `ord`.`status`");	
		$this->db->from('orders as ord');
		$this->db->join("order_address as ord_addr", "`ord`.`order_id`=`ord_addr`.`order_id`", 'left');
		$this->db->order_by("ord.order_id");
		return $this->db->get()->result_array();

	}

	public function getBillOrShipToNameOrders(){
		$cutomer_name = $this->input->get_post('customer_name');
		if($cutomer_name!=null){
		 	return $this->db->like("CONCAT(ord_addr.firstname,' ',ord_addr.lastname)", $cutomer_name)
					// ->where('MATCH (ord.order_id) AGAINST ("'. $orderId .'" IN BOOLEAN MODE)') // IN BOOLEAN MODE
					->select("ord.order_id,ord.created_at,ord.updated_at,ord_addr.firstname,ord_addr.lastname,ord.sub_total,ord.grand_total,ord.status")
					->from('orders as ord')
					->join('order_address as ord_addr', 'ord.order_id=ord_addr.order_id', 'left')
					->get()
					->result_array();		
		}
	}

	public function getGT_BaseOrders(){
		$gt_base_from = $this->input->get_post('gt_base_from');
		$gt_base_to = $this->input->get_post('gt_base_to');

		if($gt_base_from!='' && $gt_base_to!=''){
			$this->db->where('sub_total >=', $gt_base_from);
			$this->db->where('sub_total <=', $gt_base_to);	
		}
		if($gt_base_from){
			$this->db->where('sub_total >=', $gt_base_from);
		}
		if($gt_base_to){
			$this->db->where('sub_total <=', $gt_base_to);
		}
 		
		$this->db->select("`ord`.`order_id`, `ord`.`created_at`, `ord`.`updated_at`, `ord_addr`.`firstname`, 
							`ord_addr`.`lastname`, ord.sub_total, `ord`.`grand_total`, `ord`.`status`");	
		$this->db->from('orders as ord');
		$this->db->join("order_address as ord_addr", "`ord`.`order_id`=`ord_addr`.`order_id`", 'left');
		$this->db->order_by("ord.order_id");
		return $this->db->get()->result_array();
	}

	public function getGT_PurchasedOrders(){
		$gt_purchased_from = $this->input->get_post('gt_purchased_from');
		$gt_purchased_to = $this->input->get_post('gt_purchased_to');

		if($gt_purchased_from!='' && $gt_purchased_to!=''){
			$this->db->where('grand_total >=', $gt_purchased_from);
			$this->db->where('grand_total <=', $gt_purchased_to);	
		}
		if($gt_purchased_from){
			$this->db->where('grand_total >=', $gt_purchased_from);
		}
		if($gt_purchased_to){
			$this->db->where('grand_total <=', $gt_purchased_to);
		}
 		
		$this->db->select("`ord`.`order_id`, `ord`.`created_at`, `ord`.`updated_at`, `ord_addr`.`firstname`, 
							`ord_addr`.`lastname`, ord.sub_total, `ord`.`grand_total`, `ord`.`status`");	
		$this->db->from('orders as ord');
		$this->db->join("order_address as ord_addr", "`ord`.`order_id`=`ord_addr`.`order_id`", 'left');
		$this->db->order_by("ord.order_id");
		return $this->db->get()->result_array();
	}

	public function getOrdersByStatus(){
		$order_status = $this->input->get_post('order_status');
		// if($order_status!=null){
		 	return $this->db->where(['ord.status'=>$order_status])
					->select("ord.order_id,ord.created_at,ord.updated_at,ord_addr.firstname,ord_addr.lastname,ord.sub_total,ord.grand_total,ord.status")
					->from('orders as ord')
					->join('order_address as ord_addr', 'ord.order_id=ord_addr.order_id', 'left')
					->get()
					->result_array();		
		// }
	}

	public function getOrderDetails($orderId){
		if($orderId!=null){
			$data = $this->db->where(['ord.order_id'=>$orderId])
						->select('ord.coupon_code,ord.order_id,ord.customer_id,ord.created_at,ord.status,ord.remote_id,ord.delivery_date,ord.customer_firstname,ord.customer_lastname,ord.customer_email,ord.customer_comment,ord.sub_total,ord.grand_total,ord_addr.firstname,ord_addr.lastname,ord_addr.address,ord_addr.city,ord_addr.state,ord_addr.country,ord_addr.pincode,ord_addr.mobile_number, ord.discount_amount, tax_amount')
						->from('orders as ord')
						->join('order_address as ord_addr', 'ord_addr.order_id=ord.order_id','left')
						//->join('coupon','coupon.code=ord.coupon_code', 'left')
						// join address on `shipping_address_id` AND `billing_address_id`
						->limit(1)
						->get()
						->row_array();
                        return $data;
		}
	}
	public function getItemsOrdered($order_id){
    return $this->db->where(['order_id'=>$order_id])
            // ->select('product.thumb_image_url,order_item..product_name,varient,qty_ordered,price')
    		->select('order_item.product_id,order_item.product_name,category.category_name,varient,qty_ordered,price,product.quantity,product.sku')
            ->from('order_item')
            ->join('product','product.product_id=order_item.product_id','left')
            ->join('product_category','product.product_id=product_category.product_id','left')
            ->join('category','category.category_id=product_category.category_id','left')
            ->get()
            ->result_array();
	}

	public function getTotalOrders(){
		return $this->db->get('orders')->num_rows(); 
	}
	public function getTotalPages(){
		$totalRecords = $this->getTotalOrders();
		return ceil($totalRecords/20);
	}
}