<?php
include("../Roles/Connection.php");
session_start();
if (isset($_SESSION["admin"])) {
    $id_movie = "PM0001";
    if (mysqli_num_rows($conn->query("SELECT id_movie FROM movie ORDER BY id_movie DESC LIMIT 1 OFFSET 0")) > 0) {
        $temp = mysqli_fetch_assoc($conn->query("SELECT id_movie FROM movie ORDER BY id_movie DESC LIMIT 1 OFFSET 0"))["id_movie"];
        $id_movie = substr($temp, 0, 2) . (((int) substr($temp, 2)) + 1);
    }
    $path_Folder_Uploads = "../../Uploads/";
    $file_path = $path_Folder_Uploads .  $_FILES["posterIMG"]["name"];
    $imageFileType = pathinfo($file_path, PATHINFO_EXTENSION);
    if($imageFileType != "jpg" && $imageFileType != "png"){
        echo "System only accept img and png file!";
        exit();
    }
    if(file_exists($file_path)){
        echo "Already Exitst file here!";
        exit();
    }
    $movie_name = $_POST["movieName"];
    $directors = $_POST["director"];
    $producer = $_POST["producer"];
    $quocGia = $_POST["nation"];
    $cast = $_POST["actor"];
    $openingday = date('Y-m-d', strtotime($_POST['day'])); //
    $duration = $_POST["time"];
    $genre = $_POST["Category"];
    $description = $_POST["summary"];
    // $poster = $_POST["posterIMG"]; // file
    $trailer = $_POST["Trailer"];
    // echo $id_movie, $movie_name, $directors, $producer, $cast, $openingday, $duration, $genre, $description, $_FILES["posterIMG"]["name"], $trailer;
    if(move_uploaded_file($_FILES["posterIMG"]["tmp_name"], $file_path)){  
        $file_path_db = "Uploads/" . $_FILES["posterIMG"]["name"];
        $sql = "INSERT INTO movie(id_movie ,movie_name , directors, producer, quocGia, cast, openingday, duration, genre, description, poster, trailer) VALUES('$id_movie', '$movie_name', '$directors', '$producer', '$quocGia', '$cast', '$openingday', '$duration', '$genre', '$description', '$file_path_db', '$trailer')";
        if($conn->query($sql) === TRUE){
            echo "Add Items Success";
            header("Location: ../../Giaodien/Main_manage.html");
        }
        echo "Something Error! Please send us an error let we check that";
    }else{
        echo "Error when upload image";
    }
    
} else {
    echo "Access Denied";
}
