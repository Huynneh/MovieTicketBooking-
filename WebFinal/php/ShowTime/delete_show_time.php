<?php
include("../Roles/Connection.php");
session_start();
if (isset($_SESSION["admin"])) {
    if (isset($_POST["maSp"])) {
        $arr = json_decode(stripslashes($_POST['maSp']));
        for ($i = 0; $i < count($arr); $i++) {
            $item = $arr[$i];
            if (mysqli_num_rows($conn->query("SELECT * FROM show_time WHERE id_show_time = '$item'")) > 0) {
                if ($conn->query("DELETE FROM show_time WHERE id_show_time = '$item'") === TRUE) {
                }
            } else {
                echo "This show time" . $item . "not exist in system";
            }
        }
    }
} else {
    echo "Access Diened!";
}
