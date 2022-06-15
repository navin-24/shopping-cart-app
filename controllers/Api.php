<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('common_helper');
        header('Access-Control-Allow-Origin: *'); //Allow cross origin request.
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); //Allow all given methods for cross origin request
        header("Access-Control-Allow-Headers: authtoken"); //Allow only 'authtoken' header to be sent in headers
        header('Content-Type: application/json; charset=UTF-8'); //Define datatypes & character sets

    }

    public function checkpincode(){
        validateServiceRequest();
        $apiResponse = array();
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|regex_match[/^[0-9]*$/]|min_length[6]|max_length[6]',array('required'=>'Pincode is required','regex_match'=>'Pincode Should be 6 digit number','min_length'=>'Pincode must be at least 6 characters in length','max_length'=>'Pincode cannot exceed 6 characters in length'));
        if ($this->form_validation->run() == FALSE) {
            $status = 'failure';
            $message = 'Validation error';
            $data = array('pincode'=>strip_tags(form_error('pincode')));
        } else {
            $this->load->model(array('api_model'));
            $pincodeAllowed = $this->api_model->isPincodeAllowed($this->input->post('pincode'));
            if($pincodeAllowed == "no"){
                $status = 'failure';
                $message = 'Pincode is not allowed';
                $data = array('pincode'=>$this->input->post('pincode'));
            } else {
                $status = 'success';
                $message = 'Pincode is allowed';
                $data = array('pincode'=>$this->input->post('pincode'));
            }
        }
        $responseData = array('status' => $status,
          'message'=> $message,
          'data' => $data);
        setContentLength($responseData);
    }
}