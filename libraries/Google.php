<?php

defined('BASEPATH') OR exit("No direct script access allowed");
date_default_timezone_set("asia/kolkata");
require_once( 'vendor/google/autoload.php' ); // Include the required dependencies.

class Google {

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
        $google_client = new Google_Client();
        $google_client->setClientId(GOOGLE_CLIENT_ID);
        $google_client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $google_client->setRedirectUri(GOOGLE_REDIRECT_URL);
        $google_client->addScope('email');
        $google_client->addScope('profile');
        return $google_client;
    }

    public function loginUrl() {
        $google_client = $this->config();
        return $google_client->createAuthUrl();
    }

    public function responseFromGoogle() {
        set_time_limit(0);
        $storeInDb = $storeInSession = array();
        $customer_id = null;
        $google_client = $this->config();

        if ($this->CI->input->get('code') != null) {
            // if($token['error']==null)
            $token = $google_client->fetchAccessTokenWithAuthCode($this->CI->input->get("code"));
            $google_service = new Google_Service_Oauth2($google_client);
            $data = $google_service->userinfo->get();
            $user = $this->checkUserExists($data['email']);

            $storeInDb['first_name'] = $data['given_name'];
            $storeInDb['last_name'] = $data['family_name'];

            if ($user) {
                $storeInDb['updated_at'] = date('Y-m-d h:i:sa');
                $this->updateUser($data['email'], $storeInDb);
                $customer_id = $user['customer_id'];
            } else {
                $storeInDb['email'] = $data['email'];
                $storeInDb['created_at'] = date('Y-m-d h:i:sa');
                $customer_id = $this->insertUser($storeInDb);
            }

            $storeInSession['customer_id'] = $customer_id;
            $storeInSession['first_name'] = $data['given_name'];
            $storeInSession['last_name'] = $data['family_name'];
            $storeInSession['email'] = $data['email'];
            $storeInSession['mobile_number'] = $this->CI->login_history_lib->getCustomerMobile($customer_id); // fetching mobile from DB

            $this->CI->session->set_userdata('logged_in', $storeInSession);

            if ($this->CI->login_history_lib->checkUserSessionIdExists() == 0) {
                $this->CI->login_history_lib->createLoginHistory("google"); // Insert login history in DB
            }

            $cart_id = $this->CI->session->userdata('cart_id');
            if ($cart_id != null && $cart_id != '' && $cart_id != 0) {
                $this->CI->login_history_lib->setCustomerIdInCart();
            }

            $this->setGoogleAuthId($data['email'], $data['id']);
            return $customer_id;
            /* $site_url = $this->CI->login_history_lib->redirectAfterLogin(); // After login redirect to provided page
              echo "<script>window.opener.location.href='$site_url';</script>";
              echo "<script>window.close();</script>"; */
        } else {
            echo 'Bad request';
        }
    }

    public function revokeToken() {
        $google_client = $this->config();
        return $google_client->revokeToken();
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

    public function setGoogleAuthId($email, $oauth_id) {
        if ($email != null) {
            $this->CI->db->trans_start();
            $this->CI->db->where(['email' => $email])->set('google_token', $oauth_id)->update('customer');
            $this->CI->db->trans_complete();
        }
    }

}
