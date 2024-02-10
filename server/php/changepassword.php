<?php
if (!isset($_POST['email']) && !isset($_POST['new_password'])) {
    $response = array('status' => 'failed', 'message' => 'Invalid parameters');
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$email = $_POST['email'];
$newPassword = sha1($_POST['new_password']);

$sqlUpdatePassword = "UPDATE `tbl_users` SET `user_password` = '$newPassword' WHERE `user_email` = '$email'";

if ($conn->query($sqlUpdatePassword) === TRUE) {
    $response = array('status' => 'success', 'message' => 'Password updated successfully');
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'message' => 'Password update failed');
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>
