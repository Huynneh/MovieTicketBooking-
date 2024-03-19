<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="jquery-3.6.1.min.js"></script>

    <title>HAY Cinema | Xem phim thả ga không lo deadline</title>
    <link rel="icon" href="https://www.3playmedia.com/wp-content/uploads/4-16.png" type="image/x-icon">

    <link rel="stylesheet" href="../../home.css">
</head>

<body>
    <!-- banner -->
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-4 col-sm-3 col-3">
                <picture>
                    <source media="(max-width: 768px)" srcset="images/banner1.jpg">
                    <img class="logo-banner" src="../../images/banner2.jpg" alt="Banner Hay cinema" width="100%"
                        height="100%" onclick="window.location.href = '../../home.html'">
                </picture>
            </div>

            <div class="input-group col-md-5 col-sm-5 col-3" style="display: inline;">
                <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Tìm tên phim, diễn viên...">
                </div>
            </div>

            <div class="col-md-3 col-sm-4 col-5">
                <a href="#" class="login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-person-add" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                        <path
                            d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                    </svg>
                    <p style="display: inline; vertical-align: bottom;">Đăng nhập</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Thanh navigation -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item item">
                    <a class="nav-link link-tab" href="#">MUA VÉ</a>
                </li>

                <li class="nav-item dropdown item">
                    <a class="nav-link dropdown-toggle link-tab" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">PHIM</a>
                    <div class="dropdown-menu bg-dark">
                        <a class="dropdown-item link-tab" href="#">Action</a>
                        <a class="dropdown-item link-tab" href="#">Another action</a>
                        <a class="dropdown-item link-tab" href="#">Something else here</a>
                        <div class="dropdown-divider link-tab"></div>
                        <a class="dropdown-item link-tab" href="#">Separated link</a>
                    </div>
                </li>

                <li class="nav-item item">
                    <a class="nav-link link-tab" href="#">GÓC ĐIỆN ẢNH</a>
                </li>

                <li class="nav-item item">
                    <a class="nav-link link-tab" href="#">SỰ KIÊN</a>
                </li>

                <li class="nav-item item">
                    <a class="nav-link link-tab" href="#">RẠP/GIÁ VÉ</a>
                </li>

                <li class="nav-item item">
                    <a class="nav-link link-tab" href="#">HỖ TRỢ</a>
                </li>

                <li class="nav-item item">
                    <a class="nav-link link-tab" href="#">THÀNH VIÊN</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Dat ve -->
    <div class="ml-5 mr-5 pl-5 pr-5 mt-3">
        <div class="row mt-3">
            <div class="col-8" style="height: 600px;">
                <div class="m-auto text-center bg-warning" style="height: 40px; width: 600px;">Màn hình</div>
                <div id="seat_built" class="m-auto pl-3" style="width: 700px; height: 450px;">
                    <?php
                        include ('../Roles/Connection.php');

                        if (!isset($_GET['start_time']) || !isset($_GET['id'])) {
                            die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
                        }
            
                        $time = $_GET['start_time'];
                        $id = $_GET['id'];

                        $sql = "SELECT seat.* FROM movie_schedule, movie, show_time, seat, room WHERE movie_schedule.id_movie = movie.id_movie AND movie_schedule.id_show_time = show_time.id_show_time AND movie_schedule.id_room = room.id_room AND seat.id_room = room.id_room AND show_time.start_time = '$time' AND movie.id_movie = '$id'";
                        
                        $result = $conn->query($sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<div class='row seat'>";
                                while ($row = mysqli_fetch_assoc($result))
                                {  
                                    if($row["status"] == "Đã đặt"){
                                        echo "<div class='column text-center mt-2' style='background-color: rgb(255, 0, 0);'>".$row["seat_name"]."</div>";
                                    }
                                    else{
                                        echo "<div class='column text-center mt-2' style='background-color: rgb(208, 210, 210);'>".$row["seat_name"]."</div>";
                                    }
                                }
                            echo "</div>";
                        }
                    ?>
                    
                    <!-- </div> -->
                </div>
                <div class="mt-5 row text-center">
                    <div class="col-4">
                        <div style="height: 40px; width: 40px; background-color: red; border-radius: 8px; margin: auto;"></div>
                        <p style="display: inline;">Ghế đã đặt</p>
                    </div>
                    <div class="col-4">
                        <div style="height: 40px; width: 40px; background-color: rgb(184, 184, 184); border-radius: 8px; margin: auto;"></div>
                        <div style="display: inline;">Ghế trống</div>
                    </div>
                    <div class="col-4">
                        <div style="height: 40px; width: 40px; background-color: rgb(121, 255, 152); border-radius: 8px; margin: auto;"></div>
                        <div style="display: inline;">Ghế bạn đang đặt</div>
                    </div>
                </div>
            </div>

        <?php

            if (!isset($_GET['start_time']) || !isset($_GET['id'])) {
                die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
            }

            $time = $_GET['start_time'];
            $id = $_GET['id'];

            $sql = "SELECT ticket.pricce, movie.*, show_time.*, cinema.cinema_name, room.classify FROM ticket, movie_schedule, movie, cinema, room, show_time WHERE movie_schedule.id_movie = movie.id_movie AND movie_schedule.id_show_time = show_time.id_show_time AND movie_schedule.id_cinema = cinema.id_cinema AND room.id_room = movie_schedule.id_room AND show_time.start_time = '$time' AND movie.id_movie = '$id' AND ticket.classify = room.classify";
            
            $stmt = $conn->query($sql);
            $count = mysqli_num_rows($stmt);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($stmt))
                {
                    echo "<div class='col-4 mb-3'>
                        <div class='card' style='background-color: rgb(221, 221, 221);'>
                            <img class='card-img-top' src='".$row["poster"]."'
                                alt='Decibel-Poster' style='width: 100%;'>
                            <div class='card-body'>
                            <h5>".$row["movie_name"]."</h5>
                            <p>Rạp: ".$row["cinema_name"]."</p>
                            <p>Suất chiếu: ".$row["start_time"]."</p>
                            <p id='select_seat'>Ghế: </p>
                            <p style='display:none;' id='price'>".$row["pricce"]."</p>
                            <p style='display:none;' id='classify'>".$row["classify"]."</p>
                            <p style='display:none;' id='date'>".$row["date"]."</p>
                            <p id='money' class='money'>Tổng tiền: </p>
                            <button onclick='back()' class='btn btn-warning' style='color: white;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-arrow-left' viewBox='0 0 16 16'>
                                    <path fill-rule='evenodd'
                                        d='M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z' />
                                </svg>
                                Quay lại
                            </button>
                            <button class='btn btn-danger' style='float: right;' data-toggle='modal' data-target='#modal-thanhtoan'>
                                Tiếp tục
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-arrow-right' viewBox='0 0 16 16'>
                                    <path fill-rule='evenodd'
                                        d='M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z' />
                                </svg>  
                            </button>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                
                <div class='modal fade' id='modal-thanhtoan'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4 class='modal-title m-auto'>Vui lòng thanh toán</h4>
                            </div>

                            <div class='modal-body'>
                                <div class='form-group mb-3'>
                                    <label class='form-label' for='type_Tt'>Hình thức thanh toán</label>
                                    <select name='type_Tt' id='type_Tt' class='form-control'>
                                        <option value='Momo'>Thanh toán bằng ví Momo</option>
                                        <option value='Zalopay'>Thanh toán bằng Zalopay</option>
                                        <option value='VNp'>Thanh toán bằng VNPay</option>
                                    </select>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button data-dismiss='modal' type='reset' class='btn btn-primary' value='Reset'>Cancel</button>
                                <a href='Hoa_don.php?start_time=".$row["start_time"]."&id=".$row["id_movie"]."' type='button' class='btn btn-danger' onclick='check()'>Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>";
                }
            }
        ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <footer class="flex-shrink-0 py-2 bg-dark text-white mt-3">
        <div class="container text-center">
            <p>Copyright &copy HAY cinema</p>
        </div>
    </footer>

    <script>
        var total = 0;
        var num = 0;
        $(document).ready(function () {
            $(".column").on("click", function() {
                var seat = $(this)[0];

                if(seat.style.backgroundColor === "rgb(255, 0, 0)"){
                    alert("Ghế đã được đặt! Vui lòng chọn ghế trống!!");
                }

                else if(seat.style.backgroundColor === "rgb(144, 236, 174)")
                {
                    $(this).css("background-color", "#D0D2D2");
                    document.getElementById("select_seat").innerText = document.getElementById("select_seat").innerText.replace(seat.innerText, "");
                    price = parseInt(document.getElementById("price").innerText);
                    total = total - price;
                    num = num - 1;
                    document.getElementById("money").innerText = "Tổng tiền: " +  (new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND',})).format(total);
                }
               
                else{
                    $(this).css("background-color", "#90ECAE");
                    document.getElementById("select_seat").innerText = document.getElementById("select_seat").innerText + " " + seat.innerText;
                    price = parseInt(document.getElementById("price").innerText);
                    total = total + price;
                    num = num + 1;
                    document.getElementById("money").innerText = "Tổng tiền: " +  (new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND',})).format(total);
                }
            });
        });

        function back(){
            history.back();
        }

        function check(){
            
        }
        check();
    </script>

    <style>
        #seat_built {
            display: flex;
            width: 600px;
            height: 320px;
        }

        .column {
            height: 40px;
            width: 40px;
            border-radius: 8px;
            margin: 2px;
        }

        .row {
            margin: 2px;
        }
    </style>
</body>

</html>
