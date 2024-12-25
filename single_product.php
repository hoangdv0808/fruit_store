<?php
session_start();
include_once("admin/class/adminback.php");
$obj = new adminback();

$cata_info = $obj->p_display_catagory();
$cataDatas = array();
while ($data = mysqli_fetch_assoc($cata_info)) {
    $cataDatas[] = $data;
}

if (isset($_GET['status'])) {
    $pdtId = $_GET['id'];
    if ($_GET['status'] == 'singleproduct') {
        $pdt_info = $obj->display_product_byId($pdtId);
        $pdt_fetch = mysqli_fetch_assoc($pdt_info);
        $pro_datas = array();
        $pro_datas[] = $pdt_fetch;
    }
}
$ctg_id = $pdt_fetch['ctg_id'];
$rel_pro = $obj->related_product($ctg_id);


if(isset($_POST['post_comment'])){
    $cmt_msg = $obj->post_comment($_POST);
}


$cmt_fetch = $obj->view_comment_id($_GET['id']);
if(isset($cmt_fetch)){
    $cmt_row = mysqli_num_rows($cmt_fetch);
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

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            <!--Hero Section-->
            <div class="hero-section hero-background">
                <h1 class="page-title">
                    <?php
                    foreach ($pro_datas as $pro_data) {
                        echo $pro_data['pdt_name'];
                    }
                    ?>
                </h1>

               
            </div>




            <!--Navigation section-->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php" class="permal-link">Trang chủ</a></li>

                        <li class="nav-item"><span class="current-page">

                                <?php
                                foreach ($pro_datas as $pro_data) {
                                    echo $pro_data['ctg_name'];
                                }
                                ?>
                            </span></li>

                        <li class="nav-item"><span class="current-page">

                                <?php
                                foreach ($pro_datas as $pro_data) {
                                    echo $pro_data['pdt_name'];
                                }
                                ?>
                            </span></li>
                    </ul>
                </nav>


            </div>

            <div class="container">
                <div class="page-contain single-product">
                    <div class="container">

                        <!-- Main content -->
                        <div id="main-content" class="main-content">

                            <?php
                            foreach ($pro_datas as $pro_data) {


                            ?>



                                <div>
                                    <!-- summary info -->
                                    <form action="addtocart.php" method="POST">

                                        <div class="sumary-product single-layout">
                                            <div class="media">
                                                <ul class="biolife-carousel slider-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                                                    <li><img src="admin/uploads/<?php echo $pro_data['pdt_img'] ?>" alt="" width="500" height="500"></li>

                                                </ul>

                                            </div>
                                            <div class="product-attribute">
                                                <h3 class="title"><?php echo $pro_data['pdt_name'] ?></h3>
                                                <div class="rating">
                                                    <p class="star-rating"><span class="width-80percent"></span></p>
                                                    <span class="review-count">(04 Đánh giá)</span>
                                                    <span class="qa-text">Câu hỏi & Trả lời</span>
                                                    <b class="category">Bởi: <?php echo $pro_data['ctg_name'] ?></b>
                                                </div>
                                                <span class="sku">Mã sản phẩm: <?php echo $pro_data['pdt_id'] ?></span>
                                                <span class="stock" style="margin-left: 200px;">Tình trạng hàng: <?php echo $pro_data['product_stock'] ?> </span>

                                                <p class="excerpt"><?php echo $pro_data['pdt_des'] ?></p>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">Tk. </span><?php echo $pro_data['pdt_price'] ?></span></ins>
                                                </div>

                                                <div class="shipping-info">
                                                    <p class="shipping-day">Giao hàng trong 3 ngày</p>
                                                    <p class="for-today">Nhận hàng hôm nay</p>
                                                </div>
                                            </div>

                                            <div class="action-form">

                                                <div class="total-price-contain">
                                                    <span class="title">Tổng tiền:</span>
                                                    <p class="price">Tk.
                                                        <?php

                                                        echo $pro_data['pdt_price'];

                                                        ?>


                                                    </p>
                                                </div>
                                                <div class="buttons">
                                                    <input type="hidden" name="pdt_name" value="<?php echo $pro_data['pdt_name'] ?>">

                                                    <input type="hidden" name="pdt_price" value="<?php echo $pro_data['pdt_price'] ?>">

                                                    <input type="hidden" name="pdt_img" value="<?php echo $pro_data['pdt_img'] ?>">
                                                    <input type="hidden" name="pdt_id" value="<?php echo $pro_data['pdt_id'] ?>">

                                                    <input type="submit" value="Add To Cart" class="btn btn-block btn-success" name="addtocart">

                                                </div>

                                    </form>

                                    <div class="social-media">
                                        <ul class="social-list">
                                            <li><a href="#" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="www.facebook.com" class="social-link"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="social-link"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="social-link"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="social-link"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="acepted-payment-methods">
                                        <ul class="payment-methods">
                                            <li><img src="assets/images/card1.jpg" alt="" width="51" height="36"></li>
                                            <li><img src="assets/images/card2.jpg" alt="" width="51" height="36"></li>
                                            <li><img src="assets/images/card3.jpg" alt="" width="51" height="36"></li>
                                            <li><img src="assets/images/card4.jpg" alt="" width="51" height="36"></li>
                                        </ul>
                                    </div>
                                </div>
                        </div>
                        </form>

                        <!-- Tab info -->
                        <div class="product-tabs single-layout biolife-tab-contain">
                            <div class="tab-head">
                            <ul class="tabs">
                                <li class="tab-element active"><a href="#tab_1st" class="tab-link">Mô tả sản phẩm</a></li>
                                <li class="tab-element"><a href="#tab_3rd" class="tab-link">Vận chuyển & Giao hàng</a></li>
                                <li class="tab-element"><a href="#tab_4th" class="tab-link">Đánh giá của khách hàng <sup>(3)</sup></a></li>
                            </ul>

                            </div>
                            <div class="tab-content">
                            <div id="tab_1st" class="tab-contain desc-tab active">
                                    <p class="desc">Quisque quis ipsum venenatis, fermentum ante volutpat, ornare enim. Phasellus molestie risus non aliquet cursus. Integer vestibulum mi lorem, id hendrerit ante lobortis non. Nunc ante ante, lobortis non pretium non, vulputate vel nisi. Maecenas dolor elit, fringilla nec turpis ac, auctor vulputate nulla. Phasellus sed laoreet velit.
                                        Proin fringilla urna vel mattis euismod. Etiam sodales, massa non tincidunt iaculis, mauris libero scelerisque justo, ut rutrum lectus urna sit amet quam. Nulla maximus vestibulum mi vitae accumsan. Donec sit amet ligula et enim semper viverra a in arcu. Vestibulum enim ligula, varius sed enim vitae, posuere molestie velit. Morbi risus orci, congue in nulla at, sodales fermentum magna.</p>
                                    <div class="desc-expand">
                                        <span class="title">Trái cây tươi hữu cơ</span>
                                        <ul class="list">
                                            <li>100% thành phần trái cây thật</li>
                                            <li>100 túi trái cây tươi được bọc riêng từng túi</li>
                                            <li>Kết hợp truyền thống Đông và Tây một cách tự nhiên</li>
                                        </ul>
                                    </div>
                                </div>


                                <div id="tab_3rd" class="tab-contain shipping-delivery-tab">
                                    <div class="accodition-tab biolife-accodition">
                                        <ul class="tabs">
                                        <li class="tab-item">
                                                <span class="title btn-expand">Mất bao lâu để nhận đơn hàng của tôi?</span>
                                                <div class="content">
                                                    <p>Các đơn hàng đặt trước 3 giờ chiều theo giờ miền Đông sẽ được xử lý và vận chuyển vào ngày làm việc tiếp theo. Đối với các đơn hàng nhận sau 3 giờ chiều, chúng thường được xử lý và vận chuyển vào ngày làm việc thứ hai. Ví dụ, nếu bạn đặt hàng sau 3 giờ chiều vào thứ Hai, đơn hàng sẽ được gửi vào thứ Tư. Các ngày làm việc không bao gồm thứ Bảy, Chủ Nhật và các ngày lễ. Vui lòng chờ thêm thời gian xử lý nếu đơn hàng của bạn được đặt vào cuối tuần hoặc ngày lễ. Khi đơn hàng được xử lý, tốc độ giao hàng sẽ được xác định như sau dựa trên phương thức vận chuyển đã chọn:</p>
                                                    <div class="desc-expand">
                                                        <span class="title">Phương thức vận chuyển</span>
                                                        <ul class="list">
                                                            <li>Tiêu chuẩn (vận chuyển trong 3-5 ngày làm việc)</li>
                                                            <li>Ưu tiên (vận chuyển trong 2-3 ngày làm việc)</li>
                                                            <li>Chuyển phát nhanh (vận chuyển trong 1-2 ngày làm việc)</li>
                                                            <li>Đơn hàng thẻ quà tặng được vận chuyển qua Bưu điện USPS First Class. Thư First Class sẽ được giao trong vòng 8 ngày làm việc</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="tab-item">
                                                <span class="title btn-expand">Phí vận chuyển được tính như thế nào?</span>
                                                <div class="content">
                                                    <p>Bạn sẽ phải trả phí vận chuyển dựa trên trọng lượng và kích thước của đơn hàng. Những mặt hàng lớn hoặc nặng có thể bao gồm phí xử lý quá khổ. Tổng phí vận chuyển sẽ được hiển thị trong giỏ hàng của bạn. Vui lòng tham khảo bảng vận chuyển dưới đây:</p>
                                                    <p>Lưu ý: Trọng lượng vận chuyển tính trong giỏ hàng có thể khác với trọng lượng trên trang sản phẩm do kích thước và trọng lượng thực tế của mặt hàng.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Tại sao đơn hàng của tôi không đủ điều kiện miễn phí vận chuyển?</span>
                                                <div class="content">
                                                    <p>Chúng tôi không giao hàng đến hộp thư P.O. hoặc hộp thư quân đội (APO, FPO, PSC). Chúng tôi giao hàng đến tất cả 50 tiểu bang và Puerto Rico. Một số mặt hàng có thể bị loại trừ khỏi việc giao hàng đến Puerto Rico. Điều này sẽ được chỉ ra trên trang sản phẩm.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Hạn chế vận chuyển?</span>
                                                <div class="content">
                                                    <p>Chúng tôi không giao hàng đến hộp thư P.O. hoặc hộp thư quân đội (APO, FPO, PSC). Chúng tôi giao hàng đến tất cả 50 tiểu bang và Puerto Rico. Một số mặt hàng có thể bị loại trừ khỏi việc giao hàng đến Puerto Rico. Điều này sẽ được chỉ ra trên trang sản phẩm.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Gói hàng không thể giao?</span>
                                                <div class="content">
                                                    <p>Thỉnh thoảng, gói hàng bị trả lại cho chúng tôi do không thể giao được bởi đơn vị vận chuyển. Khi đơn vị vận chuyển trả lại gói hàng không thể giao, chúng tôi sẽ hủy đơn hàng và hoàn tiền giá trị mua hàng, trừ đi phí vận chuyển. Dưới đây là một số lý do gói hàng có thể bị trả lại như không thể giao được:</p>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div id="tab_4th" class="tab-contain review-tab">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                                <div class="rating-info">
                                                <p class="index"><strong class="rating">4.4</strong> trên 5</p>

                                                    <div class="rating">
                                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                                    </div>
                                                    <p class="see-all">Xem tất cả <?php echo $cmt_row?> đánh giá</p>

                                                    <ul class="options">
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">5 sao</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-90percent"></span></span>
                                                                </span>
                                                                <span class="number">90</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">4 sao</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-30percent"></span></span>
                                                                </span>
                                                                <span class="number">30</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">3 sao</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-40percent"></span></span>
                                                                </span>
                                                                <span class="number">40</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">2 sao</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-20percent"></span></span>
                                                                </span>
                                                                <span class="number">20</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail-for">
                                                                <span class="option-name">1star</span>
                                                                <span class="progres">
                                                                    <span class="line-100percent"><span class="percent width-10percent"></span></span>
                                                                </span>
                                                                <span class="number">10</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                                <?php
                                                if (isset($_SESSION['user_id'])) {
                                                ?>
                                                    <div class="review-form-wrapper">
                                                    <span class="title">Gửi đánh giá của bạn</span>

                                                        <form action="#" name="frm-review" method="post">
                                                            <div class="comment-form-rating">

                                                            <?php 
                                                                if(isset($cmt_msg)){
                                                                    echo '<script>alert("Thanks for your valuable feedback")</script>';
                                                                }
                                                            ?>
                                                                <label>1. Nhận xét của bạn về sản phẩm này:</label>
                                                            </div>
                                                            <p class="form-row">
                                                                <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" name="user_id">
                                                                <input type="hidden" value="<?php echo  $_SESSION['username'] ?>" name="user_name">
                                                                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="pdt_id">

                                                                <textarea name="comment" id="txt-comment" cols="30" rows="10" placeholder="Write your review here..." required></textarea>
                                                            </p>


                                                            <p class="">
                                                                <input type="submit" name="post_comment" value="Post Comment" class="btn btn-success">
                                                            </p>




                                                        </form>
                                                    </div>


                                                <?php } ?>
                                            </div>

                                           


                                        </div>
                                        <div id="comments">
                                            <ol class="commentlist">

                                            <?php 
                                            
                                               
                                        while($cmtinfo=mysqli_fetch_assoc($cmt_fetch)){
                                                  
                                            
                                            ?>
                                                <li class="review">
                                                    <div class="comment-container">
                                                        <div class="row">
                                                            <div class="comment-content col-lg-8 col-md-9 col-sm-8 col-xs-12">

                                                            <p class="comment-in"><span class="post-name"></span>
                                                            <span class="post-date"><?php echo $cmtinfo['comment_date'] ?></span></p>
                                                              
                                                                
                                                                <p class="author">Bởi : <b><?php echo $cmtinfo['user_name'] ?></b></p>

                                                                <p class="comment-text"><?php echo $cmtinfo['comment'] ?>.</p>

                                                            </div>
                                                            <div class="comment-review-form col-lg-3 col-lg-offset-1 col-md-3 col-sm-4 col-xs-12">
                                                            <span class="title">Đánh giá này có hữu ích không?</span>
                                                                <ul class="actions">
                                                                <li><a href="#" class="btn-act like" data-type="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Có (100)</a></li>
                                                                <li><a href="#" class="btn-act hate" data-type="dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i>Không (20)</a></li>
                                                                <li><a href="#" class="btn-act report" data-type="dislike"><i class="fa fa-flag" aria-hidden="true"></i>Báo cáo</a></li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <?php     
                                            }
                                            ?>
                                                
                                            </ol>
                                            <div class="biolife-panigations-block version-2">
                                                <ul class="panigation-contain">
                                                    <li><span class="current-page">1</span></li>
                                                    <li><a href="#" class="link-page">2</a></li>
                                                    <li><a href="#" class="link-page">3</a></li>
                                                    <li><span class="sep">....</span></li>
                                                    <li><a href="#" class="link-page">20</a></li>
                                                    <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                                </ul>
                                                <div class="result-count">
                                                    <p class="txt-count"><b>1-5</b> trong số <b>126</b> đánh giá</p>
                                                    <a href="#" class="link-to">Xem tất cả<i class="fa fa-caret-right" aria-hidden="true"></i></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- related products -->
                        <div class="product-related-box single-layout">
                            <div class="biolife-title-box lg-margin-bottom-26px-im">
                                <span class="biolife-icon icon-organic"></span>
                                <span class="subtitle">Tất cả những sản phẩm tốt nhất cho bạn</span>
                                <h3 class="main-title">Sản phẩm liên quan</h3>

                            </div>
                            <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                                <?php while ($r_pro = mysqli_fetch_assoc($rel_pro)) { ?>
                                    <li class="product-item">
                                        <div class="contain-product layout-default">
                                            <?php var_dump($r_pro); ?>
                                            <div class="product-thumb">
                                                <a href="single_product.php?status=singleproduct&&id=<?php echo $r_pro['pdt_id'] ?>" class="link-to-product">
                                                    <img src="admin/uploads/<?php echo $r_pro['pdt_img'] ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories"><?php echo $r_pro['ctg_name'] ?></b>
                                                <h4 class="product-title"><a href="single_product.php?status=singleproduct&&id=<?php echo $r_pro['pdt_id'] ?>" class="pr-name"> <?php echo $r_pro['pdt_name'] ?> </a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">$</span>
                                                            <?php echo $r_pro['pdt_price'] ?>
                                                        </span></ins>

                                                </div>
                                                <div class="slide-down-box">
                                                    <p class="message">Tất cả sản phẩm đều được lựa chọn cẩn thận để đảm bảo an toàn thực phẩm.</p>


                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>




                <?php } ?>
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

    <!--Footer For Mobile-->
    <?php
    include_once("includes/mobile_footer.php");
    ?>

    <?php
    include_once("includes/mobile_global.php")
    ?>


    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php
    include_once("includes/script.php")
    ?>
</body>

</html>