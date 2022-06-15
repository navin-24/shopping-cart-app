<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Address extends CI_Controller{

	public function __construct(){
		parent::__construct();
        $this->load->helper('cookie');
        // $this->load->model('address_model');
        $this->load->library('customer_address_lib');
	}

    public function addressDetail(){
        $data['city_list'] = $this->customer_address_lib->getCityList();
        $data['address_list'] = $this->customer_address_lib->getWholeAddress();
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('address-detail', $data);
        $this->load->view('footer', $viewArr);   
    }

    public function setShippingAddress(){
        $this->load->library('customer_address_lib');
        $this->customer_address_lib->storeShippingAddress();
    }

    public function updateAddress(){
        $this->load->library('customer_address_lib');
        $this->customer_address_lib->updateCustomerAddress();
    }

    public function addressEdit(){
        $this->load->library('customer_address_lib');
        $this->customer_address_lib->editCustomerAddress();
    }

    public function addressDelete(){
        $this->load->library('customer_address_lib');
        $this->customer_address_lib->deleteCustomerAddress();
    }

    public function setAddressDeliverHere(){
        $this->load->library('customer_address_lib');
        $this->customer_address_lib->setCustomerAddressDeliverHere();
    }

    public function setAddressDefault(){
        $this->load->library('customer_address_lib');
        $this->customer_address_lib->setCustomerAddressDefault();
    }

    public function pincodeCheck() {
        $this->load->model('common_model');
        $inputArr['pincode'] = $pincode = $this->input->post('pincode');
        $inputArr['location'] = $entered_address = $this->input->post('entered_address');
        $inputArr['latitude'] = $this->input->post('latitude');
        $inputArr['longitude'] = $this->input->post('longitude');
        $city = $this->input->post('city');
        $row = $this->common_model->checkPincode($pincode, $city);
        if ($row) {
            $returnArr['status'] = 'success';
            $str = '';
        } else {
            $row = $this->common_model->insertNoServicePincode($inputArr);
            $returnArr['status'] = 'failed';
            $str = 'Uh Oh! We’re currently not able to deliver at this location. But our friends at <a href="https://www.bigbasket.com/ps/?q=raw pressery">Bigbasket</a> might just';
        }
        $returnArr['msg'] = $str;
        echo json_encode($returnArr);
    }
    
}