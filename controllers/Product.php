<?php

// error_reporting(0);

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->helper('common_helper');
        $this->config->load('product_config');
    }

    public function productListing() {

        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $viewArr['cart_count'] = $this->cart_count;
        $this->load->view('header', $viewArr);
        $this->load->view('product-listing');
        $this->load->view('footer', $viewArr);
    }

    public function productDetail() { //temp for amey
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $this->load->view('header', $viewArr);
        $this->load->view('product-detail');
        $this->load->view('footer', $viewArr);
    }

    public function index() {
        $last = $this->uri->total_segments();
        $category = trim(strtolower($this->uri->segment($last)));
        //$arr = explode('.', $category_url);
        $viewArr['category'] = $category;
        //$viewArr['city_id'] = getPincodeCity($this->cookiePincode);
        $viewArr['city_id'] = getPincodeCityDefault($this->cookiePincode);
        $categoryArr = $this->product_model->getCategoryDetails($category);
        $productsList = $this->product_model->getProducts($categoryArr['category_id']);
        $viewArr['products'] = getCityWisePrice($productsList,$viewArr['city_id']);
        $productsCity = $this->product_model->getProductCity($categoryArr['category_id']);
        if ($productsCity) {
            foreach ($productsCity as $city_row) {
                $productCityArr[$city_row['product_id']] = $city_row['city_ids'];
            }
        }
        $avail=$notavail=array();
        foreach ($viewArr['products'] as $products) {
            $cityArr = str_replace(' ', '', explode(',', $productCityArr[$products['product_id']]));
            if($cityArr[0]==''){
                $productCityArr[$products['product_id']] = '';    
            }
            if(!in_array($viewArr['city_id'], $cityArr)){
                $notavail[] = $products;
            }else{
                $avail[] = $products;
            }
        }
        $viewArr['products'] = array_merge($avail,$notavail);
        $viewArr['productCityArr'] = $productCityArr;
        $viewArr['pincode'] = $this->cookiePincode;
        if ($this->uri->total_segments() == 2) {
            $page_name = $this->uri->segment(2);
            $viewArr['page_meta'] = $this->product_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'product/product_listing';
        $viewArr['categoryArr'] = $categoryArr;
        $this->load->view('common', $viewArr);
    }

    public function product_refresh() {
        $category = trim(strtolower($this->input->post('category')));
        $viewArr['category'] = $category;
        //$viewArr['city_id'] = getPincodeCity($this->cookiePincode);
        $viewArr['city_id'] = getPincodeCityDefault($this->cookiePincode);
        if($category == 'shop' || $category == ''){
            $category = array(JUICES_CATEGORY_ID, ALMONDMILK_CATEGORY_ID, PROTEINMILKSHAKE_CATEGORY_ID);
            $productsList = $this->product_model->getProducts($category);
            $viewArr['products'] = getCityWisePrice($productsList,$viewArr['city_id']);
            $productsCity = $this->product_model->getProductCity($category);    
        }else{
            $categoryArr = $this->product_model->getCategoryDetails($category);
            $productsList = $this->product_model->getProducts($categoryArr['category_id']);
            $viewArr['products'] = getCityWisePrice($productsList,$viewArr['city_id']);
            $productsCity = $this->product_model->getProductCity($categoryArr['category_id']);    
        }
        if ($productsCity) {
            foreach ($productsCity as $city_row) {
                $productCityArr[$city_row['product_id']] = $city_row['city_ids'];
            }
        }
        $avail=$notavail=array();
        foreach ($viewArr['products'] as $products) {
            $cityArr = str_replace(' ', '', explode(',', $productCityArr[$products['product_id']]));
            if($cityArr[0]==''){
                $productCityArr[$products['product_id']] = '';    
            }
            if(!in_array($viewArr['city_id'], $cityArr)){
                $notavail[] = $products;
            }else{
                $avail[] = $products;
            }
        }
        $viewArr['products'] = array_merge($avail,$notavail);
        $viewArr['productCityArr'] = $productCityArr;
        $viewArr['pincode'] = $this->cookiePincode;
        $viewArr['categoryArr'] = $categoryArr;
        if ($category == 'cleanses') {
            echo $this->load->view('product/cleanses',$viewArr,true);
        } else {
            echo $this->load->view('product/juices',$viewArr,true);
        }
        die;
        //echo $this->load->view('product/product_listing', $viewArr,true);die;
    }
    
    public function cfaListing() {
        $category = 'value-packs';
        //$arr = explode('.', $category_url);
        $viewArr['category'] = $category;
        $viewArr['city_id'] = getPincodeCity($this->cookiePincode);
        $categoryArr = $this->product_model->getCategoryDetails($category);
        $productSkuArr = array('1130100');
        $productSkuArr = array('1060259VP','1130210VP12','1130210','1060283VP12','1060283VP32','1130209VP12','1130209','1130178');
        $viewArr['products'] = $this->product_model->getProducts($categoryArr['category_id'], $productSkuArr);
        $productsCity = $this->product_model->getProductCity($categoryArr['category_id']);
        if ($productsCity) {
            foreach ($productsCity as $city_row) {
                $productCityArr[$city_row['product_id']] = $city_row['city_ids'];
            }
        }
        $viewArr['productCityArr'] = $productCityArr;
        $viewArr['pincode'] = $this->cookiePincode;
        if ($this->uri->total_segments() == 2) {
            $page_name = $this->uri->segment(2);
            $viewArr['page_meta'] = $this->product_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'product/product_listing';
        $viewArr['categoryArr'] = $categoryArr;
        $this->load->view('common', $viewArr);
    }
    

    public function shop() {
        $category_id_arr = array(JUICES_CATEGORY_ID, ALMONDMILK_CATEGORY_ID, PROTEINMILKSHAKE_CATEGORY_ID);
        //$viewArr['products'] = $this->product_model->getProducts($category_id_arr);
        
        $viewArr['city_id'] = getPincodeCityDefault($this->cookiePincode);
        $productsList = $this->product_model->getProducts($category_id_arr,'',1);
        $viewArr['products'] = getCityWisePrice($productsList,$viewArr['city_id']);

        $productsCity = $this->product_model->getProductCity($category_id_arr);
        if ($productsCity) {
            foreach ($productsCity as $city_row) {
                $productCityArr[$city_row['product_id']] = $city_row['city_ids'];
            }
        }
        $avail=$notavail=array();
        foreach ($viewArr['products'] as $products) {
            $cityArr = str_replace(' ', '', explode(',', $productCityArr[$products['product_id']]));
            if($cityArr[0]==''){
                $productCityArr[$products['product_id']] = '';    
            }
            if(!in_array($viewArr['city_id'], $cityArr)){
                $notavail[] = $products;
            }else{
                $avail[] = $products;
            }
        }
        $viewArr['products'] = array_merge($avail,$notavail);
        $viewArr['productCityArr'] = $productCityArr;
        $viewArr['pincode'] = $this->cookiePincode;

        if ($this->uri->total_segments() == 1) {
            $page_name = $this->uri->segment(1);
            $viewArr['page_meta'] = $this->product_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'product/product_listing';
        $this->load->view('common', $viewArr);
    }

    public function getProductDetails() {
        $product_url = trim(strtolower($this->uri->segment($this->uri->total_segments())));
        if ($product_url) {
            return $this->product_model->getProductDetails($product_url);
        } else {
            redirect('/home/');
        }
    }

    public function getProductDetailByUrl($category_id = '') {
        //echo $category_id;die;
        $product_url = trim(strtolower($this->uri->segment($this->uri->total_segments())));
        $product_id = $this->product_model->getProductIDByUrl($product_url, $category_id);
        //print_r($product_id);die;
        $this->getProductDetail($product_id);
    }

    public function getProductDetail($product_id) {

        if ($product_id) {
            $viewArr['product_detail'] = $product_details = $this->product_model->getProductDetails($product_id);
            /*$viewArr['page_meta'] = $this->product_model->getProductMeta($product_id);*/
            $viewArr['page_meta'] = getProductDetailSeoAttributes($product_details);
            $viewArr['product_attribute'] = $this->product_model->getProductAttribute($product_id);
            $viewArr['product_option'] = $this->product_model->getProductOption($product_id);
            $viewArr['product_items'] = $this->product_model->getProductItem($product_id);
            //$viewArr['city_id'] = getPincodeCity($this->cookiePincode);
            $viewArr['city_id'] = getPincodeCityDefault($this->cookiePincode);
            $product_data[0] = $product_details;
            $city_wise_price_data = getCityWisePrice($product_data,$viewArr['city_id']);
            $viewArr['product_detail'] = $product_details = $city_wise_price_data[0];
            $viewArr['product_option']['option_txt'] = $product_details['option_txt'];
            /*echo "<pre>";
            print_r($viewArr);
            echo "</pre>";die;*/
            $viewArr['faqs'] = $this->product_model->getFaqDetails($product_details['category_id']);
            $viewArr['product_reviews'] = $this->product_model->getProductReviews($product_details['product_id']);
            $viewArr['cityResult'] = $this->product_model->getProductCityById($product_id);
            $viewArr['view'] = 'product_detail/detail';
            //print_r($viewArr);
            $this->load->view('common', $viewArr);
        } else {
            redirect('/home/');
        }
    }

    public function getRecommendedProducts($product_id, $category_id) {
        $recommendedProducts = $this->product_model->getRecommendedProducts($product_id, $category_id);
        print_r($recommendedProducts);
    }

    public function getProductReviews($product_id = '') {
        $recommendedProducts = $this->product_model->getProductReviews($product_id);
        //echo '<pre>';
        //print_r($recommendedProducts);
        $inputArr['reviews'] = $recommendedProducts;
        $this->load->view('product_reviews', $inputArr);
    }

    public function getFaq($product_id) {
        $faq = $this->product_model->getFaq($product_id);
        print_r($faq);
    }

    public function getCategoryList() {
        $rows = $this->product_model->getCategoryList();
        // print_r($rows);
        $catList = $this->buildTree($rows);
        print_r($catList);
    }

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_category_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['category_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    function search() {
        $this->load->view('search');
    }

    function getSearchResult() {
        $q = $this->input->get('q');
        $result = $this->product_model->getSearchResult($q);

        if ($result) {
            foreach ($result as $key => $row) {
                $newArr[$key] = $row;
                $newArr[$key]['product_url'] = site_url('shop/' . $row['category_url'] . '/' . $row['product_url']);
            }
        }
        //print_r($result);die;


        $returnArr['status'] = 'success';
        $returnArr['data'] = $newArr;
        if ($result === FALSE) {
            $returnArr['status'] = 'failed';
        }

        echo json_encode($returnArr);
    }

}
