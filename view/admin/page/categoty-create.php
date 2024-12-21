<form method="POST" action="category.php?action=create">
    <label>Tên danh mục</label>
    <input type="text" name="name" required>
    <label>Trạng thái</label>
    <select name="status">
        <option value="1">Hiển thị</option>
        <option value="0">Ẩn</option>
    </select>
    <button type="submit">Thêm</button>
</form>
