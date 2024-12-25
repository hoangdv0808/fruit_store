<?php 
    $arry = $obj->show_admin_user();
   
  if(isset($_GET['status'])){
      $admin_id = $_GET['id'];
      if($_GET['status']=='delete'){
            $del_msg = $obj->delete_admin($admin_id);
      }
  }

?>

<div class="container">
    <h2>Quản lý người dùng</h2>

    <h4 class="text-success">
        <?php 
            if(isset($del_msg )){
                echo $del_msg;
            }
        ?>
    </h4>

    <table class="table table-bordered">
        <thead>

       
            <tr>
            <th>ID người dùng</th>
            <th>Email người dùng</th>
            <th>Vai trò người dùng</th>
            <th>Hành động</th>

            </tr>
        </thead>

        <tbody>
        <?php 
            while($user = mysqli_fetch_assoc($arry)){
        ?>
            <tr>
                <td> <?php echo $user['admin_id'] ?> </td>
                <td> <?php echo $user['admin_email'] ?> </td>
               
                <td> <?php if($user['role']==1){
                    echo "Admin";
                }else{
                    echo "Moderator";
                } ?> </td>
            
                <td>  
                    <a href="edit_admin.php?status=userEdit&&id=<?php echo $user['admin_id'] ?>" class="btn btn-sm btn-warning">Sửa </a>
                    <a href="?status=delete&&id=<?php echo $user['admin_id'] ?>" class="btn btn-sm btn-danger">xóa</a>

                </td>
            </tr>

           

            <?php }?>
        </tbody>
    </table>
</div>