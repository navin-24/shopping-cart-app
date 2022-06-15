<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
#Custom
if (ENVIRONMENT == 'production') {
    define('BASE_URL', 'https://' . $_SERVER['SERVER_NAME']);
    define('ASSET_URL', BASE_URL . '/assets/');
} else if (ENVIRONMENT == 'beta') {
    define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/rawpresseryci');
    define('ASSET_URL', BASE_URL . '/assets/');
} else {
    define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/rawpressery');
    define('ASSET_URL', BASE_URL . '/assets/');
}

define('BLOG_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/blog/');

define('IMG_BASE_PATH', ASSET_URL . 'imgs/');
define('NUTRITION_IMG_PATH', IMG_BASE_PATH . 'ingredients/');
define('PRODUCT_THUMB_PATH', IMG_BASE_PATH . 'product_images/thumb/');
define('PRODUCT_PACKSHOT_PATH', IMG_BASE_PATH . 'product_images/packshot/');
define('PRODUCT_BASE_PATH', IMG_BASE_PATH . 'product_images/base/');


define('GOOGLE_MAP_APIKEY', 'AIzaSyBBObDQC61Jg-qFH5bqPT0BSwAFtH-oxlw');
define('PRODUCT_CATEGORY_CLEANSES', 'cleanses');


define('JUICES_CATEGORY_ID', 1);
define('ALMONDMILK_CATEGORY_ID', 2);
define('CLEANSES_CATEGORY_ID', 3);
define('VALUEPACKS_CATEGORY_ID', 4);
define('SUBSCRIPTIONS_CATEGORY_ID', 5);
define('PROTEINMILKSHAKE_CATEGORY_ID', 6);

$categoryArr[JUICES_CATEGORY_ID] = 'juices';
$categoryArr[ALMONDMILK_CATEGORY_ID] = 'almond-milks';
$categoryArr[CLEANSES_CATEGORY_ID] = 'cleanses';
$categoryArr[VALUEPACKS_CATEGORY_ID] = 'value-packs';
$categoryArr[SUBSCRIPTIONS_CATEGORY_ID] = 'subscriptions';
$categoryArr[PROTEINMILKSHAKE_CATEGORY_ID] = 'protein-milkshake';

define("CATEGORYARR", serialize($categoryArr));


define('PRODUCT_CATEGORY_JUICES', 'juices');
define('PRODUCT_CATEGORY_ALMOND_MILK', 'almond milk');
define('PRODUCT_CATEGORY_VALUE_PACKS', 'value packs');
define('PRODUCT_CATEGORY_SUBSCRIPTIONS', 'subscriptions');
define('FIVE_STAR', 5);

define('FACEBOOK_APP_ID', '509395906620508');
define('FACEBOOK_APP_SECRET', '6dfecb5dab2c1558699d44aa085fc450');
define('FACEBOOK_REDIRECT_URL', BASE_URL . '/facebook/response');

//define('GOOGLE_CLIENT_ID', '1014715178994-r5bm1a0h3no2u2ncvfktvpqrdgft03d8.apps.googleusercontent.com');
//define('GOOGLE_CLIENT_SECRET', 'G96Hy4objkDDXU8kvdtKMYOU');
define('GOOGLE_CLIENT_ID', '1095902328317-mmr56036c8k585srmrmnffes1p23efkp.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'EbFBRovq-WtKHc8qjbIZ3qtC');
define('GOOGLE_REDIRECT_URL', BASE_URL . '/google/response');

define('TABLE_CART', 'cart');
define('TABLE_CART_ITEM', 'cart_item');

define('MIN_AMOUNT_FOR_PLACE_ORDER', 299);
define('DELIVERY_DATE', date('Y-m-d', strtotime("+8 days")));

define('CFURL', 'https://test.cashfree.com/billpay/checkout/post/submit');
define('CF_APP_ID', '24411b100cbd4fca9fc4d2ce1442');
define('CF_SECRET_KEY', '5e2095da390f3b8bde4d42dfadaf9730af08d4c1');

define('FROM_EMAIL', 'getmore@rawpressery.com');
define('FROM_NAME', 'Rawpressery - Sales');
define('EMAIL_API_URL', 'https://api.pepipost.com/v2/sendEmail');
define('EMAIL_API_KEY', '5b98b0b2687056ee6af430d2e4f807b5');

define('OTP_TXT', '<otp> is your one-time password (OTP) to your Raw Pressery account.');

define('RAWTALK_AMOUNT',199);
define('RAWTALK_CAMPAIGN','YOGARISE');
define('TABLE_CAMPAIGN_REGISTRATION','campaign_registration');
define('DEFAULT_CITY_ID','1');
define('RAWTALK_HEADER','#YOGARISE WITH SAMIKSHA SHETTY');

define("API_AUTHTOKEN_SOURCE_ALLOWED",serialize(array("rpcrm")));
define("API_AUTHTOKEN_KEY","rbpl@2K13");
