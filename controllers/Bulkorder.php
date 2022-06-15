<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkorder extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('common_model');
    }
    
    
    function index()
    {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('bulkorder');
        $this->load->view('footer', $viewArr);
    }
    
    function enquiry()
    {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('bulkorderform');
        $this->load->view('footer', $viewArr);
    }

    function saveBulkOrder() {
        $this->load->helper(array('security', 'email'));
        $insertArr['delivery_location'] = trim($this->input->post('delivery_location'));
        $insertArr['order_for'] = trim($this->input->post('order_for'));
        $insertArr['no_of_bottles'] = trim($this->input->post('no_of_bottles'));
        $insertArr['delivery_on'] = trim($this->input->post('delivery_on'));
        $insertArr['full_name'] = $full_name = trim($this->input->post('full_name'));
        $insertArr['mobile_number'] = trim($this->input->post('mobile_number'));
        $insertArr['email'] = trim($this->input->post('email'));
        $insertArr['pincode'] = trim($this->input->post('postal_code'));

        $this->form_validation->set_rules('delivery_location', 'Delivery Location', 'required',array('required'=>'Deivery Location is required'));
        $this->form_validation->set_rules('order_for', 'Order For', 'required',array('required'=>'Order For is required'));
        $this->form_validation->set_rules('no_of_bottles', 'No Of Bottles', 'required',array('required'=>'No Of Bottles is required'));
        $this->form_validation->set_rules('delivery_on', 'Delivery On', 'required|regex_match[/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/]',array('required'=>'Delivery Date is required','regex_match'=>'Invalid Date Format'));
        $this->form_validation->set_rules('full_name', 'Full name', 'required|regex_match[/^[a-zA-Z ]*$/]|min_length[3]|max_length[30]',array('required'=>'Full Name is required','regex_match'=>'Invalid Full name','min_length'=>'Full name must be at least 3 characters in length','max_length'=>'Full name cannot exceed 30 characters in length'));
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]',array('required'=>'Mobile Number is required','regex_match'=>'Please enter 10 digit Mobile Number'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('postal_code', 'Postal Code', 'required|regex_match[/^[0-9]{6}$/]',array('required'=>'Pincode is required','regex_match'=>'Please enter 6 digit Pincode'));


        if($this->form_validation->run() == FALSE) {
            $returnArr['status'] = 'failed';
            $returnArr['error'] = array('delivery_location'=>strip_tags(form_error('delivery_location')),'order_for'=>strip_tags(form_error('order_for')),'no_of_bottles'=>strip_tags(form_error('no_of_bottles')),'delivery_on'=>strip_tags(form_error('delivery_on')),'full_name'=>strip_tags(form_error('full_name')),'mobile_number'=>strip_tags(form_error('mobile_number')),'email'=>strip_tags(form_error('email')),'postal_code'=>strip_tags(form_error('postal_code')));
            $returnArr['msg'] = ''; 
            //print_r($returnArr);die;
        }else{
            //print_r($insertArr);die;
            $option_for_arr = array(
                "wedding" => 'Wedding',
                'corporateEventsGifting' => 'Corporate Events & Gifting',
                'celebrations' => 'Celebrations');


            $bulkOrderId = $this->common_model->saveBulkOrder($insertArr);

            if ($bulkOrderId) {
                $returnArr['status'] = 'success';
                $returnArr['msg'] = '<i class="fas fa-check-circle"></i> Your request has been submitted successfully!  We will get back to you soon.';

                $message = '<h1>Order No - ' . $bulkOrderId . '</h1>';
                $message .= "<h2>Name: ".$insertArr['full_name']."</h2>";
                $message .= "<h2>Mobile Number: ".$insertArr['mobile_number']."</h2>";
                $message .= "<h2>Email: ".$insertArr['email']."</h2>";
                $message .= "<h2>No of bottles: ".$insertArr['no_of_bottles']."</h2>";
                $message .= "<h2>Order for: ".$option_for_arr[$insertArr['order_for']]."</h2>";
                $message .= "<h2>Delivery Date: ".$insertArr['delivery_on']."</h2>";
                $message .= "<h2>Delivery Location: ".$insertArr['delivery_location']."</h2>";

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.pepipost.com/v2/sendEmail",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"personalizations\":[{\"recipient\":\"navin@rawpressery.com\"}],\"from\":{\"fromEmail\":\"getmore@rawpressery.com\",\"fromName\":\"Rawpressery - Bulk Order\"},\"subject\":\"Bulk Order Details\",\"content\":\"$message\"}",
                    CURLOPT_HTTPHEADER => array(
                        "api_key: 5b98b0b2687056ee6af430d2e4f807b5",
                        "content-type: application/json"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $returnArr['error'] = array('delivery_location'=>'','order_for'=>'','no_of_bottles'=>'','delivery_on'=>'','full_name'=>'','mobile_number'=>'','email'=>'','postal_code'=>'');
            } else {
                $returnArr['status'] = 'failed';
                $returnArr['msg'] = 'Your request can not processed this time.';
            }
        }
        echo json_encode($returnArr);
    }

}
