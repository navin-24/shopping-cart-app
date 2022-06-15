<?php

function email_validation($str) {
    return (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) ? FALSE : TRUE;
}

function generateBreadcrumb($product_name = '') {
    $ci = &get_instance();
    $i = 1;
    $uri = $ci->uri->segment($i);
    $link = '<nav class="breadcrumb"><div class="container"><ul>'
            . '<li><a href="' . site_url() . '">Home</a></li>';

    while ($uri != '') {
        $prep_link = '';
        for ($j = 1; $j <= $i; $j++) {
            $prep_link.=$ci->uri->segment($j) . '/';
        }



        if ($ci->uri->segment($i + 1) == '') {
            if ($product_name != '') {
                $link.='<li class="active">' . $product_name . '</li>';
            } else {
                $link.='<li class="active">' . preg_replace('/\W/', ' ', $ci->uri->segment($i)) . '</li>';
            }
        } else {

            $prep_link = rtrim($prep_link, '/');

            $link.='<li><a href="' . site_url($prep_link) . '">';
            $link.=preg_replace('/\W/', ' ', $ci->uri->segment($i)) . '</a></li>';
        }

        $i++;
        $uri = $ci->uri->segment($i);
    }
    $link .='</ul></div></nav>';
    return $link;
}

function generateBreadcrumbProductDetail($product_name = '') {
    $ci = &get_instance();
    $i = 1;
    $uri = $ci->uri->segment($i);
    $link = '<nav class="breadcrumb" style="position:relative;top:5rem;z-index:2;"><div class="container"><ul>'
            . '<li><a href="' . site_url() . '">Home</a></li>';

    while ($uri != '') {
        $prep_link = '';
        for ($j = 1; $j <= $i; $j++) {
            $prep_link.=$ci->uri->segment($j) . '/';
        }



        if ($ci->uri->segment($i + 1) == '') {
            if ($product_name != '') {
                $link.='<li class="active">' . $product_name . '</li>';
            } else {
                $link.='<li class="active">' . preg_replace('/\W/', ' ', $ci->uri->segment($i)) . '</li>';
            }
        } else {

            $prep_link = rtrim($prep_link, '/');

            $link.='<li><a href="' . site_url($prep_link) . '">';
            $link.=preg_replace('/\W/', ' ', $ci->uri->segment($i)) . '</a></li>';
        }

        $i++;
        $uri = $ci->uri->segment($i);
    }
    $link .='</ul></div></nav>';
    return $link;
}

