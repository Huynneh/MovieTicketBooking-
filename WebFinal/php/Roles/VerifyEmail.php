<?php
include("Connection.php");
if (isset($_GET["email"]) && !empty($_GET["email"]) && isset($_GET["hash"]) && !empty($_GET["hash"])) {
    $email = $_GET["email"];
    $hash = $_GET["hash"];
    $sql = "SELECT * FROM customer Where email = '$email' AND hashCode = '$hash'";
    if (mysqli_num_rows($conn->query($sql)) > 0) {
        $conn->query("Update customer SET Active = 1 where email='$email'");
        echo "<h1>Active success! <a href ='../../home.html'>Please click here to Login</a></h1>";
    } else {
        echo "Something Error here! Please Send me error.";
    }
} else {
    echo "Permisson Denied!";
}
