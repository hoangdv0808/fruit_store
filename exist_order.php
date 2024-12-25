<?php

session_start();

include_once("admin/class/adminback.php");
$obj = new adminback();

// Lấy thông tin danh mục sản phẩm
$cata_info = $obj->p_display_catagory();
$cataDatas = array();
while ($data = mysqli_fetch_assoc($cata_info)) {
    $cataDatas[] = $data;
}

// Nếu có yêu cầu đăng xuất
if (isset($_GET['logout'])) {
    if ($_GET['logout'] == "logout") {
        $obj->user_logout(); // Đăng xuất người dùng
    }
}

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    // Lấy thông tin đơn hàng của người dùng
    $order_query = $obj->order_details_by_id($id);
} else {
    header("location:user_login.php"); // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
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
                <div class="row">
                    <div class="col-md-2">
                        <h4>Chào bạn <?php
                                    if (isset($username)) {
                                        echo strtoupper($username);
                                    }
                                    ?></h4>
                        <a href="?logout=logout">Đăng xuất</a>
                    </div>

                    <div class="col-md-10">
                        <h2 class="text-center">Tổng quan đơn hàng</h2>

                        <!-- Bảng hiển thị thông tin đơn hàng -->
                        <table class="shop_table cart-form">
                            <thead>
                                <tr>
                                    <th class="product-name">Mã đơn hàng</th>
                                    <th class="product-price">Sản phẩm</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Tổng tiền</th>
                                    <th class="product-subtotal">Trạng thái đơn hàng</th>
                                    <th class="product-subtotal">Thời gian đặt</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while($order_info = mysqli_fetch_assoc($order_query)) {?>

                                <tr class="cart_item">
                                    <td class="product-thumbnail" data-title="Tên sản phẩm">
                                        <a class="prd-thumb" href="single_product.php?status=singleproduct&&id=<?php echo $order_info['order_id']  ?>">
                                        <div class="price price-contain">
                                            <span class="price-amount"><?php echo $order_info['order_id'] ?></span>
                                        </div>
                                        </a>
                                    </td>

                                    <td class="" data-title="Tên sản phẩm">
                                        <a href="single_product.php?status=singleproduct&&id=<?php echo $order_info['order_id']  ?>" style="text-decoration: none; color:black" >
                                        <div class="price price-contain">
                                            <h5 class="text-left" ><?php echo $order_info['product_name'] ?></h5>
                                        </div>
                                        </a>
                                    </td>

                                    <td class="product-subtotal" data-title="Tổng">
                                        <div class="price price-contain">
                                            <ins><span class="price-amount"><span class="currencySymbol"></span><?php echo $order_info['pdt_quantity'] ?></span></ins>
                                        </div>
                                    </td>
                                  
                                    <td class="product-subtotal" data-title="Tổng">
                                        <div class="price price-contain">
                                            <ins><span class="price-amount"><span class="currencySymbol"></span><?php echo $order_info['amount'] ?></span> VNĐ</ins>
                                        </div>
                                    </td>

                                    <td class="product-subtotal" data-title="Tổng">
                                        <div class="">
                                            <span class="price-amount ">
                                            <?php  
                                            if($order_info['order_status'] == 0){
                                                echo "<p class='btn btn-danger btn-sm'> Chờ xử lý </p>";
                                            } elseif($order_info['order_status'] == 1) {
                                                echo "<p class='btn btn-warning btn-sm'> Đang xử lý </p>";
                                            } elseif($order_info['order_status'] == 2) {
                                                echo "<p class='btn btn-success btn-sm'> Đã giao </p>";
                                            }    
                                            ?>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="product-subtotal" data-title="Tổng">
                                        <div class="price price-contain">
                                          <span class="price-amount"><?php echo $order_info['order_time'] ?></span>
                                        </div>
                                    </td>

                                </tr>

                               <?php }?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <br>

    <!-- FOOTER -->
    <?php
    include_once("includes/footer.php");
    ?>

    <!-- Footer cho di động -->
    <?php
    include_once("includes/mobile_footer.php");
    ?>

    <?php
    include_once("includes/mobile_global.php");
    ?>

    <!-- Nút cuộn lên đầu trang -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php
    include_once("includes/script.php");
    ?>
</body>

</html>