function sendEmail($message, $subject, $customer_email, $from_email = '', $from_name = '',$attachment_data='',$filename='') {
    if ($message !== '') {
        $curl = curl_init();

        if ($from_email == '') {
            $from_email = FROM_EMAIL;
        }

        if ($from_name == '') {
            $from_name = FROM_NAME;
        }

        $post_fields = "{\"personalizations\":[{\"recipient\":\"$customer_email\"}],\"from\":{\"fromEmail\":\"$from_email\",\"fromName\":\"$from_name\"},\"subject\":\"$subject\",\"content\":\"$message\"}";

        if($attachment_data){
           $attachment_content = base64_encode($attachment_data);
           $post_fields = "{\"personalizations\":[{\"recipient\":\"$customer_email\"}],\"from\":{\"fromEmail\":\"$from_email\",\"fromName\":\"$from_name\"},\"subject\":\"$subject\",\"content\":\"$message\",\"attachments\":[{\"name\":\"$filename\",\"content\":\"$attachment_content\"}]}";
        }
        
        $postArr = array(
            CURLOPT_URL => EMAIL_API_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => array(
                "api_key: 5b98b0b2687056ee6af430d2e4f807b5",
                "content-type: application/json"
            )
        );
        //print_r($postArr);
//die;
        curl_setopt_array($curl, $postArr);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}

function getPincodeCity($pincode) {
    $ci = & get_instance();

    $ci->load->database();
    $sql = "SELECT city_id FROM `pincode` WHERE pincode = '$pincode' and is_active=1 limit 1";
    $q = $ci->db->query($sql);

    if ($q->num_rows() > 0) {
        return $q->row()->city_id;
    }
    else{
        return 0;
    }
}

function getPincodeCityDefault($pincode) {
    $ci = & get_instance();

    $ci->load->database();
    $sql = "SELECT city_id FROM `pincode` WHERE pincode = '$pincode' and is_active=1 limit 1";
    $q = $ci->db->query($sql);

    if ($q->num_rows() > 0) {
        return $q->row()->city_id;
    }
    else{
        return 1;
    }
}

function getCityWisePrice($products,$cityid,$option_type_id=''){
    $ci = & get_instance();

    $ci->load->database();
    $ci->load->library('cart');
    $city_id = ($cityid)?$cityid:DEFAULT_CITY_ID;
    $multi_price_category = array(SUBSCRIPTIONS_CATEGORY_ID,CLEANSES_CATEGORY_ID);
    $sql = "SELECT product_id,category_id,product_price FROM `product_city_price` WHERE city_id = '$city_id'";
    $q = $ci->db->query($sql);
    $result = $q->result_array();
    $product_city=array();
    foreach ($result as $value) {
        $product_city[$value['product_id']] = $value;
    }

    $cart = $ci->cart->in_cart($products[0]['sku']);
    /*$cartData = $ci->cart->get_item($cart['rowid']);*/
/*echo "<pre>";
print_r($products);
echo "</pre>";die;*/

    foreach ($product_city as $k => $v) {
        foreach ($products as $key => $value) {
            if ($value['product_id'] == $k) {
                $price_data = json_decode($v['product_price'],1);
                $price_arr = $price_data['price'];
                $products[$key]['base_price'] = $price_arr['base_price'];
                $products[$key]['special_price'] = $price_arr['special_price'];
                if(in_array($value['category_id'], $multi_price_category)){
                    $products[$key]['option_txt'] = json_encode($price_arr);
                    $products[$key]['base_price_per_bottle'] = $price_data['base_price_per_bottle'];
                    $products[$key]['special_price_per_bottle'] = $price_data['special_price_per_bottle'];
                    if (!$cart) {
                        $products[$key]['base_price'] = $price_arr[0]['base_price'];
                        $products[$key]['special_price'] = $price_arr[0]['special_price'];
                    }
                    if ($option_type_id) {
                        foreach ($price_arr as $val) {
                            if ($val['option_type_id'] == $option_type_id) {
                                $products[$key]['base_price'] = $val['base_price'];
                                $products[$key]['special_price'] = $val['special_price'];
                            }
                        }
                    }
                }
            }
        }
    }
    return $products;
}

function getAllActiveAdresses($customer_id){
    if(!$customer_id) return;
    $ci = & get_instance();
    $ci->load->database();
    return $ci->db->where(['customer_id'=>$customer_id, 'address.is_active'=>1])
                    ->from('customer_address')
                    ->join('address', 'address.address_id=customer_address.address_id')
                    ->join('pincode', 'address.pincode=pincode.pincode',"left")
                    ->select('address.address_id, address_type, first_name, last_name, address, address.city, address.pincode, is_default_shipping,pincode.is_active')
                    ->order_by('pincode.is_active', 'DESC')
                    ->order_by('customer_address.updated_at', 'DESC')
                    ->get()
                    ->result_array();      
}

function getProductDetailSeoAttributes($productData){
    $seoData = [];
    if(!empty($productData)){
        if($productData['category_url'] == 'subscriptions'){
            $subscriptionJuices = array('subscription-valencia-orange.html','pomegranate-subscription.html','sugarcane-subscription.html','pomegranate-subscription-1litre.html','subscription-valencia-orange-250ml.html','greens-250-ml-x-24.html','grapefruit-subscription.html','life-subscription.html');
            $prodUrl = $productData['product_url'].'.html';
            if(in_array($prodUrl, $subscriptionJuices)){
                $seoData['meta_title'] = "Buy ".$productData['product_name']." Juice Subscription Pack at Best Price | Raw Pressery";
                $seoData['meta_desc'] = "Order ".$productData['product_name']." Juice Subscription Pack online at best price in India from RawPressery.com. Buy ".$productData['product_name']." cold pressed juice bundles near you with free home delivery.";
                $seoData['meta_keywords'] = $productData['product_name']." juice, raw pressery ".$productData['product_name']." subscription pack, raw pressery cold pressed juice subscription packs, order ".$productData['product_name']." juice online, ".$productData['product_name']." juice bundles delivery near me, buy ".$productData['product_name']." online, ".$productData['product_name']." juices for energy, raw pressery ".$productData['product_name']." delivery online in india";            
            } else {
                $seoData['meta_title'] = "Buy ".$productData['product_name']." Subscription Boxes at Best Price | Raw Pressery";
                $seoData['meta_desc'] = "Order ".$productData['product_name']." Subscription Pack online at best price in India from RawPressery.com. Subscribe ".$productData['product_name']." Pre-made bundles near you with free home delivery. Select the date, duration and drinks according to your desire.";
                $seoData['meta_keywords'] = $productData['product_name']." subscription pack, raw pressery ".$productData['product_name']." subscription boxes, raw pressery subscription bundles, subscribe ".$productData['product_name']." online, ".$productData['product_name']." juice bundles delivery near me, buy ".$productData['product_name']." online, shop ".$productData['product_name']." bundles for energy, raw pressery ".$productData['product_name']." delivery online in india";                
            }
            $seoData['meta_og_url'] = "https://www.rawpressery.com/shop/subscriptions/".$productData['product_url'].'.html';
            $seoData['canonical_url'] = "https://www.rawpressery.com/shop/subscriptions/".$productData['product_url'].'.html';
            $seoData['meta_og_title'] = $seoData['meta_title'];
            $seoData['meta_og_description'] = $seoData['meta_desc'];
            $seoData['meta_twitter_title'] = $seoData['meta_title'];
            $seoData['meta_twitter_description'] = $seoData['meta_desc'];
        } else if($productData['category_url'] == 'juices') {
            $seoData['meta_title'] = "Buy ".$productData['product_name']." Juice online at Best Price in India - Raw Pressery";    
            $seoData['meta_desc'] = "Buy ".$productData['product_name']." Juice online at best price in India from RawPressery.com. Order cold pressed fresh ".$productData['product_name']." juice near you with free doorstep delivery to your home or office.";        
            $seoData['meta_keywords'] = "fresh ".$productData['product_name']." juice, raw pressery ".$productData['product_name']." juice , raw pressery coconut juice, ".$productData['product_name']." juice delivery near me, buy ".$productData['product_name']." online, ".$productData['product_name']." for energy, order fresh fruits juice online, ".$productData['product_name']." delivery online in india";
            $seoData['meta_og_url'] = "https://www.rawpressery.com/shop/juices/".$productData['product_url'].'.html';
            $seoData['canonical_url'] = "https://www.rawpressery.com/shop/juices/".$productData['product_url'].'.html';
            $seoData['meta_og_title'] = $seoData['meta_title'];
            $seoData['meta_og_description'] = $seoData['meta_desc'];
            $seoData['meta_twitter_title'] = $seoData['meta_title'];
            $seoData['meta_twitter_description'] = $seoData['meta_desc'];
        } else if($productData['category_url'] == 'value-packs') {
            $seoData['meta_title'] = "Buy ".$productData['product_name']." Juice value packs online at Best Price- Raw Pressery";    
            $seoData['meta_desc'] = "Buy fresh ".$productData['product_name']." juice value pack online at best price in India from RawPressery.com. Order cold pressed ".$productData['product_name']." pre-made juice bundles with free doorstep delivery to your home or office.";    
            $seoData['meta_keywords'] = $productData['product_name']." juice, raw pressery ".$productData['product_name']." juice, ".$productData['product_name']." juice delivery near me, buy ".$productData['product_name']." online, ".$productData['product_name']." for energy, order fresh fruits juice online, ".$productData['product_name']." delivery online in india";    
            $seoData['meta_og_url'] = "https://www.rawpressery.com/shop/value-packs/".$productData['product_url'].'.html';
            $seoData['canonical_url'] = "https://www.rawpressery.com/shop/value-packs/".$productData['product_url'].'.html';
            $seoData['meta_og_title'] = $seoData['meta_title'];
            $seoData['meta_og_description'] = $seoData['meta_desc'];
            $seoData['meta_twitter_title'] = $seoData['meta_title'];
            $seoData['meta_twitter_description'] = $seoData['meta_desc'];
        } else if($productData['category_url'] == 'almond-milks') {
            $seoData['meta_title'] = "Buy ".$productData['product_name']." Online at best price in India | Raw Pressery";    
            $seoData['meta_desc'] = "Buy ".$productData['product_name']." online at best price in India at RawPressery.com. Order ".$productData['product_name']." ".$productData['varient']." near you with free doorstep delivery to your home or office. Almonds are increasing your brain capacity, intellectual ability and longevity.";    
            $seoData['meta_keywords'] = $productData['product_name'].", raw pressery ".$productData['product_name'].", ".$productData['product_name']." delivery near me, buy ".$productData['product_name']." online, ".$productData['product_name']." for energy, order ".$productData['product_name']." online, ".$productData['product_name']." delivery online in india";
            $seoData['meta_og_url'] = "https://www.rawpressery.com/shop/almond-milks/".$productData['product_url'].'.html';
            $seoData['canonical_url'] = "https://www.rawpressery.com/shop/almond-milks/".$productData['product_url'].'.html';
            $seoData['meta_og_title'] = $seoData['meta_title'];
            $seoData['meta_og_description'] = $seoData['meta_desc'];
            $seoData['meta_twitter_title'] = $seoData['meta_title'];
            $seoData['meta_twitter_description'] = $seoData['meta_desc'];            
        } else if($productData['category_url'] == 'protein-milkshake') {
            if($productData['product_url'] == 'banana-honey'){
                $seoData['meta_title'] = "Buy Banana Honey Protein Milkshake online at Best Price in India - Raw Pressery";    
                $seoData['meta_desc'] = "Buy Banana Honey Protein Milkshake online at best price in India from RawPressery.com. Order Banana Honey Protein Milkshake online near you with free doorstep delivery to your home or office.";
                $seoData['meta_keywords'] = "fresh banana milkshake, raw pressery milkshake, raw pressery banana honey milkshake, raw pressery banana shake, milkshake delivery near me, buy banana milkshake online, banana milkshake for weight gain, milkshake delivery online in india";    
                $seoData['meta_og_url'] = "https://rawpressery.com/shop/protein-milkshake/banana-honey.html";
                $seoData['canonical_url'] = "https://rawpressery.com/shop/protein-milkshake/banana-honey.html";
                $seoData['meta_og_title'] = $seoData['meta_title'];
                $seoData['meta_og_description'] = $seoData['meta_desc'];
                $seoData['meta_twitter_title'] = $seoData['meta_title'];
                $seoData['meta_twitter_description'] = $seoData['meta_desc'];            
            } else if($productData['product_url'] == 'chocolate-mint'){
                $seoData['meta_title'] = "Buy Chocolate Mint Protein Milkshake online at Best Price in India - Raw Pressery";    
                $seoData['meta_desc'] = "Buy Chocolate Mint Protein Milkshake online at best price in India from RawPressery.com. Order Chocolate Mint Protein Milkshake online near you with free doorstep delivery to your home or office.";    
                $seoData['meta_keywords'] = "fresh chocolate mint milkshake, raw pressery protein milkshake, raw pressery chocolate mint milkshake, raw pressery protein shake, protein milkshake delivery near me, buy chocolate mint protein milkshake online, chocolate mint milkshake for weight gain, milkshake delivery online in india";    
                $seoData['meta_og_url'] = "https://www.rawpressery.com/shop/protein-milkshake/chocolate-mint.html";
                $seoData['canonical_url'] = "https://www.rawpressery.com/shop/protein-milkshake/chocolate-mint.html";
                $seoData['meta_og_title'] = $seoData['meta_title'];
                $seoData['meta_og_description'] = $seoData['meta_desc'];
                $seoData['meta_twitter_title'] = $seoData['meta_title'];
                $seoData['meta_twitter_description'] = $seoData['meta_desc'];
            } else if($productData['product_url'] == 'cold-coffee'){
                $seoData['meta_title'] = "Buy Cold Coffee Protein Milkshake online at Best Price in India - Raw Pressery";    
                $seoData['meta_desc'] = "Buy Cold Coffee Protein Milkshake online at best price in India from RawPressery.com. Order Cold Coffee Protein Milkshake online near you with free doorstep delivery to your home or office.";    
                $seoData['meta_keywords'] = "fresh cold coffee milkshake, raw pressery protein milkshake, raw pressery Cold Coffee milkshake, raw pressery protein shake, protein milkshake delivery near me, buy cold coffee protein milkshake online, cold coffee milkshake for weight gain, milkshake delivery online in india";    
                $seoData['meta_og_url'] = "https://www.rawpressery.com/shop/protein-milkshake/cold-coffee.html";
                $seoData['canonical_url'] = "https://www.rawpressery.com/shop/protein-milkshake/cold-coffee.html";
                $seoData['meta_og_title'] = $seoData['meta_title'];
                $seoData['meta_og_description'] = $seoData['meta_desc'];
                $seoData['meta_twitter_title'] = $seoData['meta_title'];
                $seoData['meta_twitter_description'] = $seoData['meta_desc'];                
            }
        }
        $seoData['meta_og_locale'] = "en_US";
        $seoData['meta_og_type'] = "website";
        $seoData['meta_og_site_name'] = "RawPressery";
        $seoData['meta_og_image'] = "https://www.rawpressery.com/assets/imgs/white-logo.png";
        $seoData['meta_twitter_card'] = "summary";
        $seoData['meta_twitter_image'] = "https://www.rawpressery.com/assets/imgs/white-logo.png";
    }
    return $seoData;
}

function validateServiceRequest() {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        exit;
    } elseif (isset($_SERVER['HTTP_AUTHTOKEN']) && trim($_SERVER['HTTP_AUTHTOKEN']) != '') {
        $keys = explode(':',$_SERVER['HTTP_AUTHTOKEN']);
        if(isset($keys[0],$keys[1])) {
            $authAllowSource = unserialize(API_AUTHTOKEN_SOURCE_ALLOWED);
            $authKey = API_AUTHTOKEN_KEY;
            if(in_array($keys[0], $authAllowSource) && $keys[1] == $authKey){
                return 'yes';
            } else {
                accessUnAuthorized();
            }
        } else {
            accessUnAuthorized();
        }
    } else {
        accessUnAuthorized();
    }        
}

function accessUnAuthorized() {    
    setContentLength(array('status'=> 'Failure','message'=>'Authorization failed'));
}

function setContentLength($data) {
    $returnData = json_encode($data);
    echo $returnData;
    exit;   
}
function print_array($arr,$exit = ''){
    $print = '<div style="width:100%; border: 2px dotted red; background-color: #fbffd6; display: block; padding: 4px;">';
    $backtrace = debug_backtrace();
    $print .= '<b>Line: </b>'.$backtrace[0]['line'].'<br>';
    $print .= '<b>File: </b> '.$backtrace[0]['file'].'<br>';
    $print .= '</div>';
    echo $print;
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if($exit==''){
        exit();
    }
}

if(!function_exists('isJson')) {
    function isJson($string) {
        json_decode($string);
        if(json_last_error() === JSON_ERROR_NONE){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}