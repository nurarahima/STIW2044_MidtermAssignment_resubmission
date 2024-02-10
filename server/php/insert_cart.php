<?php
//error_reporting(0);

if (!isset($_POST['buyer_id'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$buyer_id = $_POST['buyer_id'];
$seller_id = $_POST['seller_id'];
$book_id = $_POST['book_id'];
$cart_qty = "1";
$cart_status = "New";
$book_price = $_POST['book_price'];

$sqlinsert = "INSERT INTO `tbl_carts`(`buyer_id`, `seller_id`, `book_id`, `cart_qty`, `cart_status`, `book_price`) VALUES ('$buyer_id','$seller_id','$book_id','$cart_qty','$cart_status',$book_price)";

if ($conn->query($sqlinsert) === TRUE) {
	$response = array('status' => 'success', 'data' => null);
    sendJsonResponse($response);
}else{
	$response = array('status' => 'failed', 'data' => null);
	sendJsonResponse($response);
}


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>