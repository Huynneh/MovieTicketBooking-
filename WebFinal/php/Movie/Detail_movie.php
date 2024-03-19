<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <!-- Font Awesome CSS -->
    <link rel="icon" href="https://www.3playmedia.com/wp-content/uploads/4-16.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../home.css">

    <title>HAY Cinema | Xem phim thả ga không lo deadline</title>

    <link rel="stylesheet" href="../../home.css">
</head>

<body>
    <!-- banner -->
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-4 col-sm-3 col-3">
                <picture>
                    <source media="(max-width: 768px)" srcset="../../images/banner1.jpg">
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
                <a href="../../Login/login.html" class="login d-none" id="login">
                    <i class="bi bi-person-add" style="font-size: 22px;"></i>
                    <p style="display: inline;">Đăng nhập</p>
                </a>

                <a href="../Roles/logout.php" id="logout" class="d-none logout">
                    <i class="bi bi-door-closed-fill" style="font-size: 22px;text-align: right;"></i>
                    <p style="display: inline;">Đăng xuất</p>
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
    <!-- Noi dung chi tiet phim -->
    <?php
        include('../Roles/Connection.php');

        if (!isset($_GET['id_movie']) ) {
            die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
        }

        $id = $_GET['id_movie'];
        $sql = "SELECT * FROM movie WHERE id_movie = '$id'";
        $sql1 = "SELECT movie.*, room.classify, show_time.start_time FROM `movie_schedule`,`movie`,show_time, room WHERE movie_schedule.id_movie = movie.id_movie AND movie.id_movie = '$id' AND show_time.id_show_time = movie_schedule.id_show_time AND movie_schedule.id_room = room.id_room";
        $sql2 = "SELECT movie.*, room.classify, show_time.start_time FROM `movie_schedule`,`movie`,show_time, room WHERE movie_schedule.id_movie = movie.id_movie AND movie.id_movie = '$id' AND show_time.id_show_time = movie_schedule.id_show_time AND movie_schedule.id_room = room.id_room";
        
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<div class='details-movie'>
                    <div class='container mt-3'>
                        <div class='row'>
                            <div class='col-4'>
                                <div class='poster m-4'>
                                    <img src='".$row["poster"]."' alt='Decibel-Poster'
                                        style='height: 100%; width: 100%;'>
                                </div>
                            </div>
                            <div class='col-8 m-auto' style='color: aliceblue;'>
                                <div class='content m-4'>
                                <h2 class='mb-5'>".$row["movie_name"]."</h2>
                                <p>Đạo diễn: ".$row["directors"]."</p>
                                <p>Nhà sản xuất: ".$row["producer"]."</p>
                                <p>Thể loại: ".$row["genre"]."</p>
                                <p>Diễn viên: ".$row["cast"]." </p>
                                <p>Ngày khởi chiếu: ".$row["openingday"]."</p>
                                    <div class='mt-5'>
                                        <button type='button' class='btn btn-warning mr-3'>Xem trailer</button>
                                        <button type='button' class='btn btn-danger'>Đặt vé xem phim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='mt-3 container'>
                    <h4>NỘI DUNG PHIM</h4>
                    <P>".$row["description"]."</P>
                    <p>Phim mới ".$row["movie_name"].", ra mắt tại các rạp chiếu phim từ ".$row["openingday"]."</p>
                    <h4>TRAILER PHIM</h4>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <div id='headerPopup' class='mfp-hide embed-responsive embed-responsive-21by9'>
                                <iframe width='560' height='315' src='".$row["trailer"]."'
                                    title='YouTube video player' frameborder='0'
                                    allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        }

        $stmt1 = $conn->query($sql1);
        $count1 = mysqli_num_rows($stmt1);

        echo "<div class='container mt-3'>
                    <h4 class='mt-3 mb-3'>LỊCH CHIẾU</h4>
                    <div class='col-10 m-auto'>
                                <div class='card'>
                                    <div class='card-body' style='background-color: rgba(237, 237, 237, 0.823);'>
                                        <h5 class='card-title'>
                                            HAY Nguyễn Du
                                        </h5>
                                        <hr>
                                        <div>
                                        <p>Phòng chiếu 2D</p>";
        if ($count1 > 0) {
            
            while ($row1 = mysqli_fetch_assoc($stmt1))
            {
                if($row1["classify"] == "2d"){
                    echo "<a href='../User/Dat_ve.php?id_ticket=1&start_time=".$row1["start_time"]."&id=".$row1["id_movie"]."' class='btn btn-light mr-3 ' style='background-color: white;'>".$row1["start_time"]."</a>";
                }
            };
        }

        $stmt2 = $conn->query($sql2);
        $count2 = mysqli_num_rows($stmt2);
        echo "</div>
                    <div class='mt-3'>
                    <p>Phòng chiếu 3D</p>";
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($stmt2))
            {
                if($row2["classify"] == "3d"){
                    echo "<a href='../User/Dat_ve.php?id_ticket=2&start_time=".$row2["start_time"]."&id=".$row2["id_movie"]."' class='btn btn-light mr-3 ' style='background-color: white;'>".$row2["start_time"]."</a>";
                }
            }
        }

        echo "          </div>
                        </div>
                    </div>
                </div>
            </div>";

    ?>

    <footer class="flex-shrink-0 py-2 bg-dark text-white mt-3 w-100%">
        <div class="text-center">
            <p>Copyright &copy HAY cinema</p>
        </div>
    </footer>
<script>
    $.ajax({
            url: "../Roles/Status_Roles.php",
            type: "GET",
            success: function (response) {
                if (response === "None") {
                    document.getElementById("login").classList.remove("d-none");
                    if (!document.getElementById("logout").classList.contains("d-none")) {
                        document.getElementById("logout").classList.add("d-none");
                    }
                } else {
                    if (!document.getElementById("login").classList.contains("d-none")) {
                        document.getElementById("login").classList.add("d-none");
                    }
                    document.getElementById("logout").classList.remove("d-none");
                }
            }
        });
</script>
</body>

<style>
    .details-movie {
        background-image:
            linear-gradient(rgba(0, 0, 0, 0.789),
                rgba(0, 0, 0, 0.755)),
            url("../../images/b2.png");

    }
</style>

</html>
