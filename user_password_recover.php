<?php

session_start();
include_once("admin/class/adminback.php");
$obj = new adminback();

$cata_info = $obj->p_display_catagory();
$cataDatas = array();
while ($data = mysqli_fetch_assoc($cata_info)) {
    $cataDatas[] = $data;
}

if (isset($_SESSION['user_id'])) {
    header("location:userprofile.php");
}


if (isset($_POST['u_pass_recover'])) {
    $recover_email = $_POST['recover_email'];
    $rec_row = $obj->user_password_recover($recover_email);

    $num_row = mysqli_num_rows($rec_row);
    $rec_msg = "";

    if ($num_row > 0) {
        $rec_result = mysqli_fetch_assoc($rec_row);

        $rec_id = $rec_result['user_id'];
        $rec_name = $rec_result['user_firstname'];
        $rec_email = $rec_result['user_email'];
        $rec_pass = $rec_result['user_password'];

        $to_email = $rec_email;
        $subject = "Khôi phục mật khẩu từ Fruits Bazar";
        $body = "Kính gửi {$rec_name}".PHP_EOL. "Vui lòng truy cập vào liên kết này để đặt lại mật khẩu của bạn: http://localhost/projects/Fruits_bazar_ecommerce_project/user_password_update.php?status=update&&id={$rec_id}".PHP_EOL."Cảm ơn bạn";
        $headers = "From: graphicsapon@gmail.com";

        if (mail($to_email, $subject, $body, $headers)) {
            $rec_msg= "Vui lòng kiểm tra email của bạn để đặt lại mật khẩu";
        } else {
            $rec_msg = "Gửi email thất bại...";
        }

    } else {
        $rec_msg = "Xin lỗi, bạn không có tài khoản";
    }
}
?>

<?php
include_once("includes/head.php");
?>

<body class="biolife-body">
    <!-- Preloader -->

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">

        <?php
        include_once("includes/header_top.php");
        ?>

        <?php
        include_once("includes/header_middle.php");
        ?>

        <?php
        include_once("includes/header_bottom.php");
        ?>

    </header>

    <!-- Nội dung trang -->
    <div class="page-contain">

        <!-- Nội dung chính -->
        <div id="main-content" class="main-content">

            <div class="container">
                <h2 class="text-center">Khôi phục mật khẩu</h2>

                <h4 class="text-danger"> <?php
                                            if (isset($rec_msg )) {
                                                echo $rec_msg ;
                                            }
                                            ?></h4>
                <div class="row">

                    <!-- Form đăng nhập -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="" name="frm-login" method="post">
                                <p class="form-row">
                                    <label for="email">Email</label>
                                    <input type="email" id="fid-name" name="recover_email" class="txt-input">
                                </p>

                                <p class="wrap-btn">
                                    <input type="submit" value="Khôi phục mật khẩu" name="u_pass_recover" class="btn btn-success">

                                </p>
                            </form>
                        </div>
                    </div>

                    <!-- Chuyển đến form đăng ký -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">Khách hàng mới?</h4>
                                <p class="sub-title">Tạo tài khoản với chúng tôi và bạn sẽ có thể:</p>
                                <ul class="lis">
                                    <li>Mua sắm nhanh hơn</li>
                                    <li>Lưu nhiều địa chỉ giao hàng</li>
                                    <li>Truy cập lịch sử đơn hàng của bạn</li>
                                    <li>Theo dõi các đơn hàng mới</li>
                                    <li>Lưu các sản phẩm vào danh sách yêu thích</li>
                                </ul>
                                <a href="user_register.php" class="btn btn-bold">Tạo tài khoản</a>
                            </div>
                        </div>
              
