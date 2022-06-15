<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reorder extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('reorder_model');
	}

	public function getDataForCI_Cart($DBorderItem){
        if($DBorderItem!=null){
            $keepInCI_Cart = array();
            foreach($DBorderItem as $row){
                $data['id'] = $row['product_id'];
                $data['qty'] = $row['qty_ordered'];
                $data['price'] = $row['special_price']; // taken because if CI cart will empty
                $data['name'] = $row['product_name']; // taken because if CI cart will empty
                $data['options'] = json_decode($row['product_options'],true); // taken because if CI cart will empty
                $keepInCI_Cart[] = $data;
            }
            return $keepInCI_Cart;  
        }
    }

    public function getDataForInsertingInDB_cartitem($DBorderItem, $cartId){
        if($DBorderItem!=null && $cartId!=null){
            $keepInDBcartItem = array();
            $currentDate = date('Y-m-d H:i:s');
            foreach($DBorderItem as $row){
                $forDBcartItem['cart_id'] = $cartId;
                $forDBcartItem['created_at'] = $currentDate;
                $forDBcartItem['product_id'] = $row['product_id'];
                $forDBcartItem['product_name'] = $row['product_name'];
                $forDBcartItem['sku'] = $row['product_id'];
                // $dataForDBcartItem['option_type_id'] = json_decode($row['product_options'],true)['option_type_id'];
                $forDBcartItem['qty'] = $row['qty_ordered'];
                // $forDBcartItem['price'] = $row['special_price'];
                $forDBcartItem['price_incl_tax'] = $row['special_price'];
                $forDBcartItem['options'] = $row['product_options'];
                $keepInDBcartItem[] = $forDBcartItem;
            }            
            return $keepInDBcartItem;
        }
    }

    public function updateCartData(){

        $orderId = $this->input->post('order_id'); // 15;
        $cartContents = $this->cart->contents();
        if($orderId==null || $orderId==''){
            exit(json_encode(array('status'=>'failed','message'=>'Invalid Order ID')));
        }
        $orderIdBelongsToUser = $this->reorder_model->orderIdBelongsToUser($orderId); // Do the testing with this script
        if($orderIdBelongsToUser==false){
            exit(json_encode(array('status'=>'failed','message'=>'Order ID not matching')));
        }

        $DBorderItem = $this->reorder_model->getOrderItem($orderId);
        $dataForCI_Cart = $this->getDataForCI_Cart($DBorderItem);

        if($cartContents==null){
            $this->cart->insert($dataForCI_Cart); // Insert in CI cart
            $cartId = $this->reorder_model->insertInCart();
            $this->session->set_userdata('cart_id', $cartId);
            $sessionCartId = $this->session->userdata('cart_id');
            // also print above sessionid
            $data = $this->getDataForInsertingInDB_cartitem($DBorderItem, $sessionCartId);
            $this->reorder_model->insertInCartItem($data);
        }else{
            $cartIds = $notMatchingRecords = $matchingRecords = $notMatchingRecords2 = [];
            foreach($cartContents as $oV){
                $cartIds[] = $oV['id'];
            }
            foreach($dataForCI_Cart as $oK=>$oV){
                foreach($cartContents as $cK=>$cV){
                    if($cV['id']==$oV['id']){
                        $cV['qty'] = ($oV['qty']+$cV['qty']);
                        $matchingRecords[$cK] = $cV;
                    }
                }
                if(!in_array($oV['id'], $cartIds)){
                    $notMatchingRecords[$oK] = $oV;
                }
            }
            if($matchingRecords!=null){ // Update in CI cart
                $this->cart->update($matchingRecords);
            }
            if($notMatchingRecords!=null){ // Insert in CI cart
                $this->cart->insert($notMatchingRecords);
            }
            $sessionCartId = $this->session->userdata('cart_id');

            /* If needed please update cookie_id for update statement of cart_itme */
            
            if($sessionCartId==null || $sessionCartId==''){
                $cartId = $this->reorder_model->getLastCartId();
                $this->session->set_userdata('cart_id', $cartId);
                $sessionCartId = $this->session->userdata('cart_id');
                $this->reorder_model->updateDBcart($sessionCartId);
            }else{
                $dbCartId = $this->reorder_model->cartIdMatchingWithUser($sessionCartId); // Get cart_id from DB
                if($sessionCartId!=$dbCartId){
                    $cartId = $this->reorder_model->insertInCart();
                    $this->session->set_userdata('cart_id', $cartId);
                    $sessionCartId = $this->session->userdata('cart_id');
                }else{
                    $this->reorder_model->updateDBcart($sessionCartId);
                }
            }

            $freshCartContents = $this->cart->contents(); // After update/insert, new content will come in CI cart
            $this->reorder_model->updateDBcartItem($freshCartContents, $sessionCartId);
        }
        echo json_encode(array('status'=>'success','message'=>'Record updated successfully'));
        
        // print($this->session->userdata('cart_id'));
    }

}