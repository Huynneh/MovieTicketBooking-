<?php
include("../Roles/Connection.php");
session_start();
if (isset($_SESSION["user"])) {
    $email_user = $_SESSION["user"];
    $pw_now = $_POST["pw_now"];
    $pw_new = $_POST["pw_new"];
    if (mysqli_num_rows($conn->query("SELECT * FROM customer WHERE password = '$pw_now' AND email = '$email_user'")) > 0) {
        $sql = "UPDATE customer SET password = '$pw_new' WHERE email = '$email_user'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Fail to reset password";
        }
    }
} else {
    if (isset($_POST["forgot_pass"])) {
        include("../lib.php");
        $email = $_POST["email"];
        $password = random_str(6);
        $subject = "Forgot Password | Recovery";
        if($conn->query("UPDATE customer SET password = '$password' WHERE email = '$email'") === TRUE){
            $body  = '
            <div style="padding-top : 5vh ;height : 85vh; padding-bottom : 5vh ;background-color:rgb(70,110,229)">
                <div
                    style="
                        width:50%; height:75vh; 
                        margin:auto;
                        text-align:center;
                        background-color:white;
                        border-radius: 5px;text-align: center;
                        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
                        -webkit-box-shadow:rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
                        <img src="https://cdn.sforum.vn/sforum/wp-content/uploads/2018/11/2-10.png"
                            width="200px" style="margin-top: 5vh"> <br>
                            Thanks for recovery Password! <br>
                            Your password account has been changed, you can login with the account below<br>
                            New Password: <b>' . $password . '</b><br>
                            <b style="color:red">Please Change Password to Protect you account!</b> <br>
                            Click this link to visit our Website:
                            http://localhost/WebFinal
                    </div>
                </div>
            ';
            if(send($email, $subject, $body)){
                header("Location: ../../Login/login.html?Forgot=true");
            }else{
                echo "Send error";
            }
        }else{
            echo "Fail to change Password";
        }
    } else {
        echo "Access Denied";
    }
}
