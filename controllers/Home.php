<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->helper('common_helper');
        $this->config->load('home_config');
        //$this->logged_in();
    }

    function index() {
        $viewArr['pageName'] = $this->pageName;
        $viewArr['cookieAddress'] = $this->cookieAddress;
        $viewArr['cookiePincode'] = $this->cookiePincode;
        $viewArr['view'] = 'home';
        $segmentCount = $this->uri->total_segments();
        if ($segmentCount == 0 && $this->pageName == 'home') {
            $viewArr['page_meta'] = $this->common_model->getPageMeta($page_name = $this->pageName);
        }
        $this->load->view('common', $viewArr);
    }
    
    function newhome() {
        $this->load->view('newhomepage/header');
        $this->load->view('newhomepage/home');
        $this->load->view('newhomepage/footer');
    }

    function pincodeCheck() {
        $inputArr['pincode'] = $pincode = $this->input->post('pincode');
        $inputArr['location'] = $entered_address = $this->input->post('entered_address');
        $inputArr['latitude'] = $this->input->post('latitude');
        $inputArr['longitude'] = $this->input->post('longitude');
        $pagename = $this->input->post('pagename');
        $city = $this->input->post('city');

        $row = $this->common_model->pincodeCheck($pincode, $city);

        if ($row) {
            $returnArr['status'] = 'success';
            $str = '';
            /*set_cookie('pincode_cookie', $pincode,time() + (10 * 365 * 24 * 60 * 60), $_SERVER['SERVER_NAME']);
            set_cookie('entered_address', $entered_address,time() + (10 * 365 * 24 * 60 * 60), $_SERVER['SERVER_NAME']);*/
            set_cookie('pincode_cookie', $pincode,'1231231', $_SERVER['SERVER_NAME']);
            set_cookie('entered_address', $entered_address,'1231231', $_SERVER['SERVER_NAME']);
        } else {
            $row = $this->common_model->insertNoServicePincode($inputArr);
            $returnArr['status'] = 'failed';
            $str = 'Uh Oh! We’re currently not able to deliver at this location. But our friends at <a href="https://www.bigbasket.com/ps/?q=raw pressery" target="_blank">Bigbasket</a> might just';
        }

        $returnArr['msg'] = $str;
        echo json_encode($returnArr);
    }

    function addressCheck() {
        $inputArr['pincode'] = $pincode = $this->input->post('pincode');
        //$pagename = $this->input->post('pagename');
        $city = $this->input->post('city');
        $selected_address = $this->input->post('selected_address');
        $row = $this->common_model->pincodeCheck($pincode, $city);

        if ($row) {
            $returnArr['status'] = 'success';
            $str = '';
            /*set_cookie('pincode_cookie', $pincode,time() + (10 * 365 * 24 * 60 * 60), $_SERVER['SERVER_NAME']);
            set_cookie('entered_address', $selected_address,time() + (10 * 365 * 24 * 60 * 60), $_SERVER['SERVER_NAME']);*/
            set_cookie('pincode_cookie', $pincode,'12313244', $_SERVER['SERVER_NAME']);
            set_cookie('entered_address', $selected_address,'12314124', $_SERVER['SERVER_NAME']);
            $this->session->set_userdata('address_id', $this->input->get_post('address_id')); 
        } else {
            $row = $this->common_model->insertNoServicePincode($inputArr);
            $returnArr['status'] = 'failed';
            $str = 'We are currently not delivering at this Address';
        }

        $returnArr['msg'] = $str;
        echo json_encode($returnArr);
    }

    public function getpincodeByLocation() {
        $latitude = trim($this->input->post('latitude'));
        $longitude = trim($this->input->post('longitude'));
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latitude . ',' . $longitude . '&key=' . GOOGLE_MAP_APIKEY;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curlResponse = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($curlResponse, true);

        if ($output['status'] == 'OK') {
            if ($output['results']) {
                for ($j = 0; $j < sizeof($output['results'][0]['address_components']); $j++) {
                    if ($output['results'][0]['address_components'][$j]['types'][0] == 'postal_code') {
                        $pincode = $output['results'][0]['address_components'][$j]['short_name'];
                        $entered_address = $output['results'][0]['formatted_address'];
                        set_cookie('pincode_cookie', $pincode, time() + (10 * 365 * 24 * 60 * 60));
                        set_cookie('entered_address', $entered_address, time() + (10 * 365 * 24 * 60 * 60));
                        $short_sddr = (strlen($entered_address) > 20) ? substr($entered_address, 0, 25) . '... ' : $entered_address;
                        echo $short_sddr;
                    }
                }
            }
        } else {
            echo '';
        }
        exit();
    }

    public function sendPromocode() {
        $email = trim($this->input->post('email'));
        $pincode = trim($this->input->post('pincode'));
        $entered_address = trim($this->input->post('entered_address'));

        if ($email) {
            if (email_validation($email)) {
                $message = "<div style='margin:0 auto; max-width:640px; text-align: center; border:1px solid #ddd;'> <div style='display:block; background: #000; padding:15px 0;'> <img width='70' src='https://www.rawpressery.com/skin/frontend/rawpressery/default/images/Raw_Logo.png' alt=''> </div><div style='padding:50px 15px 60px 15px;'> <h3 style='color: #000; font-size: 24px; margin: 15px 0 0 0; font-weight: 400;'>Hello New Friend</h3> <p style='font-size: 18px; color: #555;padding:0 50px;'> Here's an additional 5% discount on anything you purchase from the website today.</p><h2 style='font-size: 30px;'>USE CODE: <span style='color:green;'>NEWFRIEND</span></h2><a href='https://www.rawpressery.com/shop-227/subscription.html' target='_blank' style='padding: 15px 25px; margin-top:15px; display: inline-block; border: 0; outline: 0; background: #000; color:#fff;text-decoration: none;'>VISIT WEBSITE</a> </div><div style='border-top:1px solid #ddd; padding:15px; background: #f7f7f7;'> <h4 style='text-transform: uppercase;'>All good. no bad.</h4> <p style='font-size: 14px; color: #999;'> Raw Pressery makes fresh cold pressed juices and almond milks, delivered straight to your doorstep. </p><p style='font-size: 12px; color: #999;'>&copy; ".date('Y')." Rakyan Beverages</p></div></div>";
                $subject = 'Rawpressery: Secret Coupon Code';
                $response = sendEmail($message, $subject, $email);
                $responseArray = json_decode($response, true);

                if (strtolower($responseArray['message']) == 'success') {
                    $returnArr['status'] = 'success';
                    $returnArr['msg'] = 'Email sent successfully';
                } else {
                    $returnArr['status'] = 'failed';
                    $returnArr['msg'] = 'Please try after some time';
                }

                $insertArr['location'] = $entered_address;
                $insertArr['email'] = $email;
                $insertArr['pincode'] = $pincode;
                $insertArr['status'] = $returnArr['status'];
                $insertArr['created_at'] = date('Y-m-d H:i:s');

                $this->common_model->insertPromoEmail($insertArr);

                echo json_encode($returnArr);
            }
        }
    }

    public function getBannerContent(){
        $id = trim($this->input->post('id'));
        $section_data = json_decode($this->input->post('section_data'),1);
        switch ($id) {
            case 'box-2':
                $html = $this->getBanner2($section_data);
                break;
            case 'box-3':
                $html = $this->getBanner3($section_data);
                break;
            case 'box-4':
                $html = $this->getInsta();
                break;
            case 'box-5':
                $html = $this->getTeams($section_data);
                break;
            case 'box-6':
                $html = $this->getArticles($section_data);
                break;
            default:
                # code...
                break;
        }
        echo $html;die;
    }

    public function getBanner2($data){
        $section_data = $data[0];
        $str='';
        $str.= '<section class="dvVideo text-center relative" style="background:url('. IMG_BASE_PATH . $section_data['desktop_image_url']. ') no-repeat top left; background-size:cover;">
                <div class="container d-flex h-100">
                    <div class="videoText m-auto">';
        $str.='<h1>'.$section_data['title'].'</h1>';
        $str.='<p>'.$section_data['content'].'</p>';
        $str.= '<a class="playBtn" id="playme" onclick="revealVideo(\'video\',\'youtube\')"><i class="fas fa-play"></i></a>
                    </div>
                </div>';
        $str.='<div id="video" class="videoPopup" onclick="hideVideo(\'video\',\'youtube\')">
                    <a class="close" onclick="hideVideo(\'video\',\'youtube\')">X</a>
                    <iframe id=\'youtube\' width="100%" height="100%" src="https://www.youtube.com/embed/EYmsNq5Ymgs?showinfo=0" frameborder="0"allowfullscreen></iframe>
                </div>
                <img src="'. IMG_BASE_PATH . $section_data['mobile_image_url'].'" class="img-fluid d-md-none" alt="">
            </section>';
        return $str;
    }

    public function getBanner3($section_data){
        $rowCnt = 0;
        $str='';
        $str.='<section class="cSlider">
                <div class="owl-carousel">';
                foreach ($section_data as $row) {
                    $applyClass = ($rowCnt == 3)?"class='w50'":"";
        $str.= '<div class="item" style="background:url('.IMG_BASE_PATH . $row['desktop_image_url'].') no-repeat top left; background-size:cover;">
                            <div class="container relative">
                                <div class="owl-text">
                                    <div>
                                        <h1>'.$row['title'].'</h1>
                                        <h4>'.$row['sub_tags'].'</h4>
                                        <h5 '.$applyClass.'>'.$row['sub_title'].'</h5>
                                        <a href="'.$row['btn_url'].'" class="btn btnPrimary" title="'.$row['title'].'">'.$row['btn_txt'].'</a>
                                    </div>
                                </div>
                            </div>
                            <img src="'.IMG_BASE_PATH . '' . $row['mobile_image_url'].'" class="img-fluid d-md-none" alt="'.$row['title'].'">
                        </div>';
                        $rowCnt++;
                    }
        $str.= '</div>
            </section>';
        return $str;
    }

    public function getArticles($articles){
        $str='';
        $str.='<section class="dvLogos">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="owl-carousel">';
                foreach ($articles as $article) {
        $str.='<div class="item text-center d-flex justify-content-between align-items-center flex-column h-100">';
        $str.='<div><img src="'. IMG_BASE_PATH . $article['image_url'].'" alt="" class="img-fluid"></div>';
        $str.='<div><p class="content">'.$article['content'].'</p></div>';
        $str.='<div><a class="text-white" href="'. $article['article_url'].'" target="_blank">Read More</a></div>
                    </div>';
                }
        $str.='</div>
                </div>
            </div>
        </div>
        </section>';
        return $str;
    }

    public function getTeams($teamImages){
        $str='';
        $str.='<section class="dvTeam">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 text-center p30 order-xl-1">
                            <div>
                                <h2>The Raw Tribe</h2>
                                <p>Meet the team that works round the clock to get you the goodness of mother nature from farm to your doorstep.</p>
                            </div>
                        </div>
                        <div class="col-xl-6 p0 mt50 order-xl-0">
                            <div class="owl-carousel">';
                    foreach ($teamImages as $row) {
                        $str.='<div class="item">
                                <img src="'.IMG_BASE_PATH . $row['image_url'].'" alt="'. $row['name'].'" class="img-fluid">
                                <div class="middle">
                                    <h5>'.$row['name'].'</h5>
                                    <h6>'.$row['designation'].'</h6>
                                </div>
                            </div>';
                    }
                    $str.='</div>
                    </div>
                </div>
            </div>
        </section>';
        return $str;
    }

    public function getInsta(){
        $str='';
        $str.='<section class="dvInsta">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 text-center p30">
                        <div>
                            <h2 class="bebas">OF COURSE WE ARE<br /> ON INSTAGRAM!</h2>
                            <p>Also on Facebook &amp; Twitter. Come say hi or tag us in your story to get featured on ours.</p>
                            <a class="d-block" href="https://www.instagram.com/rawpressery/" target="_blank"> Follow Us @RAWPRESSERY</a>
                        </div>
                    </div>
                    <div class="col-xl-6 p0 mt50">
                        <div class="elfsight-app-aa39475a-8f6f-4ef4-92e2-40379171d755">&nbsp;</div>
                    </div>
                </div>
            </div>
        </section>';
        return $str;
    }
}
