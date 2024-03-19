<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAY Cinema | Hoa don</title>
    <link rel="icon" href="https://www.3playmedia.com/wp-content/uploads/4-16.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body onload="window.print();">
    <div class="container">
        <img src="../../images/banner2.jpg" alt="Poster-cinema" width="30%">
        <div class="text-center">
            <h2 class="m-3" style="color: rgb(255, 52, 52);">CHÚC MỪNG BẠN ĐÃ ĐẶT VÉ THÀNH CÔNG</h2>
        </div>

        <div class="row">
            <div class="col-7 m-auto">
                <div class="bg-danger">

                    <?php    
                        include ('../Roles/Connection.php');

                        if (!isset($_GET['start_time']) || !isset($_GET['id'])) {
                            die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
                        }

                        $time = $_GET['start_time'];
                        $id = $_GET['id'];

                        $sql = "SELECT ticket.pricce, movie.*, show_time.*, cinema.cinema_name, room.classify FROM ticket, movie_schedule, movie, cinema, room, show_time WHERE movie_schedule.id_movie = movie.id_movie AND movie_schedule.id_show_time = show_time.id_show_time AND movie_schedule.id_cinema = cinema.id_cinema AND room.id_room = movie_schedule.id_room AND show_time.start_time = '$time' AND movie.id_movie = '$id' AND ticket.classify = room.classify";
                        
                        $result = $conn->query($sql);
                        // $stmt->execute(array($time, $id));
                       
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                echo "<img src='".$row["poster"]."' alt='poster phim' width='100%'>
                                <h4 class='ten-phim mt-3 text-center'>".$row["movie_name"]."</h4>
                                <div class='row m-auto'>
                                    <div class='col-4 p-3'>
                                        <h6>Số lượng vé</h6>
                                        <p> vé</p>
                                    </div>
                                    <div class='col-4 p-3'>
                                        <h6>Ghế: </h6>
                                        <p>G1, G2, G3</p>
                                    </div>
                                    <div class='col-4 p-3'>
                                        <h6>Phòng</h6>
                                        <p>".$row["classify"]."</p>
                                    </div>
                                </div>
                                <div class='noi-dung row m-auto'>
                                    <div class='col-4 p-3'>
                                        <h6>Ngày</h6>
                                        <p>".$row["date"]."</p>
                                    </div>
                                    <div class='col-4 p-3'>
                                        <h6>Thời gian</h6>
                                        <p>".$row["start_time"]."</p>
                                    </div>
                                    <div class='col-4 p-3'>
                                        <h6>Rạp</h6>
                                        <p>".$row["cinema_name"]."</p>
                                    </div>
                                </div>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="text-center">
            <h4 class="m-3" style="color: rgb(255, 50, 50);">Chúc bạn có buổi xem phim vui vẻ</h4>
        </div>
</body>

</html>