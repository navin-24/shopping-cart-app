<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->helper('common_helper');
    }

	function create_csv_string($data) {
	  if (!$fp = fopen('php://temp', 'w+')) return FALSE;
	  	fputcsv($fp, array('Order ID','Status','First Name', 'Last Name', 'Email', 'Coupon Code','Discount Amount','Grand Total','Delivery Date', 'Created Date','City','Pincode', 'State'));
	  foreach ($data as $line) fputcsv($fp, $line);
	  rewind($fp);
	  return stream_get_contents($fp);

	}

    public function OrderReportCSV($from='',$to='',$type='download'){
    	$date = date('dMy');
    	$this->validateDates($from,$to);
		$data = $this->order_model->getOrderList($from,$to);
    	if($type=='download'){
    		$this->exports_data($data,'Orders_'.$date.".csv");
    	}else{
    		$this->send_csv_mail($data,'Orders_'.$date.".csv");
    	}
    }

    public function OrderItemReportCSV($from='',$to='',$type='download'){
    	$date = date('dMy');
    	$this->validateDates($from,$to);
    	$data = $this->order_model->getOrderItemList($from,$to);
    	if($type=='download'){
    		$this->exports_data($data,'OrdersItem_'.$date.".csv");
    	}else{
    		$this->send_csv_mail($data,'OrdersItem_'.$date.".csv");	
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
        if(strstr($filename, 'Item')){
        	fputcsv($handle, array('Order ID','Product Name', 'Qty Ordered', 'Price','Created Date'));	
        }else{
        	fputcsv($handle, array('Order ID','Status','First Name', 'Last Name', 'Email', 'Coupon Code','Discount Amount','Grand Total','Delivery Date', 'Created Date','City','Pincode', 'State', 'Order Channel', 'Order Campaign', 'Customer Channel', 'Customer Campaign'));
        }

        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        return stream_get_contents($handle);
    }

    function send_csv_mail($csvData, $filename) {
	   $to = 'navin@rawpressery.com';
	   $subject = 'Orders Data '.str_replace(".csv", "", $filename);
	   $attachment = $this->create_csv_string($csvData);
	   $body = "Dear Team,<br><br>Please find attached is CSV with processing Orders data";
	   $response = sendEmail($body, $subject,$to,"","",$attachment,$filename);
	   $responseArray = json_decode($response, true);
	   if($responseArray['message'] == 'Success'){
	   	  echo "Email Sent Successfully";
	   }else{
	   	  echo "Email Sending Failed"; 
	   }
	}

    public function AbandonedCartCSV($from='',$to=''){
        $date = date('dMy');
        $this->validateDates($from,$to);
        $data = $this->order_model->getAbandonedCartData($from,$to);
        $this->exportAbandonedCartData($data,'AbandonedCart_'.$date.".csv");
    }

    public function exportAbandonedCartData($data,$filename){
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"".$filename."\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w+');
        fputcsv($handle, array('Customer Name', 'Email', 'Number Of Items', 'Quantity of Items', 'Subtotal' , 'Applied Coupon', 'Address', 'Created At', 'Updated At'));
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        return stream_get_contents($handle);
    }

    public function PincodeDataCSV(){
        $filename = "PincodeData_".date('dMy').".csv";
        $data = $this->order_model->getPincodeData();
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"".$filename."\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w+');
        fputcsv($handle, array('State', 'City', 'Pincode', 'Is Active'));
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        return stream_get_contents($handle);
    }
}
