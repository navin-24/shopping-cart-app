<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['rawtalk'] = array(
	array(
		'field'=>'customer_name',
		'label'=>'Customer name',
		'rules'=>'trim|required|max_length[100]|regex_match[/^[a-zA-Z ]*$/]',
		'errors'=>array(
				'required'=>'Customer name is required',
				'max_length'=>'Customer name must be less than 100 characters',
				'regex_match'=>'Customer name must contain alphabetical characters'
			)
	),
	array(
		'field'=>'customer_contact_number',
		'label'=>'Customer contact number',
		'rules'=>'trim|required|numeric|min_length[10]|max_length[10]',
		'errors'=>array(
				'required'=>'Customer contact number is required',
				'numeric'=>'Customer contact number must contain numbers',
				'min_length'=>'Customer contact number must be 10 digit in length',
				'max_length'=>'Customer contact number must be 10 digit in length'									
			)
	),
	array(
		'field'=>'customer_email',
		'label'=>'Customer email address',
		'rules'=>'trim|required|valid_email|max_length[255]',
		'errors'=>array(
				'required'=>'Customer email address is required',
				'valid_email'=>'Customer email must have valid email address',
				'max_length'=>'Customer email must be less than 255 characters'									
			)
	),
	array(
		'field'=>'customer_city',
		'label'=>'Customer city',
		'rules'=>'trim|required|alpha',
		'errors'=>array(
				'required'=>'Customer city is required',
				'alpha'=>'Customer city must contain alphabetical characters'
			)
	),
);

$config['deliveryboy'] = array(
	array(
		'field'=>'db_mobileNumber',
		'label'=>'Your Mobile Number',
		'rules'=>'trim|required|numeric|min_length[10]|max_length[10]',
		'errors'=>array(
			'required'=>'Your Mobile Number is required',
			'numeric'=>'Your Mobile Number must contain numbers',
			'min_length'=>'Your Mobile Number must be 10 digit in length',
			'max_length'=>'Your Mobile Number must be 10 digit in length'							
		)
	),
	
);