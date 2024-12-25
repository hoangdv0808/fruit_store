
<?php 
    $cata_info = $obj-> p_display_catagory();

    if(isset($_POST['add_pdt'])){
        $rtn_msg = $obj->add_product($_POST);
    }
?>

<h2>Thêm Sản phẩm</h2>
<h6 class="text-success">
   <?php 
     if(isset($rtn_msg)){
         echo $rtn_msg;
     }
   ?>

</h6>
<form action="" method="post" enctype="multipart/form-data" class="form">
    <div class="form-group">
        <label for="pdt_name">Tên Sản Phẩm</label>
        <input type="text" name="pdt_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="pdt_price">Giá Sản Phẩm</label>
        <input type="text" name="pdt_price" class="form-control">
    </div>

    <div class="form-group">
        <label for="pdt_des">Mô Tả Sản Phẩm</label>
        <textarea name="pdt_des" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="pdt_img">Số Lượng Sản Phẩm</label>
        <input type="number" name="pdt_stock" class="form-control" max='30' min='1'>
    </div>

    <div class="form-group">
        <label for="pdt_ctg">Danh Mục Sản Phẩm</label>
        <select name="pdt_ctg" class="form-control">
        <option value="">Chọn Danh Mục</option>

        <?php while($cata = mysqli_fetch_assoc($cata_info)){ ?>
        <option value="<?php echo $cata['ctg_id'] ?>"><?php echo $cata['ctg_name'] ?></option>

        <?php }?>
        </select>
    </div>

    <div class="form-group">
        <label for="pdt_img">Hình Ảnh Sản Phẩm</label>
        <input type="file" name="pdt_img" class="form-control">
    </div>

    <div class="form-group">
        <label for="pdt_status">Trạng Thái</label>
        <select name="pdt_status" class="form-control">
            <option value="1">Đã Được Xuất Bản</option>
            <option value="0">Chưa Xuất Bản</option>
        </select>
    </div>

    <input type="submit" value="Thêm Sản Phẩm" name="add_pdt" class="btn btn-block btn-primary">
</form>
