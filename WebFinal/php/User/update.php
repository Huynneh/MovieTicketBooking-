<?php
include("../Roles/Connection.php");
session_start();
if (isset($_SESSION["user"])) {
    $email_user = $_SESSION["user"];
    $Name = $_POST["Name"];
    $birthday = date('Y-m-d', strtotime($_POST['birthday']));
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $id_customer = "ct" . $phone;
    $sql = "UPDATE customer SET id_customer= '$id_customer', customer_name = '$Name', customer_address = '$address', birtday = '$birthday', phone = '$phone' WHERE email = '$email_user'";
    if($conn -> query($sql) === TRUE){
        header("Location: Thong_tin_ca_nhan.php");
    }else{
        echo "Fail Update";
    }

} else {
    echo "Access Denied";
}
