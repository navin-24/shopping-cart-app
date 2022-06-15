<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Delivery extends MY_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
         $this->load->model('delivery_model');
    }

    function index() {
        $viewArr['pageName'] = $this->pageName;
        $this->load->view('header', $viewArr);
        $this->load->view('delivery');
        $this->load->view('footer', $viewArr);
    }

    public function sendOTP() {
        $db_mobileNumber = $this->input->get_post('db_mobileNumber');
        $resend = $this->input->get_post('resend');
        $otp = '123456';//mt_rand(111111, 999999);
        if ($this->mobileValidation($db_mobileNumber) == false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Please enter valid Mobile number'));
            return false;
        }
        
        $deliveryboyName = $this->delivery_model->getDeliveryBoyName($db_mobileNumber);
        if ($deliveryboyName) {
            //$sentMobileResponse = $this->sendOTPtoMobile($db_mobileNumber, $otp);
            if($sentMobileResponse == 'success' || 1){
                $response = $this->setNewOtpDetails($db_mobileNumber, $otp);
                if($response){
                    if ($resend) {
                        $msg = 'OTP resent successfully';
                    } else {
                        $msg = "Hi {$deliveryboyName},<br>Please enter the OTP sent to </br>" . $db_mobileNumber;
                    }
                    echo json_encode(array('status' => 'success', 'message' => $msg));
                }else{
                    $msg = 'OTP Sending Failed';
                    echo json_encode(array('status' => 'failed', 'message' => $msg));    
                }
                
            } else {
                $msg = 'Unable to process the request. Please try after some time';
                echo json_encode(array('status' => 'failed', 'message' => $msg));
            }
        }else {
            $msg = 'Please register your Mobile with Raw Pressery';
            echo json_encode(array('status' => 'failed', 'message' => $msg));
        }
    }

    public function mobileValidation($mobile) {
        if ((strlen($mobile) < 10) || (strlen($mobile) > 10) || (substr_count($mobile, 0) == 10)) {
            return false;
        }
        return true;
    }

    public function setNewOtpDetails($mobile_number, $otp_value,$otp_text='') {
        date_default_timezone_set('asia/kolkata');

        $otp_details['otp_value'] = $otp_value;
        $otp_details['mobile_number'] = $mobile_number;
        $otp_details['otp_type'] = 'delivery';
        $otp_details['status'] = 'sent';
        $otp_details['otp_text'] = $otp_text;
        $otp_details['expiry_time'] = date('Y-m-d H:i:s', strtotime("+5 minutes"));
        return $this->delivery_model->saveOtpDetails($otp_details);
    }

    public function sendOTPtoMobile($mobile, $otp) {
        $otp_msg = str_replace('<otp>', $otp, OTP_TXT);

        $getTagName = $errorCodeAndValue = [];
        $smsErrorCode = $RESULT_REQID = $MID_TID = null;
        $password = urlencode("Rawsms#12");
        $otp_msg = urlencode($otp_msg);

        $output = '';

        if ($mobile != "" && $otp_msg != "") {
            //$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=379508&username=9820669373&password=" . $password . "&To=" . $mobile . "&Text=" . $otp_msg . "&time=&senderid=88508853";

            $url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=381657&username=9820669373&password=" . $password . "&To=" . $mobile . "&Text=" . $otp_msg . "&senderid=RAWPRY&time=&entityid=1101362540000037660&templateid=1107160048762842995";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);

            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
            }

            curl_close($ch);
        }

        /* $xmlDataForError = "<!DOCTYPE RESULT SYSTEM 'http://bulkpush.mytoday.com/BulkSms/BulkSmsRespV1.01.dtd'>
          <RESULT REQID ='26594726263'>
          <MID SUBMITDATE='2020-03-13 18:00:07' ID='1' TAG = 'null' TID = '72558067775'>

          <ERROR INDEX = '1'>

          <ERROR>
          <CODE>120</CODE>
          <DESC>Invalid mobile number - 908206743</DESC>
          </ERROR>
          </ERROR>
          </MID>

          </RESULT>";

          $xmlDataForSuccess = "<!DOCTYPE RESULT SYSTEM 'http://bulkpush.mytoday.com/BulkSms/BulkSmsRespV1.01.dtd'>
          <RESULT REQID ='26594621211'>
          <MID SUBMITDATE='2020-03-13 17:58:18' ID='1' TAG = 'null' TID = '72557805060'>

          </MID>
          </RESULT>
          "; */
        if ($output !== '') {
            $xml = simplexml_load_string($output); // new SimpleXMLIterator($xmlDataForSuccess);
            $RESULT_REQID = $xml->attributes(); // $xml->getName();

            foreach ($xml->MID[0]->attributes() as $k => $v) {
                if ($k == 'TID' && $v != null) {
                    $MID_TID = $v;
                }
            }

            foreach ($xml->children() as $name => $data) {
                $getTagName[] = strtolower($name);
                foreach ($data as $subchildName => $subchild) {
                    $getTagName[] = strtolower($subchildName);
                    foreach ($subchild as $innerchildName => $innerchild) {
                        $getTagName[] = strtolower($innerchildName);
                        foreach ($innerchild as $inSubName => $insubchild) {
                            $getTagName[] = strtolower($inSubName);
                            if (strtolower($inSubName) == 'code') {
                                // $errorCodeAndValue['error_code'] = ['code'=>(int)$insubchild)];
                                $smsErrorCode = (int) $insubchild;
                            }
                        }
                    }
                }
            }

            if (!in_array('error', $getTagName) && $RESULT_REQID != null && $MID_TID != null) {
                return 'success';
            } else {
                return 'failed';
            }
        } else {
            return 'failed';
        }
    }

    public function verifyOTP() {
        $db_mobileNumber = $this->input->get_post('db_mobileNumber');
        $otp = $this->input->get_post('otp');
        $currentDatetime = date("Y-m-d H:i:s");

        if ($otp == null || $otp == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'OTP field cannot be blank'));
            return false;
        }

        if (!is_numeric($otp) || strlen($otp) < 6 || strlen($otp) > 6) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid OTP'));
            return false;
        }


        $otpDetails = $this->delivery_model->getLastOtpDetails($db_mobileNumber);
        $dbExpiryTime = date("Y-m-d H:i:s", strtotime($otpDetails['expiry_time']));

        if ($otp != $otpDetails['otp_value']) {
            echo json_encode(array('status' => 'failed', 'message' => 'OTP is incorrect'));
            return false;
        }

        if (strtotime($dbExpiryTime) < strtotime($currentDatetime)) {
            echo json_encode(array('status' => 'failed', 'message' => 'expired'));
            return false;
        }
        if ($this->mobileValidation($db_mobileNumber) == false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
            return false;
        }
        if ($otp == $otpDetails['otp_value']) {
            $this->delivery_model->updateOtpVerified($otpDetails['otp_id']);
            echo json_encode(array('status' => 'success', 'message' => 'Welcome','db_mobileNumber'=>$db_mobileNumber));
        }
    }

    public function customerInfo(){
        $viewArr['pageName'] = $this->pageName;
        $viewArr['mobile'] = $this->session->userdata('db_mobileNumber');
        $this->session->unset_userdata('db_mobileNumber');
        $this->load->view('header', $viewArr);
        $this->load->view('customerInfo',$viewArr);
        $this->load->view('footer', $viewArr);
    }

    public function deliveryDetails(){/*print_r($this->input->post());die;*/
        $delivery_details['cust_mobile_number'] = $cust_mobileNumber = $this->input->post("cust_mobileNumber");
        $delivery_details['delivery_latitude'] = $this->input->post("delivery_lat");
        $delivery_details['delivery_longitude'] = $this->input->post("delivery_long");
        $delivery_details['delivery_address'] = $this->input->post("delivery_address");
        $delivery_details['delivery_boy_mobile'] = $db_mobileNumber = $this->input->post("delivery_boy_mobile");
        $delivery_details['comment'] = $this->input->post("comment");

        if (!$delivery_details['delivery_latitude'] || !$delivery_details['delivery_longitude'] || !$delivery_details['delivery_address']) {
            echo json_encode(array('status' => 'failed', 'message' => 'Unable to track your location. Please try again.'));
            return false;
        }
        if ($this->mobileValidation($cust_mobileNumber) == false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Please enter valid Mobile number'));
            return false;
        }
        
        $customerDetails = $this->delivery_model->getCustomerDetails($cust_mobileNumber);
        $deliveryboyName = $this->delivery_model->getDeliveryBoyName($db_mobileNumber);
        if (!$customerDetails) {
            echo json_encode(array('status' => 'failed', 'message' => "Customer Mobile Number is Incorrect"));
            return false;
        }

        $saved = $this->delivery_model->saveDeliveryDetails($delivery_details);
        
        $text ="Your Order from Rawpressery is delivered. <br> DELIVERED BY: ".$deliveryboyName."<br>CONTACT NO: ".$db_mobileNumber;

        if($saved){
            $sentMobileResponse = $this->sendOTPtoMobile($mobileNumber, $otp);
            if($sentMobileResponse == 'success' || 1){
                $response = $this->setNewOtpDetails($cust_mobileNumber, '',$text);
            }
            $delivery_details['customer_name'] = $customerDetails['first_name'];
            $delivery_details['customer_email'] = $customerDetails['email'];
            $delivery_details['text'] = $text;
            $this->sendDeliveredEmail($delivery_details);
        }else{
            echo json_encode(array('status' => 'failed', 'message' => "Error Submiting details. Please try again later."));
            return false;
        }
        echo json_encode(array('status' => 'success'));
        return false;
    }

    public function sendDeliveredEmail($data){
        $customer_name = $data['customer_name'];
        $customer_email = $data['customer_email'];
        $customer_msg = $data['text'];
        $message = "<h4>Hi {$customer_name},</h4><br>";
        $message .= "<h4>{$customer_msg}</h4><br>";
        if($data['comment']){
            $message .= "<h4>COMMENTS: ".$data['comment']."</h4>";    
        }
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pepipost.com/v2/sendEmail",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"personalizations\":[{\"recipient\":\"$customer_email\"}],\"from\":{\"fromEmail\":\"getmore@rawpressery.com\",\"fromName\":\"Rawpressery - Order Status\"},\"subject\":\"Rawpressery Order Delivered\",\"content\":\"$message\"}",
            CURLOPT_HTTPHEADER => array(
                "api_key: 5b98b0b2687056ee6af430d2e4f807b5",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }

}