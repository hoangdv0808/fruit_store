<?php 

    if(isset($_POST['add_ctg'])){
      $rtnMsg =   $obj->add_catagory($_POST);
    }
?>


<h2>Thêm danh mục</h2>

<h4 class="text-success"> <?php if(isset($rtnMsg)){ echo $rtnMsg; } ?> 

</h4>
<form action="" method="post">


    <div class="form-group">
        <label for="ctg_name">Tên</label>
        <input type="text" name="ctg_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="ctg_des">mô tả</label>
        <input type="text" name="ctg_des" class="form-control">
    </div>

    <div class="form-group">
        <label for="ctg_status">Trạng thái</label>
        <select name="ctg_status" class="form-control">
            <option value="1"> Hoạt động</option>
            <option value="0">Không Hoạt động</option>
        </select>
    </div>

    <input type="submit" value="Add Catagory" name="add_ctg" class="btn btn-primary" >

</form>