<?php
    include("../Roles/Connection.php");
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        $sql = "SELECT * FROM movie Where movie_name LIKE '%$name%'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $rows =  mysqli_fetch_all($result);
            echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo "Not Found!";
        }
    }else if(isset($_GET["getAll"])){
        $result = $conn->query("SELECT * FROM movie");
        if (mysqli_num_rows($result) > 0) {
            $rows =  mysqli_fetch_all($result);
            echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo "Not Found!";
        }
    }
    
?>