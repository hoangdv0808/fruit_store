<?php 
    $show_coupon = $obj->show_coupon();
 
    
?>

<h2>Quản lý mã giảm giá</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Mã Coupon</th>
            <th>Mã Giảm Giá</th>
            <th>Mô Tả Coupon</th>
            <th>Giảm Giá Coupon</th>
            <th>Hành Động</th>
        </tr>
    </thead>

    <tbody>
            <?php 
               while($result = mysqli_fetch_assoc($show_coupon) ){
            ?>
        <tr>
            <td> <?php echo $result['cupon_id'] ?></td>
            <td> <?php echo $result['cupon_code'] ?></td>
            <td> <?php echo $result['description'] ?></td>
            <td> <?php echo $result['discount'] ?></td>
            <td><a href="">sửa</a>  <a href="">xóa</a>  </td>
           
        </tr>

        <?php }?>
    </tbody>
</table>