<?php

$mysqli = new mysqli("172.31.28.246", "beta", "ahgheeGhiph0eejoif7K", "beta");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$delivery_location = trim(mysqli_real_escape_string($mysqli, $_POST['delivery_location']));
$order_for = trim(mysqli_real_escape_string($mysqli, $_POST['order_for']));
$no_of_bottles = trim(mysqli_real_escape_string($mysqli, $_POST['no_of_bottles']));
$delivery_on = trim(mysqli_real_escape_string($mysqli, $_POST['delivery_on']));
$full_name = trim(mysqli_real_escape_string($mysqli, $_POST['full_name']));
$mobile_number = trim(mysqli_real_escape_string($mysqli, $_POST['mobile_number']));
$email = trim(mysqli_real_escape_string($mysqli, $_POST['email']));
$postal_code = trim(mysqli_real_escape_string($mysqli, $_POST['postal_code']));

$option_for_arr = array("wedding" => 'Wedding',
    'corporateEventsGifting' => 'Corporate Events & Gifting',
    'celebrations' => 'Celebrations');


$insertQry = "INSERT INTO bulk_order (delivery_location, order_for, no_of_bottles, delivery_on ,full_name, mobile_number, email, pincode) Values ('$delivery_location','$order_for','$no_of_bottles','$delivery_on','$full_name','$mobile_number','$email','$postal_code')";

if (mysqli_query($mysqli, $insertQry)) {
    $returnArr['status'] = 'success';
    $returnArr['msg'] = '<i class="fas fa-check-circle"></i> Your request has been submitted successfully!  We will get back to you soon.';
    
    $message = '<h1>Order No - ' . $mysqli->insert_id . '</h1>';
    $message .= "<h2>Name: $full_name</h2>";
    $message .= "<h2>Mobile Number: $mobile_number</h2>";
    $message .= "<h2>Email: $email</h2>";
    $message .= "<h2>No of bottles: $no_of_bottles</h2>";
    $message .= "<h2>Order for: $option_for_arr[$order_for]</h2>";
    $message .= "<h2>Delivery Location: $delivery_location</h2>";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.pepipost.com/v2/sendEmail",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"personalizations\":[{\"recipient\":\"getmore@rawpressery.com\"}],\"from\":{\"fromEmail\":\"getmore@rawpressery.com\",\"fromName\":\"Rawpressery - Bulk Order\"},\"subject\":\"Bulk Order Details\",\"content\":\"$message\"}",
        CURLOPT_HTTPHEADER => array(
            "api_key: 5b98b0b2687056ee6af430d2e4f807b5",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
} else {
    $returnArr['status'] = 'failed';
    $returnArr['msg'] = 'Your request can not processed this time.';
}

echo json_encode($returnArr);
