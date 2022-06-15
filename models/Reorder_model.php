<?php
defined('BASEPATH') OR exit('No direct script accesss allowed');

class Reorder_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function getOrderItem($orderId){
        if($orderId!=null){
            return $this->db->where(['order_item.order_id'=>$orderId])
                        ->select('order_item.product_id, order_item.qty_ordered, order_item.product_options, product.product_name, product.special_price')
                        ->from('order_item')
                        ->join('product','order_item.product_id = product.product_id','left')
                        ->get()
                        ->result_array();
        }
    }

    public function orderIdBelongsToUser($orderId){
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        $query = $this->db->where(['order_id'=>$orderId,'customer_id'=>$customer_id])
                ->limit(1)
                ->get('orders');
        if($query->num_rows()==1){
            return true;
        }
        return false;
    }

    public function insertInCart(){
        $items_count = count($this->cart->contents());
        if($items_count!=null && $items_count>0){
            $grand_total = $this->cart->total();
            $items_qty = $this->cart->all_item_count();
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $cookie_id = $this->getCookieId();
            $session_id = ($this->session->userdata('session_id')!=NULL)?$this->session->userdata('session_id'):'';
            $customer_id = $this->session->userdata('logged_in')['customer_id'];
            $created_at = date('Y-m-d H:i:s');

            $data = array(
            'created_at'=>$created_at,
            'items_count'=>$items_count,
            'items_qty'=>$items_qty,
            'cookie_id'=>$cookie_id,
            'session_id'=>$session_id,
            'customer_id'=>$customer_id,
            'ip_address'=>$ip_address,
            'grand_total'=>$this->cart->total()
            // 'subtotal'=>
            );

            $this->db->insert('cart', $data);
            return $this->db->insert_id();
        }
    }

    public function insertInCartItem($data){
        if($data!=null){
            $this->db->insert_batch('cart_item', $data);
        }
    }

    public function getLastCartId(){
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        return $this->db->where(['customer_id'=>$customer_id])
        ->select('cart_id')
        ->order_by('cart_id', 'DESC')
        ->limit(1)
        ->get('cart')
        ->row()
        ->cart_id;
    }

    public function updateDBcart($cart_id){
        if($cart_id!=null){
            $grand_total = $this->cart->total();
            $items_count = count($this->cart->contents());
            $items_qty = $this->cart->all_item_count();
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $cookie_id = $this->getCookieId();
            $session_id = ($this->session->userdata('session_id')!=NULL)?$this->session->userdata('session_id'):'';
            $customer_id = $this->session->userdata('logged_in')['customer_id'];
            $updated_at = date('Y-m-d H:i:s');

            $data = array(
            'updated_at'=>$updated_at,
            'items_count'=>$items_count,
            'items_qty'=>$items_qty,
            'cookie_id'=>$cookie_id,
            'session_id'=>$session_id,
            'customer_id'=>$customer_id,
            'ip_address'=>$ip_address,
            'grand_total'=>$this->cart->total()
            // 'subtotal'=>
            );

            $this->db->where(['cart_id'=>$cart_id, 'customer_id'=>$customer_id])
                    ->update('cart', $data);
        }
    }

    public function updateDBcartItem($cartContents, $cartId){ // Please check with database
        if($cartId!=null){
            $currentDate = date('Y-m-d H:i:s');

            foreach($cartContents as $row){
                $data['cart_id'] = $cartId;
                $data['created_at'] = $currentDate;
                $data['product_id'] = $row['id']; // this will be options product_id OR just id, please confirm
                $data['product_name'] = $row['name'];
                $data['sku'] = $row['id']; // $row['options']['product_id']
                $data['qty'] = $row['qty'];
                // $data['price'] = $row['price']; // $row['special_price'];
                $data['price_incl_tax'] = $row['price']; // $row['special_price'];
                $data['options'] = json_encode($row['options']);

                $dataForUpdate = array('qty'=>$data['qty'],'updated_at'=>$currentDate);
                $cartItemExistsInDB = $this->checkCartItemAvailable($cartId, $data['product_id']);

                if($cartItemExistsInDB>0){
                    $this->db->where(['cart_id'=>$cartId,'product_id'=>$data['product_id']])->update('cart_item', $dataForUpdate);
                }else{
                    // if($cartItemExistsInDB==0){
                    $this->db->insert('cart_item', $data);
                }
            }

        }
    }

    public function cartIdMatchingWithUser($cart_id){
        $customer_id = $this->session->userdata('logged_in')['customer_id'];
        return $this->db->where(['cart_id'=>$cart_id,'customer_id'=>$customer_id])
        ->select('cart_id')
        ->order_by('cart_id', 'DESC')
        ->limit(1)
        ->get('cart')
        ->row()
        ->cart_id;
    }

    public function checkCartItemAvailable($cartId, $productId){
        return $this->db->where(['cart_id'=>$cartId,'product_id'=>$productId])
                    ->get('cart_item')
                    ->num_rows();
    }

    public function getCookieId(){
        $this->load->helper('cookie');

        if (isset($_COOKIE["usercid"])) {
            get_cookie('usercid', TRUE);
        } else {
            $cookie = array(
                'name' => 'usercid',
                'value' => uniqid(),
                'expire' => "86500", // time() + 86500,
                'path' => '/',
            );
            set_cookie($cookie);
        }
        return $_COOKIE["usercid"];
    }

}