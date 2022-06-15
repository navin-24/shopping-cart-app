<?php

class Product_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getProducts($categoryId, $productSkuArr='',$is_shop_page='') {
        // $this->db->select('p.product_id, product_name,product_url, base_price, special_price, varient, pi.image_url,po.option_txt');
        $this->db->select('p.product_id, product_name,product_url, base_price, special_price, varient, thumb_image_url,po.option_txt, sequence_value, sku, is_in_stock, pc.category_id, special_price_per_bottle, base_price_per_bottle');
        $this->db->from('product as p');
        $this->db->join('product_image as pi', 'pi.product_id = p.product_id', 'left');
        $this->db->join('product_sequence as ps', 'ps.product_id = p.product_id', 'left');
        $this->db->join('product_category as pc', 'pc.product_id = p.product_id');
        //$this->db->join('product_city as pcity', 'pcity.product_id = p.product_id', 'left');

        $this->db->join('product_option as po', 'po.product_id = p.product_id', 'left');
        $this->db->where('pi.image_type', 'base');

        $this->db->where('p.is_active', 1);
        if (is_array($categoryId)) {
            $this->db->where_in('pc.category_id', $categoryId);
            if($is_shop_page ==1){
                $this->db->order_by("is_in_stock", 'desc');
            }
            $this->db->order_by("pc.category_id");
        } else {
            $this->db->where('pc.category_id', $categoryId);
        }
        
        if (!empty($productSkuArr) && is_array($productSkuArr)) {
            //$productSkuStr = implode("','", $productSkuArr);
            $this->db->where_in('p.sku', $productSkuArr);
        }
        
