<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CRM extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('crm_model');
        $this->load->model('product_model');
    }

    public function welcome() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('CRM/welcome', $data);
        $this->load->view('footer', $viewArr);
    }

    public function ordersView() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('CRM/orders', $data);
        $this->load->view('footer', $viewArr);
    }

    public function getOrders() {
        $page_number = $this->input->get_post('page_number');

        if ($page_number != null) {
            $totalPages = $this->crm_model->getTotalPages();
            if ($page_number > $totalPages) {
                exit(json_encode(array('status' => 'failed', 'message' => 'Invalid data')));
            }
            if ($page_number < 1) {
                exit(json_encode(array('status' => 'failed', 'message' => 'Invalid data')));
            }
        }

        $allOrders = $this->crm_model->gerOrderList($page_number);

        /* print_r($allOrders);
          exit; */

        if ($allOrders == null) {
            /* $data['orders'] = 0;
              $data['total_pages'] = 0;
              $data['total_records'] = 0;
              $data['currentPaginationValue'] = 0;
              exit(json_encode(array('status'=>'failed','message'=>'Sorry no records found','data'=>$data))); */
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }

        $data['orders'] = $allOrders;
        $data['total_pages'] = $this->crm_model->getTotalPages();
        $data['total_records'] = $this->crm_model->getTotalOrders();
        $data['currentPaginationValue'] = $page_number;
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function getOrdersById() {
        $order_id = $this->input->get_post('order_id');
        /* if($order_id==null || $order_id==''){
          exit(json_encode(array('status'=>'failed','message'=>'Please provide order ID')));
          }
          if(!is_numeric($order_id)){
          exit(json_encode(array('status'=>'failed','message'=>'Invalid number')));
          } */
        $data['orders'] = $this->crm_model->getOrdersThroughId($order_id);
        if ($data['orders'] == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function getOrdersByPurchasedOn() {
        $data['orders'] = $this->crm_model->getPurchasedOnOrders();
        if ($data['orders'] == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function getOrdersByUpdatedOn() {
        $data['orders'] = $this->crm_model->getUpdatedOnOrders();
        if ($data['orders'] == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function getOrdersByBillOrShipToName() {
        $data['orders'] = $this->crm_model->getBillOrShipToNameOrders();
        if ($data['orders'] == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function getOrdersGT_Base() {
        $data['orders'] = $this->crm_model->getGT_BaseOrders();
        if ($data['orders'] == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function getOrdersGT_Purchased() {
        $data['orders'] = $this->crm_model->getGT_PurchasedOrders();
        if ($data['orders'] == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function getOrdersThroughStatus() {
        $data['orders'] = $this->crm_model->getOrdersByStatus();
        if ($data['orders'] == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'Sorry no records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $data));
    }

    public function orderDetails() {
        $orderId = $this->input->get_post('order_id');
        $result = $this->crm_model->getOrderDetails($orderId);
        if ($result == null) {
            exit(json_encode(array('status' => 'failed', 'message' => 'No records found')));
        }
        echo json_encode(array('status' => 'success', 'message' => 'Records available', 'data' => $result));
    }

    public function orderDetailsView($orderId) {

        //$orderId = $this->input->get_post('order_id'); // 15 (with coupon); // 22 (without coupon); //
        $result['data'] = $this->crm_model->getOrderDetails($orderId);
        $result['itemsOrdered'] = $this->crm_model->getItemsOrdered($orderId);

        /* print_r($result['data']);
          exit; */

        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('CRM/order-details', $result);
        //$this->load->view('footer', $viewArr);
    }

    public function productCityView($productId){
        $product_name = $this->product_model->getProductName($productId);
        $product_cities = $this->product_model->getProductCityMapping($productId);
        $cities_data = $this->product_model->getActiveCities();
        
        if(!is_array($product_cities)) {
            $product_cities=array(); 
        }
        
        $sel_cities = $cities = array();
        foreach ($product_cities as $value) {
            $sel_cities[] =  $value['city_id'];
        }

        foreach ($cities_data as $value) {
            $cities[$value['city_id']] = $value['city_name'];
        }
        $this->load->view('CRM/product-city-mapping', array('productId'=>$productId,'product_name'=>$product_name,'sel_cities'=>$sel_cities,'cities'=>$cities));
    }

    public function getDataInCSV() {
        ob_start();
        $getData = '';

        $result = $this->crm_model->getAllOrders();
        $colHeaders = "Order ID" . "\t" . "Purchased On" . "\t" . "Updated On" . "\t" . "Bill to Name" . "\t" . "Ship to Name" . "\t" . "G.T.(Base)" . "\t" . "G.T.(Purchased)" . "\t" . "Status" . "\t";

        foreach ($result as $row) {

            $fullname = ($row['firstname'] == null || $row['firstname'] == '') ? '' : $row['firstname'] . ' ' . $row['lastname'];

            $getData .= $row['order_id'] . "\t" . date('d M Y h:i:s a', strtotime($row['created_at'])) . "\t" . date('d M Y h:i:s a', strtotime($row['updated_at'])) . "\t" . $fullname . "\t" . $fullname . "\t" . number_format($row['sub_total'], 2) . "\t" . number_format($row['grand_total'], 2) . "\t" . $row['status'] . "\t" . "\n";
        }

        $this->exportExcelData($xlHeader = $colHeaders, $colValues = $getData, $filename = "orders_list.xls"); // This will download file
        ob_get_flush();
    }

    public function exportExcelData($xlHeader, $colValues, $filename) {

        if (strlen($colValues) > 1) {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=$filename");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo ucwords($xlHeader) . "\n" . $colValues . "\n";
        } else {
            exit('Sorry no records found');
        }
    }

}
