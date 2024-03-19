<?php
include("../Roles/Connection.php");
session_start();
if (isset($_SESSION["admin"])) {
    $id_show_time = "ST0001";
    if (mysqli_num_rows($conn->query("SELECT id_show_time FROM show_time ORDER BY id_show_time DESC LIMIT 1 OFFSET 0")) > 0) {
        $temp = mysqli_fetch_assoc($conn->query("SELECT id_show_time FROM show_time ORDER BY id_show_time DESC LIMIT 1 OFFSET 0"))["id_show_time"];
        $id_show_time = substr($temp, 0, 2) . (((int) substr($temp, 2)) + 1);
    }
    $date_show_time = date('Y-m-d', strtotime($_POST['day-show']));
    $time = $_POST["time-show"];
    // echo $id_movie, $movie_name, $directors, $producer, $cast, $openingday, $duration, $genre, $description, $_FILES["posterIMG"]["name"], $trailer;
    $sql = "INSERT INTO show_time VALUES('$id_show_time', '$date_show_time', '$time')";
    if ($conn->query($sql) === TRUE) {
        echo "Add Items Success";
        header("Location: ../../Giaodien/Main_manage.html");
    } else {
        echo "Something Error! Please send us an error let we check that";
    }
} else {
    echo "Access Denied";
}