        //$this->db->join('product_pricing as pd', 'pd.product_id = p.product_id','LEFT');
        //$where = 'NOW() BETWEEN pd.start_date AND pd.end_date';
        //$this->db->where($where);
        if(!$is_shop_page){
            $this->db->order_by("is_in_stock", 'desc');    
        }
        $this->db->order_by("sequence_value");

        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getProductCity($categoryId) {
        $this->db->select("p.product_id,  GROUP_CONCAT(pcity.city_id SEPARATOR ',') city_ids");
        $this->db->from('product as p');
        $this->db->join('product_category as pc', 'pc.product_id = p.product_id');
        $this->db->join('product_city as pcity', 'pcity.product_id = p.product_id');
        $this->db->where('p.is_active', 1);
        $this->db->where('pcity.is_active', 1);
        if (is_array($categoryId)) {
            $this->db->where_in('pc.category_id', $categoryId);
            $this->db->order_by("pc.category_id");
        } else {
            $this->db->where('pc.category_id', $categoryId);
        }

        $this->db->group_by("p.product_id");

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getProductCityById($product_id) {
        $this->db->select("p.product_id,  GROUP_CONCAT(pcity.city_id SEPARATOR ',') city_ids");
        $this->db->from('product as p');
        $this->db->where('p.product_id', $product_id);
        $this->db->where('pcity.is_active', 1);
        $this->db->join('product_city as pcity', 'pcity.product_id = p.product_id');
        $this->db->group_by("p.product_id");

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getProductDetails($product_id = '') {
        $this->db->select('p.*, ct.category_url, ct.category_id, ct.category_name, pi.desktop_image_url,pi.mobile_image_url, pcity.city_id');
        $this->db->from('product as p');
        $this->db->join('product_image as pi', 'pi.product_id = p.product_id', 'left');
        $this->db->join('product_category as pc', 'pc.product_id = p.product_id'); // new statement
        $this->db->join('category as ct', 'ct.category_id = pc.category_id'); // new
        $this->db->join('product_city as pcity', 'pcity.product_id = p.product_id', 'left');
        $this->db->where('p.product_id', $product_id);
        $this->db->where('pi.image_type', 'base');
        //$this->db->order_by("id", "desc");

        $query = $this->db->get();
        // echo $this->db->last_query();
        if (isset($_REQUEST['q'])) {
            echo $this->db->last_query();
        }
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return 0;
        }
    }

    public function getProductMeta($product_id) {
        return $this->db->where(['product_id' => $product_id])
                        ->select("meta_title,meta_keywords,meta_desc,alt_attr")
                        ->get('product_meta')
                        ->row_array();
    }

    public function getPageMeta($page_name) {
        return $this->db->where(['page_name' => $page_name])
                        ->select('meta_title,meta_keywords,meta_desc,meta_og_locale,meta_og_type,meta_og_title,meta_og_description,meta_og_url,meta_og_site_name,meta_og_image,meta_twitter_card,meta_twitter_title,meta_twitter_description,meta_twitter_image,canonical_url')
                        ->limit(1)
                        ->get('pages')
                        ->row_array();
    }

    public function getProductIDByUrl($product_url, $category_id) {
        $this->db->select('p.product_id');
        $this->db->from('product as p');
        $this->db->join('product_category as pc', 'pc.product_id = p.product_id'); // new statement
        $this->db->where('p.is_active', 1);
        $this->db->where('pc.is_active', 1);
        $this->db->where('product_url', $product_url);
        $this->db->where('pc.category_id', $category_id);

        $query = $this->db->get();
        if (isset($_REQUEST['q'])) {
            echo $this->db->last_query();
        }
        if ($query->num_rows() > 0) {
            return $query->row()->product_id;
        } else {
            return 0;
        }
    }

    public function getProductDetailsById($product_id = '') {
        if ($product_id) {
            $this->db->select('base_price, product_url, special_price, product_name, thumb_image_url, ct.category_name,ct.category_url, sku, is_in_stock, p.is_active, varient, pcity.city_id,pc.category_id,p.product_id');
            $this->db->from('product as p');
            //$this->db->join('product_image as pi', 'pi.product_id = p.product_id');
            $this->db->join('product_category as pc', 'pc.product_id = p.product_id'); // new statement
            $this->db->join('category as ct', 'ct.category_id = pc.category_id'); // new statement
            $this->db->join('product_city as pcity', 'pcity.product_id = p.product_id', 'left');
            $this->db->where('p.product_id', $product_id);
            //$this->db->where('pi.image_type', 'thumb');
            //$this->db->order_by("id", "desc");

            $query = $this->db->get();
            if (isset($_REQUEST['q'])) {
                echo $this->db->last_query();
            }
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getOptionPrice($product_id, $option_type_id) {
        if ($product_id) {
            $this->db->select('pot.base_price, pot.special_price, product_name, p.sku, thumb_image_url, varient, is_in_stock, sku, p.is_active, p.product_url, category_name,p.product_id,pc.category_id');
            $this->db->from('product as p');
            $this->db->join('product_option_type as pot', 'pot.product_id = p.product_id'); // new statement
            $this->db->join('product_category as pc', 'pc.product_id = p.product_id');
            $this->db->join('category as ct', 'ct.category_id = pc.category_id');
            $this->db->where('p.product_id', $product_id);
            $this->db->where('option_id', $option_type_id);

            $query = $this->db->get();
            if (isset($_REQUEST['q'])) {
                echo $this->db->last_query();
            }
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getProductAttribute($product_id) {
        return $this->db->select('attribute_value, attribute_image')
                        ->from('product_attribute')
                        ->where(['product_id' => $product_id, 'is_active' => 1])
                        ->get()
                        ->result_array();
    }

    public function getProductOption($product_id) {
        return $this->db->select('option_txt')
                        ->from('product_option')
                        ->where('product_id', $product_id)
                        ->get()
                        ->row_array();
    }

    public function getRecommendedProducts($product_id = '', $category_id = '') {
        $this->db->select('p.product_id, product_name, base_price, varient, thumb_image');
        $this->db->from('product as p');

        $this->db->join('product_image as pi', 'pi.product_id = p.product_id');
        $this->db->join('product_category as pc', 'pc.product_id = p.product_id');

        $this->db->where_not_in('p.product_id', $product_id);
        $this->db->where('pi.type', 'desktop');
        $this->db->where('pc.category_id', $category_id);

        $query = $this->db->get();
        if (isset($_REQUEST['q'])) {
            echo $this->db->last_query();
        }

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getProductReviews($product_id = '') {
        $select = "product_id, review_rating, review_comment, review_image, user_name";
        $this->db->select($select, FALSE);
        $this->db->from('product_review');

        // $this->db->join('customer', 'customer.customer_id = product_review.user_id');
        //$this->db->join('customer', 'customer.customer_id = product_review.user_id', 'left'); // For getting all the reviews
        if ($product_id) {
            //$this->db->where('product_id', $product_id);
        }
        $this->db->where('review_status', 'approved');

        $query = $this->db->get();
        if (isset($_REQUEST['previ'])) {
            echo $this->db->last_query();
            die;
        }

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getFaq($category_id) {
        //$select = "product_id, review_rating, review_comment, review_image, concat(first_name,' ',last_name) customer_name";
        //$this->db->select($select, FALSE);
        $this->db->from('faq');
        $this->db->join('faq_category_item as fci', 'fci.faq_id = faq.faq_id');
        $this->db->join('faq_category as fc', 'fc.faq_category_id = fci.category_id');
        $this->db->where('fc.product_cat_id', $category_id);

        $query = $this->db->get();
        if (isset($_REQUEST['pfaq'])) {
            echo $this->db->last_query();
            die;
        }

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getCategoryList() {
        //$select = "product_id, review_rating, review_comment, review_image, concat(first_name,' ',last_name) customer_name";
        //$this->db->select($select, FALSE);
        $this->db->from('category');
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getCategoryDetails($catName = '') {
        // $select = "product_id, review_rating, review_comment, review_image, concat(first_name,' ',last_name) customer_name";
        $this->db->select('category_id, category_name, category_url');
        $this->db->from('category');
        $this->db->where('is_active', 1);
        $this->db->where('category_url', $catName);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return 0;
        }
    }

    function getSearchResult($q) {
        $select = "p.product_id, product_name, category_url, varient, base_price, special_price, thumb_image_url, product_url";
        $this->db->select($select, FALSE);
        $this->db->from('product p');
        $this->db->join('product_category as pc', 'pc.product_id = p.product_id');
        $this->db->join('category c', 'c.category_id = pc.category_id');
        $this->db->where('p.is_active', 1);
        //$this->db->where('image_type', 'thumb');
        $this->db->like('product_name', $q);
        $this->db->like('product_short_desc', $q);

        $query = $this->db->get();
//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function getFaqCategory($productCatId) {
        return $this->db->select('faq_category_id, faq_category_name')
                        ->from('faq_category')
                        ->where(['product_cat_id' => $productCatId, 'is_active' => 1])
                        ->get()
                        ->result_array();
    }

    public function getFaqCategoryItem($faq_category_id) {
        return $this->db->select('question,answer')
                        ->from('faq_category_item')
                        ->join('faq', 'faq.faq_id=faq_category_item.faq_id')
                        ->where(['category_id' => $faq_category_id, 'is_active' => 1])
                        ->get()
                        ->result_array();
    }

    public function getFaqQuestionAnswer($faq_id) {
        return $this->db->select('question,answer')
                        ->from('faq')
                        ->where(['faq_id' => $faq_id, 'is_active' => 1])
                        ->get()
                        ->row_array();
    }

    public function getFaqDetails($productCatId) {
        $arr = array();
        $faqCat = $this->getFaqCategory($productCatId);
        foreach ($faqCat as $v) {
            $faqCatItem = $this->getFaqCategoryItem($v['faq_category_id']);
            $arr[$v['faq_category_name']] = $faqCatItem;
        }

        //echo $this->db->last_query();die;
        return $arr;
    }

    public function getProductItem($product_id) {
        $result = $this->db->select('product_name, pro.product_id, did_you_know, ingredient,thumb_image_url, nutrition_facts, pack_shot_img')
                ->from('product pro')
                ->join('product_item pi', 'pro.product_id=pi.product_id', 'left')
                ->where(['pi.parent_product_id' => $product_id])
                ->order_by("sort_order")
                ->get()
                ->result_array();
        //echo $this->db->last_query();die;
        return $result;
    }

    public function getProductThumbImage($proudct_id) {
        return $this->db->where(['product_id' => $proudct_id])
                        ->select('thumb_image_url')
                        ->get('product')
                        ->row()->thumb_image_url;
    }

    public function getProductVarient($proudct_id) {
        return $this->db->where(['product_id' => $proudct_id])
                        ->select('varient')
                        ->get('product')
                        ->row()->varient;
    }

    public function getProductName($proudct_id) {
        return $this->db->where(['product_id' => $proudct_id])
                        ->select('product_name')
                        ->get('product')
                        ->row()->product_name;
    }

    public function getProductCityMapping($proudct_id) {
        return $this->db->where(['product_id' => $proudct_id, 'is_active' => '1'])
                        ->select('city_id')
                        ->get('product_city')
                        ->result_array();
    }

    public function getActiveCities() {
        return $this->db->where(['is_active' => '1'])
                        ->select('city_id,city_name')
                        ->get('city_master')
                        ->result_array();
    }

    public function getActiveCityName($city_id) {
        return $this->db->where_in('city_id', $city_id)
                        ->where(['is_active' => 1])
                        ->select('group_concat(city_name SEPARATOR ", ") as city_names')
                        ->get('city_master')
                        ->row()->city_names;
    }

}
