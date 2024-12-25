

<?php 
    $cmt_info = $obj->view_comment_all();

    if(isset($_GET['status'])){
        $comment_id = $_GET['id'];
        if($_GET['status']=='deletecomment'){
            
           $del_msg =  $obj->delete_comment($comment_id);
          

        }
    }


?>
<h2>Quản Lý Phản Hồi Của Khách Hàng.</h2>


<h5 class="text-danger">
<?php 
    if(isset($del_msg)){
        echo $del_msg;
    }

?>
</h5>
<table class="table table-bordered">
    <thead>
        <tr>
        <th>Mã Fd</th>
        <th>Mã Người Dùng</th>
        <th>Tên Người Dùng</th>
        <th>Mã Sản Phẩm</th>
        <th>Bình Luận Của Người Dùng</th>
        <th>Ngày Bình Luận</th>
        <th>Hành Động</th>

        </tr>
    </thead>

    <tbody>
        <?php 
            while($cmt_row = mysqli_fetch_assoc($cmt_info)){
        ?>
        <tr>
            <td>
                <?php echo $cmt_row['id']?>
            </td>

            <td>
                <?php echo $cmt_row['user_id']?>
            </td>

            <td>
                <?php echo $cmt_row['user_name']?>
            </td>

            <td>
                <?php echo $cmt_row['pdt_id']?>
            </td>

            <td style="width:250px ;">
                <?php echo $cmt_row['comment']?>
            </td>

            <td>
                <?php echo $cmt_row['comment_date']?>
            </td>

            <td>
                <a href="edit_comment.php?status=editcomment&&id= <?php echo $cmt_row['id']?>" class="btn btn-sm btn-warning">Sửa</a>
                <a href="?status=deletecomment&&id= <?php echo $cmt_row['id']?>" class="btn btn-sm btn-danger">xóa</a>
            </td>



        </tr>

        <?php }?>
    </tbody>
</table>