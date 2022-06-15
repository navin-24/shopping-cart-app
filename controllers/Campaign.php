<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Campaign extends MY_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->model(array('campaign_model','common_model'));
         $this->load->library('form_validation');

    }

    function rawtalk() {
    	$campaign_regId = $this->session->userdata('camp_regId');
    	$camp_regEerror = $this->session->userdata('camp_reg_payment_error');
        
        if(!empty($campaign_regId)){
        	$this->session->unset_userdata('camp_regId');
        }
        if(!empty($camp_regEerror)){
        	$this->session->unset_userdata('camp_reg_payment_error');
        }

    	$viewArr['pageName'] = $this->pageName;
        $segmentCount = $this->uri->total_segments();
        if ($segmentCount > 0) {
            $viewArr['page_meta'] = $this->common_model->getPageMeta($page_name = 'rawtalk');
        }
        $viewArr['showRegPopup'] = 'no';

        $postData = $this->input->post('submit_data');
        if($postData){
        	$rawtalk_validation = $this->campaign_model->validate();
        	if($rawtalk_validation == FALSE){
        		$returnArr['status'] = 'failure';
            	$returnArr['error'] = array('customer_name'=>strip_tags(form_error('customer_name')),'customer_contact_number'=>strip_tags(form_error('customer_contact_number')),'customer_email'=>strip_tags(form_error('customer_email')),'customer_city'=>strip_tags(form_error('customer_city')),'somethingwrong'=>'');	
        	} else {
        		$isRegistered = $this->campaign_model->isUserRegistered($this->input->post('customer_contact_number'),RAWTALK_CAMPAIGN);
        		if($isRegistered == 'no'){
        			$rand = rand(1,99);
        			$registrationId = 'RT'.date('YmdHis').$rand;
        			$formData = array('campaign_name'=>RAWTALK_CAMPAIGN,'registration_id'=>$registrationId,'customer_name'=>$this->input->post('customer_name'),'customer_contact_number'=>$this->input->post('customer_contact_number'),'customer_email'=>$this->input->post('customer_email'),'customer_city'=>$this->input->post('customer_city'),'amount'=>RAWTALK_AMOUNT,'remote_id'=>$_SERVER['REMOTE_ADDR'],'created_at'=>date('Y-m-d H:i:s'),'status'=>'pending');
	        		
	        		$save_data = $this->campaign_model->save('',$formData);
	        		if($save_data == TRUE){
	        			$this->session->set_userdata('campaignreg_id',$registrationId);
	        			$returnArr['status'] = 'success';
            			$returnArr['error'] = array('customer_name'=>'','customer_contact_number'=>'','customer_email'=>'','customer_city'=>'','somethingwrong'=>'');
            		} else {
            			$returnArr['status'] = 'failure';
            			$returnArr['error'] = array('customer_name'=>'','customer_contact_number'=>'','customer_email'=>'','customer_city'=>'','somethingwrong'=>'Oops, something went wrong, please try again');
            		}	
        		} else {
        			$returnArr['status'] = 'already registered';
            		$returnArr['error'] = array('customer_name'=>'','customer_contact_number'=>'','customer_email'=>'','customer_city'=>'','somethingwrong'=>'');
        		}            	
        	}
   	        echo json_encode($returnArr);exit;
        } else {
        	if($campaign_regId == '' && $camp_regEerror == ''){
        		$viewArr['showRegPopup'] = 'no';
        		$viewArr['isRegSuccess'] = 'no';
        	} else {
        		$viewArr['showRegPopup'] = 'yes';
        		$viewArr['isRegSuccess'] = (!empty($campaign_regId) && empty($camp_regEerror))?'yes':'no';
        	}
        	$this->load->view('header', $viewArr);
        	$this->load->view('campaign/rawtalk');
        	$this->load->view('footer', $viewArr);
		}
	}

	public function redirect() {
		$registration_id = $this->session->userdata('campaignreg_id');
        $registration_details = $this->campaign_model->getRegistrationDetails($registration_id);
		if(!empty($registration_id) && !empty($registration_details)) {
			$secretKey = CF_SECRET_KEY;
	        $postData = array(
	            "appId" => CF_APP_ID,
	            "orderId" => $registration_details['registration_id'],
	            "orderAmount" => RAWTALK_AMOUNT,
	            "orderCurrency" => 'INR',
	            "customerName" => $registration_details['customer_name'],
	            "customerPhone" => $registration_details['customer_contact_number'],
	            "customerEmail" => $registration_details['customer_email'],
	            "returnUrl" => BASE_URL . '/campaign/CFResponse',
	            "notifyUrl" => BASE_URL . '/campaign/CFNotify',
	        );
	        ksort($postData);
	        $signatureData = "";
	        foreach ($postData as $key => $value) {
	            $signatureData .= $key . $value;
	        }
	        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
	        $postData['signature'] = base64_encode($signature);
	        $inputData['postData'] = $postData;
	        $inputData['redirectUrl'] = CFURL;
	        $this->load->view('campaign/redirect', $inputData);
    	} else {
    		redirect(base_url('rawtalk'));
    	}
    }

    public function CFResponse($requestType = "") {
       log_message('error', print_r($_REQUEST, true));
       if ($this->input->server('REQUEST_METHOD') == 'POST') {
       		$orderId = $this->input->post('orderId');
            $orderAmount = $this->input->post('orderAmount');
            $paymentMode = $this->input->post('paymentMode');
            $referenceId = $this->input->post('referenceId');
            $txStatus = $this->input->post('txStatus');
            $txTime = $this->input->post('txTime');
            $txMsg = $this->input->post('txMsg');
            $signature = $this->input->post('signature');
            $updatedData['payment_method'] = $paymentMode;
            $secretKey = CF_SECRET_KEY;

            $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
            $hash_hmac = hash_hmac('sha256', $data, $secretKey, true);
            $computedSignature = base64_encode($hash_hmac);
            if (strcmp($computedSignature, $signature)) {
                $response['status'] = 0;
                $response['reason'] = "invalid";
                return $response;
            }

            if ($txStatus == "SUCCESS") {
            	$updatedData['status'] = 'completed';
                $updatedData['referenceId'] = $referenceId;
                $updatedData['payment_status'] = $txStatus;
            	$updatedData['updated_on'] = date('Y-m-d H:i:s');
				$this->campaign_model->saveByOrderId($orderId, $updatedData);                
            	$this->session->unset_userdata('campaignreg_id');
            	$this->session->set_userdata('camp_regId', $orderId);
                redirect(BASE_URL('rawtalk'));
            } else {
            	switch ($txStatus) {
            		case "CANCELLED":
	                    $error = "Your payment has been cancelled";
	                    $updatedData['status'] = 'cancelled';
	                    $updatedData['referenceId'] = $referenceId;
                        $updatedData['payment_status'] = $txStatus;
                        $updatedData['updated_on'] = date('Y-m-d H:i:s');
	                    $this->session->set_userdata('camp_reg_payment_error', $error);
	                    $this->campaign_model->saveByOrderId($orderId, $updatedData);
	                    redirect(base_url('rawtalk'));
                    case "FLAGGED":
                        $error = "Your payment is complete and under review.";
                        break;
                    default:
                        $error = "Your payment has failed. Please try again.";
                        $updatedData['status'] = 'cancelled';
                        $updatedData['referenceId'] = $referenceId;
                        $updatedData['payment_status'] = $txStatus;
                        $updatedData['updated_on'] = date('Y-m-d H:i:s');
                        $this->session->set_userdata('camp_reg_payment_error', $error);
                        $this->campaign_model->saveByOrderId($orderId, $updatedData);
                        redirect(base_url('rawtalk'));        
            	}
            }
       } else {
       		redirect(base_url('rawtalk'));
       }
    }

    public function CFNotify() {
    	log_message('error', print_r($_REQUEST, true));
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
        	$orderId = $this->input->post('orderId');
            $orderAmount = $this->input->post('orderAmount');
            $paymentMode = $this->input->post('paymentMode');
            $referenceId = $this->input->post('referenceId');
            $txStatus = $this->input->post('txStatus');
            $txTime = $this->input->post('txTime');
            $txMsg = $this->input->post('txMsg');
            $signature = $this->input->post('signature');
            $updatedData['payment_method'] = $paymentMode;
            $secretKey = CF_SECRET_KEY;

            $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
            $hash_hmac = hash_hmac('sha256', $data, $secretKey, true);
            $computedSignature = base64_encode($hash_hmac);

            if (strcmp($computedSignature, $signature)) {
                $response['status'] = 0;
                $response['reason'] = "invalid";
                return $response;
            }

            if ($txStatus == "SUCCESS") {
                $updatedData['status'] = 'completed';
                $updatedData['referenceId'] = $referenceId;
                $updatedData['payment_status'] = $txStatus;
                $updatedData['updated_on'] = date('Y-m-d H:i:s');
                $this->campaign_model->saveByOrderId($orderId, $updatedData);
                $response['status'] = 1;
                $response['reason'] = 'success';
            } else {
            	switch ($txStatus) {
                	case "CANCELLED":
                        $error = "Your payment has been cancelled";
                        $updatedData['status'] = 'cancelled';
                        $updatedData['referenceId'] = $referenceId;
                        $updatedData['payment_status'] = $txStatus;
                        $updatedData['updated_on'] = date('Y-m-d H:i:s');
                        $this->campaign_model->saveByOrderId($orderId, $updatedData);
                        break;
                    case "FLAGGED":
                        $error = "Your payment is complete and under review.";
                        break;
                    default:
                        $error = "Your payment has failed. Please try again.";
                        $updatedData['status'] = 'cancelled';
                        $updatedData['referenceId'] = $referenceId;
                        $updatedData['payment_status'] = $txStatus;
                        $updatedData['updated_on'] = date('Y-m-d H:i:s');
                        $this->campaign_model->saveByOrderId($orderId, $updatedData);
                }
                $response['status'] = 0;
                $response['reason'] = 'failed';
            }
        } else {
        	redirect(base_url('rawtalk'));
        }
    }

    public function rawtalkcsv($from='',$to='',$type='download'){
        $date = date('dMy');
        $this->validateDates($from,$to);
        $data = $this->campaign_model->getCampaignCSVData($from,$to,RAWTALK_CAMPAIGN);
        if($type=='download'){
            $this->exports_data($data,'RawTalk_Users_'.$date.".csv");
        }
    }

    public function validateDates($from,$to){
        $this->verify_date($from);
        $this->verify_date($to);
        if($from>$to){
            echo "From date should be less than To date";
            exit;
        }
    }

    public function verify_date($date){
        $date_arr = explode('-', $date);
        if(strlen($date_arr[0])!=4 || strlen($date_arr[1])!=2 || strlen($date_arr[2])!=2 || !is_numeric($date_arr[0]) || !is_numeric($date_arr[1]) || !is_numeric($date_arr[2])){
            echo "Please enter a valid date in format yyyy-mm-dd";
            exit;
        }
    }

    public function exports_data($data,$filename){
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"".$filename."\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w+');
        fputcsv($handle, array('Name','Contact Number', 'Email ID', 'City','Registration ID'));  
        
        if(!empty($data)) {
            foreach ($data as $data) {
                fputcsv($handle, $data);
            }
        }
        return stream_get_contents($handle);
    }
}