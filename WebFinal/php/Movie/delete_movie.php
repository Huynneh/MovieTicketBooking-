<?php
include("../Roles/Connection.php");
session_start();
if (isset($_SESSION["admin"])) {
    if (isset($_POST["maSp"])) {
        $arr = json_decode(stripslashes($_POST['maSp']));
        for ($i=0; $i < count($arr); $i++) { 
            $item = $arr[$i];
            if(mysqli_num_rows($conn->query("SELECT * FROM movie WHERE id_movie = '$item'")) > 0){
                if($conn -> query("DELETE FROM movie WHERE id_movie = '$item'") === TRUE){
                }
            }else{
                echo "This movie" . $item ."not exist in system";
            }
        }
    }
} else {
    echo "Access Diened!";
}
