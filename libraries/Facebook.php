<?php

defined('BASEPATH') OR exit("No direct script access allowed");
date_default_timezone_set("asia/kolkata");
require_once( 'vendor/facebook/autoload.php' ); // Include the required dependencies.

class Facebook {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance(); // Codeigniter's native resources
        $this->CI->load->library('session');
        $this->CI->load->helper('cookie');
        $this->CI->load->library('login_history_lib');
        $this->CI->load->database();
    }

    public function config() {
        set_time_limit(0);
        $fb = new Facebook\Facebook([
            'app_id' => FACEBOOK_APP_ID,
            'app_secret' => FACEBOOK_APP_SECRET,
            'default_graph_version' => 'v2.10',
        ]);
        return $fb;
    }

    public function loginUrl() {
        $fb = $this->config();
        $permissions = ['email']; // Optional permissions
        return $fb->getRedirectLoginHelper()->getLoginUrl(FACEBOOK_REDIRECT_URL, $permissions);
    }

    public function responseFromFB() {
        set_time_limit(0);
        $storeInDb = $storeInSession = array();
        $customer_id = null;
        $fb = $this->config();

        if ($this->CI->input->get('code') != null) {
            $access_token = $fb->getRedirectLoginHelper()->getAccessToken(); // Print & check its empty or not
            $graph_response = $fb->get("/me?fields=first_name,last_name,email,gender,picture", $access_token);
            $facebook_user_info = $graph_response->getGraphUser();
            $user = $this->checkUserExists($facebook_user_info['email']);

            $storeInDb['first_name'] = $facebook_user_info['first_name'];
            $storeInDb['last_name'] = $facebook_user_info['last_name'];

            if ($user) {
                $storeInDb['updated_at'] = date('Y-m-d h:i:sa');
                $this->updateUser($facebook_user_info['email'], $storeInDb);
                $customer_id = $user['customer_id'];
            } else {
                $storeInDb['email'] = $facebook_user_info['email'];
                $storeInDb['created_at'] = date('Y-m-d h:i:sa');
                $customer_id = $this->insertUser($storeInDb);
            }

            $storeInSession['customer_id'] = $customer_id;
            $storeInSession['first_name'] = $facebook_user_info['first_name'];
            $storeInSession['last_name'] = $facebook_user_info['last_name'];
            $storeInSession['email'] = $facebook_user_info['email'];
            $storeInSession['mobile_number'] = $this->CI->login_history_lib->getCustomerMobile($customer_id); // fetching mobile from DB

            $this->CI->session->set_userdata('logged_in', $storeInSession);

            if ($this->CI->login_history_lib->checkUserSessionIdExists() == 0) {
                $this->CI->login_history_lib->createLoginHistory("facebook"); // Insert login history in DB
            }

            $cart_id = $this->CI->session->userdata('cart_id');
            if ($cart_id != null && $cart_id != '' && $cart_id != 0) {
                $this->CI->login_history_lib->setCustomerIdInCart(); // After login set 'customer_id' in cart table
            }

            $this->setFacebookAuthId($facebook_user_info['email'], $facebook_user_info['id']);

            return $customer_id;
            /*$site_url = $this->CI->login_history_lib->redirectAfterLogin();
            echo "<script>window.opener.location.href='$site_url';</script>";
            echo "<script>window.close();</script>";*/
        } else {
            echo 'Bad request';
        }
    }

    public function checkUserExists($email) {
        return $this->CI->db->where(["email" => $email])
                        ->select("customer_id,first_name,last_name")
                        ->from('customer')
                        ->get()
                        ->row_array();
    }

    public function insertUser($data) {
        $this->CI->db->insert("customer", $data);
        return $this->CI->db->insert_id();
    }

    public function updateUser($email, $data) {
        return $this->CI->db->where(["email" => $email])->update("customer", $data);
    }

    public function setFacebookAuthId($email, $oauth_id) {
        if ($email != null) {
            $this->CI->db->trans_start();
            $this->CI->db->where(['email' => $email])->set('facebook_token', $oauth_id)->update('customer');
            $this->CI->db->trans_complete();
        }
    }

}
