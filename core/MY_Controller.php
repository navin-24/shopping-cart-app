<?php

class MY_Controller extends CI_Controller {

    protected $cookieAddress;
    protected $pageName;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->cookieAddress = get_cookie('entered_address');
        $this->cookiePincode = get_cookie('pincode_cookie');
        $this->pageName = $this->router->fetch_class();
    }

}
