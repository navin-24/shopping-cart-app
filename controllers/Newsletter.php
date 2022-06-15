<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('newsletter_model');
        //$this->logged_in();
    }

    function email() {
        $this->load->view('email');
    }

    function subscribe() {

        $email = (string) $this->input->post('email');
        $returnArr['result'] = 'failed';
        
        if ($email) {
            if ($this->isValidEmail($email)) {
                $row = $this->newsletter_model->checkUser($email);
                if ($row) {
                    $str = 'This email address is already subscribed.';
                } else {
                    $row = $this->newsletter_model->subscribe($email);
                    $returnArr['result'] = 'success';
                    $str = 'Thank you for subscribing to our newsletter and offer, stay tuned for some juicey updates your way!';
                }
            } else {
                $str = 'Please enter a valid email address.';
            }
        } else {
            $str = 'Please enter a email address.';
        }

        $returnArr['msg'] = $str;
        echo json_encode($returnArr);
    }

    private function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

}
