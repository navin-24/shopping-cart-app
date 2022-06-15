<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('cookie');
        $this->load->helper('common');
        $this->load->library('email');
        $this->load->model('user_model');
        $this->load->model('product_model');
        $this->load->model('cart_model');
    }

    public function login() {
        if ($this->session->userdata('logged_in')['customer_id'] != null) {
            redirect(BASE_URL);
        } else {
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;
            $this->load->library('facebook'); // Will load 'login_url' from Facebook
            $this->load->library('google'); // Will load 'login_url' from Google
            $this->load->view('header', $viewArr);
            $this->load->view('login');
            $this->load->view('footer', $viewArr);
        }
    }

    public function loginUser() {

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $password = $this->input->post('password');
        $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Please enter valid Email ID'));
            return false;
        }


        $this->verifyLoginWithPassword($email, $password);
    }

    public function registerUser() {
        $name = trim($this->input->post('name'));
        $email = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));
        $confirm_password = $this->input->post('confirm_password');

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Plese enter a valid email'));
            return false;
        }

        if ($password == NULL || $password == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Please enter the password'));
            return false;
        }

        if ($password !== $confirm_password) {
            echo json_encode(array('status' => 'failed', 'message' => 'Please enter the password & confirm password not matching'));
            return false;
        }


        $customerDetails = $this->user_model->checkEmailExistsOrNot($email);

        if ($customerDetails == NULL) {
            $encryptPwd = $this->strongPassword($password);
            $inputArr['first_name'] = $name;
            $inputArr['email'] = $email;
            $inputArr['password'] = $encryptPwd;
            $inputArr['created_at'] = date('Y-m-d h:i:s');
            $result = $this->user_model->registerUser($inputArr);
            if ($result) {
                $this->verifyLoginWithPassword($email, $password);
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Please try after sometime.'));
                return false;
            }
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'This Email already registered with us.'));
            return false;
        }
    }

    public function loginView() {
        $this->load->library('facebook'); // Will load 'login_url' from Facebook
        $this->load->library('google'); // Will load 'login_url' from Google
        $this->load->model('common_model');

        if ($this->session->userdata('logged_in')['customer_id'] != null) {
            redirect(BASE_URL);
        } else {
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;
            $this->load->view('header', $viewArr);
            $this->load->view('login');
            $this->load->view('footer', $viewArr);
        }
    }

    public function loginPassword() {
        $this->load->library('facebook'); // Will load 'login_url' from Facebook
        $this->load->library('google'); // Will load 'login_url' from Google
        $this->load->model('common_model');

        if ($this->session->userdata('logged_in')['customer_id'] != null) {
            redirect('/');
        } else {
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;
            $this->load->view('header', $viewArr);
            $this->load->view('login_password');
            $this->load->view('footer', $viewArr);
        }
    }

    function forgot_password() {
        if ($this->session->userdata('logged_in')['customer_id'] != null) {
            redirect(BASE_URL);
        } else {
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;

            $viewArr['view'] = 'forgot_password';
            $this->load->view('common', $viewArr);
        }
    }

    function forgot_password_new() {
        if ($this->session->userdata('logged_in')['customer_id'] != null) {
            redirect(BASE_URL);
        } else {
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;

            $viewArr['view'] = 'forgot_password_new';
            $this->load->view('common', $viewArr);
        }
    }

    public function sendOtpToEmailOrMobile2() {
        $numberOrEmail = $this->input->get_post('mobile_or_email');
        $createOtp = $this->generateOtp();

        if (is_numeric($numberOrEmail)) { // For Mobile OTP
            if ($this->mobileValidation($numberOrEmail) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
                return false;
            }

            $this->setNewOtpDetails($numberOrEmail, $createOtp); // Storing in DB
            $otp_sent = $this->sendOTPtoMobile($numberOrEmail, $createOtp); // API for sending OTP in mobile

            if ($otp_sent == 'failed') {
                echo json_encode(array('status' => 'success', 'message' => 'Unable to send the OTP. Please try after some time'));
                return false;
            } else {
                echo json_encode(array('status' => 'success', 'message' => 'OTP sent'));
            }
        } else { // For Email OTP
            $email = filter_var($numberOrEmail, FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Not a valid email'));
                return false;
            }

            $this->setNewOtpDetails($email, $createOtp); // Storing in DB

            $this->sendEmail($email, $subjectInEmail, $msgBody);
            echo json_encode(array('status' => 'success', 'message' => 'OTP sent', 'otp' => $createOtp));
        }
    }

    public function verifyEmailOrMobile() { // verification happening with OTP
        $this->load->library('login_history_lib');

        $numberOrEmail = $this->input->get_post('mobile_or_email'); // "rahul@raw.com"; // 9082067439;
        $otp = $this->input->get_post('otp'); // 8259
        $response = '';

        if (is_numeric($numberOrEmail)) {
            $customerDetails = $this->user_model->checkMobileMatchingWithOtp($numberOrEmail, $otp);

            if ($customerDetails) {
                $response = json_encode(array('status' => 'success', 'message' => 'Welcome'));
            } else {
                $response = json_encode(array('status' => 'failed', 'message' => 'Invalid OTP'));
            }
        } else {
            $customerDetails = $this->user_model->checkEmailMatchingWithOtp($numberOrEmail, $otp);

            if ($customerDetails) {
                $response = json_encode(array('status' => 'success', 'message' => 'Welcome'));
            } else {
                $response = json_encode(array('status' => 'failed', 'message' => 'Invalid OTP'));
            }
        }

        $responseData = json_decode($response, true);

        if ($responseData['status'] == 'success') {
            $this->session->set_userdata('logged_in', $customerDetails);
            if ($this->login_history_lib->checkUserSessionIdExists() == 0) {
                $this->login_history_lib->createLoginHistory("otp"); // Insert login history in DB
            }
            // if(isset($_COOKIE["usercid"])){
            $cart_id = $this->session->userdata('cart_id');
            if ($cart_id != null && $cart_id != '' && $cart_id != 0) { // update customer_id in DB table 'cart'
                $this->login_history_lib->setCustomerIdInCart();
            }
        }

        echo $response; // API response end here


        /* fetch cart items from DB */
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        // if($customer_id!=null && $customer_id!=''){
        $this->getUserCartContents($customer_id);
        // }
        $this->login_history_lib->updateCustomerDetailsInSession();
    }

    public function loginWithPassword() {
        $numberOrEmail = $this->input->get_post('mobile_or_email');
        // $new_user = false;

        if (is_numeric($numberOrEmail)) { // For Mobile
            if ($this->mobileValidation($numberOrEmail) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
                return false;
            }

            $customerDetails = $this->user_model->checkMobileExistsOrNot($numberOrEmail);

            if ($customerDetails == NULL) {
                $customerId = $this->user_model->insertMobileNumber($numberOrEmail);
                $new_user = true;
            } else {
                $customerId = $customerDetails['customer_id'];
            }

            echo json_encode(array('status' => 'success', 'message' => 'user created', 'data' => ['customer_id' => $customerId]));
        } else { // For Email
            $email = filter_var($numberOrEmail, FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Not a valid email'));
                return false;
            }

            $customerDetails = $this->user_model->checkEmailExistsOrNot($email);

            if ($customerDetails == NULL) {
                $customerId = $this->user_model->insertEmail($email);
                // $new_user = true;
            } else {
                $customerId = $customerDetails['customer_id'];
            }

            echo json_encode(array('status' => 'success', 'message' => 'user created', 'data' => ['customer_id' => $customerId]));
        }
    }

    public function verifyLoginWithPassword($userName, $password) {
        $this->load->library('login_history_lib'); // Will store login and logout history in DB

        $customerDetails = $this->user_model->checkUserWithPassword($userName);
        $passwordMatching = $this->passwordMatching($customerDetails['password'], $password);

        if ($customerDetails === NULL) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid email'));
            return false;
        }

        if ($passwordMatching == false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid password'));
            return false;
        }

        if ($customerDetails['is_active'] == 0) {
            echo json_encode(array('status' => 'failed', 'message' => 'Inactive user'));
            return false;
        }


        if ($customerDetails['customer_id'] != null) {
            unset($customerDetails['password'], $customerDetails['is_active']);
            $this->session->set_userdata('logged_in', $customerDetails);
            if ($this->login_history_lib->checkUserSessionIdExists() == 0) {
                $this->login_history_lib->createLoginHistory("password"); // Insert login history in DB
            }



            /* Fetch cart items from DB */
            $this->getUserCartContents($customerDetails['customer_id']);
            $this->login_history_lib->updateCustomerDetailsInSession();
            echo json_encode(array('status' => 'success', 'message' => 'Welcome')); // API response end here
        } else {
            $msg = 'Unable to process the request. Please try after some time';
            echo json_encode(array('status' => 'failed', 'message' => $msg));
        }
    }

    public function sendOTP() {
        $userName = $this->input->get_post('userName');
        $resend = $this->input->get_post('resend');
        $otp = mt_rand(111111, 999999);
        $mobile = false;
        if (is_numeric($userName)) { // For Mobile
            $mobile = true;
            if ($this->mobileValidation($userName) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Please enter valid Email ID/Mobile number'));
                return false;
            }
        } else {
            $email = filter_var($userName, FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Please enter valid Email ID/Mobile number'));
                return false;
            }
        }

        $response = $this->setNewOtpDetails($userName, $otp);

        if ($response) {
            if ($mobile) {
                $sentMobileResponse = $this->sendOTPtoMobile($userName, $otp);
                $customerDetails = $this->user_model->checkMobileExistsOrNot($userName);
                if ($customerDetails['email'] !== '') {
                    $sentEmailResponse = $this->sendOTPToEmail($customerDetails['email'], $otp);
                }
            } else {
                $sentEmailResponse = $this->sendOTPToEmail($userName, $otp);
                $customerDetails = $this->user_model->checkEmailExistsOrNot($userName);
                if ($customerDetails['mobile_number'] !== '') {
                    $sentMobileResponse = $this->sendOTPtoMobile($customerDetails['mobile_number'], $otp);
                }
            }

            if ($sentMobileResponse == 'success' || $sentEmailResponse == 'success') {
                if ($resend) {
                    $msg = 'OTP resent successfully';
                } else {
                    $msg = 'Please enter the OTP sent to </br>' . $userName;
                    if ($customerDetails) {
                        $msg = 'OTP sent sucessfully on registered email & mobile number';
                    }
                }

                echo json_encode(array('status' => 'success', 'message' => $msg));
            } else {
                $msg = 'Unable to process the request. Please try after some time';
                echo json_encode(array('status' => 'failed', 'message' => $msg));
            }
        } else {
            $msg = 'Unable to process the request. Please try after some time';
            echo json_encode(array('status' => 'failed', 'message' => $msg));
        }
    }

    function loginWithPassword2() {
        $userName = $this->input->post('userName');
        $password = $this->input->post('password');
        $mobile = false;

        if (is_numeric($userName)) { // For Mobile
            $mobile = true;
            if ($this->mobileValidation($userName) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Please enter valid Email ID/Mobile number'));
                return false;
            }
        } else {
            $email = filter_var($userName, FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Please enter valid Email ID/Mobile number'));
                return false;
            }
        }

        $this->verifyLoginWithPassword($userName, $password);
    }

    private function sendOTPToEmail($userName, $OTP) {
        //return 'success';
        $email = filter_var($userName, FILTER_SANITIZE_EMAIL);
        $msgBody = "Hi," . "<br><br>";
        $msgBody .= "$OTP is your One time password (OTP) to your Rawpressery account.: " . "<br><br>";
        $msgBody .= "Team RawPressery," . "<br>" . "<b>Website</b>: RawPressery.com";

        $subject = "OTP for login in RawPressery.com";
        $response = sendEmail($msgBody, $subject, $email);
        $responseArray = json_decode($response, true);
        //print_r($responseArray);

        if (strtolower($responseArray['message']) == 'success') {
            return 'success';
        } else {
            return 'failed';
        }
    }

    public function checkEmailOrMobileExistsOrNot() {

        $numberOrEmail = $this->input->get_post('mobile_or_email');
        $createOtp = $this->generateOtp();

        if (is_numeric($numberOrEmail)) { // For Mobile
            if ($this->mobileValidation($numberOrEmail) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
                return false;
            }

            $customerDetails = $this->user_model->checkMobileExistsOrNot($numberOrEmail);

            if ($customerDetails == NULL) {

                $otpSentMsg = '';
                $this->setNewOtpDetails($numberOrEmail, $createOtp); // Storing in DB
                $otp_sent = $this->sendOTPtoMobile($numberOrEmail, $createOtp);

                if ($otp_sent == 'failed') {
                    $otpSentMsg = 'failed';
                }

                if ($otp_sent == 'success') {
                    $otpSentMsg = 'success';
                }
                //echo json_encode(array('status'=>'failed', 'message'=>'User not available', 'otp_msg'=>$otpSentMsg)); */

                echo json_encode(array('status' => 'failed', 'message' => 'User not available', 'otp_msg' => $otpSentMsg));
                return false;
            }

            if ($customerDetails['is_active'] == 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Inactive user'));
                return false;
            }

            if ($customerDetails['password'] == NULL || $customerDetails['password'] == '') {
                echo json_encode(array('status' => 'failed', 'message' => 'Blank password'));
                return false;
            }

            $customerId = $customerDetails['customer_id'];
            echo json_encode(array('status' => 'success', 'message' => 'Yes user exists', 'data' => ['customer_id' => $customerId]));
        } else { // For Email
            $email = filter_var($numberOrEmail, FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Not a valid email'));
                return false;
            }

            $customerDetails = $this->user_model->checkEmailExistsOrNot($email);

            if ($customerDetails == NULL) {

                $msgBody = "Hi," . "<br><br>";
                $msgBody .= "You have requested following OTP: " . "<b>$createOtp</b>" . "<br><br><br>";
                $msgBody .= "Team RawPressery," . "<br>" . "<b>Website</b>: RawPressery.com";

                $this->setNewOtpDetails($email, $createOtp); // Storing in DB

                $subjectInEmail = "OTP for login in RawPressery.com";
                $this->sendEmail($email, $subjectInEmail, $msgBody);
                echo json_encode(array('status' => 'failed', 'message' => 'User not available', 'otp_msg' => 'success', 'otp' => $createOtp));
                return false;
            }

            if ($customerDetails['is_active'] == 0) { // check user active or not from front end
                echo json_encode(array('status' => 'failed', 'message' => 'Inactive user'));
                return false;
            }

            if ($customerDetails['password'] == NULL || $customerDetails['password'] == '') {
                echo json_encode(array('status' => 'failed', 'message' => 'Blank password'));
                return false;
            }

            $customerId = $customerDetails['customer_id'];
            echo json_encode(array('status' => 'success', 'message' => 'Yes user exists', 'data' => ['customer_id' => $customerId]));
        }
    }

    public function mobileValidation($mobile) {
        if ((strlen($mobile) < 10) || (strlen($mobile) > 10) || (substr_count($mobile, 0) == 10)) {
            return false;
        }
        return true;
    }

    public function generateOtp() {
        return mt_rand(111111, 999999);
    }

    public function logout() {

        $this->load->library('google');
        $this->load->library('login_history_lib');
        $this->login_history_lib->updateLogoutDetails();
        // Update logout time in DB
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('rp_channel');
        $this->session->unset_userdata('rp_campaign');
        // $this->google->revokeToken
        $this->cart->destory();
        $this->session->sess_destroy(); // It will also remove cart items
        //var_dump($this->cart->contents());die;
        redirect('login');
    }

    public function facebookLoginResponse() {
        $this->load->library('facebook');
        $customer_id = $this->facebook->responseFromFB();
        //$customer_id = $this->session->userdata('logged_in')['customer_id'];
        // if($customer_id!=null && $customer_id!=''){
        $this->getUserCartContents($customer_id);
        redirect(BASE_URL);
        // }
    }

    public function googleLoginResponse() {
        $this->load->library('google');
        $customer_id = $this->google->responseFromGoogle();
        //$customer_id = $this->session->userdata('logged_in')['customer_id'];
        //if($customer_id!=null && $customer_id!=''){
        $this->getUserCartContents($customer_id);
        redirect(BASE_URL);
        // }
    }

    public function verifyOTP() {
        $this->load->library('login_history_lib');

        $userName = $this->input->get_post('userName');
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


        $otpDetails = $this->user_model->getLastOtpDetails($userName);
        $dbExpiryTime = date("Y-m-d H:i:s", strtotime($otpDetails['expiry_time']));

        if ($otp != $otpDetails['otp_value']) {
            echo json_encode(array('status' => 'failed', 'message' => 'OTP is incorrect'));
            return false;
        }

        if (strtotime($dbExpiryTime) < strtotime($currentDatetime)) {
            echo json_encode(array('status' => 'failed', 'message' => 'expired'));
            return false;
        }

        if (is_numeric($userName)) { // For Mobile OTP
            if ($this->mobileValidation($userName) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
                return false;
            }

            $customerDetails = $this->user_model->checkMobileExistsOrNot($userName);
            if ($customerDetails == NULL) {
                $customerId = $this->user_model->insertMobileNumber($userName);
            } else {
                $customerId = $customerDetails['customer_id'];
            }

        } else { // For Email OTP
            if (filter_var($userName, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Not a valid email'));
                return false;
            }

            $customerDetails = $this->user_model->checkEmailExistsOrNot($userName);
            if ($customerDetails == NULL) {
                $customerId = $this->user_model->insertEmail($userName);
            } else {
                $customerId = $customerDetails['customer_id'];
            }
        }

        if ($customerId != null) {
            if ($otp == $otpDetails['otp_value']) {
                $this->user_model->updateOtpVerified($otpDetails['otp_id']); // Set status 'verified' in DB
                $this->session->set_userdata('logged_in', $customerDetails);
                if ($this->login_history_lib->checkUserSessionIdExists() == 0) {
                    $this->login_history_lib->createLoginHistory("otp"); // Insert login history in DB
                }

                $this->getUserCartContents($customerId);
                $this->login_history_lib->updateCustomerDetailsInSession($customerId);
                echo json_encode(array('status' => 'success', 'message' => 'Welcome'));
            }
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Please try after sometime'));
        }
    }

    public function setNewOtpDetails($number_or_email, $otp_value) {
        date_default_timezone_set('asia/kolkata');

        $otp_details['otp_value'] = $otp_value;

        if (is_numeric($number_or_email)) {
            $otp_details['mobile_number'] = $number_or_email;
        } else {
            $otp_details['email'] = $number_or_email;
        }

        $otp_type = '';
        if ($this->input->post('otp_type') == '') {
            $otp_type = 'signup';
        }
        if ($this->input->post('otp_type') == 'password') {
            $otp_type = 'password';
        }

        $otp_details['otp_type'] = $otp_type;

        $otp_details['status'] = 'sent';
        $otp_details['expiry_time'] = date('Y-m-d H:i:s', strtotime("+5 minutes"));

        return $this->user_model->saveOtpDetails($otp_details);
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
                // echo 'success';
            } else {
                return 'failed';
                // echo 'failed';
            }
        } else {
            return 'failed';
        }

        /*
          print_r($smsErrorCode);
          if(in_array(102, $errorCodeAndValue)){
          echo json_encode(array('status'=>'failed', 'message'=>'Invalid mobile number'));
          return false;
          }
          if(in_array('error', $getTagName)){
          echo json_encode(array('status'=>'failed', 'message'=>'OTP not sent, please try again after sometime'));
          return false;
          }
         */
    }

    public function passwordUpdate() {

        $otp = $this->input->get_post('otp');
        $pwd = trim($this->input->get_post('password'));
        $confirmPassword = trim($this->input->get_post('confirmPassword'));
        $userName = $this->input->get_post('userName');
        $currentDatetime = date("Y-m-d H:i:s");

        if ($userName == null || $userName == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Email/Mobile cannot be blank'));
            return false;
        }

        if ($otp == null || $otp == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'OTP field cannot be blank'));
            return false;
        }

        if ($pwd == null || $pwd == '' || $confirmPassword == null || $confirmPassword == '') {
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid password'));
            return false;
        }

        if ($confirmPassword != $pwd) {
            echo json_encode(array('status' => 'failed', 'message' => 'Password not matching'));
            return false;
        }

        if (!is_numeric($otp) || strlen($otp) < 6 || strlen($otp) > 6) {
            // echo json_encode(array('status'=>'failed', 'message'=>'OTP should be numeric and 6 digits'));
            echo json_encode(array('status' => 'failed', 'message' => 'Invalid OTP'));
            return false;
        }

        $otpDetails = $this->user_model->getLastOtpDetails($userName);
        $dbExpiryTime = date("Y-m-d H:i:s", strtotime($otpDetails['expiry_time']));

        if ($otp != $otpDetails['otp_value']) {
            echo json_encode(array('status' => 'failed', 'message' => 'Wrong OTP'));
            return false;
        }

        if (strtotime($dbExpiryTime) < strtotime($currentDatetime)) {
            echo json_encode(array('status' => 'failed', 'message' => 'expired'));
            return false;
        }

        if (is_numeric($userName)) { // For Mobile Password
            if ($this->mobileValidation($userName) == false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Mobile number is not valid'));
                return false;
            }
        } else { // For Email Password
            if (filter_var($userName, FILTER_VALIDATE_EMAIL) === false) {
                echo json_encode(array('status' => 'failed', 'message' => 'Not a valid email'));
                return false;
            }
        }


        $encryptpwd = $this->strongPassword($pwd); // get strong password
        $passwordSetStatus = $this->user_model->setPassword($userName, $encryptpwd); // set strong password

        if ($passwordSetStatus === false) {
            echo json_encode(array('status' => 'failed', 'message' => 'Password has been not set'));
            return false;
        }

        echo json_encode(array('status' => 'success', 'message' => 'Password has been updated successfully'));
    }

    public function sendEmail($to, $subject, $msg) {
        $mailHeaders = "MIME-Version: 1.0" . "\r\n";
        $mailHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $mailHeaders .= "From: getmore@rawpressery.com\r\n";
        $mailHeaders .= "Reply-To: amzad@rawpressery.com\r\n";
        $mailHeaders .= "Return-Path: rahul@rawpressery.com\r\n";
        $mailHeaders .= "CC: amey@rawpressery.com\r\n";
        $mailHeaders .= "BCC: amzad@rawpressery.com\r\n";

        mail($to, $subject, $msg, $mailHeaders);
    }

    public function passwordMatching($dbPassword, $userPassword) {
        $pwd = explode(':', $dbPassword);
        $pwd2Part = $pwd[1];
        $dbSystemPassword = $pwd[0];
        $userCustomPassword = md5($pwd2Part . $userPassword);

        if ($dbSystemPassword == $userCustomPassword) {
            return true;
        }
        return false;
    }

    public function strongPassword($password) { // For storing or updating purpose
        $salt = $this->getRandomString();
        if ($password != null && $salt != null) {
            return md5($salt . $password) . ':' . $salt;
        }
    }

    public function getRandomString() {
        $range = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $range; $i++) {
            $index = mt_rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

    function getUserCartContents($usrid = '') {
        if ($usrid) {
           
            $csql = "SELECT cart_id FROM " . TABLE_CART . " WHERE customer_id=" . $usrid . " AND is_active = 1 ORDER BY 1 DESC LIMIT 1";
            $cartDbResult = $this->db->query($csql)->row_array();
            if ($cartDbResult) {
                $cart_id = $cartDbResult['cart_id'];
                $this->session->set_userdata('cart_id', $cartDbResult['cart_id']);

                $sql = "SELECT cart_item_id, cart_item.sku, cart_item.qty, cart_item.price_incl_tax, cart_item.product_name, cart_item.options, cart_item.cart_id FROM " . TABLE_CART_ITEM . " WHERE cart_id=" . $cart_id;
                $cartItemResult = $this->db->query($sql)->result();
                $this->insertUpdateCart($cartItemResult, $cart_id);
                //$returnData = $this->cart_model->updateCartTablesAfterLogin($current_cart_id, $cart_id);
                //return $returnData;
            } else {

                $cart_id = $this->session->userdata('cart_id');
                if ($cart_id != null && $cart_id != '' && $cart_id != 0) {
                    $this->cart_model->updateCustomerIdInCart($cart_id);
                } else {
                    $this->cart_model->insertDataInCart($usrid);
                }
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    function insertUpdateCart($cartItemResult, $cart_id) {
        $skuArr=array();
        $total = $this->cart->total_items();
        foreach ($cartItemResult as $key => $val) {
            $options = json_decode($val->options, true);
            $data = array('id' => $val->sku, 'qty' => $val->qty, 'price' => $val->price_incl_tax, 'name' => $val->product_name, 'options' => $options);
            $this->cart->insert($data);
            $skuArr[$key] = $val->sku;
        }


        if ($total > 0) {
            foreach ($this->cart->contents() as $cart_item) {
                if (in_array($cart_item['id'], $skuArr) !== FALSE) {
                    $this->db->where('cart_id', $cart_id);
                    $this->db->where('sku', $cart_item['id']);
                    $updateArr['qty'] = $updateQty = $cart_item['qty'];
                    $updateArr['updated_at'] = date('Y-m-d H:i:s');
                    $this->db->update(TABLE_CART_ITEM, $updateArr);
                    unset($updateArr);
                } else {
                    $cartArr['cart_id'] = $cart_id;
                    $cartArr['qty'] = $cart_item['qty'];
                    $cartArr['product_id'] = $cart_item['options']['product_id'];
                    $cartArr['product_name'] = $cart_item['name'];
                    $cartArr['sku'] = $cart_item['id'];
                    $cartArr['price_incl_tax'] = $cart_item['price'];
                    $cartArr['options'] = json_encode($cart_item['options']);
                    $cartArr['created_at'] = date('Y-m-d H:i:s');
                    $cartArr['updated_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('cart_item', $cartArr);
                }
            }

            $updateArr['grand_total'] = $this->cart->total();
            $updateArr['subtotal'] = $this->cart->total();
            $updateArr['items_count'] = count($this->cart->contents());
            $updateArr['items_qty'] = $this->cart->all_item_count();
            $updateArr['updated_at'] = date('Y-m-d H:i:s');
            $customer_id = $this->session->userdata['logged_in']['customer_id'];

            $this->db->where('customer_id', $customer_id);

            $this->db->where('cart_id', $cart_id);
            $this->db->update('cart', $updateArr);
        }
    }

    public function sendForgotEmail() {
        $email = $this->input->post('email');

        $customerDetails = $this->user_model->checkEmailExistsOrNot($email);
        //print_r($customerDetails);
        if ($customerDetails != '' & $customerDetails !== NULL) {
            $inputArr['token'] = $token = $this->generateRandomString();
            $inputArr['expiry_datetime'] = date('Y-m-d H:i:s', strtotime("+10 minutes"));
            $inputArr['email'] = $email;
            $result = $this->user_model->insertForgotToken($inputArr);
            //print_r($result);
            if ($result) {
                $viewArr['email'] = $email;
                $viewArr['token'] = $token;
                $message = $this->load->view('template/forgot_password', $viewArr, TRUE);
                $strippedMessage = trim(preg_replace('/\s+/', ' ', $message));
                $subject = 'Raw Pressery: Password Reset';
                $response = sendEmail($strippedMessage, $subject, $email);
                $responseArr = json_decode($response, true);
                if (strtolower($responseArr['message']) == 'success') {
                    $flsh_msg = 'If there is an account associated with ' . $email . ' you will receive an email with a link to reset your password.';
                } else {
                    $flsh_msg = 'Please try after sometime.';
                }
            }
        } else {
            $flsh_msg = 'Sorry, Please enter valid email id.';
        }

        $this->session->set_flashdata('flsh_msg', $flsh_msg);
        redirect('forgotPassword');
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return md5($randomString);
    }

    public function resetPassword($token) {
        if ($token) {
            $tokenData = $this->user_model->getDetailsByToken($token);
            //print_r($tokenData);die;
            if ($tokenData !== NULL) {
                $email = $tokenData['email'];
                $expiry_time = $tokenData['expiry_datetime'];
                $currentDatetime = date("Y-m-d H:i:s");
                if (strtotime($expiry_time) < strtotime($currentDatetime)) {
                    $this->session->set_flashdata('flsh_msg', 'Your password reset link has expired.');
                    redirect('forgotPassword');
                }
            } else {
                $this->session->set_flashdata('flsh_msg', 'Invalid User');
                redirect('forgotPassword');
            }

            $viewArr['token'] = $token;
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;
            $this->load->view('header', $viewArr);
            $this->load->view('reset_password');
            $this->load->view('footer', $viewArr);
        }
    }

    function savePassword() {
        $token = $this->input->post('token');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        if ($token == '' || $password == '' || $confirm_password == '' || $confirm_password != $password) {
            $message = 'Invalid request';
            $resetStatus = 'Alert';
        }

        $tokenData = $this->user_model->getDetailsByToken($token);
        if ($tokenData !== NULL) {
            $email = $tokenData['email'];
            $encryptpwd = $this->strongPassword($password); // get strong password
            $passwordSetStatus = $this->user_model->setPassword($email, $encryptpwd); // set strong password

            if ($passwordSetStatus === false) {
                $message = 'Password has been not set';
                $resetStatus = 'Alert';
            } else {
                $message = 'Your password is successfully changed.';
                $resetStatus = 'Success';
            }
        } else {
            $message = 'User not found';
            $resetStatus = 'Alert';
        }

        $this->session->set_flashdata('resetflshMsg', $message);
        $this->session->set_flashdata('resetStatus', $resetStatus);
        redirect('login');
    }

}
