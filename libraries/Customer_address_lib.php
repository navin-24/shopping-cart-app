<?php

defined('BASEPATH') OR exit('Sorry, no direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Customer_address_lib {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('address_model');
    }

    public function storeShippingAddress() {
        // if($this->CI->session->userdata('logged_in')['customer_id']==null) redirect('/');
        // $isDefault = $this->CI->input->get_post('is_default');

        $first_name = $this->CI->input->get_post('first_name');
        $last_name = $this->CI->input->get_post('last_name');
        $mobile_number = $this->CI->input->get_post('mobile_number');
        $address = $this->CI->input->get_post('address');
        $city = $this->CI->input->get_post('city');
        $pincode = $this->CI->input->get_post('pincode');
        $state = $this->CI->input->get_post('state');
        $country = $this->CI->input->get_post('country');
        $address_type = $this->CI->input->get_post('address_type');
        $currentDate = date('Y-m-d h:i:sa');

        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'mobile_number' => $mobile_number,
            'address' => $address,
            'city' => $city,
            'pincode' => $pincode,
            'state' => $state,
            'country' => $country,
            'address_type' => $address_type,
            'created_at' => $currentDate
        );

        if ($first_name == '' || $first_name == null || strlen($first_name) < 3) {
            echo json_encode(array('status' => 'failed', 'message' => 'First Name, atleast 3 characters'));
            return false;
        }
        if ($last_name == '' || $last_name == null || strlen($last_name) < 3) {
            echo json_encode(array('status' => 'failed', 'message' => 'Last Name, atleast 3 characters'));
            return false;
        }
        if ($this->mobileValidation($mobile_number) == false || $mobile_number == null || $mobile_number == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
            return false;
        }
        if ($address == '' || $address == null) {
            echo json_encode(array('status' => 'failed', 'message' => 'Address required'));
            return false;
        }
        if ($city == '' || $city == null) {
            echo json_encode(array('status' => 'failed', 'message' => 'City required'));
            return false;
        }

        if (strtolower($this->CI->address_model->getCitynameByPincode($pincode))!==strtolower($city)) {
            echo json_encode(array('status' => 'failed', 'message' => 'Selected City Name and pincode is not matching'));
            return false;
        }

        if ($pincode == '' || $pincode == null || !is_numeric($pincode)) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid pincode'));
            return false;
        }

        if ($address_type == '' || $address_type == null) {
            echo json_encode(array('status' => 'failed', 'message' => 'Address type required'));
            return false;
        }

        $lastAddressId = $this->CI->address_model->insertShippingAddress($data);

        if ($lastAddressId != null) {
            $this->CI->address_model->markIsDefaultShippingZero($lastAddressId);
            $totalAddress = $this->CI->address_model->countAddress();

            echo json_encode(array('status' => 'success', 'message' => 'Address created successfully', 'totalAddress' => $totalAddress, 'address_list' => $this->CI->address_model->getAllAdress()));
        }
    }

    public function updateCustomerAddress() {
        // if($this->CI->session->userdata('logged_in')['customer_id']==null) redirect('/');
        // $isDefault = $this->CI->input->get_post('is_default');
        $address_id = $this->CI->input->get_post('address_id');
        $addressBelongsToUser = $this->CI->address_model->addressBelongsToUser($address_id);

        $first_name = $this->CI->input->get_post('first_name');
        $last_name = $this->CI->input->get_post('last_name');
        $mobile_number = $this->CI->input->get_post('mobile_number');
        $address = $this->CI->input->get_post('address');
        $city = $this->CI->input->get_post('city');
        $pincode = $this->CI->input->get_post('pincode');
        $state = $this->CI->input->get_post('state');
        $country = $this->CI->input->get_post('country');
        $address_type = $this->CI->input->get_post('address_type');

        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'mobile_number' => $mobile_number,
            'address' => $address,
            'city' => $city,
            'pincode' => $pincode,
            'state' => $state,
            'country' => $country,
            'address_type' => $address_type,
            'updated_at' => date('Y-m-d h:i:sa')
        );

        if ($address_id == '' || $address_id == null || $address_id == 0) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid Address ID'));
            return false;
        }
        if ($first_name == '' || $first_name == null || strlen($first_name) < 3) {
            echo json_encode(array('status' => 'failed', 'message' => 'First Name, atleast 3 characters'));
            return false;
        }
        if ($last_name == '' || $last_name == null || strlen($last_name) < 3) {
            echo json_encode(array('status' => 'failed', 'message' => 'Last Name, atleast 6 characters'));
            return false;
        }
        if ($this->mobileValidation($mobile_number) == false || $mobile_number == null || $mobile_number == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
            return false;
        }
        if ($address == '' || $address == null) {
            echo json_encode(array('status' => 'failed', 'message' => 'Address required'));
            return false;
        }
        if ($city == '' || $city == null) {
            echo json_encode(array('status' => 'failed', 'message' => 'City required'));
            return false;
        }
        if (strtolower($this->CI->address_model->getCitynameByPincode($pincode))!==strtolower($city)) {
            echo json_encode(array('status' => 'failed', 'message' => 'Selected City Name and pincode is not matching'));
            return false;
        }
        if ($pincode == '' || $pincode == null || !is_numeric($pincode)) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid pincode'));
            return false;
        }
        if ($address_type == '' || $address_type == null) {
            echo json_encode(array('status' => 'failed', 'message' => 'Address type required'));
            return false;
        }

        if ($addressBelongsToUser != 1) {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, you are not authorized user'));
            return false;
        }

        $updateStatus = $this->CI->address_model->updateShippingAddress($data, $address_id);

        if ($updateStatus == true) {

            $this->CI->address_model->markIsDefaultShippingZero($address_id);

            echo json_encode(array('status' => 'success', 'message' => 'Address updated successfully', 'address_list' => $this->CI->address_model->getAllAdress()));
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, something went wrong, please try again after sometime'));
        }
    }

    public function editCustomerAddress() {
        $address_id = $this->CI->input->get_post('address_id');

        if ($address_id == '' || $address_id == null || $address_id == 0) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid Address ID'));
            return false;
        }

        $data = $this->CI->address_model->editAddress($address_id);
        // $data = []; for testing purpose

        if (count($data) == 0) {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, something went wrong, please try again after sometime'));
        } else {
            echo json_encode(array('status' => 'success', 'message' => 'record available', 'data' => $data));
        }
    }

    public function deleteCustomerAddress() {
        $address_id = $this->CI->input->get_post('address_id');
        $addressBelongsToUser = $this->CI->address_model->addressBelongsToUser($address_id);

        if ($address_id == '' || $address_id == null || $address_id == 0) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid Address ID'));
            return false;
        }

        if ($addressBelongsToUser != 1) {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, you are not authorized user'));
            return false;
        }

        $addressDelete = $this->CI->address_model->deleteAddress($address_id);
        // $customerAddressDelete = $this->CI->address_model->deleteCustomerAddress($address_id);
        // if($addressDelete>0 && $customerAddressDelete>0){
        // if($addressDelete==true && $customerAddressDelete==true){
        if ($addressDelete == true) {
            echo json_encode(array('status' => 'success', 'message' => 'Address deleted successfully', 'address_list' => $this->CI->address_model->getAllAdress()));
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, something went wrong, please try again after sometime'));
        }
    }

    public function setCustomerAddressDeliverHere() {
        $this->CI->session->set_userdata('address_id', $this->CI->input->get_post('address_id'));
        $address_id = $this->CI->session->userdata('address_id');

        $addressDeliverHere = $this->CI->address_model->getAddressDeliverHere($address_id);

        if ($addressDeliverHere != null && $addressDeliverHere != '') {
            // echo json_encode(array('status'=>'success', 'message'=>'Delivery address updated successfully', 'data'=>$addressDeliverHere));
            echo json_encode(array('status' => 'success', 'message' => 'Delivery address updated successfully', 'address_list' => $this->CI->address_model->getAllAdress()));
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Sorry, address not available'));
        }
    }

    public function setCustomerAddressDefault() {
        if ($this->CI->input->post('address_id') == null || $this->CI->input->post('address_id') == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Address ID invalid'));
            exit;
        }

        if ($this->CI->address_model->markAddressDefault2($this->CI->input->post('address_id')) == true) {
            echo json_encode(array('status' => 'success', 'message' => 'Address has been made default', 'address_list' => $this->CI->address_model->getAllAdress()));
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Address ID not matching for making default'));
        }
    }

    public function getAllAddressOfCustomer() {
        $address_list = $this->CI->address_model->getAllAdress();

        if ($address_list != null && $address_list != '') {
            echo json_encode(array('status' => 'success', 'message' => 'Address available', 'address_list' => $address_list));
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Address not available', 'address_list' => null));
        }
    }

    public function getWholeAddress() {
        return $this->CI->address_model->getAllAdress();
    }

    public function getCityList() {
        return $this->CI->address_model->getAllCities();
    }

    public function mobileValidation($mobile) {
        if ((strlen($mobile) < 10) || (strlen($mobile) > 10) || (substr_count($mobile, 0) == 10) || !is_numeric($mobile)) {
            return false;
        }
        return true;
    }

}
