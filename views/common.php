<?php
$CI = & get_instance();
$CI->load->helper('cookie');
$viewArr['pageName'] = $CI->router->fetch_class();
$viewArr['cookieAddress'] = get_cookie('entered_address');
$viewArr['cookiePincode'] = get_cookie('pincode');

$this->load->view('header', $viewArr);
$this->load->view($view);
$this->load->view('footer', $viewArr);