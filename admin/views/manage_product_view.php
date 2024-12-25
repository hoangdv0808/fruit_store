

<?php 
    $obj=new adminback();
   $product_info =  $obj->display_product();

   if(isset($_GET['prostatus'])){
       $id = $_GET['id'];
       if($_GET['prostatus']=='published'){
        
           $obj->published_product($id);
       }elseif($_GET['prostatus']=='unpublished'){
           $obj->unpublished_product($id);
       }elseif($_GET['prostatus']=="delete"){
        $del_msg = $obj->delete_product($id);
    }
   }
?>
<h2>Quản lý sản phẩm</h2> 
<br>

<table class="table table-bordered">
    <thead>
        <tr>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Ảnh sản phẩm</th>
        <th>Trạng thái sản phẩm</th>
        <th>Danh mục sản phẩm</th>
        <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
<?php 
    if(isset($del_msg)){
        echo "{$del_msg}";
    }

?>
    <?php while($pdt = mysqli_fetch_assoc($product_info)) {?>
        <tr>
            <td> <?php echo $pdt['pdt_name'] ?></td>
            <td> <?php echo $pdt['pdt_price'] ?></td>
          
            <td>  <img style="height:60px" src="uploads/<?php echo $pdt['pdt_img'] ?>" alt=""> </td>
            <td> 
                <?php 
                    if($pdt['pdt_status']==0){
                        echo "Unpublished";
                        
                        ?>
                        <a href="?prostatus=published&&id=<?php echo $pdt['pdt_id']?>"  class="btn btn-sm btn-primary" >đang hoạt động</a>
                    <?php
                    }else{
                        echo "Published";
                       
                         ?>
                            <a href="?prostatus=unpublished&&id=<?php echo $pdt['pdt_id'] ?>" class="btn btn-sm btn-warning">chưa hoạt động</a>
                         <?php
                    }
                ?>
            </td>
            <td> <?php echo $pdt['ctg_name'] ?></td>
            <td>   <a href="edit_product.php?prostatus=edit&&id=<?php echo $pdt['pdt_id'] ?>">sửa</a> <br>
             <a href="?prostatus=delete&&id=<?php echo $pdt['pdt_id'] ?>">xóa</a>  </td>

        </tr>
        <?php }?>

        
    </tbody>
</table>


<script>




</script>