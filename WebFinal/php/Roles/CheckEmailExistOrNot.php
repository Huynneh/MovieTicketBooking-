<?php
    include("Connection.php");
    $email = $_POST["email"];
    if(mysqli_num_rows($conn->query("SELECT * FROM customer WHERE email = '$email'")) > 0){
        echo "Exist";
    }else{
        echo "No";
    }
?>