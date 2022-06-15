<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    function index() {
        $this->load->helper('security');

        $rules = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|xss_clean',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'telephone',
                'label' => 'Telephone',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'comment',
                'label' => 'Comment',
                'rules' => 'trim|required|xss_clean'
            ),
        );

        $this->form_validation->set_rules($rules);


        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('contact/index');
            $viewArr['pageName'] = $this->pageName;
            $viewArr['cookieAddress'] = $this->cookieAddress;
            $viewArr['cookiePincode'] = $this->cookiePincode;
            $this->load->view('header', $viewArr);
            // $this->load->view('login');
            $this->load->view('contact/index');
            $this->load->view('footer', $viewArr);
        } else {
            $inputArr['name'] = $this->input->post('name');
            $inputArr['email'] = $email = $this->input->post('email');
            $inputArr['telephone'] = $this->input->post('telephone');
            $inputArr['comment'] = $this->input->post('comment');

            $result = $this->user_model->saveQuery($inputArr);
            if ($result) {

                $_SESSION["querymsg"] = 'Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.';
                $s = $this->sendemail($inputArr);
            } else {
                $_SESSION["querymsg"] = 'Unable to submit your request. Please, try again later';
            }

            redirect('contact/index');
        }
    }

    function sendemail($post) {
        $message = '<p>Hello,</p><p>A New Enquiry Is Received:</p><p><b>Name:</b> ' . ($post['name']) . '<br>
			    <p><b>Email:</b> ' . ($post['email']) . '<br>
			    <p><b>Telephone:</b> ' . ($post['telephone']) . '<br>
			    <b>Comments:</b> ' . ($post['comment']) . '</p>';
        $strippedMessage = trim(preg_replace('/\s+/', ' ', $message));

        //$this->load->library('email');
        $fromemail = "getmore@rawpressery.com";
        $toemail = 'rahul.chipad@rawpressery.com';
        $subject = "Contact Us Form";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pepipost.com/v2/sendEmail",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"personalizations\":[{\"recipient\":\"$toemail\"}],\"from\":{\"fromEmail\":\"$fromemail\",\"fromName\":\"Rawpressery - Contact Us\"},\"subject\":\"$subject\",\"content\":\"$strippedMessage\"}",
            CURLOPT_HTTPHEADER => array(
                "api_key: 5b98b0b2687056ee6af430d2e4f807b5",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;

        /* $config = array(
          'charset' => 'utf-8',
          'wordwrap' => TRUE,
          'mailtype' => 'html'
          );

          $this->email->initialize($config);

          $this->email->to($toemail);
          $this->email->from($fromemail, "Title");
          $this->email->subject($subject);
          $this->email->message($body);
          return $this->email->send(); */
    }

}
