<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['shop'] = 'product/shop';
$route['shop/cart'] = 'cart/index';
$route['shop/([a-z-]+)'] = 'product/index';
//$route['shop/juices/([a-z-]+)'] = 'product/getProductDetail';
$route['shop/juices/([a-z0-9-]+)'] = 'product/getProductDetailByUrl/'.JUICES_CATEGORY_ID;
$route['shop/almond-milks/([a-z0-9-]+)'] = 'product/getProductDetailByUrl/'.ALMONDMILK_CATEGORY_ID;
$route['shop/cleanses/([a-z0-9-]+)'] = 'product/getProductDetailByUrl/'.CLEANSES_CATEGORY_ID;
$route['shop/value-packs/([a-z0-9-]+)'] = 'product/getProductDetailByUrl/'.VALUEPACKS_CATEGORY_ID;
$route['shop/subscriptions/([a-z0-9-]+)'] = 'product/getProductDetailByUrl/'.SUBSCRIPTIONS_CATEGORY_ID;
$route['shop/protein-milkshake/([a-z0-9-]+)'] = 'product/getProductDetailByUrl/'.PROTEINMILKSHAKE_CATEGORY_ID;

//$route['shop/(juices|cleanses|value-packs)/([a-z-]+)'] = 'product/getProductDetail';
$route['about-us'] = 'common/aboutUs';
$route['cfapacks'] = 'product/cfaListing';

$route['process'] = 'common/process';
$route['terms-and-condition'] = 'common/termsCondition';
$route['privacy-policy'] = 'common/privacyPolicy';
$route['returns-and-refunds'] = 'common/returnsRefunds';
$route['news'] = 'common/news';
$route['shelf-life'] = 'common/shelf';
$route['bulk-order'] = 'bulkorder/index';


$route['contact-us'] = 'contact/index';
$route['signup'] = 'user/signup';
$route['login'] = 'user/login';
$route['resetPassword/([a-z0-9-]+)'] = 'user/resetPassword/$1';
//$route['login_password'] = 'user/loginPassword';
$route['checkout'] = 'checkout/index';
$route['customer/address'] = 'address/addressDetail';
$route['logout'] = 'user/logout';
$route['facebook/response'] = 'user/facebookLoginResponse';
$route['google/response'] = 'user/googleLoginResponse';
$route['forgotPassword'] = 'user/forgot_password_new';
$route['loginPassword'] = 'user/loginPassword';
// $route['dashboard/items-ordered'] = 'dashboard/getItemsOrderedDetail';
$route['crm'] = 'CRM/welcome';
$route['crm/orders'] = 'CRM/ordersView';
$route['thankyou'] = 'payment/thankyou';
//$route['crm/order-details'] = 'CRM/orderDetailsView';

$route['rawtalk'] = 'campaign/rawtalk';
//$route['delivery'] = 'DeliveryNew';

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;