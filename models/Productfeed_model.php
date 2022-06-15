<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Productfeed_model extends CI_Model {
	function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCityWiseProductData(){
    	$this->db->select('cm.city_name, pcp.product_id, pr.product_name, pr.product_url, pr.product_short_desc, pr.product_long_desc, pr.thumb_image_url, pr.pack_shot_img, pr.varient, pr.base_price, pr.special_price, pr.sku, pr.is_active, pr.is_in_stock, pcp.category_id, cat.category_name, pcp.product_price,group_concat(CASE WHEN pin.is_active = "1" THEN pin.pincode ELSE "" END) as pincode');
    	$this->db->join('product pr', 'pcp.product_id = pr.product_id', 'left');
    	$this->db->join('city_master cm', 'pcp.city_id = cm.city_id', 'left');
    	$this->db->join('category cat', 'pcp.category_id = cat.category_id', 'left');
    	$this->db->join('pincode pin', 'pcp.city_id = pin.city_id','left');
    	$this->db->where('cm.is_active', 1);
    	$this->db->where('cat.is_active',1);
    	$this->db->group_by('pcp.product_id');
    	$this->db->group_by('pcp.city_id');
    	$this->db->order_by('cm.city_name');
    	$this->db->order_by('pr.product_name');
        return $this->db->get('product_city_price pcp')->result_array();
    }
}
