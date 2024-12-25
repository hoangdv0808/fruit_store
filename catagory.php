<?php
include_once("admin/class/adminback.php");
$obj = new adminback();

// Lấy thông tin danh mục sản phẩm
$cata_info = $obj->p_display_catagory();
$cataDatas = array();
while ($data = mysqli_fetch_assoc($cata_info)) {
    $cataDatas[] = $data;
}

// Kiểm tra trạng thái và lấy sản phẩm theo danh mục
if (isset($_GET['status'])) {
    $cataId = $_GET['id'];
    if ($_GET['status'] == 'catView') {
        $pdt_info = $obj->display_product_byCata($cataId);
        
        $pdt_datas = array();
        while($pdt_ftecth = mysqli_fetch_assoc($pdt_info)){
            $pdt_datas[] = $pdt_ftecth;
        }
    }
}

// Lấy thông tin danh mục theo ID
if (isset($_GET['status'])) {
    $cataId = $_GET['id'];
    if ($_GET['status'] == 'catView') {
        $ctg_info = $obj->ctg_by_id($cataId);
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
            <!-- Phần Hero -->
            <div class="hero-section hero-background">
                <h1 class="page-title">
                    <?php
                   echo $ctg_info['ctg_name'];  // Hiển thị tên danh mục
                    ?>
                </h1>
            </div>

            <!-- Phần điều hướng -->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php" class="permal-link">Trang chủ</a></li>
                        <li class="nav-item"><span class="current-page">
                            <?php
                               echo $ctg_info['ctg_name'];  // Hiển thị tên danh mục
                            ?>
                            </span></li>
                    </ul>
                </nav>
            </div>

            <!-- Sản phẩm -->
            <div class="container">
                <div class="product-category grid-style">
                    <div class="row">
                        <ul class="products-list">
                            <?php
                            foreach ($pdt_datas as $pdt_data) {
                            ?>

                                <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="single_product.php?status=singleproduct&&id=<?php echo $pdt_data['pdt_id'] ?>" class="link-to-product">
                                                <img src="admin/uploads/<?php echo $pdt_data['pdt_img'] ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories"> <?php echo $pdt_data['ctg_name'] ?> </b>
                                            <h4 class="product-title"><a href="single_product.php?status=singleproduct&&id=<?php echo $pdt_data['pdt_id'] ?>" class="pr-name"><?php echo $pdt_data['pdt_name'] ?></a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol"> </span><?php echo $pdt_data['pdt_price'] ?></span> VNĐ</ins>
                                            </div>
                                            <div class="shipping-info">
                                                <p class="shipping-day">Giao hàng trong 3 ngày</p>
                                                <p class="for-today">Nhận hàng trong ngày</p>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">Tất cả các sản phẩm đều được chọn lọc cẩn thận để đảm bảo an toàn thực phẩm.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <?php } ?>

                        </ul>
                    </div>

                    <!-- Phần phân trang -->
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
    include_once("includes/mobile_global.php");
    ?>

    <!-- Nút cuộn lên đầu trang -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php
    include_once("includes/script.php");
    ?>
</body>

</html>
