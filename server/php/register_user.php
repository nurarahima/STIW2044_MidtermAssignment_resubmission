<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "/home4/slumber6/PHPMailer/src/Exception.php";
require "/home4/slumber6/PHPMailer/src/PHPMailer.php";
require "/home4/slumber6/PHPMailer/src/SMTP.php";


//error_reporting(0);
if (!isset($_POST['email']) && !isset($_POST['name']) && !isset($_POST['password'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = sha1($_POST['password']);
$address = addslashes($_POST['address']);
$buyer = "Buyer";
$otp = rand(10000,99999);
$sqlinsert = "INSERT INTO `tbl_users`(`user_email`, `user_name`, `user_phone`, `user_password`, `user_address`,`user_type`) VALUES ('$email','$name','$phone','$password', '$address', '$buyer')";


if ($conn->query($sqlinsert) === TRUE) {
    testSendMail($email,$name,$otp);
	$response = array('status' => 'success', 'data' => $sqlinsert);
    sendJsonResponse($response);
}else{
	$response = array('status' => 'failed', 'data' => $sqlinsert);
	sendJsonResponse($response);
}


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

function testSendMail($email, $name,$otp){
    $subject = "Use this OTP for verification";
    $body = "Your OTP is $otp <br><br><a href='https://slumberjer.com/bookbytes/php/verify.php?otp=$otp'>Click Here</a>";
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = "mail.slumberjer.com"; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = "bookbyte_admin@slumberjer.com"; //SMTP username
        $mail->Password = "8GHVIAt(O^9Q"; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(
            "bookbyte_admin@slumberjer.com",
            "BookBytes mail notification"
        );
        $mail->addAddress($email, $name); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>