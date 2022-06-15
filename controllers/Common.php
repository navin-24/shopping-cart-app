<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('asia/kolkata');

class Common extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    function aboutUs() {
        if ($this->uri->total_segments() == 1) {
            $page_name = $this->uri->segment(1);
            $viewArr['page_meta'] = $this->common_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'aboutus';
        $this->load->view('common', $viewArr);
    }

    function process() {
        if ($this->uri->total_segments() == 1) {
            $page_name = $this->uri->segment(1);
            $viewArr['page_meta'] = $this->common_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'process';
        $this->load->view('common', $viewArr);
    }

    function termsCondition() {
        if ($this->uri->total_segments() == 1) {
            $page_name = $this->uri->segment(1);
            $viewArr['page_meta'] = $this->common_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'terms-and-condition';
        $this->load->view('common', $viewArr);
    }

    function privacyPolicy() {
        if ($this->uri->total_segments() == 1) {
            $page_name = $this->uri->segment(1);
            $viewArr['page_meta'] = $this->common_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'privacy-policy';
        $this->load->view('common', $viewArr);
    }

    function returnsRefunds() {
        if ($this->uri->total_segments() == 1) {
            $page_name = $this->uri->segment(1);
            $viewArr['page_meta'] = $this->common_model->getPageMeta($page_name);
        }
        $viewArr['view'] = 'returns-and-refunds';
        $this->load->view('common', $viewArr);
    }

    public function news() {
        $viewArr['view'] = 'news';
        $this->load->view('common', $viewArr);
    }

    function shelf() {
        $viewArr['view'] = 'shelf';
        $this->load->view('common', $viewArr);
    }

}
