
<?php 
    if(isset($_POST['cuopon_add'])){
       $coupon_msg =  $obj->add_coupon($_POST);
       
    }
?>

<h2>Thêm Mã Giảm Giá.</h2>

<h4>
    <?php 
        if(isset($coupon_msg)){
            echo $coupon_msg;
        }
    ?>
</h4>

<div>
    <form action="" method="POST">
      
    <div class="form-group">
    <label for="cuopon_code">Mã Giảm Giá</label>
    <input type="text" name="cuopon_code" class="form-control" >
</div>

<div class="form-group">
    <label for="cuopon_description">Mô Tả Mã Giảm Giá</label>
    <input type="text" name="cuopon_description" class="form-control" >
</div>

<div class="form-group">
    <label for="cuopon_discount">Giảm Giá</label>
    <input type="number" name="cuopon_discount" class="form-control" >
</div>

<div class="form-group">
    <label for="cuopon_status">Trạng Thái Mã Giảm Giá</label>
    <select name="cuopon_status" class="form-control">
        <option disabled>--Chọn--</option>
        <option value="1">Kích Hoạt</option>
        <option value="2">Vô Hiệu Hóa</option>
    </select>
</div>


    <div class="form-group">
       
        <input type="submit" name="cuopon_add" class="btn btn-primary" >
    </div>




       
    </form>
</div>
