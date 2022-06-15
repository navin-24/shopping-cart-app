<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class User_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function login($mobile_number, $password) {
        $this->db->where('mobile_number', $mobile_number);
        $this->db->where('password', md5($password));
        $this->db->where('is_active', 1);
        $query = $this->db->get('customer');

        //echo $this->db->last_query();die;
        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }

    public function registerCustomer($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('customer', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveOtpDetails($data) {

        $data['created_at'] = date('Y-m-d H:i:sa');
        $this->db->insert('otp_detail', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveLoginLogout($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('login_history', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getOtpDetails($number_or_email, $otp){
        $current_datetime = date("Y-m-d H:i:sa");

        if(is_numeric($number_or_email)){
            return $this->db->where(['mobile_number'=>$number_or_email, 'otp_value'=>$otp])
                // ->where('expiry_time >', $current_datetime)
                ->select('expiry_time, otp_id')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }else{
            return $this->db->where(['email'=>$number_or_email, 'otp_value'=>$otp])
                // ->where('expiry_time >', $current_datetime)
                ->select('expiry_time, otp_id')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }

    }

    public function getLastOtpDetails($number_or_email){
        $current_datetime = date("Y-m-d H:i:sa");

        if(is_numeric($number_or_email)){
            return $this->db->where(['mobile_number'=>$number_or_email])
                // ->where('expiry_time >', $current_datetime)
                ->select('expiry_time, otp_id, otp_value')
                ->from('otp_detail')
                ->order_by('otp_id', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }else{
            return $this->db->where(['email'=>$number_or_email])
                // ->where('expiry_time >', $current_datetime)
                ->select('expiry_time, otp_id, otp_value')
                ->from('otp_detail')
                ->order_by('otp_id', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }

    }

    public function getEmailOrNumberSubmittedBefore5minutes($number_or_email){
        $current_datetime = date("Y-m-d H:i:sa");
        if(is_numeric($number_or_email)){
            return $this->db->where(['mobile_number'=>$number_or_email])
                ->where('expiry_time >', $current_datetime)
                ->select('mobile_number')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }else{
            return $this->db->where(['email'=>$number_or_email])
                ->where('expiry_time >', $current_datetime)
                ->select('email')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array();
        }
    }

    public function checkOtpCorrectOrNot($number_or_email, $otp){
        $current_datetime = date("Y-m-d H:i:sa");
        if(is_numeric($number_or_email)){
            return $this->db->where(['mobile_number'=>$number_or_email, 'otp_value'=>$otp])
                ->where('expiry_time >', $current_datetime)
                ->select('otp_value')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }else{
            return $this->db->where(['email'=>$number_or_email, 'otp_value'=>$otp])
                ->where('expiry_time >', $current_datetime)
                ->select('otp_value')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }
    }


    public function checkOtpCorrectOrNotBasedOnTime($number_or_email, $otp){
        // $current_datetime = date("Y-m-d H:i:sa");
        if(is_numeric($number_or_email)){
            return $this->db->where(['mobile_number'=>$number_or_email, 'otp_value'=>$otp])
                // ->where('expiry_time >', $current_datetime)
                ->select('otp_value')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }else{
            return $this->db->where(['email'=>$number_or_email, 'otp_value'=>$otp])
                // ->where('expiry_time >', $current_datetime)
                ->select('otp_value')
                ->from('otp_detail')
                ->order_by('expiry_time', 'DESC')
                ->limit(1)
                ->get()
                ->row_array(); 
        }
    }

    public function updateOtpVerified($otp_id){
        return $this->db->where(['otp_id'=>$otp_id])->set('status', 'verified')->update('otp_detail');
    }

    public function isMobileExist($mobile_number = '') {
        $this->db->select('customer_id');
        $this->db->where('mobile_number', $mobile_number);
        $query = $this->db->get('customer');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyOtp($data) {

        $type = $data['otp_type'];
        $user_otp = $data['otp'];
        $mobile_number = $data['mobile_number'];

        $query = $this->db->query("SELECT otp_value, otp_id FROM otp_detail WHERE mobile_number=$mobile_number AND otp_type = '$type' order by created_at desc Limit 1");
//echo $this->db->last_query();
        $row = $query->row_array();
        //print_r($row);
        if (isset($row)) {
            if ($user_otp == $row['otp_value']) {
                $update_data['is_verified'] = 1;
                $update_data['status'] = 'verified';
                $this->db->update('otp_details', $update_data, array('otp_id' => $row['otp_id']));
                return true;
            }
        } else {
            return false;
        }
    }

    function updateLogoutDetails() {

        // $customer_id = $this->session->userdata('customer_id');
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        if ($customer_id!=null) {
            $session_id = $this->session->session_id;
            $logout_time = date('Y-m-d H:i:s');
            $this->db->set('logout_time', $logout_time);
            // $this->db->set('logout_mode', 'manual');
            $this->db->where('customer_id', $customer_id);
            $this->db->where('session_id', $session_id);
            $this->db->update('login_history');
        }
    }
    
    
    function getPincodeDetails($pincode)
    {
        $this->db->where('pincode', $pincode);
        $query = $this->db->get('pincode');

        //echo $this->db->last_query();die;
        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }
   
     public function saveQuery($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('contact_us', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getMobileOtp($mobile){
        return $this->db->select('mobile_otp')
        ->from('customer')
        ->where(['mobile_number'=>$mobile])
        ->get()
        ->row()
        ->mobile_otp;
    }

    public function getEmailOtp($email){
        return $this->db->select('email_otp')
        ->from('customer')
        ->where(['email'=>$email])
        ->get()
        ->row()
        ->email_otp;
    }

    public function getUserDataFromEmailOrMobile($numberOrEmail){
        return $this->db->where('email',$numberOrEmail)
                        ->or_where('mobile_number',$numberOrEmail)
                        ->get('customer')
                        ->row_array();
    }

    public function updateMobileOtp($mobile, $mobile_otp){
         $this->db->trans_start();
         $this->db->where('mobile_number',$mobile)
                    ->set('otp', $mobile_otp)
                    ->update('customer');
         $this->db->trans_complete();

         if($this->db->trans_status()===false){
            return false;
         }
         return true;
    }

    public function updateEmailOtp($email, $email_otp){
        $this->db->trans_start();
        $this->db->where(['email'=>$email])
                ->set('otp', $email_otp)
                ->update('customer');
        $this->db->trans_complete();        

        if($this->db->trans_status()===false){
            return false;
        }
        return true;
    }

    public function checkMobileExistsOrNot($mobile){
        return $this->db->where(['mobile_number'=>$mobile])
                ->from("customer")
                // ->select('customer_id, password, is_active')
                ->select('customer_id,first_name,last_name,email,password,is_active,mobile_number')
                ->get()
                ->row_array();
        // echo $this->db->last_query();
        // return $query;                    
    }

    public function checkEmailExistsOrNot($email){
        return $this->db->where(['email'=>$email])
            ->from("customer")
            // ->select('customer_id, password, is_active, first_name, last_name')
            // ->select('customer_id, password, is_active')
            ->select('customer_id,first_name,last_name,email,password,is_active,mobile_number')
            ->get()
            ->row_array();
    }

    public function checkEmailMatchingWithOtp($email, $email_otp){
           return $this->db->where(['email'=>$email, 'otp'=>$email_otp])             
                    ->from('customer')
                    ->select('customer_id, first_name, last_name,email,mobile_number')
                    ->get()
                    ->row_array(); 
    }

    public function checkMobileMatchingWithOtp($mobile, $mobile_otp){
           return $this->db->where(['mobile_number'=>$mobile, 'otp'=>$mobile_otp])
                        ->from('customer')
                        ->select('customer_id, first_name, last_name,email,mobile_number')
                        ->get()
                        ->row_array();                
    }

    public function insertMobileNumber($mobile){
        $data = array('mobile_number'=>$mobile, 'created_at'=>date('Y-m-d h:i:sa'),'channel'=>$this->session->userdata('rp_channel'),'campaign'=>$this->session->userdata('rp_campaign'));
        $this->db->insert("customer",$data);
        return $this->db->insert_id();
        // return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function insertEmail($email){
        $data = array('email'=>$email, 'created_at'=>date('Y-m-d h:i:sa'),'channel'=>$this->session->userdata('rp_channel'),'campaign'=>$this->session->userdata('rp_campaign'));
        $this->db->insert("customer",$data);
        return $this->db->insert_id();
        // return ($this->db->affected_rows() !=1 ) ? false : true;
    }
    
    /*public function checkUserWithPassword($numberOrEmail, $password, $new_user=false){
        if(is_numeric($numberOrEmail)){

            if($new_user==true){
                $this->db->trans_start();
                $this->db->where(["mobile_number"=>"$numberOrEmail"])
                ->set("password","$password")
                ->update("customer");
                $this->db->trans_complete();

                if($this->db->trans_status() === FALSE){
                    return false;
                }else{
                    return $this->db->where(["mobile_number"=>"$numberOrEmail"])
                                ->select("customer_id, first_name, last_name")
                                ->get("customer")
                                ->row_array();
                }

            }else{
                return $this->db->where(["mobile_number"=>"$numberOrEmail", "password"=>"$password"])
                ->select("customer_id, first_name, last_name")
                ->get("customer")
                ->row_array();
            }
            
        }else{
            if($new_user==true){
                $this->db->trans_start();
                $this->db->where(["email"=>"$numberOrEmail"])
                ->set("password","$password")
                ->update("customer");
                $this->db->trans_complete();

                if($this->db->trans_status() === FALSE){
                    return false;
                }else{
                    return $this->db->where(["email"=>"$numberOrEmail"])
                    ->select("customer_id, first_name, last_name")
                    ->get("customer")
                    ->row_array();
                }

            }else{
                return $this->db->where(["email"=>"$numberOrEmail", "password"=>"$password"])
                ->select("customer_id, first_name, last_name")
                ->get("customer")
                ->row_array();
            }
        }
    }*/

    // public function checkUserWithPassword($numberOrEmail, $password){
    public function checkUserWithPassword($numberOrEmail){
        if(is_numeric($numberOrEmail)){
            // $query = $this->db->where(["mobile_number"=>$numberOrEmail, "password"=>$password])
            $query = $this->db->where(["mobile_number"=>$numberOrEmail])
            ->from("customer")
            ->select("customer_id,first_name,last_name,email,password,is_active,mobile_number")
            ->get()
            ->row_array();
            // echo $this->db->last_query() . "<br>";
            return $query;
        }else{
            // $query = $this->db->where(["email"=>$numberOrEmail, "password"=>$password])
            $query = $this->db->where(["email"=>$numberOrEmail])
            ->from("customer")
            ->select("customer_id,first_name,last_name,email,password,is_active,mobile_number")
            ->get()
            ->row_array();
            // echo $this->db->last_query() . "<br>";
            return $query;
        }
    }

    /*public function isUserActive($numberOrEmail, $is_active=0){
        return $this->db->where('mobile_number', $numberOrEmail)
                        ->or_where('email', $numberOrEmail)
                        ->set('is_active',$is_active)
                        ->update('customer');
    }*/

    public function getEmailEmptyOrMobile($customer_id){
          if($customer_id!=null){
            return $this->db->where(["customer_id"=>$customer_id])
            ->select("mobile_number, email")
            ->get("customer")
            ->row_array();
          }  
    }

    public function setPassword($emailNumber, $pwd){
        
        if($emailNumber==null || $emailNumber==''){
            return false;
        }

        $data = array('password'=>$pwd);

        if(is_numeric($emailNumber)){
            $this->db->trans_start();
            $this->db->where(['mobile_number'=>$emailNumber])
                    ->update('customer', $data);
            $this->db->trans_complete();

            if($this->db->trans_status()===false){
                return false;
            }
            return true;
        }else{
            $this->db->trans_start();
            $this->db->where(['email'=>$emailNumber])
                    ->update('customer', $data);
            $this->db->trans_complete();

            if($this->db->trans_status()===false){
                return false;
            }
            return true;
        }

    }
    
    public function registerUser($inputArr) {
         $this->db->insert("customer", $inputArr);
         return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function insertForgotToken($inputArr) {
         $this->db->insert("password_reset", $inputArr);
         return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    
    public function getDetailsByToken($token)
    {
        $result = $this->db->where(["token"=>$token])
            ->select("email, expiry_datetime")
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get("password_reset")
            ->row_array();
        return $result;
    }
    
    
    

}
