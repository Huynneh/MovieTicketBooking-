<?php

error_reporting(0);
session_start();
include("Connection.php");
$fullName = $_POST["name"];
$pass = $_POST["password"];
$email = $_POST["email"];
$address = $_POST["address"];
// $phone = (!isset($_POST["phone"]))?"":$_POST["phone"];
$phone = $_POST["phone"];
$birthday = date('Y-m-d', strtotime($_POST['birthday']));

// Check Email Existed
if (mysqli_num_rows($conn->query("SELECT * FROM customer WHERE email = '$email'")) == 0) {
    // NOT Exist
    include("../lib.php");
    $hash = md5(random_str(6));
    $id = "ct" . $phone;
    $sql = "INSERT INTO customer(id_customer,customer_name,customer_address,birtday,email ,phone, password, hashCode, Active) VALUES('$id','$fullName', '$address', '$birthday', '$email','$phone', '$pass', '$hash', '0')";
    if ($conn->query($sql) === true) {
        $str =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $str = substr("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", 0, strrpos($str, "/")) . "/VerifyEmail.php?";
        $body = '
        <div style="padding-top : 5vh ;height : 85vh; padding-bottom : 5vh ;background-color:rgb(70,110,229)">
            <div
                style="
                    width:50%; height:75vh; 
                    margin:auto;
                    background-color:white;
                    border-radius: 5px;text-align: center;
                    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
                    -webkit-box-shadow:rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
                    <img src="https://cdn.sforum.vn/sforum/wp-content/uploads/2018/11/2-10.png"
                        width="200px" style="margin-top: 5vh">
                        <h3> <b>Verify Your email address</b> </h3>
                        <p>You " ve entered <b>' . $email . '</b> as the email address for your account </p>
                        <p>Please Verify this email address by clicking button below</p>
                        <a href="'. $str . 'email=' . $email . '&hash=' . $hash . '" style="background-color: rgb(0,128,255); border: none; color: white; border-radius : 5px;
                            padding: 15px 32px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 4px 2px;
                            cursor: pointer; margin-top: 5vh;">Verify your email</a>
                            <p> Or click this link to activate your account:</p>
                            <p>'. $str .'email=' . $email . '&hash=' . $hash . '</p>
                </div>
            </div>
        ';
        $subject = "Signup | Verification";
        if (send($email,  $subject, $body) == true) {
            echo "Send Message successfully";
            header("Location: ../../Login/login.html?messRegis=True");
        }
    } else {
        echo "something error for Insert!";
    }
} else {
    // Exist
    echo "Sorry but this Email Already Registered!";
}
