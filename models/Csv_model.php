<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function updateNutritionFacts($product_name, $recordForUpdate){
		//$dbProductName = $this->getProductName($product_name);
		if($product_name!=''){
			$data = array('nutrition_facts'=>$recordForUpdate);
			$this->db->where(["sku"=>$product_name])
					->update('product', $data);
			return ($this->db->affected_rows()===FALSE) ? false : true;	
		}
	}

	public function getProductName($product_name){
		return $this->db->where(["LOWER(product_name)"=>strtolower($product_name)])
				->select("LOWER(product_name) as product_name")
				->limit(1)
				->get('product')
				->row()->product_name;		
	}

	public function updateProductImage($productId, $dataForUpdate){
		$this->db->where(['product_id'=>$productId])->update('product_image',$dataForUpdate);
		return ($this->db->affected_rows()===FALSE) ? false : true;
	}
}