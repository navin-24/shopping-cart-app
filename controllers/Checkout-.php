<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('cart_model');
    }

    function index() {
        $data = array();

        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        print_r($data);die;
        // Load the cart view
        $this->load->view('cart/index', $data);
    }
    
    function cart() {
        
        if (isset($_COOKIE["usercid"])) {
            
            $usercid = trim($_COOKIE["usercid"]);
            $data['cartItems'] = $this->cart_model->getGuestCartDetails($usercid);
            //echo '<pre>';
            //print_r($data);die;
            $this->load->view('checkout/index', $data);
        }
    }


 

}

?>