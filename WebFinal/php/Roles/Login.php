<?php
session_start();
include("Connection.php");
$email =  $_POST['email'];
$pass =  $_POST['password'];
// check admin or user
$result =  $conn->query("SELECT email From customer where email = '$email'");
if (mysqli_num_rows($result) > 0) {
    // User
    if (mysqli_num_rows($conn->query("SELECT * FROM customer WHERE email = '$email' AND password = '$pass'")) > 0) {
        //Valid
        // Check active or not
        if (mysqli_num_rows($conn->query("SELECT * FROM customer WHERE email = '$email' AND password = '$pass' AND Active = 0")) > 0) {
            // doesn't active
            echo "This account doesn't avtive. Please go to your email to verify";
        } else {
            $_SESSION["user"] = $email;
            // header("Location: ../../home.html");
            echo "user success";
            exit();
        }
    } else {
        //Invalid
        echo "Wrong Password!";
    }
}
else{
    
    // admin
    // Check to know this admin exist or not
    if (mysqli_num_rows($conn->query("SELECT * FROM admin WHERE email = '$email'")) > 0) { // Exist
        // Check password
        if (mysqli_num_rows($conn->query("SELECT * FROM admin WHERE email = '$email' AND password = '$pass'")) > 0) {
            //Valid
            $_SESSION["admin"] = $email;
            // header("Location: ../../Giaodien/Main_manage.html");
            echo "admin success";
        } else {
            //Invalid
            echo "Wrong Password!";
        }
        exit();
    } else {
        // sai tai khoan
        echo "This Account doesn't exist!";
        exit();
    }
} 
