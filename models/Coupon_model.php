<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Coupon_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function couponInfo($code){
    	if($code!=null && $code!=''){
	    	$date = date('Y-m-d');
	    	$query = $this->db->where(['from_date <='=>$date, 'to_date >='=> $date, 'is_active'=>1, 'code'=>$code])
	    		->select('discount_type, discount_amount')
	    		->from('coupon')
	    		->limit(1)
	    		->get();

	    	// echo $this->db->last_query();	
	    	return $query->row_array();
    	}
    }
    
}    