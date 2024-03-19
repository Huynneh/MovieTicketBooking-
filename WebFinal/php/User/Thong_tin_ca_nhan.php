<?php
include("../Roles/Connection.php");
session_start();
// Xu ly duong link co password
$url = (string)($_SERVER['REQUEST_URI']);
if (strpos($url, "?")) {
    header("Location: Thong_tin_ca_nhan.php");
}
if (!isset($_SESSION["user"])) {
    echo "Access Diened!";
    exit();
}

$email_user = $_SESSION["user"];
$result = mysqli_fetch_assoc($conn->query("SELECT * FROM customer WHERE email = '$email_user'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <title>HAY Cinema | Cá nhân</title>
    <link rel="icon" href="https://www.3playmedia.com/wp-content/uploads/4-16.png" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../home.css">

</head>

<body>
    <!-- banner -->
    <div class="container-fluid banner">
        <div class="row justify-content-between">
            <div class="col-md-4 col-sm-3 col-3">
                <picture>
                    <source media="(max-width: 768px)" srcset="../../images/banner1.jpg">
                    <img style="cursor: pointer;" class="logo-banner" src="../../images/banner2.jpg" alt="Banner Hay cinema" width="100%" height="100%" onclick="window.location.href = '../../home.html'">
                </picture>
            </div>

            <div class="col-8 m-auto">
                <div class="btn-group float-right">
                    <a href="../Roles/logout.php" type="button" class="btn rounded-0 ">
                        <button class="btn btn-warning" type="button"><i class="fas fa-sign-out-alt"></i> Đăng
                            xuất</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="mt-3">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#info-user" aria-selected="true">Thông tin người
                    dùng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#his-booking" aria-selected="false">Lịch sử giao dịch</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="info-user">
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-3">
                            <div class="card" style="width:100%">
                                <div class="card-header">
                                    <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/2922/2922506.png" alt="Card image" style="width:90%">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title text-center"></h4>
                                    <p class="text-center">Người dùng đặt vé xem phim</p>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="button" class="btn btn-primary border" data-toggle="modal" data-target="#modal-updateUser">Cập nhật thông tin</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card" style="width:100%">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <h6>Mã khách hàng</h6>
                                        </div>
                                        <div class="col-9 text-secondary maKH">
                                            <?php

                                            echo $result["id_customer"];
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6>Họ tên</h6>
                                        </div>
                                        <div class="col-9 text-secondary tenKH">
                                            <?php
                                            echo $result["customer_name"];
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6>Ngày Sinh</h6>
                                        </div>
                                        <div class="col-9 text-secondary ngaySinh">
                                            <?php
                                            echo $result["birtday"];
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6>Số điện thoại</h6>
                                        </div>
                                        <div class="col-9 text-secondary phone">
                                            <?php
                                            echo $result["phone"];
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6>Email</h6>
                                        </div>
                                        <div class="col-9 text-secondary email">
                                            <?php
                                            echo $result["email"];
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6>Địa chỉ</h6>
                                        </div>
                                        <div class="col-9 text-secondary address">
                                            <?php
                                            echo $result["customer_address"];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" style="width:100%">
                                <div class="card-header">
                                    <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/5359/5359937.png" alt="Card image" style="width: 90%">
                                </div>
                                <div class="card-body">

                                    <h4 class="card-title text-center">Đổi mật khẩu</h4>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="button" class="btn btn-primary border" data-toggle="modal" data-target="#modal-changeKey">Đổi mật khẩu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="his-booking">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="text-center">
                            <th>Rạp</th>
                            <th>Tên phim</th>
                            <th>Ngày chiếu</th>
                            <th>Suất chiếu</th>
                            <th>Số lượng vé</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $id = mysqli_fetch_assoc($conn->query("SELECT id_customer FROM customer WHERE email = '$email_user'"))["id_customer"];
                        $Sql = "
                            SELECT cinema.cinema_name, movie.movie_name, show_time.date, show_time.start_time, receipt.amount, receipt.total
                            FROM receipt
                            INNER JOIN movie ON movie.id_movie = receipt.id_movie
                            INNER JOIN ticket ON ticket.id_ticket = receipt.id_ticket
                            INNER JOIN movie_schedule ON ticket.id_movie_schedule = movie_schedule.id_movie_schedule
                            INNER JOIN cinema ON cinema.id_cinema = movie_schedule.id_cinema
                            INNER JOIN show_time ON show_time.id_show_time = movie_schedule.id_show_time
                            Where id_customer = '$id'
                            ";
                        $result = $conn->query($Sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                                    <tr>
                                        <td>$row[0]</td>
                                        <td>$row[1]</td>
                                        <td>$row[2]</td>
                                        <td>$row[3]</td>
                                        <td>$row[4]</td>
                                        <td>$row[5]</td>
                                    </tr>   
                                ";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal cap nhat thong tin nguoi dung-->
    <div class="modal fade" id="modal-updateUser" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <form action="update.php" method="post">
                    <div class="modal-header">
                        <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" alt="update" height="2%" width="20%">
                        <div class="m-auto">
                            <h3 class="modal-title ">Cập nhật thông tin</h3>
                        </div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="Name">Họ tên</label>
                            <input type="text" name="Name" id="Name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="birthday">Ngày sinh</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" class="btn btn-primary" value="Reset">Cancel</button>
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal doi mat khau-->
    <div class="modal fade" id="modal-changeKey" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body row">
                    <div class="col-5 border-right">
                        <img src="https://www.phishup.co/images/login.png" height="100%" width="100%" alt="change password">
                    </div>
                    <div class="col-7 m-auto">
                        <form>
                            <div class="m-auto">
                                <h2 class="modal-title text-center mb-3">Đổi mật khẩu</h2>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="pw_now">Mật khẩu hiện tại</label>
                                <input type="password" name="pw_now" id="pw_now" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="pw_new">Mật khẩu mới</label>
                                <input type="password" name="pw_new" id="pw_new" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="pw_new2">Xác nhận mật khẩu mới</label>
                                <input type="password" name="pw_new2" id="pw_new2" class="form-control">
                            </div>
                            <div style="float: right;">
                                <button type="reset" class="btn btn-primary" data-dismiss="modal" value="Reset">Cancel</button>
                                <button type="submit" class="btn btn-danger" onclick="savePass(this)">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function savePass(x) {
            if ($(".pw_now").val() == "") {
                // validation
                x.preventDefault();
            } else {
                $.ajax({
                    url: "changePass.php",
                    type: "POST",
                    data: {
                        pw_now: $("#pw_now").val(),
                        pw_new: $("#pw_new").val()
                    },
                    success: function(response) {
                        if (response === "success") {
                            alert("Change password success");
                        } else {
                            alert("Something error for Change password");
                        }
                    }
                });
            }
            location.reload();
        }
    </script>
    <footer class="flex-shrink-0 py-2 bg-dark text-white mt-3">
        <div class="container text-center">
            <p>Copyright &copy HAY cinema</p>
        </div>
    </footer>
</body>

</html>