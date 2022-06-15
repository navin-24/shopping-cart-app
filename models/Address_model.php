<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Address_model extends CI_Model{
	private $customer_id = null;
	public function __construct(){
		$this->load->database();
		$this->customer_id = $this->session->userdata('logged_in')['customer_id']; // 1; 
	}
	
	public function insertShippingAddress($data){
		// if($this->session->userdata('logged_in')['customer_id']!=null && $data!=''){
			$this->db->insert('address', $data);
			return $this->db->insert_id();
		// }
	}

	public function updateShippingAddress($data, $address_id){
		$whereCondition = array('address_id'=>$address_id);
		$this->db->trans_start();
		$this->db->where($whereCondition)->update('address', $data);
		$this->db->trans_complete();
		if($this->db->trans_status()===false){
			return false;
		}
		return true;
	}
	
	public function markAddressDefaultOLD($address_id){
		$whereCondition = array('customer_id'=>$this->customer_id,'address_id'=>$address_id);
		$data = array('is_default'=>1);
		$mergData = array_merge($whereCondition, $data, ['created_at'=>date('Y-m-d h:i:sa')]);

		$this->markOtherAddressBlankForDefault(); // Make Other Address blank for Default

		if($this->isCustomerAddressAvailable($address_id)==true){
			$this->db->where($whereCondition)
					->update('customer_address', $data);
		}else{
			$this->insertCustomerAddress($mergData);
		}
	}

	public function markAddressDefault($address_id){
		$whereCondition = array('customer_id'=>$this->customer_id,'address_id'=>$address_id);
		$data = array('is_default_shipping'=>1, 'is_default_billing'=>1);
		$mergData = array_merge($whereCondition, $data, ['created_at'=>date('Y-m-d h:i:sa')]);

		// $this->markOtherAddressBlankForDefault(); // Make Other Address blank for Default
		$this->markOtherAddressBlankForDefault2();

		if($this->isCustomerAddressAvailable($address_id)==true){
			$this->db->where($whereCondition)
					->update('customer_address', $data);
		}else{
			$this->insertCustomerAddress($mergData);
		}
	}

	public function markAddressDefault2($address_id){
		// $customer_id = 1; // $this->session->userdata('logged_in')['customer_id'];
		$whereCondition = array('customer_id'=>$this->customer_id,'address_id'=>$address_id);
		$data = array('is_default_shipping'=>1, 'is_default_billing'=>1);
		$mergData = array_merge($whereCondition, $data, ['created_at'=>date('Y-m-d h:i:sa')]);

		// $this->markOtherAddressBlankForDefault(); // Make Other Address blank for Default
		$this->markOtherAddressBlankForDefault2();

		if($this->isCustomerAddressAvailable($address_id)==true){
			$this->db->trans_start();
			$this->db->where($whereCondition)
					->update('customer_address', $data);
			$this->db->trans_complete();
			return ($this->db->trans_status()===false)?false:true;
		}

		return false;
	}

	public function markIsDefaultShippingZero($address_id){
		$whereCondition = array('customer_id'=>$this->customer_id,'address_id'=>$address_id);
		$data = array('is_default_shipping'=>0, 'is_default_billing'=>0);
		$mergData = array_merge($whereCondition, $data, ['created_at'=>date('Y-m-d h:i:sa')]);

		// $this->markOtherAddressBlankForDefault(); // Make Other Address blank/zero (0) for Default

		if($this->isCustomerAddressAvailable($address_id)==true){
			$this->db->where($whereCondition)
					->update('customer_address', $data);
		}else{
			$this->insertCustomerAddress($mergData);
		}
	}

	public function isCustomerAddressAvailable($address_id){
		if($this->customer_id!=null){
			$data = array('customer_id'=>$this->customer_id, 'address_id'=>$address_id);
			$query = $this->db->where($data)
						  ->get('customer_address');	
			if($query->num_rows()==1){
				return true;
			}else{
				return false;
			}	
		}
		
	}

	public function isAddressAvailable($address_id){
		if($this->customer_id!=null){
			$data = array('customer_id'=>$this->customer_id, 'address_id'=>$address_id);
			$query = $this->db->where($data)
						  ->get('address');	
			if($query->num_rows()==1){
				return true;
			}else{
				return false;
			}	
		}
	}

	public function insertCustomerAddress($data){
		// if($this->session->userdata('logged_in')['customer_id']!=null && $data!=''){
			$this->db->trans_start();
			$this->db->insert('customer_address', $data);
			$this->db->trans_complete();
		// }
	}

	public function markAddressShipping($address_id){
		$whereCondition = array('customer_id'=>$this->customer_id,'address_id'=>$address_id);
		$data = array('is_shipping'=>1);
		$mergData = array_merge($whereCondition, $data, ['created_at'=>date('Y-m-d h:i:sa')]);

		$this->markOtherAddressBlankForShipping($this->customer_id); // Other address blank for shipping
		if($this->isCustomerAddressAvailable($address_id)==true){
			$this->db->where($whereCondition)
					->update('customer_address', $data);
		}else{
			$this->insertCustomerAddress($mergData);
		}
	}

	public function markOtherAddressBlankForDefault(){
		if($this->customer_id!=null && $this->customer_id!=0){
			$whereCondition = array('customer_id'=>$this->customer_id);
			$data = array('is_default_shipping'=>0);
			$this->db->where($whereCondition)
					->update('customer_address', $data);
		}
	}

	public function markOtherAddressBlankForDefault2(){
		if($this->customer_id!=null && $this->customer_id!=0){
			$whereCondition = array('customer_id'=>$this->customer_id);
			$data = array('is_default_shipping'=>0, 'is_default_billing'=>0);
			$this->db->where($whereCondition)
					->update('customer_address', $data);
		}
	}

	public function markOtherAddressBlankForShipping($customer_id){
		if($this->customer_id!=null && $this->customer_id!=0){
			$whereCondition = array('customer_id'=>$this->customer_id);
			$data = array('is_shipping'=>0);
			$this->db->where($whereCondition)
					->update('customer_address', $data);
		}
	}


	public function getDefultAddressOLD(){
		return $this->db->where(['customer_id'=>$this->customer_id, 'is_default'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id, first_name, last_name, address')
						->order_by('customer_address.updated_at', 'DESC')
						->limit(1)
						->get()
						->row_array();	
	}

	public function getDefultAddress(){
		return $this->db->where(['customer_id'=>$this->customer_id, 'is_default_shipping'=>1, 'is_default_billing'=>1, 'is_active'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id, address_type, first_name, last_name, address, city, pincode')
						->order_by('customer_address.updated_at', 'DESC')
						->limit(1)
						->get()
						->row_array();
	}

	public function getShippingAddressOLD(){
		return $this->db->where(['customer_id'=>$this->customer_id, 'is_shipping'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id, first_name, last_name, address')
						->order_by('customer_address.updated_at', 'DESC')
						->limit(1)
						->get()
						->row_array();
	}

	public function getLastAddress(){
		return $this->db->where(['customer_id'=>$this->customer_id, 'is_active'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id, address_type, first_name, last_name, address, city, pincode')
						->order_by('customer_address.updated_at', 'DESC')
						->limit(1)
						->get()
						->row_array();
	}

	public function getAllAdress(){
		$query = $this->db->where(['customer_id'=>$this->customer_id, 'address.is_active'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->join('pincode', 'address.pincode=pincode.pincode',"left")
						->select('address.address_id, address_type, first_name, last_name, address, address.city, address.pincode, is_default_shipping,pincode.is_active')
						->order_by('pincode.is_active', 'DESC')
						// ->order_by('customer_address.updated_at', 'DESC')
						->get()
						->result_array();
		// echo $this->db->last_query();
		return $query;				
	}

	public function editAddress($address_id){
		return $this->db->where(['customer_id'=>$this->customer_id, 'customer_address.address_id'=>$address_id, 'is_active'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id, mobile_number, address_type, first_name, last_name, address, city, pincode, customer_address.is_default_shipping')
						->get()
						->row_array();
	}

	public function deleteAddress($address_id){
		$whereCondition = array('address_id'=>$address_id);
		$data = array('is_active'=>0);
		if($this->customer_id!=null && $address_id!=null){
			/*$this->db->where($whereCondition)
					->delete('address');
			return ($this->db->affected_rows()!=1) ? false:true;*/

			$this->db->where($whereCondition)
					->update('address', $data);
			return ($this->db->affected_rows()!=1)?false:true;		
		}
	}

	public function deleteCustomerAddress($address_id){
		$whereCondition = array('customer_id'=>$this->customer_id, 'address_id'=>$address_id);
		if($this->customer_id!=null && $address_id!=null){
			$this->db->where($whereCondition)
					->delete('customer_address');
			return ($this->db->affected_rows()!=1) ? false:true;
		}
	}

	public function getAddressDeliverHere($address_id){
		return $this->db->where(['customer_id'=>$this->customer_id, 'customer_address.address_id'=>$address_id, 'is_active'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id, address.address_type, first_name, last_name, address, city, pincode')
						->order_by('customer_address.updated_at', 'DESC')
						->limit(1)
						->get()
						->row_array();
	}

	public function getFirstAddress(){
		return $this->db->where(['customer_id'=>$this->customer_id, 'is_active'=>1])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id, address.address_type, first_name, last_name, address, city, pincode')
						// ->order_by('customer_address.updated_at', 'ASC')
						->order_by('customer_address.created_at', 'ASC')
						->limit(1)
						->get()
						->row_array();
	}

	public function countAddress(){
		return $this->db->where(['customer_id'=>$this->customer_id])
						->from('customer_address')
						->join('address', 'address.address_id=customer_address.address_id')
						->select('address.address_id')
						->get()
						->num_rows();
	}

	public function addressBelongsToUser($address_id){
		return $this->db->where(['customer_id'=>$this->customer_id, 'address_id'=>$address_id])
				->get('customer_address')
				->num_rows();		
	}
	public function getDeliverySpan($pincode){
        return $this->db->where(['p.pincode' => $pincode])
                            ->from('city_master c')
                            ->join('pincode p','p.city_id=c.city_id','left')
                            ->get()
                            ->row()->delivery_span;
    }

    public function getDeliveryWindow($pincode){
        return $this->db->where(['p.pincode' => $pincode])
                            ->from('city_master c')
                            ->join('pincode p','p.city_id=c.city_id','left')
                            ->get()
                            ->row()->delivery_window;
    }

    public function getAllCities(){
    	return $this->db->where(['is_active' => 1])
                            ->from('city_master')
                            ->select('city_id,city_name')
                            ->get()
                            ->result_array();	
    }

    public function getCitynameByPincode($pincode){
    	return $this->db->where(['p.pincode' => $pincode,'c.is_active' => 1])
                            ->from('city_master c')
                            ->join('pincode p','p.city_id=c.city_id','left')
                            ->select('city_name')
                            ->limit(1)
                            ->get()
                            ->row()->city_name;	
    }

}