<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Productfeed extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function generatexml(){
        $this->load->model(array('productfeed_model'));
		$getData = $this->productfeed_model->getCityWiseProductData();
		$cityWiseData = array();
		$cities = array();
		if(!empty($getData)){
			foreach ($getData as $key => $value) {
				$cityWiseData[strtolower(str_replace(' ', '', $value['city_name']))][] = $value;	
				$cities[] = strtolower(str_replace(' ', '', $value['city_name']));
			}	
			$cities = array_values(array_unique($cities));
			$xmlDoc  = new DOMDocument; 
			$xmlDoc->preserveWhiteSpace = false;
			$xmlDoc->formatOutput = true;

			/* Delete items node from each city xml */
			foreach ($cities as $key => $value) {
				$xmlDoc->load($value.'.xml');
				$matchingElements = $xmlDoc->getElementsByTagName('item');
				$totalMatches     = $matchingElements->length;
				$elementsToDelete = array();
				for ($i = 0; $i < $totalMatches; $i++){
				    $elementsToDelete[] = $matchingElements->item($i);
				}
				foreach ( $elementsToDelete as $elementToDelete ) {
				    $elementToDelete->parentNode->removeChild($elementToDelete);
				}
				$xmlDoc->save($value.'.xml');
			}	

			/* create xml nodes as needed for each city xml */
			foreach ($cities as $key => $value) {
				$xmlDoc->load($value.'.xml');
				$channel = $xmlDoc->getElementsByTagName('channel')->item(0);
				foreach ($cityWiseData[$value] as $cKey => $cValue) {
					$item =$xmlDoc->createElement('item');
					$channel->appendChild($item);
					$gId =$xmlDoc->createElement('g:id',$cValue['sku']);
					$item->appendChild($gId);
					$gTitle =$xmlDoc->createElement('g:title',$cValue['product_name']);
					$item->appendChild($gTitle);
					$gDescription =$xmlDoc->createElement('g:description',htmlspecialchars($cValue['product_short_desc']));
					$item->appendChild($gDescription);
					$gAvailability =$xmlDoc->createElement('g:availability',(($cValue['is_in_stock']==1)?"In Stock":"Out Of Stock"));
					$item->appendChild($gAvailability);
					/*$gProductCategory =$xmlDoc->createElement('g:google_product_category', $cValue['category_name']);
					$item->appendChild($gProductCategory);*/
					$gImageLink =$xmlDoc->createElement('g:image_link', PRODUCT_THUMB_PATH . '/' . $cValue['thumb_image_url']);
					$item->appendChild($gImageLink);

					$categoryArr = unserialize(CATEGORYARR);
					$category = $categoryArr[$cValue['category_id']];
					$gLink =$xmlDoc->createElement('g:link', site_url('shop/'.$category.'/'.$cValue['product_url']));
					$item->appendChild($gLink);
					$gPincodes =$xmlDoc->createElement('g:pincode', $cValue['pincode']);
					$item->appendChild($gPincodes);
					$gProdCity =$xmlDoc->createElement('g:custom_label_0', $value);
					$item->appendChild($gProdCity);					

					$basePrice = $specialPrice = 0;
					$productPriceData = json_decode($cValue['product_price'],true);
					if(strtolower($cValue['category_name']) == 'subscriptions'){
						foreach ($productPriceData['price'] as $ppKey => $ppValue) {
							if($ppValue['option_name'] == "4 Weeks"){
								$basePrice = $ppValue['base_price'].' INR';
								$specialPrice = $ppValue['special_price'].' INR';
							}
						}
					} else {
						$basePrice = $productPriceData['price']['base_price'].' INR';
						$specialPrice = $productPriceData['price']['special_price'].' INR';
					}
					$gBasePrice =$xmlDoc->createElement('g:price', $basePrice);
					$item->appendChild($gBasePrice);
					$gSpecialPrice =$xmlDoc->createElement('g:sale_price', $specialPrice);
					$item->appendChild($gSpecialPrice);		
				}					
				$xmlDoc->save($value.'.xml');
			}
		}
    }
}