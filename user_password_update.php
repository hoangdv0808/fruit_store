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

if(isset($_GET['status'])){
    if($_GET['status']='update'){
        $update_id = $_GET['id'];
}}

if(isset($_POST['u_pass_recover'])){
    $update_msg = $obj->update_user_password($_POST);
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
                <h2 class="text-center">Cập nhật mật khẩu</h2>

                <h4 class="text-danger"> <?php
                                            if (isset($update_msg )) {
                                                echo $update_msg ;
                                            }
                                            ?></h4>
                <div class="row">

                    <!-- Form đăng nhập -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="" name="frm-login" method="POST">

                            <input type="hidden" name="update_user_id" value="<?php echo $update_id ?>">
                               
                                <p class="form-row">
                                    <label for="user_password">Mật khẩu mới:</label>
                                    <input type="password" name="update_user_password" class="txt-input">
                                </p>

                                <p class="wrap-btn">
                                    <input type="submit" value="Cập nhật mật khẩu" name="u_pass_recover" class="btn btn-success">

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
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- FOOTER -->

    <?php
    include_once("includes/footer.php");
    ?>

    <!-- Footer cho di động -->
    <?php
    include_once("includes/mobile_footer.php");
    ?>

    <?php
    include_once("includes/mobile_global.php")
    ?>


    <!-- Nút cuộn lên đầu trang -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php
    include_once("includes/script.php")
    ?>
</body>

</html>
