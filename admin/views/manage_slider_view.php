<?php
 $rows = $obj->SlideShow();
        
?>

<h2>quản lý trình chiếu</h2>

<table class="table">
    <thead>
        <tr>
        <th>ID Slide</th>
        <th>Dòng đầu tiên</th>
        <th>Dòng thứ hai</th>
        <th>Dòng thứ ba</th>
        <th>Nút bên trái</th>
        <th>Nút bên phải</th>
        <th>Ảnh slide</th>
        <th>Hành động</th>

        </tr>
    </thead>

    <tbody>

    <?php 
        while($row = mysqli_fetch_assoc($rows)){
    ?>
    
        <tr>
            <td> <?php echo $row['slider_id'] ?></td>
        

      
            <td> <?php echo $row['first_line'] ?></td>
    
            <td> <?php echo $row['second_line'] ?></td>
     
            <td> <?php echo $row['third_line'] ?></td>
       
            <td> <?php echo $row['btn_left'] ?></td>
        
            <td> <?php echo $row['btn_right'] ?></td>
      
            <td> <img src="uploads/<?php echo $row['slider_img'] ?>" width="200px"> </td>

            <td>
                <a href="edit_slider.php?status=edit&&id=<?php echo $row['slider_id'] ?>">sửa</a>
            </td>
        </tr>

        <?php } ?>
    </tbody>
</table>