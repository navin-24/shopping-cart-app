<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');
class Campaign_model extends CI_Model {

	function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function validate(){
    	$this->load->config('validationrules',TRUE);
    	$this->form_validation->set_rules($this->config->item('rawtalk','validationrules'));
    	if($this->form_validation->run() == FALSE){
    		return FALSE;
    	} else {
    		return TRUE;
    	}
    }

    public function fetchLastInsertedID(){
    	$this->db->select('id');
    	$this->db->order_by('id','desc');
    	$this->db->limit(1);
    	$result = $this->db->get(TABLE_CAMPAIGN_REGISTRATION)->row_array();
    	if(!empty($result)){
    		return $result['id'];
    	}
    	else {
    		return 0;
    	}
    }

    public function save($id,$data){
    	if($id!=''){
    		$this->db->where('id',$id);
    		$this->db->update(TABLE_CAMPAIGN_REGISTRATION,$data);
    	} else {
    		if($this->db->insert(TABLE_CAMPAIGN_REGISTRATION,$data)){
    			return TRUE;
    		} else {
    			return FALSE;
    		}
    	}
    }

    public function isUserRegistered($customer_contact_number,$campaign_name){
    	$this->db->select('*');
    	$this->db->where('campaign_name',$campaign_name);
    	$this->db->where('customer_contact_number',$customer_contact_number);
    	$this->db->where('status','completed');
    	$result = $this->db->get(TABLE_CAMPAIGN_REGISTRATION)->row_array();
    	if(!empty($result)){
    		return $result;
    	} else {
    		return 'no';
    	}
    }

    public function getRegistrationDetails($registration_id){
    	$this->db->select('*');
    	$this->db->where('registration_id',$registration_id);
    	$result = $this->db->get(TABLE_CAMPAIGN_REGISTRATION)->row_array();
    	return $result;
    }

    public function saveByOrderId($order_id,$updateData){
    	$this->db->where('registration_id',$order_id);
    	$this->db->update(TABLE_CAMPAIGN_REGISTRATION,$updateData);
    }

    public function getCampaignCSVData($from,$to,$campaign_name){
        $end_date = $to." 23:59:59";
        $start_date = $from." 00:00:00";
        $status = 'completed';
        $this->db->select('customer_name,customer_contact_number,customer_email,customer_city,registration_id');
        $this->db->where('campaign_name',$campaign_name);
        $this->db->where('created_at >=',$start_date);
        $this->db->where('created_at <=',$end_date);
        $this->db->where('status =',$status);
        $result = $this->db->get(TABLE_CAMPAIGN_REGISTRATION)->result_array();
        return $result;
    }
}