<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
session_start();
include("Roles/Connection.php");
// Get current ID
function getCurrentId($tableName)
{
    include("Roles/Connection.php");
    $lastId = $conn->query("SELECT id FROM '$tableName' ORDER BY id DESC limit 1, 0");
    $chars = substr($string,0,2);
    $number = (int)substr(2,strlen($lastId));

    return $str;
}
// Random String
function random_str($digit)
{
    $str = "";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $digit; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}
// SEND Mail
function send($email, $Subject, $body){ 
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP(); // gửi mail SMTP
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'web.hungnguyen100802@gmail.com'; // SMTP username
    $mail->Password = 'cqrttkdzrmkwebno';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->From = "web.hungnguyen100802@gmail.com";
    $mail->FromName = "WebSite Bán vé xem phim";

    $mail->addAddress($email);

    $mail->isHTML(true);   // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body = $body;
    try {
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    exit();
}
