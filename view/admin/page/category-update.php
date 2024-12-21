<?php
require_once '../../model/Category.php';
$categoryModel = new Category();
$category = $categoryModel->getCategoryById($_GET['id']);
?>

<form method="POST" action="category.php?action=update">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">
    <label>Tên danh mục</label>
    <input type="text" name="name" value="<?= $category['name'] ?>" required>
    <label>Trạng thái</label>
    <select name="status">
        <option value="1" <?= $category['status'] ? 'selected' : '' ?>>Hiển thị</option>
        <option value="0" <?= !$category['status'] ? 'selected' : '' ?>>Ẩn</option>
    </select>
    <button type="submit">Cập nhật</button>
</form>
