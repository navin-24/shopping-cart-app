<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-27 13:04:15 --> Severity: error --> Exception: Call to a member function getPageMeta() on null C:\xampp\htdocs\rawpressery\web\app\controllers\Delivery.php 27
ERROR - 2020-10-27 14:04:52 --> Severity: error --> Exception: Call to a member function loginUrl() on null C:\xampp\htdocs\rawpressery\web\app\views\delivery.php 45
ERROR - 2020-10-27 18:05:04 --> Query error: Column 'mobile_number' cannot be null - Invalid query: INSERT INTO `otp_detail` (`otp_value`, `mobile_number`, `otp_type`, `status`, `expiry_time`, `created_at`) VALUES ('123456', NULL, '', 'sent', '2020-10-27 18:10:03', '2020-10-27 18:05:03pm')
ERROR - 2020-10-27 18:11:51 --> Query error: Unknown column 'is_active' in 'field list' - Invalid query: SELECT `name`, `is_active`, `mobile`
FROM `deliveryboy`
WHERE `mobile` = '7208202010'
ERROR - 2020-10-27 18:19:47 --> Query error: Unknown column 'is_active' in 'field list' - Invalid query: SELECT `name`, `is_active`, `mobile`
FROM `deliveryboy`
WHERE `mobile` = '7208202010'
ERROR - 2020-10-27 18:21:05 --> Query error: Unknown column 'is_active' in 'field list' - Invalid query: SELECT `name`, `is_active`, `mobile`
FROM `deliveryboy`
WHERE `mobile` = '7208202010'
ERROR - 2020-10-27 18:34:25 --> 404 Page Not Found: Delivery/sendOTP
ERROR - 2020-10-27 18:45:35 --> Query error: Unknown column 'is_active' in 'field list' - Invalid query: SELECT `name`, `is_active`, `mobile`
FROM `deliveryboy`
WHERE `mobile` = '7208202010'
ERROR - 2020-10-27 20:23:45 --> Severity: error --> Exception: Call to a member function checkMobileExistsOrNot() on null C:\xampp\htdocs\rawpressery\web\app\controllers\Delivery.php 195
