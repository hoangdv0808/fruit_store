<?php

session_start();
include_once("admin/class/adminback.php");
$obj = new adminback();

// Lấy danh mục sản phẩm
$cata_info = $obj->p_display_catagory();
$cataDatas = array();
while ($data = mysqli_fetch_assoc($cata_info)) {
    $cataDatas[] = $data;
}

// Kiểm tra nếu có tìm kiếm sản phẩm
if (isset($_GET['search'])) {
    $keyword = $_GET['keyword']; // Lấy từ khóa tìm kiếm
    if (!empty($keyword)) {
        // Tìm kiếm sản phẩm theo từ khóa
        $search_query = $obj->search_product($keyword);

        // Lưu kết quả tìm kiếm
        $search_results = array();
        while ($search = mysqli_fetch_assoc($search_query)) {
            $search_results[] = $search;
        }
    } else {
        // Nếu không có từ khóa tìm kiếm, chuyển hướng về trang sản phẩm
        header('location:all_product.php');
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

            <!-- Phần hiển thị sản phẩm -->
            <div class="container">

                <?php 
                    $search_item = count($search_results); // Đếm số sản phẩm tìm thấy
                    echo "{$search_item} Sản phẩm tìm thấy"; // Hiển thị số lượng sản phẩm tìm được
                ?>

                <div class="product-category grid-style">

                    <div class="row">
                        <ul class="products-list">

                            <?php
                            // Lặp qua tất cả các sản phẩm tìm thấy và hiển thị
                            foreach ($search_results as $search_pdt) {
                            ?>

                                <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="single_product.php?status=singleproduct&&id=<?php echo $search_pdt['pdt_id'] ?>" class="link-to-product">
                                                <img src="admin/uploads/<?php echo $search_pdt['pdt_img'] ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories"> <?php echo $search_pdt['ctg_name'] ?> </b>
                                            
                                            <h4 class="product-title">
                                                <a href="single_product.php?status=singleproduct&&id=<?php echo $search_pdt['pdt_id'] ?>" class="pr-name"><?php echo $search_pdt['pdt_name'] ?></a>
                                            </h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol"></span><?php echo $search_pdt['pdt_price'] ?></span>VNĐ</ins>
                                            </div>
                                            <div class="shipping-info">
                                                <p class="shipping-day">Vận chuyển trong 3 ngày</p>
                                                <p class="for-today">Nhận hàng hôm nay</p>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">Tất cả sản phẩm được lựa chọn cẩn thận để đảm bảo an toàn thực phẩm.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <?php } ?>


                        </ul>
                    </div>

                    <!-- Phân trang -->
                    <div class="biolife-panigations-block">
                        <ul class="panigation-contain">
                            <li><span class="current-page">1</span></li>
                            <li><a href="#" class="link-page">2</a></li>
                            <li><a href="#" class="link-page">3</a></li>
                            <li><span class="sep">....</span></li>
                            <li><a href="#" class="link-page">20</a></li>
                            <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                        </ul>
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
