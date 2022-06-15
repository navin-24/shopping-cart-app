<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Delivery_model extends CI_Model{
	private $customer_id = null;
	public function __construct(){
		$this->load->database();
		$this->customer_id = $this->session->userdata('logged_in')['customer_id']; // 1; 
	}

    public function validate(){
        $this->load->config('validationrules',TRUE);
        $this->form_validation->set_rules($this->config->item('deliveryboy','validationrules'));
        if($this->form_validation->run() == FALSE){
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
    public function saveOtpDetails($data) {

        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('otp_detail', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveDeliveryDetails($data){
    	$data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('delivery_details', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getDeliveryBoyName($mobile){
        $this->db->where(['mobile'=>$mobile]);
        $this->db->select('name,status');
        $this->db->from('deliveryboy');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getLastOtpDetails($mobile){
        $this->db->where(['mobile_number'=>$mobile]);
        $this->db->select('expiry_time, otp_id, otp_value');
        $this->db->from('otp_detail');
        $this->db->order_by('otp_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
            
    }

    public function updateOtpVerified($otp_id){
        return $this->db->where(['otp_id'=>$otp_id])->set('status', 'verified')->update('otp_detail');
    }

    public function getCustomerDetails($mobile){
        $this->db->where(['mobile_number'=>$mobile]);
        $this->db->from("customer");
        $this->db->select('first_name,last_name,email');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getDeliveryDetailsByEmail($customer_email) {
        $this->db->where('customer_email', $customer_email);
        $this->db->where('status', 'Payment Successful');
        $this->db->limit(1);
        $this->db->select("delivery_date");
        $this->db->order_by('order_id', 'DESC');
        return $this->db->get('orders')->row()->delivery_date;
        /*if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;*/
    }
}