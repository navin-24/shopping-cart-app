<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Customer_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

	function getCustomerList($from,$to){
		$end_date = $to." 23:59:59";
		$start_date = $from." 00:00:00";
		$this->db->select("customer_id, first_name, last_name, mobile_number, email, created_at, updated_at, channel, campaign");
		$this->db->where("created_at>='".$start_date."' AND created_at<='".$end_date."'");
		$this->db->where("is_active",1);
		$this->db->order_by("customer_id","desc");
		$result = $this->db->get("customer")->result_array();
		return $result;
	}
}
