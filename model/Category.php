<?php
require_once '../../config/db.php';

class Category {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả danh mục
    public function getAllCategories() {
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Thêm danh mục mới
    public function createCategory($name, $status) {
        $stmt = $this->conn->prepare("INSERT INTO categories (name, status) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $status);
        return $stmt->execute();
    }

    // Lấy thông tin danh mục theo ID
    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $status) {
        $stmt = $this->conn->prepare("UPDATE categories SET name = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sii", $name, $status, $id);
        return $stmt->execute();
    }

    // Xóa danh mục
    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
