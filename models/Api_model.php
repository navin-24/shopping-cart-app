<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model{
	private $customer_id = null;
	public function __construct(){
		$this->load->database();
	}

	public function isPincodeAllowed($pincode){
		$this->db->select('pincode_id');
    	$this->db->where('pincode',$pincode);
    	$this->db->where('is_active',1);
    	$result = $this->db->get('pincode')->row_array();
    	return (!empty($result))?"yes":"no";
	}
}	
