<?php
date_default_timezone_set("Asia/Dhaka");

    $links = $obj->display_links();
    $link= mysqli_fetch_assoc($links);

  
    

?>
<style>
    .mydiv {
        width: 200px;
        position: absolute;
        right: 38px;
        overflow: hidden;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-center">
        <a href="#">

            <?php
            $obj = new adminback();
            $logo_info = $obj->display_logo();

            $logo = mysqli_fetch_assoc($logo_info);

            ?>
            <img class="img-fluid my-3" src="uploads/<?php echo $logo['img']; ?>" width="200px" alt="Theme-Logo" />
        </a>

    </div>
    <h4 class="text-center">Báo cáo doanh thu.</h4>
    <p class="text-center">Từ <span id="from" class="font-weight-bold"></span> Đến <span id="to" class="font-weight-bold"> <?php $mydate=getdate(date("U"));
echo "$mydate[year]-$mydate[mon]-$mydate[mday]"; ?> </span></p>

<p class="text-center">Email: <?php echo $link['email'] ?>, SĐT: <?php echo $link['phone'] ?> </p>

</div>









<div class="mydiv">
    <form action="" class="form">
        <select name="filterDate" id="filterDate" class="form-control">
            <option value="<?php echo date("Y-m-d") ?>">Hôm nay</option>
            <option value="<?php echo date('Y-m-d', strtotime('-7 days')) ?>">Tuần này</option>
            <option value="<?php echo date('Y-m-d', strtotime('-30 days')) ?>">Tháng này</option>
            <option value="<?php echo date('Y-m-d', strtotime('-365 days')) ?>">Năm nay</option>

            <option value="2020-01-01">Trọn đời.</option>
        </select>
    </form>
</div>
<div class="div">
    <br> <br>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-secondary">
            <th>Tổng Đơn Hàng Đã Đặt</th>
            <th>Tổng Số Tiền</th>
            <th>Đơn Hàng Đang Chờ</th>
            <th>Đơn Hàng Đang Xử Lý</th>
            <th>Đơn Hàng Đã Giao</th>
            <th>Tổng Số Khách Hàng</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="totalOrder"></td>
                <td id="totalSell"></td>
                <td id="pendingOrder"></td>
                <td id="processingOrder"></td>
                <td id="DeliverOrder"></td>
                <td id="totalCustomer"></td>
            </tr>
        </tbody>
    </table>
</div>


<br>

<div>
    <h5>Bán hàng theo sản phẩm.</h5> <br>
    <table class="table table-bordered table-striped">
        <thead>
        <tr class="bg-secondary">
            <th>Mã Sản Phẩm</th>
            <th>Tên Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Số Tiền</th>
        </tr>

        </thead>

        <tbody id="sell_by_pdt">


        </tbody>


    </table>


</div>

<br><br>
<div>
    <h5>Bán Theo Khách Hàng</h5> <br>
    <table class="table table-bordered table-striped">
        <thead>
        <tr class="bg-secondary">
            <th>Khách Hàng</th>
            <th>Tổng Đơn Hàng</th>
            <th>Số Tiền</th>
        </tr>

        </thead>

        <tbody id="sell_by_customer">


        </tbody>


    </table>


</div>





<script>
    $(document).ready(function() {



        $("#filterDate").change(function() {

            var filterId = this.value;
            $("#from").text(filterId);

            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'load_allorder',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#totalOrder').text(data);
                }
            });

            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'load_allsell',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#totalSell').text(data);
                }
            });

            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'load_allcustomer',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#totalCustomer').text(data);
                }
            });

            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'load_delivered_order',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#DeliverOrder').text(data);
                }
            });
            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'load_processing_order',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#processingOrder').text(data);
                }
            });

            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'load_pending_order',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#pendingOrder').text(data);
                }
            });




            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'sell_by_product',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#sell_by_pdt').html(data);

                }
            });

            $.ajax({
                url: "json/report_json.php",
                method: "POST",
                data: {
                    action: 'sell_by_customer',
                    did: filterId
                },
                success: function(data) {
                    var html = data;

                    $('#sell_by_customer').html(data);

                }
            });




        });


    })
</script>