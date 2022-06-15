<?php

defined('BASEPATH') OR exit("No direct script access allowed");
date_default_timezone_set("asia/kolkata");

class Login_history_lib {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance(); // Codeigniter's native resources
        $this->CI->load->library('session');
        $this->CI->load->database();
    }

    public function createLoginHistory($login_source) {
        $login_details['customer_id'] = $this->CI->session->userdata('logged_in')['customer_id'];
        $login_details['login_source'] = $login_source;
        $login_details['session_id'] = $this->CI->session->session_id;
        $login_details['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $login_details['campaign_id'] = ($this->CI->input->get_post('campaign_id') != null) ? $this->CI->input->get_post('campaign_id') : 0;
        $login_details['login_time'] = date('Y-m-d H:i:s');
        $login_details['logout_time'] = null;
        $login_details['created_at'] = date('Y-m-d H:i:s');
        // $this->CI->db->trans_start();
        $this->CI->db->insert('login_history', $login_details);
        // $this->CI->db->trans_complete();
    }

    public function updateLogoutDetails() {
        $customer_id = $this->CI->session->userdata('logged_in')['customer_id'];
        if ($customer_id != null) {
            $data = array('logout_time' => date('Y-m-d H:i:s'));
            $session_id = session_id(); // $this->CI->session->session_id;
            /* echo $customer_id . $session_id;
              exit; */
            $this->CI->db->where(['session_id' => $session_id, 'customer_id' => $customer_id]);
            $this->CI->db->update('login_history', $data);
        }
    }

    public function setCustomerIdInCart() {
        $cart_id = $this->CI->session->userdata('cart_id');

        if ($cart_id != null && $cart_id != '' && $cart_id != 0) {
            $this->CI->load->model('cart_model');
            $this->CI->cart_model->updateCustomerIdInCart($cart_id);
        }
    }

    public function checkUserSessionIdExists() {
        $session_id = $this->CI->session->session_id;
        return $this->CI->db->where(['session_id' => $session_id])
                        ->get('login_history')
                        ->num_rows();
    }

    public function updateCustomerDetailsInSession($customerId = '') {
        $firstNameInSession = $this->CI->session->userdata('logged_in')['first_name'];

        if ($firstNameInSession == null || $firstNameInSession == '') {

            $getAllData = array();
            $customer = $this->getCustomerDetails($customerId);
            $sessionData = $this->CI->session->userdata('logged_in');

            $getAllData['first_name'] = $customer['first_name'];
            if ($sessionData['last_name'] == null || $sessionData['last_name'] == '') {
                $getAllData['last_name'] = $customer['last_name'];
            }
            if ($sessionData['email'] == null || $sessionData['email'] == '') {
                $getAllData['email'] = $customer['email'];
            }
            if ($sessionData['mobile_number'] == null || $sessionData['mobile_number'] == '') {
                $getAllData['mobile_number'] = $customer['mobile_number'];
            }
            $getAllData['customer_id'] = $sessionData['customer_id'];

            $this->CI->session->set_userdata('logged_in', $getAllData);
        }
    }

    public function getCustomerDetails($customerId) {
        if ($customerId != '') {
            return $this->CI->db->where(['customer_id' => $customer_id])->select('first_name, last_name, mobile_number, email')->get('customer')->row_array();
        }
    }

    public function getCustomerMobile($customer_id) {
        // $customer_id = $this->CI->session->userdata('logged_in')['customer_id'];
        return $this->CI->db->where(['customer_id' => $customer_id])
                        ->select('mobile_number')
                        ->from('customer')
                        ->limit(1)
                        ->get()
                        ->row()
                ->mobile_number;
    }

    public function redirectAfterLogin() {
        return BASE_URL;
    }

}
