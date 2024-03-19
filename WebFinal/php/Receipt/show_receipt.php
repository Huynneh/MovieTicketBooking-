<?php
include("../Roles/Connection.php");
if (isset($_GET["getAll"])) {
    $result = $conn->query("SELECT * FROM receipt");
    if (mysqli_num_rows($result) > 0) {
        $rows =  mysqli_fetch_all($result);
        echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo "Not Found!";
    }
}
