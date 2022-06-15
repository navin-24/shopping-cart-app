<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->helper('common_helper');
    }

    public function customerReportCsv($from='',$to='',$type='download'){
    	$date = date('dMy');
    	$this->validateDates($from,$to);
		$data = $this->customer_model->getCustomerList($from,$to);
    	$this->exports_data($data,'Customers_'.$date.".csv");
    }

	public function validateDates($from,$to){
		$this->verify_date($from);
		$this->verify_date($to);
		if($from>$to) {
			echo "From date should be less than To date";
			exit;
		}
	}

	public function verify_date($date){
    	$date_arr = explode('-', $date);
    	if(strlen($date_arr[0])!=4 || strlen($date_arr[1])!=2 || strlen($date_arr[2])!=2 || !is_numeric($date_arr[0]) || !is_numeric($date_arr[1]) || !is_numeric($date_arr[2])) {
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
        fputcsv($handle, array('Customer ID', 'First Name', 'Last Name', 'Mobile Number', 'Email', 'Created At', 'Updated At', 'Channel', 'Campaign'));        
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        return stream_get_contents($handle);
    }
}
