<?php

class MY_Cart extends CI_Cart {

    function __construct() {
        parent::__construct();
        $this->product_name_rules = '\d\D';
    }

    /*
     * Returns data for products in cart
     * 
     * @param integer $product_id used to fetch only the quantity of a specific product
     * @return array|integer $in_cart an array in the form (id => quantity, ....) OR quantity if $product_id is set
     */

    public function in_cart($product_id = null) {
        if ($this->total_items() > 0) {
            $in_cart = array();
            // Fetch data for all products in cart
            foreach ($this->contents() AS $item) {
                $in_cart[$item['id']]['qty'] = $item['qty'];
                $in_cart[$item['id']]['rowid'] = $item['rowid'];
            }

            if ($product_id) {
                if (array_key_exists($product_id, $in_cart)) {
                    return $in_cart[$product_id];
                }
                return null;
            } else {
                return $in_cart;
            }
        }
        return null;
    }

    public function all_item_count() {
        $total = 0;

        if ($this->total_items() > 0) {
            foreach ($this->contents() AS $item) {
                $total = $item['qty'] + $total;
            }
        }

        return $total;
    }
    
    function destory()
    {
        $this->destroy();
    }
    
    

}

/* End of file: MY_Cart.php */
 /* Location: ./application/libraries/MY_Cart.php */