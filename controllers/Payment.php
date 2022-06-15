<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->helper('common_helper');
    }

    public function redirect() {
        $secretKey = CF_SECRET_KEY;
        $order_id = $this->session->userdata('order_id');
        $customer_address_id = $this->session->userdata('customer_address_id');

        $order_details = $this->order_model->getOrderDetails($order_id);
        $address_details = $this->order_model->getOrderAddress($order_id, '', $customer_address_id);
        //print_r($address_details);
        $postData = array(
            "appId" => CF_APP_ID,
            "orderId" => $order_id,
            "orderAmount" => round($order_details['grand_total'],2),
            "orderCurrency" => 'INR',
            "customerName" => $order_details['fullname'],
            "customerPhone" => $address_details['mobile_number'],
            "customerEmail" => $order_details['customer_email'],
            "returnUrl" => BASE_URL . '/payment/CFResponse',
            "notifyUrl" => BASE_URL . '/payment/CFNotify',
        );
        //print_r($postData);die;

        ksort($postData);

        $signatureData = "";

        foreach ($postData as $key => $value) {
            $signatureData .= $key . $value;
        }

        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
        $postData['signature'] = base64_encode($signature);

        $inputData['postData'] = $postData;
        $inputData['redirectUrl'] = CFURL;

        //print_r($inputData);
        $this->load->view('payment/redirect', $inputData);
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
            $updatedData['updated_at'] = date('Y-m-d H:i:s');
            $secretKey = CF_SECRET_KEY;

            $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
            $hash_hmac = hash_hmac('sha256', $data, $secretKey, true);
            $computedSignature = base64_encode($hash_hmac);

            if (strcmp($computedSignature, $signature)) {
                $response['status'] = 0;
                $response['reason'] = "invalid";
                return $response;
            }
//$txStatus='PENDING';
            if ($txStatus == "SUCCESS") {
                $this->order_model->markCartInactive($orderId);
                $order_detail = $this->order_model->getOrderDetails($orderId);
                if ($order_detail['coupon_code']!='') {
                    $coupon_details = $this->order_model->getCouponCodeDetails($order_detail['coupon_code']);
                    if($coupon_details['usage_per_customer']){
                        $coupon_usage = $this->order_model->getCouponUsage($coupon_details['coupon_id'],$order_detail['customer_id']);
                        if ($coupon_usage !==FALSE) {
                            $coupon_usage['times_used']+=1;
                            $this->order_model->updateCouponUsage($coupon_details['coupon_id'],$order_detail['customer_id'],$coupon_usage['times_used']);
                        }else{
                            $this->order_model->insertCouponUsage($coupon_details['coupon_id'],$order_detail['customer_id'],1);
                        }
                    }
                }
                $this->destroyCartRedirect($orderId,$txStatus);
            } else {
                switch ($txStatus) {
                    case "CANCELLED":
                        $error = "Your payment has been cancelled";
                        $updatedData['status'] = 'Payment Pending';
                        $this->session->set_flashdata('payment_error', $error);
                        $this->order_model->updateOrderStatus($orderId, $updatedData);
                        redirect(base_url('shop/cart'));
                        break;
                    case "FLAGGED":
                        $error = "Your payment is complete and under review.";
                        break;
                    case "PENDING":
                        $this->destroyCartRedirect($orderId,$txStatus);
                        break;
                    default:
                        $error = "Your payment has failed. Please try again.";
                        $updatedData['status'] = 'Payment Pending';
                        $this->session->set_flashdata('payment_error', $error);
                        $this->order_model->updateOrderStatus($orderId, $updatedData);
                        redirect(base_url('shop/cart'));
                }
            }
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
            $updatedData['updated_at'] = date('Y-m-d H:i:s');
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
                $updatedData['status'] = 'Payment Successful';
                $updatedData['state'] = strtolower($txStatus);
                $this->order_model->updateOrderStatus($orderId, $updatedData);
                $response['status'] = 1;
                $response['reason'] = 'success';
                $this->sendOrderConfirmationEmail($orderId);
            } else {
                switch ($txStatus) {
                    case "CANCELLED":
                        $updatedData['status'] = 'Payment Pending';
                        $this->order_model->updateOrderStatus($orderId, $updatedData);
                        break;
                    case "FLAGGED":
                        break;
                    case "PENDING":
                        break;
                    default:
                        $updatedData['status'] = 'Payment Pending';
                        $this->order_model->updateOrderStatus($orderId, $updatedData);
                }
                $response['status'] = 0;
                $response['reason'] = 'failed';
            }
            return $response;
        }
    }

    public function destroyCartRedirect($orderId='',$txStatus=''){
        $this->cart->destroy();
        $this->session->unset_userdata("cart_coupon");
        $this->session->set_flashdata('orderId', $orderId);
        $this->session->set_flashdata('payment_status', $txStatus);
        redirect(BASE_URL('thankyou'));
    }

    function thankyou() {
        $orderId = $this->session->flashdata('orderId');
        $payment_status = $this->session->flashdata('payment_status');
        if ($orderId) {
            $viewArr['order_item_details'] = $this->order_model->getOrderItemDetailsCategory($orderId);
            $viewArr['order_details'] = $this->order_model->getOrderDetails($orderId);
            $viewArr['payment_status'] = $payment_status;
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;
            $this->load->view('header', $viewArr);
            $this->load->view('thankYou');
            $this->load->view('footer', $viewArr);
        } else {
            redirect(BASE_URL);
        }
    }

    function sendOrderConfirmationEmail($orderId) {
        $viewArr['orderDetails'] = $orderDetails = $this->order_model->getOrderDetails($orderId);
        $viewArr['orderItemDetails'] = $this->order_model->getOrderItemDetails2($orderId);
        $orderAddressResult = $this->order_model->getOrderAddress($orderId, $orderDetails['customer_id']);
        //echo $this->db->last_query();
        //print_r($orderAddressResult);
        unset($orderAddressResult['mobile_number']);

        $viewArr['orderAddress']['shipping_address'] = implode(', ', $orderAddressResult);

        $viewArr['orderId'] = $orderId;
        $customer_email = $orderDetails['customer_email'];

        $message = $this->load->view('template/order-confirmation', $viewArr, TRUE);
        $strippedMessage = trim(preg_replace('/\s+/', ' ', $message));
        $subject = 'Raw Pressery: New Order #' . $orderId;
        $response = sendEmail($strippedMessage, $subject, $customer_email);
        //print_r($response);die;
        return $response;
    }

}
