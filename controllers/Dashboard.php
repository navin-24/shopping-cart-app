<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('dashboard_model');
        $this->logged_in();
    }

    private function logged_in() {
        if($this->session->userdata('logged_in')==null){
           redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        //$this->load->view('header', $data);
        $this->load->view('dashboard/index', $data);
        //$this->load->view('footer', $data);
        /*print_r($_SESSION);
        $customer_id = $this->session->userdata('customer_id');
        $customerData = $this->dashboard_model->getCustomerInfo($customer_id);
        $billingAddress = $this->dashboard_model->billingAddress($customer_id);
        $recentOrders = $this->dashboard_model->recentOrders($customer_id);
        print_r($recentOrders);*/
    }

    public function welcome(){
        $viewArr['city_list'] = $this->dashboard_model->getCityList();
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('dashboard/welcome');
        $this->load->view('footer', $viewArr);
    }
    
    public function dashboardForCustomer(){

        // $customer = $this->dashboard_model->getNameEmail();
        $customerEmail=$this->session->userdata('logged_in')['email'];
        $customerMobile=$this->session->userdata('logged_in')['mobile_number'];
        $customerId=$this->session->userdata('logged_in')['customer_id'];

        if($customerEmail==null || $customerEmail==''){
            $getEmail = $this->dashboard_model->getEmail($customerId);
            $this->updateEmailInSession($getEmail);
            $customerEmail = $this->session->userdata('logged_in')['email'];
        }
        if($customerMobile==null || $customerMobile==''){
            $getMobile = $this->dashboard_model->getMobile($customerId);
            $this->updateMobileInSession($getMobile);
            $customerMobile = $this->session->userdata('logged_in')['mobile_number'];
        }

        $data['billing_address'] = ($this->getAddressForBilling()!=null && $this->getAddressForBilling()!='') ? $this->getAddressForBilling(): "";
        $data['fullname'] = $this->session->userdata('logged_in')['first_name'] . ' ' . $this->session->userdata('logged_in')['last_name'];
        $data['email'] = $customerEmail;
        $data['mobile_number'] = $customerMobile;
        $data['recent_orders'] = $this->dashboard_model->getAllOrderItems();
        $data['total_items'] = $this->dashboard_model->totalAllOrderItems();

        if($data['email']!=null || $data['email']!='' || $data['mobile_number']!=null || $data['mobile_number']!=''){
            echo json_encode(array('status'=>'success', 'message'=>'Records available', 'data'=>$data));
        } else {
            exit(json_encode(array('status'=>'failed', 'message'=>'Sorry, no records available')));
        }
    }

    public function getRecentOrders(){
        $data['recent_orders'] = $this->dashboard_model->getAllOrderItems();
        $data['total_items'] = $this->dashboard_model->totalAllOrderItems();
        
        if($data['total_items']>0){
            echo json_encode(array('status'=>'success', 'message'=>'Records available', 'data'=>$data));
        }else {
            exit(json_encode(array('status'=>'failed', 'message'=>'Sorry, no records available')));
        }
    }

    public function getAddressForBilling(){
        $getDefaultBillingAddress = $this->dashboard_model->getDefaultBillingAddress();
        $getLastAddress = $this->dashboard_model->getLastAddress();
        $getAddress = ($getDefaultBillingAddress!=null && $getDefaultBillingAddress!='') ? $getDefaultBillingAddress : $getLastAddress;
        return $getAddress;
    }

    /*public function getOrderItems(){
        $data = $this->dashboard_model->getAllOrderItems();

        if($data!=null && $data!=''){
            echo json_encode(array('status'=>'success', 'message'=>'Records available', 'data'=>$data));
        }else{
            exit(json_encode(array('status'=>'failed', 'message'=>'Sorry, no records available')));
        }
    }*/

    /*public function getItemsOrderedDetail(){
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('dashboard/items-ordered');
        $this->load->view('footer', $viewArr);
    }*/

    public function personalInfo(){
        $data = $this->dashboard_model->getCustomerDetails();

        if($data['last_name']==null || $data['last_name']==''){
            $data['last_name'] = '';
        }

        $allData = array('first_name'=>$data['first_name'], 'last_name'=>$data['last_name'], 'email'=>$data['email']);
        $password = ($data['password']!=null && $data['password']!='') ? 'available' : 'empty';

        if($data!=null && $data!=''){
            echo json_encode(array('status'=>'success', 'message'=>'Records available', 'password'=>$password, 'data'=>$allData));  
        }else{
            echo json_encode(array('status'=>'failed', 'message'=>'Records not available', 'password'=>$password, 'data'=>$allData));
        }
    }

    public function updateNameAndEmail(){

        $dbEmail = $this->dashboard_model->getDBemail();
        $email = $this->input->post('email');

        if($this->input->post('fullname')==null || $this->input->post('fullname')==''){
            // echo json_encode(array('status'=>'failed', 'message'=>'Full Name, atleast 3 characters'));
            echo json_encode(array('status'=>'failed', 'message'=>'Full Name required'));
            return false;
        }

        if($this->input->post('fullname')!=null && $this->input->post('fullname')!=''){
            $first_name = strstr($this->input->post('fullname'), " ", true);
            $last_name = strstr($this->input->post('fullname')," ");
            if($first_name==null || $first_name==''){
                $first_name = trim($this->input->post('fullname'));
            }
        }

        if($this->checkEmailValid($email)==false){
            echo json_encode(array('status'=>'failed', 'message'=>'Invalid email'));
            return false;
        }

        $data = array('first_name'=>trim($first_name), 'last_name'=>trim($last_name), 'email'=>trim($email));        

        if($dbEmail==$email){
            $recordStatus = $this->dashboard_model->updateNameEmail($data);
            if($recordStatus==false){
                echo json_encode(array('status'=>'failed', 'message'=>'Something went wrong, please try again after sometime'));
                return false; 
            }
        }else{
            $checkEmail = $this->dashboard_model->checkEmailExists($email);
            if($checkEmail!=null && $checkEmail!=''){
                echo json_encode(array('status'=>'failed', 'message'=>'This email already used'));
                return false;
            }
            $recordStatus = $this->dashboard_model->updateNameEmail($data);
            if($recordStatus==false){
                echo json_encode(array('status'=>'failed', 'message'=>'Something went wrong, please try again after sometime'));
                return false; 
            }
        }

        $data = $this->dashboard_model->getNameEmail();
        echo json_encode(array('status'=>'success', 'message'=>'The account information has been saved', 'data'=>$data));

        $this->updateNameEmailInSession($data); // Storing in session
    }

    public function updatePassword(){

        $currentPwd = trim($this->input->get_post('currentPassword'));
        $newPwd = trim($this->input->get_post('newPassword'));
        $confirmPwd = trim($this->input->get_post('confirmPassword'));

        $passwordInDB = $this->dashboard_model->getCustomerPassword();

        if($newPwd==null || $newPwd=='' || $confirmPwd==null || $confirmPwd==''){
            echo json_encode(array('status'=>'failed', 'message'=>'Invalid password'));
            return false;
        }

        if($passwordInDB!=null && $passwordInDB!=''){
            $passwordStatus = $this->passwordMatching($passwordInDB, $currentPwd);
            // $pwd = $this->strongPassword($pwd); // get strong password
            // if($passwordInDB!=$currentPwd){
            if($passwordStatus==false){
                echo json_encode(array('status'=>'failed', 'message'=>'Invalid current password'));
                return false;
            }
        }

        if($newPwd!=$confirmPwd){
            echo json_encode(array('status'=>'failed', 'message'=>'Please make sure your passwords match'));
            return false;
        }

        $newPwd = $this->strongPassword($newPwd);
        $pwdStatus = $this->dashboard_model->updateCustomerPassword($newPwd);
        if($pwdStatus==false){
            echo json_encode(array('status'=>'failed', 'message'=>'Something went wrong, please try again after sometime'));
            return false; 
        }

        $password = ($this->dashboard_model->getCustomerPassword()!=null && $this->dashboard_model->getCustomerPassword()!='') ? 'available' : 'empty';

        echo json_encode(array('status'=>'success', 'message'=>'The account information has been saved', 'password'=>$password));
        // echo json_encode(array('status'=>'success', 'message'=>'The account information has been saved'));

    }

    public function saveAddress(){
        $this->load->library('customer_address_lib');
        $this->customer_address_lib->getAllAddressOfCustomer();
    }
    public function yourOrders(){
        // Content coming soon
        /*SELECT orders.order_id, orders.created_at as order_date, address.address_type as ship_to, orders.grand_total as total, orders.status FROM orders 
        LEFT JOIN address ON address.address_id = orders.shipping_address_id AND address.address_id = orders.billing_address_id
        WHERE orders.customer_id=13323*/

        $data['email'] = $this->session->userdata('logged_in')['email'];
        $data['mobile_number'] = $this->session->userdata('logged_in')['mobile_number'];
        $data['recent_orders'] = $this->dashboard_model->getAllOrderItems();
        $data['total_items'] = $this->dashboard_model->totalAllOrderItems();

        if($data['email']!=null || $data['email']!='' || $data['mobile_number']!=null || $data['mobile_number']!=''){
            echo json_encode(array('status'=>'success', 'message'=>'Records available', 'data'=>$data));
        } else {
            exit(json_encode(array('status'=>'failed', 'message'=>'Sorry, no records available')));
        }
    }

    public function getCustomerOrderDetails(){
        $order_id = $this->input->get_post('order_id'); // 16;
        $orderBelongsToUser = $this->dashboard_model->orderBelongsToUser($order_id);
        
        if($orderBelongsToUser!=1){
            echo json_encode(array('status'=>'failed', 'message'=>'Sorry, you are not authorized user'));
            return false;
        }

        $data['order_id'] = $order_id;
        $data['order_detail'] = $this->dashboard_model->getOrderDetails($order_id);
        $data['items_ordered'] = $this->dashboard_model->getItemsOrdered($order_id);
        $data['order_created_date'] = $this->dashboard_model->getOrderCreateDate($order_id);
        echo json_encode(array('status'=>'success', 'message'=>'Records available', 'data'=>$data));
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

    public function mobileValidation($mobile){
        if((strlen($mobile)<10) || (strlen($mobile)>10) || (substr_count($mobile,0)==10) || !is_numeric($mobile)){
            return false;
        }
        return true;
    }
    
    public function checkEmailValid($user_email){
        $email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        return true;
    }

    public function updateEmailInSession($email){
        if($email!=null && $email!=''){
            $sessionData = $this->session->userdata('logged_in');
            $sessionData['email'] = $email;
            $this->session->set_userdata('logged_in', $sessionData);
        }
    }

    public function updateMobileInSession($mobile_number){
        if($mobile_number!=null && $mobile_number!=''){
            $sessionData = $this->session->userdata('logged_in');
            $sessionData['mobile_number'] = $mobile_number;
            $this->session->set_userdata('logged_in', $sessionData);
        }
    }

    public function updateNameEmailInSession($data){
        if($data!=null && $data!=''){
            $getAllData = array();
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $sessionData = $this->session->userdata('logged_in');

            foreach($sessionData as $key=>$val){
                if($first_name!='' && $first_name!=null && $key=='first_name'){
                    $val = $first_name;
                }
                if($last_name!='' && $last_name!=null && $key=='last_name'){
                    $val = $last_name;   
                }
                if($email!='' && $email!=null && $key=='email'){
                    $val = $email;
                }
                $getAllData[$key] = $val;
            }

            $this->session->set_userdata('logged_in', $getAllData);
        }
    }

    public function getPaginationRecord(){

        $totalOrders = $this->dashboard_model->totalAllOrderItems();
        $totalPage = ceil($totalOrders/10);

        $lastPage = $this->input->get_post('lastPage'); // 3;
        $page_number = $this->input->get_post('page_number'); // 2;

        // if($lastPage>1 || $lastPage==$totalPage){
            // $page_number = $page_number;
            $data['totalPage']=$totalPage; // Need updated record
            $data['lastPage']=(int) $lastPage;
            $data['page_number']=(int) $page_number;
            $data['recent_orders'] = $this->dashboard_model->gerOrderList($page_number);
            $data['total_items'] = $totalOrders;
            echo json_encode(array('status'=>'success','message'=>'record found', 'data'=>$data));
        // }*/

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

    /*public function pincodePage(){
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('dashboard/pincode-box');
        $this->load->view('footer', $viewArr);
    }*/

    public function passwordMatching($dbPassword, $userPassword){
        $pwd = explode(':',$dbPassword);
        $pwd2Part = $pwd[1];
        $dbSystemPassword = $pwd[0];
        $userCustomPassword = md5($pwd2Part.$userPassword);

        if($dbSystemPassword==$userCustomPassword){
            return true;
        }
        return false;
    }

    public function strongPassword($password){ // For storing or updating purpose
        $salt = $this->getRandomString();    
        if($password!=null && $salt!=null){
            return md5($salt.$password).':'.$salt;
        }
    }   

    public function getRandomString(){
        $range = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for($i=0;$i<$range;$i++){
            $index = mt_rand(0, strlen($characters)-1);    
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

}